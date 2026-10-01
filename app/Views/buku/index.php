<div class="page-heading">
  <div>
    <h1><i class="bi bi-book-half text-primary me-2"></i>Katalog &amp; Data Buku</h1>
    <p>Kelola seluruh koleksi buku perpustakaan kampus, stok inventaris, dan status ketersediaan.</p>
  </div>
  <div class="page-heading-actions">
    <a href="<?= BASE_URL ?>/buku/create" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Tambah Buku Baru
    </a>
  </div>
</div>

<div class="card">
  <!-- Table Toolbar -->
  <div class="table-toolbar">
    <div class="d-flex align-items-center gap-3 flex-wrap">
      <div class="table-toolbar-title">
        <i class="bi bi-collection text-primary"></i> Daftar Koleksi
      </div>
      <!-- Filter Tabs -->
      <div class="filter-tabs">
        <button type="button" class="filter-tab active" onclick="setBookFilter('all', this)">Semua (<?= count($daftarBuku) ?>)</button>
        <button type="button" class="filter-tab" onclick="setBookFilter('tersedia', this)">Tersedia</button>
        <button type="button" class="filter-tab" onclick="setBookFilter('habis', this)">Habis</button>
      </div>
    </div>

    <div class="table-search-input">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input type="search" id="bookSearchInput" class="form-control border-start-0" placeholder="Cari judul, penulis, kode..." oninput="filterBookTable()">
      </div>
    </div>
  </div>

  <!-- Books Table -->
  <div class="table-responsive">
    <table id="bookTable" class="table align-middle">
      <thead>
        <tr>
          <th style="width: 60px;">No</th>
          <th>ID Buku</th>
          <th>Judul Buku</th>
          <th>Penulis</th>
          <th>Penerbit</th>
          <th>Tahun</th>
          <th>Stok</th>
          <th>Status</th>
          <th class="text-center" style="width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarBuku)): ?>
          <tr>
            <td colspan="9" class="empty-state">
              <i class="bi bi-journal-x empty-state-icon"></i>
              <h5>Belum Ada Data Buku</h5>
              <p class="text-muted">Koleksi buku masih kosong. Silakan tambahkan buku baru ke perpustakaan.</p>
              <a href="<?= BASE_URL ?>/buku/create" class="btn btn-sm btn-primary mt-2">
                <i class="bi bi-plus-lg"></i> Tambah Buku Pertama
              </a>
            </td>
          </tr>
        <?php else: ?>
          <?php $no = 1; foreach ($daftarBuku as $buku): ?>
            <tr data-searchable data-status="<?= htmlspecialchars($buku['status']) ?>">
              <td class="text-muted font-monospace"><?= $no++ ?></td>
              <td>
                <span class="badge bg-light text-primary border font-monospace px-2 py-1">
                  <?= htmlspecialchars($buku['kode_buku']) ?>
                </span>
              </td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <div class="book-avatar">
                    <i class="bi bi-book"></i>
                  </div>
                  <div>
                    <div class="fw-bold text-dark" style="font-size: 0.925rem;">
                      <a href="<?= BASE_URL ?>/buku/detail?id=<?= (int)$buku['id'] ?>" class="text-dark text-decoration-none hover-primary">
                        <?= htmlspecialchars($buku['judul']) ?>
                      </a>
                    </div>
                    <small class="text-muted"><i class="bi bi-person me-1"></i><?= htmlspecialchars($buku['penulis']) ?></small>
                  </div>
                </div>
              </td>
              <td>
                <span class="text-secondary"><?= htmlspecialchars($buku['penulis']) ?></span>
              </td>
              <td>
                <span class="text-secondary"><?= htmlspecialchars($buku['penerbit']) ?></span>
              </td>
              <td>
                <span class="badge bg-secondary-subtle text-secondary-emphasis font-monospace">
                  <?= htmlspecialchars($buku['tahun_terbit']) ?>
                </span>
              </td>
              <td>
                <span class="fw-bold <?= (int)$buku['stok'] > 0 ? 'text-dark' : 'text-danger' ?>">
                  <?= (int)$buku['stok'] ?> <small class="text-muted fw-normal">eks</small>
                </span>
              </td>
              <td>
                <?php if ($buku['status'] === 'tersedia'): ?>
                  <span class="badge-status badge-status-success">Tersedia</span>
                <?php else: ?>
                  <span class="badge-status badge-status-danger">Habis</span>
                <?php endif; ?>
              </td>
              <td class="text-center">
                <div class="action-group">
                  <a href="<?= BASE_URL ?>/buku/detail?id=<?= (int)$buku['id'] ?>" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                    <i class="bi bi-eye-fill"></i>
                  </a>
                  <a href="<?= BASE_URL ?>/buku/edit?id=<?= (int)$buku['id'] ?>" class="btn btn-sm btn-warning" title="Edit Buku">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form action="<?= BASE_URL ?>/buku/delete" method="POST" class="d-inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku <?= htmlspecialchars(addslashes($buku['judul'])) ?>?');">
                    <input type="hidden" name="id" value="<?= (int)$buku['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Buku">
                      <i class="bi bi-trash3-fill"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="table-footer">
    <span><i class="bi bi-info-circle me-1"></i> Menampilkan <?= count($daftarBuku) ?> koleksi buku di sistem</span>
    <span class="text-muted">Gunakan kolom pencarian atau filter status untuk navigasi cepat</span>
  </div>
</div>

<script>
let currentFilter = 'all';

function setBookFilter(filter, el) {
  currentFilter = filter;
  document.querySelectorAll('.filter-tab').forEach(tab => tab.classList.remove('active'));
  el.classList.add('active');
  filterBookTable();
}

function filterBookTable() {
  const q = (document.getElementById('bookSearchInput')?.value || '').toLowerCase().trim();
  const rows = document.querySelectorAll('#bookTable tbody tr[data-searchable]');
  
  rows.forEach(row => {
    const status = row.getAttribute('data-status');
    const textMatch = row.innerText.toLowerCase().includes(q);
    const filterMatch = (currentFilter === 'all') || (status === currentFilter);
    
    row.style.display = (textMatch && filterMatch) ? '' : 'none';
  });
}
</script>
