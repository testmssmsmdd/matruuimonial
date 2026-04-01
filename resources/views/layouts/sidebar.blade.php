<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('/') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">{{ config('app.name') }}</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation"
      >
        @if(Auth::user()->role === "Super_Admin")
        <li class="nav-item">
          <a href="{{ route('admin.list') }}" class="nav-link">
            <i class="nav-icon bi bi-palette"></i>
            <p>Admin</p>
          </a>
        </li>
        @endif
        @if(Auth::user()->role === "Admin")
        <li class="nav-item">
          <a href="{{ route('admin.profile.list') }}" class="nav-link">
            <i class="nav-icon bi bi-palette"></i>
            <p>Profile</p>
          </a>
        </li>
        @endif

      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
     