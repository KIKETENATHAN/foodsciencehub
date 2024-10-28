<!-- dashboard.php -->
<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        nav a {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: white;
            color: #2f855a;
            text-decoration: none;
            font-size: 1rem;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        nav a:hover {
            background-color: green;
            color: white;
            font-weight: bold;
            transform: scale(1.2);
        }

        #sidebar {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
            width: 16rem;
        }
        .sidebar-collapsed {
            width: 0;
            transform: translateX(-100%);
        }
        #mainContent {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 0rem;
        }
        .main-expanded {
            margin-left: 0;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex flex-col md:flex-row">
    <aside id="sidebar" class="w-64 bg-green-800 h-screen text-white p-6 fixed top-0 left-0">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Foodsciencehub</h1>
            </div>

            <!-- Toggle Arrow -->
            <button onclick="toggleSidebar()" class="absolute top-4 right-4 text-white">
                <i id="toggleIcon" class="fas fa-arrow-left"></i>
            </button>

            <nav class="space-y-4">
                <a href="#">Home</a>
                <a href="profile.php">Profile</a>
                <a href="#">Notifications</a>
                <a href="#">Chats</a>
                <hr>
                <hr>
                <a href="#">Events & Noticeboards</a>
                <a href="#">My Calendar</a>
                <a href="#">Clubs & Communities</a>
                <a href="#">Roadmap</a>
            </nav>
            <div class="mt-auto pt-6">
                <p class="text-sm text-center">Made with ❤️ by Celertech Labs &copy;2024</p>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="flex-1 p-4 md:p-8 transition-all duration-300">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-semibold">Global Community</h2>
                <button class="py-2 px-4 border-2 border-green-500 text-green-500 rounded-lg">+ Create Post</button>
            </div>

            <div class="flex space-x-4 mb-6">
                <button class="bg-green-600 text-white py-2 px-4 rounded-lg">Noticeboard</button>
                <button class="bg-white text-green-600 border-2 border-green-600 py-2 px-4 rounded-lg">Events</button>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">Community Events & Notices</h3>
                <p class="text-gray-500">Noticeboard is empty.</p>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Suggested For You</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Suggested Users -->
                    <div class="bg-white p-4 rounded-lg shadow text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full mb-4"></div>
                        <h4 class="font-semibold">User Name</h4>
                        <p class="text-gray-500">User Role/University</p>
                        <button class="mt-4 bg-green-500 text-white py-1 px-3 rounded-lg">Follow +</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer Navigation for Mobile View -->
    <div class="fixed bottom-0 left-0 right-0 bg-green-800 text-white flex justify-around py-2 z-50">
        <a href="#" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg"><i class="fas fa-home"></i></span>
            <span class="text-sm">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg"><i class="fas fa-book"></i></span>
            <span class="text-sm">Discover</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg"><i class="fas fa-user"></i></span>
            <span class="text-sm">Profile</span>
        </a>
        <a href="logout.php" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg"><i class="fas fa-sign-out-alt"></i></span>
            <span class="text-sm">Log out</span>
        </a>
    </div>
</body>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleIcon = document.getElementById('toggleIcon');

        sidebar.classList.toggle('sidebar-collapsed');
        mainContent.classList.toggle('main-expanded');

        if (sidebar.classList.contains('sidebar-collapsed')) {
            toggleIcon.classList.replace('fa-arrow-left', 'fa-arrow-right');
        } else {
            toggleIcon.classList.replace('fa-arrow-right', 'fa-arrow-left');
        }
    }
</script>
</html>
