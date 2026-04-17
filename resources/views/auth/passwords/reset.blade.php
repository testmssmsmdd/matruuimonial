@extends('layouts.user.auth')

@section('title')
Matrimonial| Reset Password
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/auth_pages.css') }}">
@endsection

@section('content')
<div class="container login-page">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
            <div class="card login-shell">
                <div class="row g-0">
                    <div class="col-12 col-lg-5">
                        <div class="login-brand-panel">
                            <a href="{{ route('/') }}" class="text-decoration-none text-white mb-2">
                                <h3 class="login-brand-title mb-2">Matrimonial</h3>
                            </a>
                            <p class="login-brand-subtitle">Choose a strong new password to secure your account and continue your search with confidence.</p>
                            <ul class="login-brand-points">
                                <li><i class="bi bi-key"></i> Set a new password</li>
                                <li><i class="bi bi-shield-check"></i> Keep your account protected</li>
                                <li><i class="bi bi-heart"></i> Pick up where you left off</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-lg-7">
                        <div class="login-form-panel">
                            <h5 class="login-heading">Reset Password</h5>
                            <p class="login-subheading">Enter your email and choose a new password below.</p>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3">
                                    <span class="input-group-text">{{ $email }}</span>
                                </div>

                                <div class="mb-3">
                                    <div class="input-group login-input-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password"
                                            required
                                            autocomplete="new-password"
                                            placeholder="{{ __('Password') }}">

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

                                <div class="mb-3">
                                    <div class="input-group login-input-group">
                                        <input id="password-confirm" type="password"
                                            class="form-control"
                                            name="password_confirmation"
                                            required
                                            autocomplete="new-password"
                                            placeholder="{{ __('Confirm Password') }}">

                                        <span class="input-group-text">
                                            <i class="bi bi-shield-lock"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>

                                <div class="text-start login-links">
                                    <a href="{{ route('login') }}">
                                        {{ __('Sign In?') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
