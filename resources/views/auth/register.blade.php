@extends('layouts.app')

@section('title', 'Register')

@section('content')
<h2>Register</h2>

@if($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
@endif

<form method="POST" action="/register">
    @csrf
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="/login">Login here</a>.</p>
@endsection
