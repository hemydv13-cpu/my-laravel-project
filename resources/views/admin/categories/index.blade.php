@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Manage Categories</h2>

        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-primary">
            Add Category
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Books</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>{{ $category->name }}</td>

                            <td>{{ $category->books_count }}</td>

                            <td>

                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.categories.destroy', $category) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete category?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3">No categories created.</td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{ $categories->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection