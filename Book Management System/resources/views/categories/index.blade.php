@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="mb-4 text-center">Main Categories</h2>

  <div class="text-center mb-4">
    <a href="{{ route('categories.create') }}" class="btn btn-success btn-lg">+ Add New Category</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th style="width: 180px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary me-2">Edit</a>

            <form 
              method="POST" 
              action="{{ route('categories.destroy', $category) }}" 
              style="display:inline;" 
              onsubmit="return confirm('Delete this category?');"
            >
              @csrf
              @method('DELETE')
              <button 
                type="submit" 
                class="btn btn-sm btn-danger"
              >
                Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
