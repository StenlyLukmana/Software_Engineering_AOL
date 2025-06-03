@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <!-- Test if basic rendering works -->
    <div class="row mb-4">
        <div class="col-12">
            <h1>Create New Quiz - Working Version</h1>
            <div class="alert alert-success">
                This is a test to confirm the view is loading properly.
            </div>
        </div>
    </div>

    <!-- Basic Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Quiz Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('quiz.store') }}" method="POST" id="quiz-form">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Quiz Title *</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="material_id" class="form-label">Material *</label>
                            <select class="form-select" id="material_id" name="material_id" required>
                                <option value="">Select Material</option>
                                @if(isset($materials) && count($materials) > 0)
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}">
                                            {{ $material->subject->name ?? 'No Subject' }} - {{ $material->title }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No materials available</option>
                                @endif
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="max_attempts" class="form-label">Maximum Attempts</label>
                            <input type="number" class="form-control" id="max_attempts" name="max_attempts" value="3" min="1">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Quiz (Basic)</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Debug Info</h5>
                </div>
                <div class="card-body">
                    <p><strong>Materials Count:</strong> {{ isset($materials) ? count($materials) : 'Not set' }}</p>
                    <p><strong>User:</strong> {{ Auth::user()->name ?? 'Not logged in' }}</p>
                    <p><strong>User Role:</strong> {{ Auth::user()->role ?? 'No role' }}</p>
                    <p><strong>Can Manage:</strong> {{ Auth::user()->canManageContent() ? 'Yes' : 'No' }}</p>
                    
                    @if(isset($materials) && count($materials) > 0)
                        <h6>Available Materials:</h6>
                        <ul class="small">
                            @foreach($materials->take(5) as $material)
                                <li>{{ $material->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
