<?php
// upload_foto.php
$conn = new mysqli("localhost", "root", "", "user_db");
if ($conn->connect_error) die(json_encode(['status'=>'error','message'=>'Connection failed: ' . $conn->connect_error]));

$allowed_columns = ['profile_pic','ktp','kk','pas_foto','ijazah','akta','prestasi'];

// Get POST values
if(!isset($_POST['user_id']) || !isset($_POST['file_type'])){
    die(json_encode(['status'=>'error','message'=>'Missing parameters']));
}

$user_id = (int)$_POST['user_id'];
$column = $_POST['file_type'];

if(!in_array($column, $allowed_columns)) die(json_encode(['status'=>'error','message'=>'Invalid document type.']));
if(!isset($_FILES['file_upload'])) die(json_encode(['status'=>'error','message'=>'No file uploaded']));

// Upload directory
$target_dir = "./getdata/uploads/";
if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);

$file_name = time() . "_" . basename($_FILES["file_upload"]["name"]);
$target_file = $target_dir . $file_name;

$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowed_types = ['jpg','jpeg','png','pdf'];
$max_size = 2 * 1024 * 1024; // 2MB

if($_FILES["file_upload"]["size"] > $max_size) die(json_encode(['status'=>'error','message'=>'Max file size is 2MB']));
if(!in_array($file_type, $allowed_types)) die(json_encode(['status'=>'error','message'=>'Only JPG, JPEG, PNG, PDF allowed']));

// Move uploaded file
if(move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)){

    // Check if user already has a record
    $check_berkas = $conn->query("SELECT * FROM userberkas WHERE id=$user_id");

    if($check_berkas->num_rows > 0){
        $old = $check_berkas->fetch_assoc();
        if(!empty($old[$column]) && file_exists($old[$column])) unlink($old[$column]);
        $sql = "UPDATE userberkas SET $column='../uploads/$file_name' WHERE id=$user_id";
    } else {
        $sql = "INSERT INTO userberkas (id, $column) VALUES ($user_id, '../uploads/$file_name')";
    }

    if($conn->query($sql)){
        echo json_encode(['status'=>'success','file'=>$target_file]);
    } else {
        echo json_encode(['status'=>'error','message'=>$conn->error]);
    }

} else {
    echo json_encode(['status'=>'error','message'=>'Upload failed']);
}