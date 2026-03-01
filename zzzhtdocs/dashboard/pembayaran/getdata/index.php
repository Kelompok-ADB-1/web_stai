<?php
require_once __DIR__ . '/../../../masuk/connection.php';

$sql = "SELECT up.*, u.email, ud.nama_mhs, tp.nama_pembayaran 
        FROM userpembayaran up
        JOIN users u ON up.id = u.id
        LEFT JOIN userdata ud ON up.id = ud.id
        LEFT JOIN transaksipembayaran tp ON up.transaksi_id = tp.id
        ORDER BY up.tanggal_upload DESC";
$result = $conn->query($sql);

$data = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}
?>