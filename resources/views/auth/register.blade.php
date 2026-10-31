@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width:450px">

        <div class="card-body p-4">

            <h3 class="text-center mb-4">Create Account</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name"
                           class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">
                    Register
                </button>

            </form>

            <p class="text-center mt-3">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </p>

        </div>

    </div>

</div>

@endsection