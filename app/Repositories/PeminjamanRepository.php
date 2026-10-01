<?php

namespace App\Repositories;

use App\Config\Database;
use PDO;

class PeminjamanRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        return $this->db->query(
            "SELECT p.*, a.nama AS nama_anggota, b.judul AS judul_buku, b.kode_buku
             FROM peminjaman p
             JOIN anggota a ON p.nim = a.nim
             JOIN buku b ON p.id_buku = b.id
             ORDER BY p.id DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM peminjaman WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function countAktifByNim(string $nim): int
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM peminjaman WHERE nim = :nim AND status = 'dipinjam'"
        );
        $stmt->execute(['nim' => $nim]);
        return (int) $stmt->fetchColumn();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO peminjaman (kode_peminjaman, nim, id_buku, tanggal_pinjam, tanggal_kembali, status)
             VALUES (:kode_peminjaman, :nim, :id_buku, :tanggal_pinjam, :tanggal_kembali, 'dipinjam')"
        );

        $stmt->execute([
            'kode_peminjaman' => $data['kode_peminjaman'],
            'nim'             => $data['nim'],
            'id_buku'         => $data['id_buku'],
            'tanggal_pinjam'  => $data['tanggal_pinjam'],
            'tanggal_kembali' => $data['tanggal_kembali'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function tandaiKembali(int $id, string $tanggalKembaliAktual): void
    {
        $stmt = $this->db->prepare(
            "UPDATE peminjaman
             SET status = 'kembali', tanggal_kembali_aktual = :tgl
             WHERE id = :id"
        );
        $stmt->execute(['tgl' => $tanggalKembaliAktual, 'id' => $id]);
    }
}
