@extends('layouts.user.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/profiles.css') }}" />
@endsection

@section('content')
<div class="container mt-4 mb-4">
  <div class="profiles-page">
    <div class="row g-4">
      <!-- LEFT: FILTERS -->
      @include('layouts.search_filter', [
          'actionRoute' => route('user', [
              'username' => request()->route('username') ?? ''
          ])
      ])

      <div class="col-12 col-lg-9">
        @if(count($profilelist) > 0)
          <div class="card listing-card mb-4">
            <div class="card-body">
              <h5 class="listing-title mb-1">Matching Profiles</h5>
              <p class="listing-subtitle mb-0">Browse responsive profile cards with quick actions.</p>
            </div>
          </div>

          <div class="row" id="profile_list_items">
            @foreach($profilelist as $profile)
              @php
                $fullAddress = ($profile->current_address ?? '-') . ', ' . ($profile->city->name ?? '-') . ', ' . ($profile->state->name ?? '-');
                $shortAddress = \Illuminate\Support\Str::limit($fullAddress, 90);
              @endphp

              @include('layouts.profile_list')
            @endforeach
          </div>
        @else
          <div class="empty-state text-center">
            <h5 class="mb-1">No Record Found</h5>
            <p class="mb-0">Try changing filters to discover more profiles.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection


@section('js')
  <script>
    window.loggedIn = {{ auth()->check() ? 'true' : 'false' }};
    document.addEventListener("DOMContentLoaded", function () {
      const collapseItems = document.querySelectorAll('.filter-accordion .accordion-collapse');
      collapseItems.forEach((item, index) => {
        if (index === 0) {
          item.classList.add('show');
        }
      });
    });
  </script>
  <script type="text/javascript" src="{{ asset('js/profile/common.js') }}"></script>
  
  <script>
    var username = "{{ request()->username }}";

    let page = 1;
    let loading = false;
    let hasMore = true;

    $(window).on("scroll", function () {

        if (loading || !hasMore) return;

        let scrollTop = $(window).scrollTop();
        let windowHeight = $(window).height();
        let documentHeight = $(document).height();

        if (scrollTop + windowHeight >= documentHeight - 100) {
            loadMore();
        }
    });

    function loadMore() {
        loading = true;

        page++;
        let params = new URLSearchParams(window.location.search);
        params.set('page', page);

        $.ajax({
            url: "/user/"+ username +"?" + params.toString(),,
            type: "GET",
            dataType: "json",
            success: function (res) {
                if (res.html.trim() !== "") {
                    $('#profile_list_items').append(res.html);
                }

                if (!res.has_more) {
                    hasMore = false;
                    $('#profile_list_items').append("<span class='text-center' style='font-size=0.86rem'>No More Record found</span>");
                }

                loading = false;
            },
            error: function () {
                loading = false;
            }
        });
    }

    let scrollTimeout;

    $(window).on("scroll", function () {
        clearTimeout(scrollTimeout);

        scrollTimeout = setTimeout(function () {

            if (loading || !hasMore) return;

            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let documentHeight = $(document).height();

            if (scrollTop + windowHeight >= documentHeight - 100) {
                loadMore();
            }

        }, 200);
    });
    </script>
@endsection

