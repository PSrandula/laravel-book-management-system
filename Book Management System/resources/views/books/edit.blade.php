@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-sm">
        <div class="card-header text-center">
          <h2>Edit Book</h2>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Book Title"
                value="{{ old('title', $book->title) }}"
                required
              >
            </div>

            <div class="mb-3">
              <input
                type="text"
                name="author"
                class="form-control"
                placeholder="Author"
                value="{{ old('author', $book->author) }}"
                required
              >
            </div>

            <div class="mb-3">
              <input
                type="number"
                name="publication_year"
                class="form-control"
                placeholder="Publication Year"
                min="1500"
                max="{{ date('Y') }}"
                value="{{ old('publication_year', $book->publication_year) }}"
                required
              >
            </div>

            <div class="mb-3">
              <select
                name="category_id"
                id="category"
                class="form-select"
                required
              >
                <option value="">Select Main Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ (old('category_id', $book->category_id) == $category->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <select
                name="subcategory_id"
                id="subcategory"
                class="form-select"
                required
              >
                <option value="">Select Subcategory</option>
                @foreach($subcategories as $subcategory)
                  <option
                    data-category="{{ $subcategory->category_id }}"
                    value="{{ $subcategory->id }}"
                    {{ (old('subcategory_id', $book->subcategory_id) == $subcategory->id) ? 'selected' : '' }}
                  >
                    {{ $subcategory->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <label class="form-label">Existing Images:</label>
            <div class="mb-3 d-flex flex-wrap gap-3">
              @foreach($book->images as $image)
                <img
                  src="{{ asset('storage/book_images/' . $image->filename) }}"
                  alt="Book Image"
                  class="img-thumbnail"
                  style="height: 100px; width: auto;"
                >
              @endforeach
            </div>

            <div class="mb-4">
              <label for="images" class="form-label">Add More Images (optional):</label>
              <input
                type="file"
                name="images[]"
                id="images"
                class="form-control"
                multiple
              >
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">Update Book</button>
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
  const categorySelect = document.getElementById('category');
  const subcategorySelect = document.getElementById('subcategory');

  function filterSubcategories() {
    const selectedCategory = categorySelect.value;

    Array.from(subcategorySelect.options).forEach(option => {
      if (!option.value) return; // skip placeholder
      option.style.display = option.dataset.category === selectedCategory ? 'block' : 'none';
    });

    if (!subcategorySelect.value) {
      subcategorySelect.value = '';
    }
  }

  categorySelect.addEventListener('change', filterSubcategories);

  window.onload = filterSubcategories;
</script>
@endsection
