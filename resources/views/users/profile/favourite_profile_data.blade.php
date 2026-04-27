@foreach($profilelist as $fav)
    @php 
        $profile = $fav->profile; 
        if (!$profile) {
            continue;
        }
        $profile->setAttribute('is_favourite', 1);
        $fullAddress = ($profile->current_address ?? '-') . ', ' . ($profile->city->name ?? '-') . ', ' . ($profile->state->name ?? '-');
        $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 100);
    @endphp
    @include('layouts.profile_list')
@endforeach