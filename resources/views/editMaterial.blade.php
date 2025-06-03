@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <h1 class="mb-2 fw-bold">
                        <i class="fas fa-edit me-2"></i>Edit Material
                    </h1>
                    <p class="mb-0 opacity-75">Update the material content and information</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('subject.index') }}">Subjects</a></li>
            <li class="breadcrumb-item"><a href="{{ route('subject.show', $material->subject_id) }}">{{ $material->subject->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Material</li>
        </ol>
    </nav>

    <form action="{{ route('materials.update', [$material->subject_id, $material->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Material Details -->
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-1"></i>Material Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $material->title) }}" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $material->content) }}</textarea>
                            @error('content')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Current Media -->
                @if($material->media_path)
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-file me-1"></i>Current Media</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-file-alt text-primary me-2" style="font-size: 1.5rem;"></i>
                            <div>
                                <div class="fw-bold">{{ basename($material->media_path) }}</div>
                                <small class="text-muted">Current file</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $material->media_path) }}" 
                           class="btn btn-outline-primary btn-sm" target="_blank">
                            <i class="fas fa-eye me-1"></i>View Current File
                        </a>
                    </div>
                </div>
                @endif
                
                <!-- New Media Upload -->
                <div class="card card-custom mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-upload me-1"></i>{{ $material->media_path ? 'Replace Media' : 'Add Media' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="media" class="form-label">{{ $material->media_path ? 'New Media File' : 'Media File' }}</label>
                            <input type="file" class="form-control" id="media" name="media" 
                                   accept=".pdf,.doc,.docx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.mp4,.avi,.mov">
                            <small class="text-muted">
                                Supported formats: PDF, DOC, DOCX, PPT, PPTX, TXT, Images, Videos<br>
                                {{ $material->media_path ? 'Leave empty to keep current file' : 'Optional' }}
                            </small>
                            @error('media')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Update Material
                            </button>
                            <a href="{{ route('subject.show', $material->subject_id) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to Subject
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Include rich text editor if needed -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-resize textarea
    const textarea = document.getElementById('content');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }
});
</script>
@endsection