<?php
session_start();
require_once('db.php');

// Check if teacher is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: teacher_login.php");
    exit();
}

// Fetch appointments assigned to the teacher
$teacher_id = $_SESSION['id'];
$sql = "SELECT * FROM appointments WHERE teacher_id=$teacher_id";
$result = $conn->query($sql);

// Handle appointment status update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_status'])) {
        $appointment_id = $_POST['appointment_id'];
        $status = $_POST['status'];
        
        $sql_update = "UPDATE appointments SET status='$status' WHERE id=$appointment_id";
        if ($conn->query($sql_update) === TRUE) {
            $success = "Status updated successfully";
        } else {
            $error = "Error updating status: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <!-- CSS styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <h3>Your Appointments</h3>
    <table>
        <tr>
            <th>Date</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['reason'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='appointment_id' value='" . $row['id'] . "'>";
                echo "<select name='status'>
                        <option value='pending'>Pending</option>
                        <option value='approved'>Approved</option>
                        <option value='cancelled'>Cancelled</option>
                      </select>";
                echo "<button type='submit' name='update_status'>Update Status</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No appointments found</td></tr>";
        }
        ?>
    </table>
    <?php if (isset($success)) echo $success; ?>
    <?php if (isset($error)) echo $error; ?>
    <!-- Display other teacher functionalities -->
</body>
</html>
