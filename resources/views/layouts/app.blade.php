<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Digital Library')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f7f8fc;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #152b4a;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .hero {
            background: linear-gradient(120deg, #152b4a, #315b88);
            color: white;
            padding: 75px 20px;
            border-radius: 0 0 25px 25px;
        }

        .book-card {
            border: 0;
            border-radius: 12px;
            overflow: hidden;
            transition: .2s;
        }

        .book-card:hover {
            transform: translateY(-4px);
        }

        .book-cover {
            height: 220px;
            object-fit: cover;
            background: #e9edf4;
        }

        footer {
            background: #152b4a;
            color: white;
            padding: 25px;
            margin-top: 60px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Digital Library
        </a>

        <button class="navbar-toggler bg-light" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                </li>

                @auth

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.bookmarks') }}">
                            My Bookmarks
                        </a>
                    </li>

                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                Admin
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm ms-lg-2">
                                Logout
                            </button>
                        </form>
                    </li>

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-light btn-sm ms-lg-2"
                           href="{{ route('register') }}">
                            Register
                        </a>
                    </li>

                @endauth

            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

<main>
    @yield('content')
</main>

<footer class="text-center">
    <div class="container">
        <h5>Digital Library</h5>
        <p class="mb-0">Discover, read and learn.</p>
        <small>© {{ date('Y') }} Digital Library</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>