@extends('layouts.user.app')

@section('title')
Home Page
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
  @include('layouts.user.search')

  <section class="py-5">
      <div class="container">

          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="fw-bold mb-0">Profiles</h4>
              <a href="{{ route('user.profiles') }}" class="btn btn-outline-primary btn-sm">
                  View All
              </a>
          </div>

          <!-- Profiles Grid -->
          <div class="row g-4">

              @forelse($profilelist as $profile)
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                      <div class="card profile-card h-100 shadow-sm border-0">

                          <!-- Image -->
                          <div class="position-relative">
                              @if($profile?->profile_photo?->image)
                                <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="user-avatar" class="img-circle img-fluid card-image-top h-255">
                                @else
                                  @if($profile->gender == "Male")
                                  <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid h-255">
                                  @else
                                  <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid h-255">
                                  @endif
                              @endif
                          </div>

                          <!-- Content -->
                          <div class="card-body text-start">
                              <h6 class="fw-semibold mb-1">
                                  {{ $profile->first_name }} {{ $profile->last_name }},
                              </h6>
                              <p class="text-muted small mb-2">
                                  Age: {{ $profile->age }} <br> 
                                  Occupation: {{ $profile->occupation }} <br>
                                  Address: {{ $profile->current_address }}, {{ $profile->city->name }},{{ $profile->state->name }}
                              </p>
                              <div class="mt-2 d-flex gap-2 flex-wrap">
                                  <a href="{{ route('user.getprofile',$profile->id) }}"
                                     class="btn btn-success flex-fill">
                                      View Profile
                                  </a>
                              </div>
                          </div>
                          @if($loop->iteration == 4)
                              @break
                          @endif
                      </div>
                  </div>
              @empty
                  <p class="text-center">No Record Found.</p>
              @endforelse
          </div>
      </div>
  </section>
  @include('layouts.user.how_it_works')

@endsection

@section('js')
window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};
<script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
@endsection