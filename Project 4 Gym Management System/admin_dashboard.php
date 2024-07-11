<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles specific to admin_dashboard.php */
        .admin-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .admin-container h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .admin-container ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        .admin-container li {
            margin-bottom: 10px;
        }

        .admin-container a {
            display: block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        .admin-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Welcome Admin!</h2>
        <ul>
            <li><a href="add_member.php">Add Member</a></li>
            <li><a href="update_members.php">Update/Delete Members</a></li>
            <li><a href="create_bill.php">Create Bill</a></li>
            <li><a href="assign_fee_package.php">Assign Fee Package</a></li>
            <li><a href="assign_notification.php">Assign Notification</a></li>
            <li><a href="supplement_store.php">Supplement Store</a></li>
            <li><a href="diet_details.php">Diet Details</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
