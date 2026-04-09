@extends('layouts.user.auth')

@section('title')
Matrimonial| Reset Page
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

            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  <form method="POST" action="{{ route('password.email') }}">
                      @csrf
                  <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4">
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-8">
                      <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!--end::Row-->
                </form>

                <p class="mb-1">
                  @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('login') }}">
                          {{ __('Login?') }}
                      </a>
                  @endif
                </p>
              </div>
              <!-- /.login-card-body -->
            </div>

          </div>
      </div>
  </div>
@endsection