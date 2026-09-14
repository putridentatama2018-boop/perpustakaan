<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\PeminjamanService;
use App\Services\BukuService;
use App\Repositories\AnggotaRepository;
use App\Exceptions\BukuTidakTersediaException;
use App\Exceptions\BatasPeminjamanException;
use App\Exceptions\BukuTidakDitemukanException;
use App\Exceptions\TransaksiTidakDitemukanException;
use App\Helpers\Logger;

/**
 * PeminjamanController
 *
 * Menangani alur peminjaman & pengembalian buku. Semua pengecekan bisnis
 * (stok, batas maksimal pinjam, dsb.) dilakukan oleh PeminjamanService.
 * Pola PRG diterapkan pada store() dan kembalikan().
 */
class PeminjamanController extends Controller
{
    private PeminjamanService $service;

    public function __construct()
    {
        $this->service = new PeminjamanService();
    }

    public function index(): void
    {
        $bukuService = new BukuService();
        $anggotaRepo = new AnggotaRepository();

        $this->view('peminjaman/index', [
            'title'             => 'Peminjaman Buku',
            'daftarPeminjaman'  => $this->service->getAll(),
            'daftarBuku'        => $bukuService->getAll(),
            'daftarAnggota'     => $anggotaRepo->all(),
        ]);
        $this->clearErrors();
    }

    public function store(): void
    {
        $input  = $_POST;
        $errors = $this->service->validate($input);

        if (!empty($errors)) {
            $this->setErrors($errors);
            $this->setOld($input);
            $this->redirect('/peminjaman');
        }

        try {
            $this->service->pinjam($input);
            $this->flash('success', 'Peminjaman buku berhasil disimpan.');
        } catch (BukuTidakTersediaException $e) {
            $this->flash('danger', $e->getMessage());
        } catch (BatasPeminjamanException $e) {
            $this->flash('danger', $e->getMessage());
        } catch (BukuTidakDitemukanException $e) {
            $this->flash('danger', $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error('Gagal memproses peminjaman: ' . $e->getMessage());
            $this->flash('danger', 'Peminjaman gagal diproses.');
        }

        $this->clearOld();
        $this->clearErrors();
        $this->redirect('/peminjaman');
    }

    public function kembalikan(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        try {
            $this->service->kembalikan($id);
            $this->flash('success', 'Buku berhasil dikembalikan.');
        } catch (TransaksiTidakDitemukanException $e) {
            $this->flash('danger', $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error('Gagal memproses pengembalian: ' . $e->getMessage());
            $this->flash('danger', $e->getMessage());
        }

        $this->redirect('/peminjaman');
    }
}
