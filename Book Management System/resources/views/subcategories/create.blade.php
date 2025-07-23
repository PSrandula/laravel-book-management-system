@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4">Add Subcategory</h2>

        <form method="POST" action="{{ route('subcategories.store') }}">
          @csrf

          <div class="mb-3">
            <input 
              type="text" 
              name="name" 
              class="form-control" 
              placeholder="Subcategory Name" 
              value="{{ old('name') }}" 
              required
            >
          </div>

          <div class="mb-3">
            <select name="category_id" class="form-select" required>
              <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select Main Category</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg">Add Subcategory</button>
          </div>
        </form>

        <div class="text-center mt-3">
          <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Back to Subcategories</a>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
