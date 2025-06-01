<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MaterialController;

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
    return view('welcome');
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

Route::get('/create-subject', [SubjectController::class, 'createPage']);
Route::POST('/create-subject', [SubjectController::class, 'store']);
Route::get('/view-subjects', [SubjectController::class, 'view']);

Route::get('/view/{subjectID}', [MaterialController::class, 'viewSubjectMaterials']);
Route::get('/create-material/{subjectID}', [MaterialController::class, 'createPage']);
Route::post('/create-material', [MaterialController::class, 'store']);
Route::get('/view/{subjectID}/{materialID}', [MaterialController::class, 'view']);