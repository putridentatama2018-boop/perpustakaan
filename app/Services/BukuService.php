<?php

namespace App\Services;

use App\Repositories\BukuRepository;
use App\Exceptions\BukuTidakDitemukanException;
use App\Helpers\Logger;


class BukuService
{
    private BukuRepository $repo;

    public function __construct()
    {
        $this->repo = new BukuRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }

    public function getById(int $id): array
    {
        $buku = $this->repo->find($id);

        if (!$buku) {
            throw new BukuTidakDitemukanException();
        }

        return $buku;
    }

    
    public function validate(array $input, ?int $ignoreId = null): array
    {
        $errors = [];

        $kodeBuku = trim($input['kode_buku'] ?? '');
        if ($kodeBuku === '') {
            $errors['kode_buku'] = 'ID Buku wajib diisi.';
        } else {
            $existing = $this->repo->findByKode($kodeBuku);
            if ($existing && (int) $existing['id'] !== (int) $ignoreId) {
                $errors['kode_buku'] = 'ID Buku sudah digunakan oleh data lain.';
            }
        }

        if (trim($input['judul'] ?? '') === '') {
            $errors['judul'] = 'Judul wajib diisi.';
        }

        if (trim($input['penulis'] ?? '') === '') {
            $errors['penulis'] = 'Penulis wajib diisi.';
        }

        if (trim($input['penerbit'] ?? '') === '') {
            $errors['penerbit'] = 'Penerbit wajib diisi.';
        }

        $tahun = (string) ($input['tahun_terbit'] ?? '');
        if ($tahun === '' || !ctype_digit($tahun) || (int) $tahun < 1900 || (int) $tahun > (int) date('Y') + 1) {
            $errors['tahun_terbit'] = 'Tahun terbit tidak valid.';
        }

        $stok = (string) ($input['stok'] ?? '');
        if ($stok === '' || !ctype_digit($stok) || (int) $stok < 0) {
            $errors['stok'] = 'Stok harus berupa angka dan tidak boleh negatif.';
        }

        return $errors;
    }

    public function create(array $input): int
    {
        $id = $this->repo->create([
            'kode_buku'    => trim($input['kode_buku']),
            'judul'        => trim($input['judul']),
            'penulis'      => trim($input['penulis']),
            'penerbit'     => trim($input['penerbit']),
            'tahun_terbit' => (int) $input['tahun_terbit'],
            'stok'         => (int) $input['stok'],
        ]);

        Logger::info("Buku ditambahkan: ID={$id}, Kode={$input['kode_buku']}, Judul={$input['judul']}");

        return $id;
    }

    public function update(int $id, array $input): void
    {
        $this->getById($id); // memastikan data ada, jika tidak -> BukuTidakDitemukanException

        $this->repo->update($id, [
            'kode_buku'    => trim($input['kode_buku']),
            'judul'        => trim($input['judul']),
            'penulis'      => trim($input['penulis']),
            'penerbit'     => trim($input['penerbit']),
            'tahun_terbit' => (int) $input['tahun_terbit'],
            'stok'         => (int) $input['stok'],
        ]);

        Logger::info("Buku diperbarui: ID={$id}");
    }

    /**
     * Ketentuan #6: buku yang sedang dipinjam tidak boleh dihapus.
     */
    public function delete(int $id): void
    {
        $this->getById($id);

        if ($this->repo->adaPeminjamanAktif($id)) {
            throw new \RuntimeException('Buku yang sedang dipinjam tidak boleh dihapus.');
        }

        $this->repo->delete($id);

        Logger::info("Buku dihapus: ID={$id}");
    }
}
