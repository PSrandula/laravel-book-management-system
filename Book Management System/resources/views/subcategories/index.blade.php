@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="mb-4 text-center">Subcategories</h2>

  <div class="text-center mb-4">
    <a href="{{ route('subcategories.create') }}" class="btn btn-success btn-lg">+ Add New Subcategory</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Main Category</th>
          <th style="width: 180px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subcategories as $subcategory)
        <tr>
          <td>{{ $subcategory->id }}</td>
          <td>{{ $subcategory->name }}</td>
          <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
          <td>
            <a href="{{ route('subcategories.edit', $subcategory) }}" class="btn btn-sm btn-primary me-2">Edit</a>

            <form 
              method="POST" 
              action="{{ route('subcategories.destroy', $subcategory) }}" 
              style="display:inline;" 
              onsubmit="return confirm('Delete this subcategory?');"
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
