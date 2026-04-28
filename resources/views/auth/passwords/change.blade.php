@extends('layouts.common_content')

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Change Password</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
  </div>
</div>
@endsection

@section('content')

<div class="col-md-2">

</div>
<div class="col-md-8">
    <div class="card card-primary card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header">
        <div class="card-title">{{ __('Change Password') }}</div>
      </div>
      <!--end::Header-->
      <!--begin::Form-->
      <form action="{{ route('update-password') }}" method="POST">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
          <div class="mb-3">
            <label for="oldPasswordInput" class="form-label">Old Password</label>
                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                    placeholder="Old Password">
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
          </div>
          <div class="mb-3">
            <label for="newPasswordInput" class="form-label">New Password</label>
                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                    placeholder="New Password">
                @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
          </div>
          <div class="mb-3">
            <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                    placeholder="Confirm New Password">
          </div>
          
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!--end::Footer-->
      </form>
      <!--end::Form-->
    </div>
</div>
   
@endsection