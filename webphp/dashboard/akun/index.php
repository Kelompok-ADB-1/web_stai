<?php
session_start();
include_once __DIR__ . '/../../masuk/connection.php';

// Security Gatekeeper
if (!isset($_SESSION["role"])) {
    header("Location: ../../masuk/");
    exit;
}

$pageTitle = "Pengaturan Akun";
$user_id = $_SESSION["id"];
$userEmail = $_SESSION["email"] ?? "User";
$userRole = ucfirst($_SESSION["role"] ?? "Calon Mahasiswa");

// Fetch current user email
$sql_user = "SELECT email FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$res_user = $stmt_user->get_result();
$u_data = $res_user->fetch_assoc();
$email = $u_data['email'] ?? $userEmail;

// Get name for display
$sql_profile = "SELECT nama_mhs FROM userdata WHERE id = ?";
$stmt_p = $conn->prepare($sql_profile);
$stmt_p->bind_param("i", $user_id);
$stmt_p->execute();
$res_p = $stmt_p->get_result();
$p_data = $res_p->fetch_assoc();
$displayName = !empty($p_data['nama_mhs']) ? $p_data['nama_mhs'] : $email;

// Password update logic
$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // Verify current password
    $sql_verify = "SELECT password FROM users WHERE id = ?";
    $stmt_v = $conn->prepare($sql_verify);
    $stmt_v->bind_param("i", $user_id);
    $stmt_v->execute();
    $res_v = $stmt_v->get_result();
    $row_v = $res_v->fetch_assoc();

    if ($row_v['password'] === $current_pass) {
        if ($new_pass === $confirm_pass) {
            $sql_upd = "UPDATE users SET password = ? WHERE id = ?";
            $stmt_u = $conn->prepare($sql_upd);
            $stmt_u->bind_param("si", $new_pass, $user_id);
            if ($stmt_u->execute()) {
                $message = "Password berhasil diperbarui!";
                $messageClass = "alert-success";
            } else {
                $message = "Gagal memperbarui password.";
                $messageClass = "alert-danger";
            }
        } else {
            $message = "Konfirmasi password baru tidak cocok.";
            $messageClass = "alert-danger";
        }
    } else {
        $message = "Password saat ini salah.";
        $messageClass = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | STAI Sabilu Salam</title>
    <link rel="icon" type="image/svg+xml" href="../../logo_stai-01.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css"> 
    <link rel="stylesheet" href="../dashboard.css">

 

    <!-- Material Symbols (Consolidated) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <style>
        .settings-card {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../navbar-dashboard.php'; ?>


        <div class="dashboard-container">
            <section class="welcome-section mb-4">
                <h1>Pengaturan Akun</h1>
                <p>Kelola email dan keamanan akun Anda.</p>
            </section>

            <div class="settings-card">
                <section class="panel mb-4">
                    <div class="panel-header">
                        <h3>Informasi Login</h3>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Email Address</label>
                        <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($email); ?>" disabled>
                        <div class="form-text">Email tidak dapat diubah secara mandiri. Hubungi Admin jika ada kesalahan.</div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-header">
                        <h3>Ubah Password</h3>
                    </div>
                    
                    <?php if ($message): ?>
                        <div class="alert <?php echo $messageClass; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required minlength="4">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" class="form-control" required minlength="4">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background: var(--primary-main); border: none; border-radius: 12px;">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
