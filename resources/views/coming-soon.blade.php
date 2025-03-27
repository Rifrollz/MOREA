<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Launching Soon</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body class="text-white items-center justify-center flex flex-col min-h-screen">
    <main class="flex-grow">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4 items-center">🚀 We Are Launching Soon!</h1>
        <p class="mb-6 text-gray-300">Subscribe to get notified.</p>

        <!-- Subscription Form -->
                <form id="subscribeForm" class="flex">
                    <div class="flex join w-full">
                        <label class="input join-item flex-grow flex items-center">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </g>
                            </svg>
                            <input id="email" type="email" placeholder="mail@site.com" required
                                class="flex-grow px-3 py-2 border rounded-l-md focus:outline-none" />
                        </label>
                        <button type="submit" class="btn btn-success join-item rounded-r-md">
                            Subscribe
                        </button>
                    </div>
                </form>
    </div>
                

                
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
                        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        if (!csrfToken) {
                            console.error("CSRF token missing!");
                            Swal.fire("❌ Error", "CSRF token missing! Check meta tags.", "error");
                            return;
                        }

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

                </main>

                <!-- Footer Section -->

                <footer class="footer sm:footer-horizontal bg-base-200 text-base-content p-10">
                    <nav>
                        <h6 class="footer-title">Services</h6>
                        <a class="link link-hover">Branding</a>
                        <a class="link link-hover">Design</a>
                        <a class="link link-hover">Marketing</a>
                        <a class="link link-hover">Advertisement</a>
                    </nav>
                    <nav>
                        <h6 class="footer-title">Company</h6>
                        <a class="link link-hover">About us</a>
                        <a class="link link-hover">Contact</a>
                        <a class="link link-hover">Jobs</a>
                        <a class="link link-hover">Press kit</a>
                    </nav>
                    <nav>
                        <h6 class="footer-title">Legal</h6>
                        <a class="link link-hover">Terms of use</a>
                        <a class="link link-hover">Privacy policy</a>
                        <a class="link link-hover">Cookie policy</a>
                    </nav>
                    <form>
                        <h6 class="footer-title">Newsletter</h6>
                        <fieldset class="w-80">
                            <label>Enter your email address</label>
                            <div class="join">
                                <input type="text" placeholder="username@site.com" class="input input-bordered join-item" />
                                <button class="btn btn-primary join-item">Subscribe</button>
                            </div>
                        </fieldset>
                    </form>
                </footer>
</body>

</html>



