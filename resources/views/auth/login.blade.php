@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h2>Login</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
@endif

<form method="POST" action="/login">
    @csrf
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Don’t have an account? <a href="/register">Register here</a>.</p>
@endsection
