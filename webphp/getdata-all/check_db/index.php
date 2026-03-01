<?php
include __DIR__ . '/../../masuk/connection.php';

header('Content-Type: application/json');

$data = [];

$result = $conn->query("SHOW TABLES");

while ($row = $result->fetch_array()) {
    $tableName = $row[0];
    $data[$tableName] = [];

    $columns = $conn->query("DESCRIBE `$tableName`");

    while ($col = $columns->fetch_assoc()) {
        $data[$tableName][] = [
            'field' => $col['Field'],
            'type'  => $col['Type']
        ];
    }
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>