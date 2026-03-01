<?php
$conn = new mysqli("localhost", "root", "", "user_db");
if($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$allowed_columns = ['profile_pic','ktp','kk','pas_foto','ijazah','akta','prestasi'];

if(isset($_POST['submit'])){
    $user_id = (int)$_POST['user_id'];
    $column = $_POST['file_type'];

    if(!in_array($column, $allowed_columns)){
        die("Invalid document type.");
    }

    $target_dir = "../uploads/";
    if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $file_name = time() . "_" . basename($_FILES["file_upload"]["name"]);
    $target_file = $target_dir . $file_name;

    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg','jpeg','png','pdf'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if($_FILES["file_upload"]["size"] > $max_size){
        echo "<script>alert('Max file size is 2MB'); window.history.back();</script>";
        exit;
    }

    if(!in_array($file_type, $allowed_types)){
        echo "<script>alert('Only JPG, JPEG, PNG, PDF allowed'); window.history.back();</script>";
        exit;
    }

    if(move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)){

        $check_user = $conn->query("SELECT id FROM users WHERE id=$user_id");
        if($check_user->num_rows == 0){
            echo "<script>alert('User not found');</script>";
            exit;
        }

        $check_berkas = $conn->query("SELECT * FROM userberkas WHERE id=$user_id");

        if($check_berkas->num_rows > 0){
            $old = $check_berkas->fetch_assoc();
            if(!empty($old[$column]) && file_exists($old[$column])){
                unlink($old[$column]);
            }
            $sql = "UPDATE userberkas SET $column='$target_file' WHERE id=$user_id";
        } else {
            $sql = "INSERT INTO userberkas (id, $column) VALUES ($user_id, '$target_file')";
        }

        if($conn->query($sql)){
            echo "<script>alert('Upload successful'); window.location.href='';</script>";
        } else {
            echo "<script>alert('DB Error: ".$conn->error."');</script>";
        }
    } else {
        echo "<script>alert('Upload failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>User Documents Upload</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.dropzone {
    border: 2px dashed #0d6efd;
    border-radius: 10px;
    padding: 40px;
    text-align: center;
    cursor: pointer;
}
.dropzone img {
    max-width: 150px;
    margin-top: 10px;
}
</style>
</head>
<body class="bg-light">

<div class="container py-5">
<h3 class="mb-4">Users List <a href="../uploads/"> ->Lihat data</a></h3>

<table class="table table-bordered bg-white shadow">
<thead>
<tr>
<th>ID</th>
<th>Email</th>
<th>Pas Foto</th>
<th>Ijazah</th>
<th>KTP</th>
<th>KK</th>
<th>Akta</th>
<th>Sertifikat / Prestasi</th>
<th>Profile Picture</th>
</tr>
</thead>
<tbody>

<?php
$result = $conn->query("SELECT users.id AS user_id, users.email, userberkas.* 
                        FROM users 
                        LEFT JOIN userberkas ON users.id = userberkas.id
                        ORDER BY users.id");

while($row = $result->fetch_assoc()){
echo "<tr>
<td>{$row['user_id']}</td>
<td>{$row['email']}</td>";


$columns = ['pas_foto','ijazah','ktp','kk','akta','prestasi', 'profile_pic'];

foreach($columns as $col){
    echo "<td>";
    if(!empty($row[$col]) && file_exists($row[$col])){
        if(pathinfo($row[$col], PATHINFO_EXTENSION) == 'pdf'){
            echo "<a href='{$row[$col]}' target='_blank'>View PDF</a><br>";
        } else {
            echo "<img src='{$row[$col]}' width='50'><br>";
        }
    }
    echo "<button class='btn btn-sm btn-primary uploadBtn mt-1'
            data-id='{$row['user_id']}'
            data-type='{$col}'>
            Upload
          </button>";
    echo "</td>";
}

echo "</tr>";
}
?>

</tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal">
<div class="modal-dialog">
<div class="modal-content">
<form method="POST" enctype="multipart/form-data">
<div class="modal-header">
<h5 class="modal-title">Upload Document</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="hidden" name="user_id" id="user_id">
<input type="hidden" name="file_type" id="file_type">

<div class="dropzone" id="dropzone">
Click or Drop file here
<input type="file" name="file_upload" id="file_upload" hidden required>
<div id="preview"></div>
</div>

<p class="mt-2 text-muted">Max size: 2MB</p>
</div>

<div class="modal-footer">
<button type="submit" name="submit" class="btn btn-primary w-100">Upload</button>
</div>

</form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const uploadBtns = document.querySelectorAll('.uploadBtn');
const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
const userIdInput = document.getElementById('user_id');
const fileTypeInput = document.getElementById('file_type');
const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('file_upload');
const preview = document.getElementById('preview');

uploadBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        userIdInput.value = btn.dataset.id;
        fileTypeInput.value = btn.dataset.type;
        preview.innerHTML = '';
        fileInput.value = '';
        modal.show();
    });
});

dropzone.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if(!file) return;

    preview.innerHTML = '';

    if(file.type.startsWith('image/')){
        const reader = new FileReader();
        reader.onload = e => preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail">`;
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `<p>${file.name}</p>`;
    }
});
</script>

</body>
</html>