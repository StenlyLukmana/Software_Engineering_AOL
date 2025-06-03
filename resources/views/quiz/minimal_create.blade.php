@extends('layouts.main')

@section('container')
<div class="container mt-4">
    <h1>Minimal Quiz Creation Form</h1>
    
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Quiz Title *</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="material_id" class="form-label">Material *</label>
            <select class="form-select" id="material_id" name="material_id" required>
                <option value="">Select Material</option>
                @foreach($materials as $material)
                    <option value="{{ $material->id }}">
                        {{ $material->subject->name }} - {{ $material->title }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                <input type="number" class="form-control" id="time_limit" name="time_limit" min="1">
            </div>
            <div class="col-md-6 mb-3">
                <label for="max_attempts" class="form-label">Maximum Attempts *</label>
                <input type="number" class="form-control" id="max_attempts" name="max_attempts" value="1" min="1" required>
            </div>
        </div>
        
        <h2>Questions</h2>
        <div id="questions-container">
            <div class="card mb-3 p-3">
                <div class="mb-3">
                    <label class="form-label">Question Text *</label>
                    <textarea class="form-control" name="questions[0][question]" rows="2" required></textarea>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Question Type *</label>
                        <select class="form-select" name="questions[0][type]" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="true_false">True/False</option>
                            <option value="text">Text Answer</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Points *</label>
                        <input type="number" class="form-control" name="questions[0][points]" value="1" min="1" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Correct Answer *</label>
                    <input type="text" class="form-control" name="questions[0][correct_answer]" required>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <button type="submit" class="btn btn-success">Create Quiz</button>
            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
