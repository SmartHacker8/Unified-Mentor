<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Student registration handling
    if (isset($_POST['student_register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Check if username (email) already exists
        $sql_check = "SELECT * FROM users WHERE username='$username'";
        $result_check = $conn->query($sql_check);
        
        if ($result_check->num_rows > 0) {
            $error = "Email already registered";
        } else {
            // Insert new student into database
            $sql_register = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'student')";
            if ($conn->query($sql_register) === TRUE) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'student';
                header("Location: student_login.php");
                exit();
            } else {
                $error = "Error: " . $sql_register . "<br>" . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Student Registration</h2>
    <form method="post">
        <input type="email" name="username" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="student_register">Register</button>
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
