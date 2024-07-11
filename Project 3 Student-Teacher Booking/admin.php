<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Admin login handling
    if (isset($_POST['admin_login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Validate admin credentials
        if ($username === 'admin@gmail.com' && $password === 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="admin_login">Login</button>
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
