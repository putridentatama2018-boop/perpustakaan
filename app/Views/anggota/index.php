<div class="page-heading">
  <div>
    <h1><i class="bi bi-people-fill text-primary me-2"></i>Data Anggota Perpustakaan</h1>
    <p>Daftar mahasiswa yang terdaftar aktif dan berhak melakukan transaksi peminjaman buku.</p>
  </div>
  <div class="page-heading-actions">
    <a href="<?= BASE_URL ?>/anggota/create" class="btn btn-primary">
      <i class="bi bi-person-plus-fill"></i> Tambah Anggota Baru
    </a>
  </div>
</div>

<div class="card">
  <div class="table-toolbar">
    <div class="table-toolbar-title">
      <i class="bi bi-person-lines-fill text-primary"></i> Direktori Mahasiswa
    </div>
    <div class="table-search-input">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input class="form-control border-start-0" type="search" id="memberSearchInput" placeholder="Cari NIM atau nama mahasiswa..." oninput="filterMemberTable(this)">
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle" id="memberTable">
      <thead>
        <tr>
          <th style="width: 50px;">No</th>
          <th>NIM Mahasiswa</th>
          <th>Nama Lengkap</th>
          <th>Status Keanggotaan</th>
          <th>Tanggal Registrasi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarAnggota)): ?>
          <tr>
            <td colspan="5" class="empty-state">
              <i class="bi bi-people empty-state-icon"></i>
              <h5>Belum Ada Data Anggota</h5>
              <p class="text-muted">Silakan daftarkan mahasiswa baru agar dapat melakukan peminjaman buku.</p>
              <a href="<?= BASE_URL ?>/anggota/create" class="btn btn-sm btn-primary mt-2">
                <i class="bi bi-plus-lg"></i> Tambah Anggota Sekarang
              </a>
            </td>
          </tr>
        <?php else: ?>
          <?php 
          $colors = [
            'linear-gradient(135deg, #6366f1, #8b5cf6)',
            'linear-gradient(135deg, #ec4899, #f43f5e)',
            'linear-gradient(135deg, #10b981, #059669)',
            'linear-gradient(135deg, #f59e0b, #d97706)',
            'linear-gradient(135deg, #0ea5e9, #0284c7)'
          ];
          $no = 1; 
          foreach ($daftarAnggota as $idx => $a): 
            $color = $colors[$idx % count($colors)];
          ?>
            <tr data-searchable>
              <td class="text-muted font-monospace"><?= $no++ ?></td>
              <td>
                <span class="badge bg-light text-primary border font-monospace px-2 py-1">
                  <?= htmlspecialchars($a['nim']) ?>
                </span>
              </td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <div class="avatar-chip" style="background: <?= $color ?>;">
                    <?= strtoupper(substr($a['nama'] ?? 'M', 0, 1)) ?>
                  </div>
                  <div>
                    <div class="fw-bold text-dark" style="font-size: 0.925rem;">
                      <?= htmlspecialchars($a['nama']) ?>
                    </div>
                    <small class="text-muted"><i class="bi bi-mortarboard me-1"></i>Mahasiswa Aktif</small>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge-status badge-status-success">Aktif</span>
              </td>
              <td>
                <span class="text-secondary" style="font-size: 0.85rem;">
                  <i class="bi bi-calendar3 me-1 text-muted"></i><?= htmlspecialchars($a['created_at'] ?? '-') ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="table-footer">
    <span><i class="bi bi-info-circle me-1"></i> Total <?= count($daftarAnggota) ?> mahasiswa terdaftar sebagai anggota</span>
    <span class="text-muted">Keanggotaan aktif dapat meminjam hingga maksimal 3 buku bersamaan</span>
  </div>
</div>

<script>
function filterMemberTable(input) {
  const q = input.value.toLowerCase().trim();
  document.querySelectorAll('#memberTable tbody tr[data-searchable]').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
