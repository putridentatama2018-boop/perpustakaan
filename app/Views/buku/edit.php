<div class="page-heading"><div><h1>Edit Buku</h1><p>Kelola informasi buku perpustakaan.</p></div></div>
<div class="card" style="max-width:760px;">
  <div class="card-header bg-white fw-semibold">Edit Buku</div>
  <div class="card-body">
    <form action="<?= BASE_URL ?>/buku/update?id=<?= (int) $buku['id'] ?>" method="POST" novalidate>
      <div class="mb-3">
        <label class="form-label">ID Buku</label>
        <input type="text" name="kode_buku" class="form-control <?= $this->errors('kode_buku') ? 'is-invalid' : '' ?>"
               value="<?= htmlspecialchars($this->old('kode_buku', $buku['kode_buku'])) ?>">
        <?php if ($this->errors('kode_buku')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('kode_buku')) ?></div><?php endif; ?>
      </div>
      <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control <?= $this->errors('judul') ? 'is-invalid' : '' ?>"
               value="<?= htmlspecialchars($this->old('judul', $buku['judul'])) ?>">
        <?php if ($this->errors('judul')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('judul')) ?></div><?php endif; ?>
      </div>
      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control <?= $this->errors('penulis') ? 'is-invalid' : '' ?>"
               value="<?= htmlspecialchars($this->old('penulis', $buku['penulis'])) ?>">
        <?php if ($this->errors('penulis')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('penulis')) ?></div><?php endif; ?>
      </div>
      <div class="mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control <?= $this->errors('penerbit') ? 'is-invalid' : '' ?>"
               value="<?= htmlspecialchars($this->old('penerbit', $buku['penerbit'])) ?>">
        <?php if ($this->errors('penerbit')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('penerbit')) ?></div><?php endif; ?>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Tahun Terbit</label>
          <input type="number" name="tahun_terbit" class="form-control <?= $this->errors('tahun_terbit') ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($this->old('tahun_terbit', $buku['tahun_terbit'])) ?>">
          <?php if ($this->errors('tahun_terbit')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('tahun_terbit')) ?></div><?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Stok</label>
          <input type="number" name="stok" min="0" class="form-control <?= $this->errors('stok') ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($this->old('stok', $buku['stok'])) ?>">
          <?php if ($this->errors('stok')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('stok')) ?></div><?php endif; ?>
        </div>
      </div>
      <div class="form-actions"><a href="<?= BASE_URL ?>/buku" class="btn btn-secondary">Batal</a><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
    </form>
  </div>
</div>
