@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="welcome">
    <h2>Welcome to the Library!</h2>
    <p>Manage books, view collections, and explore our library resources.</p>
    <a href="{{ url('/books') }}" class="btn">View Books</a>
</section>
@endsection