@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="alert alert-success">
        <h3>QUIZ CREATE VIEW IS LOADING!</h3>
        <p>This proves the view is being rendered.</p>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h5>Debug Information:</h5>
            <ul>
                <li>Materials count: {{ isset($materials) ? count($materials) : 'Not set' }}</li>
                <li>User: {{ Auth::user()->name ?? 'Not logged in' }}</li>
                <li>User role: {{ Auth::user()->role ?? 'No role' }}</li>
                <li>Route: {{ Route::currentRouteName() }}</li>
                <li>URL: {{ url()->current() }}</li>
            </ul>
        </div>
    </div>
    
    @if(isset($materials) && count($materials) > 0)
        <div class="alert alert-info mt-3">
            <h5>Available Materials:</h5>
            @foreach($materials as $material)
                <p>{{ $material->subject->name ?? 'No Subject' }} - {{ $material->title }}</p>
            @endforeach
        </div>
    @endif
    
    <div class="card mt-3">
        <div class="card-body">
            <h5>Simple Test Form:</h5>
            <form action="{{ route('quiz.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Quiz Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <button type="submit" class="btn btn-primary">Test Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
