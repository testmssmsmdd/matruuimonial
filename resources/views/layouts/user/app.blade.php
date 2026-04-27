<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/user_app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user_navbar.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    @yield('style')
  </head>
  <body>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />

    @include('layouts.user.navbar')

    @yield('content')


    @include('layouts.user.footer')
    </div>

      <script src="{{ asset('js/popper.min.js') }}" crossorigin="anonymous"></script>
      <script src="{{ asset('js/jquery.min.js') }}" crossorigin="anonymous"></script>
      <script src="{{ asset('js/sweetalert.js') }}"></script>
      <script src="{{ asset('js/datepicker.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="{{ asset('js/profile/common.js') }}"></script>
      @yield('js')
  </body>
</html>