<?php
$host = 'localhost';  // Assuming your database is on the same machine
$dbname = 'assignment_database';
$username = 'root';    // Default username for XAMPP
$password = '';        // Default password for XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
