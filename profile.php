<?php
session_start();
require_once 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission for profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = escape_input($conn, $_POST['full_name']);
    

    // Handle profile picture upload
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_picture']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($filetype, $allowed)) {
            $newname = "profile_".$user_id.".".$filetype;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/'.$newname);
            $profile_picture = 'uploads/'.$newname;
        }
    }

    // Update user profile in the database
    $update_sql = "UPDATE users SET full_name = ?, bio = ?, profession = ?, institution = ?, location = ?, website = ?" . 
                  (isset($profile_picture) ? ", profile_picture = ?" : "") . " WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    if (isset($profile_picture)) {
        $stmt->bind_param("sssssssi", $full_name, $bio, $profession, $institution, $location, $website, $profile_picture, $user_id);
    } else {
        $stmt->bind_param("ssssssi", $full_name, $bio, $profession, $institution, $location, $website, $user_id);
    }
    $stmt->execute();

    $success_message = "Profile updated successfully!";
}

// Fetch user profile data
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p>User not found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Your App Name</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function toggleDetails() {
            const details = document.getElementById('profile-details');
            details.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-green-50">
    <nav class="bg-green-600 p-4 flex justify-between items-center">
        <h2 class="text-white text-xl font-bold">Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
        <div class="flex items-center cursor-pointer" onclick="toggleDetails()">
            <div class="bg-white p-1 rounded-full">
    <img src="<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default_user_icon.png'; ?>" alt="User Icon" class="w-12 h-12 rounded-full">
</div>

            <h1 class="text-3xl font-bold text-white"><?php echo htmlspecialchars($user['full_name']); ?></h1>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <div id="profile-details" class="hidden top-1/4 right-4 bg-white shadow-lg rounded-lg overflow-auto max-h-[25vh] max-w-sm p-6">
            <?php if (isset($success_message)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <div class="fixed top-1/4 right-4 bg-white shadow-lg rounded-lg overflow-auto max-h-[25vh] max-w-sm p-6">
                <form method="POST" action="profile.php" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="full_name" class="block mb-2">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" class="w-full px-3 py-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="profile_picture" class="block mb-2">Profile Picture:</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="w-full px-3 py-2 border rounded">
                    </div>
                    <?php if (!empty($user['profile_picture'])): ?>
                        <div class="mb-4">
                            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="w-32 h-32 object-cover rounded-full mx-auto">
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Profile</button>
                    <a href="logout.php" class="text-white bg-red-600 px-4 py-2 rounded">Logout</a>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-4">
                <a href="post_handler.php" class="bg-blue-600 text-white px-4 py-2 rounded">Create a Blog</a>
            </div>
</body>
</html>
