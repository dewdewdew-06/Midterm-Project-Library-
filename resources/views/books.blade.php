@extends('layouts.app')

@section('title', 'Books')

@section('content')
<h1>Available Books</h1>

//filter, sort, search
<form method="GET" action="{{ route('books.index') }}" style="margin-bottom: 20px;">
    {{-- 🔹 Genre Filter --}}
    <label>Genre:</label>
    <select name="genre" onchange="this.form.submit()">
        <option value="all">All</option>
        @foreach ($genres as $genre)
            <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                {{ $genre }}
            </option>
        @endforeach
    </select>

    //sort toggle
    <label style="margin-left: 20px;">Sort:</label>
    <input type="hidden" name="sort" value="{{ request('sort') == 'asc' ? '' : 'asc' }}">
    <button type="submit">
        {{ request('sort') == 'asc' ? 'Reset' : 'A → Z' }}
    </button>

    //search
    <label style="margin-left: 20px;">Search:</label>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Book title...">
    <button type="submit">🔍</button>

    //randomize book
    <button type="button" id="randomBtn" style="margin-left: 20px;">🎲 Random Highlight</button>
</form>

//add new book
<a href="{{ route('books.create') }}" style="display:inline-block; margin-top:15px; font-weight:bold; text-decoration:none;">
    ➕ Add New Book
</a>

//table
<table id="booksTable" border="1" cellpadding="10" style="margin-top:20px;">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Release Date</th>
        <th>Pages</th>
        <th>Actions</th>
    </tr>

    @forelse ($books as $book)
    <tr>
        <td>{{ $book->id }}</td>
        <td>{{ $book->name }}</td>
        <td>{{ $book->author->name ?? 'Unknown' }}</td>
        <td>{{ $book->genre }}</td>
        <td>{{ $book->releaseDate }}</td>
        <td>{{ $book->pages }}</td>
        <td>
            <a href="{{ route('books.edit', $book->id) }}">Edit</a> |
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this book?')">Delete</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" style="text-align:center; color: gray;">No books found.</td>
    </tr>
    @endforelse
</table>

<script>
document.getElementById('randomBtn').addEventListener('click', function() {
    const rows = document.querySelectorAll('#booksTable tr');
    rows.forEach(row => row.style.backgroundColor = ''); // reset
    if (rows.length > 1) {
        const randomIndex = Math.floor(Math.random() * (rows.length - 1)) + 1; // skip header
        rows[randomIndex].style.backgroundColor = 'yellow';
    }
});
</script>
@endsection
