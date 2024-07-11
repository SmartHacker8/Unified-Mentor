<?php
$host = 'localhost'; // Replace with your host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = 'gym_management'; // Replace with your database name

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO attributes (optional)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Disable emulated prepared statements
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
