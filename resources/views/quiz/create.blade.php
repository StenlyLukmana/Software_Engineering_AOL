@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <h1 class="mb-2 fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Create New Quiz
                    </h1>
                    <p class="mb-0 opacity-75">
                        Create an interactive quiz for your students
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('quiz.store') }}" method="POST" id="quiz-form">
        @csrf
        
        <!-- Quiz Details -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card card-custom">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-1"></i>Quiz Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Quiz Title *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="{{ old('title') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="material_id" class="form-label">Material *</label>
                                <select class="form-select" id="material_id" name="material_id" required>
                                    <option value="">Select Material</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                            {{ $material->subject->name }} - {{ $material->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                                <input type="number" class="form-control" id="time_limit" name="time_limit" 
                                       value="{{ old('time_limit') }}" min="1">
                                <small class="text-muted">Leave empty for no time limit</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="max_attempts" class="form-label">Maximum Attempts *</label>
                                <input type="number" class="form-control" id="max_attempts" name="max_attempts" 
                                       value="{{ old('max_attempts', 1) }}" min="1" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Section -->
        <div class="row">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-question-circle me-1"></i>Questions</h5>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion()">
                            <i class="fas fa-plus me-1"></i>Add Question
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="questions-container">
                            <!-- Questions will be added here dynamically -->
                        </div>
                        
                        <div class="alert alert-info" id="no-questions-alert">
                            <i class="fas fa-info-circle me-1"></i>
                            Click "Add Question" to start creating your quiz questions.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('quiz.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Create Quiz
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let questionCount = 0;

function addQuestion() {
    questionCount++;
    const container = document.getElementById('questions-container');
    const noQuestionsAlert = document.getElementById('no-questions-alert');
    
    if (noQuestionsAlert) {
        noQuestionsAlert.style.display = 'none';
    }
    
    const questionHtml = `
        <div class="question-item border rounded p-3 mb-3" id="question-${questionCount}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Question ${questionCount}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeQuestion(${questionCount})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Question Text *</label>
                    <textarea class="form-control" name="questions[${questionCount-1}][question]" rows="2" required></textarea>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Type *</label>
                    <select class="form-select" name="questions[${questionCount-1}][type]" onchange="updateQuestionType(this, ${questionCount})" required>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Points *</label>
                    <input type="number" class="form-control" name="questions[${questionCount-1}][points]" value="1" min="1" required>
                </div>
            </div>
            
            <div id="options-container-${questionCount}">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Option A</label>
                        <input type="text" class="form-control" name="questions[${questionCount-1}][options][]" placeholder="Option A">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Option B</label>
                        <input type="text" class="form-control" name="questions[${questionCount-1}][options][]" placeholder="Option B">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Option C</label>
                        <input type="text" class="form-control" name="questions[${questionCount-1}][options][]" placeholder="Option C">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Option D</label>
                        <input type="text" class="form-control" name="questions[${questionCount-1}][options][]" placeholder="Option D">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Correct Answer *</label>
                    <input type="text" class="form-control" name="questions[${questionCount-1}][correct_answer]" 
                           placeholder="Enter the correct answer" required>
                    <small class="text-muted">For multiple choice: enter the option letter (A, B, C, D)</small>
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
        
        // Check if any questions remain
        const container = document.getElementById('questions-container');
        const noQuestionsAlert = document.getElementById('no-questions-alert');
        
        if (container.children.length === 0 && noQuestionsAlert) {
            noQuestionsAlert.style.display = 'block';
        }
    }
}

function updateQuestionType(selectElement, questionId) {
    const optionsContainer = document.getElementById(`options-container-${questionId}`);
    const questionIndex = questionId - 1;
    
    if (selectElement.value === 'multiple_choice') {
        optionsContainer.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Option A</label>
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option A">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Option B</label>
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option B">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Option C</label>
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option C">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Option D</label>
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option D">
                </div>
            </div>
        `;
    } else {
        optionsContainer.innerHTML = '';
    }
}

// Add first question by default
document.addEventListener('DOMContentLoaded', function() {
    addQuestion();
});
</script>

@endsection
