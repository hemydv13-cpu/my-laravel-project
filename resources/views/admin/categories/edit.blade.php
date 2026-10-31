@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width:600px">

        <div class="card-body p-4">

            <h2>Edit Category</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.categories.update', $category) }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Category Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $category->name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $category->description) }}</textarea>
                </div>

                <button class="btn btn-primary">
                    Update Category
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection