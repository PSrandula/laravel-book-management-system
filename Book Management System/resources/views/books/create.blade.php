@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h2>Add New Book</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Book Title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="author" class="form-control" placeholder="Author" value="{{ old('author') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="number" name="publication_year" class="form-control" placeholder="Publication Year" min="1500" max="{{ date('Y') }}" value="{{ old('publication_year') }}" required>
                        </div>

                        <div class="mb-3">
                            <select name="category_id" id="category" class="form-select" required>
                                <option value="">Select Main Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <select name="subcategory_id" id="subcategory" class="form-select" required>
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $subcategory)
                                    <option data-category="{{ $subcategory->category_id }}" value="{{ $subcategory->id }}" {{ old('subcategory_id')==$subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Book Images (multiple allowed):</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Books</a>
            </div>

        </div>
    </div>
</div>

<script>
    // Filter subcategories based on category
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');

    function filterSubcategories() {
        const selectedCategory = categorySelect.value;

        Array.from(subcategorySelect.options).forEach(option => {
            if (!option.value) return;
            option.style.display = option.dataset.category === selectedCategory ? 'block' : 'none';
        });

        subcategorySelect.value = '';
    }

    categorySelect.addEventListener('change', filterSubcategories);

    window.onload = filterSubcategories;
</script>
@endsection
