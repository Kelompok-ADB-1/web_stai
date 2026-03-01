<?php
require_once __DIR__ . '/config.php';

include_once __DIR__ . '/masuk/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STAI Sabilu Salam Bandung</title>

  <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/logo_stai-01.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&family=Signika:wght@300..700&display=swap"
    rel="stylesheet">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- link external css -->
  <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">

  <!-- Material Symbols Outlined -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- Animate On Scroll (AOS) -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    :root {
      --primary: #109335;
      --primary-dark: #1A6034;
      --primary-light: #ADCE24;
      --primary-soft: rgba(16, 147, 53, 0.08);
      --accent: #F9A856;
      --bg-light: #f8fafc;
      --gray-50: #f9fafb;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-700: #334155;
      --gray-800: #1e293b;
      --white: #ffffff;
      --radius-sm: 12px;
      --radius-md: 20px;
      --radius-lg: 32px;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
      --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
      --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      font-family: 'Signika', 'Open Sans', sans-serif;
      background-color: var(--white);
      color: var(--gray-700);
      overflow-x: hidden;
      line-height: 1.6;
      display: block !important;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Signika', sans-serif;
      font-weight: 700;
      color: var(--gray-800);
    }



    /* Hero Section */
    .landing {
      position: relative;
      min-height: 75vh;
      display: flex;
      align-items: center;
      padding: 120px 0 80px;
      overflow: hidden;
      background: var(--white);
    }

    .bg-main {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }

    .bg-main::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 40%;
      background: linear-gradient(to top, var(--white), transparent);
    }

    .bg-main img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .content-landing {
      position: relative;
      z-index: 10;
    }

    .display-3 {
      font-weight: 800;
      letter-spacing: -1.5px;
      line-height: 1.1;
      color: var(--gray-800);
    }

    .btn {
      padding: 0.8rem 2.2rem;
      border-radius: 14px;
      font-weight: 600;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-success {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      border: none;
      box-shadow: 0 4px 15px rgba(16, 147, 53, 0.3);
      transition: all 0.25s ease;
      color: white !important;
    }

    .btn-success:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(16, 147, 53, 0.4);
      /* background: linear-gradient(135deg, #14B940 0%, #1F6F38 100%); */
      filter: brightness(1.1); /* 10% brighter */
    }

    .btn-outline-success {
      border: 2px solid var(--primary);
      color: var(--primary);
      background: transparent;
    }

    .btn-outline-success:hover {
      background: var(--primary);
      color: var(--white) !important;
      transform: translateY(-3px);
    }


    /* Sections */
    .section-padding {
      padding: 100px 0;
    }

    .section-title {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      position: relative;
      display: inline-block;
    }

    .section-title::after {
      content: '';
      display: block;
      width: 60px;
      height: 4px;
      background: var(--primary);
      margin-top: 15px;
      border-radius: 10px;
    }

    .text-center .section-title::after {
      margin-left: auto;
      margin-right: auto;
    }

    /* Cards */
    .card-premium {
      background: var(--white);
      border: 1px solid var(--gray-100);
      border-radius: var(--radius-md);
      padding: 2.5rem;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      height: 100%;
    }

    .card-premium:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-xl);
      border-color: var(--primary-soft);
    }

    .icon-box {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 64px;
      height: 64px;
      background: var(--primary-soft);
      color: var(--primary);
      border-radius: 18px;
      margin-bottom: 1.5rem;
      transition: var(--transition);
    }

    .card-premium:hover .icon-box {
      background: var(--primary);
      color: var(--white);
      transform: rotate(-5deg) scale(1.1);
    }

    /* Steps */
    .step-card {
      background: var(--gray-50);
      border-radius: var(--radius-md);
      padding: 2rem;
      border: 1px solid var(--gray-100);
      position: relative;
      overflow: hidden;
    }

    .step-card:hover {
      transform: translateX(10px);
      background: var(--white);
      border-color: var(--primary-soft);
      box-shadow: var(--shadow-lg);
    }

    .step-number-bg {
      font-size: 5rem;
      font-weight: 900;
      color: var(--primary);
      opacity: 0.05;
      position: absolute;
      top: -1rem;
      right: 0.5rem;
      line-height: 1;
      pointer-events: none;
    }

    /* Animations */
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .animate-float {
      animation: float 3s ease-in-out infinite;
    }


    #map-container {
      border-radius: var(--radius-md);
      overflow: hidden;
      height: 100%;
      min-height: 400px;
      box-shadow: var(--shadow-lg);
    }



  </style>




</head>

<body>

    
  <?php include __DIR__ . '/navbar.php'; ?>









  <!-- Background Fixed -->
  <div class="landing">
    <div class="bg-main">
      <img src="./div_bg.png" alt="Background">
    </div>

    <!-- Landing Content -->

    <div class="content-landing container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-10" data-aos="zoom-in">
          <span class="badge-premium mb-4 animate-float">
            <span class="material-symbols-outlined fs-6">campaign</span>
            PMB 2026/2027 Telah Dibuka
          </span>
          <h1 class="display-3 mb-4">Wujudkan Masa Depan <br><span class="text-success">Bersama STAI Sabilussalam</span></h1>
          <p class="mb-5 text-muted mx-auto" style="max-width: 700px; font-size: 1.25rem;">Berkomitmen untuk mencetak lulusan yang religius, profesional, dan kompetitif di era digital dengan dukungan fasilitas modern dan pengajar ahli.</p>
          <div class="d-flex flex-wrap justify-content-center gap-3">
            <?php if (isset($_SESSION["role"])): ?>
              <a class="btn btn-success" href="./dashboard/">
                Masuk ke Dashboard
                <span class="material-symbols-outlined">arrow_forward</span>
              </a>
            <?php else: ?>
              <a class="btn btn-success" href="./daftar/">
                Daftar Sekarang
                <span class="material-symbols-outlined">arrow_forward</span>
              </a>
            <?php endif; ?>
            <a class="btn btn-outline-success" href="#tentang">
              Tentang Kami
              <span class="material-symbols-outlined">info</span>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>


  <!-- Sambutan & Visi Misi ALT DESIGN -->
  <section id="tentang" class="section-padding">
    <div class="container">
      <div class="row g-5" style="overflow: clip; padding: 50px; padding-top: 0px;">
        <div class="col-lg-7" data-aos="fade-right">
          <div class="pe-lg-5">
            <span class="text-success fw-bold text-uppercase tracking-wider mb-2 d-block"
              style="letter-spacing: 2px; font-size: 14px;">Tentang Kami</span>
            <h2 class="display-5 fw-bold mb-4" style="color: var(--primary-dark);">Selamat Datang di <br><span
                class="text-success">STAI Sabilussalam</span></h2>

            <div class="bg-white p-4 rounded-4 shadow-sm mb-4" style="border: 2px solid var(--gray-100); background: transparent;">
              <p class="lead mb-0 italic" style="font-style: italic;">"Kami bercita-cita untuk membangun ekosistem
                pendidikan
                Islam yang modern tanpa melupakan akar tradisi dan nilai-nilai luhur keagamaan."</p>
            </div>

            <p class="text-muted mb-4">Visi kami adalah menjadi pusat unggulan (Center of Excellence) dalam pengembangan
              ilmu pengetahuan berbasis nilai-nilai Islam yang kompetitif di tingkat regional pada tahun 2030.</p>

            <div class="row g-4 mb-7" style="padding-bottom: 100px">
              <div class="col-sm-6">
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 45px; height: 45px;">
                    <span class="material-symbols-outlined text-success">school</span>
                  </div>
                  <h6 class="fw-bold mb-0">Pendidikan Berkualitas</h6>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 45px; height: 45px;">
                    <span class="material-symbols-outlined text-success">auto_awesome</span>
                  </div>
                  <h6 class="fw-bold mb-0">Karakter Islami</h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5" data-aos="fade-left">
          <div class="position-relative">
            <!-- Decorative Elements -->
            <div class="position-absolute top-0 start-0 translate-middle bg-success opacity-10 rounded-circle"
              style="width: 90px; height: 90px; z-index: -1;"></div>

            <div class="card-premium p-4 shadow-lg border-0" style="border-radius: 32px;">
              <h4 class="fw-bold mb-4 text-center">Fokus Strategis</h4>

              <div class="vstack gap-3">
                <div
                  class="p-3 rounded-4 bg-light border-0 d-flex align-items-center gap-3 transition-all hover-translate">
                  <span
                    class="material-symbols-outlined text-success bg-white p-2 rounded-3 shadow-sm">collections_bookmark</span>
                  <div>
                    <h6 class="fw-bold mb-0">Riset Terapan</h6>
                    <p class="small text-muted mb-0">Pengembangan ilmu ekonomi & syariah.</p>
                  </div>
                </div>

                <div
                  class="p-3 rounded-4 bg-light border-0 d-flex align-items-center gap-3 transition-all hover-translate">
                  <span
                    class="material-symbols-outlined text-success bg-white p-2 rounded-3 shadow-sm">volunteer_activism</span>
                  <div>
                    <h6 class="fw-bold mb-0">Pengabdian</h6>
                    <p class="small text-muted mb-0">Aktif dalam pemberdayaan masyarakat.</p>
                  </div>
                </div>

                <div
                  class="p-3 rounded-4 bg-light border-0 d-flex align-items-center gap-3 transition-all hover-translate">
                  <span
                    class="material-symbols-outlined text-success bg-white p-2 rounded-3 shadow-sm">military_tech</span>
                  <div>
                    <h6 class="fw-bold mb-0">Prestasi Alumni</h6>
                    <p class="small text-muted mb-0">Jaringan karir luas di berbagai sektor.</p>
                  </div>
                </div>
              </div>

              <div class="mt-4 pt-2">
                <a href="#"
                  class="btn btn-success w-100 py-3 rounded-4 fw-bold">
                  Selengkapnya
                  <span class="material-symbols-outlined">arrow_forward</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>




  <!-- Highlights / Keunggulan RE-DESIGN -->
  <section class="py-2" style="position: relative; z-index: 5;" data-aos="fade-up">
    <div class="container">
      <div class="text-center mb-3">
        <span class="text-success fw-bold text-uppercase tracking-wider mb-2 d-block"
          style="letter-spacing: 2px; font-size: 14px;">Keunggulan Kami</span>
        <h2 class="section-title">Profil Kampus</h2>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="card-premium p-4">
            <div class="icon-box">
              <span class="material-symbols-outlined fs-2">verified</span>
            </div>
            <h5 class="fw-bold">Akreditasi Baik</h5>
            <p class="text-muted small mb-0">Terakreditasi resmi oleh BAN-PT, menjamin kualitas pendidikan nasional.</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="card-premium p-4">
            <div class="icon-box">
              <span class="material-symbols-outlined fs-2">groups</span>
            </div>
            <h5 class="fw-bold">Networking Luas</h5>
            <p class="text-muted small mb-0">Berjejaring dengan berbagai sektor pekerjaan yang luas dan sukses.
            </p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="card-premium p-4">
            <div class="icon-box">
              <span class="material-symbols-outlined fs-2">event_note</span>
            </div>
            <h5 class="fw-bold">Prestasi Nasional</h5>
            <p class="text-muted small mb-0">Aktif mengukir prestasi dalam kompetisi akademik maupun non-akademik.</p>
          </div>
        </div>
      </div>
    </div>
  </section>





  <!-- Daftar Jurusan -->
  <section class="py-5 bg-light-subtle">
    <div class="container py-4">
      <div class="text-center mb-5">
        <span class="text-success fw-bold text-uppercase tracking-wider mb-2 d-block"
          style="letter-spacing: 2px; font-size: 14px;">Program Studi</span>
        <h2 class="section-title">Pilih Masa Depanmu</h2>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card-premium h-100 p-0 overflow-hidden">
            <div class="p-4 d-flex align-items-start gap-4">
              <div class="flex-shrink-0 bg-success-subtle p-3 rounded-4">
                <span class="material-symbols-outlined display-6 text-success">account_balance</span>
              </div>
              <div class="flex-grow-1">
                <h4 class="fw-bold mb-2">Hukum Ekonomi Syariah</h4>
                <p class="text-muted small mb-3">Kombinasi ilmu hukum kontemporer dengan prinsip ekonomi syariah untuk
                  mencetak praktisi hukum yang kompeten.</p>
                <a href="./jurusan/hukum-ekonomi-syariah"
                  class="btn btn-sm btn-outline-success rounded-pill px-3 d-inline-flex align-items-center gap-2">
                  Detail Program <span class="material-symbols-outlined fs-6">arrow_right_alt</span>
                </a>
              </div>
            </div>
            <div class="bg-success py-2 text-center text-white small fw-bold">Program Unggulan</div>
          </div>
        </div>
        <div class="col-md-6 col-lg-5">
          <div class="card-premium h-100 p-0 overflow-hidden">
            <div class="p-4 d-flex align-items-start gap-4">
              <div class="flex-shrink-0 bg-success-subtle p-3 rounded-4">
                <span class="material-symbols-outlined display-6 text-success">menu_book</span>
              </div>
              <div class="flex-grow-1">
                <h4 class="fw-bold mb-2">Pendidikan Agama Islam</h4>
                <p class="text-muted small mb-3">Membentuk tenaga pendidik profesional yang memiliki integritas moral
                  tinggi dan wawasan keislaman yang luas.</p>
                <a href="./jurusan/pendidikan-agama-islam"
                  class="btn btn-sm btn-outline-success rounded-pill px-3 d-inline-flex align-items-center gap-2">
                  Detail Program <span class="material-symbols-outlined fs-6">arrow_right_alt</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Panduan Pendaftaran -->
  <section class="py-5 bg-white" style="overflow: hidden">
    <div class="container py-4">
      <div class="row g-5 align-items-center">
        <div class="col-lg-5">
          <span class="text-success fw-bold text-uppercase tracking-wider mb-2 d-block"
            style="letter-spacing: 2px; font-size: 14px;">Admission Process</span>
          <h2 class="display-5 fw-bold mb-4">Mulai Perjalanan Anda Disini</h2>
          <p class="text-muted mb-4 fs-5">Langkah pendaftaran yang mudah dan sepenuhnya online untuk kenyamanan Anda.
          </p>
          <div class="d-flex flex-column gap-3">
            <div class="d-flex align-items-center gap-3">
              <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                style="width: 24px; height: 24px;">
                <span class="material-symbols-outlined text-white" style="font-size: 16px;">check</span>
              </div>
              <span class="fw-medium">Proses Cepat & Transparan</span>
            </div>
            <div class="d-flex align-items-center gap-3">
              <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                style="width: 24px; height: 24px;">
                <span class="material-symbols-outlined text-white" style="font-size: 16px;">check</span>
              </div>
              <span class="fw-medium">Bantuan Support 24/7</span>
            </div>
          </div>
          <a class="btn btn-success px-5 py-3 rounded-pill fw-bold mt-5 shadow-sm d-inline-flex align-items-center gap-2"
            href="./petunjuk-pendaftaran/">
            Lihat Panduan Detail
            <span class="material-symbols-outlined">trending_flat</span>
          </a>
        </div>
        <div class="col-lg-7">
          <div class="position-relative ps-lg-4">
            <div class="vstack gap-4">
              <div class="step-card" data-aos="fade-left" data-aos-delay="100">
                <div class="step-number-bg">01</div>
                <div class="d-flex gap-4">
                  <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2">Registrasi Online</h5>
                    <p class="text-muted mb-0 small">Kunjungi website pendaftaran dan buat akun baru Anda menggunakan email aktif.</p>
                  </div>
                </div>
              </div>
              <div class="step-card" data-aos="fade-left" data-aos-delay="200">
                <div class="step-number-bg">02</div>
                <div class="d-flex gap-4">
                  <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2">Lengkapi Berkas</h5>
                    <p class="text-muted mb-0 small">Unggah dokumen persyaratan seperti Ijazah, KTP, dan foto terbaru Anda.</p>
                  </div>
                </div>
              </div>
              <div class="step-card" data-aos="fade-left" data-aos-delay="300">
                <div class="step-number-bg">03</div>
                <div class="d-flex gap-4">
                  <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2">Validasi Pembayaran</h5>
                    <p class="text-muted mb-0 small">Lakukan pembayaran melalui kanal bank yang tersedia dan konfirmasi otomatis.</p>
                  </div>
                </div>
              </div>
              <div class="step-card" data-aos="fade-left" data-aos-delay="400">
                <div class="step-number-bg">04</div>
                <div class="d-flex gap-4">
                  <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2">Hasil Seleksi</h5>
                    <p class="text-muted mb-0 small">Ikuti tes masuk jika diperlukan dan pantau status kelulusan di dashboard.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>








  <!-- Contact & Map -->
  <section class="section-padding bg-light" style="position: relative; overflow: hidden;">
    <div class="container relative z-10">
      <div class="row g-5 align-items-center">
        <!-- Left Side: Contact Info -->
        <div class="col-lg-5" data-aos="fade-right">
          <div class="pe-lg-4">
            <span class="text-success fw-bold text-uppercase tracking-wider mb-2 d-block" style="letter-spacing: 2px; font-size: 14px;">Contact Us</span>
            <h2 class="display-5 fw-bold mb-4">Terhubung Dengan Kami</h2>
            <p class="text-muted mb-5 fs-5">Kami siap membantu memberikan informasi yang Anda butuhkan seputar pendaftaran dan program studi.</p>
            
            <div class="vstack gap-4 mb-5">
              <div class="d-flex align-items-start gap-4 p-4 bg-white rounded-4 shadow-sm border border-light">
                <div class="flex-shrink-0 bg-primary-soft p-3 rounded-4">
                  <span class="material-symbols-outlined text-success fs-3">location_on</span>
                </div>
                <div>
                  <h6 class="fw-bold mb-1">Lokasi Kampus</h6>
                  <p class="text-muted small mb-0">Jl. Raya Sabilussalam No. 12, Bandung, Jawa Barat</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-4 p-4 bg-white rounded-4 shadow-sm border border-light">
                <div class="flex-shrink-0 bg-primary-soft p-3 rounded-4">
                  <span class="material-symbols-outlined text-success fs-3">mail</span>
                </div>
                <div>
                  <h6 class="fw-bold mb-1">Email Resmi</h6>
                  <p class="text-muted small mb-0">info@staisabilussalam.ac.id</p>
                </div>
              </div>
            </div>

            <!-- CTA Block -->
            <div class="p-4 rounded-4 bg-gray-800 text-white shadow-xl position-relative overflow-hidden">
              <div class="position-relative z-10">
                <h5 class="fw-bold mb-3">Butuh Respon Cepat?</h5>
                <p class="text-black-50 small mb-4">Layanan informasi pendaftaran via WhatsApp tersedia di jam kerja.</p>
                <a href="https://wa.me/" class="btn btn-success w-100 rounded-pill py-3 gap-2" target="_blank">
                  <span class="material-symbols-outlined">chat</span>
                  Hubungi Admin (WhatsApp)
                </a>
              </div>
              <!-- Decorative background circle -->
              <div style="position: absolute; width: 200px; height: 200px; background: var(--primary); opacity: 0.1; border-radius: 50%; bottom: -100px; right: -50px;"></div>
            </div>
          </div>
        </div>

        <!-- Right Side: Map -->
        <div class="col-lg-7" data-aos="fade-left">
          <div id="map-container" style="height: 550px; border: 8px solid white;">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d391.6801387569396!2d107.67923346262857!3d-6.940865057831515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c3002f449de9%3A0x4ef578fa702b7bad!2sAkademi%20Digital%20Bandung!5e0!3m2!1sid!2sid!4v1772184082402!5m2!1sid!2sid"
              width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include __DIR__ . '/footer.php'; ?>
  <div style="background-color: black; text-align: center; justify-content: center; align-items: center; display: flex;">
    <a href="<?= BASE_URL ?>/init_db.php" style="font-size: 10px; background-color: red; color: white; padding:10px; margin: 10px; text-decoration: none; border-radius: 10px;" target="_blank">init_db.php</a>
  </div>



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

</body>

</html>