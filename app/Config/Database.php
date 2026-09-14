<?php

namespace App\Config;

use PDO;
use PDOException;

/**
 * Database
 *
 * Mengelola satu koneksi PDO (singleton) ke MySQL.
 * Kredensial database TIDAK ditampilkan ke pengguna apabila terjadi kegagalan koneksi.
 */
class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

            try {
                self::$instance = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                // Detail koneksi (host/user/password) sengaja tidak diteruskan ke pengguna.
                throw new PDOException('Koneksi database gagal.');
            }
        }

        return self::$instance;
    }
}
