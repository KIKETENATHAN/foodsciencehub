<?php
session_start();
require_once 'db_connection.php';
$conn = new mysqli("localhost", "root", "", "food_science_hub");
$user_id = $_SESSION['user_id'];  // Assume user_id is stored in session after login

$query = "SELECT id, message, is_read, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}
echo json_encode($notifications);

$stmt->close();
$conn->close();
?>
