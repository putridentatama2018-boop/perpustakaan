<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\PeminjamanService;
use App\Exceptions\TransaksiTidakDitemukanException;
use App\Helpers\Logger;

class PengembalianController extends Controller
{
    private PeminjamanService $service;
    public function __construct(){ $this->service = new PeminjamanService(); }

    public function index(): void
    {
        $semua = $this->service->getAll();
        $aktif = array_values(array_filter($semua, fn($p) => $p['status'] === 'dipinjam'));
        $this->view('pengembalian/index', [
            'title' => 'Pengembalian Buku',
            'daftarPengembalian' => $aktif,
        ]);
    }

    public function store(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        try {
            $this->service->kembalikan($id);
            $this->flash('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
        } catch (TransaksiTidakDitemukanException $e) {
            $this->flash('danger', $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error('Gagal memproses pengembalian: '.$e->getMessage());
            $this->flash('danger', $e->getMessage());
        }
        $this->redirect('/pengembalian');
    }
}
