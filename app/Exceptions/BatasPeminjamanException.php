<?php

namespace App\Exceptions;

use Exception;

class BatasPeminjamanException extends Exception
{
    public function __construct(string $message = 'Mahasiswa telah mencapai batas maksimal peminjaman.')
    {
        parent::__construct($message);
    }
}
