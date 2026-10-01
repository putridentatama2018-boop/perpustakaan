<div class="hero-banner">
  <div class="hero-content">
    <div class="hero-text">
      <div class="hero-badge">
        <i class="bi bi-stars"></i> Perpustakaan Pintar Kampus
      </div>
      <h2>Selamat Datang, Admin! 👋</h2>
      <p>Kelola sirkulasi buku, monitor peminjaman mahasiswa, dan pantau stok inventaris perpustakaan secara real-time.</p>
    </div>

    <div class="hero-actions">
      <a href="<?= BASE_URL ?>/peminjaman" class="btn btn-white shadow-sm">
        <i class="bi bi-journal-plus text-primary"></i> Peminjaman Baru
      </a>
      <a href="<?= BASE_URL ?>/buku/create" class="btn btn-outline-light">
        <i class="bi bi-plus-lg"></i> Tambah Buku
      </a>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-6 col-xl-3">
    <div class="stat-card stat-theme-indigo">
      <div class="stat-header">
        <div>
          <div class="stat-label">Total Judul Buku</div>
          <div class="stat-value"><?= number_format((int)$totalBuku) ?></div>
        </div>
        <div class="stat-icon-wrapper">
          <i class="bi bi-book-half"></i>
        </div>
      </div>
      <div class="stat-footer text-primary">
        <i class="bi bi-collection"></i> Terdaftar di Katalog
      </div>
    </div>
  </div>

  <div class="col-6 col-xl-3">
    <div class="stat-card stat-theme-emerald">
      <div class="stat-header">
        <div>
          <div class="stat-label">Total Stok Fisik</div>
          <div class="stat-value"><?= number_format((int)$totalStok) ?></div>
        </div>
        <div class="stat-icon-wrapper">
          <i class="bi bi-boxes"></i>
        </div>
      </div>
      <div class="stat-footer text-success">
        <i class="bi bi-check2-circle"></i> Eksemplar Tersedia
      </div>
    </div>
  </div>

  <div class="col-6 col-xl-3">
    <div class="stat-card stat-theme-amber">
      <div class="stat-header">
        <div>
          <div class="stat-label">Sedang Dipinjam</div>
          <div class="stat-value"><?= number_format((int)$totalDipinjam) ?></div>
        </div>
        <div class="stat-icon-wrapper">
          <i class="bi bi-arrow-repeat"></i>
        </div>
      </div>
      <div class="stat-footer text-warning">
        <i class="bi bi-hourglass-split"></i> Sirkulasi Aktif
      </div>
    </div>
  </div>

  <div class="col-6 col-xl-3">
    <div class="stat-card stat-theme-rose">
      <div class="stat-header">
        <div>
          <div class="stat-label">Stok Habis</div>
          <div class="stat-value"><?= number_format((int)$totalHabis) ?></div>
        </div>
        <div class="stat-icon-wrapper">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
      </div>
      <div class="stat-footer text-danger">
        <i class="bi bi-bell-fill"></i> Perlu Pengadaan
      </div>
    </div>
  </div>
</div>


<div class="dashboard-grid">
  <div class="dashboard-panel">
    <div class="dashboard-panel-header">
      <div>
        <h3 class="dashboard-panel-title"><i class="bi bi-clock-history text-primary me-2"></i>Aktivitas Peminjaman Terkini</h3>
        <div class="dashboard-panel-subtitle">5 transaksi peminjaman terbaru yang tercatat di sistem</div>
      </div>
      <a href="<?= BASE_URL ?>/peminjaman" class="btn btn-sm btn-outline-primary">
        Lihat Semua <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Peminjam</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($peminjamanTerbaru)): ?>
            <tr>
              <td colspan="6" class="empty-state">
                <i class="bi bi-inbox empty-state-icon"></i>
                <p class="mb-0">Belum ada transaksi peminjaman.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($peminjamanTerbaru as $p): ?>
              <tr data-searchable>
                <td>
                  <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                    <?= htmlspecialchars($p['kode_peminjaman']) ?>
                  </span>
                </td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="avatar-chip" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                      <?= strtoupper(substr($p['nama_anggota'] ?? 'M', 0, 1)) ?>
                    </div>
                    <div>
                      <div class="fw-bold text-dark" style="font-size:0.875rem;"><?= htmlspecialchars($p['nama_anggota']) ?></div>
                      <small class="text-muted font-monospace"><?= htmlspecialchars($p['nim']) ?></small>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="text-truncate fw-semibold" style="max-width: 220px;" title="<?= htmlspecialchars($p['judul_buku']) ?>">
                    <i class="bi bi-book text-muted me-1"></i><?= htmlspecialchars($p['judul_buku']) ?>
                  </div>
                </td>
                <td>
                  <span class="text-secondary" style="font-size:0.825rem;">
                    <?= htmlspecialchars($p['tanggal_pinjam']) ?>
                  </span>
                </td>
                <td>
                  <span class="text-secondary" style="font-size:0.825rem;">
                    <?= htmlspecialchars($p['tanggal_kembali']) ?>
                  </span>
                </td>
                <td>
                  <?php if ($p['status'] === 'dipinjam'): ?>
                    <span class="badge-status badge-status-warning">Dipinjam</span>
                  <?php else: ?>
                    <span class="badge-status badge-status-success">Kembali</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="d-flex flex-column gap-3">
    <div class="dashboard-panel">
      <div class="dashboard-panel-header">
        <div>
          <h3 class="dashboard-panel-title"><i class="bi bi-pie-chart text-primary me-2"></i>Statistik Cepat</h3>
          <div class="dashboard-panel-subtitle">Ringkasan operasional perpustakaan</div>
        </div>
      </div>

      <div class="mini-stat-item">
        <div class="label">
          <i class="bi bi-bookmark-check text-primary fs-5"></i>
          <span>Ketersediaan Buku</span>
        </div>
        <div class="val text-success">
          <?= $totalBuku > 0 ? round((($totalBuku - $totalHabis) / $totalBuku) * 100) : 0 ?>%
        </div>
      </div>

      <div class="mini-stat-item">
        <div class="label">
          <i class="bi bi-person-lines-fill text-indigo fs-5" style="color:var(--primary);"></i>
          <span>Buku Dipinjam</span>
        </div>
        <div class="val text-warning">
          <?= (int)$totalDipinjam ?>
        </div>
      </div>

      <div class="mini-stat-item">
        <div class="label">
          <i class="bi bi-archive text-danger fs-5"></i>
          <span>Judul Stok Kosong</span>
        </div>
        <div class="val text-danger">
          <?= (int)$totalHabis ?>
        </div>
      </div>
    </div>

    <div class="dashboard-panel">
      <h3 class="dashboard-panel-title mb-3"><i class="bi bi-lightning-charge text-amber me-2" style="color:var(--accent-amber);"></i>Akses Cepat</h3>
      <div class="d-grid gap-2">
        <a href="<?= BASE_URL ?>/peminjaman" class="btn btn-outline-primary text-start justify-content-start">
          <i class="bi bi-journal-arrow-up text-primary fs-6"></i> Transaksi Peminjaman
        </a>
        <a href="<?= BASE_URL ?>/pengembalian" class="btn btn-outline-primary text-start justify-content-start">
          <i class="bi bi-arrow-return-left text-success fs-6"></i> Proses Pengembalian Buku
        </a>
        <a href="<?= BASE_URL ?>/buku/create" class="btn btn-outline-primary text-start justify-content-start">
          <i class="bi bi-plus-square text-info fs-6"></i> Input Buku Baru
        </a>
        <a href="<?= BASE_URL ?>/anggota/create" class="btn btn-outline-primary text-start justify-content-start">
          <i class="bi bi-person-plus text-purple fs-6" style="color:var(--accent-purple);"></i> Daftarkan Anggota Baru
        </a>
      </div>
    </div>
  </div>
</div>
