<?php
// Database connection details
$servername = "localhost";  // XAMPP or WAMP server
$username = "root";
$password = "";
$database = "food_science_hub";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Notification message
$message = "Tomorrow is Friday";

// Option 1: Insert notification for all users
$query = "INSERT INTO notifications (user_id, message) SELECT id, ? FROM users";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $message);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Notification sent to all users"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to send notification"]);
}

$stmt->close();
$conn->close();
?>
