// document.getElementById('search_profile').addEventListener('submit', function(e) {
//     let minAge = document.getElementById('min_age').value;
//     let maxAge = document.getElementById('max_age').value;

//     minAge = minAge ? parseInt(minAge) : null;
//     maxAge = maxAge ? parseInt(maxAge) : null;

//     if (minAge !== null && maxAge !== null && minAge > maxAge) {
//         alert('Minimum age cannot be greater than maximum age');
//         e.preventDefault();
//     }
// });


function BookmarkFunction(profileId, el) {
    if(window.loggedIn == true)
    {
        el.disabled = true;
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
        .then(async (res) => {
            const contentType = res.headers.get("content-type") || "";

            if (res.redirected || contentType.includes("text/html")) {
                const redirectUrl = res.url || "/email/verify";
                throw { type: "verification_redirect", redirectUrl };
            }

            if (!res.ok) {
                let message = "Unable to update favourite profile.";
                try {
                    const errorData = await res.json();
                    message = errorData.message || message;
                } catch (e) {}
                throw { type: "request_error", message };
            }

            return res.json();
        })
        .then(data => {
            const icon = el.querySelector('i');

            if (data.status === 'added') {
                if (icon) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                }
                el.setAttribute('aria-label', 'Remove from favourites');
                el.setAttribute('title', 'Remove from favourites');
                Swal.fire({
                  title: 'Good job!',
                  text: 'Pofile Added in Favourite',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#8b1e3f',
                  returnFocus: false,
                });
            } else {
                if (icon) {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                }
                el.setAttribute('aria-label', 'Add to favourites');
                el.setAttribute('title', 'Add to favourites');
                Swal.fire({
                  title: 'Good job!',
                  text: 'Pofile Removed from Favourite',
                  icon: 'success',
                  confirmButtonText: 'OK',
                  confirmButtonColor: '#8b1e3f',
                  returnFocus: false,
                });
            }
            el.disabled = false;
            el.blur();
        })
        .catch((error) => {
            el.disabled = false;
            if (error?.type === "verification_redirect") {
                Swal.fire({
                    title: "Email verification required",
                    text: "Please verify your email to add profiles to favourites.",
                    icon: "warning",
                    confirmButtonText: "Verify Email"
                }).then(() => {
                    window.location.href = error.redirectUrl;
                });
                return;
            }

            Swal.fire({
                title: "Something went wrong",
                text: error?.message || "Unable to update favourite profile right now.",
                icon: "error"
            });
        });
    }else{
        Swal.fire({
          title: "<strong>Login Required</strong>",
          icon: "info",
          text: "Login required to add favourites.",
          showCloseButton: true,
          focusConfirm: false,
          confirmButtonText: 'Login',
          confirmButtonColor: '#8b1e3f'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "/login";
          }
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
      title: "Are you sure you want to delete?",
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
    title: "Are you sure you want to change profile Status?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes!"
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