-- =========================================================
-- Database: perpustakaan
-- Studi Kasus: Sistem Perpustakaan dengan Business Logic
--
-- File ini AMAN untuk di-import berkali-kali (idempotent):
-- database & tabel lama akan dihapus dulu sebelum dibuat ulang,
-- jadi tidak akan pernah bentrok dengan sisa data/metadata lama.
-- =========================================================

DROP DATABASE IF EXISTS perpustakaan;
CREATE DATABASE perpustakaan;
USE perpustakaan;

-- Tabel anggota (mahasiswa peminjam)
CREATE TABLE anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel buku
CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(20) NOT NULL UNIQUE,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    status ENUM('tersedia', 'habis') NOT NULL DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel peminjaman
CREATE TABLE peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_peminjaman VARCHAR(20) NOT NULL UNIQUE,
    nim VARCHAR(20) NOT NULL,
    id_buku INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    tanggal_kembali_aktual DATE NULL,
    status ENUM('dipinjam', 'kembali') NOT NULL DEFAULT 'dipinjam',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_peminjaman_anggota FOREIGN KEY (nim) REFERENCES anggota(nim)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_peminjaman_buku FOREIGN KEY (id_buku) REFERENCES buku(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Data awal: anggota
INSERT INTO anggota (nim, nama) VALUES
('20241001', 'Andi Pratama'),
('20241002', 'Siti Nurhaliza'),
('20241003', 'Budi Santoso');

-- Data awal: buku (mengikuti contoh pada dokumen studi kasus)
INSERT INTO buku (kode_buku, judul, penulis, penerbit, tahun_terbit, stok, status) VALUES
('BK001', 'Pemrograman Web Dasar', 'Andi Setiawan', 'Informatika Press', 2021, 5, 'tersedia'),
('BK002', 'Struktur Data dan Algoritma', 'Budi Santoso', 'Elex Media Komputindo', 2020, 3, 'tersedia'),
('BK003', 'Basis Data', 'Siti Aminah', 'Andi Offset', 2019, 0, 'habis'),
('BK004', 'Jaringan Komputer', 'Rizky Pratama', 'Media Komputindo', 2022, 7, 'tersedia'),
('BK005', 'Keamanan Web', 'Dewi Lestari', 'Penerbit IT', 2021, 2, 'tersedia');

-- Data awal: peminjaman (mengikuti contoh pada dokumen studi kasus)
-- Catatan: stok pada baris di atas sudah memperhitungkan 2 peminjaman aktif berikut
-- (BK001 dan BK002 masing-masing sudah dikurangi 1 dari stok "penuh").
INSERT INTO peminjaman (kode_peminjaman, nim, id_buku, tanggal_pinjam, tanggal_kembali, tanggal_kembali_aktual, status) VALUES
('PJ001', '20241001', 1, '2026-08-23', '2026-08-30', NULL, 'dipinjam'),
('PJ002', '20241002', 2, '2026-08-20', '2026-08-27', NULL, 'dipinjam'),
('PJ003', '20241003', 4, '2026-08-18', '2026-08-25', '2026-08-24', 'kembali');
