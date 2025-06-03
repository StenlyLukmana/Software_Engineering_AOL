<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizAttemptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Course detail routes
Route::get('/course/{course}', [App\Http\Controllers\CourseController::class, 'showCourse'])->name('course.detail');

// Temporary debug route
Route::get('/debug/quiz-create', function () {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.create_clean', compact('materials'));
});

// Test quiz create without auth - TEMPORARY
Route::get('/test-quiz-create', function () {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.diagnostic', compact('materials'));
});

// Quick login test
Route::get('/login-test', function () {
    return view('login_test');
});

// Quiz access verification page
Route::get('/quiz-access-test', function () {
    return view('quiz_access_test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Public routes - accessible by all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/view-subjects', [SubjectController::class, 'view'])->name('subjects.index');
    Route::get('/view/{subjectID}', [MaterialController::class, 'viewSubjectMaterials'])->name('subjects.materials');
    Route::get('/view/{subjectID}/{materialID}', [MaterialController::class, 'view'])->name('materials.show');
    
    // Quiz routes for students
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz', function () {
        return redirect()->route('quiz.index');
    }); // Redirect /quiz to /quizzes
    Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{quiz}/start', [QuizAttemptController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/{quiz}/attempt/{attempt}', [QuizAttemptController::class, 'take'])->name('quiz.take');
    Route::post('/quiz/{quiz}/attempt/{attempt}/submit', [QuizAttemptController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/{quiz}/attempt/{attempt}/result', [QuizAttemptController::class, 'result'])->name('quiz.result');
});

// Admin and Lecturer routes - content management
Route::middleware(['auth', 'role:admin,lecturer'])->group(function () {
    Route::get('/create-subject', [SubjectController::class, 'createPage'])->name('subjects.create');
    Route::post('/create-subject', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    Route::get('/create-material/{subjectID}', [MaterialController::class, 'createPage'])->name('materials.create');
    Route::post('/create-material', [MaterialController::class, 'store'])->name('materials.store');
    
    // Material management routes - FIXED WORKING ROUTES
    Route::get('/edit-material/{subjectID}/{materialID}', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/update-material/{subjectID}/{materialID}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/delete-material/{subjectID}/{materialID}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    
    // Quiz management routes
    Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store'); // Use consistent naming
    Route::get('/quiz/{quiz}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
    Route::delete('/quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');
});

// Admin only routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

// Direct access to basic quiz creation without middleware
Route::get('/quiz-create-basic', function() {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.create_basic', compact('materials'));
})->name('quiz.create.basic');

// Direct access debug routes without middleware
Route::get('/quiz-debug-direct', function() {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.create_debug', compact('materials'));
})->name('quiz.debug.direct');

// Debug routes
Route::get('/debug/quiz-create', [App\Http\Controllers\DebugController::class, 'testQuizCreate'])->name('debug.quiz.create');

// Test SimpleQuizController without authentication middleware
Route::get('/quiz/simple/create', [App\Http\Controllers\SimpleQuizController::class, 'create'])->name('quiz.simple.create');

// Simple test route for quiz creation 
Route::get('/quiz-create-simple', function() {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.create_simple', compact('materials'));
})->name('quiz.create.simple');

// Direct test route for quiz creation (for debugging)
Route::get('/quiz-create-direct', function() {
    try {
        $materials = App\Models\Material::with('subject')->get();
        return view('quiz.create', compact('materials'));
    } catch (Exception $e) {
        return response("Error: " . $e->getMessage(), 500);
    }
})->name('quiz.create.direct');

// Simple layout test
Route::get('/simple-layout-test', function () {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.simple_layout_test', compact('materials'));
});

// Simplified quiz controller with explicit error handling
Route::get('/quiz-simple', [App\Http\Controllers\QuizSimpleController::class, 'create'])->name('quiz.simple');

// Authentication debug route
Route::get('/auth-debug', function() {
    echo "<h1>Authentication Debug</h1>";
    if (auth()->check()) {
        echo "<p>Logged in as: " . auth()->user()->name . "</p>";
        echo "<p>Role: " . auth()->user()->role . "</p>";
        echo "<p>Can manage content: " . (auth()->user()->canManageContent() ? 'Yes' : 'No') . "</p>";
        echo "<p>Is Admin: " . (auth()->user()->isAdmin() ? 'Yes' : 'No') . "</p>";
        echo "<hr>";
        echo "<p><a href='/quiz/create'>Try accessing /quiz/create</a></p>";
    } else {
        echo "<p>Not logged in</p>";
        echo "<p><a href='/login'>Login</a></p>";
    }
})->name('auth.debug');

// Diagnostic route for quiz creation
Route::get('/quiz-diagnostic', function() {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.diagnostic_quiz_create', compact('materials'));
})->name('quiz.diagnostic');

// Minimal quiz creation route
Route::get('/quiz-create-minimal', function() {
    $materials = App\Models\Material::with('subject')->get();
    return view('quiz.minimal_create', compact('materials'));
})->name('quiz.create.minimal');

// Test route for quiz create view without authentication
Route::get('/quiz-create-test', function() {
    try {
        $materials = App\Models\Material::with('subject')->get();
        return view('quiz.create', compact('materials'));
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('quiz.create.test');