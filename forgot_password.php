<?php
// forgot_password.php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = escape_input($conn, $_POST['email']);
    
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));
        
        $update_sql = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sss", $token, $expires, $email);
        $update_stmt->execute();
        
        // Send email with reset link (implement your email sending logic here)
        $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
        // For now, we'll just echo the link
        $success_message = "Password reset link has been sent to your email.";
    } else {
        $success_message = "If that email exists in our system, we've sent a password reset link.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-3xl font-bold mb-6 text-center">Forgot Password</h1>
        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="forgot_password.php">
            <div class="mb-4">
                <label for="email" class="block mb-2">Email:</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 w-full rounded">Reset Password</button>
        </form>
    </div>
</body>
</html>
