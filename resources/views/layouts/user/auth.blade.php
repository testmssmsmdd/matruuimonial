<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/user_auth.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_icons.min.css') }}" crossorigin="anonymous" /> --}}
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    @yield('style')
  </head>
  <body class="d-flex flex-column min-vh-100">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet">
    @include('layouts.user.navbar')

    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        @yield('content')
    </main>

    @include('layouts.user.footer')
    </div>
      <script src="{{ asset('js/popper.min.js') }}" crossorigin="anonymous"></script>
      <script src="{{ asset('js/jquery.min.js') }}" crossorigin="anonymous"></script>
      <script src="{{ asset('js/sweetalert.js') }}"></script>

      <script src="{{ asset('js/datepicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>

      @yield('js')
  </body>
</html>