<?php
session_start();

// Security Gatekeeper: ONLY Admin can access this page
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../../masuk/");
    exit;
}

// Include database connection
include_once __DIR__ . '/../../masuk/connection.php';

// Simple Dashboard PHP - Stai Sabilu Salam
$pageTitle = "Dashboard Admin";
$userEmail = $_SESSION["email"] ?? "UserAdmin";
$userRole = ucfirst($_SESSION["role"] ?? "admin");
$currentDate = date("l, d F Y");

// Get Name from Session
$nama_mhs = $_SESSION["nama_mhs"] ?? "";
$displayName = !empty($nama_mhs) ? $nama_mhs : $userEmail;
$firstName = explode(' ', trim($displayName))[0];
$firstName = explode('@', $firstName)[0]; 

// Note: All data (stats & table) will be loaded dynamically via JS fetch from ./getdata/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | STAI Sabilu Salam</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Official Administration Dashboard for STAI Sabilu Salam Bandung. Modern and efficient management system.">
    <meta name="author" content="STAI Sabilu Salam">
    
    <link rel="icon" type="image/svg+xml" href="../../logo_stai-01.svg">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../style.css"> <!-- Base styles -->
    <link rel="stylesheet" href="../dashboard.css"> <!-- Dashboard specific -->

    <!-- Material Symbols (Consolidated) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />





</head>
<body>




    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../navbar-dashboard.php'; ?>


        <!-- Container -->
        <div class="dashboard-container">
            <!-- Welcome -->
            <section class="welcome-section">
                <h1>Selamat Datang, <?php echo $firstName; ?>! 👋</h1>
                <p><?php echo $currentDate; ?></p>
            </section>

            <!-- Stats Grid -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <span class="material-symbols-rounded">person_add</span>
                    </div>
                    <div class="stat-info">
                        <span class="value" id="stat-total">...</span>
                        <span class="label">Total Calon Mahasiswa</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <span class="material-symbols-rounded">event_available</span>
                    </div>
                    <div class="stat-info">
                        <span class="value" id="stat-percent">...%</span>
                        <span class="label">Presentasi Proses Pendaftaran</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <span class="material-symbols-rounded">how_to_reg</span>
                    </div>
                    <div class="stat-info">
                        <span class="value" id="stat-new">...</span>
                        <span class="label">Total Pendaftar Akun</span>
                    </div>
                </div>
            </section>

            <!-- Panels -->
            <div class="panels-grid">
                <!-- Recent Activity -->
                <section class="panel">
                    <div class="panel-header">
                        <h3>Pendaftaran Mahasiswa Terbaru</h3>
                        <a href="./data-akun/" class="btn-text">Lihat Data</a>
                    </div>
                    <div class="table-responsive">
                        <table class="custom-table" id="recent-registrations">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="recent-tbody">
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Loading registrations...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Quick Actions / Info -->
                <section class="panel">
                    <div class="panel-header">
                        <h3>Informasi Akademik</h3>
                    </div>
                    <div class="info-list">
                        <div class="info-item mb-3 p-3 rounded" style="background: #f8f9fa; border-left: 4px solid var(--primary-main);">
                            <small class="d-block text-muted">Deadline Pendaftaran Mahasiswa Baru</small>
                            <strong>15 Maret 2026</strong>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Fetch all data from the admin getdata API
        fetch('./data-akun/getdata/')
            .then(res => res.json())
            .then(data => {
                const recentTbody = document.getElementById('recent-tbody');
                const statTotal = document.getElementById('stat-total');
                const statPercent = document.getElementById('stat-percent');
                const statNew = document.getElementById('stat-new');

                recentTbody.innerHTML = '';
                
                // 1. Process data for stats
                const students = data.filter(u => u.role !== 'admin').sort((a,b) => b.id - a.id);
                const totalStudents = students.length;
                const totalAccounts = data.length;
                
                // 2. Calculate "Selesai" (Bio + 5 docs)
                const docFields = ['pas_foto', 'ijazah', 'ktp', 'kk', 'akta'];
                const completedStudents = students.filter(u => {
                    const hasBio = !!u.nama_mhs;
                    let docsCount = 0;
                    docFields.forEach(f => { if(u[f]) docsCount++; });
                    return hasBio && (docsCount === docFields.length);
                });

                const percent = totalStudents > 0 ? Math.round((completedStudents.length / totalStudents) * 100) : 0;

                // 3. Update Stats UI
                statTotal.innerText = totalStudents.toLocaleString();
                statNew.innerText = totalAccounts.toLocaleString(); 
                statPercent.innerText = percent + '%';

                if (totalStudents === 0) {
                    recentTbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">No registrations found</td></tr>';
                    return;
                }

                // 4. Show All Registrations
                students.forEach(user => {
                    const name = user.nama_mhs ? user.nama_mhs : user.email;
                    const jurusan = user.jurusan ? user.jurusan : '<span class="text-muted">Belum Memilih</span>';
                    
                    // Logic: Selesai ONLY if Bio + all 5 Docs are present
                    const hasBio = !!user.nama_mhs;
                    const docFields = ['pas_foto', 'ijazah', 'ktp', 'kk', 'akta'];
                    let docsCount = 0;
                    docFields.forEach(f => { if(user[f]) docsCount++; });
                    const isAllDocsComplete = (docsCount === docFields.length);
                    
                    const isFullyComplete = hasBio && isAllDocsComplete;
                    
                    let statusText = "";
                    let statusClass = "";
                    
                    if (isFullyComplete) {
                        statusText = "Selesai";
                        statusClass = "success";
                    } else if (!hasBio) {
                        statusText = "Biodata Kosong";
                        statusClass = "pending";
                    } else {
                        statusText = "Belum Lengkap";
                        statusClass = "pending";
                    }

                    recentTbody.innerHTML += `
                        <tr>
                            <td>${name}</td>
                            <td>${jurusan}</td>
                            <td>
                                <span class="status-pills ${statusClass}">
                                    ${statusText}
                                </span>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => {
                console.error("Dashboard API Error:", err);
            });
    </script>
    <script>
        // Cards hover effect
        const cards = document.querySelectorAll('.stat-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>

</body>
</html>