<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Student login handling
    if (isset($_POST['student_login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Query database for student login
        $sql = "SELECT * FROM users WHERE username='$email' AND password='$password' AND role='student'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'student';
            header("Location: student.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Student Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="student_login">Login</button>
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
