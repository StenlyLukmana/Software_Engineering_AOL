@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Quiz Creation Debug Page</h1>
            
            <!-- Debug Information -->
            <div class="alert alert-info">
                <h5>Debug Information:</h5>
                <p><strong>Current User:</strong> {{ auth()->user()->name ?? 'Not logged in' }}</p>
                <p><strong>User Role:</strong> {{ auth()->user()->role ?? 'N/A' }}</p>
                <p><strong>Can Manage Content:</strong> {{ auth()->user()->canManageContent() ? 'Yes' : 'No' }}</p>
                <p><strong>Materials Count:</strong> {{ isset($materials) ? count($materials) : 'Materials variable not set' }}</p>
                <p><strong>Route:</strong> {{ request()->url() }}</p>
            </div>

            @if(isset($materials) && count($materials) > 0)
                <div class="alert alert-success">
                    <h5>Available Materials:</h5>
                    <ul>
                        @foreach($materials->take(5) as $material)
                            <li>{{ $material->title }} (Subject: {{ $material->subject->name }})</li>
                        @endforeach
                        @if(count($materials) > 5)
                            <li>... and {{ count($materials) - 5 }} more</li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="alert alert-warning">
                    <h5>No Materials Found</h5>
                    <p>No materials are available in the database. Please create some materials first.</p>
                </div>
            @endif

            <!-- Simple Form -->
            <div class="card">
                <div class="card-header">
                    <h5>Create New Quiz</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('quiz.store') }}" method="POST" id="quiz-form">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Quiz Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="material_id" class="form-label">Material *</label>
                                <select class="form-select" id="material_id" name="material_id" required>
                                    <option value="">Select Material</option>
                                    @if(isset($materials))
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}">
                                                {{ $material->subject->name }} - {{ $material->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="max_attempts" class="form-label">Maximum Attempts *</label>
                                <input type="number" class="form-control" id="max_attempts" name="max_attempts" value="1" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                                <input type="number" class="form-control" id="time_limit" name="time_limit" min="1">
                            </div>
                        </div>

                        <!-- Question Section -->
                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6>Questions</h6>
                                <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion()">Add Question</button>
                            </div>
                            <div class="card-body">
                                <div id="questions-container"></div>
                                <div class="alert alert-info" id="no-questions-alert">
                                    Click "Add Question" to start creating your quiz questions.
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Create Quiz</button>
                            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let questionCount = 0;

function addQuestion() {
    const container = document.getElementById('questions-container');
    const noQuestionsAlert = document.getElementById('no-questions-alert');
    
    if (!container) {
        alert("Questions container not found!");
        return;
    }
    
    if (noQuestionsAlert) {
        noQuestionsAlert.style.display = 'none';
    }
    
    questionCount++;
    
    const questionHtml = `
        <div class="border rounded p-3 mb-3" id="question-${questionCount}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Question ${questionCount}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeQuestion(${questionCount})">Remove</button>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Question Text *</label>
                <textarea class="form-control" name="questions[${questionCount-1}][question]" rows="2" required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type *</label>
                    <select class="form-select" name="questions[${questionCount-1}][type]" required>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Points *</label>
                    <input type="number" class="form-control" name="questions[${questionCount-1}][points]" value="1" min="1" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Correct Answer *</label>
                    <input type="text" class="form-control" name="questions[${questionCount-1}][correct_answer]" required>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', questionHtml);
}

function removeQuestion(questionId) {
    const element = document.getElementById(`question-${questionId}`);
    if (element) {
        element.remove();
        
        const container = document.getElementById('questions-container');
        const noQuestionsAlert = document.getElementById('no-questions-alert');
        
        if (container && container.children.length === 0 && noQuestionsAlert) {
            noQuestionsAlert.style.display = 'block';
        }
    }
}

// Add a question by default
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        addQuestion();
    }, 500);
});
</script>

@endsection
