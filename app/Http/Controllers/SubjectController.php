<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    public function createPage(){
        $title = 'Create Subject';
        return view('createSubject', compact('title'));
    }

    public function store(Request $request){
        Subject::create([
            'name' => $request->name,
        ]);
        return redirect('/');
    }

    public function view(){
        $title = 'View Subjects';
        $subjects = Subject::all();
        return view('viewSubjects', compact('title', 'subjects'));
    }

}
