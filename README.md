# Sistem Perpustakaan dengan Business Logic

Aplikasi manajemen peminjaman buku perpustakaan kampus, dibangun dengan **PHP Native**
menggunakan arsitektur **MVC + Service Layer + Repository Pattern**, mengikuti pola yang
diajarkan pada BKPM Workshop Sistem Informasi Web Server (Acara 1–14).

## Fitur

- CRUD Data Buku (tambah, lihat, ubah, hapus, detail).
- Transaksi Peminjaman & Pengembalian buku.
- Dashboard, Data Anggota, dan Laporan untuk tampilan administrasi seperti contoh studi kasus.
- Business Logic (di Service Layer, bukan Controller):
  1. Buku hanya dapat dipinjam apabila stok > 0.
  2. Satu mahasiswa maksimal memiliki 3 buku yang sedang dipinjam.
  3. Setelah peminjaman berhasil, stok buku berkurang 1.
  4. Ketika buku dikembalikan, stok bertambah 1.
  5. Buku yang stoknya 0 tidak boleh dipinjam.
  6. Buku yang sedang dipinjam tidak boleh dihapus.
  7. Data peminjaman tidak boleh dihapus sembarangan (tidak ada fitur hapus peminjaman;
     status hanya berpindah dari "dipinjam" ke "kembali").
- Validasi input: NIM, ID Buku, tanggal peminjaman, tanggal pengembalian, ketersediaan buku.
- Exception khusus dengan pesan baku:
  - `Buku tidak tersedia.`
  - `Mahasiswa telah mencapai batas maksimal peminjaman.`
  - `Data buku tidak ditemukan.`
  - `Transaksi peminjaman tidak ditemukan.`
- Logging setiap transaksi peminjaman & pengembalian ke `storage/logs/app.log`.
- Pola **PRG (Post → Redirect → Get)** pada seluruh aksi tambah/ubah/hapus/pinjam/kembalikan
  agar data tidak terkirim ulang saat halaman di-refresh.

## Struktur Folder

```
perpustakaan/
├── app/
│   ├── Config/Database.php        <- Koneksi PDO (singleton)
│   ├── Core/
│   │   ├── Controller.php         <- Base Controller (view, redirect, flash, dsb.)
│   │   └── Router.php             <- Router array sederhana
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── BukuController.php
│   │   └── PeminjamanController.php
│   ├── Services/                  <- SELURUH business logic & validasi ada di sini
│   │   ├── BukuService.php
│   │   └── PeminjamanService.php
│   ├── Repositories/               <- Satu-satunya lapisan yang menjalankan query SQL
│   │   ├── BukuRepository.php
│   │   ├── AnggotaRepository.php
│   │   └── PeminjamanRepository.php
│   ├── Exceptions/                 <- Exception khusus sesuai ketentuan studi kasus
│   ├── Helpers/Logger.php          <- Logging ke storage/logs/app.log
│   └── Views/                      <- Layout, partial, dan halaman (Bootstrap 5)
├── config/database.php             <- Kredensial database
├── database/perpustakaan.sql       <- Skema + data awal (seed)
├── public/
│   ├── index.php                   <- Front Controller (satu-satunya entry point)
│   └── .htaccess                   <- URL rewriting ke index.php
├── routes/web.php                  <- Pemetaan URL ke Controller
└── storage/logs/app.log            <- Log transaksi & error (dibuat otomatis)
```

## Instalasi & Menjalankan

1. Salin folder `perpustakaan/` ke dalam `htdocs` XAMPP/Laragon.
2. Jalankan Apache & MySQL, lalu buka phpMyAdmin.
3. Import `database/perpustakaan.sql` (akan otomatis membuat database `perpustakaan`
   beserta data contoh).
4. Sesuaikan kredensial di `config/database.php` bila perlu (default: `root` tanpa password).
5. Pastikan module `mod_rewrite` Apache aktif (dibutuhkan `.htaccess` di `public/`).
6. Akses aplikasi melalui browser, contoh:
   `http://localhost/perpustakaan/public/`

## Alur Arsitektur

```
User -> Controller -> Service (validasi + business logic) -> Repository (query SQL) -> MySQL
                                     |
                                     v
                         Exception jika terjadi masalah
                                     |
                                     v
                          Logging (storage/logs/app.log)
                                     |
                                     v
                        Flash Message (session) -> Redirect (PRG) -> User melihat hasil
```
