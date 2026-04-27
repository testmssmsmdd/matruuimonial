
<nav class="navbar navbar-expand-lg sticky-top site-navbar py-2">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('/') }}">
      <span class="brand-badge"><i class="bi bi-heart-fill"></i></span>
      <span>Matrimonial</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
      <div class="ms-auto">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          
          @if(Auth::user()?->role=="Admin" || Auth::user()?->role=="Super_Admin")
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard.index') }}">Dashboard</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('/') }}">Home</a>
          </li>
          @auth
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name  }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if(Auth::user()?->role=="User")
                        <a class="dropdown-item" href="{{ route('users.create_profile') }}">My Profile</a>
                        <a class="dropdown-item" href="{{ route('user.favourite_profile') }}">Favourite Profile</a>
                    @endif

                    <a class="dropdown-item" href="{{ route('change-password') }}">{{ __('Change Password') }}</a>
                    <a class="dropdown-item logout-btn" href="{{ route('logout') }}">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
              </li>
          @else
              <li class="nav-item mt-2 mt-lg-0 ms-lg-2">
                <a href="{{ route('login') }}" class="btn-nav-login">
                    Log in
                </a>
              </li>
          @endauth
        </ul>
      </div>
    </div>
  </div>
</nav>