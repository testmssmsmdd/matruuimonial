@extends('layouts.user.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/profiles.css') }}" />
@endsection

@section('content')
<div class="container mt-4 mb-4">
  <div class="profiles-page">
    <div class="row g-4">
      <div class="col-12 col-lg-3">
        <div class="card filters-card filters-sticky">
          <div class="card-body">
            <div class="mb-3">
              <h5 class="filters-title mb-1">Quick Search</h5>
              <input
                type="text"
                id="name"
                name="name"
                form="search_profile"
                class="form-control"
                value="{{ request('name') }}"
                placeholder="Search by name, education, or profession"
              />
            </div>
            <div class="mb-3">
              <h5 class="filters-title mb-1">Filters</h5>
              <p class="filters-subtitle mb-0">Refine profiles by your preferences.</p>
            </div>

            <form method="get" id="search_profile" name="search_profile" action="{{ route('user',['username' => request()->route('username') ?? '']) }}">
              <div class="accordion filter-accordion" id="filterAccordion">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#genderCollapse">
                      Gender
                    </button>
                  </h2>
                  <div id="genderCollapse" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                      <select class="form-select" id="gender" name="gender">
                        <option value="">All</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#maritalCollapse">
                      Marital Status
                    </button>
                  </h2>
                  <div id="maritalCollapse" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <select class="form-select" id="marital_status" name="marital_status">
                        <option value="">All</option>
                        <option value="Never_Married" {{ request('marital_status') == 'Never_Married' ? 'selected' : '' }}>Never Married</option>
                        <option value="Divorced" {{ request('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ request('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="Mithi_Jibh_Cancel" {{ request('marital_status') == 'Mithi_Jibh_Cancel' ? 'selected' : '' }}>Mithi Jibh Cancel</option>
                        <option value="Broken_Engagement" {{ request('marital_status') == 'Broken_Engagement' ? 'selected' : '' }}>Broken Engagement</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cityCollapse">
                      City
                    </button>
                  </h2>
                  <div id="cityCollapse" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <select class="form-select" id="city" name="city">
                        <option value="">All</option>
                        @foreach($cityList as $city)
                          <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ageCollapse">
                      Age Range
                    </button>
                  </h2>
                  <div id="ageCollapse" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <input type="number" id="min_age" name="min_age" class="form-control mb-2" placeholder="Min Age" min="0" value="{{ request('min_age') }}" />
                      <input type="number" id="max_age" name="max_age" class="form-control" placeholder="Max Age" min="0" value="{{ request('max_age') }}" />
                    </div>
                  </div>
                </div>

              </div>

              <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-theme">Apply Filters</button>
                <a href="{{ url()->current() }}" class="btn btn-theme-outline">Reset Filters</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-9">
        @if(count($profilelist) > 0)
          <div class="card listing-card mb-4">
            <div class="card-body">
              <h5 class="listing-title mb-1">Matching Profiles</h5>
              <p class="listing-subtitle mb-0">Browse responsive profile cards with quick actions.</p>
            </div>
          </div>

          <div class="row" id="profile_list_items">
            @foreach($profilelist as $profile)
              @php
                $fullAddress = ($profile->current_address ?? '-') . ', ' . ($profile->city->name ?? '-') . ', ' . ($profile->state->name ?? '-');
                $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 90);
              @endphp
              <div class="col-12 col-md-6 col-xl-6 mb-3">
                <div class="card profile-card h-100">
                  <div class="row g-0 align-items-center">
                    <div class="col-12 col-sm-4 text-center">
                      <div class="profile-media">
                        @if($profile?->profile_photo?->image)
                          <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="user-avatar" class="img-fluid profile-img">
                        @else
                          @if($profile->gender == "Male")
                            <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-fluid profile-img">
                          @else
                            <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-fluid profile-img">
                          @endif
                        @endif
                      </div>
                    </div>
                    <div class="col-12 col-sm-8">
                      <div class="card-body profile-card-body">
                        <a href="{{ route('user.getprofile',$profile->slug) }}" style="text-decoration: none; color: inherit;">
                          <h6 class="profile-name mb-2">{{ $profile->first_name }} {{ $profile->last_name }}
                          </h6>
                        </a>

                        <small class="profile-summary d-block">
                          <strong>Occupation:</strong> {{ $profile->occupation ?? 'N/A' }}<br/>
                          <strong>Age:</strong> {{ $profile->age ?? 'N/A' }} Years<br/>
                          <strong>Address:</strong> {{ $shortAddress }}
                        </small>

                        <a href="{{ route('user.getprofile',$profile->slug) }}" class="btn btn-theme btn-sm w-100">
                          View Profile
                        </a>
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
            <p class="mb-0">Try changing filters to discover more profiles.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection


@section('js')
  <script>
    document.getElementById('search_profile').addEventListener('submit', function(e) {
      const minAge = document.getElementById('min_age').value ? parseInt(document.getElementById('min_age').value) : null;
      const maxAge = document.getElementById('max_age').value ? parseInt(document.getElementById('max_age').value) : null;

      if (minAge !== null && maxAge !== null && minAge > maxAge) {
          alert('Minimum age cannot be greater than maximum age');
          e.preventDefault();
      }
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const collapseItems = document.querySelectorAll('.filter-accordion .accordion-collapse');
      collapseItems.forEach((item, index) => {
        if (index === 0) {
          item.classList.add('show');
        }
      });
    });
  </script>
  <script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
  
  <script>
    var username = "{{ request()->username }}";

    let page = 1;
    let loading = false;
    let hasMore = true;

    $(window).on("scroll", function () {

        if (loading || !hasMore) return;

        let scrollTop = $(window).scrollTop();
        let windowHeight = $(window).height();
        let documentHeight = $(document).height();

        if (scrollTop + windowHeight >= documentHeight - 100) {
            loadMore();
        }
    });

    function loadMore() {
        loading = true;

        page++;

        $.ajax({
            url: "/user/"+ username +"?page=" + page,
            type: "GET",
            dataType: "json",
            success: function (res) {
                if (res.html.trim() !== "") {
                    $('#profile_list_items').append(res.html);
                }

                if (!res.has_more) {
                    hasMore = false;
                    $('#profile_list_items').append("<span class='text-center' style='font-size=0.86rem'>No More Record found</span>");
                }

                loading = false;
            },
            error: function () {
                loading = false;
            }
        });
    }

    let scrollTimeout;

    $(window).on("scroll", function () {
        clearTimeout(scrollTimeout);

        scrollTimeout = setTimeout(function () {

            if (loading || !hasMore) return;

            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let documentHeight = $(document).height();

            if (scrollTop + windowHeight >= documentHeight - 100) {
                loadMore();
            }

        }, 200);
    });
    </script>
@endsection

