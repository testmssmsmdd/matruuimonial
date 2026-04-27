@extends('layouts.user.app')

@section('title') Favourite Profile @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/fav_profile.css') }}" />
@endsection

@section('content')
<div class="container mt-4 mb-4">
    <div class="favourite-page">
    <div class="row g-4">
        <!-- LEFT: FILTERS -->
        @include('layouts.search_filter', ['actionRoute' => route('user.favourite_profile')])

        <!-- RIGHT: FILTERS -->
        <div class="col-12 col-lg-9">
            <section>
                <div class="row g-4" id="favourite_profile_list">
                    @if(count($profilelist) > 0)
                        <div class="card listing-card mb-2">
                          <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-0">
                                <div>
                                  <h5 class="listing-title mb-1">Favourite Profiles ({{ $favouriteProfilesCount ?? ''}})</h5>
                                  <p class="listing-subtitle mb-0">All your saved profiles in one responsive view.</p>
                                </div>

                                <form method="get" name="search_profile" action="{{ route('user.favourite_profile') }}">
                                  <input type="hidden" name="sort_by" id="" value="" />
                                    <select class="form-select profiles-sort-select w-auto" name="sorting" id="sorting">
                                      <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest</option>
                                      <option value="age" {{ request('sort_by') == 'age' ? 'selected' : '' }}>Age</option>
                                    </select>
                                </form>
                            </div>
                          </div>
                        </div>
                        @foreach($profilelist as $fav)
                            @php 
                              $profile = $fav->profile;
                              if (!$profile) {
                                  continue;
                              }
                              $profile->setAttribute('is_favourite', 1);
                              $fullAddress = $profile?->current_address . ', ' . $profile?->city?->name . ', ' . $profile?->state?->name;
                              $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 100);
                            @endphp
                            @include('layouts.profile_list')
                        @endforeach
                    </div>
                  @else
                    <div class="empty-state text-center">
                      <h5 class="mb-1">No Record Found</h5>
                      <p class="mb-0">Try adjusting filters to see favourite profiles.</p>
                    </div>
                  @endif
                </div>
            </section>
        </div>
    </div>
    </div>
</div>

@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/profile/profile.js') }}"></script>
@endsection