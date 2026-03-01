<?php
session_start();
require_once __DIR__ . '/../../masuk/connection.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo "error: email or password empty";
    exit;
}

// Check if email already exists in users table (assuming we check the main users table)
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    echo "exists";
    exit;
}

// Proceed with registration - Role is 'calon_mahasiswa' by default
$role = 'calon_mahasiswa';
$stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $password, $role);

if ($stmt->execute()) {
    $_SESSION['registration_success'] = true;
    echo "success";
} else {
    echo "error: " . $conn->error;
}
?>