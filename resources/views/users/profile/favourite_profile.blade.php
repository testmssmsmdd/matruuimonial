@extends('layouts.user.app')

@section('title') Favourite Profile @endsection

@section('style')

@endsection
<link rel="stylesheet" href="{{ asset('css/fav_profile.css') }}" />
@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- LEFT: FILTERS -->
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="mb-3">Filters</h5>
              <button class="btn btn-outline-primary d-block d-md-none" type="button" id="filterToggleBtn">
                <i class="bi bi-chevron-compact-up"></i>
              </button>
              <div class="accordion show" id="filterAccordion_full">
                <form method="get" name="filter_form" id="filter_form" action="{{ route('user.favourite_profile') }}">
                  <div class="accordion" id="filterAccordion">
                    <!-- Gender -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#genderCollapse">
                          Gender
                        </button>
                      </h2>
                      <div id="genderCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          <select class="form-select" name="gender">
                            <option value="">All</option>
                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Marital Status -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#maritalCollapse">
                          Marital Status
                        </button>
                      </h2>
                      <div id="maritalCollapse" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <select class="form-select" name="marital_status">
                            <option value="">All</option>
                            <option value="Never_Married" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Never_Married') echo 'selected'; ?>>Never Married</option>
                            <option value="Divorced" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                            <option value="Widowed" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                            <option value="Mithi_Jibh_Cancel" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Mithi_Jibh_Cancel') echo 'selected'; ?>>Mithi Jibh Cancel</option>
                            <option value="Broken_Engagement" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Broken_Engagement') echo 'selected'; ?>>Broken Engagement</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- City -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cityCollapse">
                          City
                        </button>
                      </h2>
                      <div id="cityCollapse" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <select class="form-select" name="city">
                            <option value="">All</option>
                            @foreach($cityList as $city)
                              <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Age -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ageCollapse">
                          Age Range
                        </button>
                      </h2>
                      <div id="ageCollapse" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <input type="number" name="min_age" id="min_age" class="form-control mb-2" placeholder="Min Age" value="{{ request('min_age') }}">
                          <input type="number" name="max_age" id="max_age" class="form-control" placeholder="Max Age" value="{{ request('max_age') }}">
                        </div>
                      </div>
                    </div>

                    <!-- Name/ Religion -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#searchCollapse">
                          Name / Religion
                        </button>
                      </h2>
                      <div id="searchCollapse" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <input type="text" name="name" class="form-control" placeholder="Enter name or religion" value="{{ request('name') }}">
                        </div>
                      </div>
                    </div>

                    <!-- Education -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#educationCollapse">
                          Education
                        </button>
                      </h2>
                      <div id="educationCollapse" class="accordion-collapse collapse">
                        <div class="accordion-body">
                         <input type="text" id="education" name="education" class="form-control" placeholder="Education" value="<?php if (isset($_GET['education']) && $_GET['education'])  echo $_GET['education'] ?>" />
                        </div>
                      </div>
                    </div>

                    <!-- Profession -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#professionCollapse">
                          Profession
                        </button>
                      </h2>
                      <div id="professionCollapse" class="accordion-collapse collapse">
                        <div class="accordion-body">
                         <input type="text" id="profession" name="profession" class="form-control" placeholder="profession" value="<?php if (isset($_GET['profession']) && $_GET['profession'])  echo $_GET['profession'] ?>" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Buttons -->
                  <div class="gap-2 mt-3">
                    <button class="btn btn-success">Apply Filters</button>
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary mx-2">Reset Filters</a>
                  </div>
                  <input type="hidden" name="sort_by" id="sort_by" value="" />
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT: FILTERS -->
        <div class="col-md-9">
            <section class="py-5">
                <div class="container">

                    <!-- Profiles Grid -->
                    <div class="row g-4">
                        @if(count($profilelist) > 0)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Favourite Profiles</h5>

                            <form method="get" name="search_profile" action="{{ route('user.favourite_profile') }}">
                              <input type="hidden" name="sort_by" id="" value="" />
                                <select class="form-select w-auto m-2" name="sorting" id="sorting">
                                  <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest</option>
                                  <option value="age" {{ request('sort_by') == 'age' ? 'selected' : '' }}>Age</option>
                                  <option value="location" {{ request('sort_by') == 'location' ? 'selected' : '' }}>Location</option>
                                </select>
                            </form>
                          </div>
                            @foreach($profilelist as $fav)
                                @php 
                                  $profile = $fav->profile; 
                                  $fullAddress = $profile->current_address . ', ' . $profile->city->name . ', ' . $profile->state->name;
                                  $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 100);
                                @endphp

                                <div class="col-12 col-md-6 col-xl-6 mb-3">
                                    <div class="card profile-card h-100">
                                        <div class="row g-0 align-items-center">

                                            <!-- Image -->
                                            <div class="col-4 text-center p-2">
                                                @if($profile?->profile_photo?->image)
                                                    <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}"
                                                         class="img-fluid rounded profile-img">
                                                @else
                                                    @if($profile->gender == "Male")
                                                      <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                                    @else
                                                      <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                                    @endif
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="col-8">
                                                <div class="card-body py-2">
                                                    <h6 class="mb-1 fw-bold">
                                                        {{ $profile->first_name }} {{ $profile->last_name }}
                                                    </h6>

                                                    <small class="text-muted d-block">
                                                        Occupation: {{ $profile->occupation ?? 'N/A' }},<br/>
                                                        Age: {{ $profile->age ?? 'N/A' }} Years,<br/>
                                                        Address: {{ $shortAddress }}
                                                        <span class="full-text d-none">{{ $fullAddress }}</span>
                                                    </small>

                                                   
                                                    <!-- Buttons -->
                                                    <div class="mt-2 d-flex gap-2 flex-wrap">
                                                        <a href="{{ route('user.getprofile',$profile->id) }}"
                                                           class="btn btn-success btn-sm flex-fill">
                                                            View Profile
                                                        </a>
                                                        @if(Auth::user()?->role == "User")
                                                          <button class="btn btn-danger btn-sm flex-fill" onclick="BookmarkFunction({{ $profile->id }},this)">
                                                                ❤️ Favourited
                                                          </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <nav class="mt-3">
                            <ul class="pagination justify-content-center">
                              {{ $profilelist->links() }}
                            </ul>
                        </nav>
                      @else
                        <h2 class="text-center">No Record Found</h2>
                      @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/profile/favourite_profile.js') }}"></script>
@endsection