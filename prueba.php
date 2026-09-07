<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = new App\Models\User();
$user->role = 'admin';

echo "Role: " . $user->role . "\n";
echo "isAdmin: " . ($user->isAdmin() ? 'VERDADERO' : 'FALSO') . "\n";