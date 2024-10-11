
<?php
// delete_kb_entry.php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: knowledge_base.php");
    exit();
}

$entry_id = escape_input($conn, $_GET['id']);

$sql = "DELETE FROM knowledge_base WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $entry_id, $_SESSION['user_id']);

if ($stmt->execute()) {
    header("Location: knowledge_base.php");
} else {
    echo "Error deleting entry. Please try again.";
}
?>