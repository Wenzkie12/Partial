<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookLog;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->query('sort', 'name'); 
        $sortOrder = $request->query('order', 'asc'); 

        $books = Book::orderBy($sortField, $sortOrder)->paginate(6);
        return view('management.book-management.index', compact('books', 'sortField', 'sortOrder'));
    }

    public function create()
    {
        return view('management.book-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date_published' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::create($request->all());

        // Ensure user is authenticated before logging
        if (Auth::check()) {
            $user = Auth::user();

            BookLog::create([
                'user_id' => $user->id,
                'name' => $user->name, 
                'book_id' => $book->id,
                'action' => 'Added',
                'description' => 'Added a new book: ' . $book->name,
            ]);
        }

        return redirect()->route('book-management')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        return view('management.book-management.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date_published' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $book->update($request->all());

        // Log the update action
        if (Auth::check()) {
            $user = Auth::user();

            BookLog::create([
                'user_id' => $user->id,
                'name' => $user->name, 
                'book_id' => $book->id,
                'action' => 'Updated',
                'description' => 'Updated book details for: ' . $book->name,
            ]);
        }

        return redirect()->route('book-management')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if (Auth::check()) {
            $user = Auth::user();

            BookLog::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'book_id' => $book->id,
                'action' => 'Deleted',
                'description' => 'Deleted the book titled "' . $book->name . '" from the system',
            ]);
        }

        $book->delete();

        return redirect()->route('book-management')->with('success', 'Book deleted successfully.');
    }
}
