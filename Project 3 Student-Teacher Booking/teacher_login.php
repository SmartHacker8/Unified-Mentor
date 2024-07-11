<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Teacher login handling
    if (isset($_POST['teacher_login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Query database for teacher login
        $sql = "SELECT * FROM teachers WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['role'] = 'teacher';
            header("Location: teacher.php");
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
    <title>Teacher Login</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Teacher Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="teacher_login">Login</button>
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
