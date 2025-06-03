@extends('layouts.main')

@section('container')
<div class="container mt-4">
    <h1>Quiz Creation Diagnostic Page</h1>
    
    <div class="card mb-4">
        <div class="card-header">Authentication Status</div>
        <div class="card-body">
            @if(auth()->check())
                <p><strong>User:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
                <p><strong>Can Manage Content:</strong> {{ auth()->user()->canManageContent() ? 'Yes' : 'No' }}</p>
                <p><strong>Is Admin:</strong> {{ auth()->user()->isAdmin() ? 'Yes' : 'No' }}</p>
            @else
                <p>Not logged in</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
            @endif
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">Available Materials</div>
        <div class="card-body">
            @if(isset($materials) && $materials->count() > 0)
                <ul>
                    @foreach($materials as $material)
                        <li>{{ $material->title }} ({{ $material->subject->name ?? 'No Subject' }})</li>
                    @endforeach
                </ul>
                <p>Total materials: {{ $materials->count() }}</p>
            @else
                <p>No materials available</p>
            @endif
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">Routes</div>
        <div class="card-body">            <p><a href="{{ route('quiz.index') }}">Quiz Index</a></p>
            <p><a href="{{ route('quiz.create') }}">Quiz Create (Official Route)</a></p>
            <p><a href="{{ url('/quiz-create-direct') }}">Quiz Create Direct (Bypass Middleware)</a></p>
            <p><a href="{{ route('quiz.create.minimal') }}">Quiz Create Minimal (Simplified Form)</a></p>
            <p><a href="{{ route('quiz.diagnostic') }}">Refresh Diagnostic Page</a></p>
        </div>
    </div>
</div>
@endsection
