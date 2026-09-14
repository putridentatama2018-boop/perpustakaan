<div class="page-heading">
  <div><h1>Data Anggota</h1><p>Daftar mahasiswa yang terdaftar sebagai peminjam perpustakaan.</p></div>
  <div class="page-heading-actions">
    <a href="<?= BASE_URL ?>/anggota/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Anggota</a>
  </div>
</div>
<div class="card">
  <div class="table-toolbar">
    <div class="section-label">Data Mahasiswa</div>
    <div class="input-group input-group-sm table-search"><span class="input-group-text bg-white"><i class="bi bi-search"></i></span><input class="form-control" type="search" placeholder="Cari NIM atau nama..." oninput="filterMember(this)"></div>
  </div>
  <div class="table-responsive"><table class="table mb-0 align-middle" id="memberTable"><thead><tr><th>No</th><th>NIM</th><th>Nama Anggota</th><th>Terdaftar</th></tr></thead><tbody><?php if(empty($daftarAnggota)): ?><tr><td colspan="4" class="text-center empty-state">Belum ada data anggota.</td></tr><?php else:$no=1;foreach($daftarAnggota as $a): ?><tr data-searchable><td><?= $no++ ?></td><td><strong><?= htmlspecialchars($a['nim']) ?></strong></td><td><?= htmlspecialchars($a['nama']) ?></td><td><?= htmlspecialchars($a['created_at']) ?></td></tr><?php endforeach;endif;?></tbody></table></div>
  <div class="table-footer"><span>Menampilkan <?= count($daftarAnggota) ?> anggota</span><span>Gunakan pencarian untuk menemukan data lebih cepat.</span></div>
</div>
<script>function filterMember(input){const q=input.value.toLowerCase().trim();document.querySelectorAll('#memberTable tbody tr[data-searchable]').forEach(r=>r.style.display=r.innerText.toLowerCase().includes(q)?'':'none');}</script>
