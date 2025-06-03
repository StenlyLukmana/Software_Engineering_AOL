<?php

require_once __DIR__ . '/vendor/autoload.php';

// Test login and quiz creation functionality

echo "=== Quiz Creation Form Debug Test ===\n";

try {
    // Initialize Laravel properly
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
      // Boot the application
    $app->boot();
    
    // Set up the application context
    $app->instance('request', Illuminate\Http\Request::capture());
    
    // Test database connection
    $users = DB::table('users')->get();
    echo "Found " . count($users) . " users in database:\n";
    
    foreach ($users as $user) {
        echo "- {$user->name} ({$user->role})\n";
    }
    
    // Test materials
    $materials = DB::table('materials')->join('subjects', 'materials.subject_id', '=', 'subjects.id')
                  ->select('materials.*', 'subjects.name as subject_name')
                  ->get();
    
    echo "\nFound " . count($materials) . " materials:\n";
    foreach ($materials as $material) {
        echo "- {$material->subject_name}: {$material->title}\n";
    }
    
    // Check if there are any view cache issues
    echo "\nChecking for potential view issues...\n";
    $viewPath = __DIR__ . '/resources/views/quiz/create.blade.php';
    if (file_exists($viewPath)) {
        echo "✓ Quiz create view exists\n";
        $content = file_get_contents($viewPath);
        if (strpos($content, '@extends') !== false) {
            echo "✓ View extends layout\n";
        } else {
            echo "✗ View doesn't extend layout properly\n";
        }
        if (strpos($content, '@section') !== false) {
            echo "✓ View has section\n";
        } else {
            echo "✗ View doesn't have section\n";
        }
    } else {
        echo "✗ Quiz create view does not exist\n";
    }
    
    // Check main layout
    $layoutPath = __DIR__ . '/resources/views/layouts/main.blade.php';
    if (file_exists($layoutPath)) {
        echo "✓ Main layout exists\n";
        $layoutContent = file_get_contents($layoutPath);
        if (strpos($layoutContent, '@yield(\'container\')') !== false) {
            echo "✓ Layout has container yield\n";
        } else {
            echo "✗ Layout missing container yield\n";
        }
    } else {
        echo "✗ Main layout does not exist\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";
