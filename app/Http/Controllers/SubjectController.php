<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    
    public function createPage(){
        $title = 'Create Subject';
        return view('createSubject', compact('title'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Subject::create([
            'name' => $request->name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }

    public function view(){
        $title = 'Computer Science Subjects';
        $subjects = Subject::withCount('materials')->orderBy('name')->get();
        return view('viewSubjects', compact('title', 'subjects'));
    }

    public function edit(Subject $subject){
        $title = 'Edit Subject';
        return view('editSubject', compact('title', 'subject'));
    }

    public function update(Request $request, Subject $subject){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject->update([
            'name' => $request->name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject){
        // Check if subject has materials
        if ($subject->materials()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete subject with existing materials. Please delete all materials first.');
        }

        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }

}
