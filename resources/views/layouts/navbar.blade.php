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
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link">Home</a>
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
            @else

              <!--begin::User Menu Dropdown-->
              <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <img
                    src="./assets/img/user2-160x160.jpg"
                    class="user-image rounded-circle shadow"
                    alt="User Image"
                  />
                  <span class="d-none d-md-inline">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                  <!--begin::User Image-->
                  <li class="user-header text-bg-primary">
                    <img
                      src="./assets/img/user2-160x160.jpg"
                      class="rounded-circle shadow"
                      alt="User Image"
                    />
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2023</small>
                    </p>
                  </li>
                  <!--end::User Image-->
                  <!--begin::Menu Body-->
                  <li class="user-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                    <!--end::Row-->
                  </li>
                  <!--end::Menu Body-->
                  <!--begin::Menu Footer-->
                  <li class="user-footer">
                    <a href="#" class="btn btn-outline-secondary">Profile</a>
                    <a href="#" class="btn btn-outline-danger float-end">Sign out</a>
                  </li>
                  <!--end::Menu Footer-->
                </ul>
              </li>
              <!--end::User Menu Dropdown-->


            @endif

            
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>