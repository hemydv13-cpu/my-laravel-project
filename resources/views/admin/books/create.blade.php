@extends('layouts.app')

@section('title', 'Add Book')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width:750px">

        <div class="card-body p-4">

            <h2 class="mb-4">Add New Book</h2>

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
                  action="{{ route('admin.books.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label>Book Title</label>
                    <input type="text" name="title"
                           class="form-control"
                           value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <input type="text" name="author"
                           class="form-control"
                           value="{{ old('author') }}" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>

                    <select name="category_id" class="form-select">
                        <option value="">Select Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn"
                           class="form-control"
                           value="{{ old('isbn') }}">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Book Cover Image</label>
                    <input type="file" name="cover"
                           class="form-control"
                           accept="image/*">
                    <small class="text-muted">Maximum 2 MB.</small>
                </div>

                <div class="mb-3">
                    <label>Book PDF</label>
                    <input type="file" name="pdf"
                           class="form-control"
                           accept=".pdf,application/pdf" required>
                    <small class="text-muted">Maximum 50 MB.</small>
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_published"
                           value="1" class="form-check-input"
                           id="published">

                    <label class="form-check-label" for="published">
                        Publish immediately
                    </label>
                </div>

                <button class="btn btn-primary">
                    Save Book
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