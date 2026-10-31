@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="container py-5">

    <div class="row g-5">

        <div class="col-md-4">

            @if($book->cover_path)
                <img src="{{ asset('storage/'.$book->cover_path) }}"
                     class="img-fluid rounded shadow"
                     alt="{{ $book->title }}">
            @else
                <div class="bg-light p-5 text-center">
                    No cover available
                </div>
            @endif

        </div>

        <div class="col-md-8">

            <h1 class="fw-bold">{{ $book->title }}</h1>

            <p class="text-muted">
                Author: {{ $book->author }}
            </p>

            <p>
                Category:
                {{ $book->category?->name ?? 'Uncategorized' }}
            </p>

            <p>
                ISBN: {{ $book->isbn ?? 'Not available' }}
            </p>

            <p>
                Views: {{ number_format($book->views) }}
            </p>

            <hr>

            <h5>Description</h5>

            <p>{{ $book->description ?? 'No description available.' }}</p>

            <div class="d-flex flex-wrap gap-2 mt-4">

                <a href="{{ route('books.read', $book) }}"
                   class="btn btn-primary">
                    Read Online
                </a>

                @auth

                    <form method="POST"
                          action="{{ route('books.download', $book) }}">
                        @csrf

                        <button class="btn btn-success">
                            Download PDF
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('books.bookmark', $book) }}">
                        @csrf

                        <button class="btn btn-outline-primary">
                            Bookmark
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}"
                       class="btn btn-success">
                        Login to Download
                    </a>

                @endauth

            </div>

        </div>

    </div>

</div>

@endsection