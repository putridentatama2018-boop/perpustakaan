<?php

namespace App\Helpers;

/**
 * Logger
 *
 * Mencatat kejadian penting (info) dan error ke storage/logs/app.log.
 * Setiap transaksi peminjaman & pengembalian WAJIB tercatat di sini (ketentuan studi kasus).
 */
class Logger
{
    private static function logFile(): string
    {
        return __DIR__ . '/../../storage/logs/app.log';
    }

    public static function info(string $message): void
    {
        self::write('INFO', $message);
    }

    public static function error(string $message): void
    {
        self::write('ERROR', $message);
    }

    private static function write(string $level, string $message): void
    {
        $line = sprintf('[%s] %s: %s%s', date('Y-m-d H:i:s'), $level, $message, PHP_EOL);

        $dir = dirname(self::logFile());
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        error_log($line, 3, self::logFile());
    }
}
