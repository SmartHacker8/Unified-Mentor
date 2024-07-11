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

// Fetch member details based on ID
if ($id) {
    $query = "SELECT id, name, email, phone, address, fee_package_id, join_date FROM members WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Process form submission for updating member details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $fee_package_id = $_POST['fee_package_id'] ?? '';

    // Validate and update member details in the database
    $updateQuery = "UPDATE members SET name = ?, email = ?, phone = ?, address = ?, fee_package_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($updateQuery);
    $stmt->execute([$name, $email, $phone, $address, $fee_package_id, $id]);

    // Redirect back to update_members.php or any other page after updating
    header("Location: update_members.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Member</h2>
        <form action="" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($member['name'] ?? ''); ?>"><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($member['email'] ?? ''); ?>"><br>

            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($member['phone'] ?? ''); ?>"><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address"><?php echo htmlspecialchars($member['address'] ?? ''); ?></textarea><br>

            <label for="fee_package_id">Fee Package ID:</label><br>
            <input type="text" id="fee_package_id" name="fee_package_id" value="<?php echo htmlspecialchars($member['fee_package_id'] ?? ''); ?>"><br>

            <button type="submit">Update Member</button>
        </form>
    </div>
</body>
</html>
