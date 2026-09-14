<?php

namespace App\Repositories;

use App\Config\Database;
use PDO;

/**
 * AnggotaRepository
 *
 * Menangani query ke tabel `anggota` (data mahasiswa/peminjam),
 * digunakan untuk validasi NIM dan menampilkan nama anggota pada daftar peminjaman.
 */
class AnggotaRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        return $this->db->query('SELECT * FROM anggota ORDER BY nama ASC')->fetchAll();
    }


    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO anggota (nim, nama) VALUES (:nim, :nama)'
        );
        $stmt->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function findByNim(string $nim): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM anggota WHERE nim = :nim');
        $stmt->execute(['nim' => $nim]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
