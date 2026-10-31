@extends('layouts.app')

@section('title', 'Add Category')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width:600px">

        <div class="card-body p-4">

            <h2>Add Category</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.categories.store') }}">

                @csrf

                <div class="mb-3">
                    <label>Category Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description') }}</textarea>
                </div>

                <button class="btn btn-primary">
                    Save Category
                </button>

            </form>

        </div>

    </div>

</div>

@endsection