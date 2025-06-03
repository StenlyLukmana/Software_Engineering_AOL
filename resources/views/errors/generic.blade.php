@extends('layouts.main')

@section('container')
<div class="container mt-5">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h2>{{ $title ?? 'Error' }}</h2>
        </div>
        <div class="card-body">
            <div class="alert alert-danger">
                {{ $message ?? 'An unexpected error occurred.' }}
            </div>
            
            @if(isset($details) && config('app.debug'))
                <h4 class="mt-4">Error Details</h4>
                <div class="bg-light p-3 rounded">
                    <pre>{{ $details }}</pre>
                </div>
            @endif
            
            @if(isset($trace) && config('app.debug'))
                <h4 class="mt-4">Stack Trace</h4>
                <div class="bg-light p-3 rounded overflow-auto" style="max-height: 300px;">
                    <pre>{{ $trace }}</pre>
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Go Back</a>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
