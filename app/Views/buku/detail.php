<div class="page-heading">
  <div>
    <h1><i class="bi bi-file-text text-primary me-2"></i>Detail Informasi Buku</h1>
    <p>Informasi lengkap mengenai buku <strong><?= htmlspecialchars($buku['judul']) ?></strong>.</p>
  </div>
  <div class="page-heading-actions">
    <a href="<?= BASE_URL ?>/buku" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Kembali ke Katalog
    </a>
    <a href="<?= BASE_URL ?>/buku/edit?id=<?= (int)$buku['id'] ?>" class="btn btn-warning">
      <i class="bi bi-pencil-square"></i> Edit Data Buku
    </a>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-4">
    <div class="card text-center p-4">
      <div class="mx-auto mb-3" style="width: 100px; height: 130px; border-radius: 12px; background: linear-gradient(135deg, var(--primary), var(--accent-purple)); color: #fff; display: grid; place-items: center; font-size: 3rem; box-shadow: var(--shadow-glow);">
        <i class="bi bi-book"></i>
      </div>

      <span class="badge bg-light text-primary border font-monospace px-3 py-1 mb-2 d-inline-block">
        <?= htmlspecialchars($buku['kode_buku']) ?>
      </span>

      <h3 class="fw-bold text-dark mb-1" style="font-size: 1.25rem;">
        <?= htmlspecialchars($buku['judul']) ?>
      </h3>
      <p class="text-secondary mb-3">Oleh <?= htmlspecialchars($buku['penulis']) ?></p>

      <div class="pt-3 border-top">
        <div class="text-muted small mb-1">Status Ketersediaan:</div>
        <?php if ($buku['status'] === 'tersedia'): ?>
          <span class="badge-status badge-status-success fs-6 px-3 py-1">
            Tersedia (<?= (int)$buku['stok'] ?> Eksemplar)
          </span>
        <?php else: ?>
          <span class="badge-status badge-status-danger fs-6 px-3 py-1">
            Stok Habis
          </span>
        <?php endif; ?>
      </div>

      <?php if ((int)$buku['stok'] > 0): ?>
        <div class="mt-4">
          <a href="<?= BASE_URL ?>/peminjaman" class="btn btn-primary w-100">
            <i class="bi bi-journal-arrow-up"></i> Pinjamkan Buku Ini
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <span><i class="bi bi-card-checklist text-primary me-2"></i>Spesifikasi &amp; Detail Teknis</span>
        <span class="badge bg-light text-muted border">ID #<?= (int)$buku['id'] ?></span>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <tbody>
              <tr>
                <td style="width: 200px;" class="text-secondary fw-semibold">
                  <i class="bi bi-upc text-muted me-2"></i>Kode Buku
                </td>
                <td class="font-monospace fw-bold text-primary">
                  <?= htmlspecialchars($buku['kode_buku']) ?>
                </td>
              </tr>
              <tr>
                <td class="text-secondary fw-semibold">
                  <i class="bi bi-book text-muted me-2"></i>Judul Lengkap
                </td>
                <td class="fw-bold text-dark">
                  <?= htmlspecialchars($buku['judul']) ?>
                </td>
              </tr>
              <tr>
                <td class="text-secondary fw-semibold">
                  <i class="bi bi-person-circle text-muted me-2"></i>Penulis / Pengarang
                </td>
                <td>
                  <?= htmlspecialchars($buku['penulis']) ?>
                </td>
              </tr>
              <tr>
                <td class="text-secondary fw-semibold">
                  <i class="bi bi-building text-muted me-2"></i>Penerbit
                </td>
                <td>
                  <?= htmlspecialchars($buku['penerbit']) ?>
                </td>
              </tr>
              <tr>
                <td class="text-secondary fw-semibold">
                  <i class="bi bi-calendar3 text-muted me-2"></i>Tahun Terbit
                </td>
                <td>
                  <span class="badge bg-secondary-subtle text-secondary-emphasis font-monospace">
                    <?= htmlspecialchars($buku['tahun_terbit']) ?>
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-secondary fw-semibold">
                  <i class="bi bi-boxes text-muted me-2"></i>Stok Tersedia
                </td>
                <td>
                  <strong><?= (int)$buku['stok'] ?></strong> Eksemplar
                </td>
              </tr>
              <tr>
                <td class="text-secondary fw-semibold">
                  <i class="bi bi-shield-check text-muted me-2"></i>Status Sirkulasi
                </td>
                <td>

                  <?php if ($buku['status'] === 'tersedia'): ?>
                    <span class="badge-status badge-status-success">
                    Dapat Dipinjam
                  </span>

                  <?php else: ?>
                    <span class="badge-status badge-status-danger">
                    Tidak Dapat Dipinjam (Stok Kosong)
                    </span>
                    
                  <?php endif; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="text-muted small">
        Data tersinkronisasi dengan basis data perpustakaan
        </span>
        <div class="d-flex gap-2">
          <a href="<?= BASE_URL ?>
          /buku/edit?id=<?= (int)$buku['id'] ?>" 
          class="btn btn-sm btn-warning">
            <i class="bi bi-pencil-square">
            </i> Edit
          </a>
          <a href="<?= BASE_URL ?>/buku" 
          class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left">
            </i> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
