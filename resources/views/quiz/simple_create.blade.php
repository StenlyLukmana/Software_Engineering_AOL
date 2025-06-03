@extends('layouts.main')

@section('container')
<div class="container py-4">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Simple Quiz Creation Page (Debug Version)</h5>
        </div>
        <div class="card-body">
            <h2>User Information</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Logged In</th>
                            <td>{{ $userInfo['is_logged_in'] ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $userInfo['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $userInfo['email'] }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $userInfo['role'] }}</td>
                        </tr>
                        <tr>
                            <th>Can Manage Content</th>
                            <td>{{ $userInfo['can_manage_content'] ? 'Yes' : 'No' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <h2 class="mt-4">Materials Available</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Material Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td>{{ $material->id }}</td>
                                <td>{{ $material->subject->name }}</td>
                                <td>{{ $material->title }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No materials found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('quiz.create') }}" class="btn btn-primary">Go to Real Quiz Creation</a>
            </div>
        </div>
    </div>
</div>
@endsection
