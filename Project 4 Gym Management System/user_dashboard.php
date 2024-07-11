<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
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
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome User!</h2>
        <ul>
            <!-- Add links to user-specific functionalities -->
            <li><a href="view_details.html">View Details</a></li>
            <li><a href="contact_us.html">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
