<?php
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (BASE_URL !== '' && str_starts_with($current, BASE_URL)) $current = substr($current, strlen(BASE_URL));
$current = '/' . ltrim($current, '/');
if ($current !== '/') $current = rtrim($current, '/');
function isActive(string $path, string $current): string { 
    if ($path === '/' && ($current === '/' || $current === '')) return 'active';
    if ($path !== '/' && str_starts_with($current, $path)) return 'active';
    return ''; 
}
?>
<div class="menu-title">Menu Utama</div>
<a href="<?= BASE_URL ?>/" class="nav-item-link <?= isActive('/', $current) ?>">
  <i class="bi bi-grid-1x2-fill"></i>
  <span>Dashboard</span>
</a>
<a href="<?= BASE_URL ?>/buku" class="nav-item-link <?= isActive('/buku', $current) ?>">
  <i class="bi bi-book"></i>
  <span>Data Buku</span>
</a>
<a href="<?= BASE_URL ?>/peminjaman" class="nav-item-link <?= isActive('/peminjaman', $current) ?>">
  <i class="bi bi-journal-arrow-up"></i>
  <span>Peminjaman</span>
</a>
<a href="<?= BASE_URL ?>/pengembalian" class="nav-item-link <?= isActive('/pengembalian', $current) ?>">
  <i class="bi bi-arrow-return-left"></i>
  <span>Pengembalian</span>
</a>
<a href="<?= BASE_URL ?>/anggota" class="nav-item-link <?= isActive('/anggota', $current) ?>">
  <i class="bi bi-people"></i>
  <span>Data Anggota</span>
</a>

<div class="menu-title">Informasi &amp; Rekap</div>
<a href="<?= BASE_URL ?>/laporan" class="nav-item-link <?= isActive('/laporan', $current) ?>">
  <i class="bi bi-file-earmark-bar-graph"></i>
  <span>Laporan Transaksi</span>
</a>
