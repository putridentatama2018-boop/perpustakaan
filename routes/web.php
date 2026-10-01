<?php

use App\Controllers\HomeController;
use App\Controllers\BukuController;
use App\Controllers\PeminjamanController;
use App\Controllers\PengembalianController;
use App\Controllers\AnggotaController;
use App\Controllers\LaporanController;

return [
    'GET' => [
        '/'                => [HomeController::class, 'index'],
        '/buku'            => [BukuController::class, 'index'],
        '/buku/create'     => [BukuController::class, 'create'],
        '/buku/edit'       => [BukuController::class, 'edit'],
        '/buku/detail'     => [BukuController::class, 'detail'],
        '/peminjaman'      => [PeminjamanController::class, 'index'],
        '/pengembalian'    => [PengembalianController::class, 'index'],
        '/anggota'         => [AnggotaController::class, 'index'],
        '/anggota/create'  => [AnggotaController::class, 'create'],
        '/laporan'         => [LaporanController::class, 'index'],
    ],
    'POST' => [
        '/buku/store'            => [BukuController::class, 'store'],
        '/buku/update'           => [BukuController::class, 'update'],
        '/buku/delete'           => [BukuController::class, 'destroy'],
        '/peminjaman/store'      => [PeminjamanController::class, 'store'],
        '/peminjaman/kembalikan' => [PeminjamanController::class, 'kembalikan'],
        '/pengembalian/store'    => [PengembalianController::class, 'store'],
        '/anggota/store'         => [AnggotaController::class, 'store'],
    ],
];
