<?php
session_start();

// Security Gatekeeper
if (!isset($_SESSION["role"])) {
    header("Location: ../../masuk/");
    exit;
}

$pageTitle = "Upload Berkas";
$user_id = $_SESSION["id"];
$userEmail = $_SESSION["email"] ?? "";
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
        .dropzone {
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        .dropzone:hover {
            border-color: var(--primary-main);
            background: #f1f5f9;
        }
        .dropzone img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 15px;
        }
        .status-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }
    </style>

    

</head>
<body>

    <!-- navbar dashboard php -->
    <?php include_once __DIR__ . '/../navbar-dashboard.php'; ?>

        <div class="dashboard-container">
            <section class="welcome-section">
                <h1>Upload Berkas Pendaftaran</h1>
                <p>Silahkan unggah dokumen pendukung dalam format PDF atau JPG (Maks. 2MB).</p>
                
                <!-- <p class="mb-0"><strong>Nama: </strong><?php echo htmlspecialchars($displayName); ?></p>
                <p class="mb-0"><strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
                <p class="mb-0"><strong>Status:</strong> <?php echo htmlspecialchars($userRole); ?></p>
                <p class="mb-0"><strong>Date:</strong> <?php echo $currentDate; ?></p> -->


            </section>
            <section class="panel">
                <div class="panel-header"><h3>Dokumen Pendaftaran</h3></div>

                

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th style="width: 70%;">Nama Dokumen</th>
                            <th style="width: 30%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="berkasTableBody">
                        <!-- Data will be loaded here -->
                    </tbody>
                </table>
            </div>



            </section>
        </div>
    </main>

    <!-- new window popup update -->

    <!-- Modal Upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                <form id="uploadForm">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="modalTitle">Upload Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <input type="hidden" name="user_id" id="modal_user_id">
                        <input type="hidden" name="file_type" id="modal_file_type">
                        
                        <p class="text-muted small mb-4 text-start">Pilih file dari perangkat Anda atau tarik ke area di bawah ini.</p>

                        <div class="dropzone" id="modalDropzone">
                            <input type="file" name="file_upload" id="modal_file_upload" hidden required>
                            <div id="modalPlaceholder">
                                <span class="material-symbols-rounded fs-1 text-muted mb-2">upload_file</span>
                                <p class="mb-0 fw-bold small">Klik atau Tarik File Disini</p>
                                <small class="text-muted" style="font-size: 11px;">PNG, JPG, PDF (Max. 2MB)</small>
                            </div>
                            <div id="modalPreview"></div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm" id="btnUploadSubmit" style="background: var(--primary-main); border: none; border-radius: 14px;">Mulai Upload</button>
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
                    <p id="notif_message" class="text-muted mb-0">Dokumen telah diunggah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 text-warning">
                        <span class="material-symbols-rounded" style="font-size: 60px;">delete_forever</span>
                    </div>
                    <h5 class="fw-bold">Hapus Dokumen?</h5>
                    <p class="text-muted mb-4 small">Dokumen yang dihapus tidak dapat dikembalikan. Anda harus mengunggah ulang.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="btnConfirmDelete">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>





    //table data

document.addEventListener("DOMContentLoaded", function() {
    
    // CHANGE THIS with logged-in user ID
    var userId = <?php echo $user_id; ?>;

    fetch("./getdata/index.php")
        .then(response => response.json())
        .then(result => {

            if (result.status !== "success") {
                console.error("Failed to load data");
                return;
            }

            const data = result.data.find(u => u.user_id == userId);

            if (!data) {
                console.error("User not found");
                return;
            }

            const documents = [
                { label: "Pas Foto 3x4", field: "pas_foto" },
                { label: "Ijazah / SKL", field: "ijazah" },
                { label: "KTP", field: "ktp" },
                { label: "Kartu Keluarga", field: "kk" },
                { label: "Akta Kelahiran", field: "akta" },
                { label: "Sertifikat / Prestasi", field: "prestasi", optional: true },
                // { label: "Profil Picture", field: "profile_picture" },
                // { label: "Status Berkas", field: "berkas_is_null" }
            ];

            const tbody = document.getElementById("berkasTableBody");
            tbody.innerHTML = "";

documents.forEach(doc => {
    const isExist = data[doc.field] !== null && data[doc.field] !== "";

    let actionButton = "";

    if (!isExist) {
        let btnClass = doc.optional ? "btn-outline-secondary" : "btn-outline-success";
        let uploadText = doc.optional ? "Upload (Opsional)" : "Upload";
  actionButton = `
        <button class="btn ${btnClass} btn-sm px-3 uploadBtn" style="border-radius: 8px;"
            onclick="openUploadModal(${userId}, '${doc.field}', '${doc.label}')">
            <span class="d-flex align-items-center gap-1"><span class="material-symbols-rounded fs-6">upload</span> ${uploadText}</span>
        </button>
    `;
    } else {
        const fileName = data[doc.field].replace(/'/g, "\\'"); // escape single quotes

        actionButton = `
            <div class="d-flex gap-2">
                <a href="./getdata/uploads/${data[doc.field]}" target="_blank" 
                   class="btn btn-outline-primary btn-sm px-3" style="border-radius: 8px;">
                   <span class="d-flex align-items-center gap-1"><span class="material-symbols-rounded fs-6">visibility</span> View</span>
                </a>

                <button class="btn btn-outline-danger btn-sm px-3" style="border-radius: 8px;"
                   onclick="deleteFoto(${userId}, '${doc.field}', '${fileName}')">
                    <span class="d-flex align-items-center gap-1"><span class="material-symbols-rounded fs-6">delete</span> Delete</span>
                </button>
            </div>
        `;
    }

    const rowLabel = doc.optional ? `${doc.label} <span class="badge bg-light text-secondary border ms-2">Opsional</span>` : doc.label;

    const row = `
        <tr id="row-${userId}-${doc.field}">
            <td>${rowLabel}</td>
            <td>${actionButton}</td>
        </tr>
    `;
    tbody.innerHTML += row;
});

        })
        .catch(error => console.error(error));
});




    // update
const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
const modalUserId = document.getElementById('modal_user_id');
const modalFileType = document.getElementById('modal_file_type');
const modalFileInput = document.getElementById('modal_file_upload');
const modalPreview = document.getElementById('modalPreview');
const modalDropzone = document.getElementById('modalDropzone');
const uploadForm = document.getElementById('uploadForm');

// Open modal when Upload button clicked
function openUploadModal(userId, field, label){
    modalUserId.value = userId;
    modalFileType.value = field;
    document.getElementById('modalTitle').textContent = `Upload ${label}`;
    modalPreview.innerHTML = '';
    document.getElementById('modalPlaceholder').classList.remove('d-none');
    modalFileInput.value = '';
    modal.show();
}

// Dropzone click & preview
modalDropzone.addEventListener('click', () => modalFileInput.click());

// Preview on file select
modalFileInput.addEventListener('change', () => {
    showPreview(modalFileInput.files[0]);
});

// Drag & Drop support
modalDropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    modalDropzone.classList.add('border-primary'); // optional visual effect
});
modalDropzone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    modalDropzone.classList.remove('border-primary');
});
modalDropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    modalDropzone.classList.remove('border-primary');
    if(e.dataTransfer.files.length){
        modalFileInput.files = e.dataTransfer.files; // assign dropped files
        showPreview(modalFileInput.files[0]);
    }
});

// Preview function
function showPreview(file){
    if(!file) return;
    modalPreview.innerHTML = '';
    const placeholder = document.getElementById('modalPlaceholder');
    
    if(file.type.startsWith('image/')){
        const reader = new FileReader();
        reader.onload = e => {
            modalPreview.innerHTML = `<img src="${e.target.result}" class="img-fluid">`;
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        modalPreview.innerHTML = `
            <div class="p-3 bg-white rounded-3 shadow-sm border">
                <span class="material-symbols-rounded fs-1 text-primary">description</span>
                <p class="mb-0 fw-bold small mt-2">${file.name}</p>
                <small class="text-muted">PDF Document</small>
            </div>
        `;
        placeholder.classList.add('d-none');
    }
}



//


modalFileInput.addEventListener('change', () => {
    const file = modalFileInput.files[0];
    if(!file) return;
    modalPreview.innerHTML = '';
    if(file.type.startsWith('image/')){
        const reader = new FileReader();
        reader.onload = e => modalPreview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail">`;
        reader.readAsDataURL(file);
    } else {
        modalPreview.innerHTML = `<p>${file.name}</p>`;
    }
});

function showNotification(title, message, type = 'success', shouldReload = true) {
    const notifModalEl = document.getElementById('notificationModal');
    const notifModal = new bootstrap.Modal(notifModalEl);
    const titleEl = document.getElementById('notif_title');
    const msgEl = document.getElementById('notif_message');
    const iconEl = document.getElementById('notif_icon');
    const iconContainer = document.getElementById('notif_icon_container');

    titleEl.innerText = title;
    msgEl.innerText = message;
    
    if (type === 'success') {
        iconEl.innerText = 'check_circle';
        iconContainer.className = 'mb-3 text-success';
    } else {
        iconEl.innerText = 'error';
        iconContainer.className = 'mb-3 text-danger';
    }

    notifModal.show();
    
    if (shouldReload && type === 'success') {
        setTimeout(() => {
            location.reload();
        }, 1500);
    }
}

// AJAX form submission
uploadForm.addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(uploadForm);
    const btnSubmit = document.getElementById('btnUploadSubmit');
    
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengunggah...';

    fetch('upload_foto.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success'){
            bootstrap.Modal.getInstance(document.getElementById('uploadModal')).hide();
            showNotification('Upload Berhasil!', 'Dokumen berhasil disimpan.', 'success', true);
        } else {
            showNotification('Upload Gagal', res.message, 'error', false);
            btnSubmit.disabled = false;
            btnSubmit.innerHTML = 'Mulai Upload';
        }
    })
    .catch(err => {
        showNotification('Kesalahan', 'Gagal menghubungi server.', 'error', false);
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = 'Mulai Upload';
    });
});

let deleteData = null;
const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

function deleteFoto(userId, fieldname) {
    deleteData = { userId, fieldname };
    deleteConfirmModal.show();
}

document.getElementById('btnConfirmDelete').addEventListener('click', function() {
    if (!deleteData) return;
    
    const btnObj = this;
    const originalText = btnObj.innerText;
    btnObj.disabled = true;
    btnObj.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

    const data = new URLSearchParams();
    data.append("id", deleteData.userId);
    data.append("fieldname", deleteData.fieldname);

    fetch("delete_foto.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: data.toString()
    })
    .then(res => res.text())
    .then(response => {
        deleteConfirmModal.hide();
        btnObj.disabled = false;
        btnObj.innerText = originalText;

        if (response.trim() === "success") {
            showNotification('Dihapus!', 'Dokumen berhasil dihapus.', 'success', true);
        } else {
            showNotification('Gagal', 'Gagal menghapus dokumen!', 'error', false);
        }
    })
    .catch(err => {
        deleteConfirmModal.hide();
        btnObj.disabled = false;
        btnObj.innerText = originalText;
        showNotification('Kesalahan', 'Gagal menghubungi server.', 'error', false);
    });
});








    </script>
</body>
</html>
