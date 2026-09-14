<?php

namespace App\Exceptions;

use Exception;

/**
 * Dilempar ketika buku yang ingin dipinjam memiliki stok 0 (habis).
 */
class BukuTidakTersediaException extends Exception
{
    public function __construct(string $message = 'Buku tidak tersedia.')
    {
        parent::__construct($message);
    }
}
