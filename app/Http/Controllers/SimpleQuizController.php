<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimpleQuizController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $userInfo = [
            'is_logged_in' => Auth::check(),
            'name' => $user ? $user->name : 'Not logged in',
            'email' => $user ? $user->email : 'N/A',
            'role' => $user ? $user->role : 'None',
            'can_manage_content' => $user ? $user->canManageContent() : false,
        ];
        
        // Skip authorization
        $materials = Material::with('subject')->get();
        
        return view('quiz.simple_create', compact('materials', 'userInfo'));
    }
}
