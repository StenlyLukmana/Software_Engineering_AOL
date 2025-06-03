<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuizSimpleController extends Controller
{
    public function create()
    {
        try {
            // Check auth
            if (!Auth::check()) {
                Log::error('Quiz creation attempted without authentication');
                return redirect()->route('login')->with('error', 'You must be logged in to create quizzes.');
            }
            
            // Check role
            $user = Auth::user();
            if (!in_array($user->role, ['admin', 'lecturer'])) {
                Log::error('Quiz creation attempted by unauthorized user: ' . $user->name . ' (Role: ' . $user->role . ')');
                return redirect()->route('dashboard')->with('error', 'You do not have permission to create quizzes.');
            }
            
            // Check for materials
            $materials = Material::with('subject')->get();
            if ($materials->isEmpty()) {
                Log::warning('No materials found when attempting to create quiz');
                return redirect()->route('dashboard')->with('warning', 'No materials available to create a quiz. Please create some materials first.');
            }
            
            // Log and return view
            Log::info('Quiz creation page accessed by: ' . $user->name . ' (' . $user->role . ')');
            
            // Return the simplified view for debug purposes
            return view('quiz.create_basic', compact('materials'));
            
        } catch (\Exception $e) {
            Log::error('Error in quiz creation page: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return view('errors.generic', [
                'title' => 'Error Loading Quiz Creation',
                'message' => 'An error occurred while loading the quiz creation page.',
                'details' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
