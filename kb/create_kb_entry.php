
<?php
// create_kb_entry.php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = escape_input($conn, $_POST['title']);
    $content = escape_input($conn, $_POST['content']);
    $tags = escape_input($conn, $_POST['tags']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO knowledge_base (user_id, title, content, tags) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $title, $content, $tags);

    if ($stmt->execute()) {
        header("Location: view_kb_entry.php?id=" . $stmt->insert_id);
        exit();
    } else {
        $error = "Error creating entry. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Knowledge Base Entry - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Create Knowledge Base Entry</h1>
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <form method="POST" action="create_kb_entry.php" class="max-w-2xl">
            <div class="mb-4">
                <label for="title" class="block mb-2">Title:</label>
                <input type="text" id="title" name="title" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="content" class="block mb-2">Content:</label>
                <textarea id="content" name="content" required class="w-full px-3 py-2 border rounded" rows="10"></textarea>
            </div>
            <div class="mb-4">
                <label for="tags" class="block mb-2">Tags (comma-separated):</label>
                <input type="text" id="tags" name="tags" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Create Entry</button>
        </form>
    </div>
</body>
</html>

<?php
// view_kb_entry.php
require_once 'db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: knowledge_base.php");
    exit();
}

$entry_id = escape_input($conn, $_GET['id']);

$sql = "SELECT kb.*, u.username FROM knowledge_base kb JOIN users u ON kb.user_id = u.id WHERE kb.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $entry_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: knowledge_base.php");
    exit();
}

$entry = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($entry['title']); ?> - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($entry['title']); ?></h1>
        <p class="text-gray-600 mb-4">By <?php echo htmlspecialchars($entry['username']); ?> on <?php echo date('F j, Y', strtotime($entry['created_at'])); ?></p>
        <div class="prose lg:prose-xl mb-4">
            <?php echo nl2br(htmlspecialchars($entry['content'])); ?>
        </div>
        <p class="text-sm text-gray-500 mb-4">Tags: <?php echo htmlspecialchars($entry['tags']); ?></p>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $entry['user_id']): ?>
            <div class="mt-4">
                <a href="edit_kb_entry.php?id=<?php echo $entry['id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Edit</a>
                <a href="delete_kb_entry.php?id=<?php echo $entry['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
