<?php
// Initialize your database connection
$servername = "localhost"; // Change this to your servername
$username = "root"; // Change this to your username
$password = ""; // Change this to your password
$database = "appointment_system"; // Change this to your database name

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to fetch all teachers
function fetchTeachers($conn) {
    $sql = "SELECT * FROM teachers";
    $result = mysqli_query($conn, $sql);
    $teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $teachers;
}

// Function to update a teacher
function updateTeacher($conn, $teacher_id, $name, $email, $password, $department, $subject) {
    $sql = "UPDATE teachers SET name='$name', email='$email', password='$password', department='$department', subject='$subject' WHERE id=$teacher_id";
    return mysqli_query($conn, $sql);
}

// Function to delete a teacher
function deleteTeacher($conn, $teacher_id) {
    $sql = "DELETE FROM teachers WHERE id=$teacher_id";
    return mysqli_query($conn, $sql);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Teacher
    if (isset($_POST['add_teacher'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $department = $_POST['department'];
        $subject = $_POST['subject'];

        $sql = "INSERT INTO teachers (name, email, password, department, subject) VALUES ('$name', '$email', '$password', '$department', '$subject')";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="success">Teacher added successfully!</div>';
        } else {
            echo '<div class="error">Error adding teacher: ' . mysqli_error($conn) . '</div>';
        }
    }

    // Update Teacher
    if (isset($_POST['update_teacher'])) {
        $teacher_id = $_POST['teacher_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $department = $_POST['department'];
        $subject = $_POST['subject'];

        if (updateTeacher($conn, $teacher_id, $name, $email, $password, $department, $subject)) {
            echo '<div class="success">Teacher updated successfully!</div>';
        } else {
            echo '<div class="error">Error updating teacher: ' . mysqli_error($conn) . '</div>';
        }
    }

    // Delete Teacher
    if (isset($_POST['delete_teacher'])) {
        $teacher_id = $_POST['teacher_id'];

        if (deleteTeacher($conn, $teacher_id)) {
            echo '<div class="success">Teacher deleted successfully!</div>';
        } else {
            echo '<div class="error">Error deleting teacher: ' . mysqli_error($conn) . '</div>';
        }
    }
}

// Fetch all teachers for dropdowns
$teachers = fetchTeachers($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <!-- Add Teacher Form -->
        <h2>Add Teacher</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="department" placeholder="Department" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <button type="submit" name="add_teacher" class="buttons">Add Teacher</button>
        </form>

        <!-- Update Teacher Form -->
        <h2>Update Teacher</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php foreach ($teachers as $teacher) : ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="text" name="department" placeholder="Department">
            <input type="text" name="subject" placeholder="Subject">
            <button type="submit" name="update_teacher" class="buttons">Update Teacher</button>
        </form>

        <!-- Delete Teacher Form -->
        <h2>Delete Teacher</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
            <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php foreach ($teachers as $teacher) : ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="delete_teacher" class="buttons">Delete Teacher</button>
        </form>
    </div>
</body>
</html>
