$(document).ready(function () {
  $('#filterForm').on('submit', function (e) {
      e.preventDefault();
      fetchProfiles();
  });

  $('select[name="sorting"]').on('change', function () {
      $('#sort_by').val($('#sorting').val());
      $('#filter_form').submit();
  });
});

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

    $.ajax({
        url: "/profiles?page=" + page,
        type: "GET",
        dataType: "json",
        success: function (res) {
            if (res.html.trim() !== "") {
                $('#profile_list').append(res.html);
            }

            if (!res.has_more) {
                hasMore = false;
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

function BookmarkFunction(profileId, el) {
    if(window.loggedIn == true)
    {
      fetch(`/user/profile/favourite`, {
          method: "POST",
          headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              profile_id: profileId
          })
      })
      .then(res => res.json())
      .then(data => {
          if (data.status === 'added') {
              swal.fire("Good job!", "Pofile Added in Favourite", "success");
              el.innerText = '❤️ Favourited';

          } else {
              swal.fire("Good job!", "Pofile Removed from Favourite", "success");
              el.innerText = '❤️';
          }

      });
    }else{
        swal.fire({
          title: "Please Login to add profile!",
        });
    }
}

document.getElementById('filter_form').addEventListener('submit', function(e) {

    let minAge = document.getElementById('min_age').value;
    let maxAge = document.getElementById('max_age').value;

    minAge = minAge ? parseInt(minAge) : null;
    maxAge = maxAge ? parseInt(maxAge) : null;

    if (minAge !== null && maxAge !== null && minAge > maxAge) {
        alert('Minimum age cannot be greater than maximum age');
        e.preventDefault();
    }
});
document.addEventListener("DOMContentLoaded", function () {
  const filterAccordion = document.getElementById('filterAccordion_full');
  const filterToggleBtn = document.getElementById('filterToggleBtn');
  const icon = filterToggleBtn.querySelector('i');

  const isDesktop = window.innerWidth >= 768;

  const bsCollapse = new bootstrap.Collapse(filterAccordion, {
    toggle: !isDesktop
  });

  if (isDesktop) {
    filterAccordion.classList.add('show');
  } else {
    filterAccordion.classList.remove('show');
  }

  filterToggleBtn.addEventListener('click', function () {
    if (filterAccordion.classList.contains('show')) {
      bsCollapse.hide();
    } else {
      bsCollapse.show();
    }
  });

  filterAccordion.addEventListener('shown.bs.collapse', function () {
    icon.classList.remove('bi-chevron-compact-down');
    icon.classList.add('bi-chevron-compact-up');
  });

  filterAccordion.addEventListener('hidden.bs.collapse', function () {
    icon.classList.remove('bi-chevron-compact-up');
    icon.classList.add('bi-chevron-compact-down');
  });
});

window.addEventListener('resize', function () {
  const filterAccordion = document.getElementById('filterAccordion_full');

  if (window.innerWidth >= 768) {
    filterAccordion.classList.add('show');
  } else {
    filterAccordion.classList.remove('show');
  }
});