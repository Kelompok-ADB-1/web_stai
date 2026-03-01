<?php
$conn = new mysqli("localhost", "root", "", "user_db");

$id = (int)$_POST['id'];

// 1. Delete from all 3 related tables first
$conn->query("DELETE FROM userberkas WHERE id = $id");
$conn->query("DELETE FROM userdata WHERE id = $id");
$conn->query("DELETE FROM users WHERE id = $id");

// 2. Shift all subsequent IDs down by 1 to keep order 1,2,3...
// We iterate through all IDs greater than the deleted one and update them
$sql_shift = "SELECT id FROM users WHERE id > $id ORDER BY id ASC";
$res_shift = $conn->query($sql_shift);

while($row = $res_shift->fetch_assoc()) {
    $old_id = $row['id'];
    $new_id = $old_id - 1;
    
    // Update related tables first (Order is important to avoid collisions)
    $conn->query("UPDATE userberkas SET id = $new_id WHERE id = $old_id");
    $conn->query("UPDATE userdata SET id = $new_id WHERE id = $old_id");
    $conn->query("UPDATE users SET id = $new_id WHERE id = $old_id");
}

// 3. Reset auto increment
$conn->query("ALTER TABLE users AUTO_INCREMENT = 1");

echo "success";
?>