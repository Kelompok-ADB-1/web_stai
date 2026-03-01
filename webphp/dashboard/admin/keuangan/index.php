<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") { header("Location: ../../../masuk/"); exit; }
$pageTitle = "Laporan Keuangan";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../style.css"> 
    <link rel="stylesheet" href="../../dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .stat-card {
            border: none;
            border-radius: 20px;
            border: 1px solid #e8eae8;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary-main), var(--primary-light));
            border-radius: 4px 0 0 4px;
            transition: width 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .proof-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .proof-img:hover {
            transform: scale(1.1);
        }
        .status-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>


    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../../navbar-dashboard.php'; ?>

        <div class="dashboard-container">
            <section class="welcome-section">
                <h1>Laporan Keuangan</h1>
                <p>Verifikasi bukti pembayaran pendaftaran mahasiswa baru.</p>
            </section>

            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="stat-card bg-white">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Total Pendapatan</small>
                        <h3 class="fw-bold mb-0 mt-1" id="totalRevenue">Rp 0</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-white">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Menunggu Verifikasi</small>
                        <h3 class="fw-bold mb-0 mt-1 text-warning" id="totalPending">0</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-white">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Pembayaran Lunas</small>
                        <h3 class="fw-bold mb-0 mt-1 text-success" id="totalSuccess">0</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-white">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Ditolak</small>
                        <h3 class="fw-bold mb-0 mt-1 text-danger" id="totalRejected">0</h3>
                    </div>
                </div>
            </div>

            <section class="panel">
                <div class="panel-header d-flex justify-content-between align-items-center">
                    <h3>Daftar Pembayaran</h3>
                    <button class="btn btn-light btn-sm d-flex align-items-center gap-2" onclick="loadData()">
                        <span class="material-symbols-rounded fs-6">refresh</span> Refresh
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Mahasiswa</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="paymentTableBody">
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <!-- Modal View Proof -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <img id="modalFullImg" src="" alt="Bukti" class="img-fluid rounded-4 shadow-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reject -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-3">Tolak Pembayaran?</h5>
                    <textarea class="form-control mb-3" id="rejectReason" placeholder="Alasan penolakan (opsional)..." rows="3"></textarea>
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger w-100 py-2 fw-bold" id="confirmRejectBtn" style="border-radius: 12px;">Ya, Tolak</button>
                        <button class="btn btn-light w-100 py-2 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentActionId = null;
        let currentActionTransaksiType = null;

        function loadData() {
            fetch('../../pembayaran/getdata/index.php')
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        const data = res.data;
                        renderTable(data);
                        updateStats(data);
                    }
                });
        }

        function updateStats(data) {
            let revenue = 0;
            let pending = 0;
            let success = 0;
            let rejected = 0;

            data.forEach(item => {
                if(item.status === 'berhasil') {
                    revenue += parseInt(item.nominal);
                    success++;
                } else if(item.status === 'verifikasi' || item.status === 'menunggu') {
                    pending++;
                } else if(item.status === 'ditolak') {
                    rejected++;
                }
            });

            document.getElementById('totalRevenue').innerText = 'Rp ' + revenue.toLocaleString();
            document.getElementById('totalPending').innerText = pending;
            document.getElementById('totalSuccess').innerText = success;
            document.getElementById('totalRejected').innerText = rejected;
        }

        function renderTable(data) {
            const tbody = document.getElementById('paymentTableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-5 text-muted">Belum ada rincian pembayaran.</td></tr>';
                return;
            }

            data.forEach(item => {
                let statusClass = 'bg-secondary-subtle text-secondary';
                if(item.status === 'verifikasi') statusClass = 'bg-info-subtle text-info';
                if(item.status === 'berhasil') statusClass = 'bg-success-subtle text-success';
                if(item.status === 'ditolak') statusClass = 'bg-danger-subtle text-danger';

                const row = `
                    <tr>
                        <td>
                            <div class="fw-bold">${item.nama_mhs || 'N/A'}</div>
                            <small class="text-muted">${item.email}</small>
                        </td>
                        <td>${item.nama_pembayaran || item.transaksi_id}</td>
                        <td class="fw-bold">Rp ${parseInt(item.nominal).toLocaleString()}</td>
                        <td>
                            ${item.bukti_bayar ? 
                                `<img src="../../pembayaran/getdata/uploads_pembayaran/${item.bukti_bayar}" class="proof-img" onclick="viewImage('../../pembayaran/getdata/uploads_pembayaran/${item.bukti_bayar}')">` : 
                                '<span class="text-muted small">No File</span>'}
                        </td>
                        <td><span class="status-badge ${statusClass}">${item.status || 'menunggu'}</span></td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-success btn-sm px-3" onclick="updateStatus(${item.id}, '${item.transaksi_id}', 'berhasil')" ${item.status === 'berhasil' ? 'disabled' : ''}>
                                    <span class="material-symbols-rounded fs-6">check</span>
                                </button>
                                <button class="btn btn-outline-danger btn-sm px-3" onclick="openRejectModal(${item.id}, '${item.transaksi_id}')" ${item.status === 'ditolak' ? 'disabled' : ''}>
                                    <span class="material-symbols-rounded fs-6">close</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        function viewImage(src) {
            document.getElementById('modalFullImg').src = src;
            new bootstrap.Modal(document.getElementById('viewModal')).show();
        }

        function openRejectModal(id, type) {
            currentActionId = id;
            currentActionTransaksiType = type;
            new bootstrap.Modal(document.getElementById('rejectModal')).show();
        }

        document.getElementById('confirmRejectBtn').onclick = () => {
            const reason = document.getElementById('rejectReason').value;
            updateStatus(currentActionId, currentActionTransaksiType, 'ditolak', reason);
            bootstrap.Modal.getInstance(document.getElementById('rejectModal')).hide();
        };

        function updateStatus(id, type, status, reason = '') {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('transaksi_id', type);
            formData.append('status', status);
            formData.append('keterangan', reason);

            fetch('update_status.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    loadData();
                } else {
                    alert('Gagal update: ' + res.message);
                }
            });
        }

        window.onload = loadData;

    </script>
</body>
</html>
