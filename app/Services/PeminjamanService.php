<?php

namespace App\Services;

use App\Repositories\PeminjamanRepository;
use App\Repositories\BukuRepository;
use App\Repositories\AnggotaRepository;
use App\Exceptions\BukuTidakTersediaException;
use App\Exceptions\BatasPeminjamanException;
use App\Exceptions\BukuTidakDitemukanException;
use App\Exceptions\TransaksiTidakDitemukanException;
use App\Helpers\Logger;

class PeminjamanService
{
    private const MAKS_PINJAM_PER_MAHASISWA = 3;

    private PeminjamanRepository $repo;
    private BukuRepository $bukuRepo;
    private AnggotaRepository $anggotaRepo;

    public function __construct()
    {
        $this->repo        = new PeminjamanRepository();
        $this->bukuRepo    = new BukuRepository();
        $this->anggotaRepo = new AnggotaRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }


    public function validate(array $input): array
    {
        $errors = [];

        $nim = trim($input['nim'] ?? '');
        if ($nim === '') {
            $errors['nim'] = 'NIM wajib diisi.';
        } elseif (!ctype_digit($nim)) {
            $errors['nim'] = 'NIM harus berupa angka.';
        } elseif (!$this->anggotaRepo->findByNim($nim)) {
            $errors['nim'] = 'NIM tidak terdaftar sebagai anggota perpustakaan.';
        }

        if (empty($input['id_buku'])) {
            $errors['id_buku'] = 'Buku wajib dipilih.';
        }

        $tglPinjam  = trim($input['tanggal_pinjam'] ?? '');
        $tglKembali = trim($input['tanggal_kembali'] ?? '');

        if ($tglPinjam === '' || !$this->isTanggalValid($tglPinjam)) {
            $errors['tanggal_pinjam'] = 'Tanggal peminjaman tidak valid.';
        }

        if ($tglKembali === '' || !$this->isTanggalValid($tglKembali)) {
            $errors['tanggal_kembali'] = 'Tanggal pengembalian tidak valid.';
        }

        if (empty($errors['tanggal_pinjam']) && empty($errors['tanggal_kembali'])
            && strtotime($tglKembali) < strtotime($tglPinjam)) {
            $errors['tanggal_kembali'] = 'Tanggal pengembalian tidak boleh sebelum tanggal peminjaman.';
        }

        return $errors;
    }

    private function isTanggalValid(string $tanggal): bool
    {
        $d = \DateTime::createFromFormat('Y-m-d', $tanggal);
        return $d !== false && $d->format('Y-m-d') === $tanggal;
    }

    /**
     * Memproses peminjaman buku baru.
     *
     * @throws BukuTidakDitemukanException jika id_buku tidak valid
     * @throws BukuTidakTersediaException  jika stok buku 0 (ketentuan #1 & #5)
     * @throws BatasPeminjamanException    jika mahasiswa sudah pinjam 3 buku (ketentuan #2)
     */
    public function pinjam(array $input): int
    {
        $nim    = trim($input['nim']);
        $idBuku = (int) $input['id_buku'];

        // Ketentuan validasi ketersediaan buku.
        $buku = $this->bukuRepo->find($idBuku);
        if (!$buku) {
            throw new BukuTidakDitemukanException();
        }

        // Ketentuan #1 & #5: buku dengan stok 0 tidak boleh dipinjam.
        if ((int) $buku['stok'] <= 0) {
            throw new BukuTidakTersediaException();
        }

        // Ketentuan #2: maksimal 3 buku sedang dipinjam per mahasiswa.
        $jumlahAktif = $this->repo->countAktifByNim($nim);
        if ($jumlahAktif >= self::MAKS_PINJAM_PER_MAHASISWA) {
            throw new BatasPeminjamanException();
        }

        $kodePeminjaman = 'PJ' . date('ymd') . str_pad((string) random_int(0, 999), 3, '0', STR_PAD_LEFT);

        $id = $this->repo->create([
            'kode_peminjaman' => $kodePeminjaman,
            'nim'             => $nim,
            'id_buku'         => $idBuku,
            'tanggal_pinjam'  => $input['tanggal_pinjam'],
            'tanggal_kembali' => $input['tanggal_kembali'],
        ]);

        // Ketentuan #3: stok berkurang 1 setelah peminjaman berhasil.
        $this->bukuRepo->decrementStok($idBuku);

        Logger::info(
            "Peminjaman berhasil: Kode={$kodePeminjaman}, NIM={$nim}, IDBuku={$idBuku}, " .
            "TglPinjam={$input['tanggal_pinjam']}, TglKembaliRencana={$input['tanggal_kembali']}"
        );

        return $id;
    }

    /**
     * Memproses pengembalian buku.
     *
     * @throws TransaksiTidakDitemukanException jika ID transaksi tidak ada
     */
    public function kembalikan(int $id): void
    {
        $peminjaman = $this->repo->find($id);

        if (!$peminjaman) {
            throw new TransaksiTidakDitemukanException();
        }

        if ($peminjaman['status'] === 'kembali') {
            throw new \RuntimeException('Transaksi ini sudah tercatat sebagai dikembalikan.');
        }

        $tanggalKembaliAktual = date('Y-m-d');

        $this->repo->tandaiKembali($id, $tanggalKembaliAktual);

        // Ketentuan #4: stok bertambah 1 ketika buku dikembalikan.
        $this->bukuRepo->incrementStok((int) $peminjaman['id_buku']);

        Logger::info(
            "Pengembalian berhasil: IDPeminjaman={$id}, Kode={$peminjaman['kode_peminjaman']}, " .
            "IDBuku={$peminjaman['id_buku']}, TglKembaliAktual={$tanggalKembaliAktual}"
        );
    }
}
