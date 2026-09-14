<?php
namespace App\Services;

use App\Repositories\AnggotaRepository;
use App\Helpers\Logger;

class AnggotaService
{
    private AnggotaRepository $repo;

    public function __construct()
    {
        $this->repo = new AnggotaRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }

    public function validate(array $input): array
    {
        $errors = [];
        $nim = trim($input['nim'] ?? '');
        $nama = trim($input['nama'] ?? '');

        if ($nim === '') {
            $errors['nim'] = 'NIM wajib diisi.';
        } elseif (!ctype_digit($nim)) {
            $errors['nim'] = 'NIM harus berupa angka.';
        } elseif (strlen($nim) > 20) {
            $errors['nim'] = 'NIM maksimal 20 karakter.';
        } elseif ($this->repo->findByNim($nim)) {
            $errors['nim'] = 'NIM sudah terdaftar.';
        }

        if ($nama === '') {
            $errors['nama'] = 'Nama anggota wajib diisi.';
        } elseif (mb_strlen($nama) > 100) {
            $errors['nama'] = 'Nama anggota maksimal 100 karakter.';
        }

        return $errors;
    }

    public function create(array $input): int
    {
        $id = $this->repo->create([
            'nim' => trim($input['nim']),
            'nama' => trim($input['nama']),
        ]);

        Logger::info("Anggota ditambahkan: ID={$id}, NIM={$input['nim']}, Nama={$input['nama']}");
        return $id;
    }
}
