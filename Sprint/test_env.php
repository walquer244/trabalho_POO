<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "App Environment: " . app()->environment() . "\n";
echo "Config Database Default: " . config('database.default') . "\n";
echo "Config Session Driver: " . config('session.driver') . "\n";
echo "env('APP_ENV'): " . env('APP_ENV') . "\n";
echo "getenv('APP_ENV'): " . getenv('APP_ENV') . "\n";
echo "\$_ENV['APP_ENV']: " . ($_ENV['APP_ENV'] ?? 'not set') . "\n";
echo "\$_SERVER['APP_ENV']: " . ($_SERVER['APP_ENV'] ?? 'not set') . "\n";
?>
