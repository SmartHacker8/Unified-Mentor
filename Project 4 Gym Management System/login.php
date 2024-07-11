<?php
session_start();
// Connect to database
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check credentials
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':username' => $username, ':password' => $password));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($user['role'] == 'member') {
            header("Location: member_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>
