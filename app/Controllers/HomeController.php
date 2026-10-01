<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\BukuService;
use App\Services\PeminjamanService;

class HomeController extends Controller
{
    public function index(): void
    {
        $bukuService       = new BukuService();
        $peminjamanService = new PeminjamanService();

        $daftarBuku       = $bukuService->getAll();
        $daftarPeminjaman = $peminjamanService->getAll();

        $totalBuku      = count($daftarBuku);
        $totalStok      = array_sum(array_column($daftarBuku, 'stok'));
        $totalDipinjam  = count(array_filter($daftarPeminjaman, fn ($p) => $p['status'] === 'dipinjam'));
        $totalHabis     = count(array_filter($daftarBuku, fn ($b) => (int) $b['stok'] === 0));

        $this->view('dashboard/index', [
            'title'              => 'Dashboard',
            'totalBuku'          => $totalBuku,
            'totalStok'          => $totalStok,
            'totalDipinjam'      => $totalDipinjam,
            'totalHabis'         => $totalHabis,
            'peminjamanTerbaru'  => array_slice($daftarPeminjaman, 0, 5),
        ]);
    }
}
