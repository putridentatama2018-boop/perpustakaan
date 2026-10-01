<div class="page-heading">
  <div>
    <h1><i class="bi bi-pencil-square text-warning me-2"></i>Edit Informasi Buku</h1>
    <p>Perbarui detail data katalog buku perpustakaan.</p>
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
        <span><i class="bi bi-pencil-square text-primary me-2"></i>Perbarui Buku (ID: #<?= (int)$buku['id'] ?>)</span>
        <span class="badge bg-warning-subtle text-warning-emphasis">Mode Edit</span>
      </div>

      <div class="card-body">
        <form action="<?= BASE_URL ?>/buku/update?id=<?= (int)$buku['id'] ?>" method="POST" novalidate id="bookForm">
          <div class="mb-3">

            <label class="form-label">
              <i class="bi bi-upc-scan text-muted"></i> ID / Kode Buku <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
              <i class="bi bi-upc-scan input-icon"></i>
              <input type="text" name="kode_buku" id="inputKode" class="form-control font-monospace <?= $this->errors('kode_buku') ? 'is-invalid' : '' ?>"
                     value="<?= htmlspecialchars($this->old('kode_buku', $buku['kode_buku'])) ?>" placeholder="Contoh: BK001">
            </div>
            <?php if ($this->errors('kode_buku')): ?>
              <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('kode_buku')) ?></div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <i class="bi bi-book text-muted"></i> Judul Buku <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
              <i class="bi bi-book input-icon"></i>
              <input type="text" name="judul" id="inputJudul" class="form-control <?= $this->errors('judul') ? 'is-invalid' : '' ?>"
                     value="<?= htmlspecialchars($this->old('judul', $buku['judul'])) ?>" placeholder="Judul buku">
            </div>
            <?php if ($this->errors('judul')): ?>
              <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('judul')) ?></div>
            <?php endif; ?>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">
                <i class="bi bi-person text-muted"></i> Penulis <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="penulis" id="inputPenulis" class="form-control <?= $this->errors('penulis') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($this->old('penulis', $buku['penulis'])) ?>" placeholder="Nama penulis">
              </div>
              <?php if ($this->errors('penulis')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('penulis')) ?></div>
              <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">
                <i class="bi bi-building text-muted"></i> Penerbit <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-building input-icon"></i>
                <input type="text" name="penerbit" id="inputPenerbit" class="form-control <?= $this->errors('penerbit') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($this->old('penerbit', $buku['penerbit'])) ?>" placeholder="Nama penerbit">
              </div>
              <?php if ($this->errors('penerbit')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('penerbit')) ?></div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">
                <i class="bi bi-calendar3 text-muted"></i> Tahun Terbit <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-calendar3 input-icon"></i>
                <input type="number" name="tahun_terbit" id="inputTahun" min="1900" max="2099" class="form-control <?= $this->errors('tahun_terbit') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($this->old('tahun_terbit', $buku['tahun_terbit'])) ?>" placeholder="Tahun terbit">
              </div>
              <?php if ($this->errors('tahun_terbit')): ?>
                <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('tahun_terbit')) ?></div>
              <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">
                <i class="bi bi-boxes text-muted"></i> Jumlah Stok <span class="text-danger">*</span>
              </label>
              <div class="input-icon-group">
                <i class="bi bi-boxes input-icon"></i>
                <input type="number" name="stok" id="inputStok" min="0" class="form-control <?= $this->errors('stok') ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($this->old('stok', $buku['stok'])) ?>" placeholder="Stok buku">
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
              <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-lg-5">
    <div class="card p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <span class="section-label"><i class="bi bi-eye text-primary me-1"></i> Preview Kartu Buku</span>
        <span class="badge bg-light text-muted border">Live Update</span>
      </div>

      <div class="p-4 rounded-4 text-center" style="background: linear-gradient(135deg, #eef2ff 0%, #fdf4ff 100%); border: 1px solid var(--primary-border);">
        <div class="mx-auto mb-3" style="width: 70px; height: 90px; border-radius: 8px; background: linear-gradient(135deg, var(--primary), var(--accent-purple)); color: #fff; display: grid; place-items: center; font-size: 2rem; box-shadow: var(--shadow-glow);">
          <i class="bi bi-book"></i>
        </div>

        <div class="mb-2">
          <span class="badge bg-white text-primary border font-monospace px-3 py-1" id="previewKode">
            <?= htmlspecialchars($this->old('kode_buku', $buku['kode_buku'])) ?>
          </span>
        </div>

        <h4 class="fw-bold text-dark mb-1" id="previewJudul">
          <?= htmlspecialchars($this->old('judul', $buku['judul'])) ?>
        </h4>
        <p class="text-secondary mb-3" style="font-size: 0.85rem;" id="previewPenulis">
          Oleh: <?= htmlspecialchars($this->old('penulis', $buku['penulis'])) ?>
        </p>

        <div class="d-flex justify-content-center gap-2 mb-3 flex-wrap">
          <span class="badge bg-white text-secondary border px-2 py-1" id="previewPenerbit">
            <i class="bi bi-building me-1"></i><?= htmlspecialchars($this->old('penerbit', $buku['penerbit'])) ?>
          </span>
          <span class="badge bg-white text-secondary border px-2 py-1" id="previewTahun">
            <i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($this->old('tahun_terbit', $buku['tahun_terbit'])) ?>
          </span>
        </div>

        <div class="pt-3 border-top d-flex justify-content-between align-items-center">
          <span class="text-muted" style="font-size: 0.8rem;">Status Ketersediaan:</span>
          <?php $stokCurrent = (int)$this->old('stok', $buku['stok']); ?>
          <span class="badge-status <?= $stokCurrent > 0 ? 'badge-status-success' : 'badge-status-danger' ?>" id="previewStokBadge">
            <span id="previewStok"><?= $stokCurrent ?></span> <?= $stokCurrent > 0 ? 'Eksemplar' : 'Habis' ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const k = document.getElementById('inputKode');
  const j = document.getElementById('inputJudul');
  const p = document.getElementById('inputPenulis');
  const pb = document.getElementById('inputPenerbit');
  const t = document.getElementById('inputTahun');
  const s = document.getElementById('inputStok');

  if(k) k.addEventListener('input', e => document.getElementById('previewKode').innerText = e.target.value);
  if(j) j.addEventListener('input', e => document.getElementById('previewJudul').innerText = e.target.value);
  if(p) p.addEventListener('input', e => document.getElementById('previewPenulis').innerText = 'Oleh: ' + e.target.value);
  if(pb) pb.addEventListener('input', e => document.getElementById('previewPenerbit').innerHTML = '<i class="bi bi-building me-1"></i>' + e.target.value);
  if(t) t.addEventListener('input', e => document.getElementById('previewTahun').innerHTML = '<i class="bi bi-calendar3 me-1"></i>' + e.target.value);
  if(s) s.addEventListener('input', e => {
    const val = parseInt(e.target.value) || 0;
    document.getElementById('previewStok').innerText = val;
    const badge = document.getElementById('previewStokBadge');
    if (val <= 0) {
      badge.className = 'badge-status badge-status-danger';
      badge.innerHTML = '<span id="previewStok">0</span> Habis';
    } else {
      badge.className = 'badge-status badge-status-success';
      badge.innerHTML = '<span id="previewStok">' + val + '</span> Eksemplar';
    }
  });
})();
</script>
