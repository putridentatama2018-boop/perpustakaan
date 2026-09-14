<div class="page-heading">
  <div><h1>Tambah Anggota</h1><p>Tambahkan mahasiswa baru yang dapat melakukan peminjaman buku.</p></div>
</div>
<div class="card" style="max-width:760px;">
  <div class="card-header bg-white fw-semibold">Form Tambah Anggota</div>
  <div class="card-body">
    <form action="<?= BASE_URL ?>/anggota/store" method="POST" novalidate>
      <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" inputmode="numeric" class="form-control <?= $this->errors('nim') ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($this->old('nim')) ?>" placeholder="Contoh: 20241004">
        <?php if ($this->errors('nim')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('nim')) ?></div><?php endif; ?>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Anggota</label>
        <input type="text" name="nama" class="form-control <?= $this->errors('nama') ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($this->old('nama')) ?>" placeholder="Contoh: Putri Dentatama">
        <?php if ($this->errors('nama')): ?><div class="invalid-feedback"><?= htmlspecialchars($this->errors('nama')) ?></div><?php endif; ?>
      </div>
      <div class="form-actions"><a href="<?= BASE_URL ?>/anggota" class="btn btn-secondary">Batal</a><button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Simpan Anggota</button></div>
    </form>
  </div>
</div>
