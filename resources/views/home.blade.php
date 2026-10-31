@extends('layouts.app')

@section('title', 'Home - Digital Library')

@section('content')

<section class="hero text-center">

    <div class="container">

        <h1 class="display-4 fw-bold">
            Your Digital Library
        </h1>

        <p class="lead">
            Explore thousands of books and expand your knowledge.
        </p>

        <form action="{{ route('books.index') }}"
              method="GET"
              class="row justify-content-center mt-4">

            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search"
                           class="form-control form-control-lg"
                           placeholder="Search books or authors...">

                    <button class="btn btn-warning">
                        Search
                    </button>
                </div>
            </div>

        </form>

    </div>

</section>

<div class="container py-5">

    <h2 class="fw-bold mb-4">Browse Categories</h2>

    <div class="row g-3 mb-5">

        @forelse($categories as $category)

            <div class="col-md-3 col-6">

                <a href="{{ route('books.index', ['category' => $category->id]) }}"
                   class="text-decoration-none">

                    <div class="card shadow-sm p-3 h-100">
                        <h6 class="mb-1">{{ $category->name }}</h6>

                        <small class="text-muted">
                            {{ $category->books_count }} books
                        </small>
                    </div>

                </a>

            </div>

        @empty

            <p>No categories available yet.</p>

        @endforelse

    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Recently Added Books</h2>

        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
            View All
        </a>

    </div>

    <div class="row g-4">

        @forelse($books as $book)

            <div class="col-md-3 col-6">

                <div class="card book-card shadow-sm h-100">

                    @if($book->cover_path)

                        <img src="{{ asset('storage/'.$book->cover_path) }}"
                             class="card-img-top book-cover"
                             alt="{{ $book->title }}">

                    @else

                        <div class="book-cover d-flex align-items-center justify-content-center">
                            <span class="text-muted">No Cover</span>
                        </div>

                    @endif

                    <div class="card-body">

                        <h6>{{ $book->title }}</h6>

                        <p class="text-muted small">
                            {{ $book->author }}
                        </p>

                        <a href="{{ route('books.show', $book) }}"
                           class="btn btn-primary btn-sm w-100">
                            View Book
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <p>No books have been published yet.</p>

        @endforelse

    </div>

</div>

@endsection