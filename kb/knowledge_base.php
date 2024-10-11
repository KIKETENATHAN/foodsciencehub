<?php
// knowledge_base.php
require_once '../db_connection.php';

$search = isset($_GET['search']) ? escape_input($conn, $_GET['search']) : '';

if (!empty($search)) {
    $sql = "SELECT kb.*, u.username 
            FROM knowledge_base kb 
            JOIN users u ON kb.user_id = u.id 
            WHERE MATCH(kb.title, kb.content, kb.tags) AGAINST (? IN BOOLEAN MODE)
            ORDER BY kb.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
} else {
    $sql = "SELECT kb.*, u.username 
            FROM knowledge_base kb 
            JOIN users u ON kb.user_id = u.id 
            ORDER BY kb.created_at DESC 
            LIMIT 20";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Base - Food Science Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Food Science Knowledge Base</h1>
        <form action="knowledge_base.php" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search the knowledge base..." value="<?php echo htmlspecialchars($search); ?>" class="w-full px-3 py-2 border rounded">
            <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded">Search</button>
        </form>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="create_kb_entry.php" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">Create New Entry</a>
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php while ($entry = $result->fetch_assoc()): ?>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">
                        <a href="view_kb_entry.php?id=<?php echo $entry['id']; ?>" class="text-green-600 hover:underline">
                            <?php echo htmlspecialchars($entry['title']); ?>
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-2">By <?php echo htmlspecialchars($entry['username']); ?> on <?php echo date('F j, Y', strtotime($entry['created_at'])); ?></p>
                    <p class="mb-2"><?php echo htmlspecialchars(substr($entry['content'], 0, 150)) . '...'; ?></p>
                    <p class="text-sm text-gray-500">Tags: <?php echo htmlspecialchars($entry['tags']); ?></p>
                    <a href="view_kb_entry.php?id=<?php echo $entry['id']; ?>" class="text-green-600 hover:underline">Read more</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

