<?php
session_start();

// Include database connection
include_once __DIR__ . '/../../../masuk/connection.php';

// Security Gatekeeper: ONLY Admin can access this page
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../../../masuk/");
    exit;
}

$pageTitle = "Kelola Akun";
$userEmail = $_SESSION["email"] ?? "Admin";
$userRole = ucfirst($_SESSION["role"] ?? "Super Admin");
$currentDate = date("l, d F Y");

$nama_mhs_admin = $_SESSION["nama_mhs"] ?? "";
$displayName = !empty($nama_mhs_admin) ? $nama_mhs_admin : $userEmail;

// PHP SQL for progress data removed as per instruction. Data will be fetched via JS.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | STAI Sabilu Salam</title>
    
    <link rel="icon" type="image/svg+xml" href="../../../logo_stai-01.svg">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Signika:wght@300..700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../style.css"> 
    <link rel="stylesheet" href="../../dashboard.css">

    <!-- Bootstrap JS Bundle (In head for reliability) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Material Symbols Sheet (Requested) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>


    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../../navbar-dashboard.php'; ?>


        <div class="dashboard-container">
            <section class="welcome-section">
                <h1>Manajemen Akun Calon Mahasiswa dan Admin</h1>
                <p>Kelola data calon mahasiswa dan verifikasi pendaftaran.</p>
            </section>

            <section class="panel mb-4">
                <div class="panel-header mb-3">
                    <h3 class="mb-0">Detail Progres Pendaftaran Calon Mahasiswa</h3>
                </div>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nama Lengkap</th>
                                <th class="text-center">Status Biodata</th>
                                <th class="text-center">Status Berkas</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody id="progressTable">
                            <tr>
                                <td colspan="6" class="text-center text-muted">Loading progress data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="panel">

                            <!-- Form Tambah -->
                            <div id="formTambah" class="w-100 mb-3" style="display: none;">
                            <div class="row g-2 align-items-center">

                                <!-- Email -->
                                <div class="col">
                                    <div class="input-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="newEmail" 
                                            placeholder="Username"
                                            required>
                                        <span class="input-group-text">@stai.ac.id</span>
                                    </div>
                                </div>

                                <!-- Role -->
                                <div class="col-auto">
                                <select class="form-select" id="newRole">
                                    <option value="calon_mahasiswa">Calon Mahasiswa</option>
                                    <option value="admin">Admin</option>
                                </select>
                                </div>

                                <!-- Buttons -->
                                <div class="col-auto">
                                <button class="btn btn-success btn-sm px-3" onclick="saveNewUser()">
                                    Simpan
                                </button>
                                </div>

                                <div class="col-auto">
                                <button class="btn btn-outline-secondary btn-sm px-3" onclick="closeForm()">
                                    Batal
                                </button>
                                </div>

                            </div>
                            </div>


                            <!-- Panel Header -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0">Daftar Akun Sistem</h3>
                            <button 
                                id="btnTambah" 
                                class="btn btn-outline-success btn-sm px-3">
                                Tambah Akun
                            </button>
                            </div>


                <div class="table-responsive">
                    <table class="custom-table" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr>
                                <th style="width:10%;">ID</th>
                                <th style="width:30%;">Email</th>
                                <th style="width:35%;">Role</th>
                                <th style="width:25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                 Loading data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            
        </div>
    </main>

    <!-- Modal Detail User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header bg-success text-white px-4 py-3">
                    <h5 class="modal-title d-flex align-items-center">
                        <span class="material-symbols-rounded me-2">person</span>
                        Detail Pendaftaran Mahasiswa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="modalContent">
                        <!-- Content injected by JS -->
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>




    <script>

        // Fetch all data from the new admin getdata API
        fetch('getdata/index.php')
            .then(res => res.json())
            .then(data => {
                const dataTable = document.getElementById('dataTable');
                const progressTable = document.getElementById('progressTable');
                
                dataTable.innerHTML = '';
                progressTable.innerHTML = '';

                if (data.length === 0) {
                    const emptyRow = `<tr><td colspan="10" class="text-center text-muted">No data found</td></tr>`;
                    dataTable.innerHTML = emptyRow;
                    progressTable.innerHTML = emptyRow;
                    return;
                }

                // Global stored data for modal access
                window.allUserData = data;

                data.forEach((user, index) => {
                    // ... (dataTable logic remains same)
                    dataTable.innerHTML += `
                        <tr id="row-${user.id}">
                            <td>${user.id}</td>
                            <td class="email">${user.email}</td>
                            <td class="role">
                                ${user.role === 'admin' ? 'Admin' : 
                                  user.role === 'calon_mahasiswa' ? 'Calon Mahasiswa' : 
                                  user.role}
                            </td>
                            <td>
                                <button class="btn btn-outline-success btn-sm px-3" onclick="editUser(${user.id})">Edit</button>
                                <button class="btn btn-outline-danger btn-sm px-3" onclick="deleteUser(${user.id})">Delete</button>
                            </td>
                        </tr>
                    `;

                    // 2. Populate Progress Table (progressTable) - Skip Admins
                    if (user.role !== 'NULL') {
                        const hasBio = !!user.nama_mhs;
                        let filled = 0;
                        const fields = ['pas_foto', 'ijazah', 'ktp', 'kk', 'akta'];
                        fields.forEach(f => { if(user[f]) filled++; });
                        const isCompleteBerkas = (filled === fields.length);

                        // Determine admin-specific styling
                        const rowClass = user.role === 'admin' ? 'table-warning fw-bold' : '';
                        const idLabel = user.role === 'admin' ? `${user.id} <span class="badge bg-primary">ADMIN</span>` : user.id;

                        progressTable.innerHTML += `
                            <tr class="${rowClass}">
                                <td>${idLabel}</td>
                                <td>${user.email}</td>
                                <td>${user.nama_mhs ? user.nama_mhs : '<span class="text-muted italic">Belum Mengisi</span>'}</td>
                                <td class="text-center">
                                    <span class="status-pills ${hasBio ? 'success' : 'pending'} small">
                                        ${hasBio ? 'Lengkap' : 'Kosong'}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="status-pills ${isCompleteBerkas ? 'success' : (filled > 0 ? 'warning' : 'pending')} small">
                                        ${isCompleteBerkas ? 'Lengkap' : (filled > 0 ? filled + '/5' : 'Kosong')}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm p-1 rounded-circle d-inline-flex align-items-center shadow-sm" onclick="viewDetails('${user.id}')">
                                        <span class="material-symbols-rounded fs-6">expand_content</span>
                                    </button>
                                </td>
                            </tr>
                        `;
                    }
                });

            })
            .catch(err => {
                const errorRow = `<tr><td colspan="10" class="text-center text-danger">Failed to load data from API</td></tr>`;
                document.getElementById('dataTable').innerHTML = errorRow;
                document.getElementById('progressTable').innerHTML = errorRow;
                console.error(err);
            });


            function editUser(id) {
                const row = document.getElementById("row-" + id);

                const email = row.querySelector(".email").innerText;
                const role = row.querySelector(".role").innerText;

                row.innerHTML = `
                    <td>${id}</td>
                    <td><input class="form-control" type="text" id="email-${id}" value="${email}"></td>
                    <td>
                        <select class="form-select" id="role-${id}">
                            <option value="admin" ${role === 'admin' ? 'selected' : ''}>Admin</option>
                            <option value="calon_mahasiswa" ${role === 'calon_mahasiswa' ? 'selected' : ''}>Calon Mahasiswa</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm px-3" style="border: none;" onclick="saveUser(${id})">Save</button>
                        <button class="btn btn-outline-secondary btn-sm px-3" onclick="location.reload()">Cancel</button>
                    </td>
                `;
            }

            function saveUser(id) {
                const email = document.getElementById("email-" + id).value;
                const role = document.getElementById("role-" + id).value;

                fetch("update_user.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${id}&email=${email}&role=${role}`
                })
                .then(res => res.text())
                .then(() => {
                    location.reload();
                });
            }


            // delete user

            function deleteUser(id) {

                if (!confirm("Yakin ingin menghapus user ini?")) {
                    return;
                }

                fetch("delete_user.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id=" + id
                })
                .then(res => res.text())
                .then(response => {

                    if (response === "success") {
                        const row = document.getElementById("row-" + id);
                        row.remove();
                        alert("User berhasil dihapus!");
                        location.reload();
                    } else {
                        alert("Gagal menghapus user!");
                    }

                });

            }






            // untuk insert data user

                document.getElementById("btnTambah").addEventListener("click", function() {
                            document.getElementById("formTambah").style.display = "block";
                        });



                            function saveNewUser() {
                                const email = document.getElementById("newEmail").value;
                                const role = document.getElementById("newRole").value;

                                if (!email) {
                                    alert("Email wajib diisi!");
                                    return;
                                }

                                fetch("insert_user.php", {
                                    method: "POST",
                                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                    body: `email=${email}&role=${role}`
                                })
                                .then(res => res.text())
                                .then(response => {
                                    if (response === "success") {
                                        const fullEmail = email.includes('@') ? email : email + "@stai.ac.id";
                                        const defaultPass = fullEmail.split('@')[0];
                                        alert(`Akun '${fullEmail}' [${role}] berhasil ditambahkan.\nPassword default: ${defaultPass}`);
                                        location.reload();
                                    } else if (response === "exists") {
                                        alert("Email ini sudah terdaftar! Harap gunakan email lain.");
                                    } else {
                                        alert("Gagal menambahkan akun: " + response);
                                    }
                                });
                            }

                function closeForm() {
                    document.getElementById("formTambah").style.display = "none";
                }







            // --- VIEW DETAILS MODAL LOGIC ---
            function viewDetails(id) {
                console.log("Viewing details for ID:", id);
                if (!window.allUserData) {
                    console.error("User data not loaded yet");
                    return;
                }
                const user = window.allUserData.find(u => u.id == id);
                if (!user) {
                    alert("Data user tidak ditemukan!");
                    return;
                }

                const modalBody = document.getElementById('modalContent');
                
                // Helper for document status
                const getDocItem = (label, path) => {
                    const fileName = path ? path.split('/').pop() : '';
                    const fullPath = '<?= BASE_URL ?>/dashboard/upload-berkas/getdata/uploads/' + fileName;
                    return `
                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">${label}</small>
                                <strong>${path ? 'Tersedia' : 'Belum Upload'}</strong>
                            </div>
                            ${path ? `
                                <a href="${fullPath}" target="_blank" class="btn btn-outline-success btn-sm d-flex align-items-center">
                                    <span class="material-symbols-rounded fs-6 me-1">visibility</span> Lihat
                                </a>
                            ` : `
                                <span class="material-symbols-rounded text-muted">close</span>
                            `}
                        </div>
                    </div>
                `};

                modalBody.innerHTML = `
                    <div class="row">
                        <!-- Basic Info -->
                        <div class="col-12 mb-4">
                            <h6 class="text-success border-bottom pb-2 mb-3">Informasi Biodata</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tr><td width="30%" class="text-muted">Nama Lengkap</td><td>: ${user.nama_mhs || '-'}</td></tr>
                                    <tr><td class="text-muted">NIK</td><td>: ${user.nik || '-'}</td></tr>
                                    <tr><td class="text-muted">Alamat</td><td>: ${user.alamat || '-'}</td></tr>
                                    <tr><td class="text-muted">Tempat, Tgl Lahir</td><td>: ${user.tempat_lahir || '-'}, ${user.tanggal_lahir || '-'}</td></tr>
                                    <tr><td class="text-muted">Jurusan Dipilih</td><td>: ${user.jurusan || '-'}</td></tr>
                                </table>
                            </div>
                        </div>

                        <!-- Documents Info -->
                        <div class="col-12">
                            <h6 class="text-success border-bottom pb-2 mb-3">Berkas Unggahan</h6>
                            <div class="row">
                                ${getDocItem('Pas Foto', user.pas_foto)}
                                ${getDocItem('Ijazah', user.ijazah)}
                                ${getDocItem('KTP', user.ktp)}
                                ${getDocItem('Kartu Keluarga', user.kk)}
                                ${getDocItem('Akta Kelahiran', user.akta)}
                            </div>
                        </div>
                    </div>
                `;

                const myModal = new bootstrap.Modal(document.getElementById('userModal'));
                myModal.show();
            }


    </script>
</body>
</html>
