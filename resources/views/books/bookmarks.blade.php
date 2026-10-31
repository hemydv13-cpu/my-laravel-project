@extends('layouts.app')

@section('title', 'My Bookmarks')

@section('content')

<div class="container py-5">

    <h2 class="mb-4">My Bookmarks</h2>

    <div class="row g-4">

        @forelse($books as $bookmark)

            @if($bookmark->book)

                <div class="col-md-3 col-6">

                    <div class="card h-100 shadow-sm">

                        @if($bookmark->book->cover_path)
                            <img src="{{ asset('storage/'.$bookmark->book->cover_path) }}"
                                 class="book-cover"
                                 alt="{{ $bookmark->book->title }}">
                        @endif

                        <div class="card-body">

                            <h6>{{ $bookmark->book->title }}</h6>

                            <a href="{{ route('books.show', $bookmark->book) }}"
                               class="btn btn-primary btn-sm">
                                View Book
                            </a>

                        </div>

                    </div>

                </div>

            @endif

        @empty

            <p>You have not bookmarked any books yet.</p>

        @endforelse

    </div>

    <div class="mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection