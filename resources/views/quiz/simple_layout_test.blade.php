@extends('layouts.main')

@section('container')
<div class="container">
    <h1>TEST PAGE - QUIZ CREATE</h1>
    <div class="alert alert-success">
        <h4>This is a test page to verify the layout is working</h4>
        <p>Current time: {{ date('Y-m-d H:i:s') }}</p>
        <p>Materials count: {{ isset($materials) ? count($materials) : 'Not set' }}</p>
    </div>
    
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="test" class="form-label">Test Input</label>
            <input type="text" class="form-control" id="test" name="test" value="This is working">
        </div>
        <button type="submit" class="btn btn-primary">Test Button</button>
    </form>
</div>
@endsection
