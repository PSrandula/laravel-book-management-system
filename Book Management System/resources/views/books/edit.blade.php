@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#333;">Edit Book</h1>

    <div style="max-width: 600px; margin: 0 auto;">
        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" style="background:#f9f9f9; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            @csrf
            @method('PUT')

            <label>Title:</label><br>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" required style="width:100%; padding:10px; margin-bottom:15px;"><br>

            <label>Author:</label><br>
            <input type="text" name="author" value="{{ old('author', $book->author) }}" required style="width:100%; padding:10px; margin-bottom:15px;"><br>

            <label>Publication Year:</label><br>
            <input type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}" required style="width:100%; padding:10px; margin-bottom:15px;"><br>

            <label>Book Images (optional):</label><br>
            <input type="file" name="images[]" multiple style="margin-bottom:20px;"><br>

            <button type="submit" style="padding: 10px 25px; background-color: #2196F3; color:white; border:none; border-radius:5px;">Update</button>
        </form>
    </div>
@endsection
