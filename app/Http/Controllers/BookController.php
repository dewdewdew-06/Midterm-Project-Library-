<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('author');

        if ($request->filled('genre') && $request->genre != 'all') {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort') && $request->sort === 'asc') {
            $query->orderBy('name', 'asc');
        }

        $books = $query->get();

        $genres = Book::select('genre')->distinct()->pluck('genre');

        return view('books', compact('books', 'genres'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('book-create', compact('authors'));
    }

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

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('book-edit', compact('book', 'authors'));
    }

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

    public function destroy($id)
    {
        Book::destroy($id);
        return redirect('/books')->with('success', 'Book deleted successfully!');
    }
}
