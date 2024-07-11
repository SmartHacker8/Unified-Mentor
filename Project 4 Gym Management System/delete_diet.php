<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection
require_once('db_connect.php');

// Initialize variables
$id = $_GET['id'] ?? null;

// Fetch diet details based on ID
if ($id) {
    $query = "DELETE FROM diet_details WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
}

// Redirect to diet details page after deletion
header("Location: diet_details.php");
exit();
?>
