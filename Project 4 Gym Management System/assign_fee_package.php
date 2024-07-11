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

// Fetch fee packages from database
$queryPackages = "SELECT id, name FROM fee_packages";
$stmtPackages = $pdo->query($queryPackages);
$fee_packages = $stmtPackages->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $member_id = $_POST['member_id'];
    $fee_package_id = $_POST['fee_package_id'];

    // Perform database update (sanitize inputs and use prepared statements)
    $updateQuery = "UPDATE members SET fee_package_id = ? WHERE id = ?";
    $stmtUpdate = $pdo->prepare($updateQuery);
    $stmtUpdate->execute([$fee_package_id, $member_id]);

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
    <title>Assign Fee Package</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Assign Fee Package</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Dropdown for selecting member -->
            <select name="member_id" required>
                <option value="" disabled selected>Select Member</option>
                <?php foreach ($members as $member): ?>
                    <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <!-- Dropdown for fee packages -->
            <select name="fee_package_id" required>
                <option value="" disabled selected>Select Fee Package</option>
                <?php foreach ($fee_packages as $package): ?>
                    <option value="<?php echo $package['id']; ?>"><?php echo htmlspecialchars($package['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Assign Fee Package</button>
        </form>
    </div>
</body>
</html>
