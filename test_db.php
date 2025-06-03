<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->boot();

echo "🔧 Database Connection Test\n";
echo "==========================\n\n";

try {
    $userCount = App\Models\User::count();
    $subjectCount = App\Models\Subject::count();
    $materialCount = App\Models\Material::count();
    
    echo "✅ Database Connection: WORKING\n";
    echo "📊 Users: {$userCount}\n";
    echo "📚 Subjects: {$subjectCount}\n";
    echo "📄 Materials: {$materialCount}\n\n";

    // Test admin user
    $admin = App\Models\User::where('email', 'admin@cslearning.com')->first();
    if ($admin) {
        echo "Admin user found: {$admin->name}\n";
        echo "Admin email: {$admin->email}\n\n";
    } else {
        echo "Admin user not found\n\n";
    }

    echo "Database is ready for login testing!\n";
    
} catch (Exception $e) {
    echo "Database Connection: FAILED\n";
    echo "Error: " . $e->getMessage() . "\n";
}
