@extends('layouts.app')

@section('title', 'Read '.$book->title)

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4>{{ $book->title }}</h4>
            <small class="text-muted">{{ $book->author }}</small>
        </div>

        <a href="{{ route('books.show', $book) }}"
           class="btn btn-outline-primary">
            Back to Book
        </a>

    </div>

    <div style="height:80vh; background:#333;">

        <iframe
            src="{{ route('books.pdf', $book) }}"
            width="100%"
            height="100%"
            style="border:0;"
            title="PDF Reader">
        </iframe>

    </div>

</div>

@endsection