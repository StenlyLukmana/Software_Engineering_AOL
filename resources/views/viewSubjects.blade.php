@extends('layouts.main')

@section('container')

<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 fw-bold">
                                <i class="fas fa-book-open me-2"></i>Computer Science Subjects
                            </h1>
                            <p class="mb-0 opacity-75">
                                Explore our comprehensive curriculum and learning materials
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(auth()->user()->canManageContent())
                                <a href="{{ route('subjects.create') }}" class="btn btn-light btn-lg">
                                    <i class="fas fa-plus me-2"></i>Add New Subject
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Subjects Grid -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-graduation-cap me-2"></i>Available Subjects ({{ $subjects->count() }})</span>
                    @if(auth()->user()->canManageContent())
                        <a href="{{ route('subjects.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i>Add Subject
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">#</th>
                                        <th scope="col" style="width: 45%;">Subject Name</th>
                                        <th scope="col" style="width: 15%;">Materials</th>
                                        <th scope="col" style="width: 15%;">Created</th>
                                        <th scope="col" style="width: 20%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                    <tr>
                                        <td class="align-middle">
                                            <span class="badge bg-light text-dark rounded-pill px-3">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="subject-icon me-3" style="background: var(--light-cream); width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas 
                                                        @if(str_contains(strtolower($subject->name), 'database')) fa-database
                                                        @elseif(str_contains(strtolower($subject->name), 'algorithm')) fa-code
                                                        @elseif(str_contains(strtolower($subject->name), 'data structure')) fa-project-diagram
                                                        @elseif(str_contains(strtolower($subject->name), 'network')) fa-network-wired
                                                        @elseif(str_contains(strtolower($subject->name), 'software')) fa-laptop-code
                                                        @elseif(str_contains(strtolower($subject->name), 'operating')) fa-server
                                                        @else fa-book
                                                        @endif" 
                                                        style="color: var(--primary-navy); font-size: 1.2rem;"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold" style="color: var(--primary-navy);">{{ $subject->name }}</h6>
                                                    <small class="text-muted">Computer Science Course</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge rounded-pill" style="background: var(--accent-yellow); color: var(--primary-navy);">
                                                <i class="fas fa-file-alt me-1"></i>{{ $subject->materials_count }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">{{ $subject->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('subjects.materials', $subject->id) }}" 
                                                   class="btn btn-success-custom btn-sm" 
                                                   title="View Materials">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(auth()->user()->canManageContent())
                                                    <a href="{{ route('materials.create', $subject->id) }}" 
                                                       class="btn btn-primary-custom btn-sm" 
                                                       title="Add Material">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <a href="{{ route('subjects.edit', $subject) }}" 
                                                       class="btn btn-outline-primary btn-sm" 
                                                       title="Edit Subject">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-outline-danger btn-sm" 
                                                            title="Delete Subject"
                                                            onclick="confirmDelete({{ $subject->id }}, '{{ $subject->name }}', {{ $subject->materials_count }})">
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
                                <i class="fas fa-book-open" style="font-size: 4rem; color: var(--light-cream);"></i>
                            </div>
                            <h5 style="color: var(--primary-navy);">No Subjects Available</h5>
                            <p class="text-muted">No subjects have been created yet. Start building your curriculum!</p>
                            @if(auth()->user()->canManageContent())
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary-custom">
                                    <i class="fas fa-plus me-2"></i>Create First Subject
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the subject <strong id="deleteSubjectName"></strong>?</p>
                <div id="materialWarning" class="alert alert-warning d-none">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This subject contains <strong id="materialCount"></strong> learning materials that will also be deleted.
                </div>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Subject
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(subjectId, subjectName, materialCount) {
    document.getElementById('deleteSubjectName').textContent = subjectName;
    document.getElementById('deleteForm').action = '/subjects/' + subjectId;
    
    const materialWarning = document.getElementById('materialWarning');
    const materialCountElement = document.getElementById('materialCount');
    
    if (materialCount > 0) {
        materialCountElement.textContent = materialCount;
        materialWarning.classList.remove('d-none');
    } else {
        materialWarning.classList.add('d-none');
    }
    
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

@endsection