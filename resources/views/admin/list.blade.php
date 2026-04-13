@extends('layouts.common_content')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Admin User List</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">admin user list</li>
    </ol>
  </div>
</div>
@endsection

@section('content')

<div class="app-content">
                            
  <!--begin::Container-->
  <div class="container-fluid">
      <a href="{{ route('admin.add') }}" class="btn btn-primary">Add New</a>

    <!--begin::Row-->
    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">
              <div class="col-md-4">
                  <form method="get" name="search_admin" action= "{{ route('admin.list') }}" class="d-flex">
                      <input
                        type="text"
                        class="form-control"
                        name="search"
                        placeholder="Search data"
                        value="<?php if (isset($_GET['search']) && $_GET['search'])  echo $_GET['search'] ?>" 
                      />
                      <button class="btn btn-primary mx-2">Search</button>
                      <a href="{{ url()->current() }}" class="btn btn-warning">Reset</a>
                  </form>
              </div>
              <div class="col-md-4">

              </div>
              <div class="col-md-4">
              </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact No.</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($adminList as $admin)
                <tr class="align-middle">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $admin->fullname }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->phone_number }}</td>
                  <td class="btn-style">
                    @if($admin->is_active == 1)
                      <button class="btn btn-warning" onclick="changeStatus(0, {{ $admin->id }})">Deactive</button>
                    @else
                      <button class="btn btn-primary" onclick="changeStatus(1, {{ $admin->id }})">Active</button>
                    @endif
                    <a href="{{ route('admin.edit',$admin->id) }}" class="btn btn-secondary"> <i class="nav-icon bi bi-pencil-square"></i> </a>

                    <form method="POST" action="{{ route('admin.destroy', $admin->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete"><i class="nav-icon bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                {{ $adminList->links() }}
            </ul>
          </div>
        </div>
        <!-- /.card -->      
      </div>
      <!-- /.col -->
      
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>

@endsection


@section('js')
  <script src="{{ asset('js/admin.js') }}"></script>
@endsection