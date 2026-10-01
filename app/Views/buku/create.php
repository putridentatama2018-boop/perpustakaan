<div class="page-heading">
  <div>
    <h1>
      <i class="bi bi-journal-plus text-primary me-2"></i>
      Tambah Buku Baru
    </h1>
    <p>Daftarkan judul buku baru ke dalam katalog perpustakaan kampus.</p>
  </div>
  <div class="page-heading-actions">
    <a href="<?= BASE_URL ?>/buku" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Kembali ke Katalog
    </a>
  </div>
</div>

<div class="row g-4">

  <div class="col-lg-7">
    <div class="card">
      <div class="card-header">
        <span><i class="bi bi-pencil-square text-primary me-2"></i>Formulir Data Buku</span>
        <span class="badge bg-primary-subtle text-primary">Informasi Pokok</span>
      </div>
      <div class="card-body">
        <form action="<?= BASE_URL ?>/buku/store" method="POST" novalidate id="bookForm">

          <div class="mb-3">
            <label class="form-label" for="inputKode">
              <i class="bi bi-upc-scan text-muted"></i> ID / Kode Buku <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
              <i class="bi bi-upc-scan input-icon"></i>
              <input 
                type="text" 
                name="kode_buku" 
                id="inputKode" 
                class="form-control font-monospace <?= $this->errors('kode_buku') ? 'is-invalid' : '' ?>"
                value="<?= htmlspecialchars($this->old('kode_buku')) ?>" 
                placeholder="Contoh: BK006" 
                autocomplete="off"
              >
            </div>
            <?php if ($this->errors('kode_buku')): ?>
              <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('kode_buku')) ?></div>
            <?php else: ?>
              <small class="text-muted" style="font-size: 0.75rem;">Gunakan format kode unik seperti BK001, BK002, dll.</small>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label class="form-label" for="inputJudul">
              <i class="bi bi-book text-muted"></i> Judul Buku <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
              <i class="bi bi-book input-icon"></i>
              <input 
                type="text" 
                name="judul" 
                id="inputJudul" 
                class="form-control <?= $this->errors('judul') ? 'is-invalid' : '' ?>"
                value="<?= htmlspecialchars($this->old('judul')) ?>" 
                placeholder="Masukkan judul buku lengkap"
              >
            </div>
            <?php if ($this->errors('judul')): ?>
              <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('judul')) ?></div>
            <?php endif; ?>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" for="inputPenulis">
                <i class="bi bi-person text-muted"></i> Penulis <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-person input-icon"></i>
                <input 
                  type="text" 
                  name="penulis" 
                  id="inputPenulis" 
                  class="form-control <?= $this->errors('penulis') ? 'is-invalid' : '' ?>"
                  value="<?= htmlspecialchars($this->old('penulis')) ?>" 
                  placeholder="Nama penulis / pengarang"
                >
              </div>
              <?php if ($this->errors('penulis')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('penulis')) ?></div>
              <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label" for="inputPenerbit">
                <i class="bi bi-building text-muted"></i> Penerbit <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-building input-icon"></i>
                <input 
                  type="text" 
                  name="penerbit" 
                  id="inputPenerbit" 
                  class="form-control <?= $this->errors('penerbit') ? 'is-invalid' : '' ?>"
                  value="<?= htmlspecialchars($this->old('penerbit')) ?>" 
                  placeholder="Nama penerbit buku"
                >
              </div>
              <?php if ($this->errors('penerbit')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('penerbit')) ?></div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" for="inputTahun">
                <i class="bi bi-calendar3 text-muted"></i> Tahun Terbit <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-calendar3 input-icon"></i>
                <input 
                  type="number" 
                  name="tahun_terbit" 
                  id="inputTahun" 
                  min="1900" 
                  max="2099" 
                  class="form-control <?= $this->errors('tahun_terbit') ? 'is-invalid' : '' ?>"
                  value="<?= htmlspecialchars($this->old('tahun_terbit', date('Y'))) ?>" 
                  placeholder="Contoh: 2024"
                >
              </div>
              <?php if ($this->errors('tahun_terbit')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('tahun_terbit')) ?></div>
              <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label" for="inputStok">
                <i class="bi bi-boxes text-muted"></i> Jumlah Stok <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-boxes input-icon"></i>
                <input 
                  type="number" 
                  name="stok" 
                  id="inputStok" 
                  min="0" 
                  class="form-control <?= $this->errors('stok') ? 'is-invalid' : '' ?>"
                  value="<?= htmlspecialchars($this->old('stok', '1')) ?>" 
                  placeholder="Jumlah eksemplar"
                >
              </div>
              <?php if ($this->errors('stok')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('stok')) ?></div>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-actions pt-2 border-top">
            <a href="<?= BASE_URL ?>/buku" class="btn btn-secondary">
              <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-circle-fill"></i> Simpan Buku
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <span class="section-label">
          <i class="bi bi-eye text-primary me-1"></i> Live Preview Kartu Buku
        </span>
        <span class="badge bg-light text-muted border">Otomatis Terupdate</span>
      </div>

      <div class="p-4 rounded-4 text-center" style="background: linear-gradient(135deg, #eef2ff 0%, #fdf4ff 100%); border: 1px solid var(--primary-border);">
        <div class="mx-auto mb-3" style="width: 70px; height: 90px; border-radius: 8px; background: linear-gradient(135deg, var(--primary), var(--accent-purple)); color: #fff; display: grid; place-items: center; font-size: 2rem; box-shadow: var(--shadow-glow);">
          <i class="bi bi-book"></i>
        </div>

        <div class="mb-2">
          <span class="badge bg-white text-primary border font-monospace px-3 py-1" id="previewKode">
            <?= htmlspecialchars($this->old('kode_buku') ?: 'BK00X') ?>
          </span>
        </div>

        <h4 class="fw-bold text-dark mb-1" id="previewJudul">
          <?= htmlspecialchars($this->old('judul') ?: 'Judul Buku Baru') ?>
        </h4>
        <p class="text-secondary mb-3" style="font-size: 0.85rem;" id="previewPenulis">
          Oleh: <?= htmlspecialchars($this->old('penulis') ?: 'Nama Penulis') ?>
        </p>

        <div class="d-flex justify-content-center gap-2 mb-3 flex-wrap">
          <span class="badge bg-white text-secondary border px-2 py-1" id="previewPenerbit">
            <i class="bi bi-building me-1"></i><?= htmlspecialchars($this->old('penerbit') ?: 'Penerbit') ?>
          </span>
          <span class="badge bg-white text-secondary border px-2 py-1" id="previewTahun">
            <i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($this->old('tahun_terbit') ?: date('Y')) ?>
          </span>
        </div>

        <div class="pt-3 border-top d-flex justify-content-between align-items-center">
          <span class="text-muted" style="font-size: 0.8rem;">Ketersediaan Stok:</span>
          <span class="badge-status badge-status-success" id="previewStokBadge">
            <span id="previewStok"><?= (int)($this->old('stok') ?: 1) ?></span> Eksemplar
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  const kodeInput = document.getElementById('inputKode');
  const judulInput = document.getElementById('inputJudul');
  const penulisInput = document.getElementById('inputPenulis');
  const penerbitInput = document.getElementById('inputPenerbit');
  const tahunInput = document.getElementById('inputTahun');
  const stokInput = document.getElementById('inputStok');

  const previewKode = document.getElementById('previewKode');
  const previewJudul = document.getElementById('previewJudul');
  const previewPenulis = document.getElementById('previewPenulis');
  const previewPenerbit = document.getElementById('previewPenerbit');
  const previewTahun = document.getElementById('previewTahun');
  const previewStok = document.getElementById('previewStok');
  const previewStokBadge = document.getElementById('previewStokBadge');

  if (kodeInput && previewKode) {
    kodeInput.addEventListener('input', function(e) {
      previewKode.innerText = e.target.value.trim() || 'BK00X';
    });
  }

  if (judulInput && previewJudul) {
    judulInput.addEventListener('input', function(e) {
      previewJudul.innerText = e.target.value.trim() || 'Judul Buku Baru';
    });
  }

  if (penulisInput && previewPenulis) {
    penulisInput.addEventListener('input', function(e) {
      previewPenulis.innerText = 'Oleh: ' + (e.target.value.trim() || 'Nama Penulis');
    });
  }

  if (penerbitInput && previewPenerbit) {
    penerbitInput.addEventListener('input', function(e) {
      previewPenerbit.innerHTML = '<i class="bi bi-building me-1"></i>' + (e.target.value.trim() || 'Penerbit');
    });
  }

  if (tahunInput && previewTahun) {
    tahunInput.addEventListener('input', function(e) {
      previewTahun.innerHTML = '<i class="bi bi-calendar3 me-1"></i>' + (e.target.value.trim() || '2024');
    });
  }

  if (stokInput && previewStok && previewStokBadge) {
    stokInput.addEventListener('input', function(e) {
      const val = parseInt(e.target.value) || 0;
      previewStok.innerText = val;
      if (val <= 0) {
        previewStokBadge.className = 'badge-status badge-status-danger';
        previewStokBadge.innerHTML = '<span id="previewStok">0</span> Habis';
      } else {
        previewStokBadge.className = 'badge-status badge-status-success';
        previewStokBadge.innerHTML = '<span id="previewStok">' + val + '</span> Eksemplar';
      }
    });
  }
})();
</script>
