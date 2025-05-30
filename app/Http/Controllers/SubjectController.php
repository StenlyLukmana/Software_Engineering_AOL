<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    public function createSubjectPage(){
        return view('createSubject', ['title' => 'Create Subject']);
    }

    public function createSubject(Request $request){
        Subject::create([
            'name' => $request->name,
        ]);
        return redirect('/');
    }

}
