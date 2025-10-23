@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
<h1>Edit Author</h1>

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

{{-- Author edit form --}}
<form action="{{ route('authors.update', $author->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Author Name:</label><br>
    <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" required><br><br>

    <label for="booksPublished">Books Published:</label><br>
    <input type="number" name="booksPublished" id="booksPublished" value="{{ old('booksPublished', $author->booksPublished) }}" min="0" required><br><br>

    <button type="submit">Update Author</button>
</form>

<br>
<a href="{{ route('authors.index') }}">⬅ Back to Authors List</a>
@endsection
