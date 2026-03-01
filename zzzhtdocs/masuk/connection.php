<?php
require_once __DIR__ . '/../config.php';
$host = "localhost";
$user = "root";        // default for XAMPP
$pass = "";            // default for XAMPP
$db   = "user_db";
$port = 3306;          // MySQL port (NOT Apache)

// Create mysqli connection


$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
