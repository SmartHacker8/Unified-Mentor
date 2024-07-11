<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection
require_once('db_connect.php');

// Initialize variables
$id = $_GET['id'] ?? null;

// Fetch diet details based on ID
if ($id) {
    $query = "SELECT id, member_id, details, date FROM diet_details WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $dietDetail = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Process form submission for updating diet details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $details = $_POST['details'] ?? '';
    
    // Validate and sanitize inputs if needed
    
    // Update diet details in the database
    $query = "UPDATE diet_details SET details = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$details, $id]);
    
    // Redirect to diet details page after updating
    header("Location: diet_details.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diet Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Diet Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="POST">
            <div class="form-group">
                <label for="details">Details:</label>
                <textarea id="details" name="details" rows="5" cols="40"><?php echo htmlspecialchars($dietDetail['details']); ?></textarea>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
