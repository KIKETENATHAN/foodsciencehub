<!-- dashboard.php -->
<?php
// Check if user is logged in, redirect if not
session_start();
//if (!isset($_SESSION['logged_in'])) {
   // header('Location: login.php');
   // exit;
//}
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
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-green-800 min-h-screen text-white p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Foodsciencehub</h1>
            </div>
            <nav class="space-y-4">
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-yellow-600 hover:text-yellow-400">Home</a>
                <a href="profile.php" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">Profile</a>
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">Notifications</a>
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">Chats</a>
                <hr class="border-white my-4">
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">Events & Noticeboards</a>
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">My Calendar</a>
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">Clubs & Communities</a>
                <hr class="border-green-600 my-4">
                <a href="#" class="block py-2 px-4 rounded-lg bg-white text-green-800 no-underline hover:bg-green-600 hover:text-yellow-400">Roadmap</a>
            </nav>


            <div class="mt-auto pt-6">
                <p class="text-sm text-center">Made with ❤️ by Celertech Labs &copy;2024</p>
            </div>
        </aside>

        <!-- Main Content -->
         
        <main class="flex-1 p-8">
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
                    <!-- Repeat above div for other users -->
                </div>
            </div>
        </main>
    </div>

    <!-- Footer Navigation for Mobile View -->
    <div class="fixed bottom-0 left-0 right-0 bg-green-800 text-white flex justify-around py-2">
        <a href="#" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg">🏠</span>
            <span class="text-sm">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg">📚</span>
            <span class="text-sm">Discover</span>
        </a>
        <a href="#" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg">🔥</span>
            <span class="text-sm">Bytes</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center py-2 px-4 rounded-lg bg-white text-green-800 no-underline">
            <span class="text-lg">👤</span>
            <span class="text-sm">Profile</span>
        </a>
    </div>
</body>
<script>
        function toggleDetails() {
            const details = document.getElementById('profile-details');
            details.classList.toggle('hidden');
        }
    </script>
</html>
