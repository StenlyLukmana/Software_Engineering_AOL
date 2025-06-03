<?php

// Direct test of quiz creation view rendering
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Boot the application
$app->boot();

try {
    // Test view rendering
    $materials = App\Models\Material::with('subject')->get();
    $viewContent = view('quiz.create', compact('materials'))->render();
    echo "SUCCESS: View rendered successfully!\n";
    echo "Content length: " . strlen($viewContent) . " characters\n";
    
    // Check if the content has the expected elements
    if (strpos($viewContent, 'Create New Quiz') !== false) {
        echo "✓ Title found\n";
    } else {
        echo "✗ Title not found\n";
    }
    
    if (strpos($viewContent, 'questions-container') !== false) {
        echo "✓ Questions container found\n";
    } else {
        echo "✗ Questions container not found\n";
    }
    
    if (strpos($viewContent, 'addQuestion') !== false) {
        echo "✓ JavaScript function found\n";
    } else {
        echo "✗ JavaScript function not found\n";
    }
    
} catch (Exception $e) {
    echo "ERROR rendering view: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
