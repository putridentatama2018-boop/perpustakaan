<div class="page-heading">
  <div>
    <h1>
      <i class="bi bi-person-plus-fill text-primary me-2"></i>
      Tambah Anggota Baru
    </h1>
    <p>Registrasi mahasiswa baru ke dalam sistem peminjaman perpustakaan.</p>
  </div>
  <div class="page-heading-actions">
    <a href="<?= BASE_URL ?>/anggota" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Kembali ke Data Anggota
    </a>
  </div>
</div>

<div class="row g-4">

  <div class="col-lg-7">
    <div class="card">
      <div class="card-header">
        <span><i class="bi bi-person-vcard text-primary me-2"></i>Formulir Registrasi Mahasiswa</span>
        <span class="badge bg-primary-subtle text-primary">Anggota Baru</span>
      </div>
      <div class="card-body">
        <form action="<?= BASE_URL ?>/anggota/store" method="POST" novalidate id="memberForm">

          <div class="mb-3">
            <label class="form-label" for="inputNIM">
              <i class="bi bi-person-badge text-muted"></i> Nomor Induk Mahasiswa (NIM) <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
              <i class="bi bi-person-badge input-icon"></i>
              <input 
                type="text" 
                name="nim" 
                id="inputNIM" 
                inputmode="numeric" 
                class="form-control font-monospace <?= $this->errors('nim') ? 'is-invalid' : '' ?>" 
                value="<?= htmlspecialchars($this->old('nim')) ?>" 
                placeholder="Contoh: 20241004" 
                autocomplete="off"
              >
            </div>
            <?php if ($this->errors('nim')): ?>
              <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('nim')) ?></div>
            <?php else: ?>
              <small class="text-muted" style="font-size: 0.75rem;">NIM harus unik dan berupa angka / identitas resmi mahasiswa.</small>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label class="form-label" for="inputNama">
              <i class="bi bi-person text-muted"></i> Nama Lengkap Mahasiswa <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
              <i class="bi bi-person input-icon"></i>
              <input 
                type="text" 
                name="nama" 
                id="inputNama" 
                class="form-control <?= $this->errors('nama') ? 'is-invalid' : '' ?>" 
                value="<?= htmlspecialchars($this->old('nama')) ?>" 
                placeholder="Contoh: Putri Dentatama" 
                autocomplete="off"
              >
            </div>
            <?php if ($this->errors('nama')): ?>
              <div class="invalid-feedback d-block"><?= htmlspecialchars($this->errors('nama')) ?></div>
            <?php endif; ?>
          </div>

          <div class="form-actions pt-2 border-top">
            <a href="<?= BASE_URL ?>/anggota" class="btn btn-secondary">
              <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-circle-fill"></i> Daftarkan Anggota
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Kolom Kanan: Preview Kartu Anggota Digital -->
  <div class="col-lg-5">
    <div class="card p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <span class="section-label">
          <i class="bi bi-person-vcard text-primary me-1"></i> Preview Kartu Anggota
        </span>
        <span class="badge bg-light text-muted border">Live Preview</span>
      </div>

      <div class="p-4 rounded-4 text-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: #ffffff; box-shadow: var(--shadow-glow); position: relative; overflow: hidden;">
        <div style="position: absolute; right: -20px; top: -20px; width: 100px; height: 100px; border-radius: 50%; background: rgba(255,255,255,0.1); pointer-events: none;"></div>

        <div class="d-flex justify-content-between align-items-center mb-3 text-start">
          <div>
            <div class="fw-bold" style="font-size: 0.8rem; letter-spacing: 0.05em; text-transform: uppercase;">Perpustakaan Kampus</div>
            <div style="font-size: 0.65rem; opacity: 0.8;">Kartu Anggota Resmi</div>
          </div>
          <i class="bi bi-book-half fs-4"></i>
        </div>

        <div class="mx-auto my-3" id="previewAvatar" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(255,255,255,0.25); border: 2px solid #ffffff; display: grid; place-items: center; font-size: 1.5rem; font-weight: 800; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
          <?= strtoupper(substr($this->old('nama') ?: 'M', 0, 1)) ?>
        </div>

        <h4 class="fw-bold mb-0 text-white" id="previewNama">
          <?= htmlspecialchars($this->old('nama') ?: 'Nama Mahasiswa') ?>
        </h4>
        <div class="font-monospace mt-1 mb-3" style="font-size: 0.9rem; opacity: 0.9;" id="previewNIM">
          NIM: <?= htmlspecialchars($this->old('nim') ?: '2024XXXX') ?>
        </div>

        <div class="pt-2 border-top border-white border-opacity-25 d-flex justify-content-between align-items-center" style="font-size: 0.725rem; opacity: 0.85;">
          <span>Status: <strong class="text-white">Aktif</strong></span>
          <span>Hak Pinjam: <strong class="text-white">Maks. 3 Buku</strong></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script Live Preview -->
<script>
(function() {
  const nimInput = document.getElementById('inputNIM');
  const namaInput = document.getElementById('inputNama');
  const previewNIM = document.getElementById('previewNIM');
  const previewNama = document.getElementById('previewNama');
  const previewAvatar = document.getElementById('previewAvatar');

  if (nimInput && previewNIM) {
    nimInput.addEventListener('input', function(e) {
      const val = e.target.value.trim();
      previewNIM.innerText = 'NIM: ' + (val || '2024XXXX');
    });
  }

  if (namaInput && previewNama && previewAvatar) {
    namaInput.addEventListener('input', function(e) {
      const val = e.target.value.trim();
      previewNama.innerText = val || 'Nama Mahasiswa';
      previewAvatar.innerText = val ? val.charAt(0).toUpperCase() : 'M';
    });
  }
})();
</script>
