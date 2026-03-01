<?php
session_start();

// Security Gatekeeper
if (!isset($_SESSION["role"])) {
    header("Location: ../../masuk/");
    exit;
}

$pageTitle = "Hasil Seleksi";
$userEmail = $_SESSION["email"] ?? "User";
$userRole = ucfirst($_SESSION["role"] ?? "Calon Mahasiswa");
$currentDate = date("l, d F Y");

$nama_mhs = $_SESSION["nama_mhs"] ?? "";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css"> 
    <link rel="stylesheet" href="../dashboard.css">
    
    <!-- Material Symbols Sheet (Consolidated) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />



</head>
<body>

    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../navbar-dashboard.php'; ?>

        <div class="dashboard-container">
            <section class="welcome-section">
                <h1>Hasil Seleksi PMB</h1>
                <p>Pengumuman kelulusan dan tahap selanjutnya.</p>
            </section>
            
            <div id="hasilContent">
                <section class="panel text-center py-5">
                    <div class="spinner-border text-success mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h3>Memuat Hasil Seleksi...</h3>
                </section>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const currentUserId = <?= json_encode($_SESSION["id"]) ?>;

        document.addEventListener('DOMContentLoaded', function() {
            fetch('../admin/data-akun/getdata/index.php')
                .then(res => res.json())
                .then(data => {
                    const user = data.find(u => u.id == currentUserId);
                    const container = document.getElementById('hasilContent');

                    if (!user || !user.status_mahasiswa || user.status_mahasiswa === 'pending' || user.status_mahasiswa === 'Belum Ditentukan') {
                        container.innerHTML = `
                            <section class="panel text-center py-5">
                                <div class="mb-3">
                                    <span class="material-symbols-rounded text-muted" style="font-size: 80px;">hourglass_empty</span>
                                </div>
                                <h3>Hasil Belum Tersedia</h3>
                                <p class="text-muted">Mohon tunggu hingga seluruh proses verifikasi berkas dan ujian selesai dilaksanakan.</p>
                            </section>
                        `;
                        return;
                    }

                    let statusTitle = '';
                    let statusColor = '';
                    let statusIcon = '';
                    let extraMessage = '';

                    if (user.status_mahasiswa === 'diterima') {
                        statusTitle = 'Selamat! Anda Dinyatakan Diterima';
                        statusColor = 'success';
                        statusIcon = 'check_circle';
                        extraMessage = `Anda dinyatakan diterima pada program studi <strong>${user.jurusan || '-'}</strong>. <br>Selamat bergabung di STAI Sabilu Salam Bandung! Silahkan cek menu pembayaran untuk proses her-registrasi.`;
                    } else if (user.status_mahasiswa === 'tidak diterima') {
                        statusTitle = 'Mohon Maaf, Anda Belum Diterima';
                        statusColor = 'danger';
                        statusIcon = 'error';
                        extraMessage = `Anda belum berhasil diterima pada program studi <strong>${user.jurusan || '-'}</strong>. <br>Jangan berkecil hati, tetap semangat dan coba lagi di kesempatan berikutnya.`;
                    }

                    container.innerHTML = `
                        <section class="panel text-center py-5 border-top border-4 border-${statusColor} rounded-top shadow-sm">
                            <div class="mb-3">
                                <span class="material-symbols-rounded text-${statusColor}" style="font-size: 80px;">${statusIcon}</span>
                            </div>
                            <h2 class="text-${statusColor} fw-bold mb-3">${statusTitle}</h2>
                            <div class="row justify-content-center mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-4 shadow-sm">
                                        <div class="mb-2">
                                            <span class="text-muted small d-block">Nilai Ujian Anda</span>
                                            <strong class="fs-3 text-dark">${user.nilai_ujian || '0.00'}</strong>
                                        </div>
                                        <div class="border-top pt-2">
                                            <span class="text-muted small d-block">Catatan Kampus:</span>
                                            <p class="mb-0 italic">"${user.catatan || 'Tidak ada catatan.'}"</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="lead px-3">${extraMessage}</p>
                            <hr class="w-25 mx-auto">
                            <div class="mt-4">
                                ${user.status_mahasiswa === 'diterima' ? `
                                    <a href="../pembayaran/" class="btn btn-success px-4 py-2 ms-2">
                                        <span class="material-symbols-rounded fs-5 align-middle">payments</span> Bayar Registrasi
                                    </a>
                                ` : ''}
                            </div>
                        </section>
                    `;
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('hasilContent').innerHTML = `
                        <div class="alert alert-danger">Gagal mengambil data seleksi. Silahkan coba lagi nanti.</div>
                    `;
                });
        });
    </script>
</body>
</html>
