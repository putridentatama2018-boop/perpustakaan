<?php

namespace App\Repositories;

use App\Config\Database;
use PDO;

/**
 * BukuRepository
 *
 * Satu-satunya lapisan yang menjalankan query SQL untuk tabel `buku`.
 * Seluruhnya menggunakan PDO Prepared Statement untuk mencegah SQL Injection.
 */
class BukuRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        return $this->db->query('SELECT * FROM buku ORDER BY id DESC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM buku WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findByKode(string $kodeBuku): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM buku WHERE kode_buku = :kode');
        $stmt->execute(['kode' => $kodeBuku]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO buku (kode_buku, judul, penulis, penerbit, tahun_terbit, stok, status)
             VALUES (:kode_buku, :judul, :penulis, :penerbit, :tahun_terbit, :stok, :status)'
        );

        $stmt->execute([
            'kode_buku'    => $data['kode_buku'],
            'judul'        => $data['judul'],
            'penulis'      => $data['penulis'],
            'penerbit'     => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'stok'         => $data['stok'],
            'status'       => $data['stok'] > 0 ? 'tersedia' : 'habis',
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE buku
             SET kode_buku = :kode_buku,
                 judul = :judul,
                 penulis = :penulis,
                 penerbit = :penerbit,
                 tahun_terbit = :tahun_terbit,
                 stok = :stok,
                 status = :status
             WHERE id = :id'
        );

        $stmt->execute([
            'kode_buku'    => $data['kode_buku'],
            'judul'        => $data['judul'],
            'penulis'      => $data['penulis'],
            'penerbit'     => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'stok'         => $data['stok'],
            'status'       => $data['stok'] > 0 ? 'tersedia' : 'habis',
            'id'           => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM buku WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    /**
     * Ketentuan #3: stok berkurang 1 setelah peminjaman berhasil.
     * Kondisi "stok > 0" ditambahkan lagi di level query sebagai lapisan pengaman kedua
     * (defense in depth) selain pengecekan yang sudah dilakukan di Service Layer.
     */
    public function decrementStok(int $id): void
    {
        $stmt = $this->db->prepare(
            "UPDATE buku
             SET stok = stok - 1,
                 status = IF(stok - 1 > 0, 'tersedia', 'habis')
             WHERE id = :id AND stok > 0"
        );
        $stmt->execute(['id' => $id]);
    }

    /**
     * Ketentuan #4: stok bertambah 1 ketika buku dikembalikan.
     */
    public function incrementStok(int $id): void
    {
        $stmt = $this->db->prepare(
            "UPDATE buku SET stok = stok + 1, status = 'tersedia' WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
    }

    /**
     * Ketentuan #6: buku yang sedang dipinjam tidak boleh dihapus.
     */
    public function adaPeminjamanAktif(int $id): bool
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM peminjaman WHERE id_buku = :id AND status = 'dipinjam'"
        );
        $stmt->execute(['id' => $id]);
        return (int) $stmt->fetchColumn() > 0;
    }
}
