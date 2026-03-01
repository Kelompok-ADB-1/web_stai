<?php
session_start();
require_once __DIR__ . '/../../../masuk/connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $transaksi_id = $_POST['transaksi_id'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'] ?? '';

    $sql = "UPDATE userpembayaran SET status = ?, keterangan = ? WHERE id = ? AND transaksi_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $status, $keterangan, $id, $transaksi_id);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
