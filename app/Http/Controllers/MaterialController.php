<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    
    public function createPage($subjectID){
        $title = 'Add Material';
        $subject = Subject::find($subjectID);
        return view('createMaterial', compact('title', 'subject'));
    }

    public function store(Request $request){

        $fileName = null;

        if ($request->hasFile('media')) {
            $extension = $request->file('media')->getClientOriginalExtension();
            $fileName = $request->title . '.' . $extension;
            $request->file('media')->storeAs('public/media/', $fileName);
        }

        Material::create([
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'content' => $request->content,
            'media' => $fileName,
        ]);
        return redirect("/view/{$request->subject_id}")->with('success', 'Material added successfully!');
    }

    public function viewSubjectMaterials($subjectId){
        $title = 'View Subject Materials';
        $subject = Subject::with('materials')->findOrFail($subjectId);
        return view('viewSubjectMaterials', compact('title', 'subject'));
    }

    public function view($subjectID, $materialID){
        $title = 'Material';
        $material = Material::where('subject_id', $subjectID)->where('id', $materialID)->firstOrFail();
        return view('viewMaterial', compact('title', 'material'));
    }

}
