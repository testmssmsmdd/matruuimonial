@extends('layouts.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    @if($profile?->profile_photo?->image)
                      <img class="profile-user-img img-fluid img-circle" src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="User profile picture">
                    @else
                        @if($profile->gender == "Male")
                          <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid">
                        @else
                          <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid">
                        @endif
                    @endif
                </div>
                

                <h3 class="profile-username text-center">{{ $profile->first_name }} {{ $profile->last_name }}</h3>

                <p class="text-muted text-center">{{ $profile->date_of_birth }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-info card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header">
                  <div class="card-title h3">Profile Details</div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                      <!--begin::Col-->
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#basic_information"
                                    aria-expanded="true"
                                    aria-controls="basic_information"
                                  >
                                    Basic Information
                                </button>
                            </h2>
                            <div class="accordion" id="accordionExample">
                                <div
                                  id="basic_information"
                                  class="accordion-collapse collapse show"
                                  data-bs-parent="#accordionExample">

                                   <div class="row h5">
                                        <div class="fs-3">{{ $profile->first_name }} {{ $profile->middle_name }} {{ $profile->last_name }}</div>
                                    
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
                                            <span>{{ $profile->age }}</span>
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

                                        <div class="col-md-6 d-flex justify-content-between">
                                            <strong>Manglik:</strong>
                                            <span>{{ $profile->manglik }}</span>
                                        </div>
                                   </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
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
                            </div>
                        </div>
                        <div class="accordion" id="location_details">
                            <div class="row h5">
                              <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Current Location:</strong>
                                    <span>{{ $profile->current_address }}, </span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>City, State, Country:</strong>
                                    <span>{{ $profile->city->name }}, {{ $profile->state->name }}, {{ $profile->country->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
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
                            </div>
                        </div>
                        <div class="accordion" id="education">
                          <div class="row h5">
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Education:</strong>
                                    <span>{{ $profile->education }}, </span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Occupation:</strong>
                                    <span>{{ $profile->occupation }}</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Company Name:</strong>
                                    <span>{{ $profile->company_name }}, </span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Annual income:</strong>
                                    <span>{{ $profile->annual_income }}</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Location:</strong>
                                    <span>{{ $profile->work_location }}, </span>
                                </div>
                           </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#family"
                                        aria-expanded="true"
                                        aria-controls="family"
                                      >
                                        Family Details
                                    </button>
                                </h2>
                            </div>
                        </div>
                      <div class="accordion" id="family">
                          <div class="row h5">
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Father Name:</strong>
                                    <span>{{ $profile->father_name }}, </span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Father Occupation:</strong>
                                    <span>{{ $profile->father_occupation }}</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Mother Name:</strong>
                                    <span>{{ $profile->mother_name }}, </span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Mother Occupation:</strong>
                                    <span>{{ $profile->mother_occupation }}</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Number of brother:</strong>
                                    <span>{{ $profile->no_of_brothers }}, </span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Number of sister:</strong>
                                    <span>{{ $profile->no_of_sisters }}</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Family Type:</strong>
                                    <span>{{ $profile->family_type }} </span>
                                </div>
                          </div>
                      </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#mosal"
                                        aria-expanded="true"
                                        aria-controls="mosal"
                                      >
                                        Mosal Details
                                    </button>
                                </h2>
                            </div>
                        </div>
                        <div class="accordion" id="mosal">
                          <div class="row h5">
                            <div class="col-md-6 d-flex justify-content-between">
                                <strong>Mosal place:</strong>
                                <span>{{ $profile->mosal_name }}, </span>
                            </div>
                            @foreach($profile->mosals as $key => $mosal)
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Person Name:</strong>
                                    <span>{{ $mosal->person_name }}</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-between">
                                    <strong>Contact Number:</strong>
                                    {{ $profile->show_contact_publicly ? $mosal->contact_number : Str::mask($mosal->contact_number, '*', 0, -2) }}
                                </div>
                            @endforeach
                          </div>
                        </div>
                    </div>


                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#lifestyle"
                                        aria-expanded="true"
                                        aria-controls="lifestyle"
                                      >
                                        Lifestyle & Personal Info
                                    </button>
                                </h2>
                            </div>
                        </div>
                        <div class="accordion" id="lifestyle">

                          <div class="row h5">
                            <div class="col-md-6 d-flex justify-content-between">
                                <strong>Hobbies:</strong>
                                <span>{{ $profile->hobbies }}, </span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between">
                                <strong>About Me:</strong>
                                <span>{{ $profile->about_me }}</span>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#contact"
                                        aria-expanded="true"
                                        aria-controls="contact"
                                      >
                                        Contact Details
                                    </button>
                                </h2>
                            </div>
                        </div>
                    <div class="accordion" id="contact">
                      <div class="row h5">
                        <div class="col-md-6 d-flex justify-content-between">
                            <strong>Contact:</strong>
                            <span>{{ $profile->contact_person_name }}, {{ $profile->show_contact_publicly ? $profile->contact_person_number : Str::mask($profile->contact_person_number, '*', 0, -2) }}</span>
                        </div>
                      </div>
                    </div>
                </div>
                    <div class="row g-3 mt-1">
                        <div class="accordion" id="accordionExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#other_img"
                                        aria-expanded="true"
                                        aria-controls="other_img"
                                      >
                                        Other images
                                    </button>
                                </h2>
                            </div>
                        </div>
                        <div class="accordion" id="other_img">
                            @foreach($profile->gallery_photo as $gallery_photo)
                                <img src="{{ asset('/gallery_photo/'.$gallery_photo->image) }}" class="img-thumbnail w-25"  />
                            @endforeach
                        </div>
                    </div>

            </div>
          </div>
          </div>

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>




@endsection