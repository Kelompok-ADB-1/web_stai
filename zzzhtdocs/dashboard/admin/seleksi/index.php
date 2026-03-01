<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") { header("Location: ../../../masuk/"); exit; }
$pageTitle = "Kelola Seleksi PMB";
$userEmail = $_SESSION["email"] ?? "Admin";
$userRole = ucfirst($_SESSION["role"] ?? "Super Admin");

$nama_mhs_session = $_SESSION["nama_mhs"] ?? "";
$displayName = !empty($nama_mhs_session) ? $nama_mhs_session : $userEmail;
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
            <h1>Kelola Seleksi PMB</h1>
            <p>Update status kelulusan, nilai ujian, dan catatan seleksi calon mahasiswa.</p>
        </section>

        <section class="panel">
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jurusan</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="seleksiTable">
                        <tr>
                            <td colspan="6" class="text-center text-muted">Loading data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Modal Edit Seleksi -->
    <div class="modal fade" id="editSeleksiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-success text-white px-4 py-3">
                    <h5 class="modal-title d-flex align-items-center">
                        <span class="material-symbols-rounded me-2">edit_note</span>
                        Edit Status Seleksi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdateSeleksi">
                    <div class="modal-body p-4">
                        <input type="hidden" id="edit_user_id" name="user_id">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Mahasiswa</label>
                            <input type="text" class="form-control bg-light text-muted" id="display_nama" disabled style="user-select: none; pointer-events: none;">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nilai Ujian</label>
                                <input type="number" step="0.01" class="form-control" name="nilai_ujian" id="edit_nilai" placeholder="0.00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status Mahasiswa</label>
                                <select class="form-select" name="status_mahasiswa" id="edit_status">
                                    <option value="">Belum Ditentukan</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="tidak diterima">Tidak Diterima</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">Catatan</label>
                            <textarea class="form-control" name="catatan" id="edit_catatan" rows="3" placeholder="Tambahkan catatan jika perlu..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light px-4 py-3">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Success/Error Notification -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-body p-4 text-center">
                    <div id="notif_icon_container" class="mb-3">
                        <span id="notif_icon" class="material-symbols-rounded" style="font-size: 60px;">check_circle</span>
                    </div>
                    <h5 id="notif_title" class="fw-bold">Berhasil!</h5>
                    <p id="notif_message" class="text-muted mb-0">Data telah diperbarui.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchData();
        });

        function fetchData() {
            fetch('../data-akun/getdata/index.php')
                .then(res => res.json())
                .then(data => {
                    const table = document.getElementById('seleksiTable');
                    table.innerHTML = '';

                    if (data.length === 0) {
                        table.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Belum ada data user.</td></tr>';
                        return;
                    }

                    data.forEach(user => {
                        const statusClass = getStatusClass(user.status_mahasiswa);
                        const isAdmin = user.role === 'admin';
                        const adminBadge = isAdmin ? `<span class="badge bg-primary ms-2" style="font-size: 0.65rem;">ADMIN</span>` : '';
                        
                        table.innerHTML += `
                            <tr class="${isAdmin ? 'bg-light' : ''}">
                                <td>${user.id}</td>
                                <td>
                                    <div class="fw-bold d-flex align-items-center">
                                        ${user.nama_mhs || 'NULL'} 
                                        ${adminBadge}
                                    </div>
                                    <small class="text-muted">${user.email}</small>
                                </td>
                                <td>${user.jurusan || '-'}</td>
                                <td class="text-center fw-bold">${user.nilai_ujian || 'NULL'}</td>
                                <td class="text-center">
                                    <span class="status-pills ${statusClass} small">
                                         ${user.status_mahasiswa
                                            ? user.status_mahasiswa.charAt(0).toUpperCase() + user.status_mahasiswa.slice(1)
                                            : 'Belum Ditentukan'}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-outline-success btn-sm d-inline-flex align-items-center" onclick="openEditModal(${user.id})">
                                        <span class="material-symbols-rounded fs-6 me-1">edit</span> Update
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    // Store data globally for modal access
                    window.userSeleksiData = data;
                });
        }

        function getStatusClass(status) {
            if (!status) return 'pending';
            const s = status.toLowerCase().trim();
            switch(s) {
                case 'diterima': 
                case 'lulus':
                    return 'success';
                case 'tidak diterima':
                case 'tidak lulus':
                    return 'danger';
                case 'pending':
                case 'cadangan':
                case 'proses':
                    return 'pending';
                default: 
                    return 'pending';
            }
        }

        function openEditModal(userId) {
            const user = window.userSeleksiData.find(u => u.id == userId);
            if (!user) return;

            document.getElementById('edit_user_id').value = user.id;
            document.getElementById('display_nama').value = user.nama_mhs || user.email;
            document.getElementById('edit_nilai').value = user.nilai_ujian || '';
            document.getElementById('edit_status').value = user.status_mahasiswa || '';
            document.getElementById('edit_catatan').value = user.catatan || '';

            const modal = new bootstrap.Modal(document.getElementById('editSeleksiModal'));
            modal.show();
        }

        document.getElementById('formUpdateSeleksi').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('update_userseleksi.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                const modalEl = document.getElementById('editSeleksiModal');
                const editModal = bootstrap.Modal.getInstance(modalEl);
                editModal.hide();

                const notifModalEl = document.getElementById('notificationModal');
                const notifModal = new bootstrap.Modal(notifModalEl);
                const titleEl = document.getElementById('notif_title');
                const msgEl = document.getElementById('notif_message');
                const iconEl = document.getElementById('notif_icon');
                const iconContainer = document.getElementById('notif_icon_container');

                if (res.status === 'success') {
                    titleEl.innerText = 'Berhasil!';
                    msgEl.innerText = 'Data seleksi telah diperbarui.';
                    iconEl.innerText = 'check_circle';
                    iconContainer.className = 'mb-3 text-success';
                } else {
                    titleEl.innerText = 'Gagal!';
                    msgEl.innerText = res.message || 'Terjadi kesalahan saat menyimpan data.';
                    iconEl.innerText = 'error';
                    iconContainer.className = 'mb-3 text-danger';
                }

                notifModal.show();
                fetchData();

                // Auto hide after 2 seconds
                setTimeout(() => {
                    notifModal.hide();
                }, 2000);
            })
            .catch(err => {
                console.error(err);
                const notifModalEl = document.getElementById('notificationModal');
                const notifModal = new bootstrap.Modal(notifModalEl);
                document.getElementById('notif_title').innerText = 'Kesalahan';
                document.getElementById('notif_message').innerText = 'Gagal menghubungi server.';
                document.getElementById('notif_icon').innerText = 'cloud_off';
                document.getElementById('notif_icon_container').className = 'mb-3 text-danger';
                notifModal.show();
            });
        });
    </script>

</body>
</html>
