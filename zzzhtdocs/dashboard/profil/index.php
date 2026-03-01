<?php
session_start();
include_once __DIR__ . '/../../masuk/connection.php';

// Security Gatekeeper: ANY logged-in user can access
if (!isset($_SESSION["role"])) {
    header("Location: ../../masuk/");
    exit;
}

// PMB / Mahasiswa Dashboard - Profile
$pageTitle = "Profil & Biodata";
$user_id = $_SESSION["id"];
$userEmail = $_SESSION["email"] ?? "";
$userRole = ucfirst($_SESSION["role"] ?? "Calon Mahasiswa");
$currentDate = date("l, d F Y");

$message = "";
$messageType = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mhs = $_POST['nama_mhs'] ?? '';
    $jurusan = $_POST['jurusan'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $tanggal_lahir = !empty($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : null;

    // Check if data already exists in userdata
    $checkSql = "SELECT id FROM userdata WHERE id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $user_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Update (removed email)
        $sql = "UPDATE userdata SET nama_mhs = ?, jurusan = ?, nik = ?, alamat = ?, tempat_lahir = ?, tanggal_lahir = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nama_mhs, $jurusan, $nik, $alamat, $tempat_lahir, $tanggal_lahir, $user_id);
    } else {
        // Insert (removed email)
        $sql = "INSERT INTO userdata (id, nama_mhs, jurusan, nik, alamat, tempat_lahir, tanggal_lahir) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $user_id, $nama_mhs, $jurusan, $nik, $alamat, $tempat_lahir, $tanggal_lahir);
    }

    if ($stmt->execute()) {
        $_SESSION["nama_mhs"] = $nama_mhs; // Update session
        $message = "Biodata berhasil disimpan!";
        $messageType = "success";
    } else {
        $message = "Gagal menyimpan biodata: " . $conn->error;
        $messageType = "danger";
    }
}

// Fetch existing data using LEFT JOIN
$sql = "SELECT users.email, userdata.* 
        FROM users 
        LEFT JOIN userdata ON users.id = userdata.id 
        WHERE users.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Fallback values
$nama_mhs = $userData['nama_mhs'] ?? '';
$jurusan = $userData['jurusan'] ?? '';
$email = $userData['email'] ?? $userEmail;
$nik = $userData['nik'] ?? '';
$alamat = $userData['alamat'] ?? '';
$tempat_lahir = $userData['tempat_lahir'] ?? '';
$tanggal_lahir = $userData['tanggal_lahir'] ?? '';

$displayName = !empty($nama_mhs) ? $nama_mhs : $userEmail;
$firstName = explode(' ', trim($displayName))[0];
$firstName = explode('@', $firstName)[0]; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | STAI Sabilu Salam</title>
    
    <link rel="icon" type="image/svg+xml" href="../../logo_stai-01.svg">
    
    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../style.css"> 
    <link rel="stylesheet" href="../dashboard.css">

    <!-- Material Symbols (Consolidated) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    

    <!-- Custom Styling for Muted Inputs -->
    <style>
        .form-control[readonly], 
        .form-select[disabled],
        .form-control:disabled {
            background-color: #f1f5f9;
            color: #64748b; /* Better contrast than 94a3b8 */
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 0.8;
        }
        .form-control::placeholder {
            color: #cbd5e1;
        }
        
    </style>




</head>
<body>


    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../navbar-dashboard.php'; ?>


        <!-- Container -->
        <div class="dashboard-container">
            <section class="welcome-section">
                <h1>Profil & Biodata</h1>
                <p>Lengkapi biodata diri Anda dengan benar.</p>
            </section>

            <!-- Alert Message -->
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-md-12">
                    <section class="panel">
                        <div class="panel-header">
                            <h3>Data Pribadi</h3>
                            <button class="btn-text" type="button" onclick="enableEdit()">Edit Data</button>
                        </div>
                        <form class="row g-3 mt-2" method="POST" id="profileForm">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" value="<?php echo htmlspecialchars($nama_mhs); ?>" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email</label>
                                <input type="email" id="email_display" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Program Studi / Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-select" disabled required>
                                    <option value="" disabled <?php echo empty($jurusan) ? 'selected' : ''; ?>>Pilih Jurusan</option>
                                    <option value="Pendidikan Agama Islam" <?php echo ($jurusan == "Pendidikan Agama Islam") ? 'selected' : ''; ?>>Pendidikan Agama Islam</option>
                                    <option value="Hukum Ekonomi Syariah" <?php echo ($jurusan == "Hukum Ekonomi Syariah") ? 'selected' : ''; ?>>Hukum Ekonomi Syariah</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted d-flex justify-content-between mb-1">
                                    <span>NIK (Nomor Induk Kependudukan)</span>
                                    <span class="text-danger small bg-danger-subtle px-2 rounded-pill d-none align-items-center" id="nikWarning" style="font-size: 10px;">
                                        <span class="material-symbols-rounded" style="font-size: 12px; margin-right: 2px;">error</span> Harus Angka
                                    </span>
                                </label>
                                <input type="text" name="nik" id="nik" class="form-control" value="<?php echo htmlspecialchars($nik); ?>" placeholder="Masukkan 16 digit NIK" readonly required maxlength="16" oninput="validateNIK(this)">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($tempat_lahir); ?>" placeholder="Contoh: Bandung" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($tanggal_lahir); ?>" readonly required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Jl. Raya Sabilu Salam No..." readonly required><?php echo htmlspecialchars($alamat); ?></textarea>
                            </div>
                            <div class="col-12 mt-4 text-end gap-2 d-flex justify-content-end">
                                <button type="button" id="cancelBtn" class="btn btn-outline-secondary px-4" style="display: none;" onclick="disableEdit()">Batal</button>
                                <button type="submit" id="saveBtn" class="btn btn-success px-4" style="background: var(--primary-main); border: none; display: none;">Simpan Biodata</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateNIK(input) {
            const warning = document.getElementById('nikWarning');
            const originalValue = input.value;
            const numericValue = originalValue.replace(/[^0-9]/g, '');
            
            // If user typed letters/symbols, show warning
            if (originalValue !== numericValue) {
                warning.classList.remove('d-none');
                warning.classList.add('d-flex');
                
                // Hide warning after 2.5 seconds
                clearTimeout(window.nikWarningTimer);
                window.nikWarningTimer = setTimeout(() => {
                    warning.classList.add('d-none');
                    warning.classList.remove('d-flex');
                }, 2500);
            }
            
            // Force input to be numbers only
            input.value = numericValue;
        }

        function enableEdit() {
            const inputs = document.querySelectorAll('#profileForm input, #profileForm select, #profileForm textarea');
            inputs.forEach(input => {
                if (input.id !== 'email_display') { 
                    input.removeAttribute('readonly');
                    input.removeAttribute('disabled');
                }
            });
            document.getElementById('saveBtn').style.display = 'inline-block';
            document.getElementById('cancelBtn').style.display = 'inline-block';
            document.querySelector('.btn-text').style.display = 'none';
        }

        function disableEdit() {
            // Simply refresh the page to reset all fields and lock them
            location.reload();
        }
    </script>
</body>
</html>
