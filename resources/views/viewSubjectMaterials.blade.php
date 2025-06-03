@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Subject Header -->
        <div class="card card-custom mb-4" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1 fw-bold">
                            <i class="fas fa-book-open me-2"></i>{{ $subject->name }}
                        </h2>
                        <p class="mb-0 opacity-75">
                            <i class="fas fa-graduation-cap me-2"></i>Computer Science Learning Materials
                        </p>
                    </div>
                    @if(auth()->user()->canManageContent())
                        <a href="{{ route('materials.create', $subject->id) }}" class="btn btn-primary-custom">
                            <i class="fas fa-plus me-2"></i>Add Material
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Navigation Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('subjects.index') }}" style="color: var(--primary-blue);">
                        <i class="fas fa-home me-1"></i>Subjects
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $subject->name }}</li>
            </ol>
        </nav>

        <!-- Materials List -->
        <div class="card card-custom">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="fas fa-file-alt me-2"></i>Learning Materials</span>
                <span class="badge bg-light text-dark rounded-pill">{{ $subject->materials->count() }} Materials</span>
            </div>
            <div class="card-body p-0">
                @if($subject->materials->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 8%;">#</th>
                                    <th scope="col" style="width: 50%;">Material Title</th>
                                    <th scope="col" style="width: 15%;">Type</th>
                                    <th scope="col" style="width: 12%;">Added</th>
                                    <th scope="col" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subject->materials as $material)
                                <tr>
                                    <td class="align-middle">
                                        <span class="badge bg-light text-dark rounded-pill px-3">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="material-icon me-3" style="background: var(--light-cream); width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                @if($material->media)
                                                    @php
                                                        $extension = pathinfo($material->media, PATHINFO_EXTENSION);
                                                        $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                                    @endphp
                                                    @if($isVideo)
                                                        <i class="fas fa-play-circle" style="color: var(--primary-blue);"></i>
                                                    @elseif($isImage)
                                                        <i class="fas fa-image" style="color: var(--accent-yellow);"></i>
                                                    @else
                                                        <i class="fas fa-file" style="color: var(--primary-navy);"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-file-text" style="color: var(--primary-navy);"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold" style="color: var(--primary-navy);">{{ $material->title }}</h6>
                                                <small class="text-muted">{{ Str::limit($material->content, 60) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($material->media)
                                            @php
                                                $extension = pathinfo($material->media, PATHINFO_EXTENSION);
                                                $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                            @endphp
                                            @if($isVideo)
                                                <span class="badge" style="background: var(--primary-blue); color: white;">Video</span>
                                            @elseif($isImage)
                                                <span class="badge" style="background: var(--accent-yellow); color: var(--primary-navy);">Image</span>
                                            @else
                                                <span class="badge" style="background: var(--primary-navy); color: white;">File</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Text</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <small class="text-muted">{{ $material->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('materials.show', [$material->subject_id, $material->id]) }}" 
                                               class="btn btn-success-custom btn-sm" 
                                               title="View Material">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(auth()->user()->canManageContent())
                                                <a href="{{ route('materials.edit', [$material->subject_id, $material->id]) }}" 
                                                   class="btn btn-outline-primary btn-sm" 
                                                   title="Edit Material">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-outline-danger btn-sm" 
                                                        title="Delete Material"
                                                        onclick="confirmDeleteMaterial({{ $material->id }}, '{{ $material->title }}', {{ $material->subject_id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-file-alt" style="font-size: 4rem; color: var(--light-cream);"></i>
                        </div>
                        <h5 style="color: var(--primary-navy);">No Materials Available</h5>
                        <p class="text-muted">No learning materials have been added to this subject yet.</p>
                        @if(auth()->user()->canManageContent())
                            <a href="{{ route('materials.create', $subject->id) }}" class="btn btn-primary-custom">
                                <i class="fas fa-plus me-2"></i>Add First Material
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Material Confirmation Modal -->
<div class="modal fade" id="deleteMaterialModal" tabindex="-1" aria-labelledby="deleteMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMaterialModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>
                <p>Are you sure you want to delete the learning material <strong id="deleteMaterialName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This action cannot be undone. The material and any associated media files will be permanently deleted.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteMaterialForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Material
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDeleteMaterial(materialId, materialTitle, subjectId) {
    document.getElementById('deleteMaterialName').textContent = materialTitle;
    document.getElementById('deleteMaterialForm').action = `/delete-material/${subjectId}/${materialId}`;
    new bootstrap.Modal(document.getElementById('deleteMaterialModal')).show();
}
</script>

@endsection