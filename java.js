document.addEventListener("DOMContentLoaded", function() {
    const acceptBtn = document.getElementById("acceptBtn");
    const rejectBtn = document.getElementById("rejectBtn");
    const acceptSelectedBtn = document.querySelector('[data-action="accept-selected"]');
    const policyCheckboxes = document.querySelectorAll('.policy-checkbox');

    acceptBtn.addEventListener("click", function() {
        acceptAllCookies();
    });

    rejectBtn.addEventListener("click", function() {
        rejectAllCookies();
    });

    acceptSelectedBtn.addEventListener("click", function() {
        acceptSelectedCookies();
    });

    function acceptAllCookies() {
        setCookieConsent(true);
        hideCookieBanner();
    }

    function rejectAllCookies() {
        setCookieConsent(false);
        hideCookieBanner();
    }

    function acceptSelectedCookies() {
        let selectedCategories = [];
        policyCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedCategories.push(checkbox.name);
            }
        });
        if (selectedCategories.length > 0) {
            // Handle accepting selected categories
            console.log("Accepted categories:", selectedCategories);
            setCookieConsent(true);
            hideCookieBanner();
        } else {
            alert("Please select at least one category.");
        }
    }

    function setCookieConsent(consent) {
        // Set cookie with path '/'
        document.cookie = "cookieConsent=" + consent + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        console.log("Cookie consent set to:", consent);
    }

    function hideCookieBanner() {
        const cookieBanner = document.getElementById("cookies");
        cookieBanner.style.display = "none";
    }
});
