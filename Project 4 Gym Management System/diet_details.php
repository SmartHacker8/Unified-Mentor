<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection
require_once('db_connect.php');

// Fetch diet details from database
$query = "SELECT id, member_id, details, date FROM diet_details";
$stmt = $pdo->query($query);
$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="table-container">
        <h2>Diet Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $detail): ?>
                    <tr>
                        <td><?php echo $detail['member_id']; ?></td>
                        <td><?php echo $detail['details']; ?></td>
                        <td><?php echo $detail['date']; ?></td>
                        <td>
                            <a href="edit_diet.php?id=<?php echo $detail['id']; ?>">Edit</a>
                            <a href="delete_diet.php?id=<?php echo $detail['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
