<?php

namespace App\Exceptions;

use Exception;

class TransaksiTidakDitemukanException extends Exception
{
    public function __construct(string $message = 'Transaksi peminjaman tidak ditemukan.')
    {
        parent::__construct($message);
    }
}
