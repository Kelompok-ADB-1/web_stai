<?php
include __DIR__ . '/../masuk/connection.php';

header('Content-Type: application/json');

$response = [
    "users" => [],
    "calonUsers" => []
];

/*
|--------------------------------------------------------------------------
| 1️⃣ Get All Users With Single-Row Relations
|--------------------------------------------------------------------------
*/
$sql = "
SELECT 
    u.id,
    u.email,
    u.password,
    u.role,

    ud.nama_mhs,
    ud.jurusan,
    ud.nik,
    ud.alamat,
    ud.tempat_lahir,
    ud.tanggal_lahir,

    ub.pas_foto,
    ub.ijazah,
    ub.ktp,
    ub.kk,
    ub.akta,
    ub.prestasi,
    ub.profile_pic,

    us.status_mahasiswa,
    us.nilai_ujian,
    us.catatan

FROM users u
LEFT JOIN userdata ud ON u.id = ud.id
LEFT JOIN userberkas ub ON u.id = ub.id
LEFT JOIN userseleksi us ON u.id = us.id
ORDER BY u.id
";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {

        $userId = $row['id'];

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ Get Payments (MULTIPLE rows per user)
        |--------------------------------------------------------------------------
        */
        $payments = [];
        $payQuery = "
            SELECT 
                up.transaksi_id,
                up.bukti_bayar,
                up.nominal,
                up.status,
                up.tanggal_upload,
                up.keterangan,
                tp.nama_pembayaran,
                tp.nominal_default
            FROM userpembayaran up
            LEFT JOIN transaksipembayaran tp 
                ON up.transaksi_id = tp.id
            WHERE up.id = $userId
        ";

        $payResult = $conn->query($payQuery);
        if ($payResult) {
            while ($pay = $payResult->fetch_assoc()) {
                $payments[] = $pay;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ Build Clean User Object
        |--------------------------------------------------------------------------
        */
        $response["users"][] = [
            "user" => [
                "id" => $row['id'],
                "email" => $row['email'],
                "password" => $row['password'],
                "role" => $row['role']
            ],
            "userdata" => [
                "nama_mhs" => $row['nama_mhs'],
                "jurusan" => $row['jurusan'],
                "nik" => $row['nik'],
                "alamat" => $row['alamat'],
                "tempat_lahir" => $row['tempat_lahir'],
                "tanggal_lahir" => $row['tanggal_lahir']
            ],
            "userberkas" => [
                "pas_foto" => $row['pas_foto'],
                "ijazah" => $row['ijazah'],
                "ktp" => $row['ktp'],
                "kk" => $row['kk'],
                "akta" => $row['akta'],
                "prestasi" => $row['prestasi'],
                "profile_pic" => $row['profile_pic']
            ],
            "userseleksi" => [
                "status_mahasiswa" => $row['status_mahasiswa'],
                "nilai_ujian" => $row['nilai_ujian'],
                "catatan" => $row['catatan']
            ],
            "userpembayaran" => $payments
        ];
    }
}

/*
|--------------------------------------------------------------------------
| 4️⃣ Get Calon Users (Not Related)
|--------------------------------------------------------------------------
*/
$calonResult = $conn->query("SELECT * FROM calonUsers");

if ($calonResult) {
    while ($calon = $calonResult->fetch_assoc()) {
        $response["calonUsers"][] = $calon;
    }
}

/*
|--------------------------------------------------------------------------
| 5️⃣ Output JSON
|--------------------------------------------------------------------------
*/
echo json_encode($response, JSON_PRETTY_PRINT);

$conn->close();
?>