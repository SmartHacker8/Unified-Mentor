<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection
require_once('db_connect.php');

// Fetch members from database
$queryMembers = "SELECT id, name FROM members";
$stmtMembers = $pdo->query($queryMembers);
$members = $stmtMembers->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Perform database insertion (sanitize inputs and use prepared statements)
    $insertQuery = "INSERT INTO bills (member_id, amount, date) VALUES (?, ?, ?)";
    $stmtInsert = $pdo->prepare($insertQuery);
    $stmtInsert->execute([$member_id, $amount, $date]);

    // Redirect to admin dashboard or display success message
    // For example:
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Bill</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Create Bill</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Dropdown for selecting member -->
            <select name="member_id" required>
                <option value="" disabled selected>Select Member</option>
                <?php foreach ($members as $member): ?>
                    <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="amount" placeholder="Amount" required>
            <input type="date" name="date" required>
            <button type="submit">Create Bill</button>
        </form>
    </div>
</body>
</html>
