<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error = "Username or email already exists";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($insert_stmt->execute()) {
                $_SESSION['user_id'] = $insert_stmt->insert_id;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $error = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-6 text-green-600">Sign Up for Food Science Hub</h1>
        <?php if (isset($error)) echo "<p class='text-red-500 text-center mb-4'>$error</p>"; ?>
        <form method="POST" action="signup.php">
            <div class="mb-4">
                <label for="username" class="block mb-2 font-medium">Username:</label>
                <input type="text" id="username" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 font-medium">Email:</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 font-medium">Password:</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2 font-medium">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>
            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500 transition duration-300">Sign Up</button>
        </form>
        <p class="mt-4 text-center">Already have an account? <a href="login.php" class="text-green-600">Login here</a></p>
        <p class="mt-4 text-center"><a href="index.php" class="text-green-600"><b>Homepage</b></a></p>
    </div>
</body>
</html>
