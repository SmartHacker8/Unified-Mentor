<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}

// Include database connection code here if needed
require_once('db_connect.php');

// Initialize variables
$id = $_GET['id'] ?? null;

// Delete member record from database based on ID
if ($id) {
    $deleteQuery = "DELETE FROM members WHERE id = ?";
    $stmt = $pdo->prepare($deleteQuery);
    $stmt->execute([$id]);

    // Redirect back to update_members.php or any other page after deletion
    header("Location: update_members.php");
    exit();
}
?>
