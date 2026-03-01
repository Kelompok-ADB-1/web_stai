<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") { header("Location: ../../../masuk/"); exit; }
$pageTitle = "Settings";
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
            <section class="welcome-section">
                <h1>Pengaturan Sistem</h1>
                <p>Konfigurasi parameter aplikasi, API, dan keamanan sistem.</p>
            </section>

            <!-- JSON Preview Section -->
            <section class="panel">
                <div class="panel-header mb-3">
                    <h3>Get Data Website JSON Preview</h3>
                    <p class="text-muted small">Pilih sumber data untuk melihat output JSON mentah dari sistem.</p>
                </div>
                
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <button class="btn btn-outline-success btn-sm px-3" onclick="fetchPreview('../data-akun/getdata/index.php')">
                        Data Semua Akun
                    </button>
                    <button class="btn btn-outline-success btn-sm px-3" onclick="fetchPreview('../../upload-berkas/getdata/index.php')">
                        Data Berkas Mahasiswa
                    </button>
                    <button class="btn btn-outline-success btn-sm px-3" onclick="fetchPreview('../../pembayaran/getdata/index.php')">
                        Data Pembayaran
                    </button>
                    <button class="btn btn-outline-success btn-sm px-3" onclick="fetchPreview('../../../getdata-all/index.php')">
                        Global GetData-All
                    </button>
                    <button class="btn btn-outline-success btn-sm px-3" onclick="fetchPreview('../../../getdata-all/check_db/index.php')">
                        Global Check-All Datababse
                    </button>
                    <a href="../../upload-berkas/getdata/testview/index.php" 
                    class="btn btn-outline-warning btn-sm px-3" target="_blank">
                        Test View Data Berkas
                    </a>

                    <button class="btn btn-warning btn-sm px-3" onclick="runInitDB()">
                        Reset Aman Database Setup
                    </button>

                </div>

                <div id="previewContainer" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted" id="previewUrl">URL: ...</small>
                        <button class="btn btn-link btn-sm text-decoration-none" onclick="copyJson()">Copy JSON</button>
                    </div>
                    <pre id="jsonOutput" class="p-3 bg-dark text-success rounded-3 small border" style="max-height: 500px; overflow-y: auto; font-family: 'Courier New', monospace;"></pre>
                </div>

                <div id="loadingSpinner" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </section>

            <!-- Placeholder for other settings -->
            <section class="panel mt-4">
                 <div class="panel-header mb-0"><h3>Informasi Server</h3></div>
                 <div class="table-responsive">
                     <table class="table table-sm mt-3">
                         <tr><td class="text-muted" width="30%">PHP Version</td><td><?php echo phpversion(); ?></td></tr>
                         <tr><td class="text-muted">Database</td><td>MySQL (stai_pmb)</td></tr>
                         <tr><td class="text-muted">Session ID</td><td><code class="small"><?php echo session_id(); ?></code></td></tr>
                     </table>
                 </div>
            </section>
        </div>
    </main>

    <script>
        function fetchPreview(url) {
            const container = document.getElementById('previewContainer');
            const output = document.getElementById('jsonOutput');
            const spinner = document.getElementById('loadingSpinner');
            const urlText = document.getElementById('previewUrl');

            container.style.display = 'none';
            spinner.style.display = 'block';
            urlText.innerText = 'Fetching: ' + url;

            fetch(url)
                .then(res => {
                    if (!res.ok) throw new Error('HTTP error! status: ' + res.status);
                    return res.json();
                })
                .then(data => {
                    spinner.style.display = 'none';
                    container.style.display = 'block';
                    output.innerText = JSON.stringify(data, null, 4);
                })
                .catch(err => {
                    spinner.style.display = 'none';
                    container.style.display = 'block';
                    output.className = 'p-3 bg-dark text-danger rounded-3 small border';
                    output.innerText = 'Error loading data: ' + err.message + '\n\nMake sure the endpoint is accessible and returning valid JSON.';
                    console.error('Fetch error:', err);
                });
        }

        function copyJson() {
            const text = document.getElementById('jsonOutput').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('JSON copied to clipboard!');
            });
        }

        function runInitDB() {
            if(!confirm("Anda yakin ingin menjalankan Reset Database Setup?")) return;
            
            const container = document.getElementById('previewContainer');
            const output = document.getElementById('jsonOutput');
            const spinner = document.getElementById('loadingSpinner');
            const urlText = document.getElementById('previewUrl');

            container.style.display = 'none';
            spinner.style.display = 'block';
            urlText.innerText = 'POST: ../../../init_db.php';

            fetch('../../../init_db.php', { method: 'POST' })
                .then(res => {
                    if (!res.ok) throw new Error('HTTP error! status: ' + res.status);
                    return res.text();
                })
                .then(data => {
                    spinner.style.display = 'none';
                    container.style.display = 'block';
                    output.className = 'p-3 bg-dark text-warning rounded-3 small border';
                    output.innerText = data;
                })
                .catch(err => {
                    spinner.style.display = 'none';
                    container.style.display = 'block';
                    output.className = 'p-3 bg-dark text-danger rounded-3 small border';
                    output.innerText = 'Error running init_db: ' + err.message;
                    console.error('Fetch error:', err);
                });
        }
    </script>

</body>
</html>
