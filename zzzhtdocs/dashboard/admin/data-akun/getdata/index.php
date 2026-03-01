<?php
require_once __DIR__ . '/../../../../masuk/connection.php';

$sql = "SELECT 
    users.id,
    users.email,
    users.password,
    users.role,

    userdata.nama_mhs,
    userdata.jurusan,
    userdata.nik,
    userdata.alamat,
    userdata.tempat_lahir,
    userdata.tanggal_lahir,

    userberkas.pas_foto,
    userberkas.ijazah,
    userberkas.ktp,
    userberkas.kk,
    userberkas.akta,
    userberkas.prestasi,
    userberkas.profile_pic,

    userseleksi.status_mahasiswa,
    userseleksi.nilai_ujian,
    userseleksi.catatan,

    userpembayaran.transaksi_id,
    userpembayaran.bukti_bayar,
    userpembayaran.nominal,
    userpembayaran.status AS pembayaran_status,
    userpembayaran.tanggal_upload,
    userpembayaran.keterangan,
    transaksipembayaran.nama_pembayaran,
    transaksipembayaran.nominal_default

FROM users
LEFT JOIN userdata ON users.id = userdata.id
LEFT JOIN userberkas ON users.id = userberkas.id
LEFT JOIN userseleksi ON users.id = userseleksi.id
LEFT JOIN userpembayaran ON users.id = userpembayaran.id
LEFT JOIN transaksipembayaran ON userpembayaran.transaksi_id = transaksipembayaran.id

ORDER BY users.id;";
$result = $conn->query($sql);

$data = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Pretty print JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    die("Query failed: " . $conn->error);
}
?>