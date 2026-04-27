@extends('layouts.common_content')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('page_title')
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-0">Create Profile</h3>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create Profile</li>
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
    <form action="{{ route('admin.profile.store') }}" class="needs-validation" id="profile_form">
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
            <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="first_name"
              name="first_name"
              value = "{{ old('first_name') }}"
            />
            <span class="help-block"><span></span></span>
          </div>
          
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input
              type="text"
              class="form-control"
              id="middle_name"
              name="middle_name"
              value = "{{ old('middle_name') }}"
            />
            <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="last_name"
              name="last_name"
              value = "{{ old('last_name') }}"

            />
            <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
              <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
              <select class="form-select" id="gender" name="gender">
                <option selected disabled value="">Choose...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
              <label for="gender" class="form-label">Birth Date<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="birth_date" name="date_of_birth" placeholder="Select a date">
              <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6">
            <label for="age" class="form-label">Age(years)<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control bg-age"
              id="age"
              name="age"
              value = "{{ old('age') }}"
            />
            <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->
          <!--begin::Col-->
          <div class="col-md-6 row me-2 mt-3">
            <label for="birth_time" class="form-label">Birth Time<span class="text-danger">*</span></label>
            <div class="col-md-3">
              <select class="form-select" id="birth_hours" name="birth_hours">
                  <option selected disabled value="">Hours...</option>
                  @for ($i = 1; $i <= 12; $i++)
                    <option  value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <span class="help-block"><span></span></span>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="birth_minutes" name="birth_minutes">
                    <option selected disabled value="">Minutes...</option>
                    <option  value="00">00</option>
                    @for ($i = 1; $i <= 60; $i++)
                      <option  value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <span class="help-block"><span></span></span>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="birth_format" name="birth_format">
                    <option selected disabled value="">Select AM/PM</option>
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
                <span class="help-block"><span></span></span>
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
              value = "{{ old('birth_place') }}"
            />
            <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->

          <div class="col-md-6 row me-2  mt-3">
            <label for="height" class="form-label">Height<span class="text-danger">*</span></label>
            <div class="col-md-3">
              <select class="form-select" id="height_ft" name="height_ft">
                  <option selected disabled value="">feet...</option>
                  @for ($i = 1; $i < 11; $i++)
                    <option  value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <span class="help-block"><span></span></span>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="height_in" name="height_in">
                  <option selected disabled value="">inch...</option>
                  @for ($i = 0; $i < 11; $i++)
                    <option  value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <span class="help-block"><span></span></span>
            </div>
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="weight" class="form-label">Weight<span class="text-danger">*</span></label>
            <input
              type="number"
              class="form-control"
              min="0"
              id="weight"
              name="Weight"
              value = "{{ old('weight') }}"

            />
            <span class="help-block"><span></span></span>

          </div>

          <div class="col-md-6">
              <label for="marital_status" class="form-label">Marital Status<span class="text-danger">*</span></label>
              <select class="form-select" id="marital_status" name="marital_status">
                <option selected disabled value="">Choose...</option>
                <option value="Never_Married">Never Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                <option value="Mithi_Jibh_Cancel">Mithi Jibh Cancel</option>
                <option value="Broken_Engagement">Broken Engagement</option>
              </select>
              <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="mother_tounge" class="form-label">Mother Tounge<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="mother_tounge"
              name="mother_tounge"
              value = "{{ old('mother_tounge') }}"

            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="rashi" class="form-label">Rashi<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="rashi"
              name="rashi"
              value = "{{ old('rashi') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="caste" class="form-label">Caste<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="caste"
              name="caste"
              value = "{{ old('caste') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="gotra" class="form-label">Gotra</label>
            <input
              type="text"
              class="form-control"
              id="gotra"
              name="gotra"
              value = "{{ old('gotra') }}"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
              <label for="manglik" class="form-label">Manglik<span class="text-danger">*</span></label>
              <select class="form-select" id="manglik" name="manglik">
                <option selected disabled value="">Choose...</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                <option value="don't know">Don't know</option>
              </select>
              <span class="help-block"><span></span></span>
          </div>

          <h3 class="fw-bold">
            Location Details
          </h3>

          <div class="col-md-6">
              <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
              <select class="form-select" id="country_id" name="country_id">
                <option selected disabled value="">Choose...</option>
                @foreach($countries as $key => $val)
                  <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                @endforeach
              </select>
              <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
              <label for="state" class="form-label">State<span class="text-danger">*</span></label>
              <select class="form-select" id="state_id" name="state_id">
                <option selected disabled value="">Choose...</option>
              </select>
              <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
              <label for="city" class="form-label">City<span class="text-danger">*</span></label>
              <select class="form-select" id="city_id" name="city_id">
                <option selected disabled value="">Choose...</option>
              </select>
              <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
              <label for="current_location" class="form-label">Address<span class="text-danger">*</span></label>
              <textarea class="form-control" aria-label="With textarea" name="current_address"></textarea>
              <span class="help-block"><span></span></span>
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
              value = "{{ old('education') }}"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="occupation" class="form-label">Occupation<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="occupation"
              name="occupation"
              value = "{{ old('occupation') }}"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="company_name" class="form-label">Company Name</label>
            <input
              type="text"
              class="form-control"
              id="company_name"
              name="company_name"
              value = "{{ old('company_name') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="Annual_income" class="form-label">Annual Income</label>
            <input
              type="text"
              class="form-control"
              id="Annual_income"
              name="annual_income"
              value = "{{ old('Annual_income') }}"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="work_location" class="form-label">Work Location</label>
            <input
              type="text"
              class="form-control"
              id="work_location"
              name="work_location"
              value = "{{ old('work_location') }}"
            />
            <span class="help-block"><span></span></span>
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
              value = "{{ old('father_name') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="father_occupation" class="form-label">Father Occupation<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="father_occupation"
              name="father_occupation"
              value = "{{ old('father_occupation') }}"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="mother_name" class="form-label">Mother Name<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="mother_name"
              name="mother_name"
              value = "{{ old('mother_name') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="mother_occupation" class="form-label">Mother Occupation<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="mother_occupation"
              name="mother_occupation"
              value = "{{ old('mother_occupation') }}"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="no_of_brothers" class="form-label">Number Of Brother<span class="text-danger">*</span></label>
            <input
              type="number"
              class="form-control"
              id="no_of_brothers"
              name="no_of_brothers"
              min = 0
              value = "{{ old('no_of_brothers') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
            <label for="no_of_sisters" class="form-label">Number Of Sister<span class="text-danger">*</span></label>
            <input
              type="number"
              class="form-control"
              id="no_of_sisters"
              name="no_of_sisters"
              min = 0
              value = "{{ old('no_of_sisters') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
              <label for="family_type" class="form-label">Family Type<span class="text-danger">*</span></label>
              <select class="form-select" id="family_type" name="family_type">
                <option selected disabled value="">Choose...</option>
                <option value="joint">Joint</option>
                <option value="nuclear">Nuclear</option>
              </select>
              <span class="help-block"><span></span></span>
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
                value = "{{ old('mosal_name') }}"
              />
              <span class="help-block"><span></span></span>
            </div>
            <div class= "col-md-6">

            </div>

            <div class="col-md-5">

              <label for="person_name" class="form-label">Person Name</label>
              <input
                type="text"
                class="form-control"
                name="mosal[0][person_name]"
                value = "{{ old('mosal[$i][person_name]') }}"
              />
              <span class="help-block"><span></span></span>
            </div>

            <div class="col-md-5" >
              <label for="contact_number" class="form-label">Contact Number</label>
              <input
                type="text"
                class="form-control"
                name="mosal[0][contact_number]"
                value="{{ old('mosal.0.contact_number') }}"
                maxlength="10"
                pattern="\d{10}"
                inputmode="numeric"
              />
              <span class="help-block"><span></span></span>
              
            </div>


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
              <textarea class="form-control" aria-label="With textarea" name="hobbies"></textarea>
              <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
              <label for="about_me" class="form-label">About Me<span class="text-danger">*</span></label>
              <textarea class="form-control" aria-label="With textarea" name="about_me"></textarea>
              <span class="help-block"><span></span></span>
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
              value = "{{ old('contact_person_name') }}"

            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="mobile_no" class="form-label">Mobile Number<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              id="contact_person_number"
              name="contact_person_number"
              value = "{{ old('contact_person_number') }}"
              maxlength="10"
              pattern="\d{10}"
              inputmode="numeric"
            />
            <span class="help-block"><span></span></span>
          </div>


          <div class="col-md-6">
            <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
            <input
              type="text"
              class="form-control"
              id="contact_person_wp_number"
              name="contact_person_wp_number"
              value = "{{ old('contact_person_wp_number') }}"
            />
            <span class="help-block"><span></span></span>
          </div>

          <!--begin::Col-->
          <div class="col-md-6">
            <label for="contact_person_email" class="form-label">Email</label>
            <input
              type="name"
              class="form-control"
              id="contact_person_email"
              name="contact_person_email"
              value = "{{ old('email') }}"
            />
            <span class="help-block"><span></span></span>
          </div>
          <!--end::Col-->

          <div class="col-md-6">
            <label for="email" class="form-label">Show Contact Publicly</label>
            <input type="checkbox" id="show_contact_publicly" name="show_contact_publicly">
            <label for="show_contact"> Yes</label><br>         

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
            <span class="help-block"><span></span></span>
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
            <span class="help-block"><span></span></span>
          </div>

          <div class="col-md-6">
              <label for="account_status" class="form-label">Account Status<span class="text-danger">*</span></label>
              <select class="form-select" id="account_status" name="profile_status">
                <option selected disabled value="">Choose...</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            <span class="help-block"><span></span></span>
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
<script type="text/javascript" src="{{ asset('js/profile/create.js') }}"></script>
@endsection
