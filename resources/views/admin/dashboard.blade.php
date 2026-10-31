@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Admin Dashboard</h2>

        <span class="badge bg-primary">Administrator</span>

    </div>

    <div class="row g-4">

        <div class="col-md-3 col-6">
            <div class="card shadow-sm p-4">
                <h6>Total Books</h6>
                <h2>{{ $totalBooks }}</h2>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card shadow-sm p-4">
                <h6>Categories</h6>
                <h2>{{ $totalCategories }}</h2>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card shadow-sm p-4">
                <h6>Users</h6>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card shadow-sm p-4">
                <h6>Downloads</h6>
                <h2>{{ $totalDownloads }}</h2>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mt-5">

        <div class="card-body">

            <h5>Recently Added Books</h5>

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Author</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($recentBooks as $book)

                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                {{ $book->is_published ? 'Published' : 'Draft' }}
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

            <a href="{{ route('admin.books.index') }}"
               class="btn btn-primary">
                Manage Books
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-outline-primary">
                Manage Categories
            </a>

        </div>

    </div>

    <div class="card shadow-sm mt-4">

        <div class="card-body">

            <h5>Recent Downloads</h5>

            <table class="table">

                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Book</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($recentDownloads as $download)

                        <tr>
                            <td>{{ $download->user?->name ?? 'Deleted user' }}</td>
                            <td>{{ $download->book?->title ?? 'Deleted book' }}</td>
                            <td>{{ $download->created_at->format('d M Y') }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection