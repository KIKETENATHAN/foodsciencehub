<?php
session_start();
$conn = new mysqli("localhost", "root", "", "food_science_hub");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume user_id is stored in session after login
$user_id = $_SESSION['user_id'];

// Mark all notifications as read for this user
$query = "UPDATE notifications SET is_read = 1 WHERE user_id = ? AND is_read = 0";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "no_unread_notifications"]);
}

$stmt->close();
$conn->close();
?>
