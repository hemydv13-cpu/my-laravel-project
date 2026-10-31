@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container py-5">

    <div class="card shadow mx-auto" style="max-width:450px">

        <div class="card-body p-4">

            <h3 class="text-center mb-4">Login</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password"
                           class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">
                    Login
                </button>

            </form>

            <p class="text-center mt-3">
                New student?
                <a href="{{ route('register') }}">Create account</a>
            </p>

        </div>

    </div>

</div>

@endsection