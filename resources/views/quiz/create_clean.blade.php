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
                    <p class="mb-0 opacity-75">Create an interactive quiz for your students</p>
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
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Create Quiz
                            </button>
                        </div>
                    </div>
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
        <div class="card mb-3 question-item" id="question-${questionCount}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Question ${questionCount}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeQuestion(${questionCount})">
                    <i class="fas fa-trash me-1"></i>Remove
                </button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Question Text *</label>
                    <textarea class="form-control" name="questions[${questionCount}][question]" rows="2" required></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Question Type *</label>
                        <select class="form-select" name="questions[${questionCount}][type]" onchange="updateQuestionOptions(${questionCount})" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="true_false">True/False</option>
                            <option value="text">Text Answer</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Points *</label>
                        <input type="number" class="form-control" name="questions[${questionCount}][points]" value="1" min="1" required>
                    </div>
                </div>
                
                <div id="question-options-${questionCount}">
                    <!-- Options will be generated based on question type -->
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Correct Answer *</label>
                    <input type="text" class="form-control" name="questions[${questionCount}][correct_answer]" required>
                    <small class="text-muted">Enter the exact answer as it should match</small>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', questionHtml);
    updateQuestionOptions(questionCount);
}

function removeQuestion(questionId) {
    const questionElement = document.getElementById(`question-${questionId}`);
    if (questionElement) {
        questionElement.remove();
    }
    
    const remainingQuestions = document.querySelectorAll('.question-item');
    if (remainingQuestions.length === 0) {
        document.getElementById('no-questions-alert').style.display = 'block';
    }
}

function updateQuestionOptions(questionId) {
    const typeSelect = document.querySelector(`select[name="questions[${questionId}][type]"]`);
    const optionsContainer = document.getElementById(`question-options-${questionId}`);
    
    if (!typeSelect || !optionsContainer) return;
    
    if (typeSelect.value === 'multiple_choice') {
        optionsContainer.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Answer Options (one per line)</label>
                <textarea class="form-control" name="questions[${questionId}][options]" rows="4" 
                          placeholder="Option A&#10;Option B&#10;Option C&#10;Option D"></textarea>
                <small class="text-muted">Enter the correct answer exactly as it appears in the options above</small>
            </div>
        `;
    } else if (typeSelect.value === 'true_false') {
        optionsContainer.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Select Correct Answer</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tf_answer_${questionId}" value="True" 
                           onchange="document.querySelector('input[name=\\'questions[${questionId}][correct_answer]\\']').value = 'True'">
                    <label class="form-check-label">True</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tf_answer_${questionId}" value="False"
                           onchange="document.querySelector('input[name=\\'questions[${questionId}][correct_answer]\\']').value = 'False'">
                    <label class="form-check-label">False</label>
                </div>
            </div>
        `;
    } else {
        optionsContainer.innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                For text questions, enter the exact text answer students should provide.
            </div>
        `;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log("Quiz form initialized");
    
    // Add first question automatically
    setTimeout(function() {
        addQuestion();
    }, 500);
    
    // Form validation
    const form = document.getElementById('quiz-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const questions = document.querySelectorAll('.question-item');
            if (questions.length === 0) {
                e.preventDefault();
                alert('Please add at least one question to your quiz.');
                addQuestion();
                return false;
            }
            
            // Validate each question
            let isValid = true;
            questions.forEach(function(question, index) {
                const questionText = question.querySelector('textarea[name*="[question]"]');
                const correctAnswer = question.querySelector('input[name*="[correct_answer]"]');
                
                if (!questionText.value.trim()) {
                    alert(`Please enter text for Question ${index + 1}`);
                    questionText.focus();
                    isValid = false;
                    return;
                }
                
                if (!correctAnswer.value.trim()) {
                    alert(`Please enter the correct answer for Question ${index + 1}`);
                    correctAnswer.focus();
                    isValid = false;
                    return;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    }
});
</script>
@endsection
