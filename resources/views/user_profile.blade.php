@extends('layouts.user.app')

@section('title')
User Detail Page
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
@endsection

@section('content')

<div class="container mt-4 mb-4">
  <div class="profile-page">
    <a href="{{ url()->previous() ?? route('user.profiles') }}" class="btn btn-theme-outline mb-3">
      ← Back
    </a>

    <div class="card profile-hero shadow-sm p-3 p-md-4 mb-4">
      <div class="row align-items-center g-3">
        <div class="col-12 col-md-3 text-center">
          <img src="{{ $profile->profile_photo?->image ? asset('/profile_photos/'.$profile->profile_photo->image) : ($profile->gender == 'Male' ? asset('/assets/img/man.png') : asset('/assets/img/women.png')) }}"
            alt="{{ $profile->first_name }} profile image"
            class="rounded-circle profile-avatar previewable-image"
            data-previewable-image="true">
        </div>
        <div class="col-12 col-md-9">
          <h3 class="mb-1 fw-bold">{{ $profile->first_name }} {{ $profile->middle_name }} {{ $profile->last_name }}</h3>
          <p class="text-muted mb-3">{{ $profile->city->name ?? '-' }} | {{ $profile->occupation ?? '-' }}</p>
          @if(Auth::user()?->role == "User")
            <button
              class="favourite-heart-btn"
              onclick="BookmarkFunction({{ $profile->id }},this)"
              aria-label="{{ !empty($is_favourite) ? 'Remove from favourites' : 'Add to favourites' }}"
              title="{{ !empty($is_favourite) ? 'Remove from favourites' : 'Add to favourites' }}">
              <i class="bi {{ !empty($is_favourite) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
            </button>
          @endif
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-12 col-lg-8">
        <div class="card section-card p-3 p-md-4">
          <h5 class="section-title">Personal Information</h5>
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Name</span><span class="info-value">{{ $profile->first_name }} {{ $profile->last_name }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Gender</span><span class="info-value">{{ $profile->gender ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Birth Date</span><span class="info-value">{{ $profile->date_of_birth ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Age</span><span class="info-value">{{ $profile->age ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Birth Time</span><span class="info-value">{{ $profile->birth_time ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Birth Place</span><span class="info-value">{{ $profile->birth_place ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Height</span><span class="info-value">{{ $profile->height ? str_replace(".", "'", $profile->height) : '-' }}*</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Weight</span><span class="info-value">{{ $profile->Weight ?? '-' }} kg</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Marital Status</span><span class="info-value">{{ $profile->marital_status ? str_replace('_' , ' ', $profile->marital_status) : '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Mother Tongue</span><span class="info-value">{{ $profile->mother_tounge ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Rashi</span><span class="info-value">{{ $profile->rashi ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Caste</span><span class="info-value">{{ $profile->caste ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Gotra</span><span class="info-value">{{ $profile->gotra ?? '-' }}</span></div></div>
          </div>

          <h5 class="section-title">Location Details</h5>
          <div class="row g-3 mb-3">
            <div class="col-12">
              <div class="info-item">
                <span class="info-label">Address</span>
                <span class="info-value">{{ $profile->current_address ?? '-' }}, {{ $profile->city->name ?? '-' }}, {{ $profile->state->name ?? '-' }}, {{ $profile->country->name ?? '-' }}</span>
              </div>
            </div>
          </div>

          <h5 class="section-title">Education & Profession</h5>
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Education</span><span class="info-value">{{ $profile->education ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Occupation</span><span class="info-value">{{ $profile->occupation ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Company Name</span><span class="info-value">{{ $profile->company_name ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Annual Income</span><span class="info-value">{{ $profile->annual_income ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Work Location</span><span class="info-value">{{ $profile->work_location ?? '-' }}</span></div></div>
          </div>

          <h5 class="section-title">Family Details</h5>
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Father Name</span><span class="info-value">{{ $profile->father_name ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Father Occupation</span><span class="info-value">{{ $profile->father_occupation ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Mother Name</span><span class="info-value">{{ $profile->mother_name ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Mother Occupation</span><span class="info-value">{{ $profile->mother_occupation ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">No. of Brothers</span><span class="info-value">{{ $profile->no_of_brothers ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">No. of Sisters</span><span class="info-value">{{ $profile->no_of_sisters ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Family Type</span><span class="info-value">{{ $profile->family_type ?? '-' }}</span></div></div>
          </div>

          <h5 class="section-title">Mosal Details</h5>
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-6">
              <div class="info-item">
                <span class="info-label">Mosal Place</span>
                <span class="info-value">{{ $profile->mosal_name ?: '-' }}</span>
              </div>
            </div>
            @foreach($profile->mosals as $mosal)
              <div class="col-12 col-md-6">
                <div class="info-item">
                  <span class="info-label">Contact Details</span>
                  <span class="info-value">{{ $mosal->person_name ? $mosal->person_name. ' ,': ''  }}  {{ $profile->show_contact_publicly ? $mosal->contact_number : Str::mask($mosal->contact_number, '*', 0, -2) }}</span>
                </div>
              </div>
            @endforeach
          </div>

          <h5 class="section-title">Lifestyle & Personal Info</h5>
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">Hobbies</span><span class="info-value">{{ $profile->hobbies ?? '-' }}</span></div></div>
            <div class="col-12 col-md-6"><div class="info-item"><span class="info-label">About Me</span><span class="info-value">{{ $profile->about_me ?? '-' }}</span></div></div>
          </div>

          <h5 class="section-title">Contact Details</h5>
          <div class="row g-3 mb-3">
            <div class="col-12">
              <div class="info-item">
                <span class="info-label">Contact Person</span>
                <span class="info-value">{{ $profile->contact_person_name ?? '-' }}, {{ $profile->show_contact_publicly ? $profile->contact_person_number : Str::mask($profile->contact_person_number, '*', 0, -2) }}</span>
              </div>
            </div>
          </div>

          @if($profile->gallery_photo->isNotEmpty())
            <h5 class="section-title">Other Images</h5>
            @if(count($profile->gallery_photo) > 0)
              <div class="gallery-grid">
                @foreach($profile->gallery_photo as $gallery_photo)
                  <img src="{{ asset('/gallery_photo/'.$gallery_photo->image) }}" alt="Gallery photo" class="gallery-thumb previewable-image" data-previewable-image="true">
                @endforeach
              </div>
            @else
              <p class="text-center text-muted mb-0">No other images</p>
            @endif
          @endif
        </div>
      </div>

      <div class="col-12 col-lg-4 d-flex flex-column gap-3">
        <div class="card contact-card p-3 text-center">
          <h5 class="mb-2 fw-bold">Contact Admin</h5>
          <p class="mb-1"><strong>Name:</strong> {{ $profile->admin_details->first_name }} {{ $profile->admin_details->last_name }}</p>
          <p class="mb-3"><strong>Contact:</strong> {{ $profile->admin_details->phone_number }}</p>
          <a href="tel:{{ $profile->admin_details->phone_number }}" class="btn btn-theme w-100">📞 Contact Admin</a>
        </div>

        <div class="card contact-card p-3 text-center">
          <h5 class="mb-2 fw-bold">Contact User</h5>
          <p class="mb-1"><strong>Name:</strong> {{ $profile->contact_person_name ?? '-' }}</p>
          <p class="mb-3"><strong>Contact:</strong> {{ $profile->show_contact_publicly ? $profile->contact_person_number : Str::mask($profile->contact_person_number, '*', 0, -2) }}</p>
          <a href="tel:{{ $profile->contact_person_number }}" class="btn btn-theme w-100">📞 Contact User</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="image-lightbox-overlay" id="imageLightbox" aria-hidden="true">
  <div class="image-lightbox-content" role="dialog" aria-modal="true" aria-label="Image preview dialog">
    <button type="button" class="image-lightbox-close" id="imageLightboxClose" aria-label="Close image preview">&times;</button>
    <img src="" alt="Preview image" class="image-lightbox-image" id="imageLightboxImage">
    <div class="image-lightbox-caption" id="imageLightboxCaption"></div>
  </div>
</div>

@endsection

@section('js')
<script>
window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};

(() => {
  const previewImages = document.querySelectorAll('[data-previewable-image="true"]');
  const lightbox = document.getElementById('imageLightbox');
  const lightboxImage = document.getElementById('imageLightboxImage');
  const lightboxCaption = document.getElementById('imageLightboxCaption');
  const closeBtn = document.getElementById('imageLightboxClose');

  if (!previewImages.length || !lightbox || !lightboxImage || !closeBtn) {
    return;
  }

  const openLightbox = (src, altText) => {
    lightboxImage.src = src;
    lightboxImage.alt = altText || 'Image preview';
    lightboxCaption.textContent = altText || 'Photo Preview';
    lightbox.classList.add('is-open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const closeLightbox = () => {
    lightbox.classList.remove('is-open');
    lightbox.setAttribute('aria-hidden', 'true');
    lightboxImage.src = '';
    document.body.style.overflow = '';
  };

  previewImages.forEach((imageEl) => {
    imageEl.addEventListener('click', () => openLightbox(imageEl.src, imageEl.alt));
  });

  closeBtn.addEventListener('click', closeLightbox);

  lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) {
      closeLightbox();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && lightbox.classList.contains('is-open')) {
      closeLightbox();
    }
  });
})();
</script>
<script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
@endsection