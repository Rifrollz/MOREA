<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Launching Soon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">🚀 We Are Launching Soon!</h1>
        <p class="mb-6 text-gray-300">Subscribe to get notified.</p>

        <!-- Subscription Form -->
        <form id="subscribeForm" class="space-y-4">
            <input type="email" id="email" placeholder="Enter your email" required
                class="px-4 py-2 rounded-md text-gray-900 w-80" />
            <button type="submit" class="bg-green-500 px-6 py-2 rounded-md text-white">Subscribe</button>
        </form>


    <script>
       document.getElementById("subscribeForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent page reload
            let email = document.getElementById("email").value;
            let submitBtn = event.target.querySelector("button");

            submitBtn.disabled = true; // Disable button after click to prevent multiple submissions

            // Ensure email is valid before sending request
            if (!email || !validateEmail(email)) {
                Swal.fire("❌ Error", "Please enter a valid email.", "error");
                submitBtn.disabled = false;
                return;
            }

            // Get the CSRF token from the meta tag
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("/subscribe", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken // Add CSRF token to the request header
                },
                body: JSON.stringify({ email })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("🎉 Subscribed!", "You have successfully subscribed.", "success");
                    } else {
                        Swal.fire("❌ Error", data.message || "Subscription failed", "error");
                    }
                })
                .catch(error => {
                    console.error("Error:", error); // Log any network error
                    Swal.fire("❌ Error", "Something went wrong!", "error");
                })
                .finally(() => submitBtn.disabled = false); // Re-enable button after response
        });

        // Basic email validation
        function validateEmail(email) {
            const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return re.test(email);
        }

    </script>
</body>

</html>



