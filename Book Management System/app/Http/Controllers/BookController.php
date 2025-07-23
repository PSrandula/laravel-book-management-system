<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'subcategory', 'images'])->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('books.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'title' => 'required|string|max:255',
    'author' => 'required|string|max:255',
    'publication_year' => ['required', 'digits:4', 'integer', 'min:1500', 'max:2025'],
    'category_id' => 'required|exists:categories,id',
    'subcategory_id' => 'required|exists:subcategories,id',
    'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
]);

        $book = Book::create($request->only('title', 'author', 'publication_year', 'category_id', 'subcategory_id'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $filename = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('storage/book_images'), $filename);
                Image::create([
                    'filename' => $filename,
                    'book_id' => $book->id,
                ]);
            }
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $book->category_id)->get();
        $book->load('images');
        return view('books.edit', compact('book', 'categories', 'subcategories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
    'title' => 'required|string|max:255',
    'author' => 'required|string|max:255',
    'publication_year' => ['required', 'digits:4', 'integer', 'min:1500', 'max:2025'],
    'category_id' => 'required|exists:categories,id',
    'subcategory_id' => 'required|exists:subcategories,id',
    'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
]);


        $book->update($request->only('title', 'author', 'publication_year', 'category_id', 'subcategory_id'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $filename = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->storeAs('public/book_images', $filename);
                Image::create([
                    'filename' => $filename,
                    'book_id' => $book->id,
                ]);
            }
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        foreach ($book->images as $image) {
            Storage::delete('public/book_images/' . $image->filename);
            $image->delete();
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }
}
