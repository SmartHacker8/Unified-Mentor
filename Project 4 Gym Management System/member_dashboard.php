<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'member') {
    header("Location: index.html");
    exit();
}

// Include database connection code here if needed
require_once('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome Member!</h2>
        <ul>
            <li><a href="view_bills.php">View Bill Receipts</a></li>
            <li><a href="view_notifications.php">View Notifications</a></li>
            <!-- Add more links to member-specific functionalities -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
