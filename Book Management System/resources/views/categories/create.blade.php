@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4">Add Main Category</h2>

        <form method="POST" action="{{ route('categories.store') }}">
          @csrf
          <div class="mb-3">
            <input 
              type="text" 
              name="name" 
              class="form-control" 
              placeholder="Category Name" 
              value="{{ old('name') }}" 
              required
            >
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg">Add Category</button>
          </div>
        </form>

        <div class="text-center mt-3">
          <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
