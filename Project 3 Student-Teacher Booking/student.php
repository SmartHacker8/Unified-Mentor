<?php
session_start();
require_once('db.php');

// Check if student is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: student_login.php");
    exit();
}

// Handle appointment booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['book_appointment'])) {
        $student_id = $_SESSION['id'];
        $teacher_id = $_POST['teacher_id'];
        $date = $_POST['date'];
        $reason = $_POST['reason'];
        
        $sql = "INSERT INTO appointments (student_id, teacher_id, date, reason) 
                VALUES ($student_id, $teacher_id, '$date', '$reason')";
                
        if ($conn->query($sql) === TRUE) {
            $success = "Appointment booked successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch list of teachers
$sql_teachers = "SELECT id, name FROM teachers";
$result_teachers = $conn->query($sql_teachers);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <h3>Book Appointment</h3>
    <form method="post">
        <select name="teacher_id" required>
            <?php
            if ($result_teachers->num_rows > 0) {
                while($row = $result_teachers->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No teachers available</option>";
            }
            ?>
        </select><br><br>
        <input type="date" name="date" required><br><br>
        <textarea name="reason" placeholder="Reason for appointment" required></textarea><br><br>
        <button type="submit" name="book_appointment">Book Appointment</button>
    </form>
    <?php if (isset($success)) echo $success; ?>
    <?php if (isset($error)) echo $error; ?>
    <!-- Display other student functionalities -->
</body>
</html>
