<?php
header("Content-Type: application/json");
session_start();

// Security check
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
    exit;
}

require_once __DIR__ . '/../../../masuk/connection.php';

// Get POST data
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$nilai_ujian = isset($_POST['nilai_ujian']) ? $_POST['nilai_ujian'] : null;
$status = isset($_POST['status_mahasiswa']) ? $_POST['status_mahasiswa'] : null;
$catatan = isset($_POST['catatan']) ? $_POST['catatan'] : null;

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid User ID."]);
    exit;
}

// Check if user already has an entry in userseleksi
$check_sql = "SELECT id FROM userseleksi WHERE id = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // UPDATE
    $update_sql = "UPDATE userseleksi SET nilai_ujian = ?, status_mahasiswa = ?, catatan = ? WHERE id = ?";
    $stmt_update = $conn->prepare($update_sql);
    $stmt_update->bind_param("sssi", $nilai_ujian, $status, $catatan, $user_id);
    
    if ($stmt_update->execute()) {
        echo json_encode(["status" => "success", "message" => "Selection status updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update selection status: " . $conn->error]);
    }
} else {
    // INSERT
    $insert_sql = "INSERT INTO userseleksi (id, nilai_ujian, status_mahasiswa, catatan) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($insert_sql);
    $stmt_insert->bind_param("isss", $user_id, $nilai_ujian, $status, $catatan);
    
    if ($stmt_insert->execute()) {
        echo json_encode(["status" => "success", "message" => "Selection status created successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to create selection status: " . $conn->error]);
    }
}

$stmt->close();
$conn->close();
?>