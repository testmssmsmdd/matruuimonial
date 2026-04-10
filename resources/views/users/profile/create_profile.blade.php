@extends('layouts.user.app')

@section('title')
Create Profile
@endsection

@section('content')
@php
    $mosals = old('mosal') ?? ($profile->mosals ?? []);
@endphp

  <div class="section row mx-2 m-4">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">

      <div class="card card-info card-outline mb-4">
        <div class="row card-header">
          <div class="col-sm-6">
            <h3 class="mb-0 text-secondary">{{ !empty($profile->first_name) ? 'Update Profile' : 'Create Profile' }}</h3>
          </div>
          
        </div>
        <!--begin::Form-->
        @if($profile?->id)
         <form action="{{ route('users.update_profile',$profile->id) }}" method="POST" class="needs-validation" id="profile_form">
        @else
          <form action="{{ route('users.store_profile') }}" method="POST" class="needs-validation" id="profile_form">
        @endif
          @csrf
          <!--begin::Body-->
          <div class="card-body">
            <!--begin::Row-->
            <div class="row g-3">
              <!--begin::Col-->
              <h3 class="fw-bold">
                Basic Information
              </h3>

              <div class="col-md-6">
                <label for="first_name" class="form-label">First name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="first_name"
                  name="first_name"
                  value = "{{ old('first_name', $profile->first_name ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6">
                <label for="middle_name" class="form-label">Middle name</label>
                <input
                  type="text"
                  class="form-control"
                  id="middle_name"
                  name="middle_name"
                  value = "{{ old('middle_name', $profile->middle_name ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6">
                <label for="last_name" class="form-label">Last name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="last_name"
                  name="last_name"
                  value = "{{ old('last_name', $profile->last_name ?? '') }}"

                />
                <span class="help-block"><strong></strong></span>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6">
                  <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                  <select class="form-select" id="gender" name="gender">
                    <option selected disabled value="">Choose...</option>
                    <option value="Male" {{ ($profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ ($profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6">
                  <label for="gender" class="form-label">Birth Date<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="birth_date" name="date_of_birth" placeholder="Select a date" value="{{ old('$profile->date_of_birth', $profile->date_of_birth  ?? '') }}">
                  <span class="help-block"><strong></strong></span>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6">
                <label for="age" class="form-label">Age(years)<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="age"
                  name="age"
                  value = "{{ old('age', $profile->age ?? '') }}"
                  style="pointer-events:none;background:aquamarine;"
                />
                <span class="help-block"><strong></strong></span>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6 row me-2 mt-3">
                <label for="birth_time" class="form-label">Birth time<span class="text-danger">*</span></label>
                <div class="col-md-3">
                  <select class="form-select" id="birth_hours" name="birth_hours">
                      <option selected disabled value="">Hours...</option>
                      @for ($i = 1; $i <= 12; $i++)
                        <option  value="{{ $i }}" {{ ($profile->birth_time_parts['hours'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                  </select>
                  <span class="help-block"><strong></strong></span>
                </div>
                <div class="col-md-3">
                  <select class="form-select" id="birth_minutes" name="birth_minutes">
                        <option selected disabled value="">Minutes...</option>
                        <option  value="00">00</option>
                        @for ($i = 1; $i <= 60; $i++)
                          <option value="{{ $i }}" {{ ($profile->birth_time_parts['minutes'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <span class="help-block"><strong></strong></span>
                </div>
                <div class="col-md-3">
                  <select class="form-select" id="birth_format" name="birth_format">
                        <option selected disabled value="">Select AM/PM</option>
                        <option value="AM" {{ ($profile->birth_time_parts['format'] ?? '') == 'AM' ? 'selected' : '' }}>AM</option>
                        <option value="PM" {{ ($profile->birth_time_parts['format'] ?? '') == 'PM' ? 'selected' : '' }}>PM</option>
                    </select>
                    <span class="help-block"><strong></strong></span>
                </div>
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-6">
                <label for="birth_place" class="form-label">Birth Place<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="birth_place"
                  name="birth_place"
                  value = "{{ old('birth_place', $profile->birth_place ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>
              <!--end::Col-->

              <div class="col-md-6 row me-2  mt-3">
                <label for="height" class="form-label">Height<span class="text-danger">*</span></label>
                <div class="col-md-3">
                  <select class="form-select" id="height_ft" name="height_ft">
                      <option selected disabled value="">feet...</option>
                      @for ($i = 1; $i < 11; $i++)
                        <option value="{{ $i }}"
                          {{ old('height_ft', $profile->height_ft ?? '') == $i ? 'selected' : '' }}>
                          {{ $i }}
                      </option>
                      @endfor
                  </select>
                  <span class="help-block"><strong></strong></span>
                </div>
                <div class="col-md-3">
                  <select class="form-select" id="height_in" name="height_in">
                      <option selected disabled value="">inch...</option>
                      @for ($i = 0; $i < 11; $i++)
                        <option  value="{{ $i }}" {{ old('height_in',$profile->height_in ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                  </select>
                  <span class="help-block"><strong></strong></span>
                </div>
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="weight" class="form-label">Weight<span class="text-danger">*</span></label>
                <input
                  type="number"
                  class="form-control"
                  id="weight"
                  name="Weight"
                  value = "{{ old('Weight', $profile->Weight ?? '') }}"

                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                  <label for="marital_status" class="form-label">Marital Status<span class="text-danger">*</span></label>
                  <select class="form-select" id="marital_status" name="marital_status">
                    <option selected disabled value="" >Choose...</option>
                    <option value="Never_Married" {{ old('marital_status', $profile->marital_status ?? '') == 'Never_Married' ? 'selected' : '' }}>Never Married</option>
                    <option value="Divorced" {{ old('marital_status', $profile->marital_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                    <option value="Widowed" {{ old('marital_status', $profile->marital_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    <option value="Mithi_Jibh_Cancel" {{ old('marital_status', $profile->marital_status ?? '') == 'Mithi_Jibh_Cancel' ? 'selected' : '' }}>Mithi Jibh Cancel</option>
                    <option value="Broken_Engagement" {{ old('marital_status', $profile->marital_status ?? '') == 'Broken_Engagement' ? 'selected' : '' }}>Broken Engagement</option>
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="mother_tounge" class="form-label">Mother tounge<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="mother_tounge"
                  name="mother_tounge"
                  value = "{{ old('mother_tounge', $profile->mother_tounge ?? '') }}"

                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="rashi" class="form-label">Rashi<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="rashi"
                  name="rashi"
                  value = "{{ old('rashi', $profile->rashi ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="caste" class="form-label">Caste<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="caste"
                  name="caste"
                  value = "{{ old('caste', $profile->caste ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="gotra" class="form-label">Gotra</label>
                <input
                  type="text"
                  class="form-control"
                  id="gotra"
                  name="gotra"
                  value = "{{ old('gotra', $profile->gotra ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>


              <div class="col-md-6">
                  <label for="manglik" class="form-label">Manglik<span class="text-danger">*</span></label>
                  <select class="form-select" id="manglik" name="manglik">
                    <option selected disabled value="">Choose...</option>
                    <option value="Yes" {{ old('manglik', $profile->manglik ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('manglik', $profile->manglik ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    <option value="Don\'t Know" {{ old('manglik', $profile->manglik ?? '') == 'Don\'t Know' ? 'selected' : '' }}>Don't know</option>
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>

              <h3 class="fw-bold">
                Location Details
              </h3>

              <div class="col-md-6">
                  <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                  <select class="form-select" id="country_id" name="country_id">
                    <option selected disabled value="">Choose...</option>
                    @foreach($countries as $key => $val)
                      <option   value="{{ $val['id'] }}" {{ old('country_id', $profile->country_id ?? '') == $val['id'] ? 'selected' : '' }} value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                    @endforeach
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>


              <div class="col-md-6">
                  <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                  <select class="form-select" id="state_id" name="state_id">
                    <option selected disabled value="">Choose...</option>
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                  <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                  <select class="form-select" id="city_id" name="city_id">
                    <option selected disabled value="">Choose...</option>
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                  <label for="current_location" class="form-label">Address<span class="text-danger">*</span></label>
                  <textarea class="form-control" aria-label="With textarea" name="current_address">{{ old('current_address', $profile->current_address ?? '') }}</textarea>
                  <span class="help-block"><strong></strong></span>
              </div>


              <h3 class="fw-bold">
                Education & Profession
              </h3>

              <div class="col-md-6">
                <label for="education" class="form-label">Education<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="education"
                  name="education"
                  value = "{{ old('education', $profile->education ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>


              <div class="col-md-6">
                <label for="occupation" class="form-label">Occupation<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="occupation"
                  name="occupation"
                  value = "{{ old('occupation', $profile->occupation ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>


              <div class="col-md-6">
                <label for="company_name" class="form-label">Company Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="company_name"
                  name="company_name"
                  value = "{{ old('company_name', $profile->company_name ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="Annual_income" class="form-label">Annual income</label>
                <input
                  type="text"
                  class="form-control"
                  id="Annual_income"
                  name="annual_income"
                  value = "{{ old('annual_income', $profile->annual_income ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>


              <div class="col-md-6">
                <label for="work_location" class="form-label">Work Location</label>
                <input
                  type="text"
                  class="form-control"
                  id="work_location"
                  name="work_location"
                  value = "{{ old('work_location', $profile->work_location ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <h3 class="fw-bold">
                Family Details
              </h3>

              <div class="col-md-6">
                <label for="father_name" class="form-label">Father Name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="father_name"
                  name="father_name"
                  value = "{{ old('father_name', $profile->father_name ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="father_occupation" class="form-label">Father Occupation<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="father_occupation"
                  name="father_occupation"
                  value = "{{ old('father_occupation', $profile->father_occupation ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>


              <div class="col-md-6">
                <label for="mother_name" class="form-label">Mother Name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="mother_name"
                  name="mother_name"
                  value = "{{ old('mother_name', $profile->mother_name ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="mother_occupation" class="form-label">Mother Occupation<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="mother_occupation"
                  name="mother_occupation"
                  value = "{{ old('mother_occupation', $profile->mother_occupation ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="no_of_brothers" class="form-label">Number of brother<span class="text-danger">*</span></label>
                <input
                  type="number"
                  class="form-control"
                  id="no_of_brothers"
                  name="no_of_brothers"
                  min = 0
                  value = "{{ old('no_of_brothers', $profile->no_of_brothers ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="no_of_sisters" class="form-label">Number of sister<span class="text-danger">*</span></label>
                <input
                  type="number"
                  class="form-control"
                  id="no_of_sisters"
                  name="no_of_sisters"
                  min = 0
                  value = "{{ old('no_of_sisters', $profile->no_of_sisters ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                  <label for="family_type" class="form-label">Family Type<span class="text-danger">*</span></label>
                  <select class="form-select" id="family_type" name="family_type">
                    <option selected disabled value="">Choose...</option>
                    <option value="joint" {{ old('family_type', $profile->family_type ?? '') == 'Joint' ? 'selected' : '' }}>Joint</option>
                    <option value="nuclear" {{ old('family_type', $profile->family_type ?? '') == 'Nuclear' ? 'selected' : '' }}>Nuclear</option>
                  </select>
                  <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">


              </div>

              <h3 class="fw-bold">
                Mosal Details
              </h3>
              <div id="mosal_details" class="row">
                <div class="col-md-6">
                  <label for="location" class="form-label">Location</label>
                  <input
                    type="text"
                    class="form-control"
                    id="mosal_name"
                    name="mosal_name"
                    value = "{{ old('mosal_name', $profile->mosal_name ?? '') }}"
                  />
                  <span class="help-block"><strong></strong></span>
                </div>
                <div class= "col-md-6">

                </div>

                @foreach($mosals as $key => $mosal)
                    <div class="row mosal_{{ $key }}">
                        
                        <div class="col-md-5">
                            <label class="form-label">Person Name</label>
                            <input type="text"
                                class="form-control"
                                name="mosal[{{ $key }}][person_name]"
                                value="{{ is_array($mosal) ? $mosal['person_name'] ?? '' : $mosal->person_name }}"
                            >

                            @error("mosal.$key.person_name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label class="form-label">Contact Number</label>
                            <input type="text"
                                class="form-control"
                                name="mosal[{{ $key }}][contact_number]"
                                value="{{ is_array($mosal) ? $mosal['contact_number'] ?? '' : $mosal->contact_number }}"
                            >

                            @error("mosal.$key.contact_number")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 mt-4">
                            <button type="button"
                                class="btn btn-danger remove_mosal"
                                data-attr="mosal_{{ $key }}">
                                -
                            </button>
                        </div>
                    </div>
                  @endforeach
                  @if(empty($mosals))
                    <div class="row mosal_0">
                        <div class="col-md-5">
                          <label for="person_name" class="form-label">Person Name</label>
                            <input type="text" name="mosal[0][person_name]" class="form-control">
                        </div>

                        <div class="col-md-5">
                          <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="mosal[0][contact_number]" class="form-control">
                        </div>
                    </div>
                  @endif

                <div class="col-md-2 mt-4">
                  <button type="button" id="add_mosal" class="btn btn-primary add_mosal"> <i class="nav-icon bi bi-plus"></i> </button>
                </div>
              </div>

              <div id="add_more_mosal" class="row"></div>
              <h3 class="fw-bold">
                Lifestyle & Personal Info
              </h3>

              <div class="col-md-6">
                  <label for="hobbies" class="form-label">Hobbies<span class="text-danger">*</span></label>
                  <textarea class="form-control" aria-label="With textarea" name="hobbies">{{ old('hobbies', $profile->hobbies ?? '') }}</textarea>
                  <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                  <label for="about_me" class="form-label">About Me<span class="text-danger">*</span></label>
                  <textarea class="form-control" aria-label="With textarea" name="about_me">{{ old('about_me', $profile->about_me ?? '') }}</textarea>
                  <span class="help-block"><strong></strong></span>
              </div>

              <h3 class="fw-bold">
                Contact Details
              </h3>

              <div class="col-md-6">
                <label for="contact_person_name" class="form-label">Contact Person Name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="contact_person_name"
                  name="contact_person_name"
                  value = "{{ old('contact_person_name', $profile->contact_person_name ?? '') }}"

                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="mobile_no" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="contact_person_number"
                  name="contact_person_number"
                  value = "{{ old('contact_person_number', $profile->contact_person_number ?? Auth::user()->phone_number) }}"
                />
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6">
                <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
                <input
                  type="text"
                  class="form-control"
                  id="contact_person_wp_number"
                  name="contact_person_wp_number"
                  value = "{{ old('contact_person_wp_number', $profile->contact_person_wp_number ?? '') }}"
                />
                <span class="help-block"><strong></strong></span>            
              </div>

              <!--begin::Col-->
              <div class="col-md-6">
                <label for="contact_person_email" class="form-label">Email<span class="text-danger">*</span></label>
                <input
                  type="name"
                  class="form-control"
                  id="contact_person_email"
                  name="contact_person_email"
                  value = "{{ old('contact_person_email', $profile->contact_person_email ?? Auth::user()->email) }}"
                />
                <span class="help-block"><strong></strong></span>            
              </div>
              <!--end::Col-->

              <div class="col-md-6">
                <label for="email" class="form-label">Show Contact Publicly</label>
                <input type="hidden" name="show_contact_publicly" value="0">

                <input type="checkbox"
                       id="show_contact_publicly"
                       name="show_contact_publicly"
                       value="1"
                       {{ old('show_contact_publicly', $profile->show_contact_publicly ?? 0) == 1 ? 'checked' : '' }}>

                <label for="show_contact_publicly">Yes</label>
              </div>

              <h3 class="fw-bold">
                Profile Media
              </h3>

              <div class="col-md-6">
                <label for="upload_profile_photo" class="form-label">Upload Profile Photo</label>
                <input
                  type="file"
                  class="form-control"
                  id="profile_photo"
                  name="profile_photo"
                  value = "{{ old('profile_photo') }}"
                />
                @if($profile?->profile_photo?->image)
                  <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" class="img-thumbnail w-25" />
                @endif
                <span class="help-block"><strong></strong></span>            
              </div>

              <div class="col-md-6">
                <label for="upload_gallery_photo" class="form-label">Upload Gallery Photo</label>
                <input
                  type="file"
                  class="form-control"
                  id="gallery_photo"
                  name="gallery_photo[]"
                  multiple
                  value = "{{ old('gallery_photo') }}"
                />

                 @if($profile?->gallery_photo)
                  <div class="d-flex flex-wrap gap-3">
                    @foreach($profile->gallery_photo as $gallery_photo)
                      <div style="position: relative; display: inline-block;">
                        
                        <button 
                          type="button"
                          class="gallery_img_del"
                          data-attr="{{ $gallery_photo->id }}"
                          style="position: absolute;top: 5px;right: 5px;background: red;color: white;border: none;border-radius: 50%;width: 25px;height: 25px;display: flex;align-items: center;justify-content: center;
                          ">
                          <i class="bi bi-x"></i>
                        </button>

                        <img 
                          src="{{ asset('/gallery_photo/'.$gallery_photo->image) }}" 
                          class="img-thumbnail" 
                          style="width: 150px; height: auto;"
                        />

                      </div>
                    @endforeach
                  </div>
                @endif
                <span class="help-block"><strong></strong></span>
              </div>

              <div class="col-md-6 d-none">
                  <label for="account_status" class="form-label">Account Status<span class="text-danger">*</span></label>
                  <select class="form-select" id="account_status" name="profile_status">
                    <option selected disabled value="">Choose...</option>
                    <option value="1" {{ old('profile_status', $profile->profile_status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('profile_status', $profile->profile_status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                  </select>
                <span class="help-block"><strong></strong></span>            
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <input type="hidden" name="created_by" value="{{ Auth::user()->id }}"
          <!--end::Body-->
          <!--begin::Footer-->
          <div class="card-footer">
            <button class="btn btn-info mx-2" type="submit">Submit</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
          </div>
          <!--end::Footer-->
        </form>
      <!--end::Form-->
    </div>

    <div class="col-md-2">

    </div>
    </div>
  </div>
@endsection

@section('js')
<script type="text/javascript">
  let countryId = $('#country_id').val();
  var state_id = "{{ old('state_id', $profile->state_id ?? '') }}";
  var city_id = "{{ old('city_id', $profile->city_id ?? '') }}";
  var profile_id = "{{ $profile->id ?? '' }}";

  $(document).ready(function(){
    loadStates(countryId);
    // loadMosals(profile_id);
  });

  function loadStates(countryId){
    if(countryId){
      $.ajax({
        url : "{{ route('admin.profile.states') }}",
        data:{'id':countryId},
        success: function(result){
          $('#state_id').empty();
          $('#city_id').empty();
          $('#state_id').append('<option value="">Select Option</select>');
          $.each(result.states,function(index, data){
            $('#state_id').append($('<option>',{
                value:data.id
              }).text(data.name)
            );
          })
          $('#state_id').val(state_id).change();

        }

      });

      setTimeout(function() {
          loadCities(state_id);
      }, 2000);

    }
  }

  function loadCities(stateId){
    if(stateId){
      $.ajax({
        url : "{{ route('admin.profile.cities') }}",
        data:{'id':stateId},
        success: function(result){
          $('#city_id').empty();
          $('#city_id').append('<option value="">Select Option</select>');
          $.each(result.cities,function(index, data){
            $('#city_id').append($('<option>',{
                value:data.id
              }).text(data.name)
            );
          })
          $('#city_id').val(city_id).change();
        }
      });
    }
  }

  $("#country_id").on("click change", function(){
      $('#state_id').empty();
      let id = $(this).val();
      $.ajax({
        url : "{{ route('admin.profile.states') }}",
        data:{'id':id},
        success: function(result){
          $('#state_id').empty();
          $('#state_id').append('<option value="">Select Option</select>');
          $.each(result.states,function(index, data){
            $('#state_id').append($('<option>',{
                value:data.id
              }).text(data.name)
            );
          })
        }
      });
  });

  $("#state_id").on("change", function(){

     $('#city_id').empty();
      let id = $(this).val();
      $.ajax({
        url : "{{ route('admin.profile.cities') }}",
        data:{'id':id},
        success: function(result){
          $('#city_id').empty();
          $('#city_id').append('<option value="">Select Option</select>');
          $.each(result.cities,function(index, data){
            $('#city_id').append($('<option>',{
                value:data.id
              }).text(data.name)
            );
          })
        }
      });
  });

  $(document).on('click', '.gallery_img_del', function(e){
    e.preventDefault();

    let button = $(this);
    let id = button.data("attr");

    Swal.fire({
        title: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then(function (result) {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: "/user/profile/delete_gallery_img/" + id,
                data: {
                    _method: 'DELETE',
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function (results) {
                    if (results.success) {
                        Swal.fire("Deleted!", results.message, "success");
                        location.reload();

                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });

        }
    });
});

  let i = {{ count($mosals) ? count($mosals) - 1 : 0 }};

  $("#add_mosal").on("click",function(){
    ++i;
    var html = '<div class="mosal_details row mosal_'+i+'" data-attr="mosal_'+i+'">';

    html += '<div class="col-md-5">';
    html += '<label class="form-label">Person Name</label>';
    html += '<input type="text" class="form-control" name="mosal['+i+'][person_name]" />';
    html += '<span class="help-block"><strong></strong></span>';
    html += '</div>';

    html += '<div class="col-md-5">';
    html += '<label class="form-label">Contact Number</label>';
    html += '<input type="text" class="form-control" name="mosal['+i+'][contact_number]" />';
    html += '<span class="help-block"><strong></strong></span>';
    html += '</div>';

    html += '<div class="col-md-2 mt-4">';
    html += '<button type="button" data-attr="mosal_'+i+'" class="btn btn-danger remove_mosal">';
    html += '<i class="nav-icon bi bi-file-minus"></i></button>';
    html += '</div>';

    html += '</div>';

    $("#mosal_details").append(html);
  });

  $(document).on('click','.remove_mosal',function () {
      var mosal_attr = $(this).data('attr');
      $("."+mosal_attr).remove();
  });


  $('#profile_form').submit(function(e){
    e.preventDefault();

    $('#profile_form .is-invalid').removeClass('is-invalid');

    // Clear all error messages
    $('#profile_form .help-block strong').text('');

    var url = $(this).attr("action");
    let formData = new FormData(this);

    $.ajax({
          type:'POST',
          url: url,
          data: formData,
          contentType: false,
          processData: false,
          success: (response) => {
              window.location.href = '/admin/profile';                      
          },
          error: function(response){
              $.each(response.responseJSON.errors, function (key, value) {
              let errorText = value[0];
              let input;

              if (key.startsWith('gallery_photo')) {

                  input = $('#profile_form').find('[name="gallery_photo[]"]');
                  input.addClass('is-invalid');
                  input.closest('[class*="col-md"]')
                       .find('.help-block strong')
                       .text(errorText);

                  return;
              }

              let parts = key.split('.');
              let inputName = parts[0];

              for (let i = 1; i < parts.length; i++) {
                  inputName += `[${parts[i]}]`;
              }


              input = $('#profile_form').find('[name="' + inputName + '"]');

              if (!input.length) {
                  console.warn("Not found:", inputName);
              }

              if (input.length) {
                  input.addClass('is-invalid');

                  input.closest('[class*="col-md"]')
                       .find('.help-block strong')
                       .text(errorText);
              }

            });
          } 
     });
  })

  function calculateAge(dateString) {
      var currentDate = new Date();
      var selectedDate = new Date(dateString);

      if (isNaN(selectedDate)) return; // invalid date safety

      var age = currentDate.getFullYear() - selectedDate.getFullYear();
      var m = currentDate.getMonth() - selectedDate.getMonth();

      if (m < 0 || (m === 0 && currentDate.getDate() < selectedDate.getDate())) {
          age--;
      }

      $('#age').val(age);
  }

  $('#birth_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      endDate: "today",
  }).on('changeDate', function(e) {
       calculateAge(e.format('yyyy-mm-dd'));
  });

  $('#birth_date').on('input change', function () {
    calculateAge($(this).val());
  });

  $(document).on('change','#show_contact_publicly',function(){
    if($(this).is(':checked')){
       $('#show_contact_publicly').val(1);
    }else{
       $('#show_contact_publicly').val(0);
    }
  });

</script>

@endsection



