@extends('layouts.main')

@section('container')
<div class="container mt-5">
    <h1>Debug Quiz Create Page</h1>
    
    <div class="alert alert-info">
        <h4>Debug Information:</h4>
        <ul>
            <li>Current User: {{ Auth::user()->name ?? 'Not logged in' }}</li>
            <li>User Role: {{ Auth::user()->role ?? 'No role' }}</li>
            <li>Can Create Quiz: {{ Auth::user()->canManageContent() ? 'Yes' : 'No' }}</li>
            <li>Materials Count: {{ isset($materials) ? count($materials) : 'Materials not passed' }}</li>
            <li>Route Name: {{ Route::currentRouteName() }}</li>
        </ul>
    </div>

    @if(isset($materials))
        <div class="alert alert-success">
            <h5>Materials Available:</h5>
            @foreach($materials as $material)
                <p>{{ $material->subject->name ?? 'No Subject' }} - {{ $material->title }}</p>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger">
            No materials passed to the view!
        </div>
    @endif

    <div class="alert alert-warning">
        <h5>Simple Form Test:</h5>
        <form method="POST" action="{{ route('quiz.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Quiz Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <button type="submit" class="btn btn-primary">Test Submit</button>
        </form>
    </div>
</div>
@endsection
