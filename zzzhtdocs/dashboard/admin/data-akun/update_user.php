<?php
$conn = new mysqli("localhost", "root", "", "user_db");

$id = $_POST['id'];
$email = $_POST['email'];
$role = $_POST['role'];

$stmt = $conn->prepare("UPDATE users SET email=?, role=? WHERE id=?");
$stmt->bind_param("ssi", $email, $role, $id);
$stmt->execute();

echo "success";
?>