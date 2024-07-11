<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection code here if needed
require_once('db_connect.php');

// Fetch members from database
// Example query: $query = "SELECT id, name, email, phone, address, fee_package_id, join_date FROM members";
// Execute query and fetch results

$query = "SELECT id, name, email, phone, address, fee_package_id, join_date FROM members";
$stmt = $pdo->query($query);
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Members</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="table-container">
        <h2>Update/Delete Members</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Fee Package</th>
                    <th>Join Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo $member['name']; ?></td>
                        <td><?php echo $member['email']; ?></td>
                        <td><?php echo $member['phone']; ?></td>
                        <td><?php echo $member['address']; ?></td>
                        <td><?php echo $member['fee_package_id']; ?></td>
                        <td><?php echo $member['join_date']; ?></td>
                        <td>
                            <a href="edit_member.php?id=<?php echo $member['id']; ?>">Edit</a>
                            <a href="delete_member.php?id=<?php echo $member['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
