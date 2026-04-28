@extends('layouts.common_content')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Profile List</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="{{ route('admin.profile.list') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
  <!--begin::Container-->
  <div class="container-fluid">
        <form method="get" name="search_profile" action= "{{ route('admin.profile.list') }}">
          <div class="row">

              <div class="col-md-3">
                <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                      <option selected value="">All</option>
                      <option value="Male" <?php if(isset($_GET['gender']) && $_GET['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                      <option value="Female" <?php if(isset($_GET['gender']) && $_GET['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
              </div>

              <div class="col-md-3">
                <label for="city" class="form-label">City</label>
                  <select class="form-select" id="city" name="city">
                      <option selected disabled value="">Choose...</option>
                      @foreach($cityList as $city)
                        <option value="{{ $city->id }}" <?php echo (isset($_GET['city']) && $_GET['city'] == $city->id) ? 'selected' : ''; ?>>{{ $city->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-md-3">
                <label for="name" class="form-label">Religion/name</label>
                <input type="text" id="" name="name" class="form-control" value="<?php if (isset($_GET['name']) && $_GET['name'])  echo $_GET['name'] ?>" />
              </div>
              <div class="col-md-3 mt-4 mr-3">
                <button class="btn btn-primary mt-2">Search</button>
                <a href="{{ url()->current() }}" class="btn btn-warning mt-2 mx-2">Reset</a>
                <a href="{{ route('admin.profile.create') }}" class="btn btn-primary mt-2 ml-3">Add New</a>
              </div>
          </div>
        </form>

      <div class="row mt-2">
        <div class="col-md-12">
          <div class="card mb-4">
              <!--begin::Container-->
                  <section class="content">
                    <!-- Default box -->
                    <div class="card card-solid">
                      <div class="card-body pb-0">
                        <div class="row">
                          @if(count($profilelist) > 0)
                          @foreach($profilelist as $profile)
                          @php
                              $fullAddress = $profile->current_address . ', ' . $profile->city->name . ', ' . $profile->state->name;
                              $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 100);
                          @endphp                       
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column p-3">
                              <div class="card bg-light d-flex flex-fill">
                                <div class="card-header border-bottom-0 {{ $profile->profile_status == 1 ? 'text-success' : 'text-danger' }}">
                                  {{ $profile->profile_status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                                <div class="card-body pt-2">
                                  <div class="row">
                                    <div class="col-7">
                                      <h2 class="lead"><b>{{ $profile->first_name }} {{ $profile->last_name }}</b></h2>
                                      <p class="text-muted text-sm"><b>Address: </b>
                                        <span class="short-text">{{ $shortAddress }}</span>
                                        <span class="full-text d-none">{{ $fullAddress }}</span>
                                        @if(strlen($fullAddress) > 100)
                                            <a href="javascript:void(0);" class="read-more text-primary">Read more</a>
                                        @endif
                                      </p>
                                      <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> {{ $profile->caste }}</</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ str_replace('_', ' ',$profile->marital_status) }}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ $profile->age }} Years</li>
                                      </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                      @if($profile?->profile_photo?->image)
                                        <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="user-avatar" class="img-circle img-fluid">
                                      @else
                                        @if($profile->gender == "Male")
                                          <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                        @else
                                          <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                        @endif
                                      @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <div class="text-right">
                                                                      
                                    <a href="{{ route('admin.profile.details',$profile->id) }}" class="btn btn-primary mx-2"> <i class="nav-icon bi bi-eye"></i> 
                                    </a>
                                    <a href="{{ route('admin.profile.edit',$profile->id) }}" class="btn btn-secondary"> <i class="nav-icon bi bi-pencil-square"></i> 
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.profile.delete_profile', $profile->id) }}" class="btn btn-danger bg-border-none">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-delete"><i class="nav-icon bi bi-trash"></i></button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.profile.change_status', $profile->id) }}" class="btn btn-danger bg-border-none">
                                      @csrf
                                      <button class="btn btn-secondary btn-status">{{ $profile->profile_status ? 'Inactive':'active' }}</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <!-- /.card -->
                          @endforeach
                          @else
                            <h2 class="text-center">No Record Found</h2>
                          @endif
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </section>

              <div class="card-footer">
                  <nav aria-label="Contacts Page Navigation">
                      <ul class="pagination justify-content-end m-0">
                          {{ $profilelist->links() }}
                      </ul>
                  </nav>
              </div>
              <!--end::Container-->
        </div>
      </div>
  </div>                   


@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
@endsection
