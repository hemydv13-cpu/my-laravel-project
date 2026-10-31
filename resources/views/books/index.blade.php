@extends('layouts.app')

@section('title', 'All Books')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4">Explore Our Library</h2>

    <form method="GET" action="{{ route('books.index') }}"
          class="row g-2 mb-4">

        <div class="col-md-6">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search title or author">
        </div>

        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(request('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Search</button>
        </div>

    </form>

    <div class="row g-4">

        @forelse($books as $book)

            <div class="col-md-3 col-6">

                <div class="card book-card shadow-sm h-100">

                    @if($book->cover_path)
                        <img src="{{ asset('storage/'.$book->cover_path) }}"
                             class="book-cover"
                             alt="{{ $book->title }}">
                    @else
                        <div class="book-cover d-flex align-items-center justify-content-center">
                            No Cover
                        </div>
                    @endif

                    <div class="card-body">

                        <h6>{{ $book->title }}</h6>

                        <p class="text-muted small">
                            {{ $book->author }}
                        </p>

                        <a href="{{ route('books.show', $book) }}"
                           class="btn btn-primary btn-sm w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-info">
                    No books found.
                </div>
            </div>

        @endforelse

    </div>

    <div class="mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection