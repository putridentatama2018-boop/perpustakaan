<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title ?? 'Perpustakaan Kampus') ?> - Perpustakaan Kampus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
  :root { --primary:#0d6efd; --sidebar:#08264d; --sidebar2:#0d3566; --page:#f5f8fc; --border:#e6edf5; }
  * { box-sizing:border-box; }
  body { margin:0; background:var(--page); color:#24344d; font-family:Inter,system-ui,-apple-system,"Segoe UI",sans-serif; font-size:16px; }
  .app-shell { min-height:100vh; }
  .sidebar { width:238px; min-height:100vh; background:linear-gradient(180deg,var(--sidebar),#071d3b); color:#dbe8f8; position:sticky; top:0; align-self:flex-start; }
  .brand { height:62px; padding:0 20px; display:flex; align-items:center; gap:10px; font-weight:700; color:#fff; border-bottom:1px solid rgba(255,255,255,.1); letter-spacing:.1px; }
  .brand .brand-icon { width:30px; height:30px; display:grid; place-items:center; border-radius:7px; background:#fff; color:#0d3b73; font-size:17px; }
  .menu-title { padding:20px 18px 8px; color:#8fa9c8; font-size:12px; text-transform:uppercase; letter-spacing:.08em; font-weight:700; }
  .sidebar a { font-size:14px; margin:3px 10px; color:#cbd9eb; text-decoration:none; display:flex; align-items:center; gap:11px; padding:12px 13px; border-radius:7px; transition:.15s; }
  .sidebar a i { width:18px; text-align:center; font-size:16px; }
  .sidebar a.active, .sidebar a:hover { background:#0e4a8d; color:#fff; }
  .sidebar-footer { position:sticky; top:calc(100vh - 75px); margin-top:22px; padding:14px 18px; border-top:1px solid rgba(255,255,255,.08); color:#8fa9c8; font-size:12px; }
  .main-area { min-width:0; flex:1; }
  .topbar { height:62px; background:#fff; border-bottom:1px solid var(--border); padding:0 26px; display:flex; align-items:center; justify-content:space-between; gap:20px; }
  .top-search { width:min(420px,48vw); }
  .top-search .input-group-text, .top-search .form-control { border-color:#e2eaf3; background:#f8fafc; }
  .top-search .form-control { font-size:14px; }
  .profile { display:flex; align-items:center; gap:10px; }
  .profile-avatar { width:34px; height:34px; border-radius:50%; display:grid; place-items:center; background:#e8f0fb; color:#175ca8; font-weight:700; }
  .profile-name { line-height:1.1; }
  .profile-name strong { display:block; font-size:13px; color:#263b58; }
  .profile-name span { font-size:11px; color:#8a9ab0; }
  .page-content { padding:24px 26px 34px; }
  .page-heading { display:flex; justify-content:space-between; align-items:flex-start; gap:15px; margin-bottom:20px; }
  .page-heading-actions { margin-left:auto; display:flex; align-items:center; gap:8px; flex-shrink:0; }
  .form-actions { display:flex; justify-content:flex-end; align-items:center; gap:8px; margin-top:6px; }
  .action-group { display:flex; justify-content:center; align-items:center; gap:4px; white-space:nowrap; }
  .action-group .btn { min-width:54px; }
  .page-heading h1 { font-size:24px; margin:0; font-weight:700; color:#18365c; }
  .page-heading p { margin:5px 0 0; color:#7b8da5; font-size:13px; }
  .card { border:1px solid var(--border); border-radius:10px; box-shadow:0 2px 10px rgba(22,55,91,.04); }
  .card-header { border-bottom:1px solid var(--border); padding:15px 18px; }
  .table { font-size:13px; }
  .table > :not(caption) > * > * { padding:11px 10px; border-color:#edf1f6; }
  .table thead th { background:#f5f8fc; color:#647791; font-size:11px; text-transform:uppercase; letter-spacing:.04em; font-weight:700; white-space:nowrap; }
  .table tbody tr:hover { background:#f9fbfe; }
  .badge-status { border-radius:20px; padding:5px 9px; font-weight:600; font-size:10px; }
  .btn { border-radius:6px; font-size:13px; font-weight:600; }
  .btn-sm { padding:5px 8px; font-size:12px; }
  .btn-primary { box-shadow:0 3px 8px rgba(13,110,253,.15); }
  .stat-card { border:0; color:#fff; overflow:hidden; position:relative; }
  .stat-card .card-body { padding:17px 18px; }
  .stat-label { font-size:11px; opacity:.86; }
  .stat-value { font-size:25px; line-height:1.1; font-weight:800; margin-top:6px; }
  .stat-icon { position:absolute; right:18px; top:18px; font-size:30px; opacity:.18; }
  .bg-stat-blue { background:linear-gradient(135deg,#1769e0,#0d55bc); }
  .bg-stat-green { background:linear-gradient(135deg,#1ca67a,#12835f); }
  .bg-stat-orange { background:linear-gradient(135deg,#f3a51b,#dd7f00); }
  .bg-stat-red { background:linear-gradient(135deg,#e95362,#c93243); }
  .section-label { color:#6f819a; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; }
  .form-label { font-size:13px; font-weight:600; color:#40546f; }
  .form-control, .form-select { font-size:13px; border-color:#dfe7f0; border-radius:6px; }
  .form-control:focus, .form-select:focus { border-color:#86b7fe; box-shadow:0 0 0 .15rem rgba(13,110,253,.1); }
  .table-toolbar { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:13px 16px; border-bottom:1px solid var(--border); }
  .table-search { max-width:290px; }
  .table-search .form-control { font-size:12px; }
  .table-footer { padding:10px 16px; display:flex; justify-content:space-between; align-items:center; color:#8998ab; font-size:11px; border-top:1px solid var(--border); }
  .pagination .page-link { font-size:11px; padding:4px 8px; }
  .empty-state { padding:38px 10px !important; color:#94a1b3; }
  @media (max-width: 900px) {
    .sidebar { width:72px; }
    .brand { padding:0; justify-content:center; }
    .brand span, .menu-title, .sidebar a span, .sidebar-footer { display:none; }
    .sidebar a { justify-content:center; padding:12px 8px; }
    .sidebar a i { margin:0; }
    .topbar { padding:0 15px; }
    .page-content { padding:18px 15px; }
  }
  @media (max-width:600px) {
    .top-search { display:none; }
    .page-heading { flex-direction:column; }
    .page-heading-actions { width:100%; }
    .page-heading-actions .btn { width:100%; }
    .form-actions { justify-content:stretch; }
    .form-actions .btn { flex:1; }
  }
</style>
</head>
<body>
<div class="d-flex app-shell">
  <aside class="sidebar">
    <div class="brand"><span class="brand-icon"><i class="bi bi-book-half"></i></span><span>Perpustakaan Kampus</span></div>
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="sidebar-footer">Sistem Informasi Perpustakaan<br>Business Logic &amp; Logging</div>
  </aside>
  <div class="main-area">
    <header class="topbar">
      <div class="top-search input-group input-group-sm">
        <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
        <input class="form-control border-start-0" id="globalSearch" type="search" placeholder="Cari buku, judul, penulis...">
      </div>
      <div class="d-flex align-items-center gap-3">
        <i class="bi bi-bell text-secondary"></i>
        <div class="profile">
          <div class="profile-avatar"><i class="bi bi-person-fill"></i></div>
          <div class="profile-name"><strong>Admin</strong><span>Administrator</span></div>
          <i class="bi bi-chevron-down small text-secondary"></i>
        </div>
      </div>
    </header>
    <main class="page-content">
      <?php require __DIR__ . '/../partials/alert.php'; ?>
      <?= $content ?>
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){
  const input=document.getElementById('globalSearch');
  if(!input) return;
  input.addEventListener('input', function(){
    const q=this.value.toLowerCase().trim();
    document.querySelectorAll('[data-searchable]').forEach(function(row){
      row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
  });
})();
</script>
</body>
</html>
