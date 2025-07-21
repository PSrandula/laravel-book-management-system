<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Display list of books
    public function index()
    {
        $books = Book::with('images')->get();
        return view('books.index', compact('books'));
    }

    // Show form to create new book
    public function create()
    {
        return view('books.create');
    }

    // Store new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|digits:4|integer|min:1500|max:' . date('Y'),
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $book = Book::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('book_images', 'public');
                Image::create([
                    'book_id' => $book->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Show single book
    public function show(Book $book)
    {
        $book->load('images');
        return view('books.show', compact('book'));
    }

    // Show edit form
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|digits:4|integer|min:1500|max:' . date('Y'),
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $book->update($validated);

        // Optionally handle new images upload (extend as needed)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('book_images', 'public');
                Image::create([
                    'book_id' => $book->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete book and related images
    public function destroy(Book $book)
    {
        // Delete images files from storage
        foreach ($book->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
