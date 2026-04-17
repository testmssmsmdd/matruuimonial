@extends('layouts.user.app')


@section('title')
Profile List
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/profiles.css') }}" />
@endsection

@section('content')
<div class="container mt-4 mb-4">
    <div class="profiles-page">
    <div class="row g-4">
        <!-- LEFT: FILTERS -->
        <div class="col-12 col-lg-3">
          <div class="card filters-card filters-sticky">
            <div class="card-body">
              <div class="mb-3">
                <h5 class="filters-title mb-1">Quick Search</h5>
                <input
                  type="text"
                  name="name"
                  form="filter_form"
                  class="form-control"
                  placeholder="Search by name, education, or profession"
                  value="{{ request('name') ?: request('education') ?: request('profession') }}"
                >
              </div>
              <div class="mb-3">
                <h5 class="filters-title mb-1">Filters</h5>
                <p class="filters-subtitle mb-0">Refine profiles by preferences and details.</p>
              </div>
              <button class="btn filter-toggle-btn d-block d-md-none mb-3" type="button" id="filterToggleBtn">
                <i class="bi bi-chevron-compact-down"></i>
              </button>
              <div id="filterAccordion_full" class="accordion collapse d-md-block">
                <form method="get" name="filter_form" id="filter_form" action="{{ route('user.profiles') }}">
                  <div class="accordion filter-accordion" id="filterAccordion">
                    <!-- Gender -->
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genderCollapse">
                          Gender
                        </button>
                      </h2>
                      <div id="genderCollapse" class="accordion-collapse collapse">
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
                          <select class="form-select" name="marital_status[]" id="marital_status" multiple="multiple">
                            <option value="Never_Married" <?php if(isset($_GET['marital_status']) &&  in_array('Never_Married', $_GET['marital_status'])) echo 'selected'; ?>>Never Married</option>
                            <option value="Divorced" <?php if(isset($_GET['marital_status']) && in_array('Divorced', $_GET['marital_status'])) echo 'selected'; ?>>Divorced</option>
                            <option value="Widowed" <?php if(isset($_GET['marital_status']) && in_array('Widowed', $_GET['marital_status'])) echo 'selected'; ?>>Widowed</option>
                            <option value="Mithi_Jibh_Cancel" <?php if(isset($_GET['marital_status']) && in_array('Mithi_Jibh_Cancel', $_GET['marital_status'])) echo 'selected'; ?>>Mithi Jibh Cancel</option>
                            <option value="Broken_Engagement" <?php if(isset($_GET['marital_status']) && in_array('Broken_Engagement', $_GET['marital_status'])) echo 'selected'; ?>>Broken Engagement</option>
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
                          <select class="form-select" name="city[]" id="city" multiple="multiple">
                            @foreach($cityList as $city)
                              <option value="{{ $city->id }}"
                                {{ in_array($city->id, request('city', [])) ? 'selected' : '' }}>
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

                    <input type="hidden" name="education" value="">
                    <input type="hidden" name="profession" value="">
                  </div>

                  <!-- Buttons -->
                  <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-theme">Apply Filters</button>
                    <a href="{{ url()->current() }}" class="btn btn-theme-outline">Reset Filters</a>
                  </div>
                  <input type="hidden" name="sort_by" id="sort_by" value="" />
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT: FILTERS -->
        <div class="col-12 col-lg-9">
            @if($profilelist->isNotEmpty())
              <div class="card listing-card mb-4">
                <div class="card-body">
               <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-0">
                <div>
                  <h5 class="listing-title mb-1">Matching Profiles</h5>
                  <p class="listing-subtitle mb-0">Browse responsive profile cards with quick actions.</p>
                </div>

                <form method="get" name="search_profile" action= "{{ route('user.profiles') }}">
                  <input type="hidden" name="sort_by" id="" value="" />
                    <select class="form-select profiles-sort-select w-auto" name="sorting" id="sorting">
                      <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest</option>
                      <option value="age" {{ request('sort_by') == 'age' ? 'selected' : '' }}>Age</option>
                    </select>
                </form>
              </div>
                </div>
              </div>
            <div class="row" id="profile_list">
                @foreach($profilelist as $profile)
                  @php
                      $fullAddress = $profile->current_address . ', ' . $profile->city->name . ', ' . $profile->state->name;
                      $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 100);
                  @endphp
                <div class="col-12 col-md-6 col-xl-6 mb-3">
                    <div class="card profile-card h-100">
                        <div class="row g-0 align-items-center">

                            <!-- Image -->
                            <div class="col-12 col-sm-4 text-center">
                                <div class="profile-media">
                                @if($profile?->profile_photo?->image)
                                    <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}"
                                         class="img-fluid profile-img">
                                @else
                                    @if($profile->gender == "Male")
                                      <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-fluid profile-img">
                                    @else
                                      <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-fluid profile-img">
                                    @endif
                                @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="col-12 col-sm-8">
                                <div class="card-body profile-card-body">
                                    <a href="{{ route('user.getprofile',$profile->slug) }}" style="text-decoration: none; color: inherit;">
                                        <h6 class="profile-name mb-2">
                                            {{ $profile->first_name }} {{ $profile->last_name }}
                                        </h6>
                                    </a>

                                    <small class="profile-summary d-block">
                                        <strong>Occupation:</strong> {{ $profile->occupation ?? 'N/A' }}<br/>
                                        <strong>Age:</strong> {{ $profile->age ?? 'N/A' }} Years<br/>
                                        <strong>Address:</strong> {{ $shortAddress }}
                                        <span class="full-text d-none">{{ $fullAddress }}</span>
                                    </small>

                                   
                                    <!-- Buttons -->
                                    <div class="mt-2 d-flex gap-2 flex-wrap">
                                        <a href="{{ route('user.getprofile',$profile->slug) }}"
                                           class="btn btn-theme btn-sm flex-fill">
                                            View Profile
                                        </a>
                                        @if(Auth::user()?->role != "Admin" && Auth::user()?->role != "Super_Admin")
                                          <button
                                            class="favourite-heart-btn"
                                            onclick="BookmarkFunction({{ $profile->id }},this)"
                                            aria-label="{{ $profile->is_favourite == 1 ? 'Remove from favourites' : 'Add to favourites' }}"
                                            title="{{ $profile->is_favourite == 1 ? 'Remove from favourites' : 'Add to favourites' }}">
                                              <i class="bi {{ $profile->is_favourite == 1 ? 'bi-heart-fill' : 'bi-heart' }}"></i>
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
            @else
                <div class="empty-state text-center">
                  <h5 class="mb-1">No Record Found</h5>
                  <p class="mb-0">Try changing your filters to discover more profiles.</p>
                </div>
            @endif
        </div>
    </div>
    </div>
</div>
@endsection


@section('js')
<script>
$(document).ready(function () {
    $('#marital_status').select2({
      placeholder: "Select a marital status",
      allowClear: true,
      width: '100%'
    });
    $('#city').select2({
        placeholder: "Select a city",
        allowClear: true,
        width: '100%'
    });
});
window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>
<script type="text/javascript" src="{{ asset('js/profile/profiles.js') }}"></script>
@endsection