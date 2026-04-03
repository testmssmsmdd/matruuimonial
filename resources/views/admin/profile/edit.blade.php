@extends('layouts.common_content')

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Edit Profile</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="col-md-1">

</div>
<div class="col-md-10">

  <div class="card card-info card-outline mb-4">
    
    <!--begin::Form-->
    <form action="{{ route('admin.profile.update',$profile->id) }}" class="needs-validation" id="profile_form">
      @csrf
      @method('PUT')

      <input type="hidden" name="profile_id" value="{{ $profile->id }}" />

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
              value = "{{ $profile->first_name }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('first_name')
              <span class="first_name text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="middle_name" class="form-label">Middle name</label>
            <input
              type="text"
              class="form-control"
              id="middle_name"
              name="middle_name"
              value = "{{ $profile->middle_name }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('middle_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
              value = "{{ $profile->last_name }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('last_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
              <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
              <select class="form-select" id="gender" name="gender">
                <option selected disabled value="">Choose...</option>
                <option value="Male" <?php if($profile->gender == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($profile->gender == 'Female') echo 'selected'; ?>>Female</option>
              </select>
              <span class="help-block"><strong></strong></span>
            @error('gender')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
              <label for="gender" class="form-label">Birth Date<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="birth_date" name="date_of_birth" placeholder="Select a date" value="{{ $profile->date_of_birth }}">
              <span class="help-block"><strong></strong></span>
            @error('birth_date')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
              value = "{{ $profile->age }}"
              style="pointer-events: none;background: aquamarine;"
            />
            <span class="help-block"><strong></strong></span>
            @error('age')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6 row me-2 mt-3">
            <label for="birth_time" class="form-label">Birth time<span class="text-danger">*</span></label>
            <div class="col-md-3">
              <select class="form-select" id="birth_hours" name="birth_hours">
                  <option selected disabled value="">Hours...</option>
                  @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ ($profile->birth_time_parts['hours'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
              </select>
              <span class="help-block"><strong></strong></span>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="birth_minutes" name="birth_minutes">
                    <option selected disabled value="">Minutes...</option>
                    @for ($i = 0; $i <= 60; $i++)
                      <option value="{{ $i }}" {{ ($profile->birth_time_parts['minutes'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <span class="help-block"><strong></strong></span>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="birth_format" name="birth_format">
                    <option selected disabled value="">Select AM/PM</option>
                    <option value="AM" {{ ($profile->birth_time_parts['format'] ?? '') == 'AM' ? 'selected' : '' }}>
                        AM
                    </option>

                    <option value="PM" {{ ($profile->birth_time_parts['format'] ?? '') == 'PM' ? 'selected' : '' }}>
                        PM
                    </option>
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
              value = "{{ $profile->birth_place }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('birth_place')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->

          <div class="col-md-6 row me-2  mt-3">
            <label for="height" class="form-label">Height<span class="text-danger">*</span></label>
            <div class="col-md-3">
              <select class="form-select" id="height_ft" name="height_ft">
                  <option selected disabled value="">feet...</option>
                  @for ($i = 1; $i < 11; $i++)
                    <option value="{{ $i }}" {{ $profile->height_ft == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="height_in" name="height_in">
                  <option selected disabled value="">inch...</option>
                  @for ($i = 0; $i < 11; $i++)
                    <option value="{{ $i }}" {{ $profile->height_in == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
              </select>
            </div>
            <span class="help-block"><strong></strong></span>
            @error('height')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="weight" class="form-label">Weight<span class="text-danger">*</span></label>
            <input
              type="number"
              class="form-control"
              id="weight"
              name="Weight"
              value = "{{ $profile->Weight }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('weight')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
              <label for="marital_status" class="form-label">Marital Status<span class="text-danger">*</span></label>

              <select class="form-select" id="marital_status" name="marital_status">
                
                <option selected disabled value="">Choose...</option>
                <option value="Never_Married" <?php if($profile->marital_status == "Never_Married") echo 'selected'; ?>>Never Married</option>
                <option value="Divorced" <?php if($profile->marital_status == "Divorced") echo 'selected'; ?>>Divorced</option>
                <option value="Widowed" <?php if($profile->marital_status == "Widowed") echo 'selected'; ?>>Widowed</option>
                <option value="Mithi_Jibh_Cancel" <?php if($profile->marital_status == "Mithi_Jibh_Cancel") echo 'selected'; ?>>Mithi Jibh Cancel</option>
                <option value="Broken_Engagement" <?php if($profile->marital_status == "Broken_Engagement") echo 'selected'; ?>>Broken Engagement</option>
              </select>
              <span class="help-block"><strong></strong></span>
            @error('marital_status')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="mother_tounge" class="form-label">Mother tounge<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="mother_tounge"
              name="mother_tounge"
              value = "{{ $profile->mother_tounge }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('mother_tounge')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="rashi" class="form-label">Rashi<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="rashi"
              name="rashi"
              value = "{{ $profile->rashi }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('rashi')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="caste" class="form-label">Caste<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="caste"
              name="caste"
              value = "{{ $profile->caste }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('caste')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="gotra" class="form-label">Gotra</label>
            <input
              type="text"
              class="form-control"
              id="gotra"
              name="gotra"
              value = "{{ $profile->gotra }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('gotra')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
              <label for="manglik" class="form-label">Manglik<span class="text-danger">*</span></label>
              <select class="form-select" id="manglik" name="manglik">
                <option selected disabled value="">Choose...</option>
                <option value="yes" <?php if($profile->manglik == "Yes") echo 'selected'; ?>>Yes</option>
                <option value="no" <?php if($profile->manglik == "No") echo 'selected'; ?>>No</option>
                <option value="don't know" <?php if($profile->manglik == "Don't Know") echo 'selected'; ?>>Don't know</option>
              </select>
              <span class="help-block"><strong></strong></span>
            @error('manglik')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <h3 class="fw-bold">
            Location Details
          </h3>

          <div class="col-md-6">
              <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
              <select class="form-select" id="country_id" name="country_id">
                <option selected disabled value="">Choose...</option>
                @foreach($countries as $key => $val)
                  <option value="{{ $val['id'] }}" <?php if($profile['country_id'] == $val['id']) echo 'selected';?>>{{ $val['name'] }}</option>
                @endforeach
              </select>
              <span class="help-block"><strong></strong></span>
            @error('country')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
              <label for="state" class="form-label">State<span class="text-danger">*</span></label>
              <select class="form-select" id="state_id" name="state_id">
                <option selected disabled value="">Choose...</option>
              </select>
              <span class="help-block"><strong></strong></span>
            @error('state')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
              <label for="city" class="form-label">City<span class="text-danger">*</span></label>
              <select class="form-select" id="city_id" name="city_id">
                <option selected disabled value="">Choose...</option>
              </select>
              <span class="help-block"><strong></strong></span>
            @error('city')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
              <label for="current_location" class="form-label">Address<span class="text-danger">*</span></label>
              <textarea class="form-control" aria-label="With textarea" name="current_address">{{ $profile->current_address }}</textarea>
              <span class="help-block"><strong></strong></span>
            @error('current_location')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
              value = "{{ $profile->education }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('education')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="occupation" class="form-label">Occupation<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="occupation"
              name="occupation"
              value = "{{ $profile->occupation }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('occupation')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="company_name" class="form-label">Company Name</label>
            <input
              type="text"
              class="form-control"
              id="company_name"
              name="company_name"
              value = "{{ $profile->company_name }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('company_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="Annual_income" class="form-label">Annual income</label>
            <input
              type="text"
              class="form-control"
              id="Annual_income"
              name="annual_income"
              value = "{{ $profile->annual_income }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('Annual_income')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="work_location" class="form-label">Work Location</label>
            <input
              type="text"
              class="form-control"
              id="work_location"
              name="work_location"
              value = "{{ $profile->work_location }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('work_location')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
              value = "{{ $profile->father_name }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('father_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="father_occupation" class="form-label">Father Occupation<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="father_occupation"
              name="father_occupation"
              value = "{{ $profile->father_occupation }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('father_occupation')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="mother_name" class="form-label">Mother Name<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="mother_name"
              name="mother_name"
              value = "{{ $profile->mother_name }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('mother_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="mother_occupation" class="form-label">Mother Occupation<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="mother_occupation"
              name="mother_occupation"
              value = "{{ $profile->mother_occupation }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('mother_occupation')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="no_of_brothers" class="form-label">Number of brother<span class="text-danger">*</span></label>
            <input
              type="number"
              class="form-control"
              min = 0
              id="no_of_brothers"
              name="no_of_brothers"
              value = "{{ $profile->no_of_brothers }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('no_of_brothers')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="no_of_sisters" class="form-label">Number of sister<span class="text-danger">*</span></label>
            <input
              type="number"
              class="form-control"
              id="no_of_sisters"
              min = 0
              name="no_of_sisters"
              value = "{{ $profile->no_of_sisters }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('no_of_sister')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
              <label for="family_type" class="form-label">Family Type<span class="text-danger">*</span></label>
              <select class="form-select" id="family_type" name="family_type">
                <option selected disabled value="">Choose...</option>
                <option value="joint" <?php if($profile->family_type == 'Joint') echo 'selected'; ?>>Joint</option>
                <option value="nuclear" <?php if($profile->family_type == 'Nuclear') echo 'selected'; ?>>Nuclear</option>
              </select>
              <span class="help-block"><strong></strong></span>
            @error('family_type')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
                value = "{{ $profile->mosal_name }}"
              />
              <span class="help-block"><strong></strong></span>
              @error('location')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class= "col-md-6">

            </div>
            @foreach($profile->mosals as $key => $mosal)
              <div class="mosal_{{ $key }} row">
                <div class="col-md-5">

                  <label for="person_name" class="form-label">Person Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="person_name"
                    name="mosal[{{ $key }}][person_name]"
                    value = "{{ $mosal->person_name }}"
                  />
                  <span class="help-block"><strong></strong></span>
                  @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="col-md-5" >
                  <label for="contact_number" class="form-label">Contact Number</label>
                  <input
                    type="text"
                    class="form-control"
                    id="contact_number"
                    name="mosal[{{ $key }}][contact_number]"
                    value = "{{ $mosal->contact_number }}"
                  />
                  <span class="help-block"><strong></strong></span>
                  @error('contact_number')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="col-md-2 mt-4">
                  <button type="button" data-attr="mosal_{{ $key }} "id="remove_mosal_'{{ $key }}" class="btn btn-danger remove_mosal"> <i class="nav-icon bi bi-file-minus">
                  </i> </button>
                </div>
              </div>
            @endforeach
            <div class="col-md-2 mt-4">
              <button type="button" id="add_mosal" class="btn btn-primary add_mosal"> <i class="nav-icon bi bi-plus"></i> </button>
            </div>
            
            <input type="hidden" name="mosal_count_value" id="mosal_count_value" value="{{ count($profile->mosals) - 1 }}" />
            @if(empty($profile->mosals))

             <div class="col-md-5">

              <label for="person_name" class="form-label">Person Name</label>
              <input
                type="text"
                class="form-control"
                id="person_name"
                name="mosal[[0]][person_name]"
                value = "{{ $mosal->person_name }}"
              />
              <span class="help-block"><strong></strong></span>
              @error('name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="col-md-5" >
              <label for="contact_number" class="form-label">Contact Number</label>
              <input
                type="text"
                class="form-control"
                name="mosal[[0]][contact_number]"
                value = "{{ $mosal->contact_number }}"
              />
              <span class="help-block"><strong></strong></span>
              @error('contact_number')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="col-md-2 mt-4">
              <button type="button" id="add_mosal" class="btn btn-primary add_mosal"> <i class="nav-icon bi bi-plus"></i> </button>
            </div>
            @endif
          </div>

          <div id="add_more_mosal" class="row"></div>
          <h3 class="fw-bold">
            Lifestyle & Personal Info
          </h3>

          <div class="col-md-6">
              <label for="hobbies" class="form-label">Hobbies<span class="text-danger">*</span></label>
              <textarea class="form-control" aria-label="With textarea" name="hobbies">{{ $profile->hobbies }}</textarea>
              <span class="help-block"><strong></strong></span>

            @error('hobbies')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
              <label for="about_me" class="form-label">About Me<span class="text-danger">*</span></label>
              <textarea class="form-control" aria-label="With textarea" name="about_me">{{ $profile->about_me }}</textarea>
              <span class="help-block"><strong></strong></span>
            @error('about_me')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
              value = "{{ $profile->contact_person_name }}"

            />
            <span class="help-block"><strong></strong></span>
            @error('contact_person_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="mobile_no" class="form-label">Mobile Number<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="contact_person_number"
              name="contact_person_number"
              value = "{{ $profile->contact_person_number }}"
            />
            <span class="help-block"><strong></strong></span>
            @error('contact_person_number')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
            <input
              type="text"
              class="form-control"
              id="contact_person_wp_number"
              name="contact_person_wp_number"
              value = "{{ $profile->contact_person_wp_number }}"
            />
            <span class="help-block"><strong></strong></span>            
            @error('contact_person_wp_number')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!--begin::Col-->
          <div class="col-md-6">
            <label for="contact_person_email" class="form-label">Email</label>
            <input
              type="name"
              class="form-control"
              id="contact_person_email"
              name="contact_person_email"
              value = "{{ $profile->email }}"
            />
            <span class="help-block"><strong></strong></span>            
            @error('email')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <!--end::Col-->

          <div class="col-md-6">
            <label for="email" class="form-label">Show Contact Publicly</label>

            <input type="hidden" name="show_contact_publicly" value="0">

            <input type="checkbox"
                   id="show_contact_publicly"
                   name="show_contact_publicly"
                   value="1"
                   {{ $profile->show_contact_publicly == 1 ? 'checked' : '' }}>

            <label for="show_contact_publicly">Yes</label>
          </div>

          <h3 class="fw-bold">
            Profile Media
          </h3>

          <div class="col-md-6">
            <label for="profile_photo" class="form-label">Upload Profile Photo</label>
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
            @error('profile_photo')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>


          <div class="col-md-6">
            <label for="gallery_photo" class="form-label">Upload Gallery Photo</label>
            <input
              type="file"
              class="form-control"
              id="gallery_photo"
              name="gallery_photo[]"
              multiple
              value = "{{ old('gallery_photo') }}"
            />
            <span class="help-block"><strong></strong></span>            
            @error('gallery_photo')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            @if($profile?->gallery_photo)
              <div>
                @foreach($profile->gallery_photo as $gallery_photo)
                    <button 
                        type="button"
                        class="gallery_img_del" 
                        data-attr="{{ $gallery_photo->id }}" 
                        style="position:absolute;background:cadetblue;">
                        
                        <i class="bi bi-x mt-4"></i>
                    </button>
                    <img src="{{ asset('/gallery_photo/'.$gallery_photo->image) }}" class="img-thumbnail w-25"  />
                @endforeach
              </div>
            @endif
          </div>

          <div class="col-md-6">
              <label for="profile_status" class="form-label">Account Status<span class="text-danger">*</span></label>
              <select class="form-select" id="profile_status" name="profile_status">
                <option selected disabled value="">Choose...</option>
                <option value="1" <?php if($profile->profile_status == '1') echo 'selected'; ?>>Active</option>
                <option value="0" <?php if($profile->profile_status == '0') echo 'selected'; ?>>Inactive</option>
              </select>
            <span class="help-block"><strong></strong></span>            
            @error('account_status')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
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
@endsection


@section('js')
<script type="text/javascript">
  let countryId = $('#country_id').val();
  var state_id = {{ $profile->state_id }};
  var city_id = {{ $profile->city_id }};
  var profile_id = {{ $profile->id }};
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
  
  $("#country_id").on("change", function(){
    let countryId = $('#country_id').val()
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
      }
    });
  });

  $("#state_id").on("change", function(){
     let stateId = $('#state_id').val()
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
        }
      });
  });

  var i = $('#mosal_count_value').val() || 0;
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

                  if (key.includes('.')) {

                      let inputName = key.replace(/\.(\w+)/g, '[$1]');
                      let safeName = inputName.replace(/([:\[\]])/g, "\\$1");

                      input = $('#profile_form').find('[name="' + safeName + '"]');

                  } else {
                      input = $('#profile_form').find('[name="' + key + '"]');
                  }

                  if (input.length) {

                      input.addClass('is-invalid');

                      input.closest('[class*="col-md"]')
                           .find('.help-block strong')
                           .text(errorText);
                  }

              });
          }
                  

              // $.each(response.responseJSON.errors, function (key, value) {

              //     var input = '#profile_form input[name=' + key + ']';
              //     var input2 = '#profile_form select[name=' + key + ']';
              //     var input3 = '#profile_form textarea[name=' + key + ']';
              //     var input4 = '#profile_form file[name=' + key + ']';
              //     console.log(input4);

              //     $(input + '+span>strong').text(value);
              //     $(input2 + '+span>strong').text(value);
              //     $(input3 + '+span>strong').text(value);
              //     $(input4 + '+span>strong').text(value);
              //     console.log(value)
              //     $(input).parent().parent().addClass('has-error');
              //     $(input2).parent().parent().addClass('has-error');
              //     $(input3).parent().parent().addClass('has-error');
              //     $(input4).parent().parent().addClass('has-error');


              // });
     });
  });


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
                url: "/admin/profile/delete_gallery_img/" + id,
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
</script>
@endsection
