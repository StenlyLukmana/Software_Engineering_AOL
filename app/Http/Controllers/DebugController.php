<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function testQuizCreate()
    {
        // Print auth information
        $user = Auth::user();
        $isLoggedIn = Auth::check();
        $userRole = $user ? $user->role : 'Not logged in';
        $canManage = $user ? $user->canManageContent() : false;
        
        echo "<h1>Auth Debug Information</h1>";
        echo "<ul>";
        echo "<li>User Logged In: " . ($isLoggedIn ? 'Yes' : 'No') . "</li>";
        echo "<li>User: " . ($user ? $user->name : 'None') . "</li>";
        echo "<li>Role: " . $userRole . "</li>";
        echo "<li>Can Manage Content: " . ($canManage ? 'Yes' : 'No') . "</li>";
        echo "</ul>";
        
        // Try to get materials
        try {
            $materials = Material::with('subject')->get();
            echo "<h2>Materials Found: " . count($materials) . "</h2>";
        } catch (\Exception $e) {
            echo "<h2>Error Getting Materials:</h2>";
            echo "<pre>" . $e->getMessage() . "</pre>";
        }
        
        // Check for view file
        $viewPath = resource_path('views/quiz/create.blade.php');
        echo "<h2>Checking View File</h2>";
        echo "<p>View Path: " . $viewPath . "</p>";
        echo "<p>View Exists: " . (file_exists($viewPath) ? 'Yes' : 'No') . "</p>";
        
        // Try to render the view
        try {
            $html = view('quiz.create', compact('materials'))->render();
            echo "<h2>View Rendered Successfully</h2>";
            echo "<p>Length: " . strlen($html) . " characters</p>";
        } catch (\Exception $e) {
            echo "<h2>Error Rendering View:</h2>";
            echo "<pre>" . $e->getMessage() . "</pre>";
        }
    }
}
