@extends('layouts.app')

@section('title', 'Add New Author')

@section('content')
<h1>Add New Author</h1>

{{-- Display validation errors --}}
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Author creation form --}}
<form action="{{ route('authors.store') }}" method="POST">
    @csrf

    <label for="name">Author Name:</label><br>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required><br><br>

    <label for="booksPublished">Books Published:</label><br>
    <input type="number" name="booksPublished" id="booksPublished" value="{{ old('booksPublished') }}" min="0" required><br><br>

    <button type="submit">Add Author</button>
</form>

<br>
<a href="{{ route('authors.index') }}">⬅ Back to Authors List</a>
@endsection
