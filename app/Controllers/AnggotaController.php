<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AnggotaService;
use App\Helpers\Logger;

class AnggotaController extends Controller
{
    private AnggotaService $service;

    public function __construct()
    {
        $this->service = new AnggotaService();
    }

    public function index(): void
    {
        $this->view('anggota/index', [
            'title' => 'Data Anggota',
            'daftarAnggota' => $this->service->getAll(),
        ]);
    }

    public function create(): void
    {
        $this->view('anggota/create', ['title' => 'Tambah Anggota']);
        $this->clearErrors();
    }

    public function store(): void
    {
        $input = $_POST;
        $errors = $this->service->validate($input);

        if (!empty($errors)) {
            $this->setErrors($errors);
            $this->setOld($input);
            $this->redirect('/anggota/create');
        }

        try {
            $this->service->create($input);
            $this->flash('success', 'Data anggota berhasil ditambahkan.');
        } catch (\Throwable $e) {
            Logger::error('Gagal menambah anggota: ' . $e->getMessage());
            $this->flash('danger', 'Data anggota gagal disimpan.');
        }

        $this->clearOld();
        $this->clearErrors();
        $this->redirect('/anggota');
    }
}
