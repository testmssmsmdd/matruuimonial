@foreach($profilelist as $profile)
    @php
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
                            @if(Auth::user()?->role != "Admin" && Auth::user()?->role != "Super_Admin")
                              @if($profile->is_favourite  == 0)
                                <button class="btn btn-danger btn-sm flex-fill" onclick="BookmarkFunction({{ $profile->id }},this)">
                                    ❤️
                                </button>
                              @else
                                <button
                                   class="btn btn-danger btn-sm flex-fill" onclick="BookmarkFunction({{ $profile->id }},this)">
                                    ❤️ Favourited
                                </button>
                              @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach