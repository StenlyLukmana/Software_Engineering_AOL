@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('quiz.show', $quiz) }}" class="btn btn-outline-light btn-sm me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="mb-2 fw-bold">
                                <i class="fas fa-edit me-2"></i>Edit Quiz
                            </h1>
                            <p class="mb-0 opacity-75">
                                Update quiz settings and status
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('quiz.update', $quiz) }}" method="POST">
        @csrf
        @method('PUT')
        
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
                                       value="{{ old('title', $quiz->title) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="material_id" class="form-label">Material *</label>
                                <select class="form-select" id="material_id" name="material_id" required>
                                    <option value="">Select Material</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}" 
                                                {{ old('material_id', $quiz->material_id) == $material->id ? 'selected' : '' }}>
                                            {{ $material->subject->name }} - {{ $material->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $quiz->description) }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                                <input type="number" class="form-control" id="time_limit" name="time_limit" 
                                       value="{{ old('time_limit', $quiz->time_limit) }}" min="1">
                                <small class="text-muted">Leave empty for no time limit</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="max_attempts" class="form-label">Maximum Attempts *</label>
                                <input type="number" class="form-control" id="max_attempts" name="max_attempts" 
                                       value="{{ old('max_attempts', $quiz->max_attempts) }}" min="1" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="is_active" class="form-label">Status</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $quiz->is_active) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !old('is_active', $quiz->is_active) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quiz Statistics -->
            <div class="col-lg-4">
                <div class="card card-custom">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-1"></i>Quiz Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-question-circle fa-2x text-primary mb-2"></i>
                                    <h6 class="mb-0">{{ $quiz->questions->count() }}</h6>
                                    <small class="text-muted">Questions</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-users fa-2x text-info mb-2"></i>
                                    <h6 class="mb-0">{{ $quiz->attempts()->distinct('user_id')->count() }}</h6>
                                    <small class="text-muted">Students</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-clipboard-check fa-2x text-success mb-2"></i>
                                    <h6 class="mb-0">{{ $quiz->attempts()->count() }}</h6>
                                    <small class="text-muted">Total Attempts</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                    <h6 class="mb-0">
                                        {{ $quiz->attempts()->whereNotNull('completed_at')->count() > 0 
                                           ? round($quiz->attempts()->whereNotNull('completed_at')->avg(\DB::raw('(score / total_points) * 100'))) 
                                           : 0 }}%
                                    </h6>
                                    <small class="text-muted">Avg Score</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Preview -->
        <div class="row">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list me-1"></i>Questions ({{ $quiz->questions->count() }})</h5>
                        <small class="text-muted">Questions cannot be edited after creation</small>
                    </div>
                    <div class="card-body">
                        @if($quiz->questions->count() > 0)
                            @foreach($quiz->questions as $index => $question)
                                <div class="border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h6 class="fw-bold">Question {{ $index + 1 }}</h6>
                                        <span class="badge bg-primary">{{ $question->points }} points</span>
                                    </div>
                                    <p class="mb-2">{{ $question->question }}</p>
                                    
                                    @if($question->type === 'multiple_choice' && $question->options)
                                        <div class="row">
                                            @foreach($question->options as $optIndex => $option)
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge {{ $question->correct_answer === chr(65 + $optIndex) ? 'bg-success' : 'bg-light text-dark' }} me-1">
                                                        {{ chr(65 + $optIndex) }}
                                                    </span>
                                                    {{ $option }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <div class="mt-2">
                                        <small class="text-success">
                                            <i class="fas fa-check me-1"></i>
                                            Correct Answer: {{ $question->correct_answer }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">No Questions Added</h6>
                                <p class="text-muted">This quiz doesn't have any questions yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('quiz.show', $quiz) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update Quiz
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
