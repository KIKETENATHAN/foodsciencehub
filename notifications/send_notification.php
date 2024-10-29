<?php
session_start();
$conn = new mysqli("localhost", "root", "", "food_science_hub");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];

// Insert notification for all users
$query = "INSERT INTO notifications (user_id, message, is_read) SELECT id, ?, 0 FROM users";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $message);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Notification sent to all users."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to send notification."]);
}

$stmt->close();
$conn->close();
?>
