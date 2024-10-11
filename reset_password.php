<?php
// reset_password.php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = escape_input($conn, $_GET['token']);
    
    $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_expires > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        die("Invalid or expired token.");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = escape_input($conn, $_POST['token']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ? AND reset_expires > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $token);
    
    if ($stmt->execute()) {
        echo "Password successfully reset. You can now <a href='login.php'>login</a> with your new password.";
    } else {
        echo "Error resetting password. Please try again.";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Reset Password</h1>
        <form method="POST" action="reset_password.php" class="max-w-md">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="mb-4">
                <label for="password" class="block mb-2">New Password:</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Reset Password</button>
        </form>
    </div>
</body>
</html>