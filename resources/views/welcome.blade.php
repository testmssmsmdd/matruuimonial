@extends('layouts.user.app')

@section('title')
Home Page
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
                                <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="user-avatar" class="img-circle img-fluid card-image-top" style="height:255px;">
                                @else
                                  @if($profile->gender == "Male")
                                  <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid" style="height:255px;">
                                  @else
                                  <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid" style="height:255px;">
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
<script type="text/javascript">
    document.getElementById('searchForm').addEventListener('submit', function(e) {

        let age = document.getElementById('age_range').value;
        document.getElementById('min_age').value = '';
        document.getElementById('max_age').value = '';
        if (age) {
            let parts = age.split('-');

            document.getElementById('min_age').value = parts[0];
            document.getElementById('max_age').value = parts[1];
        }
    });

    document.getElementById('search_profile').addEventListener('submit', function(e) {

        let minAge = document.getElementById('min_age').value;
        let maxAge = document.getElementById('max_age').value;

        minAge = minAge ? parseInt(minAge) : null;
        maxAge = maxAge ? parseInt(maxAge) : null;

        if (minAge !== null && maxAge !== null && minAge > maxAge) {
            alert('Minimum age cannot be greater than maximum age');
            e.preventDefault();
        }
    });

    function BookmarkFunction(profileId, el) {
        var loggedIn = {{ auth()->check() ? 'true' : 'false' }};
        if(loggedIn == true)
        {
            fetch(`/user/profile/favourite`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    profile_id: profileId
                })
            })
            .then(res => res.json())
            .then(data => {

                if (data.status === 'added') {
                    el.classList.remove('bi-bookmarks');
                    el.classList.add('bi-bookmark-fill', 'text-danger');
                } else {
                    el.classList.remove('bi-bookmarks-fill', 'text-danger');
                    el.classList.add('bi-bookmark');
                }

            });
        }else{
            swal.fire({
              title: "Please Login to add profile",
            });
        }
    }
</script>

@endsection