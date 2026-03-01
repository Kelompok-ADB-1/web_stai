<?php
session_start();

// Gating: Only allow access if the user just registered
if (!isset($_SESSION['registration_success']) || $_SESSION['registration_success'] !== true) {
    header("Location: ../");
    exit;
}

// Clear the flag so they can't revisit the page directly (one-time view)
unset($_SESSION['registration_success']);
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>STAI Sabilu Salam Bandung</title>

	<link rel="icon" type="image/svg+xml" href="../../logo_stai-01.svg">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&family=Signika:wght@300..700&display=swap"
		rel="stylesheet">

	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- link external css -->
	<link href="../../style.css" rel="stylesheet">

	<!-- Animate On Scroll (AOS) -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


	<style>

		html{
			overflow: hidden;
		}
		/* --- Container Utama --- */
		.container {
			width: 100%;
			width: 400px;
			padding: 20px;
		}

		/* --- Kotak Form Login --- */
		.login-form {
			background-color: #ffffff;
			padding: 20px 40px;
			border-radius: 10px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
			text-align: center;
		}

		.login-form h2 {
			font-size: 27px;
			font-weight: 600;
			color: var(--gray);
			margin-bottom: 5px;
		}

		.login-form h4 {
			font-size: 16px;
			font-weight: 400;
			color: var(--gray);
			margin-bottom: 30px;
		}

		.login-form a {
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
			padding: 12px;
			border: 1px solid #dddfe2;
			border-radius: 6px;
			font-size: 16px;
			transition: border-color 0.2s, box-shadow 0.2s;
		}

		/* Efek saat input di-klik (focus) */
		.form-group input[type="text"]:focus,
		.form-group input[type="password"]:focus {
			outline: none;
			border-color: var(--primary-main);
			box-shadow: 0 0 0 2px #e7f3ff;
		}

		/* --- Style untuk Tombol Login --- */
		button[type="submit"] {
			width: 100%;
			padding: 12px;
			margin-bottom: 9px;
			background-color: var(--primary-main);
			border: none;
			border-radius: 6px;
			color: #fff;
			font-size: 18px;
			font-weight: bold;
			cursor: pointer;
			transition: background-color 0.2s;
		}

		/* Efek saat tombol di-hover (cursor di atasnya) */
		button[type="submit"]:hover {
			background-color: var(--primary-dark);
		}

		/* Efek saat tombol di-klik */
		button[type="submit"]:active {
			transform: scale(0.98);
		}
	</style>



</head>

<body>


  <!-- ===== NAVBAR ===== -->
  <?php include __DIR__ . '/../../navbar.php'; ?>









	<!-- landing page disini -->
	<div class="landing">
		<div class="bg-main">
			<img src="../../div_bg.png" alt="Background">
		</div>

		<div class="content-landing">


        <div class="container d-flex align-items-center" style="min-width: 500px;"data-aos="fade-up" data-aos-duration="800">
        <div class="card shadow-lg border-0 text-center" style="width: 100%; padding: 30px; padding-top: 5px">
                
            <div class="mb-4">
                </div>

                <h2 class="fw-bold mb-3 text-dark">Pendaftaran Berhasil!</h2>
                
                <p class="mb-2 fs-6">
                    <span class="fw-semibold text-dark">Akun Anda</span> sedang dalam proses 
                    <span class="text-success fw-bold">validasi</span> oleh admin<br>
                </p>
                <p class="mb-0 fst-italic text-primary" style="font-size: 14px">
                    Mohon tunggu konfirmasi melalui email yang telah Anda daftarkan.<br><br>
                </p>

                <a href="../../" class="btn btn-success px-4">
                Kembali ke Beranda
                </a>

                </div>
            </div>


		</div>

	</div>




	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

	<!-- AOS Script -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		AOS.init({
			duration: 800,
			once: true,
			easing: 'ease-in-out'
		});
	</script>

</body>

</html>