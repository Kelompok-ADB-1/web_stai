<?php
$conn = new mysqli("localhost", "root", "", "user_db");

$email = $_POST['email'];
$role = $_POST['role'];

// --- ENFORCE DOMAIN & CALC PASSWORD ---
// Ensure email has @stai.ac.id
if (strpos($email, '@') === false) {
    $email .= "@stai.ac.id";
}

// --- CHECK IF EMAIL EXISTS ---
$check_sql = "SELECT id FROM users WHERE email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $email);
$check_stmt->execute();
$check_res = $check_stmt->get_result();

if ($check_res->num_rows > 0) {
    echo "exists";
    exit;
}

// Get username part for password
$password = explode('@', $email)[0];

// Since we maintain a perfect sequence on delete, we just find the next ID
$sql_max = "SELECT MAX(id) as max_id FROM users";
$res_max = $conn->query($sql_max);
$next_id = 1;

if ($res_max && $row = $res_max->fetch_assoc()) {
    $next_id = ($row['max_id'] ?? 0) + 1;
}

$stmt = $conn->prepare("INSERT INTO users (id, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $next_id, $email, $password, $role);
$stmt->execute();

echo "success";
?>