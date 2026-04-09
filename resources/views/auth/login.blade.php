@extends('layouts.user.auth')

@section('title')
Matrimonial| Login Page
@endsection
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-5 col-xl-4">
            <!-- Logo -->
            <div class="text-center mb-2">
                <a href="{{ route('/') }}" class="text-decoration-none">
                    <h2 class="text-secondary"><b>Matrimonial</b></h2>
                </a>
            </div>
            <!-- Card -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input id="email" type="email"
                                    class="form-control  @error('login') is-invalid @enderror"
                                    name="login" required value="{{ old('login') }}"
                                    placeholder="Email" autofocus>

                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>

                            @error('login')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input id="password"  required type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    placeholder="Password"
                                    autocomplete="current-password">

                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        
                        <!-- Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Sign In
                            </button>
                        </div>
                        <!-- Links -->
                        <div class="text-left">
                            @if (Route::has('password.request'))
                                <a class="d-block mb-1" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>

                                <a href="{{ route('register') }}">
                                    Sign Up?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection