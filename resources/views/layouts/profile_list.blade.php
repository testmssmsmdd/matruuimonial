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
                        @if(Auth::user()?->role != "User" || !request()->routeIs('user'))
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