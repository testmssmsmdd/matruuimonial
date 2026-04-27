@extends('layouts.user.app')

@section('title')
Matrimonial
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/user_welcome.css') }}">
@endsection

@section('content')
  @include('layouts.user.search')

  <section class="py-5 home-profiles-section">
      <div class="container home-profiles-wrap">

          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 home-section-head">
              <div>
                  <span class="home-section-badge">Most Viewed Matches</span>
                  <h4 class="fw-bold mb-0">Profiles</h4>
                  <p class="home-section-subtitle mb-0">Explore verified profiles curated by preference and activity.</p>
              </div>
              <a href="{{ route('user.profiles') }}" class="btn btn-theme-outline btn-sm px-3">
                  <i class="bi bi-grid me-1"></i> View All
              </a>
          </div>

          <div class="row g-4">

              @forelse($randomProfiles as $profile)
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                      <div class="card profile-card clickable-profile-card h-100 border-0" data-profile-url="{{ route('user.getprofile',$profile->slug) }}">
                          <div class="profile-image-wrap">
                              @if($profile?->profile_photo?->image)
                                <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="user-avatar" class="profile-image">
                                @else
                                  @if($profile->gender == "Male")
                                  <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="profile-image">
                                  @else
                                  <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="profile-image">
                                  @endif
                              @endif
                          </div>

                          <div class="card-body text-start">
                              <h6 class="profile-name">
                                  {{ $profile->first_name }} {{ $profile->last_name }}
                              </h6>
                              <div class="profile-meta">
                                  <div class="profile-meta-item">
                                      <i class="bi bi-hourglass-split"></i>
                                      <span><strong>Age:</strong> {{ $profile->age ?? '-' }} Years</span>
                                  </div>
                                  <div class="profile-meta-item">
                                      <i class="bi bi-briefcase"></i>
                                      <span><strong>Occupation:</strong> {{ $profile->occupation ?? '-' }}</span>
                                  </div>
                                  <div class="profile-location">
                                      <i class="bi bi-geo-alt me-1"></i>
                                      {{ $profile->current_address ?? '-' }}, {{ $profile->city->name ?? '-' }}, {{ $profile->state->name ?? '-' }}
                                  </div>
                              </div>
                              <div class="mt-2 d-flex gap-2 flex-wrap">
                                  <a href="{{ route('user.getprofile',$profile->slug) }}"
                                     class="btn btn-theme view-profile-btn flex-fill">
                                      <i class="bi bi-person-lines-fill me-1"></i> View Profile
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              @empty
                  <div class="col-12">
                    <p class="text-center empty-state mb-0">No record found.</p>
                  </div>
              @endforelse
          </div>
      </div>
  </section>
  @include('layouts.user.how_it_works')

@endsection

@section('js')
<script>
window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};

</script>
<script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
@endsection
