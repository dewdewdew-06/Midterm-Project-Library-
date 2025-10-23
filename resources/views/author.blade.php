@extends('layouts.app')

@section('title', 'Authors')

@section('content')
<h1>Authors</h1>

<a href="{{ route('authors.create') }}">➕ Add New Author</a>

<table border="1" cellpadding="10" style="margin-top:20px;">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Books Published</th>
        <th>Actions</th>
    </tr>

    @foreach ($authors as $author)
    <tr>
        <td>{{ $author->id }}</td>
        <td>{{ $author->name }}</td>
        <td>{{ $author->booksPublished }}</td>
        <td>
            <a href="{{ route('authors.edit', $author->id) }}">Edit</a> |
            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this author?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
