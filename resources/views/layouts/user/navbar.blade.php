<nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('/') }}">
      <span class="me-2">🏠</span> Matrimonial
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarText">

      <!-- Left Menu -->
      
      <!-- Right Button -->
      <div class="ms-auto">
        <ul class="navbar-nav">
          @if(Auth::user()?->role=="User")
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.create_profile') }}">My Profile</a>
            </li>
          @endif
          @if(Auth::user()?->role=="Admin" || Auth::user()?->role=="Super_Admin")
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard.index') }}">Dashboard</a>
            </li>
          @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('/') }}">Home</a>
            </li>
          @if(Auth::user()?->role=="User")
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.favourite_profile') }}">Favourite Profile</a>
            </li>
          @endif
          @auth
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name  }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    {{-- <a class="dropdown-item" href="{{ route('change-password') }}">{{ __('Change Password') }}</a> --}}


                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a> --}}

                    <a class="dropdown-item logout-btn" href="#">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
          @else
              <a
                  href="{{ route('login') }}"
                  class="btn btn-success px-3"
              >
                  Log in
              </a>
          @endauth
        </ul>
      </div>
    </div>
  </div>
</nav>