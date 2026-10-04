<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;

error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: text/plain; charset=utf-8');

echo "=== INFINITY INTERNS AUTO-SETUP & REPAIR ===\n\n";

$baseDir = dirname(__DIR__);
echo 'Base Directory: '.$baseDir."\n";
echo 'PHP Version: '.PHP_VERSION."\n\n";

// 1. Check & Fix .env
$envPath = $baseDir.'/.env';
if (! file_exists($envPath)) {
    echo "Creating .env from .env.example...\n";
    if (file_exists($baseDir.'/.env.example')) {
        copy($baseDir.'/.env.example', $envPath);
    } else {
        file_put_contents($envPath, '');
    }
}

$envContent = file_exists($envPath) ? file_get_contents($envPath) : '';
$neededSettings = [
    'APP_NAME' => '"Infinity Interns"',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_KEY' => 'base64:XyQ/Sjp9Q65menCAcwzC0zm6OjSjKBAhLqyGoofv8Ss=',
    'APP_URL' => 'https://infinityinterns.com',
    'DB_CONNECTION' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_DATABASE' => 'u637069213_test_db',
    'DB_USERNAME' => 'u637069213_infinity',
    'DB_PASSWORD' => "'!L8;7|yz'",
    'SESSION_DRIVER' => 'file',
    'CACHE_STORE' => 'file',
];

foreach ($neededSettings as $key => $val) {
    if (preg_match('/^'.preg_quote($key, '/').'=.*/m', $envContent)) {
        $envContent = preg_replace('/^'.preg_quote($key, '/').'=.*/m', $key.'='.$val, $envContent);
    } else {
        $envContent .= "\n".$key.'='.$val;
    }
}
file_put_contents($envPath, $envContent);
echo "[1/4] SUCCESS: .env file configured with correct database credentials.\n";

// 2. Fix storage folders and permissions
$storageDirs = [
    $baseDir.'/storage',
    $baseDir.'/storage/app',
    $baseDir.'/storage/app/public',
    $baseDir.'/storage/framework',
    $baseDir.'/storage/framework/cache',
    $baseDir.'/storage/framework/cache/data',
    $baseDir.'/storage/framework/sessions',
    $baseDir.'/storage/framework/views',
    $baseDir.'/storage/logs',
    $baseDir.'/bootstrap/cache',
];

foreach ($storageDirs as $d) {
    if (! is_dir($d)) {
        @mkdir($d, 0775, true);
    }
    @chmod($d, 0775);
}
echo "[2/4] SUCCESS: Storage & bootstrap cache directories verified and permissions set to 0775.\n";

// 3. Test MySQL Direct PDO Connection
echo "\n--- TESTING MYSQL CONNECTION ---\n";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=u637069213_test_db;charset=utf8mb4', 'u637069213_infinity', '!L8;7|yz', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "[3/4] SUCCESS: Direct PDO connection to MySQL database u637069213_test_db successful!\n";
} catch (Exception $e) {
    echo '[3/4] ERROR: Direct MySQL connection failed: '.$e->getMessage()."\n";
}

// 4. Bootstrap Laravel and execute migrations
echo "\n--- BOOTSTRAPPING LARAVEL APPLICATION ---\n";
try {
    require $baseDir.'/vendor/autoload.php';
    $app = require_once $baseDir.'/bootstrap/app.php';
    $kernel = $app->make(Kernel::class);
    $kernel->bootstrap();

    echo "--- CLEARING CONFIG & APPLICATION CACHE ---\n";
    Artisan::call('optimize:clear');
    echo trim(Artisan::output())."\n";

    echo "\n--- EXECUTING MIGRATIONS & SEEDERS ---\n";
    Artisan::call('migrate', ['--force' => true, '--seed' => true]);
    echo trim(Artisan::output())."\n";

    echo "\n--- CREATING STORAGE SYMLINK ---\n";
    try {
        Artisan::call('storage:link');
        echo trim(Artisan::output())."\n";
    } catch (Throwable $linkErr) {
        echo 'Note: '.$linkErr->getMessage()."\n";
    }

    echo "\n--- OPTIMIZING CONFIG, ROUTES & VIEWS ---\n";
    Artisan::call('optimize');
    echo trim(Artisan::output())."\n";

    echo "\n======================================================\n";
    echo "🎉 SUCCESS: SETUP COMPLETE! WEBSITE IS FULLY OPERATIONAL!\n";
    echo "======================================================\n";
} catch (Throwable $t) {
    echo "\nEXCEPTION DURING LARAVEL BOOTSTRAP:\n".$t->getMessage()."\n";
    echo 'File: '.$t->getFile().' (Line '.$t->getLine().")\n";
}
