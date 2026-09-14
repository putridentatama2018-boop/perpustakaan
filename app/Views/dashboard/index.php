<div class="page-heading">
  <div><h1>Dashboard</h1><p>Ringkasan aktivitas dan kondisi perpustakaan kampus.</p></div>
  <a href="<?= BASE_URL ?>/peminjaman" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Peminjaman Baru</a>
</div>
<div class="row g-3 mb-4">
  <div class="col-6 col-xl-3"><div class="card stat-card bg-stat-blue"><div class="card-body"><div class="stat-label">Judul Buku</div><div class="stat-value"><?= (int)$totalBuku ?></div><i class="bi bi-book stat-icon"></i></div></div></div>
  <div class="col-6 col-xl-3"><div class="card stat-card bg-stat-green"><div class="card-body"><div class="stat-label">Total Stok Buku</div><div class="stat-value"><?= (int)$totalStok ?></div><i class="bi bi-box-seam stat-icon"></i></div></div></div>
  <div class="col-6 col-xl-3"><div class="card stat-card bg-stat-orange"><div class="card-body"><div class="stat-label">Sedang Dipinjam</div><div class="stat-value"><?= (int)$totalDipinjam ?></div><i class="bi bi-arrow-left-right stat-icon"></i></div></div></div>
  <div class="col-6 col-xl-3"><div class="card stat-card bg-stat-red"><div class="card-body"><div class="stat-label">Stok Habis</div><div class="stat-value"><?= (int)$totalHabis ?></div><i class="bi bi-exclamation-circle stat-icon"></i></div></div></div>
</div>
<div class="card">
  <div class="card-header bg-white d-flex justify-content-between align-items-center"><div><strong>Aktivitas Peminjaman Terbaru</strong><div class="text-muted" style="font-size:11px">Transaksi terakhir yang tercatat di sistem.</div></div><a href="<?= BASE_URL ?>/peminjaman" class="btn btn-outline-primary btn-sm">Lihat Semua</a></div>
  <div class="table-responsive"><table class="table mb-0 align-middle"><thead><tr><th>No</th><th>Kode</th><th>NIM</th><th>Nama Anggota</th><th>Judul Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th></tr></thead>
  <tbody><?php if(empty($peminjamanTerbaru)): ?><tr><td colspan="8" class="text-center empty-state">Belum ada data peminjaman.</td></tr><?php else: $no=1; foreach($peminjamanTerbaru as $p): ?><tr data-searchable><td><?= $no++ ?></td><td><strong><?= htmlspecialchars($p['kode_peminjaman']) ?></strong></td><td><?= htmlspecialchars($p['nim']) ?></td><td><?= htmlspecialchars($p['nama_anggota']) ?></td><td><?= htmlspecialchars($p['judul_buku']) ?></td><td><?= htmlspecialchars($p['tanggal_pinjam']) ?></td><td><?= htmlspecialchars($p['tanggal_kembali']) ?></td><td><?php if($p['status']==='dipinjam'): ?><span class="badge badge-status bg-warning-subtle text-warning-emphasis">Dipinjam</span><?php else: ?><span class="badge badge-status bg-success-subtle text-success">Kembali</span><?php endif; ?></td></tr><?php endforeach; endif; ?></tbody></table></div>
</div>
