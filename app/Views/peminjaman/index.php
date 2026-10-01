<div class="page-heading">
  <div>
    <h1><i class="bi bi-journal-arrow-up text-primary me-2"></i>Transaksi Peminjaman Buku</h1>
    <p>Kelola peminjaman buku mahasiswa, pastikan validasi ketersediaan stok &amp; batas maksimal pinjam.</p>
  </div>
  <div class="page-heading-actions">
    <a href="#form-peminjaman" class="btn btn-primary">
      <i class="bi bi-plus-circle-fill"></i> Pinjam Buku Baru
    </a>
  </div>
</div>


<div class="card mb-4" id="form-peminjaman">
  <div class="card-header">
    <div class="d-flex align-items-center gap-2">
      <i class="bi bi-plus-square-fill text-primary"></i>
      <span class="fw-bold">Formulir Peminjaman Baru</span>
    </div>
    <span class="badge bg-primary-subtle text-primary">
      <i class="bi bi-info-circle me-1"></i> Maks. 3 Buku Aktif per Mahasiswa
    </span>
  </div>
  <div class="card-body">
    <form action="<?= BASE_URL ?>/peminjaman/store" method="POST" novalidate id="loanForm">
      <div class="row g-3">

        <div class="col-md-4">
          <label class="form-label">
            <i class="bi bi-person-badge text-muted"></i> NIM Mahasiswa <span class="text-danger">*</span>
          </label>
          <div class="input-icon-group">
            <i class="bi bi-person-badge input-icon"></i>
            <input type="text" name="nim" list="daftar-nim" id="inputNIM" class="form-control font-monospace <?= $this->errors('nim') ? 'is-invalid' : '' ?>" 
                   value="<?= htmlspecialchars($this->old('nim')) ?>" placeholder="Ketik atau pilih NIM..." autocomplete="off">
          </div>
          <datalist id="daftar-nim">
            <?php foreach ($daftarAnggota as $a): ?>
              <option value="<?= htmlspecialchars($a['nim']) ?>"><?= htmlspecialchars($a['nama']) ?></option>
            <?php endforeach; ?>
          </datalist>
          <?php if ($this->errors('nim')): ?>
            <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('nim')) ?></div>
          <?php else: ?>
            <small class="text-muted" style="font-size:0.75rem;">Pilih anggota yang sudah terdaftar di sistem.</small>
          <?php endif; ?>
        </div>


        <div class="col-md-4">
          <label class="form-label">
            <i class="bi bi-book text-muted"></i> Pilih Judul Buku <span class="text-danger">*</span>
          </label>
          <div class="input-icon-group">
            <i class="bi bi-book input-icon"></i>
            <select name="id_buku" class="form-select <?= $this->errors('id_buku') ? 'is-invalid' : '' ?>">
              <option value="">-- Pilih Buku yang Tersedia --</option>
              <?php foreach ($daftarBuku as $b): ?>
                <option value="<?= (int)$b['id'] ?>" 
                  <?= (string)$this->old('id_buku') === (string)$b['id'] ? 'selected' : '' ?> 
                  <?= (int)$b['stok'] <= 0 ? 'disabled' : '' ?>>
                  <?= htmlspecialchars($b['kode_buku'] . ' - ' . $b['judul']) ?> (Stok: <?= (int)$b['stok'] ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php if ($this->errors('id_buku')): ?>
            <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('id_buku')) ?></div>
          <?php else: ?>
            <small class="text-muted" style="font-size:0.75rem;">Buku bersisa stok 0 tidak dapat dipilih.</small>
          <?php endif; ?>
        </div>


        <div class="col-md-2">
          <label class="form-label">
            <i class="bi bi-calendar-event text-muted"></i> Tgl Pinjam <span class="text-danger">*</span>
          </label>
          <input type="date" name="tanggal_pinjam" id="inputTglPinjam" class="form-control <?= $this->errors('tanggal_pinjam') ? 'is-invalid' : '' ?>" 
                 value="<?= htmlspecialchars($this->old('tanggal_pinjam', date('Y-m-d'))) ?>">
          <?php if ($this->errors('tanggal_pinjam')): ?>
            <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('tanggal_pinjam')) ?></div>
          <?php endif; ?>
        </div>


        <div class="col-md-2">
          <label class="form-label">
            <i class="bi bi-calendar-check text-muted"></i> Batas Kembali <span class="text-danger">*</span>
          </label>
          <input type="date" name="tanggal_kembali" id="inputTglKembali" class="form-control <?= $this->errors('tanggal_kembali') ? 'is-invalid' : '' ?>" 
                 value="<?= htmlspecialchars($this->old('tanggal_kembali', date('Y-m-d', strtotime('+7 days')))) ?>">
          <?php if ($this->errors('tanggal_kembali')): ?>
            <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('tanggal_kembali')) ?></div>
          <?php endif; ?>
        </div>


        <div class="col-12 pt-2 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
          <div class="d-flex align-items-center gap-2">
            <span class="text-muted" style="font-size: 0.775rem;">Pilihan Durasi Cepat:</span>
            <button type="button" class="btn btn-sm btn-secondary" onclick="setReturnDays(3)">+3 Hari</button>
            <button type="button" class="btn btn-sm btn-secondary" onclick="setReturnDays(7)">+7 Hari (Standar)</button>
            <button type="button" class="btn btn-sm btn-secondary" onclick="setReturnDays(14)">+14 Hari</button>
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check2-circle"></i> Proses Peminjaman
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="table-toolbar">
    <div class="d-flex align-items-center gap-3 flex-wrap">
      <div class="table-toolbar-title">
        <i class="bi bi-clock-history text-primary"></i> Riwayat &amp; Status Transaksi
      </div>
      <div class="filter-tabs">
        <button type="button" class="filter-tab active" onclick="setLoanFilter('all', this)">Semua (<?= count($daftarPeminjaman) ?>)</button>
        <button type="button" class="filter-tab" onclick="setLoanFilter('dipinjam', this)">Sedang Dipinjam</button>
        <button type="button" class="filter-tab" onclick="setLoanFilter('kembali', this)">Sudah Kembali</button>
      </div>
    </div>

    <div class="table-search-input">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input type="search" id="loanSearchInput" class="form-control border-start-0" placeholder="Cari kode, nama, buku..." oninput="filterLoanTable()">
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table id="loanTable" class="table align-middle">
      <thead>
        <tr>
          <th style="width: 50px;">No</th>
          <th>Kode Transaksi</th>
          <th>Mahasiswa Peminjam</th>
          <th>Judul Buku</th>
          <th>Tgl Pinjam</th>
          <th>Batas Kembali</th>
          <th>Status</th>
          <th class="text-center" style="width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarPeminjaman)): ?>
          <tr>
            <td colspan="8" class="empty-state">
              <i class="bi bi-journal-x empty-state-icon"></i>
              <h5>Belum Ada Transaksi Peminjaman</h5>
              <p class="text-muted">Gunakan form di atas untuk membuat transaksi peminjaman pertama.</p>
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
                <span class="text-secondary" style="font-size: 0.85rem;">
                  <?= htmlspecialchars($p['tanggal_pinjam']) ?>
                </span>
              </td>
              <td>
                <span class="text-secondary" style="font-size: 0.85rem;">
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
              <td class="text-center">
                <?php if ($p['status'] === 'dipinjam'): ?>
                  <form action="<?= BASE_URL ?>/peminjaman/kembalikan" method="POST" class="d-inline m-0" onsubmit="return confirm('Tandai transaksi <?= htmlspecialchars($p['kode_peminjaman']) ?> sudah dikembalikan?');">
                    <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-success shadow-sm" title="Proses Pengembalian">
                      <i class="bi bi-arrow-return-left"></i> Kembalikan
                    </button>
                  </form>
                <?php else: ?>
                  <span class="badge bg-light text-muted border"><i class="bi bi-check-all text-success me-1"></i> Selesai</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="table-footer">
    <span><i class="bi bi-info-circle me-1"></i> Total <?= count($daftarPeminjaman) ?> catatan transaksi terdata</span>
    <a href="<?= BASE_URL ?>/pengembalian" class="btn btn-sm btn-outline-primary">
      Kelola Pengembalian Khusus <i class="bi bi-arrow-right"></i>
    </a>
  </div>
</div>

<script>
let currentLoanFilter = 'all';

function setLoanFilter(filter, el) {
  currentLoanFilter = filter;
  document.querySelectorAll('.filter-tab').forEach(tab => tab.classList.remove('active'));
  el.classList.add('active');
  filterLoanTable();
}

function filterLoanTable() {
  const q = (document.getElementById('loanSearchInput')?.value || '').toLowerCase().trim();
  const rows = document.querySelectorAll('#loanTable tbody tr[data-searchable]');
  
  rows.forEach(row => {
    const status = row.getAttribute('data-status');
    const textMatch = row.innerText.toLowerCase().includes(q);
    const filterMatch = (currentLoanFilter === 'all') || (status === currentLoanFilter);
    
    row.style.display = (textMatch && filterMatch) ? '' : 'none';
  });
}

function setReturnDays(days) {
  const pinjamInput = document.getElementById('inputTglPinjam');
  const kembaliInput = document.getElementById('inputTglKembali');
  if (!pinjamInput || !kembaliInput) return;

  const pinjamDate = pinjamInput.value ? new Date(pinjamInput.value) : new Date();
  pinjamDate.setDate(pinjamDate.getDate() + days);
  
  const yyyy = pinjamDate.getFullYear();
  const mm = String(pinjamDate.getMonth() + 1).padStart(2, '0');
  const dd = String(pinjamDate.getDate()).padStart(2, '0');
  kembaliInput.value = `${yyyy}-${mm}-${dd}`;
}
</script>
