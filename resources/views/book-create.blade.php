@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')
<h1>Add New Book</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.store') }}" method="POST">
    @csrf

    <label>Title:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Author:</label><br>
    <select name="authorID" required>
        <option value="">-- Select Author --</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select><br><br>

    <label>Release Date:</label><br>
    <input type="date" name="releaseDate" value="{{ old('releaseDate') }}" required><br><br>

    <label>Genre:</label><br>
    <input type="text" name="genre" value="{{ old('genre') }}" required><br><br>

    <label>Pages:</label><br>
    <input type="number" name="pages" value="{{ old('pages') }}" min="1" required><br><br>

    <button type="submit">Add Book</button>
</form>

<br>
<a href="{{ route('books.index') }}">⬅ Back to Book List</a>
@endsection
