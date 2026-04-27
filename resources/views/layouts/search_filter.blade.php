<div class="col-12 col-lg-3">
  <div class="card filters-card filters-sticky">
    <div class="card-body">
      <div class="mb-3">
        <h5 class="filters-title mb-1">Quick Search</h5>
        <input
          type="text"
          name="name"
          form="filter_form"
          class="form-control"
          placeholder="Search by name, education, or profession"
          value="{{ request('name') ?: request('education') ?: request('profession') }}"
        >
      </div>
      <div class="mb-3">
        <h5 class="filters-title mb-1">Filters</h5>
        <p class="filters-subtitle mb-0">Refine profiles by preferences and details.</p>
      </div>
      <button class="btn filter-toggle-btn d-block d-md-none mb-3" type="button" id="filterToggleBtn">
        <i class="bi bi-chevron-compact-down"></i>
      </button>
      <div id="filterAccordion_full" class="accordion collapse d-md-block">
        <form method="get" name="filter_form" id="filter_form" action="{{ $actionRoute }}">
          <div class="accordion filter-accordion" id="filterAccordion">
            <!-- Gender -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button {{ request('gender') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#genderCollapse">
                  Gender
                </button>
              </h2>
              <div id="genderCollapse" class="accordion-collapse collapse {{ request('gender') ? 'show' : '' }}">
                <div class="accordion-body">
                  <select class="form-select" name="gender">
                    <option value="">All</option>
                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Marital Status -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button {{ request('marital_status') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#maritalCollapse">
                  Marital Status
                </button>
              </h2>
              <div id="maritalCollapse" class="accordion-collapse collapse {{ request('marital_status') ? 'show' : '' }}">
                <div class="accordion-body">
                  <select class="form-select" name="marital_status[]" id="marital_status" multiple="multiple">
                    <option value="Never_Married" <?php if(isset($_GET['marital_status']) &&  in_array('Never_Married', $_GET['marital_status'])) echo 'selected'; ?>>Never Married</option>
                    <option value="Divorced" <?php if(isset($_GET['marital_status']) && in_array('Divorced', $_GET['marital_status'])) echo 'selected'; ?>>Divorced</option>
                    <option value="Widowed" <?php if(isset($_GET['marital_status']) && in_array('Widowed', $_GET['marital_status'])) echo 'selected'; ?>>Widowed</option>
                    <option value="Mithi_Jibh_Cancel" <?php if(isset($_GET['marital_status']) && in_array('Mithi_Jibh_Cancel', $_GET['marital_status'])) echo 'selected'; ?>>Mithi Jibh Cancel</option>
                    <option value="Broken_Engagement" <?php if(isset($_GET['marital_status']) && in_array('Broken_Engagement', $_GET['marital_status'])) echo 'selected'; ?>>Broken Engagement</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- City -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button {{ request('city') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#cityCollapse">
                  City
                </button>
              </h2>
              <div id="cityCollapse" class="accordion-collapse collapse {{ request('city') ? 'show' : '' }}">
                <div class="accordion-body">
                  <select class="form-select" name="city[]" id="city" multiple="multiple">
                    @foreach($cityList as $city)
                      <option value="{{ $city->id }}"
                        {{ in_array($city->id, request('city', [])) ? 'selected' : '' }}>
                        {{ $city->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <!-- Age -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button {{ request('min_age') || request('max_age') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#ageCollapse">
                  Age Range
                </button>
              </h2>
              <div id="ageCollapse" class="accordion-collapse collapse {{ request('min_age') || request('max_age') ? 'show' : '' }}">
                <div class="accordion-body">
                  <input type="number" name="min_age" id="min_age" class="form-control mb-2" placeholder="Min Age" value="{{ request('min_age') }}">
                  <input type="number" name="max_age" id="max_age" class="form-control" placeholder="Max Age" value="{{ request('max_age') }}">
                </div>
              </div>
            </div>

            <input type="hidden" name="education" value="">
            <input type="hidden" name="profession" value="">
          </div>

          <!-- Buttons -->
          <div class="d-grid gap-2 mt-3">
            <button class="btn btn-theme">Apply Filters</button>
            <a href="{{ url()->current() }}" class="btn btn-theme-outline">Reset Filters</a>
          </div>
          <input type="hidden" name="sort_by" id="sort_by" value="" />
        </form>
      </div>
    </div>
  </div>
</div>