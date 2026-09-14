<?php

namespace App\Exceptions;

use Exception;

/**
 * Dilempar ketika mahasiswa sudah memiliki 3 buku yang sedang dipinjam.
 */
class BatasPeminjamanException extends Exception
{
    public function __construct(string $message = 'Mahasiswa telah mencapai batas maksimal peminjaman.')
    {
        parent::__construct($message);
    }
}
