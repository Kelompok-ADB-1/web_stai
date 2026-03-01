<?php
session_start();

// Security Gatekeeper
if (!isset($_SESSION["role"])) {
    header("Location: ../../masuk/");
    exit;
}

$pageTitle = "Pembayaran";
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

    
    <!-- Material Symbols (Consolidated) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .btn-payment {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none !important;
            border-radius: 12px !important;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn-payment:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }

        .btn-payment:active {
            transform: translateY(-1px);
        }

        /* Bayar Sekarang State */
        .btn-payment-primary {
            background: var(--primary-main) !important;
            color: white !important;
        }

        .btn-payment-primary:hover {
            background: var(--primary-dark) !important;
            color: white !important;
        }

        /* Dalam Verifikasi State */

        .btn-payment-info {
            background: var(--primary-main) !important;
            color: white !important;
        }

        .btn-payment-info:hover {
            background: var(--primary-dark) !important;
            color: white !important;
        }

        /* Upload Ulang State */
        .btn-payment-warning {
            background: #f59e0b !important;
            color: white !important;
        }

        /* Disabled / Paid State */
        .btn-payment-success {
            background: #10b981 !important;
            color: white !important;
            opacity: 0.8;
            cursor: default;
        }
        
        .btn-payment-success:hover {
            transform: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body>

    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../navbar-dashboard.php'; ?>

        <div class="dashboard-container">
            <section class="welcome-section">
                <h1>Informasi Pembayaran</h1>
                <p>Status tagihan dan riwayat transaksi anda.</p>
            </section>

            <div class="row g-4">
                <!-- Tagihan Summary -->
                <div class="col-lg-8">
                    <section class="panel mb-4">
                        <div class="panel-header">
                            <h3>Tagihan Aktif</h3>
                            <span id="paymentStatusBadge" class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">Menunggu Pembayaran</span>
                        </div>
                        
                        <div class="p-4 rounded-4 border border-light-subtle bg-light mb-0">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">Item Pembayaran</small>
                                        <h4 class="fw-bold mb-1">Biaya Pendaftaran PMB 2026</h4>
                                        <p class="text-muted small mb-0">Biaya administrasi dan seleksi calon mahasiswa baru.</p>
                                    </div>

                                </div>
                                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                    <div class="mb-4">
                                        <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">Total Tagihan</small>
                                        <h2 class="fw-bold text-success mb-0">Rp 250.000</h2>
                                    </div>
                                    <button id="btnBayarSekarang" class="btn btn-primary btn-payment px-5 py-2 ms-md-auto" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                        <span class="material-symbols-rounded">payments</span>
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-header">
                            <h3>Riwayat Transaksi</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionHistory">
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <div class="spinner-border spinner-border-sm text-primary mb-2" role="status"></div>
                                            <p class="mb-0 small">Memasukan data...</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- Sidebar Info -->
                <div class="col-lg-4">
                    <section class="panel mb-4">
                        <div class="panel-header">
                            <h3>Metode Pembayaran</h3>
                        </div>
                        <div class="vstack gap-3 mt-2">
                            <!-- BSI -->
                            <div class="p-3 border rounded-4 bg-white shadow-sm overflow-hidden position-relative">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <span class="material-symbols-rounded">account_balance</span>
                                    </div>
                                    <div>
                                        <strong class="d-block">Bank Syariah Indonesia</strong>
                                        <small class="text-muted" style="font-size: 11px;">(BSI) Transfer Manual</small>
                                    </div>
                                </div>
                                <div class="bg-light p-2 rounded-3 border border-light-subtle">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="text-muted">No. Rekening:</small>
                                        <small class="fw-bold">7123456789</small>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">Atas Nama:</small>
                                        <small class="fw-bold text-uppercase">STAI Sabilu Salam</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Mandiri -->
                            <div class="p-3 border rounded-4 bg-white shadow-sm overflow-hidden position-relative">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <span class="material-symbols-rounded">account_balance</span>
                                    </div>
                                    <div>
                                        <strong class="d-block">Bank Mandiri</strong>
                                        <small class="text-muted" style="font-size: 11px;">Transfer Manual</small>
                                    </div>
                                </div>
                                <div class="bg-light p-2 rounded-3 border border-light-subtle">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="text-muted">No. Rekening:</small>
                                        <small class="fw-bold">1310001234567</small>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">Atas Nama:</small>
                                        <small class="fw-bold text-uppercase">STAI Sabilu Salam</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="panel bg-light border-0">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-warning">info</span>
                            <h5 class="mb-0 fw-bold">Bantuan</h5>
                        </div>
                        <p class="small text-muted mb-3">Jika anda mengalami kendala saat melakukan pembayaran, silakan hubungi bagian keuangan kami.</p>
                        <a href="https://wa.me/" target="_blank" class="btn btn-outline-dark btn-sm w-100 py-2 fw-bold" style="border-radius: 10px;">
                            Chat WhatsApp
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Upload Bukti -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Upload Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4">Silahkan unggah foto atau screenshot bukti transfer Anda untuk diverifikasi oleh admin.</p>
                    
                    <div class="upload-area p-4 border-2 border-dashed rounded-4 text-center mb-3" id="dropZone" style="border: 2px dashed #e2e8f0; background: #f8fafc; cursor: pointer;">
                        <input type="file" id="paymentProof" class="d-none" accept="image/*">
                        <div id="previewContainer" class="d-none mb-3">
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                        </div>
                        <div id="uploadPlaceholder">
                            <span class="material-symbols-rounded fs-1 text-muted mb-2">upload_file</span>
                            <p class="mb-0 fw-bold small">Klik atau Tarik Foto Disini</p>
                            <small class="text-muted" style="font-size: 11px;">PNG, JPG, JPEG (Max. 2MB)</small>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary w-100 py-3 fw-bold shadow-sm" id="btnConfirmUpload" style="background: var(--primary-main); border: none; border-radius: 14px;" disabled>
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 24px;">
                <div class="modal-body p-5">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 64px; height: 64px; box-shadow: 0 0 20px rgba(16, 147, 53, 0.3);">
                        <span class="material-symbols-rounded fs-1">check</span>
                    </div>
                    <h4 class="fw-bold mb-2">Upload Berhasil!</h4>
                    <p class="text-muted small mb-4">Bukti pembayaran Anda telah diterima dan akan segera divalidasi oleh sistem.</p>
                    <button type="button" class="btn btn-dark w-100 py-2 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cancel -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 24px;">
                <div class="modal-body p-5">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 64px; height: 64px;">
                        <span class="material-symbols-rounded fs-1">history</span>
                    </div>
                    <h4 class="fw-bold mb-2">Batalkan Bukti?</h4>
                    <p class="text-muted small mb-4">Ingin menarik kembali bukti pembayaran ini? Anda harus mengupload ulang nanti.</p>
                    <div class="vstack gap-2">
                        <button type="button" id="btnConfirmCancel" class="btn btn-danger w-100 py-2 fw-bold" style="border-radius: 12px;">Ya, Tarik Kembali</button>
                        <button type="button" class="btn btn-light w-100 py-2 fw-bold text-muted" data-bs-dismiss="modal" style="border-radius: 12px;">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        // Fetch Payment Status
        const userId = <?php echo $_SESSION['id']; ?>;
        const historyTbody = document.getElementById('transactionHistory');
        const statusBadge = document.getElementById('paymentStatusBadge');
        const btnBayar = document.getElementById('btnBayarSekarang');

        function loadPaymentData() {
            fetch('./getdata/index.php')
                .then(res => res.json())
                .then(data => {
                    // Filter for current user and pendaftaran type
                    const myPayment = data.data.find(p => p.id == userId && (p.transaksi_id == 'pendaftaran' || !p.transaksi_id));
                    historyTbody.innerHTML = '';

                    if (!myPayment || !myPayment.bukti_bayar) {
                        statusBadge.className = 'badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill';
                        statusBadge.innerText = 'Menunggu Pembayaran';
                        btnBayar.disabled = false;
                        btnBayar.innerText = 'Bayar Sekarang';
                        btnBayar.className = 'btn btn-payment btn-payment-primary px-5 py-2 ms-md-auto';
                        btnBayar.setAttribute('data-bs-target', '#uploadModal');
                        
                        historyTbody.innerHTML = `
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <span class="material-symbols-rounded fs-1 d-block mb-2 opacity-25">payments</span>
                                    Belum ada transaksi. Silahkan lakukan pembayaran.
                                </td>
                            </tr>
                        `;
                    } else {
                        // Update Status Badge based on DB status
                        let badgeClass = 'bg-secondary-subtle text-secondary border-secondary-subtle';
                        let statusText = myPayment.status ? myPayment.status.toUpperCase() : 'MENUNGGU';

                        btnBayar.className = 'btn btn-payment px-5 py-2 ms-md-auto'; // Reset classes
                        btnBayar.onclick = null; // Clear view handler
                        btnBayar.setAttribute('data-bs-toggle', 'modal'); // Re-enable modals

                        if (myPayment.status === 'verifikasi' || myPayment.status === 'menunggu') {
                            badgeClass = 'bg-info-subtle text-info border-info-subtle';
                            statusText = 'Verifikasi';
                            btnBayar.disabled = false; 
                            btnBayar.innerHTML = '<span class="material-symbols-rounded">history</span> Dalam Verifikasi';
                            btnBayar.classList.add('btn-payment-info');
                            btnBayar.setAttribute('data-bs-target', '#cancelModal');
                        } else if (myPayment.status === 'berhasil') {
                            badgeClass = 'bg-success-subtle text-success border-success-subtle';
                            statusText = 'Lunas';
                            btnBayar.disabled = false;
                            btnBayar.innerHTML = '<span class="material-symbols-rounded">visibility</span>Lihat Bukti Lunas';
                            btnBayar.classList.add('btn-payment-success');
                            btnBayar.removeAttribute('data-bs-target');
                            btnBayar.removeAttribute('data-bs-toggle');
                            btnBayar.style.cursor = 'pointer';
                            btnBayar.onclick = () => window.open('./getdata/uploads_pembayaran/' + myPayment.bukti_bayar, '_blank');
                        } else if (myPayment.status === 'ditolak') {
                            badgeClass = 'bg-danger-subtle text-danger border-danger-subtle';
                            statusText = 'Ditolak';
                            btnBayar.disabled = false;
                            btnBayar.innerHTML = '<span class="material-symbols-rounded">upload</span> Upload Ulang';
                            btnBayar.classList.add('btn-payment-warning');
                            btnBayar.setAttribute('data-bs-target', '#uploadModal');
                        }

                        statusBadge.className = `badge ${badgeClass} border px-3 py-2 rounded-pill`;
                        statusBadge.innerText = statusText;

                        // Add to history
                        const dateStr = myPayment.tanggal_upload ? myPayment.tanggal_upload : new Date().toISOString();
                        const date = new Date(dateStr).toLocaleDateString('id-ID', {
                            day: 'numeric', month: 'short', year: 'numeric'
                        }); 

                        const infoNote = myPayment.keterangan ? `<div class="mt-1 opacity-75" style="font-size: 10px; max-width: 150px; line-height: 1.2;"><b>Note:</b> ${myPayment.keterangan}</div>` : '';

                        historyTbody.innerHTML = `
                            <tr>
                                <td><code class="text-primary fw-bold">${myPayment.transaksi_id}</code></td>
                                <td>${date}</td>
                                <td>Biaya Pendaftaran</td>
                                <td>Rp ${parseInt(myPayment.nominal || 250000).toLocaleString()}</td>
                                <td>
                                    <span class="status-pills ${myPayment.status === 'berhasil' ? 'success' : (myPayment.status === 'ditolak' ? 'bg-danger-subtle text-danger border-danger-subtle' : 'pending')}">${statusText}</span>
                                    ${infoNote}
                                </td>
                            </tr>
                        `;
                    }
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    historyTbody.innerHTML = '<tr><td colspan="5" class="text-center py-5 text-danger">Gagal memuat data. Pastikan database sudah siap.</td></tr>';
                });
        }

        loadPaymentData();

        // Modal Logic
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('paymentProof');
        const btnConfirm = document.getElementById('btnConfirmUpload');
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');

        dropZone.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                    uploadPlaceholder.classList.add('d-none');
                    btnConfirm.disabled = false;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        btnConfirm.addEventListener('click', function() {
            const formData = new FormData();
            formData.append('bukti_bayar', fileInput.files[0]);
            formData.append('transaksi_id', 'pendaftaran');

            btnConfirm.disabled = true;
            btnConfirm.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';

            fetch('upload_pembayaran.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const uploadModal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
                    uploadModal.hide();
                    
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    
                    // Reload UI
                    loadPaymentData();

                    // Reset Modal
                    fileInput.value = '';
                    previewContainer.classList.add('d-none');
                    uploadPlaceholder.classList.remove('d-none');
                    btnConfirm.innerText = 'Konfirmasi Pembayaran';
                    btnConfirm.disabled = true;
                } else {
                    alert('Error: ' + data.message);
                    btnConfirm.disabled = false;
                    btnConfirm.innerText = 'Konfirmasi Pembayaran';
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat upload.');
                btnConfirm.disabled = false;
                btnConfirm.innerText = 'Konfirmasi Pembayaran';
            });
        });

        // Cancel Payment Logic
        const btnConfirmCancel = document.getElementById('btnConfirmCancel');
        btnConfirmCancel.addEventListener('click', function() {
            const formData = new FormData();
            formData.append('transaksi_id', 'pendaftaran');

            btnConfirmCancel.disabled = true;
            btnConfirmCancel.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';

            fetch('cancel_pembayaran.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const cancelModal = bootstrap.Modal.getInstance(document.getElementById('cancelModal'));
                    cancelModal.hide();
                    
                    // Reset appearance
                    btnBayar.className = 'btn btn-payment btn-payment-primary px-5 py-2 ms-md-auto';
                    btnBayar.setAttribute('data-bs-target', '#uploadModal');

                    loadPaymentData();
                    
                    btnConfirmCancel.innerText = 'Ya, Tarik Kembali';
                    btnConfirmCancel.disabled = false;
                } else {
                    alert('Error: ' + data.message);
                    btnConfirmCancel.disabled = false;
                    btnConfirmCancel.innerText = 'Ya, Tarik Kembali';
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan.');
                btnConfirmCancel.disabled = false;
                btnConfirmCancel.innerText = 'Ya, Tarik Kembali';
            });
        });


    </script>
</body>
</html>
