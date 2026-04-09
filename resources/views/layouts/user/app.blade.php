<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
      .help-block{
        color: red;
      }

      /* Common button style */
    .btn-profile,
    .btn-interest {
        border-radius: 8px;
        padding: 8px 14px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    /* View Profile (Primary action) */
    .btn-profile {
        background: #2f855a;
        color: #fff;
        border: none;
    }

    .btn-profile:hover {
        background: #276749;
    }

    /* Interested (Secondary action) */
    .btn-interest {
        background: #f8d7da;
        color: #c53030;
        border: none;
    }

    .btn-interest:hover {
        background: #f1b0b7;
        color: #9b2c2c;
    }

    /* Desktop alignment */
    @media (min-width: 768px) {
        .col-md-3 .d-grid {
            display: flex !important;
            flex-direction: column;
            align-items: flex-end;
        }

        .btn-profile,
        .btn-interest {
            width: 140px;
        }
    }

    </style>
    @yield('style')
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />

    @include('layouts.user.navbar')

    @yield('content')


    @include('layouts.user.footer')
    </div>

      <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>

      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <script src="{{ asset('js/sweetalert.js') }}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

      <script>

          document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.logout-btn').forEach(function(button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure you want to logout?',
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, logout!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                });
            });

        });
      </script>

      @yield('js')
  </body>
</html>