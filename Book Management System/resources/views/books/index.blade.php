@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#333;">📚 Books List</h1>

    <div style="text-align:center; margin-bottom: 20px;">
        <a href="{{ route('books.create') }}" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">+ Add New Book</a>
    </div>

    @if(session('success'))
        <p style="color:green; text-align:center;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin: 0 auto; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <thead style="background-color: #f2f2f2;">
            <tr style="text-align:left;">
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publication_year }}</td>
                <td>
                    @foreach($book->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Book Image" width="60" style="margin: 5px;" />
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" style="color: #2196F3; text-decoration: none;">Edit</a> | 
                    <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button style="background:none; border:none; color:#f44336; cursor:pointer;" onclick="return confirm('Delete this book?');">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" style="text-align:center;">No books found.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
