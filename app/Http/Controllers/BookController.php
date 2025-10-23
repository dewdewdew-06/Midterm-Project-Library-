<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1️⃣ Show all books
    public function index(Request $request)
    {
        $query = Book::with('author');

        // Filter by genre
        if ($request->filled('genre') && $request->genre != 'all') {
            $query->where('genre', $request->genre);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort alphabetically
        if ($request->filled('sort') && $request->sort === 'asc') {
            $query->orderBy('name', 'asc');
        }

        $books = $query->get();

        // 🟢 This part ensures $genres is defined even if empty
        $genres = Book::select('genre')->distinct()->pluck('genre');

        return view('books', compact('books', 'genres'));
    }

    // 2️⃣ Show the form for adding a new book
    public function create()
    {
        $authors = Author::all(); // needed for dropdown
        return view('book-create', compact('authors'));
    }

    // 3️⃣ Save a new book to DB
    public function store(Request $request)
    {
        $request->validate([
            'authorID' => 'required|integer|exists:authors,id',
            'name' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'genre' => 'required|string|max:100',
            'pages' => 'required|integer|min:1',
        ]);

        Book::create($request->all());
        return redirect('/books')->with('success', 'Book added successfully!');
    }

    // 4️⃣ Show the edit form
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all(); // for dropdown
        return view('book-edit', compact('book', 'authors'));
    }

    // 5️⃣ Update the book in DB
    public function update(Request $request, $id)
    {
        $request->validate([
            'authorID' => 'required|integer|exists:authors,id',
            'name' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'genre' => 'required|string|max:100',
            'pages' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect('/books')->with('success', 'Book updated successfully!');
    }

    // 6️⃣ Delete a book
    public function destroy($id)
    {
        Book::destroy($id);
        return redirect('/books')->with('success', 'Book deleted successfully!');
    }
}
