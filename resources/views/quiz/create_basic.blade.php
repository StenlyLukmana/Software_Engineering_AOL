@extends('layouts.main')

@section('container')
<div class="container mt-4">
    <h1>Create New Quiz - Basic Version</h1>
    
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quiz Details</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Quiz Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-md-6">
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
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                Questions
                <button type="button" class="btn btn-sm btn-primary float-end" id="add-question-btn">Add Question</button>
            </div>
            <div class="card-body">
                <div id="questions-container">
                    <!-- Questions will be added here -->
                </div>
                
                <div id="no-questions-alert" class="alert alert-info">
                    Click "Add Question" to start creating your quiz questions.
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Create Quiz</button>
        </div>
    </form>
</div>

<script>
// Very basic script - just essentials to make the form function
let questionCount = 0;

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-question-btn').addEventListener('click', addQuestion);
});

function addQuestion() {
    questionCount++;
    const container = document.getElementById('questions-container');
    document.getElementById('no-questions-alert').style.display = 'none';
    
    const questionDiv = document.createElement('div');
    questionDiv.className = 'card mb-3';
    questionDiv.id = `question-${questionCount}`;
    
    questionDiv.innerHTML = `
        <div class="card-header d-flex justify-content-between align-items-center">
            Question ${questionCount}
            <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(${questionCount})">Remove</button>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Question Text *</label>
                <textarea class="form-control" name="questions[${questionCount}][question]" rows="2" required></textarea>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Question Type *</label>
                    <select class="form-select" name="questions[${questionCount}][type]" required>
                        <option value="">Select Type</option>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Points *</label>
                    <input type="number" class="form-control" name="questions[${questionCount}][points]" value="1" min="1" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Correct Answer *</label>
                <input type="text" class="form-control" name="questions[${questionCount}][correct_answer]" required>
            </div>
        </div>
    `;
    
    container.appendChild(questionDiv);
}

function removeQuestion(id) {
    document.getElementById(`question-${id}`).remove();
    
    if (document.getElementById('questions-container').children.length === 0) {
        document.getElementById('no-questions-alert').style.display = 'block';
    }
}
</script>
@endsection
