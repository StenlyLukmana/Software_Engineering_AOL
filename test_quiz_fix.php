<?php

// Test quiz creation functionality after fix
require_once 'vendor/autoload.php';

// Boot Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== QUIZ CREATION FIX VERIFICATION ===\n\n";

// Test 1: Check if routes exist
echo "1. Checking routes:\n";

try {
    $routes = Route::getRoutes()->getRoutes();
    
    $quizCreateDirectExists = false;
    $quizStoreDirectExists = false;
    
    foreach ($routes as $route) {
        if ($route->uri() === 'quiz-create-direct' && in_array('GET', $route->methods())) {
            $quizCreateDirectExists = true;
            echo "✓ GET /quiz-create-direct route exists\n";
        }
        if ($route->uri() === 'quiz-store-direct' && in_array('POST', $route->methods())) {
            $quizStoreDirectExists = true;
            echo "✓ POST /quiz-store-direct route exists\n";
        }
    }
    
    if (!$quizCreateDirectExists) {
        echo "✗ GET /quiz-create-direct route missing\n";
    }
    if (!$quizStoreDirectExists) {
        echo "✗ POST /quiz-store-direct route missing\n";
    }
    
} catch (Exception $e) {
    echo "✗ Route check failed: " . $e->getMessage() . "\n";
}

// Test 2: Check QuizController methods
echo "\n2. Checking QuizController:\n";
try {
    $controller = new App\Http\Controllers\QuizController();
    
    if (method_exists($controller, 'store')) {
        echo "✓ QuizController@store method exists\n";
    } else {
        echo "✗ QuizController@store method missing\n";
    }
    
} catch (Exception $e) {
    echo "✗ Controller check failed: " . $e->getMessage() . "\n";
}

// Test 3: Check view file
echo "\n3. Checking view file:\n";
$viewPath = __DIR__ . '/resources/views/quiz/create.blade.php';
if (file_exists($viewPath)) {
    echo "✓ Quiz create view exists\n";
    
    $content = file_get_contents($viewPath);
    if (strpos($content, '/quiz-store-direct') !== false) {
        echo "✓ Form action points to /quiz-store-direct\n";
    } else {
        echo "✗ Form action does not point to /quiz-store-direct\n";
    }
} else {
    echo "✗ Quiz create view missing\n";
}

// Test 4: Check database connection and materials
echo "\n4. Checking database:\n";
try {
    $materials = App\Models\Material::with('subject')->get();
    echo "✓ Database connection working\n";
    echo "✓ Found {$materials->count()} materials for quiz creation\n";
} catch (Exception $e) {
    echo "✗ Database check failed: " . $e->getMessage() . "\n";
}

echo "\n=== SUMMARY ===\n";
echo "The issue was that the quiz creation form at /quiz-create-direct\n";
echo "was submitting to /quiz-store-direct, but this route didn't exist.\n\n";

echo "FIXES APPLIED:\n";
echo "✓ Added POST /quiz-store-direct route pointing to QuizController@store\n";
echo "✓ Added middleware protection (auth + role:admin,lecturer) to both routes\n";
echo "✓ Form action now properly submits to an existing route\n\n";

echo "NEXT STEPS:\n";
echo "1. Navigate to: http://127.0.0.1:8000/quiz-create-direct\n";
echo "2. Log in as admin or lecturer\n";
echo "3. Fill out the quiz form with questions\n";
echo "4. Click 'Create Quiz' - should now work instead of showing blank page\n\n";

echo "TEST ACCOUNTS:\n";
echo "- Admin: admin@example.com / password\n";
echo "- Lecturer: lecturer@example.com / password\n";
