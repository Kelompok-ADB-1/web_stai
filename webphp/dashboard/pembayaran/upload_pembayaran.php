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
    
    // Create uploads directory if not exists
    $uploadDir = 'getdata/uploads_pembayaran/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES['bukti_bayar']) && $_FILES['bukti_bayar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['bukti_bayar']['tmp_name'];
        $fileName = $_FILES['bukti_bayar']['name'];
        $fileSize = $_FILES['bukti_bayar']['size'];
        $fileType = $_FILES['bukti_bayar']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize file name
        $newFileName = 'PAY_' . $user_id . '_' . $transaksi_id . '_' . time() . '.' . $fileExtension;

        if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {
            // Check if record exists
            $check_sql = "SELECT id FROM userpembayaran WHERE id = ? AND transaksi_id = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("is", $user_id, $transaksi_id);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                // Update existing
                $upd_sql = "UPDATE userpembayaran SET bukti_bayar = ?, status = 'verifikasi', tanggal_upload = CURRENT_TIMESTAMP WHERE id = ? AND transaksi_id = ?";
                $stmt_upd = $conn->prepare($upd_sql);
                $stmt_upd->bind_param("sis", $newFileName, $user_id, $transaksi_id);
                $stmt_upd->execute();
            } else {
                // Insert new
                $ins_sql = "INSERT INTO userpembayaran (id, transaksi_id, bukti_bayar, status, tanggal_upload) VALUES (?, ?, ?, 'verifikasi', CURRENT_TIMESTAMP)";
                $stmt_ins = $conn->prepare($ins_sql);
                $stmt_ins->bind_param("iss", $user_id, $transaksi_id, $newFileName);
                $stmt_ins->execute();
            }

            echo json_encode(['status' => 'success', 'message' => 'Upload berhasil']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memindahkan file']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diupload atau terjadi error']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
