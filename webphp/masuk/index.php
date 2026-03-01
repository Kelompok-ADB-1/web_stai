<?php require_once __DIR__ . '/../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAI Sabilu Salam Bandung</title>

    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/logo_stai-01.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&family=Signika:wght@300..700&display=swap" rel="stylesheet">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- link external css -->
    <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">

	  <!-- Animate On Scroll (AOS) -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

	
	<style>
	
				

			/* --- Container Utama --- */
			.auth-container {
				max-width: 550px;
				padding: 50px 20px;
				margin: 0 auto;
			}

			/* --- Kotak Form Login --- */
			.login-form {
				background-color: #ffffff;
				padding: 30px 60px;
				border-radius: 24px;
				box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08), 0 20px 80px rgba(0, 0, 0, 0.05);
				text-align: center;
				border: 1px solid rgba(0,0,0,0.03);
			}

			@media (max-width: 768px) {
				.login-form {
					padding: 40px 25px;
				}
			}

			.login-form h2 {
				font-size: 32px;
				font-weight: 700;
				color: #000;
				margin-bottom: 10px;
			}

			.login-form h4 {
				font-size: 18px;
				font-weight: 400;
				color: #444;
				margin-bottom: 35px;
			}

			.login-form a{
				color: var(--primary-main);
				text-decoration: none;
			}

			/* --- Grup Form (Label + Input) --- */
			.form-group {
				margin-bottom: 15px;
				text-align: left;
			}

			.form-group label {
				display: block;
				font-size: 12px;
				color: #606770;
				font-weight: 600;
				margin-bottom: 5px;
			}

			/* --- Style untuk Input Field --- */
			.form-group input[type="text"],
			.form-group input[type="password"] {
				width: 100%;
				padding: 16px 20px;
				border: 1px solid #e2e8f0;
				border-radius: 12px;
				font-size: 16px;
				transition: all 0.3s;
				background: #f8fafc;
			}

			/* Efek saat input di-klik (focus) */
			.form-group input[type="text"]:focus,
			.form-group input[type="password"]:focus {
				outline: none;
				border-color:  var(--primary-main);
				box-shadow: 0 0 0 2px #e7f3ff;
			}

			/* --- Style untuk Tombol Login --- */
			button[type="submit"] {
				width: 100%;
				padding: 16px;
				margin-top: 20px;
				margin-bottom: 10px;
				background: linear-gradient(135deg, var(--primary-main), var(--primary-dark));
				border: none;
				border-radius: 12px;
				color: #fff;
				font-size: 18px;
				font-weight: 700;
				cursor: pointer;
				transition: all 0.3s;
				box-shadow: 0 4px 15px rgba(16, 147, 53, 0.25);
			}

			/* Efek saat tombol di-hover (cursor di atasnya) */
			button[type="submit"]:hover {
				background-color: var(--primary-dark);
			}

			/* Efek saat tombol di-klik */
			button[type="submit"]:active {
				transform: scale(0.98);
			}

			.landing {
				justify-content: center;
			}

			.content-landing {
				width: 100%;
				z-index: 10;
			}


	
	</style>
	
    

</head>

<body>

<?php include __DIR__ . '/../navbar.php'; ?>








<!-- landing page disini -->
<div class="landing">
    <div class="bg-main">
        <img src="<?= BASE_URL ?>/div_bg.png" alt="Background">
    </div>

    <div class="content-landing">
        
		
                <div class="auth-container">
                    <div class="login-form" data-aos="fade-up" data-aos-duration="800">
                        <h2 style="color:black">Masuk</h2>
                        <h4 style="color:black">Belum punya akun? <a href="<?= BASE_URL ?>/daftar/">Daftar</a></h4>
                        <form id="loginForm">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" required placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required placeholder="">
                            </div>
                            <button type="submit">Masuk</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>

        <!-- Modal Success/Error Notification -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                    <div class="modal-body p-4 text-center">
                        <div id="notif_icon_container" class="mb-3">
                            <span id="notif_icon" class="material-symbols-rounded" style="font-size: 60px;">check_circle</span>
                        </div>
                        <h5 id="notif_title" class="fw-bold">Berhasil!</h5>
                        <p id="notif_message" class="text-muted mb-0">Mengalihkan ke dashboard...</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showNotification(title, message, type = 'success') {
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
                return notifModal;
            }

            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('./login.php', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        showNotification('Login Berhasil', 'Selamat datang kembali! Mengalihkan...');
                        setTimeout(() => {
                            window.location.href = res.redirect;
                        }, 1200);
                    } else {
                        showNotification('Gagal Masuk', res.message, 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    showNotification('Kesalahan', 'Gagal menghubungi server.', 'error');
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- AOS Script -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-in-out'
            });
        </script>

        <!-- Material Symbols -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</body>
</html>











