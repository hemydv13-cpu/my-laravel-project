@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width:750px">

        <div class="card-body p-4">

            <h2 class="mb-4">Edit Book</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.books.update', $book) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title"
                           class="form-control"
                           value="{{ old('title', $book->title) }}" required>
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <input type="text" name="author"
                           class="form-control"
                           value="{{ old('author', $book->author) }}" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>

                    <select name="category_id" class="form-select">

                        <option value="">No Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id', $book->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn"
                           class="form-control"
                           value="{{ old('isbn', $book->isbn) }}">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Current Cover</label>

                    @if($book->cover_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$book->cover_path) }}"
                                 width="110" alt="Book cover">
                        </div>
                    @else
                        <p>No cover uploaded.</p>
                    @endif

                    <label>Replace Cover</label>
                    <input type="file" name="cover" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Replace PDF (optional)</label>
                    <input type="file" name="pdf"
                           class="form-control"
                           accept=".pdf,application/pdf">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox"
                           name="is_published"
                           value="1"
                           class="form-check-input"
                           id="published"
                           @checked(old('is_published', $book->is_published))>

                    <label class="form-check-label" for="published">
                        Published
                    </label>
                </div>

                <button class="btn btn-primary">
                    Update Book
                </button>

                <a href="{{ route('admin.books.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection