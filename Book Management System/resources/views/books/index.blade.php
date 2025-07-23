@extends('layouts.app')

@section('content')
<div class="container my-5">

    <h2 class="mb-4 text-center">Books List</h2>

    <div class="mb-3 text-center">
        <a href="{{ route('books.create') }}" class="btn btn-success btn-lg">+ Add New Book</a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publication Year</th>
                    <th>Main Category</th>
                    <th>Subcategory</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($books as $book)
                <tr>
                    <td class="text-center">{{ $book->id }}</td>

                    <td>
                        @foreach($book->images as $image)
                            <img src="{{ asset('storage/book_images/' . $image->filename) }}" alt="Book Image" style="max-height: 60px; max-width: 60px; object-fit: cover; border-radius: 4px; margin-right: 5px;">
                        @endforeach
                    </td>

                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td class="text-center">{{ $book->publication_year }}</td>
                    <td>{{ $book->category->name ?? 'N/A' }}</td>
                    <td>{{ $book->subcategory->name ?? 'N/A' }}</td>

                    <td class="text-center">
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                        <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline;" onsubmit="return confirm('Delete this book?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
