@extends('layouts.user.app')

@section('title') Profile List @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/profiles.css') }}" />
@endsection

@section('content')
<div class="container mt-4 mb-4">
    <div class="profiles-page">
    <div class="row g-4">
        <!-- LEFT: FILTERS -->
        @include('layouts.search_filter', ['actionRoute' => route('user.profiles')])

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
                  @include('layouts.profile_list')

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
window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>
<script type="text/javascript" src="{{ asset('js/profile/profile.js') }}"></script>
@endsection