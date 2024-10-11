<?php
// edit_kb_entry.php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: knowledge_base.php");
    exit();
}

$entry_id = escape_input($conn, $_GET['id']);

// Fetch the entry
$sql = "SELECT * FROM knowledge_base WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $entry_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: knowledge_base.php");
    exit();
}

$entry = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = escape_input($conn, $_POST['title']);
    $content = escape_input($conn, $_POST['content']);
    $tags = escape_input($conn, $_POST['tags']);

    $update_sql = "UPDATE knowledge_base SET title = ?, content = ?, tags = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssii", $title, $content, $tags, $entry_id, $_SESSION['user_id']);

    if ($update_stmt->execute()) {
        header("Location: view_kb_entry.php?id=" . $entry_id);
        exit();
    } else {
        $error = "Error updating entry. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Knowledge Base Entry - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Edit Knowledge Base Entry</h1>
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <form method="POST" action="edit_kb_entry.php?id=<?php echo $entry_id; ?>" class="max-w-2xl">
            <div class="mb-4">
                <label for="title" class="block mb-2">Title:</label>
                <input type="text" id="title" name="title" required class="w-full px-3 py-2 border rounded" value="<?php echo htmlspecialchars($entry['title']); ?>">
            </div>
            <div class="mb-4">
                <label for="content" class="block mb-2">Content:</label>
                <textarea id="content" name="content" required class="w-full px-3 py-2 border rounded" rows="10"><?php echo htmlspecialchars($entry['content']); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="tags" class="block mb-2">Tags (comma-separated):</label>
                <input type="text" id="tags" name="tags" class="w-full px-3 py-2 border rounded" value="<?php echo htmlspecialchars($entry['tags']); ?>">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Entry</button>
        </form>
    </div>
</body>
</html>