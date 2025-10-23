<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() //displays all authors
    {
        $authors = Author::all();
        return view('author', compact('authors'));
    }

    public function create() //create new author
    {
        return view('author-create');
    }

    public function store(Request $request) //storea new author
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'booksPublished' => 'required|integer|min:0',
        ]);

        Author::create($request->all());
        return redirect('/authors')->with('success', 'Author added successfully!');
    }

    public function edit($id) //open edit window
    {
        $author = Author::findOrFail($id);
        return view('author-edit', compact('author'));
    }

    public function update(Request $request, $id) //update the author
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'booksPublished' => 'required|integer|min:0',
        ]);

        $author = Author::findOrFail($id);
        $author->update($request->all());
        return redirect('/authors')->with('success', 'Author updated successfully!');
    }

    public function destroy($id) //delete author
    {
        Author::destroy($id);
        return redirect('/authors')->with('success', 'Author deleted successfully!');
    }
}
