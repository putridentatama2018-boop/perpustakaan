<?php
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (BASE_URL !== '' && str_starts_with($current, BASE_URL)) $current = substr($current, strlen(BASE_URL));
$current = '/' . ltrim($current, '/');
if ($current !== '/') $current = rtrim($current, '/');
function isActive(string $path, string $current): string { return $current === $path ? 'active' : ''; }
?>
<div class="menu-title">Menu Utama</div>
<a href="<?= BASE_URL ?>/" class="<?= isActive('/', $current) ?>"><i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span></a>
<a href="<?= BASE_URL ?>/buku" class="<?= isActive('/buku', $current) ?>"><i class="bi bi-book"></i><span>Data Buku</span></a>
<a href="<?= BASE_URL ?>/peminjaman" class="<?= isActive('/peminjaman', $current) ?>"><i class="bi bi-journal-arrow-up"></i><span>Peminjaman</span></a>
<a href="<?= BASE_URL ?>/pengembalian" class="<?= isActive('/pengembalian', $current) ?>"><i class="bi bi-arrow-return-left"></i><span>Pengembalian</span></a>
<a href="<?= BASE_URL ?>/anggota" class="<?= isActive('/anggota', $current) ?>"><i class="bi bi-people"></i><span>Data Anggota</span></a>
<div class="menu-title">Informasi</div>
<a href="<?= BASE_URL ?>/laporan" class="<?= isActive('/laporan', $current) ?>"><i class="bi bi-file-earmark-bar-graph"></i><span>Laporan</span></a>
