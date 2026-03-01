<?php
header("Content-Type: application/json");

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "user_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Connection failed: " . $conn->connect_error
    ]));
}

// Query
$sql = "SELECT users.id AS user_id, users.email, userberkas.* 
        FROM users 
        LEFT JOIN userberkas ON users.id = userberkas.id
        ORDER BY users.id";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // Check if userberkas is NULL
        $isBerkasNull = true;

        foreach ($row as $key => $value) {
            if ($key !== 'user_id' && $key !== 'email' && $value !== null) {
                $isBerkasNull = false;
                break;
            }
        }

        $row['berkas_is_null'] = $isBerkasNull;

        $data[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "data" => [],
        "message" => "No data found"
    ]);
}

$conn->close();
?>