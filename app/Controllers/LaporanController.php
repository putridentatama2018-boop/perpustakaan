<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\BukuService;
use App\Services\PeminjamanService;

class LaporanController extends Controller
{
    public function index(): void
    {
        $buku = (new BukuService())->getAll();
        $pinjam = (new PeminjamanService())->getAll();
        $this->view('laporan/index', [
            'title' => 'Laporan',
            'daftarBuku' => $buku,
            'daftarPeminjaman' => $pinjam,
            'totalBuku' => count($buku),
            'totalStok' => array_sum(array_column($buku, 'stok')),
            'totalDipinjam' => count(array_filter($pinjam, fn($p)=>$p['status']==='dipinjam')),
            'totalKembali' => count(array_filter($pinjam, fn($p)=>$p['status']==='kembali')),
        ]);
    }
}
