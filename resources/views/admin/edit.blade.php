@extends('layouts.common_content')

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Edit Admin</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page">edit</li>
    </ol>
  </div>
</div>
@endsection


@section('content')

<div class="col-md-2">

</div>
<div class="col-md-8">

  <div class="card card-info card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header">
      <div class="card-title">Edit Admin</div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form action="{{ route('admin.update', $user->id) }}" class="needs-validation" method="POST">
      @csrf
      @method('PUT')
      <!--begin::Body-->
      <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="first_name" class="form-label">First name*</label>
            <input
              type="text"
              class="form-control"
              id="first_name"
              name="first_name"
              value = "{{ $user->first_name }}"
            />
            @error('first_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="middle_name" class="form-label">Middle name</label>
            <input
              type="text"
              class="form-control"
              id="middle_name"
              name="middle_name"
              value = "{{ $user->middle_name }}"
            />
            @error('middle_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="last_name" class="form-label">Last name*</label>
            <input
              type="text"
              class="form-control"
              id="last_name"
              name="last_name"
              value = "{{ $user->last_name }}"
            />
            @error('last_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="email" class="form-label">Email*</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              value = "{{ $user->email }}"
            />
            @error('email')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="phone_number" class="form-label">Mobile No</label>
            <input
              type="text"
              class="form-control"
              id="phone_number"
              name="phone_number"
              value = "{{ $user->phone_number }}"
              
            />
            @error('phone_number')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            
          </div>
          <!--end::Col-->
         
        </div>
        <!--end::Row-->
      </div>
      <!--end::Body-->
      <!--begin::Footer-->
      <div class="card-footer">
        <button class="btn btn-info" type="submit">Submit</button>
        <a href="{{ route('admin.list') }}" class="btn btn-info" type="back" >Back</a>
      </div>
      <!--end::Footer-->
    </form>
  <!--end::Form-->
</div>

@endsection