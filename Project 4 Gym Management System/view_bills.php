<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'member') {
    header("Location: index.html");
    exit();
}

// Include database connection code here if needed
require_once('db_connect.php');

// Fetch bills for the logged-in member from database
$user_id = $_SESSION['user_id'];
$query = "SELECT id, amount, date FROM bills WHERE member_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$bills = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bill Receipts</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="table-container">
        <h2>Bill Receipts</h2>
        <table>
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bills as $bill): ?>
                    <tr>
                        <td><?php echo $bill['amount']; ?></td>
                        <td><?php echo $bill['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
