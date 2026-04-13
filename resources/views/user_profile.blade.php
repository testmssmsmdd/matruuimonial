@extends('layouts.user.app')

@section('title')
User Detail Page
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')

<div class="container mt-4">

  <!-- Back Button -->
  <a href="{{ route('user.profiles') }}" class="btn btn-outline-primary mb-3">
    ← Back
  </a>
  <!-- IMAGE -->
  <div class="card shadow-sm p-3 mb-3">
      <div class="row align-items-center">
          <!-- PROFILE IMAGE -->
          <div class="col-4 col-md-3 text-center mb-2 mb-md-0">
              <img src="{{ $profile->profile_photo?->image 
                          ? asset('/profile_photos/'.$profile->profile_photo->image) 
                          : ($profile->gender == 'Male' ? asset('/assets/img/man.png') : asset('/assets/img/women.png')) }}" 
                   class="img-fluid rounded-circle profile_img">
          </div>

          <!-- NAME & INFO -->
          <div class="col-8 col-md-9">
              <h4 class="mb-1">{{ $profile->first_name }} {{ $profile->last_name }}, {{ $profile->age }}</h4>
              <p class="text-muted mb-2">{{ $profile->city->name ?? '' }} | {{ $profile->occupation ?? '' }}</p>

              <!-- LEFT & RIGHT BUTTONS -->
              @if(Auth::user()?->role == "User")
              <div class=" mt-2 gap-2">
                  @if(!empty($is_favourite))
                    <button class="btn btn-danger flex-fill me-2" onclick="BookmarkFunction({{ $profile->id }},this)">
                        ❤️ Favourited
                    </button>
                  @else
                    <button
                       class="btn btn-danger flex-fill me-2" onclick="BookmarkFunction({{ $profile->id }},this)">
                        ❤️
                    </button>
                  @endif
              </div>
              @endif
          </div>
      </div>
  </div>


  <div class="mt-4">
    <div class="row">

        <!-- LEFT SIDE: Information Card -->
        <div class="col-12 col-md-8 order-1 order-md-1">
            <div class="card shadow-sm p-3 mb-3 profile_bg">
                <h5 class="mb-3 border-bottom pb-2 profile_header_bg">Personal Information</h5>
                <div class="row">
                    <div class="col-6 mb-2"><span>Name:</span> {{ $profile->first_name }} {{ $profile->last_name }}</div>
                    <div class="col-6 mb-2"><span>Gender:</span> {{ $profile->gender }}</div>
                    <div class="col-6 mb-2"><span>Birth Date:</span> {{ $profile->date_of_birth }}</div>
                    <div class="col-6 mb-2"><span>Age:</span> {{ $profile->age }}</div>
                    <div class="col-6 mb-2"><span>Birth Time:</span> {{ $profile->birth_time }}</div>
                    <div class="col-6 mb-2"><span>Birth Place:</span> {{ $profile->birth_place }}</div>
                    <div class="col-6 mb-2"><span>Height:</span> {{ str_replace(".", "'", $profile->height) }}</div>
                    <div class="col-6 mb-2"><span>Weight:</span> {{ $profile->Weight }}</div>

                    <div class="col-6 mb-2"><span>Marital Status:</span> {{ str_replace('_' , ' ', $profile->marital_status) }}</div>
                    <div class="col-6 mb-2"><span>Mother Tongue:</span> {{ $profile->mother_tounge }}</div>
                    <div class="col-6 mb-2"><span>Rashi:</span> {{ $profile->rashi }}</div>
                    <div class="col-6 mb-2"><span>Caste:</span> {{ $profile->caste }}</div>
                    <div class="col-6 mb-2"><span>Gotra:</span> {{ $profile->gotra }}</div>
                </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Location Details</h5>
                <div class="row">
                  <div class="col-6 mb-2"><span>Address:</span> {{ $profile->current_address }},{{ $profile->city->name }},
                {{ $profile->state->name }},
                {{ $profile->country->name }}</div>
                </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Education & Profession</h5>
                <div class="row">
                    <div class="col-6 mb-2"><span>Education:</span> {{ $profile->education }}</div>
                    <div class="col-6 mb-2"><span>Occupation:</span> {{ $profile->occupation }}</div>
                    <div class="col-6 mb-2"><span>Company Name:</span> {{ $profile->company_name ?? '-' }}</div>
                    <div class="col-6 mb-2"><span>Annual Income:</span> {{ $profile->annual_income ?? '-' }}</div>
                    <div class="col-6 mb-2"><span>Work Location:</span> {{ $profile->work_location ?? '-' }}</div>
                </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Family Details</h5>
                  <div class="row">
                    <div class="col-6 mb-2"><span>Father Name:</span> {{ $profile->father_name }}</div>
                    <div class="col-6 mb-2"><span>Father Occupation:</span> {{ $profile->father_occupation }}</div>
                    <div class="col-6 mb-2"><span>Mother Name:</span> {{ $profile->mother_name }}</div>
                    <div class="col-6 mb-2"><span>Mother Occupation:</span> {{ $profile->mother_occupation }}</div>
                    <div class="col-6 mb-2"><span>Number of Brothers:</span> {{ $profile->no_of_brothers }}</div>
                    <div class="col-6 mb-2"><span>Number of Sisters:</span> {{ $profile->no_of_sisters }}</div>
                    <div class="col-6 mb-2"><span>Family Type:</span> {{ $profile->family_type }}</div>
                  </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Mosal Details</h5>
                  <div class="row">
                    <div class="col-6 mb-2"><span>Mosal Place:</span> {{ $profile->mosal_name ? $profile->mosal_name : '-' }}</div>
                    <div class="col-6 mb-2"></div>
                    @foreach($profile->mosals as $mosal)
                        <div class="col-6 mb-2">
                            <span>Contact Details:</span>
                            {{ $mosal->person_name }} , {{ $profile->show_contact_publicly 
                                    ? $mosal->contact_number 
                                    : Str::mask($mosal->contact_number, '*', 0, -2) }}
                        </div>
                    @endforeach
                  </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Lifestyle & Personal Info</h5>
                <div class="row">
                  <div class="col-6 mb-2"><span>Hobbies:</span> {{ $profile->hobbies }}</div>
                  <div class="col-6 mb-2"><span>About Me:</span> {{ $profile->about_me }}</div>
                </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Contact Details</h5>
                <div class="row">
                  <div class="col-6 mb-2"><span>Contact:</span>{{ $profile->contact_person_name }},
                      {{ $profile->show_contact_publicly 
                          ? $profile->contact_person_number 
                          : Str::mask($profile->contact_person_number, '*', 0, -2) }}
                  </div>
                <h5 class="mb-3 mt-3 border-bottom pb-2 profile_header_bg">Other Images</h5>
                @if(count($profile->gallery_photo) > 0)
                  @foreach($profile->gallery_photo as $gallery_photo)
                      <img src="{{ asset('/gallery_photo/'.$gallery_photo->image) }}"
                           class="img-thumbnail w-25" />
                  @endforeach
                @else
                   <h5 class="text-center">No other images</h5>
                @endif
                </div>

            </div>
        </div>

        <!-- RIGHT SIDE: Contact Cards -->
        <div class="col-12 col-md-4 order-2 order-md-2 d-flex flex-column gap-3">
            <!-- Contact Admin -->
            <div class="card shadow-sm p-3 text-center">
                <h5 class="mb-2">Contact Admin</h5>
                <p class="mb-1"><strong>Name:</strong> {{ $profile->admin_details->first_name }} {{ $profile->admin_details->last_name }}</p>
                <p class="mb-2"><strong>Contact:</strong> {{ $profile->admin_details->phone_number }}</p>
                <button class="btn btn-success w-100">📞 Contact Admin</button>
            </div>

            <!-- Contact User -->
            <div class="card shadow-sm p-3 text-center">
                <h5 class="mb-2">Contact User</h5>
                <p class="mb-1"><strong>Name:</strong> {{ $profile->contact_person_name }}</p>
                <p class="mb-2"><strong>Contact:</strong> {{ $profile->show_contact_publicly 
                          ? $profile->contact_person_number 
                          : Str::mask($profile->contact_person_number, '*', 0, -2) }}</p>
                <button class="btn btn-success w-100">📞 Contact User</button>
            </div>
        </div>

    </div>

  </div>

</div>

@endsection

@section('js')
window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};
<script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
@endsection