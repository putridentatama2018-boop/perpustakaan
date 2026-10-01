<div class="page-heading">
  <div>
    <h1><i class="bi bi-arrow-return-left text-success me-2"></i>Pengembalian Buku</h1>
    <p>Daftar sirkulasi peminjaman yang sedang aktif dan siap diproses pengembaliannya.</p>
  </div>
  <div class="page-heading-actions">
    <span class="badge bg-warning-subtle text-warning-emphasis fs-6 px-3 py-2 border border-warning-subtle">
      <i class="bi bi-hourglass-split me-1"></i> <?= count($daftarPengembalian) ?> Peminjaman Aktif
    </span>
  </div>
</div>

<div class="card">
  <div class="table-toolbar">
    <div class="table-toolbar-title">
      <i class="bi bi-check2-circle text-success"></i> Antrean Pengembalian Buku
    </div>
    <div class="table-search-input">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input class="form-control border-start-0" type="search" placeholder="Cari transaksi, NIM, buku..." oninput="filterReturnTable(this)">
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle" id="returnTable">
      <thead>
        <tr>
          <th style="width: 50px;">No</th>
          <th>Kode Transaksi</th>
          <th>Mahasiswa Peminjam</th>
          <th>Judul Buku</th>
          <th>Tgl Pinjam</th>
          <th>Batas Kembali</th>
          <th>Status Waktu</th>
          <th class="text-center" style="width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarPengembalian)): ?>
          <tr>
            <td colspan="8" class="empty-state">
              <i class="bi bi-emoji-smile empty-state-icon text-success"></i>
              <h5 class="text-dark">Tidak Ada Peminjaman Aktif</h5>
              <p class="text-muted mb-0">Semua buku telah dikembalikan dengan lengkap ke perpustakaan.</p>
            </td>
          </tr>
        <?php else: ?>
          <?php $no = 1; foreach ($daftarPengembalian as $p): 
            $today = new DateTime();
            $due = new DateTime($p['tanggal_kembali']);
            $diffDays = (int)$today->diff($due)->format("%r%a");
          ?>
            <tr data-searchable>
              <td class="text-muted font-monospace"><?= $no++ ?></td>
              <td>
                <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                  <?= htmlspecialchars($p['kode_peminjaman']) ?>
                </span>
              </td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar-chip" style="background: linear-gradient(135deg, #10b981, #059669);">
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
                <?php if ($diffDays < 0): ?>
                  <span class="badge-status badge-status-danger" title="Terlambat <?= abs($diffDays) ?> hari">
                    Terlambat <?= abs($diffDays) ?> hari
                  </span>
                <?php elseif ($diffDays === 0): ?>
                  <span class="badge-status badge-status-warning">
                    Jatuh tempo hari ini
                  </span>
                <?php else: ?>
                  <span class="badge-status badge-status-info">
                    Sisa <?= $diffDays ?> hari
                  </span>
                <?php endif; ?>
              </td>
              <td class="text-center">
                <form action="<?= BASE_URL ?>/pengembalian/store" method="POST" class="m-0" onsubmit="return confirm('Proses pengembalian buku <?= htmlspecialchars(addslashes($p['judul_buku'])) ?> oleh <?= htmlspecialchars(addslashes($p['nama_anggota'])) ?>?');">
                  <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-success shadow-sm">
                    <i class="bi bi-check2-circle"></i> Selesai
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="table-footer">
    <span><i class="bi bi-info-circle me-1"></i> Menampilkan <?= count($daftarPengembalian) ?> transaksi yang perlu dikembalikan</span>
    <span class="text-muted">Proses pengembalian akan otomatis merestorasi stok fisik buku</span>
  </div>
</div>

<script>
function filterReturnTable(input) {
  const q = input.value.toLowerCase().trim();
  document.querySelectorAll('#returnTable tbody tr[data-searchable]').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
