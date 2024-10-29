<?php
session_start();
$conn = new mysqli("localhost", "root", "", "food_science_hub");
$user_id = $_SESSION['user_id'];

$query = "SELECT id, message, is_read, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
$unreadCount = 0;
$readCount = 0;
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
    if ($row['is_read'] == 0) {
        $unreadCount++;
    } else {
        $readCount++;
    }
}
echo json_encode(["notifications" => $notifications, "unreadCount" => $unreadCount, "readCount" => $readCount]);

$stmt->close();
$conn->close();
?>
