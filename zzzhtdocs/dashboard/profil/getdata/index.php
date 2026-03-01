<?php
require_once __DIR__ . '/../../../masuk/connection.php';

$sql = "SELECT * FROM users LEFT JOIN userdata ON users.id = userdata.id;";
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