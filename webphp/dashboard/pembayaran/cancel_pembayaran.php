<?php
session_start();
include_once __DIR__ . '/../../masuk/connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION["id"])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION["id"];
    $transaksi_id = $_POST['transaksi_id'] ?? 'pendaftaran';

    // Check if record exists and is in 'verifikasi' or 'menunggu' status
    $check_sql = "SELECT bukti_bayar FROM userpembayaran WHERE id = ? AND transaksi_id = ? AND status IN ('verifikasi', 'menunggu')";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("is", $user_id, $transaksi_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $fileName = $row['bukti_bayar'];

        // Optional: Delete physical file
        if ($fileName) {
            $filePath = 'getdata/uploads_pembayaran/' . $fileName;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete record instead of updating (since User wants it removed)
        $del_sql = "DELETE FROM userpembayaran WHERE id = ? AND transaksi_id = ?";
        $stmt_del = $conn->prepare($del_sql);
        $stmt_del->bind_param("is", $user_id, $transaksi_id);
        
        if ($stmt_del->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Bukti berhasil ditarik kembali']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan atau sudah diproses']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
