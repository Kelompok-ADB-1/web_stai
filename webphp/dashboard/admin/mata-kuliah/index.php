<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") { header("Location: ../../../masuk/"); exit; }
$pageTitle = "Mata Kuliah";
$userEmail = $_SESSION["email"] ?? "Admin";
$userRole = ucfirst($_SESSION["role"] ?? "Super Admin");

$nama_mhs = $_SESSION["nama_mhs"] ?? "";
$displayName = !empty($nama_mhs) ? $nama_mhs : $userEmail;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | STAI Sabilu Salam</title>
    <link rel="icon" type="image/svg+xml" href="../../../logo_stai-01.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../../../style.css"> 
    <link rel="stylesheet" href="../../dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>


    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../../navbar-dashboard.php'; ?>


        <div class="dashboard-container">
            <section class="welcome-section"><h1>Kurikulum & Mata Kuliah</h1><p>Kelola data mata kuliah dan jadwal perkuliahan.</p></section>
            <section class="panel"><div class="panel-header"><h3>Daftar Program Studi</h3></div><div class="row g-3"><div class="col-md-6"><div class="p-3 border rounded-3 bg-light"><h5>Hukum Ekonomi Syariah</h5><p class="small text-muted mb-0">Total 144 SKS</p></div></div><div class="col-md-6"><div class="p-3 border rounded-3 bg-light"><h5>Pendidikan Agama Islam</h5><p class="small text-muted mb-0">Total 144 SKS</p></div></div></div></section>
        </div>
    </main>
</body>
</html>
