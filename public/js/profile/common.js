document.getElementById('search_profile').addEventListener('submit', function(e) {
    let minAge = document.getElementById('min_age').value;
    let maxAge = document.getElementById('max_age').value;

    minAge = minAge ? parseInt(minAge) : null;
    maxAge = maxAge ? parseInt(maxAge) : null;

    if (minAge !== null && maxAge !== null && minAge > maxAge) {
        alert('Minimum age cannot be greater than maximum age');
        e.preventDefault();
    }
});

document.getElementById('searchForm').addEventListener('submit', function(e) {

    let age = document.getElementById('age_range').value;
    document.getElementById('min_age').value = '';
    document.getElementById('max_age').value = '';
    if (age) {
        let parts = age.split('-');

        document.getElementById('min_age').value = parts[0];
        document.getElementById('max_age').value = parts[1];
    }
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
                el.classList.remove('bi-bookmarks');
                el.classList.add('bi-bookmark-fill', 'text-danger');
            } else {
                el.classList.remove('bi-bookmarks-fill', 'text-danger');
                el.classList.add('bi-bookmark');
            }

        });
    }else{
        swal.fire({
          title: "Please Login to add profile",
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.logout-btn').forEach(function(button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to logout?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    });
});

$(".btn-delete").click(function(e){
    e.preventDefault();
    var form = $(this).parents("form");

    Swal.fire({
      title: "Are you sure you want to delete",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
});

$(".btn-status").click(function(e){
  e.preventDefault();
  var form = $(this).parents("form");

  Swal.fire({
    title: "Are you sure you want to change profile Staus",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit();
    }
  });
});

$('.read-more').click(function (e) {
  e.preventDefault();
  let parent = $(this).closest('p');
  parent.find('.short-text').toggleClass('d-none');
  parent.find('.full-text').toggleClass('d-none');

  $(this).text($(this).text() === 'Read more' ? 'Show less' : 'Read more');
});