<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection code here if needed
require_once('db_connect.php');

// Initialize variables
$id = $_GET['id'] ?? null;

// Fetch supplement details based on ID
if ($id) {
    $query = "SELECT id, name, description, price FROM supplement_store WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $supplement = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Process form submission for updating supplement details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';

    // Validate and update supplement details in the database
    $updateQuery = "UPDATE supplement_store SET name = ?, description = ?, price = ? WHERE id = ?";
    $stmt = $pdo->prepare($updateQuery);
    $stmt->execute([$name, $description, $price, $id]);

    // Redirect back to supplement_store.php or any other page after updating
    header("Location: supplement_store.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Supplement</h2>
        <form action="" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($supplement['name'] ?? ''); ?>"><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo htmlspecialchars($supplement['description'] ?? ''); ?></textarea><br>

            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($supplement['price'] ?? ''); ?>"><br>

            <button type="submit">Update Supplement</button>
        </form>
    </div>
</body>
</html>
