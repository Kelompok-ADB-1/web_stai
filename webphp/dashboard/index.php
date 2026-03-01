<?php
session_start();
include_once __DIR__ . '/../masuk/connection.php';

// Security Gatekeeper: ANY logged-in user can access (Admin OR Mahasiswa)
if (!isset($_SESSION["role"])) {
    header("Location: ../masuk/");
    exit;
}

// PMB / Mahasiswa Dashboard - Stai Sabilu Salam
$pageTitle = "Portal Calon Mahasiswa";
$user_id = $_SESSION["id"];
$userEmail = $_SESSION["email"] ?? "User";
$userRole = ucfirst($_SESSION["role"] ?? "Calon Mahasiswa");
$currentDate = date("l, d F Y");

// Fetch User Data for Name and Biodata Completion
$sql_user = "SELECT * FROM userdata WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$res_user = $stmt_user->get_result();
$user_data = $res_user->fetch_assoc();

$nama_mhs = $user_data['nama_mhs'] ?? "";
$is_biodata_complete = !empty($nama_mhs); 

// Get Name from Session (set in login or updated in profil) as fallback if userdata not updated in session yet
if (empty($nama_mhs)) {
    $nama_mhs = $_SESSION["nama_mhs"] ?? "";
}

$displayName = !empty($nama_mhs) ? $nama_mhs : $userEmail;
$firstName = explode(' ', trim($displayName))[0];
$firstName = explode('@', $firstName)[0]; 

// Fetch Berkas Data from Database
$sql = "SELECT * FROM userberkas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$berkas = $result->fetch_assoc();

$documents = [
    ['label' => 'Pas Foto 3x4', 'field' => 'pas_foto'],
    ['label' => 'Ijazah / SKL', 'field' => 'ijazah'],
    ['label' => 'KTP', 'field' => 'ktp'],
    ['label' => 'Kartu Keluarga', 'field' => 'kk'],
    ['label' => 'Akta Kelahiran', 'field' => 'akta'],
    ['label' => 'Sertifikat / Prestasi', 'field' => 'prestasi', 'optional' => true],
];

$uploadedCount = 0;
$totalDocs = 0;

foreach ($documents as $doc) {
    if (empty($doc['optional'])) {
        $totalDocs++;
        if ($berkas && !empty($berkas[$doc['field']])) {
            $uploadedCount++;
        }
    }
}

$uploadProgress = $totalDocs > 0 ? round(($uploadedCount / $totalDocs) * 100) : 0;

// Fetch Payment Status
$sql_pay = "SELECT status FROM userpembayaran WHERE id = ? ORDER BY id DESC LIMIT 1";
$stmt_pay = $conn->prepare($sql_pay);
$stmt_pay->bind_param("i", $user_id);
$stmt_pay->execute();
$res_pay = $stmt_pay->get_result();
$pay_data = $res_pay->fetch_assoc();

$is_payment_verified = ($pay_data && $pay_data['status'] === 'berhasil');

// Overall Progress calculation (Biodata = 25%, Upload = 50%, Pay = 25%)
$bioWeight = $is_biodata_complete ? 25 : 0;
$uploadWeight = ($uploadProgress / 100) * 50;
$payWeight = $is_payment_verified ? 25 : 0;
$progressPercent = $bioWeight + $uploadWeight + $payWeight;

// Status Logic
if ($uploadedCount === 0) {
    $registrationStatus = "Belum Mulai";
    $statusColor = "text-warning";
} elseif ($uploadedCount < $totalDocs) {
    $registrationStatus = "Dalam Proses";
    $statusColor = "text-primary";
} else {
    $registrationStatus = "Selesai";
    $statusColor = "text-success";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | STAI Sabilu Salam</title>
    
    <link rel="icon" type="image/svg+xml" href="../logo_stai-01.svg">
    
    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css"> 
    <link rel="stylesheet" href="dashboard.css">

    <!-- Material Symbols (Consolidated) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    






</head>
<body>

    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/navbar-dashboard.php'; ?>


        <!-- Container -->
        <div class="dashboard-container">
            <!-- Registration Tracker Header -->
            <section class="welcome-section d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1>Halo, <?php echo $firstName; ?>! 👋</h1>
                    <p>Silahkan lengkapi proses pendaftaran Anda.</p>
                </div>
                <div class="bg-white p-3 rounded-4 shadow-sm border d-flex align-items-center gap-3">
                    <div class="stat-info text-end">
                        <span class="label">Status Akun</span>
                        <strong class="<?php echo $statusColor; ?>"><?php echo $registrationStatus; ?></strong>
                    </div>
                    <div class="stat-icon green rounded-circle" style="width: 45px; height: 45px;">
                        <span class="material-symbols-rounded">verified</span>
                    </div>
                </div>
            </section>

            <!-- PMB STEP TRACKER -->
            <section class="panel mb-4 mt-2">
                <div class="panel-header">
                    <h3>Progress Pendaftaran PMB</h3>
                    <span class="badge <?php echo ($progressPercent == 100) ? 'bg-success-subtle text-success border-success-subtle' : 'bg-warning-subtle text-warning border-warning-subtle'; ?> border px-3 py-2 rounded-pill"><?php echo $progressPercent; ?>% Complete</span>
                </div>
                
                <div class="mt-4">
                    <div class="progress mb-4" style="height: 8px; border-radius: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $progressPercent; ?>%; background: var(--primary-main);" aria-valuenow="<?php echo $progressPercent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    
                    <div class="row text-center g-2 pmb-steps">
                        <div class="col">
                            <div class="step-circle <?php echo $is_biodata_complete ? 'active' : 'current'; ?> mb-2">1</div>
                            <small class="fw-bold d-block">Biodata</small>
                            <?php if ($is_biodata_complete): ?>
                                <span class="material-symbols-rounded text-success fs-5">check_circle</span>
                            <?php else: ?>
                                <small class="text-primary fw-bold">Wajib</small>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <div class="step-circle <?php echo ($uploadProgress == 100) ? 'active' : (($is_biodata_complete && $uploadProgress > 0) ? 'current' : ''); ?> mb-2">2</div>
                            <small class="fw-bold d-block">Upload Berkas</small>
                            <?php if ($uploadProgress == 100): ?>
                                <span class="material-symbols-rounded text-success fs-5">check_circle</span>
                            <?php else: ?>
                                <small class="text-muted"><?php echo $uploadProgress; ?>%</small>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <div class="step-circle <?php echo $is_payment_verified ? 'active' : (($uploadProgress == 100) ? 'current' : ''); ?> mb-2">3</div>
                            <small class="fw-bold d-block">Bayar</small>
                            <?php if ($is_payment_verified): ?>
                                <span class="material-symbols-rounded text-success fs-5">check_circle</span>
                            <?php else: ?>
                                <small class="text-muted"><?php echo ($uploadProgress == 100) ? 'Pending' : 'Locked'; ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <div class="step-circle <?php echo $is_payment_verified ? 'current' : ''; ?> mb-2">4</div>
                            <small class="fw-bold d-block">Ujian / Verifikasi</small>
                            <small class="text-muted"><?php echo $is_payment_verified ? 'Pending' : 'Locked'; ?></small>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($uploadProgress == 100): ?>
            <!-- CONGRATS PANEL: ONLY SHOWN WHEN UPLOADS ARE 100% -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="panel p-4 overflow-hidden position-relative border-0 shadow-lg text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border-radius: 24px;">
                        <!-- Background Decoration -->
                        <div class="position-absolute end-0 top-0 p-4 opacity-10">
                            <span class="material-symbols-rounded" style="font-size: 151px;">celebration</span>
                        </div>
                        
                        <div class="row align-items-center position-relative" style="z-index: 1;">
                            <div class="col-md-9">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; box-shadow: 0 0 20px rgba(16, 147, 53, 0.4);">
                                        <span class="material-symbols-rounded text-white fs-2">task_alt</span>
                                    </div>
                                    <div>
                                        <h2 class="h4 mb-0 fw-bold">Berkas Selesai Diverifikasi!</h2>
                                        <small class="opacity-75">Seluruh dokumen wajib telah berhasil Anda kumpulkan.</small>
                                    </div>
                                </div>
                                <p class="mb-4 pe-md-1">Selamat! Langkah administrasi Anda hampir selesai. Silahkan lakukan pembayaran biaya pendaftaran untuk melanjutkan ke tahap Ujian Saringan Masuk.</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="./pembayaran/" class="btn btn-success px-5 py-2 fw-bold d-flex align-items-center gap-2 shadow-sm" style="border-radius: 14px; background: #109335; border: none;">
                                        <span class="material-symbols-rounded">payments</span>
                                        Klik Disini Untuk Bayar
                                    </a>
                                    <a href="./upload-berkas/" class="btn btn-dark px-4 py-2 fw-bold border border-secondary" style="border-radius: 14px; background: rgba(255,255,255,0.05);">
                                        Review Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Quick Action Cards -->
            <div class="row g-4">
                <div class="col-md-8">
                    <section class="panel h-100">
                        <?php if (!$is_biodata_complete): ?>
                        <!-- Quick Action: Biodata Missing -->
                        <div class="p-3 mb-4 rounded-4 border-start border-4 border-warning bg-warning-subtle d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <span class="material-symbols-rounded">person_edit</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Biodata Belum Lengkap</h6>
                                    <small class="text-muted">Silahkan isi data diri Anda untuk melanjutkan.</small>
                                </div>
                            </div>
                            <a href="./profil/" class="btn btn-warning btn-sm fw-bold px-3">Isi Sekarang</a>
                        </div>
                        <?php else: ?>
                        <!-- Biodata Summary -->
                        <div class="p-3 mb-4 rounded-4 border border-light-subtle bg-light d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <span class="material-symbols-rounded">account_circle</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($user_data['nama_mhs']); ?></h6>
                                    <small class="text-muted"><?php echo htmlspecialchars($user_data['jurusan']); ?> • NIK: <?php echo htmlspecialchars($user_data['nik']); ?></small>
                                </div>
                            </div>
                            <a href="./profil/" class="btn btn-outline-primary btn-sm px-3">Update</a>
                        </div>
                        <?php endif; ?>

                        <div class="panel-header">
                            <h3>Upload Dokumen Penting</h3>
                            <a href="./upload-berkas" class="btn-text">Lihat Data</a>
                        </div>
                        <div class="table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>Dokumen</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($documents as $doc): 
                                        $isExist = !empty($berkas[$doc['field']]);
                                        $isOptional = !empty($doc['optional']);
                                        if ($isExist) {
                                            $statusText = "Dikumpulkan";
                                            $statusClass = "success";
                                        } else {
                                            $statusText = $isOptional ? "Opsional" : "Belum Lengkap";
                                            $statusClass = $isOptional ? "secondary" : "pending";
                                        }
                                        $labelDisplay = $doc['label'];
                                        if ($isOptional) {
                                            $labelDisplay .= ' <span class="badge bg-light text-secondary border ms-2">Opsional</span>';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $labelDisplay; ?></td>
                                        <td><span class="status-pills <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                                        <td>
                                            <?php if ($isExist): ?>
                                                <a href="./upload-berkas/"> <span class="material-symbols-rounded text-muted">pending</span></a>
                                            <?php else: ?>
                                                <a href="./upload-berkas/" class="btn-text">Upload</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel h-100 bg-dark text-white" style="background: linear-gradient(135deg, var(--primary-main), var(--primary-dark)) !important;">
                        <h3>Informasi Ujian Saringan Masuk</h3>
                        <p class="opacity-75 small">Ujian akan dilaksanakan secara daring melalui portal ini setelah seluruh berkas divalidasi.</p>
                        
                        <div class="mt-4 p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-25">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="material-symbols-rounded fs-5" >calendar_month</span>
                                <small >Estimasi Jadwal</small>
                            </div>
                            <strong class="d-block" style="font-family: signika;">Akan Diumumkan</strong>
                        </div>

                        <button class="btn btn-light w-100 mt-4 fw-bold py-2 rounded-3 border-0" style="font-size: 15px; color: var(--bs-gray-500); font-family: signika; font-weight: 200;" disabled>
                            Mohon Ditunggu Untuk Mulai Ujian
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <style>
        .pmb-steps .step-circle {
            width: 32px;
            height: 32px;
            background: #e2e8f0;
            color: #64748b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-weight: bold;
            font-size: 14px;
            border: 2px solid white;
            box-shadow: 0 0 0 1px #e2e8f0;
        }
        .pmb-steps .step-circle.active {
            background: var(--primary-main);
            color: white;
            box-shadow: 0 0 0 1px var(--primary-main);
        }
        .pmb-steps .step-circle.current {
            background: var(--bs-warning);
            color: white;
            box-shadow: 0 0 0 4px rgba(16, 147, 53, 0.2);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
