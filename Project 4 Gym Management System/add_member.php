<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection
require_once('db_connect.php');

// Fetch fee packages from database
$query = "SELECT id, name FROM fee_packages";
$stmt = $pdo->query($query);
$fee_packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $fee_package_id = $_POST['fee_package_id'];
    $join_date = $_POST['join_date'];

    // Perform database insertion (sanitize inputs and use prepared statements)
    $insertQuery = "INSERT INTO members (name, email, phone, address, fee_package_id, join_date) 
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([$name, $email, $phone, $address, $fee_package_id, $join_date]);

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
    <title>Add Member</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Member</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone">
            <textarea name="address" placeholder="Address"></textarea>
            <!-- Dropdown for fee packages -->
            <select name="fee_package_id" required>
                <option value="" disabled selected>Select Fee Package</option>
                <?php foreach ($fee_packages as $package): ?>
                    <option value="<?php echo $package['id']; ?>"><?php echo htmlspecialchars($package['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="date" name="join_date" required>
            <button type="submit">Add Member</button>
        </form>
    </div>
</body>
</html>
