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
    $full_name = htmlspecialchars($_POST['full_name']);
    $bio = htmlspecialchars($_POST['bio']);
    $profession = htmlspecialchars($_POST['profession']);
    $institution = htmlspecialchars($_POST['institution']);
    $location = htmlspecialchars($_POST['location']);
    $website = htmlspecialchars($_POST['website']);

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
    <title>User Profile - CampoPrime</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Dashboard Layout -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-500 min-h-screen text-white p-6">
            <div class="mb-8">
            </div>
            <nav class="space-y-4 fixed top-0 left-10">
            <h1 class="text-2xl font-bold">FoodscienceHub</h1>
                <a href="dashboard.php" class="block py-2 px-4 rounded-lg hover:bg-green-600">Dashboard</a>
                <a href="profile.php" class="block py-2 px-4 rounded-lg hover:bg-green-600 bg-green-600">Profile</a>
                <a href="logout.php" class="block py-2 px-4 rounded-lg hover:bg-green-600">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Profile Header -->
            <div class="flex items-center space-x-4 mb-4">
                <img src="<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default_user_icon.png'; ?>" alt="User Icon" class="w-16 h-16 rounded-full">
                <h2 class="text-3xl font-bold text-green-700">Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
            </div>

            <!-- Profile Update Form -->
            <div class="bg-white p-6 rounded-lg shadow">
                <?php if (isset($success_message)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="profile.php" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="full_name" class="block mb-2">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label for="bio" class="block mb-2">Bio:</label>
                        <textarea id="bio" name="bio" class="w-full px-3 py-2 border rounded"><?php echo htmlspecialchars($user['bio']); ?></textarea>
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

                    <div class="mb-4">
                        <label for="profession" class="block mb-2">Profession:</label>
                        <input type="text" id="profession" name="profession" value="<?php echo htmlspecialchars($user['profession']); ?>" class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label for="institution" class="block mb-2">Institution:</label>
                        <input type="text" id="institution" name="institution" value="<?php echo htmlspecialchars($user['institution']); ?>" class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block mb-2">Location:</label>
                        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($user['location']); ?>" class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label for="website" class="block mb-2">Website:</label>
                        <input type="text" id="website" name="website" value="<?php echo htmlspecialchars($user['website']); ?>" class="w-full px-3 py-2 border rounded">
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Profile</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
