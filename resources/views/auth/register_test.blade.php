@extends('layouts.auth')

@section('content')
<div style="padding: 2rem; text-align: center;">
    <h1>Register Test Page</h1>
    <p>This is a simple test to check if the layout works</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div style="margin: 1rem 0;">
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div style="margin: 1rem 0;">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div style="margin: 1rem 0;">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div style="margin: 1rem 0;">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
</div>
@endsection
