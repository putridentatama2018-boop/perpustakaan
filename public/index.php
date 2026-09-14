<?php

/**
 * Front Controller
 * Satu-satunya titik masuk (entry point) aplikasi. Seluruh request diarahkan
 * ke sini oleh public/.htaccess, kemudian diteruskan ke Router.
 */

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '0'); // Jangan tampilkan error PHP mentah ke pengguna.
ini_set('log_errors', '1');

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

// Autoloader sederhana (mengikuti pola PSR-4) untuk namespace App\
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $path = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

use App\Core\Router;
use App\Helpers\Logger;

$routes = require BASE_PATH . '/routes/web.php';

try {
    (new Router($routes))->dispatch();
} catch (\Throwable $e) {
    Logger::error('Unhandled exception: ' . $e->getMessage());
    http_response_code(500);
    echo 'Terjadi kesalahan pada server. Silakan coba lagi.';
}
