<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    
    public function createPage($subjectID){
        $title = 'Add Learning Material';
        $subject = Subject::findOrFail($subjectID);
        return view('createMaterial', compact('title', 'subject'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm,ogg,pdf,doc,docx,ppt,pptx|max:20480', // 20MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = null;

        if ($request->hasFile('media')) {
            $extension = $request->file('media')->getClientOriginalExtension();
            $fileName = Str::slug($request->title) . '_' . time() . '.' . $extension;
            $request->file('media')->storeAs('public/media/', $fileName);
        }

        Material::create([
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'content' => $request->content,
            'media' => $fileName,
        ]);

        return redirect()->route('subjects.materials', $request->subject_id)
            ->with('success', 'Learning material added successfully!');
    }

    public function viewSubjectMaterials($subjectId){
        $title = 'Subject Materials';
        $subject = Subject::with(['materials' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($subjectId);
        return view('viewSubjectMaterials', compact('title', 'subject'));
    }

    public function view($subjectID, $materialID){
        $title = 'Learning Material';
        $material = Material::with('subject')
            ->where('subject_id', $subjectID)
            ->where('id', $materialID)
            ->firstOrFail();
        return view('viewMaterial', compact('title', 'material'));
    }

}
