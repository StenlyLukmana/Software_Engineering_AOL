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
                                <i class="fas fa-users me-2"></i>User Management
                            </h1>
                            <p class="mb-0 opacity-75">
                                Manage platform users, roles, and permissions
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Add New User
                            </a>
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

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-users me-2"></i>All Users ({{ $users->total() }})</span>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i>Add User
                    </a>
                </div>
                <div class="card-body">
                    @if($users->count() > 0)                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="d-none d-md-table-cell">Email</th>
                                        <th>Role</th>
                                        <th class="d-none d-md-table-cell">Status</th>
                                        <th class="d-none d-lg-table-cell">Joined</th>
                                        <th width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-circle me-2 text-muted" style="font-size: 1.2rem;"></i>
                                                <div>
                                                    <strong>{{ $user->name }}</strong>
                                                    <div class="d-md-none small text-muted">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($user->role === 'admin') bg-danger
                                                @elseif($user->role === 'lecturer') bg-warning text-dark
                                                @else bg-info
                                                @endif">
                                                <i class="fas 
                                                    @if($user->role === 'admin') fa-shield-alt
                                                    @elseif($user->role === 'lecturer') fa-chalkboard-teacher
                                                    @else fa-user-graduate
                                                    @endif me-1"></i>
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>Verified
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i>Pending                                                </span>
                                            @endif
                                        </td>
                                        <td class="d-none d-lg-table-cell">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                    <span class="d-none d-md-inline ms-1">Edit</span>
                                                </a>
                                                @if($user->id !== auth()->user()->id)
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Delete User"
                                                            onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="d-none d-md-inline ms-1">Delete</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($users->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $users->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                            <h4 class="mt-3 text-muted">No Users Found</h4>
                            <p class="text-muted">Start by adding your first user to the platform.</p>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-user-plus me-2"></i>Add First User
                            </a>
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
                <p>Are you sure you want to delete user <strong id="deleteUserName"></strong>?</p>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId, userName) {
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('deleteForm').action = '/admin/users/' + userId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

@endsection
