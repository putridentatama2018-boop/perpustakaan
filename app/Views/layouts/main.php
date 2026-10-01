<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Perpustakaan Kampus') ?> - Sistem Informasi Perpustakaan</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  

  <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar(false)"></div>

<div class="app-shell">
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="brand-icon">
        <i class="bi bi-book-half"></i>
      </div>
      <div>
        <div class="brand-title">Perpustakaan</div>
        <span class="brand-subtitle">Kampus Utama</span>
      </div>
    </div>

    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <div class="sidebar-footer">
      <div class="sidebar-footer-card">
        <div class="title"><i class="bi bi-shield-check text-primary"></i> SIP v2.0 Active</div>
        <div class="desc">Sistem Peminjaman &amp; Inventaris Buku Terintegrasi</div>
      </div>
    </div>
  </aside>

  <div class="main-area">
    <header class="topbar">
      <div class="d-flex align-items-center gap-3">
        <button type="button" class="mobile-sidebar-toggle" onclick="toggleSidebar(true)" aria-label="Menu">
          <i class="bi bi-list"></i>
        </button>
        
        <div class="topbar-search">
          <i class="bi bi-search search-icon"></i>
          <input class="form-control" id="globalSearch" type="search" placeholder="Cari buku, anggota, kode transaksi..." autocomplete="off">
          <span class="search-shortcut">Ctrl K</span>
        </div>
      </div>

      <div class="topbar-actions">
        <div class="d-none d-md-flex align-items-center gap-2 text-muted px-2" style="font-size:0.8rem; font-weight:600;">
          <i class="bi bi-calendar3 text-primary"></i>
          <span id="currentDateDisplay"><?= date('d M Y') ?></span>
        </div>

        <a href="<?= BASE_URL ?>/peminjaman" class="btn btn-sm btn-primary d-none d-sm-inline-flex" title="Buat Peminjaman Cepat">
          <i class="bi bi-plus-circle-fill"></i>
          <span>Pinjam Cepat</span>
        </a>

        <div class="profile-pill">
          <div class="profile-avatar">
            <i class="bi bi-person-fill"></i>
          </div>
          <div class="profile-info d-none d-sm-block">
            <span class="name">Administrator</span>
            <span class="role">Petugas Perpus</span>
          </div>
        </div>
      </div>
    </header>

    <main class="page-content fade-in">
      <?php require __DIR__ . '/../partials/alert.php'; ?>
      <?= $content ?>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

function toggleSidebar(show) {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  if (show) {
    sidebar.classList.add('show');
    overlay.classList.add('show');
  } else {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
  }
}

(function(){
  const input = document.getElementById('globalSearch');
  if (!input) return;

  window.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
      e.preventDefault();
      input.focus();
      input.select();
    }
  });

  input.addEventListener('input', function(){
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('[data-searchable]').forEach(function(row){
      row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
  });
})();
</script>
</body>
</html>
