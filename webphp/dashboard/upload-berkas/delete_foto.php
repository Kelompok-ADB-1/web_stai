<?php
$conn = new mysqli("localhost", "root", "", "user_db");

$id = $_POST['id'];
$fieldname = $_POST['fieldname']; // column to clear

// whitelist column names
$allowedColumns = ['pas_foto', 'ijazah', 'ktp', 'kk', 'akta', 'prestasi'];
if (!in_array($fieldname, $allowedColumns)) {
    die("Invalid column name");
}

// Set that column to NULL (or '' if you prefer)
$sql = "UPDATE userberkas SET $fieldname = NULL WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo "success";
?>