<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->

    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">

      @if (Route::has('login'))
          <nav class="flex items-center justify-end gap-4">
              @auth
                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name  }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('my-account') }}">{{ __('My Account') }}</a>
                        <a class="dropdown-item" href="{{ route('change-password') }}">{{ __('Change Password') }}</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
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
                      class="btn btn-outline-secondary"
                  >
                      Log in
                  </a>
              @endauth
          </nav>
      @endif

      
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>