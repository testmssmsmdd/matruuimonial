@extends('layouts.common_content')

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Profile Details</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile Details</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
 <section class="content">
      <div class="container-fluid">
        <div class="row g-4">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
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

                <h3 class="profile-username text-center mt-2">{{ $profile->first_name }} {{ $profile->last_name }}</h3>

                <p class="text-muted text-center">{{ $profile->date_of_birth }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-info card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header d-flex align-items-center">
    
                    <!-- Left: Title (takes full width) -->
                    <div class="card-title h3 mb-0 flex-grow-1">
                        Profile Details
                    </div>

                    <!-- Right: Button -->
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>

                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="accordion" id="basicAccordion">

                            <div class="accordion-item border-0">

                                <!-- Header -->
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#basic_information"
                                        aria-expanded="true"
                                    >
                                        Basic Information
                                    </button>
                                </h2>

                                <!-- Body -->
                                <div
                                    id="basic_information"
                                    class="accordion-collapse collapse show"
                                    data-bs-parent="#basicAccordion"
                                >
                                    <div class="accordion-body p-0 mt-3">

                                        <div class="row h5">
                                            <p class="fs-3">
                                                {{ $profile->first_name }} {{ $profile->middle_name }} {{ $profile->last_name }}
                                            </p>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Gender:</strong>
                                                <span>{{ $profile->gender }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Birth Date:</strong> 
                                                <span>{{ $profile->date_of_birth }}</span> 
                                            </div> 

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Age:</strong> 
                                                <span>{{ $profile->age }} Years</span> 
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Birth Time:</strong>
                                                <span>{{ $profile->birth_time }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Birth Place:</strong>
                                                <span>{{ $profile->birth_place }}</span> 
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Height:</strong>
                                                <span>{{ $profile->height }}</span>
                                            </div> 

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Weight:</strong>
                                                <span>{{ $profile->Weight }}</span> 
                                            </div> 

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Marital Status:</strong> 
                                                <span>{{ $profile->marital_status }}</span> 
                                            </div> 

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Mother Tongue:</strong> 
                                                <span>{{ $profile->mother_tounge }}</span> 
                                            </div>

                                             <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Rashi:</strong> 
                                                <span>{{ $profile->rashi }}</span> 
                                            </div> 

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Caste:</strong> 
                                                <span>{{ $profile->caste }}</span> 
                                            </div> 

                                            <div class="col-md-6 d-flex justify-content-between"> 
                                                <strong>Gotra:</strong> 
                                                <span>{{ $profile->gotra }}</span> 
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="locationAccordion">

                            <div class="accordion-item border-0">

                                <!-- Header -->
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#location_details"
                                        aria-expanded="true"
                                        aria-controls="location_details"
                                    >
                                        Location Details
                                    </button>
                                </h2>

                                <!-- Collapse Body -->
                                <div
                                    id="location_details"
                                    class="accordion-collapse collapse show"
                                    data-bs-parent="#locationAccordion"
                                >
                                    <div class="accordion-body p-0 mt-3">

                                        <div class="row h5">
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Address:</strong>
                                                <span class="mb-0 text-break">{{ $profile->current_address }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>City, State, Country:</strong>
                                                <span>
                                                    {{ $profile->city->name }},
                                                    {{ $profile->state->name }},
                                                    {{ $profile->country->name }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="educationAccordion">

                            <div class="accordion-item border-0">

                                <!-- Header -->
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#education"
                                        aria-expanded="true"
                                        aria-controls="education"
                                    >
                                        Education & Profession
                                    </button>
                                </h2>

                                <!-- Collapse Body -->
                                <div
                                    id="education"
                                    class="accordion-collapse collapse show"
                                    data-bs-parent="#educationAccordion"
                                >
                                    <div class="accordion-body p-0 mt-3">

                                        <div class="row h5">
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Education:</strong>
                                                <span>{{ $profile->education }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Occupation:</strong>
                                                <span class="mb-0 text-break">{{ $profile->occupation }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Company Name:</strong>
                                                <span>{{ $profile->company_name }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Annual Income:</strong>
                                                <span>{{ $profile->annual_income }}</span>
                                            </div>

                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Location:</strong>
                                                <span>{{ $profile->work_location }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAMILY DETAILS -->
                    <div class="row g-3 mt-1">
                        <div class="accordion" id="familyAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#family"
                                            aria-expanded="true">
                                        Family Details
                                    </button>
                                </h2>

                                <div id="family" class="accordion-collapse collapse show" data-bs-parent="#familyAccordion">
                                    <div class="accordion-body p-0 mt-3">
                                        <div class="row h5">
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Father Name:</strong>
                                                <span>{{ $profile->father_name }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Father Occupation:</strong>
                                                <span>{{ $profile->father_occupation }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Mother Name:</strong>
                                                <span>{{ $profile->mother_name }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Mother Occupation:</strong>
                                                <span>{{ $profile->mother_occupation }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Number of Brothers:</strong>
                                                <span>{{ $profile->no_of_brothers }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Number of Sisters:</strong>
                                                <span>{{ $profile->no_of_sisters }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Family Type:</strong>
                                                <span>{{ $profile->family_type }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOSAL DETAILS -->
                    <div class="row g-3 mt-1">
                        <div class="accordion" id="mosalAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#mosal"
                                            aria-expanded="true">
                                        Mosal Details
                                    </button>
                                </h2>

                                <div id="mosal" class="accordion-collapse collapse show" data-bs-parent="#mosalAccordion">
                                    <div class="accordion-body p-0 mt-3">
                                        <div class="row h5">
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Mosal Place:</strong>
                                                <span>{{ $profile->mosal_name ? $profile->mosal_name : '-' }}</span>
                                            </div>

                                            @foreach($profile->mosals as $mosal)
                                                <div class="col-md-6 d-flex justify-content-between">
                                                    <strong>Contact Details:</strong>
                                                    <span>{{ $mosal->person_name }} , {{ $mosal->contact_number }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LIFESTYLE -->
                    <div class="row g-3 mt-1">
                        <div class="accordion" id="lifestyleAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#lifestyle"
                                            aria-expanded="true">
                                        Lifestyle & Personal Info
                                    </button>
                                </h2>

                                <div id="lifestyle" class="accordion-collapse collapse show" data-bs-parent="#lifestyleAccordion">
                                    <div class="accordion-body p-0 mt-3">
                                        <div class="row h5">
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Hobbies:</strong>
                                                <span class="mb-0 text-break">{{ $profile->hobbies }}</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>About Me:</strong>
                                                <span class="mb-0 text-break">{{ $profile->about_me }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CONTACT -->
                    <div class="row g-3 mt-1">
                        <div class="accordion" id="contactAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#contact"
                                            aria-expanded="true">
                                        Contact Details
                                    </button>
                                </h2>

                                <div id="contact" class="accordion-collapse collapse show" data-bs-parent="#contactAccordion">
                                    <div class="accordion-body p-0 mt-3">
                                        <div class="row h5">
                                            <div class="col-md-6 d-flex justify-content-between">
                                                <strong>Contact:</strong>
                                                <span>
                                                    {{ $profile->contact_person_name }},
                                                    {{ $profile->contact_person_number }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- OTHER IMAGES -->
                    <div class="row g-3 mt-1">
                        <div class="accordion" id="imageAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#other_img"
                                            aria-expanded="true">
                                        Other Images
                                    </button>
                                </h2>

                                <div id="other_img" class="accordion-collapse collapse show" data-bs-parent="#imageAccordion">
                                    <div class="accordion-body p-0 mt-3">

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
                        </div>
                    </div>
                </div>

                </div>
            </div>
          </div>
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
 </section>

@endsection