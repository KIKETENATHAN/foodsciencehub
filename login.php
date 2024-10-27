<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-gradient-to-br from-green-700 to-green-400 shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-6 text-white">Login to The Hub</h1>
        <?php if (isset($error)) echo "<p class='text-red-300 text-center mb-4'>$error</p>"; ?>
        <form method="POST" action="login.php">
            <div class="mb-4">
                <label for="username" class="block mb-2 font-medium text-white">Username:</label>
                <input type="text" id="username" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 font-medium text-white">Password:</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-white text-green-600 border border-green-600 px-4 py-2 rounded font-bold hover:bg-green-100 transition duration-300">
                    Login
                </button>
            </div>
        </form>
        <p class="mt-4 text-center text-white">Don't have an account? <a href="signup.php" class="text-green-200">Sign up here</a></p>
        <p class="mt-4 text-center text-white">Forgot Password? <a href="forgot_password.php" class="text-green-200">Reset Here</a></p>
        <p class="mt-4 text-center">
        <a href="index.php" class="bg-white text-green-500 border border-green-500 py-2 px-4 rounded font-bold hover:bg-green-100">
        Homepage</a>
    </p>
    </div>
</body>
</html>
