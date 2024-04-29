document.addEventListener("DOMContentLoaded", function() {
    const acceptBtn = document.getElementById("acceptBtn");
    const rejectBtn = document.getElementById("rejectBtn");
    const acceptSelectedBtn = document.querySelector('[data-action="accept-selected"]');
    const hideCookieBannerBtn = document.getElementById("hideCookieBannerBtn");
    const policyCheckboxes = document.querySelectorAll('.policy-checkbox');

    function acceptAllCookies() {
        handleCookieConsent(true);
    }

    function rejectAllCookies() {
        handleCookieConsent(false);
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
            // No categories selected, reject cookies
            console.log("No categories selected");
            setCookieConsent(false);
            hideCookieBanner();
        }
    }

    function handleCookieConsent(consent) {
        setCookieConsent(consent);
        hideCookieBanner();
        logData(consent);
    }

    function setCookieConsent(consent) {
        document.cookie = `cookieConsent=${consent}; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;
        console.log("Cookie consent set to:", consent);
    }

    function hideCookieBanner() {
        const cookieBanner = document.getElementById("cookies");
        cookieBanner.style.display = "none";
    }

    function logData(consent) {
        function logData(consent) {
            // Read the message from the console
            const message = readConsoleMessage();
        
            // Check if the message is not empty
            if (message.trim() !== '') {
                // Send the message to the server using AJAX
                fetch('/path/to/server', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ consent: consent, message: message }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to send log data to server');
                    }
                })
                .catch(error => {
                    console.error('Error sending log data to server:', error);
                });
            } else {
                console.warn('Console message is empty. No data sent to server.');
            }
        }
        
        function readConsoleMessage() {
            // Replace this with your logic to read the message from the console
            // For demonstration purposes, we'll just return a static message
            return 'This is a sample console message.';
        }
        
        const selectedCategories = Array.from(policyCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.name);

        fetch('/project/index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ level: consent, message: selectedCategories }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to send log data to server');
            }
        })
        .catch(error => {
            console.error('Error sending log data to server:', error);
        });
    }

    // Event listener registration moved to the end
    acceptBtn.addEventListener("click", acceptAllCookies);
    rejectBtn.addEventListener("click", rejectAllCookies);
    acceptSelectedBtn.addEventListener("click", acceptSelectedCookies);
    hideCookieBannerBtn.addEventListener("click", hideCookieBanner);
});
