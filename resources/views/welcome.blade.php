@extends('layouts.app')

@section('content')
  <!--begin::Container-->
  <div class="container-fluid">
        <form method="get" id="search_profile" name="search_profile" action= "{{ route('/') }}">
          <div class="row">

              <div class="col-md-3">
                <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                      <option selected  value="">All</option>
                      <option value="Male" <?php if(isset($_GET['gender']) && $_GET['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                      <option value="Female" <?php if(isset($_GET['gender']) && $_GET['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
              </div>

              <div class="col-md-3">
                <label for="city" class="form-label">City</label>
                  <select class="form-select" id="city" name="city">
                      <option selected value="">Select</option>
                      @foreach($cityList as $city)
                        <option value="{{ $city->id }}" <?php echo (isset($_GET['city']) && $_GET['city'] == $city->id) ? 'selected' : ''; ?>>{{ $city->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class ="col-md-3">
                <label for="marital_status" class="form-label">Marital Status<span class="text-danger">*</span></label>

                <select class="form-select" id="marital_status" name="marital_status">
                  
                  <option selected value="">Choose...</option>
                  <option value="Never_Married" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Never_Married') echo 'selected'; ?>>Never Married</option>
                  <option value="Divorced" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                  <option value="Widowed" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                  <option value="Mithi_Jibh_Cancel" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Mithi_Jibh_Cancel') echo 'selected'; ?>>Mithi Jibh Cancel</option>
                  <option value="Broken_Engagement" <?php if(isset($_GET['marital_status']) && $_GET['marital_status'] == 'Broken_Engagement') echo 'selected'; ?>>Broken Engagement</option>
                </select>
              </div>
              <div class="col-md-3 row">
                <label for="name" class="form-label">Age range</label>
                <input type="number" id="min_age" name="min_age" class="form-control" style="width: 150px;" placeholder="minimum age" min="0" value="<?php if (isset($_GET['min_age']) && $_GET['min_age'])  echo $_GET['min_age'] ?>" />
                <input type="number" id="max_age" name="max_age" class="form-control mx-2" style="width: 150px;" placeholder="maximum age" min="0" value="<?php if (isset($_GET['max_age']) && $_GET['max_age'])  echo $_GET['max_age'] ?>" />
              </div>
              <div class="col-md-3 mt-1">
                <label for="name" class="form-label">Religion/name/profession/Education</label>
                <input type="text" id="" name="name" class="form-control" value="<?php if (isset($_GET['name']) && $_GET['name'])  echo $_GET['name'] ?>" />
              </div>
              <div class="col-md-3 mt-4">
                <button type="submit" class="btn btn-primary mt-2">Search</button>
                <a href="{{ url()->current() }}" class="btn btn-warning mt-2 mx-2">Reset</a>
              </div>
          </div>
        </form>

      <div class="row mt-2">
        <div class="col-md-12">
          <div class="card mb-4">
              <!--begin::Container-->
                  <section class="content">
                    <!-- Default box -->
                    <div class="card card-solid">
                      <div class="card-body pb-0">
                        <div class="row">
                          @if(count($profilelist) > 0)
                          @foreach($profilelist as $profile)                          
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column p-3">
                              <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                  {{ $profile->gender }}
                                </div>
                                <div class="card-body pt-0">
                                  <div class="row">
                                    <div class="col-7">
                                      <a href="{{ route('user.profile',$profile->id) }}"><h2 class="lead"><b>{{ $profile->first_name }} {{ $profile->last_name }}</b></h2></a>
                                      <p class="text-muted text-sm"><b>Current Address: </b> {{ $profile->current_address }} </p>
                                      <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> {{ $profile->caste }}</</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ str_replace('_' , ' ', $profile->marital_status) }}</li>
                                      </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                      @if($profile?->profile_photo?->image)
                                      <img src="{{ asset('/profile_photos/'.$profile->profile_photo->image) }}" alt="user-avatar" class="img-circle img-fluid">
                                      @else
                                        @if($profile->gender == "Male")
                                        <img src="{{ asset('/assets/img/man.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                        @else
                                        <img src="{{ asset('/assets/img/women.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                        @endif
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          <!-- /.card -->
                          @endforeach
                          @else
                            <h2 class="text-center">No Record Found</h2>
                          @endif
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </section>

              <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                  <ul class="pagination justify-content-center m-0">
                      {{ $profilelist->links() }}
                  </ul>
                </nav>
              </div>
              <!--end::Container-->
        </div>
      </div>
  </div>
@endsection


@section('js')
<script type="text/javascript">
document.getElementById('search_profile').addEventListener('submit', function(e) {
    let minAge = document.getElementById('min_age').value;
    let maxAge = document.getElementById('max_age').value;

    minAge = minAge ? parseInt(minAge) : null;
    maxAge = maxAge ? parseInt(maxAge) : null;

    if (minAge !== null && maxAge !== null && minAge > maxAge) {
        alert('Minimum age cannot be greater than maximum age');
        e.preventDefault(); // stops GET request
    }
});
</script>
@endsection

