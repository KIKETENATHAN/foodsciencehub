<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .btn-custom {
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-size: 16px;
            transition: background-color 0.3s ease;
            background-color: green;
        }

        .btn-custom:hover {
            background-color: #4caf50; /* Nature-like green on hover */
            color: white;
        }

        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .main-content {
            max-width: 800px;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        }

        .marquee-text {
            display: inline-block;
            position: relative;
            animation: slide-left 5s forwards;
        }
        @keyframes slide-left {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(0%);
        }
    }
    
</style>
</head>
<div class="bg-green-50">
<!-- Navigation Bar -->
<nav class="bg-green-600 p-4 fixed top-0 right-0 w-full z-50">
    <div class="container mx-auto flex justify-between items-center">
        <p class="text-white text-2xl font-bold">Food Science Hub</p>
        <!-- Hamburger Icon for small screens -->
        <button id="navbar-toggle" class="block lg:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <!-- Navigation Links -->
        <div id="navbar-menu" class="hidden lg:flex lg:space-x-4">
    <a href="#" class="bg-white text-green-700 py-2 px-4 rounded-lg no-underline hover:bg-green-500 hover:text-white">Home</a>
    <a href="#" class="bg-white text-green-700 py-2 px-4 rounded-lg no-underline hover:bg-green-700 hover:text-white">Blog</a>
    <div class="relative">
        <!-- Knowledge Base Button -->
        <a href="#" id="knowledgeBaseButton" class="bg-white text-green-700 py-2 px-4 rounded-lg no-underline hover:bg-green-500 hover:text-white">Knowledge Base</a>
                <!-- Floating Card for Knowledge Base Links -->
                <div id="knowledgeBaseLinks" class="hidden absolute top-10 right-0 bg-green-600 rounded-lg shadow-lg w-64 z-50">
                    <div class="p-4 space-y-2">
                        <a href="#link1" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Fruits and Vegetables</a>
                        <a href="#link2" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Dairy, Meat Tech</a>
                        <a href="#link4" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Cereals</a>
                        <a href="#link1" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Food Analysis & Quality</a>
                        <a href="#link2" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Food Engineering</a>
                        <a href="#link3" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Sugar and Confectionery</a>
                        <a href="#link4" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Beverages</a>
                        <a href="#link1" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Roots and Tubers</a>
                        <a href="#link3" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Food Microbiology</a>
                        <a href="#link4" class="block bg-white text-green-500 font-bold no-underline py-2 px-4 rounded-lg shadow hover:bg-gray-100">Quality Management System</a>
                    </div>
                </div>
            </div>
            <a href="#" class="bg-white text-green-700 py-2 px-4 rounded-lg no-underline hover:bg-green-200 hover:text-white">Jobs</a>
        </div>
    </div>
</nav>

   <!-- Main Content Area -->
<div class="pt-20">
    <div class="container mx-auto content-container mt-8 flex flex-col lg:flex-row flex-wrap gap-8">
        <!-- Card Column -->
        <div class="flex flex-col space-y-4 flex-1 min-w-[300px]"><!-- Add min-width for better wrapping -->
            <div class="marquee-container">
                <h1 class="marquee-text">Frequently Asked Questions</h1>
            </div>
            <div class="card bg-green-600 text-black p-4 rounded-lg cursor-pointer hover:bg-[#cfffdc] transition duration-300" onclick="toggleContent('science')">
                <h2 class="text-2xl font-bold text-green-600">What is Food Science?</h2>
                <p id="science-content" class="hidden">Food science is the study of the physical, biological, and chemical makeup of food. <br>
                    It applies science and engineering to food production, preservation, and quality management. <br>
                    The ultimate goal is to improve food safety, enhance nutrition, and innovate in food technology to make healthier and more sustainable products.</p>
            </div>

            <div class="card bg-green-600 text-black p-4 rounded-lg cursor-pointer hover:bg-[#cfffdc] transition duration-300" onclick="toggleContent('importance')">
                <h2 class="text-2xl font-bold text-green-600">Why is Food Science Important?</h2>
                <ul id="importance-content" class="hidden list-disc list-inside">
                    <li>Ensures food safety and quality standards.</li>
                    <li>Helps in the development of innovative and sustainable food products.</li>
                    <li>Contributes to reducing food waste and extending shelf life.</li>
                    <li>Promotes healthier eating habits by improving nutritional content.</li>
                </ul>
            </div>

            <div class="card bg-green-600 text-black p-4 rounded-lg cursor-pointer hover:bg-[#cfffdc] transition duration-300" onclick="toggleContent('webinars')">
                <h2 class="text-2xl font-bold text-green-600">Be updated with our latest Trends and Jobs, Webinars in the Market?</h2>
                <p id="webinars-content" class="hidden">Stay informed on the latest trends, 
                  job opportunities, and webinars in the food science industry. Explore market updates,
                 career insights, and expert-led events to boost your knowledge and skills.
                </p>
            </div>

            <div class="card bg-green-600 text-black p-4 rounded-lg cursor-pointer hover:bg-[#cfffdc] transition duration-300" onclick="toggleContent('careers')">
                <h2 class="text-2xl font-bold text-green-600">Careers in Food Science</h2>
                <p id="careers-content" class="hidden">The field of food science offers a wide range of career opportunities, including:</p>
                <ul id="careers-list" class="hidden list-disc list-inside">
                    <li>Food Technologist – Develop and improve food products and processes.</li>
                    <li>Quality Assurance Manager – Ensure food safety and compliance with regulations.</li>
                    <li>Nutritionist – Advise on healthy eating and create nutritious food plans.</li>
                    <li>Food Safety Inspector – Monitor and enforce food safety standards.</li>
                    <li>Research Scientist – Conduct research to innovate and improve food production techniques.</li>
                </ul>
            </div>

            <div class="card bg-green-600 text-black p-4 rounded-lg cursor-pointer hover:bg-[#cfffdc] transition duration-300" onclick="toggleContent('trends')">
                <h2 class="text-2xl font-bold text-green-600">Stay Updated with the Latest Trends</h2>
                <p id="trends-content" class="hidden">Explore our blog and knowledge base to stay updated on the latest advancements in food science, new food technologies, and best practices in food safety and sustainability.</p>
            </div>
        </div>

        <!-- Content Column -->
        <div class="main-content flex-1 min-w-[300px] px-4"> <!-- Add min-width for better wrapping -->
            <div class="marquee-container">
                <h1 class="text-3xl font-bold mb-4 marquee-text">Welcome to Food Science Hub</h1>
            </div>
            <p class="mb-4">Please log in or sign up to access all features.</p>

            <!-- Dynamic Login/Signup Section -->
            <div id="auth-section">
                <button class="btn btn-primary btn-custom mr-4" id="login-btn">Sign In</button>
                <p class="mt-4">Don't have an account? <a href="#" id="show-signup" class="text-green-600">Sign up here</a>.</p>
            </div>

            <!-- Slideshow Card -->
            <div class="max-w-lg w-full h-auto bg-#aaf0d1-600 shadow-lg rounded-lg p-6">
                <div id="slideshow" class="carousel slide relative" data-bs-ride="carousel">
                    <!-- Slideshow Card -->
                    <div class="max-w-lg w-full h-64 bg-green-600 shadow-lg rounded-lg p-6">
                        <!-- Slideshow Images -->
                        <div class="carousel-inner h-full">
                            <div class="carousel-item active">
                                <img src="images/1.png" class="d-block w-full h-full object-cover rounded-lg" alt="Slide 1">
                            </div>
                            <div class="carousel-item">
                                <img src="images/2.webp" class="d-block w-full h-full object-cover rounded-lg" alt="Slide 2">
                            </div>
                            <div class="carousel-item">
                                <img src="images/3.png" class="d-block w-full h-full object-cover rounded-lg" alt="Slide 3">
                            </div>
                            <div class="carousel-item">
                                <img src="images/4.webp" class="d-block w-full h-full object-cover rounded-lg" alt="Slide 4">
                            </div>
                            <div class="carousel-item">
                                <img src="images/5.png" class="d-block w-full h-full object-cover rounded-lg" alt="Slide 5">
                            </div>
                        </div>
                    </div>
                    <!-- Navigation Arrows -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!-- Slideshow Dots -->
                    <div class="mt-4 flex justify-center space-x-2">
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="w-3 h-3 rounded-full bg-yellow-400 active:bg-white" aria-current="true"></button>
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1" class="w-3 h-3 rounded-full bg-yellow-400 active:bg-white"></button>
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2" class="w-3 h-3 rounded-full bg-yellow-400 active:bg-white"></button>
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="3" class="w-3 h-3 rounded-full bg-yellow-400 active:bg-white"></button>
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="4" class="w-3 h-3 rounded-full bg-yellow-400 active:bg-white"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--navbar js-->
    <!-- JavaScript to toggle the menu on small screens -->
<script>
    const toggleButton = document.getElementById('navbar-toggle');
    const menu = document.getElementById('navbar-menu');

    toggleButton.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    function toggleContent(contentId) {
        const content = document.getElementById(contentId);
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
        } else {
            content.classList.add('hidden');
        }
    }
</script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript for dynamic signup/login buttons -->
    <script>
        // Toggle content visibility
        function toggleContent(topic) {
            const contentId = topic + '-content';
            const listId = topic + '-list';
            
            const content = document.getElementById(contentId);
            const list = document.getElementById(listId);
            
            // Toggle visibility
            if (content) {
                content.classList.toggle('hidden');
            }
            if (list) {
                list.classList.toggle('hidden');
            }
        }

        // Redirect to login page when login button is clicked
        document.getElementById('login-btn').addEventListener('click', function() {
            window.location.href = 'login.php';
        });

        // Display the signup button when "Sign up here" is clicked
        document.getElementById('show-signup').addEventListener('click', function(e) {
            e.preventDefault();
            // Replace the "Login" button with the "Sign Up" button
            document.getElementById('auth-section').innerHTML = `
                <button class="btn btn-success btn-custom mr-4" id="signup-btn">Sign Up</button>
                <p class="mt-4">Already have an account? <a href="#" id="show-login" class="text-green-600">Login here</a>.</p>
            `;
            
            // Add redirection for the sign-up button
            document.getElementById('signup-btn').addEventListener('click', function() {
                window.location.href = 'signup.php';
            });

            // Add functionality to switch back to login button
            document.getElementById('show-login').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('auth-section').innerHTML = `
                    <button class="btn btn-primary btn-custom mr-4" id="login-btn">Sign In</button>
                    <p class="mt-4">Don't have an account? <a href="#" id="show-signup" class="text-green-600">Sign up here</a>.
                    </p>
                `;

                // Re-add event listener for the login button
                document.getElementById('login-btn').addEventListener('click', function() {
                    window.location.href = 'login.php';
                });

                // Re-add event listener for the signup link
                document.getElementById('show-signup').addEventListener('click', function(e) {
                    e.preventDefault();
                    location.reload(); // Reload the page to reset back to sign up
                });
            });
        });
    document.addEventListener("DOMContentLoaded", function () {
        const knowledgeBaseButton = document.getElementById("knowledgeBaseButton");
        const knowledgeBaseLinks = document.getElementById("knowledgeBaseLinks");

        knowledgeBaseButton.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default anchor behavior
            knowledgeBaseLinks.classList.toggle("hidden"); // Toggle the hidden class
        });
    });

    </script>
<script>
 document.getElementById('searchButton').addEventListener('click', function () {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    // Remove existing highlights
    const highlightedElements = document.querySelectorAll('.highlight');
    highlightedElements.forEach(el => {
        const parent = el.parentNode;
        parent.replaceChild(document.createTextNode(el.textContent), el);
    });

    if (searchTerm) {
        const bodyText = document.body.innerHTML.toLowerCase();
        const regex = new RegExp(`(${searchTerm})`, 'gi'); // Use regex for case insensitive search

        if (bodyText.includes(searchTerm)) {
            // Highlight found terms
            document.body.innerHTML = document.body.innerHTML.replace(regex, `<span class="highlight">$1</span>`);
            alert(`Found: "${searchTerm}" in the webpage.`);
        } else {
            alert(`"${searchTerm}" not found.`);
        }
    }
});

// Optionally, you can also search when the user presses the "Enter" key
document.getElementById('searchInput').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        document.getElementById('searchButton').click();
    }
});

</script>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
