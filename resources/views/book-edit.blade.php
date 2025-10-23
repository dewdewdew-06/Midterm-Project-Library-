@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<h1>Edit Book</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Title:</label><br>
    <input type="text" name="name" value="{{ old('name', $book->name) }}" required><br><br>

    <label>Author:</label><br>
    <select name="authorID" required>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" {{ $book->authorID == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
            </option>
        @endforeach
    </select><br><br>

    <label>Release Date:</label><br>
    <input type="date" name="releaseDate" value="{{ old('releaseDate', $book->releaseDate) }}" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre" value="{{ old('genre', $book->genre) }}" required><br><br>

    <label>Pages:</label><br>
    <input type="number" name="pages" value="{{ old('pages', $book->pages) }}" min="1" required><br><br>

    <button type="submit">Update Book</button>
</form>

<br>
<a href="{{ route('books.index') }}">⬅ Back to Book List</a>
@endsection
