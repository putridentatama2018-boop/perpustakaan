<div class="page-heading">
  <div>
    <h1><i class="bi bi-file-earmark-bar-graph-fill text-primary me-2"></i>Laporan &amp; Rekapitulasi Perpustakaan</h1>
    <p>Ringkasan menyeluruh mengenai kondisi inventaris koleksi buku dan riwayat sirkulasi peminjaman.</p>
  </div>
  <div class="page-heading-actions">
    <button type="button" class="btn btn-outline-primary" onclick="window.print()">
      <i class="bi bi-printer-fill"></i> Cetak Laporan
    </button>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
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
        <i class="bi bi-collection"></i> Katalog Koleksi
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3">
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
        <i class="bi bi-check2-circle"></i> Seluruh Eksemplar
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3">
    <div class="stat-card stat-theme-amber">
      <div class="stat-header">
        <div>
          <div class="stat-label">Sedang Dipinjam</div>
          <div class="stat-value"><?= number_format((int)$totalDipinjam) ?></div>
        </div>
        <div class="stat-icon-wrapper">
          <i class="bi bi-hourglass-split"></i>
        </div>
      </div>
      <div class="stat-footer text-warning">
        <i class="bi bi-arrow-repeat"></i> Sirkulasi Aktif
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3">
    <div class="stat-card stat-theme-indigo">
      <div class="stat-header">
        <div>
          <div class="stat-label">Sudah Dikembalikan</div>
          <div class="stat-value"><?= number_format((int)$totalKembali) ?></div>
        </div>
        <div class="stat-icon-wrapper">
          <i class="bi bi-patch-check-fill"></i>
        </div>
      </div>
      <div class="stat-footer text-success">
        <i class="bi bi-check-all"></i> Transaksi Tuntas
      </div>
    </div>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">
    <i class="bi bi-pie-chart-fill text-primary me-2"></i>
    <span>Tingkat Perputaran Sirkulasi Buku</span>
  </div>
  <div class="card-body">
    <?php 
      $totalTx = $totalDipinjam + $totalKembali;
      $pctKembali = $totalTx > 0 ? round(($totalKembali / $totalTx) * 100) : 100;
      $pctDipinjam = $totalTx > 0 ? (100 - $pctKembali) : 0;
    ?>
    <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:0.85rem;">
      <span class="fw-bold text-dark">Rasio Pengembalian Transaksi: <?= $pctKembali ?>%</span>
      <span class="text-muted"><?= $totalTx ?> Total Transaksi</span>
    </div>
    <div class="progress" style="height: 12px; border-radius: 999px; background: #e2e8f0;">
      <div class="progress-bar bg-success" role="progressbar" style="width: <?= $pctKembali ?>%;" title="Sudah Dikembalikan (<?= $pctKembali ?>%)"></div>
      <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $pctDipinjam ?>%;" title="Sedang Dipinjam (<?= $pctDipinjam ?>%)"></div>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 0.775rem;">
      <span class="text-success fw-semibold"><i class="bi bi-circle-fill me-1" style="font-size:0.6rem;"></i> Selesai Kembali (<?= (int)$totalKembali ?>)</span>
      <span class="text-warning fw-semibold"><i class="bi bi-circle-fill me-1" style="font-size:0.6rem;"></i> Masih Dipinjam (<?= (int)$totalDipinjam ?>)</span>
    </div>
  </div>
</div>

<div class="card">
  <div class="table-toolbar">
    <div class="d-flex align-items-center gap-3 flex-wrap">
      <div class="table-toolbar-title">
        <i class="bi bi-journal-text text-primary"></i> Seluruh Riwayat Transaksi
      </div>
      <div class="filter-tabs">
        <button type="button" class="filter-tab active" onclick="setReportFilter('all', this)">Semua (<?= count($daftarPeminjaman) ?>)</button>
        <button type="button" class="filter-tab" onclick="setReportFilter('dipinjam', this)">Dipinjam</button>
        <button type="button" class="filter-tab" onclick="setReportFilter('kembali', this)">Kembali</button>
      </div>
    </div>

    <div class="table-search-input">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input class="form-control border-start-0" type="search" id="reportSearchInput" placeholder="Cari data transaksi..." oninput="filterReportTable()">
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle" id="reportTable">
      <thead>
        <tr>
          <th style="width: 50px;">No</th>
          <th>Kode Transaksi</th>
          <th>Mahasiswa</th>
          <th>Judul Buku</th>
          <th>Tgl Pinjam</th>
          <th>Tgl Kembali</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarPeminjaman)): ?>
          <tr>
            <td colspan="7" class="empty-state">
              <i class="bi bi-inbox empty-state-icon"></i>
              <h5>Belum Ada Riwayat Transaksi</h5>
              <p class="text-muted">Data transaksi akan muncul di sini setelah ada peminjaman.</p>
            </td>
          </tr>
        <?php else: ?>
          <?php $no = 1; foreach ($daftarPeminjaman as $p): ?>
            <tr data-searchable data-status="<?= htmlspecialchars($p['status']) ?>">
              <td class="text-muted font-monospace"><?= $no++ ?></td>
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
                    <div class="fw-bold text-dark"><?= htmlspecialchars($p['nama_anggota']) ?></div>
                    <small class="text-muted font-monospace"><?= htmlspecialchars($p['nim']) ?></small>
                  </div>
                </div>
              </td>
              <td>
                <div class="fw-semibold text-dark" style="max-width: 250px;">
                  <i class="bi bi-book text-muted me-1"></i><?= htmlspecialchars($p['judul_buku']) ?>
                </div>
              </td>
              <td>
                <span class="text-secondary" style="font-size:0.85rem;">
                  <?= htmlspecialchars($p['tanggal_pinjam']) ?>
                </span>
              </td>
              <td>
                <span class="text-secondary" style="font-size:0.85rem;">
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

  <div class="table-footer">
    <span><i class="bi bi-info-circle me-1"></i> Dicetak otomatis oleh Sistem Informasi Perpustakaan Kampus</span>
    <span class="text-muted"><?= date('d F Y, H:i') ?> WIB</span>
  </div>
</div>

<script>
let currentReportFilter = 'all';

function setReportFilter(filter, el) {
  currentReportFilter = filter;
  document.querySelectorAll('.filter-tab').forEach(tab => tab.classList.remove('active'));
  el.classList.add('active');
  filterReportTable();
}

function filterReportTable() {
  const q = (document.getElementById('reportSearchInput')?.value || '').toLowerCase().trim();
  const rows = document.querySelectorAll('#reportTable tbody tr[data-searchable]');
  
  rows.forEach(row => {
    const status = row.getAttribute('data-status');
    const textMatch = row.innerText.toLowerCase().includes(q);
    const filterMatch = (currentReportFilter === 'all') || (status === currentReportFilter);
    
    row.style.display = (textMatch && filterMatch) ? '' : 'none';
  });
}
</script>
