/* ======================================================
   COMMON JS FOR profiles + favourite_profiles
   Safe merged version (no duplicate scroll/events)
====================================================== */

(function () {
    "use strict";

    let page = 1;
    let loading = false;
    let hasMore = true;
    let scrollTimeout;

    /* ==========================================
       Detect Current Page Config
    ========================================== */
    const pageConfig = getPageConfig();

    function getPageConfig() {
        if ($('#favourite_profile_list').length) {
            return {
                ajaxUrl: '/user/favourite-profile',
                container: '#favourite_profile_list',
                reloadAfterFavourite: true
            };
        }

        if ($('#profile_list').length) {
            return {
                ajaxUrl: '/profiles',
                container: '#profile_list',
                reloadAfterFavourite: false
            };
        }

        return null;
    }

    /* ==========================================
       Favourite Function
    ========================================== */
    window.BookmarkFunction = function (profileId, el) {

        if (typeof window.loggedIn !== "undefined" && window.loggedIn === false) {
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
            return;
        }

        fetch('/user/profile/favourite', {
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
                throw {
                    type: "verification_redirect",
                    redirectUrl: res.url || "/email/verify"
                };
            }

            if (!res.ok) {
                let message = "Unable to update favourite profile.";

                try {
                    const errorData = await res.json();
                    message = errorData.message || message;
                } catch (e) {}

                throw {
                    type: "request_error",
                    message
                };
            }

            return res.json();
        })
        .then((data) => {

            /* Favourite page => remove + reload */
            if (pageConfig && pageConfig.reloadAfterFavourite) {
                Swal.fire({
                    text: "Profile Removed from Favourite",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#8b1e3f",
                    returnFocus: false
                }).then(() => location.reload());

                return;
            }

            /* Profiles page => toggle icon */
            if (data.status === "added") {

                Swal.fire({
                    text: "Profile Added in Favourite",
                    icon: "success",
                    confirmButtonColor: "#8b1e3f",
                    returnFocus: false
                });

                el.innerHTML = '<i class="bi bi-heart-fill"></i>';
                el.setAttribute('aria-label', 'Remove from favourites');
                el.setAttribute('title', 'Remove from favourites');

            } else {

                Swal.fire({
                    text: "Profile Removed from Favourite",
                    icon: "success",
                    confirmButtonColor: "#8b1e3f",
                    returnFocus: false
                });

                el.innerHTML = '<i class="bi bi-heart"></i>';
                el.setAttribute('aria-label', 'Add to favourites');
                el.setAttribute('title', 'Add to favourites');
            }

            el.blur();
        })
        .catch((error) => {

            if (error?.type === "verification_redirect") {
                Swal.fire({
                    title: "Email verification required",
                    text: "Please verify your email to manage favourites.",
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
    };

    /* ==========================================
       Infinite Scroll
    ========================================== */
    function loadMore() {

        if (!pageConfig || loading || !hasMore) return;

        loading = true;
        page++;

        let params = new URLSearchParams(window.location.search);
        params.set('page', page);

        $.ajax({
            url: pageConfig.ajaxUrl + '?' + params.toString(),
            type: "GET",
            dataType: "json",

            success: function (res) {

                if (res.html.trim() !== "") {
                    $(pageConfig.container).append(res.html);
                }

                if (!res.has_more) {
                    hasMore = false;

                    $(pageConfig.container).append(
                        "<div class='text-center mt-3' style='font-size:0.86rem'>No More Record Found</div>"
                    );
                }

                loading = false;
            },

            error: function () {
                loading = false;
            }
        });
    }

    $(window).on("scroll", function () {

        clearTimeout(scrollTimeout);

        scrollTimeout = setTimeout(function () {

            if (!pageConfig || loading || !hasMore) return;

            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let documentHeight = $(document).height();

            if (scrollTop + windowHeight >= documentHeight - 100) {
                loadMore();
            }

        }, 200);
    });

    /* ==========================================
       Filter Accordion
    ========================================== */
    document.addEventListener("DOMContentLoaded", function () {

        const filterAccordion = document.getElementById('filterAccordion_full');
        const filterToggleBtn = document.getElementById('filterToggleBtn');

        if (!filterAccordion || !filterToggleBtn) return;

        const icon = filterToggleBtn.querySelector('i');
        const isDesktop = window.innerWidth >= 768;

        const bsCollapse = new bootstrap.Collapse(filterAccordion, {
            toggle: false
        });

        if (isDesktop) {
            filterAccordion.classList.add('show');
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

        window.addEventListener('resize', function () {

            if (window.innerWidth >= 768) {
                filterAccordion.classList.add('show');
            } else {
                filterAccordion.classList.remove('show');
            }
        });
    });

})();