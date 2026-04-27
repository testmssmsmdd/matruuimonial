@foreach($profilelist as $profile)
    @php
      $fullAddress = ($profile->current_address ?? '-') . ', ' . ($profile->city->name ?? '-') . ', ' . ($profile->state->name ?? '-');
      $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 100);
    @endphp
    @include('layouts.profile_list')
@endforeach