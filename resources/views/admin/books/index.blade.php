@extends('layouts.app')

@section('title', 'Manage Books')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Manage Books</h2>

        <a href="{{ route('admin.books.create') }}"
           class="btn btn-primary">
            + Add New Book
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($books as $book)

                            <tr>

                                <td>{{ $book->title }}</td>

                                <td>{{ $book->author }}</td>

                                <td>
                                    {{ $book->category?->name ?? '-' }}
                                </td>

                                <td>
                                    @if($book->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('admin.books.edit', $book) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.books.destroy', $book) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this book?')">

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
                                <td colspan="5" class="text-center">
                                    No books available.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{ $books->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection