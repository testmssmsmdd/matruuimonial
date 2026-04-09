@extends('layouts.user.app')

@section('title')
User Detail Page
@endsection

@section('content')

<div class="container mt-4">

  <!-- TOP PROFILE HEADER -->
  <div class="card shadow-sm mb-3">
    <div class="row g-0 align-items-center">

      <!-- Image -->
      <div class="col-md-3 text-center p-3">
        @if($profile?->profile_photo?->image)
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="User profile picture" style="width:200px;height:200px;">
        @else
            @if($profile->gender == "Male")
              <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid">
            @else
              <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid">
            @endif
        @endif
      </div>


      <!-- Basic Info -->
      <div class="col-md-6">
        <div class="card-body" style="background: aliceblue;">
          <h4 class="mb-1">
            {{ $profile->first_name }} {{ $profile->last_name }}
          </h4>

          <p class="text-muted mb-2">
            {{ $profile->city->name ?? '' }} |
            {{ $profile->occupation ?? '' }}
          </p>

          <div class="d-flex flex-wrap gap-2">
            @if($is_favourite)
                <button class="btn btn-danger" onclick="BookmarkFunction({{ $profile->id }},this)">
                  ❤️ Favourite
                </button>
            @else
                <button class="btn btn-danger" onclick="BookmarkFunction({{ $profile->id }},this)">
                  ❤️
                </button>
            @endif
            <a href="{{ route('user.profiles') }}" class="btn btn-sm btn-outline-primary ">
                <i class="bi bi-arrow-left"></i> Back
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>

  <!-- DETAILS SECTION -->
  <div class="row">
    <!-- LEFT SIDE -->
    <div class="col-md-8">

      <!-- Personal Info -->
      <div class="card mb-3 shadow-sm">
        <div class="card-body" style="background: aliceblue;">
        <span class="display-6 border-bottom text-black">Personal Information</span><br/>

        <div class="col-md-6 d-flex justify-content-start mt-3"> 
            <span class="font-monospace">Name:</span>
            <span class="mx-2 font-monospace">{{ $profile->first_name }} {{ $profile->middle_name }} {{ $profile->last_name }}</span>
        </div>

        <div class="col-md-6 d-flex justify-content-start"> 
            <span class="font-monospace">Gender:</span>
            <span class="mx-2 font-monospace">{{ $profile->gender }}</span>
        </div>

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Birth Date:</span> 
            <span class="mx-2 font-monospace">{{ $profile->date_of_birth }}</span>
        </div>

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Age:</span> 
            <span class="mx-2 font-monospace">{{ $profile->age }} Years</span>
        </div>

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Birth Time:</span>
            <span class="mx-2 font-monospace">{{ $profile->birth_time }}</span>
        </div>

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Birth Place:</span>
            <span class="mx-2 font-monospace">{{ $profile->birth_place }}</span> 
        </div>

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Height:</span>
            <span class="mx-2 font-monospace">{{ str_replace(".","'",$profile->height).'*' }}</span>
        </div>

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Weight:</span>
            <span class="mx-2 font-monospace">{{ $profile->Weight }}</span> 
        </div> 

        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Marital Status:</span> 
            <span class="mx-2 font-monospace">{{ str_replace('_' , ' ', $profile->marital_status) }}</span> 
        </div> 

        <div class="col-md-6 d-flex justify-content-start"> 
            <span class="font-monospace">Mother Tongue:</span> 
            <span class="mx-2 font-monospace">{{ $profile->mother_tounge }}</span> 
        </div>

        <div class="col-md-6 d-flex justify-content-start"> 
            <span class="font-monospace">Rashi:</span> 
            <span class="mx-2 font-monospace">{{ $profile->rashi }}</span> 
        </div> 

        <div class="col-md-6 d-flex justify-content-start"> 
            <span class="font-monospace">Caste:</span> 
            <span class="mx-2 font-monospace">{{ $profile->caste }}</span> 
        </div> 

        <div class="col-md-6 d-flex justify-content-start mb-2"> 
            <span class="font-monospace">Gotra:</span> 
            <span class="mx-2 font-monospace">{{ $profile->gotra }}</span> 
        </div>

        <span class="display-6 border-bottom border-top text-black">Location Details</span><br/>
        <div class="col-md-6 d-flex justify-content-start mt-3"> 
            <span class="font-monospace">Address:</span> 
            <span class="mx-2 font-monospace">{{ $profile->current_address }}</span> 
        </div>
          

        <div class="col-md-6 d-flex justify-content-start mb-2">
            <span>City, State, Country:</span>
            <span class="mx-2">
                {{ $profile->city->name }},
                {{ $profile->state->name }},
                {{ $profile->country->name }}
            </span>
        </div>
          <span class="display-6 border-bottom border-top text-black">Education & Profession</span><br/>
          <div class="col-md-6 d-flex justify-content-start mt-3">
                <span class="font-monospace">Education:</span>
                <span class="mx-2 font-monospace">{{ $profile->education }}</span>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
                <span class="font-monospace">Occupation:</span>
                <span class="mb-0 text-break mx-2 font-monospace">{{ $profile->occupation }}</span>
            </div>

            <div class="col-md-6 d-flex justify-content-start">
                <span class="font-monospace">Company Name:</span>
                <span class="mx-2 font-monospace">{{ $profile->company_name }}</span>
            </div>

            <div class="col-md-6 d-flex justify-content-start">
                <span class="font-monospace">Annual Income:</span>
                <span class="mx-2 font-monospace">{{ $profile->annual_income }}</span>
            </div>

            <div class="col-md-6 d-flex justify-content-start mb-2">
                <span class="font-monospace">Location:</span>
                <span class="mx-2 font-monospace">{{ $profile->work_location }}</span>
            </div>
          <span class="display-6 border-bottom border-top text-black">Family Details</span><br/>

          <div class="col-md-6 d-flex justify-content-start mt-3">
            <span class="font-monospace">Father Name:</span>
            <span class="mx-2 font-monospace">{{ $profile->father_name }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Father Occupation:</span>
            <span class="mx-2 font-monospace">{{ $profile->father_occupation }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Mother Name:</span>
            <span class="mx-2 font-monospace">{{ $profile->mother_name }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Mother Occupation:</span>
            <span class="mx-2 font-monospace">{{ $profile->mother_occupation }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Number of Brothers:</span>
            <span class="mx-2 font-monospace">{{ $profile->no_of_brothers }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start">
            <span class="font-monospace">Number of Sisters:</span>
            <span class="mx-2 font-monospace">{{ $profile->no_of_sisters }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start mb-2">
            <span class="font-monospace">Family Type:</span>
            <span class="mx-2 font-monospace">{{ $profile->family_type }}</span>
        </div>
        
        <span class="display-6 border-bottom border-top text-black">Mosal Details</span><br/>

        <div class="col-md-6 d-flex justify-content-start mt-3">
            <span class="font-monospace">Mosal Place:</span>
            <span class="mx-2 font-monospace">{{ $profile->mosal_name ? $profile->mosal_name : '-' }}</span>
        </div>

        @foreach($profile->mosals as $mosal)
            <div class="col-md-6 d-flex justify-content-start">
                <span class="font-monospace">Person Name and contact details:</span>
                <span class="mx-2 font-monospace">{{ $mosal->person_name }} , {{ $profile->show_contact_publicly 
                        ? $mosal->contact_number 
                        : Str::mask($mosal->contact_number, '*', 0, -2) }}</span>
            </div>
        @endforeach
          
        <div class="mb-2"></div>
        <span class="display-6 border-bottom border-top">Lifestyle & Personal Info</span><br/>

        <div class="col-md-6 d-flex justify-content-start mt-3">
            <span class="font-monospace">Hobbies:</span>
            <span class="mb-0 text-break mx-2 font-monospace">{{ $profile->hobbies }}</span>
        </div>
        <div class="col-md-6 d-flex justify-content-start mb-2">
            <span class="font-monospace">About Me:</span>
            <span class="mb-0 text-break mx-2 font-monospace">{{ $profile->about_me }}</span>
        </div>

          <span class="display-6 border-bottom border-top text-black">Contact Details</span><br/>

          <span class="font-monospace mt-3">Contact:</span>
          <div class="col-md-6 d-flex justify-content-start mb-2 font-monospace">
            <span class="mx-2">
                {{ $profile->contact_person_name }},
                {{ $profile->show_contact_publicly 
                    ? $profile->contact_person_number 
                    : Str::mask($profile->contact_person_number, '*', 0, -2) }}
            </span>
         </div>

          <span class="display-6 border-bottom border-top text-black">Other Images</span><br/>
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

    <!-- RIGHT SIDE -->
    <div class="col-md-4">

      <!-- Contact Card -->
      <div class="card mb-3 shadow-sm text-center" style="background:aliceblue">
        <div class="card-body">
          <p class="mb-2 h5"><span><b>Contact Number:</b></span> {{ $profile->contact_person_number }}</p>

          <button class="btn btn-success w-100">
            📞 Contact Admin
          </button>
        </div>
      </div>
    </div>

  </div>

</div>

@endsection


@section('js')
<script>
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
                swal.fire("Good job!", "Pofile Added in Favourite", "success");
                el.innerText = '❤️ Favourite';

            } else {
                swal.fire("Good job!", "Pofile Removed from Favourite", "success");
                el.innerText = '❤️';
            }

        });
    }else{
        // window.location.href = "/login";
        swal.fire({
          title: "Please Login to add profile!",
        });
    }
}
</script>
@endsection