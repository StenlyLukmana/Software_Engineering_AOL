<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

echo "=== CS Learning Platform - Functionality Test ===\n\n";

// Check database connection
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    echo "✅ Database connection: SUCCESS\n";
} catch (Exception $e) {
    echo "❌ Database connection: FAILED - " . $e->getMessage() . "\n";
    exit(1);
}

// Check users
echo "\n--- Users ---\n";
$users = App\Models\User::select('name', 'email', 'role')->get();
foreach ($users as $user) {
    echo "- {$user->name} ({$user->email}) - Role: {$user->role}\n";
}

// Check subjects
echo "\n--- Subjects ---\n";
$subjects = App\Models\Subject::all();
foreach ($subjects as $subject) {
    echo "- ID: {$subject->id}, Name: {$subject->name}\n";
}

// Check materials
echo "\n--- Materials ---\n";
$materials = App\Models\Material::with('subject')->take(5)->get();
foreach ($materials as $material) {
    echo "- ID: {$material->id}, Title: {$material->title}, Subject: {$material->subject->name}\n";
}

// Check quizzes
echo "\n--- Quizzes ---\n";
$quizzes = App\Models\Quiz::with('material.subject')->get();
foreach ($quizzes as $quiz) {
    echo "- ID: {$quiz->id}, Title: {$quiz->title}, Material: {$quiz->material->title}\n";
}

// Test route resolution
echo "\n--- Route Tests ---\n";

// Test material routes
try {
    $materialEditUrl = route('materials.edit', [1, 1]);
    echo "✅ Material edit route: {$materialEditUrl}\n";
} catch (Exception $e) {
    echo "❌ Material edit route: FAILED - " . $e->getMessage() . "\n";
}

try {
    $quizCreateUrl = route('quiz.create');
    echo "✅ Quiz create route: {$quizCreateUrl}\n";
} catch (Exception $e) {
    echo "❌ Quiz create route: FAILED - " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";
