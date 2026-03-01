<?php
require_once __DIR__ . '/../config.php';
 ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petunjuk Pendaftaran - STAI Sabilussalam</title>
  <meta name="description"
    content="Panduan lengkap cara mendaftar sebagai calon mahasiswa baru STAI Sabilussalam. Ikuti 5 tahap mudah untuk mendaftar secara online.">

  <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/logo_stai-01.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">

  <style>
    :root {
      --primary-main: #109335;
      --primary-dark: #1A6034;
      --primary-light: #ADCE24;
      --accent: #F9A856;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Signika', sans-serif;
      background-color: #f6f8f5;
      color: #1a1a1a;
      overflow-x: hidden;
      display: block !important;
    }

    /* ===== NAVBAR ===== */


    /* ===== HERO ===== */
    .hero-section {
      background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-main) 70%, #1db954 100%);
      color: white;
      padding: 90px 0 80px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: -80px;
      right: -80px;
      width: 380px;
      height: 380px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
    }

    .hero-section::after {
      content: '';
      position: absolute;
      bottom: -100px;
      left: -60px;
      width: 280px;
      height: 280px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.06);
    }

    .hero-badge {
      display: inline-block;
      background: rgba(255, 255, 255, 0.18);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 50px;
      padding: 6px 20px;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 18px;
    }

    .hero-section h1 {
      font-size: clamp(2rem, 5vw, 3.2rem);
      font-weight: 700;
      line-height: 1.2;
    }

    .hero-section .lead {
      opacity: 0.9;
      max-width: 560px;
      margin: 0 auto 32px;
      font-size: 1.05rem;
    }

    .btn-hero-primary {
      background: white;
      color: var(--primary-dark);
      border: none;
      border-radius: 50px;
      padding: 12px 32px;
      font-weight: 700;
      font-size: 0.95rem;
      font-family: 'Signika', sans-serif;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-hero-primary:hover {
      background: var(--primary-main);
      color: var(--white);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    /* ===== SECTION STYLES ===== */
    .section-eyebrow {
      display: inline-block;
      background: linear-gradient(135deg, #e8f5ee, #d0edda);
      color: var(--primary-dark);
      border-radius: 50px;
      padding: 5px 18px;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      margin-bottom: 12px;
    }

    .section-title {
      font-size: clamp(1.6rem, 3vw, 2.2rem);
      font-weight: 700;
      color: #111;
    }

    .section-title span {
      color: var(--primary-main);
    }

    /* ===== PERSYARATAN ===== */
    .syarat-section {
      padding: 80px 0;
      background: white;
    }

    .syarat-card {
      background: linear-gradient(135deg, #f0f9f3, #e6f5ea);
      border-radius: 20px;
      padding: 28px 24px;
      border: 1px solid #c8e6ce;
      height: 100%;
      transition: all 0.3s;
    }

    .syarat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(16, 147, 53, 0.12);
    }

    .syarat-icon {
      width: 54px;
      height: 54px;
      background: linear-gradient(135deg, var(--primary-main), var(--primary-dark));
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .syarat-icon span {
      color: white;
      font-size: 26px;
    }

    .syarat-card h5 {
      font-weight: 700;
      color: var(--primary-dark);
      margin-bottom: 6px;
      font-size: 0.95rem;
    }

    .syarat-card p {
      color: #555;
      font-size: 0.875rem;
      margin: 0;
      line-height: 1.6;
    }

    /* ===== LANGKAH PENDAFTARAN ===== */
    .langkah-section {
      padding: 90px 0;
      background: #f6f8f5;
    }

    .step-wrapper {
      position: relative;
    }

    /* Vertical connector line */
    .step-connector {
      position: absolute;
      left: 28px;
      top: 64px;
      bottom: 0;
      width: 2px;
      background: linear-gradient(180deg, var(--primary-main), transparent);
      z-index: 0;
    }

    .step-card {
      background: white;
      border-radius: 20px;
      padding: 28px 28px 28px 30px;
      border: 1px solid #e4eae4;
      margin-bottom: 20px;
      display: flex;
      gap: 20px;
      align-items: flex-start;
      position: relative;
      z-index: 1;
      transition: all 0.3s;
    }

    .step-card:hover {
      box-shadow: 0 12px 32px rgba(16, 147, 53, 0.1);
      border-color: transparent;
      transform: translateX(4px);
    }

    .step-num {
      min-width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--primary-main), var(--primary-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      font-weight: 700;
      color: white;
      flex-shrink: 0;
      box-shadow: 0 4px 14px rgba(16, 147, 53, 0.35);
    }

    .step-body {
      flex: 1;
    }

    .step-body h4 {
      font-weight: 700;
      color: var(--primary-dark);
      font-size: 1.05rem;
      margin-bottom: 10px;
    }

    .step-body ul {
      padding-left: 18px;
      margin-bottom: 14px;
      color: #555;
    }

    .step-body ul li {
      padding: 3px 0;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .step-tag {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: #f0f9f3;
      color: var(--primary-dark);
      border-radius: 20px;
      padding: 3px 12px;
      font-size: 0.78rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .btn-step {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: linear-gradient(135deg, var(--primary-main), var(--primary-dark));
      color: white;
      border-radius: 50px;
      padding: 9px 22px;
      font-size: 0.875rem;
      font-weight: 600;
      font-family: 'Signika', sans-serif;
      text-decoration: none;
      transition: all 0.3s;
    }

    .btn-step:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(16, 147, 53, 0.35);
    }

    .btn-step-outline {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: transparent;
      color: var(--primary-dark);
      border: 2px solid var(--primary-main);
      border-radius: 50px;
      padding: 7px 20px;
      font-size: 0.875rem;
      font-weight: 600;
      font-family: 'Signika', sans-serif;
      text-decoration: none;
      transition: all 0.3s;
    }

    .btn-step-outline:hover {
      background: var(--primary-main);
      color: white;
    }

    /* ===== VIDEO SECTION ===== */
    .video-section {
      padding: 80px 0;
      background: white;
    }

    .video-card {
      background: #f6f8f5;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e4eae4;
      transition: all 0.3s;
    }

    .video-card:hover {
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
      transform: translateY(-4px);
    }

    .video-card iframe {
      width: 100%;
      height: 230px;
      border: none;
      display: block;
    }

    .video-card .vid-info {
      padding: 16px 20px;
    }

    .video-card .vid-info h6 {
      font-weight: 700;
      color: #111;
      margin-bottom: 4px;
      font-size: 0.9rem;
    }

    .video-card .vid-info p {
      color: #777;
      font-size: 0.8rem;
      margin: 0;
    }

    /* ===== INFO STRIP ===== */
    .info-strip {
      background: linear-gradient(135deg, #f0f9f3, #e8f5ee);
      border-radius: 20px;
      padding: 28px 32px;
      border: 1px solid #c8e6ce;
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .info-strip .icon-big {
      font-size: 40px;
      color: var(--primary-main);
      flex-shrink: 0;
    }

    .info-strip h5 {
      font-weight: 700;
      color: var(--primary-dark);
      margin-bottom: 4px;
    }

    .info-strip p {
      color: #555;
      font-size: 0.875rem;
      margin: 0;
    }

    /* ===== CTA ===== */
    .cta-section {
      padding: 130px 0;
      background: linear-gradient(135deg, var(--primary-dark), var(--primary-main));
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: -80px;
      right: -80px;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
    }

    .cta-section h2 {
      font-size: clamp(1.8rem, 4vw, 2.6rem);
      font-weight: 700;
    }

    .cta-section p {
      opacity: 0.88;
      font-size: 1rem;
      max-width: 500px;
      margin: 0 auto 32px;
    }

    .btn-cta-white {
      background: white;
      color: var(--primary-dark);
      border: none;
      border-radius: 50px;
      padding: 12px 36px;
      font-weight: 700;
      font-size: 1rem;
      font-family: 'Signika', sans-serif;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s;
    }

    .btn-cta-white:hover {
      background: var(--primary-main);
      color: var(--white);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-cta-outline {
      background: transparent;
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.6);
      border-radius: 50px;
      padding: 12px 32px;
      font-weight: 600;
      font-size: 0.95rem;
      font-family: 'Signika', sans-serif;
      text-decoration: none;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-cta-outline:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: white;
      color: white;
    }



    @media (max-width: 768px) {
      .step-connector {
        display: none;
      }

      .info-strip {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>

<body>

    <!-- ===== NAVBAR ===== -->
  <?php include __DIR__ . '/../navbar.php'; ?>


  <!-- ===== HERO ===== -->
  <section class="hero-section">
    <div class="container position-relative" style="z-index:2">
      <div data-aos="fade-up">
        <div class="hero-badge">📋 Penerimaan Mahasiswa Baru</div>
        <h1 class="mb-3">Petunjuk Pendaftaran</h1>
        <p class="lead">
          Ikuti panduan langkah demi langkah untuk mendaftar sebagai calon mahasiswa baru STAI Sabilussalam dengan mudah
          dan cepat.
        </p>
        <?php if (isset($_SESSION["role"])): ?>
          <a href="<?= BASE_URL ?>/dashboard/" class="btn-hero-primary">
            Masuk ke Dashboard
            <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
          </a>
        <?php else: ?>
          <a href="../daftar/" class="btn-hero-primary">
            Mulai Daftar Sekarang
            <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
          </a>
        <?php endif; ?>
      </div>

      <!-- Quick steps indicator -->
      <div class="d-flex justify-content-center gap-3 mt-5 flex-wrap" data-aos="fade-up" data-aos-delay="150">
        <div
          style="background:rgba(255,255,255,0.15);border-radius:50px;padding:8px 20px;font-size:0.85rem;display:flex;align-items:center;gap:8px">
          <span class="material-symbols-outlined" style="font-size:18px">person_add</span> Buat Akun
        </div>
        <div
          style="background:rgba(255,255,255,0.15);border-radius:50px;padding:8px 20px;font-size:0.85rem;display:flex;align-items:center;gap:8px">
          <span class="material-symbols-outlined" style="font-size:18px">edit_document</span> Isi Formulir
        </div>
        <div
          style="background:rgba(255,255,255,0.15);border-radius:50px;padding:8px 20px;font-size:0.85rem;display:flex;align-items:center;gap:8px">
          <span class="material-symbols-outlined" style="font-size:18px">payments</span> Bayar PIN
        </div>
        <div
          style="background:rgba(255,255,255,0.15);border-radius:50px;padding:8px 20px;font-size:0.85rem;display:flex;align-items:center;gap:8px">
          <span class="material-symbols-outlined" style="font-size:18px">verified</span> Cek Kelulusan
        </div>
      </div>
    </div>
  </section>


  <!-- ===== PERSYARATAN ===== -->
  <section class="syarat-section" id="persyaratan">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="section-eyebrow">Syarat Umum</span>
        <h2 class="section-title">Persyaratan Calon <span>Mahasiswa Baru</span></h2>
        <p class="text-muted mt-2" style="max-width:500px;margin:0 auto">Pastikan Anda memenuhi seluruh persyaratan di
          bawah ini sebelum memulai proses pendaftaran.</p>
      </div>

      <div class="row g-4 justify-content-center">

        <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
          <div class="syarat-card">
            <div class="syarat-icon"><span class="material-symbols-outlined">flag</span></div>
            <h5>Warga Negara Indonesia</h5>
            <p>Calon mahasiswa merupakan WNI yang memiliki identitas kependudukan yang sah dan berlaku.</p>
          </div>
        </div>

        <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="syarat-card">
            <div class="syarat-icon"><span class="material-symbols-outlined">school</span></div>
            <h5>Lulusan SMA / SMK / MA</h5>
            <p>Telah lulus atau sedang menempuh tingkat SMA, SMK, MA, atau pendidikan sederajat yang diakui pemerintah.
            </p>
          </div>
        </div>

        <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="syarat-card">
            <div class="syarat-icon"><span class="material-symbols-outlined">calendar_month</span></div>
            <h5>Tidak Ada Batasan Usia</h5>
            <p>Pendaftaran terbuka untuk semua usia. Siapapun bisa mewujudkan mimpi menempuh pendidikan tinggi Islam.
            </p>
          </div>
        </div>

      </div>

      <!-- Info strip -->
      <div class="mt-5" data-aos="fade-up" data-aos-delay="100">
        <div class="info-strip">
          <span class="material-symbols-outlined icon-big">info</span>
          <div>
            <h5>Dokumen yang Perlu Disiapkan</h5>
            <p>Siapkan ijazah / SKL, KTP/Kartu Keluarga, foto formal terbaru, dan alamat email aktif sebelum memulai
              pendaftaran. Semua proses dilakukan secara online.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ===== LANGKAH PENDAFTARAN ===== -->
  <section class="langkah-section" id="langkah">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="section-eyebrow">Cara Mendaftar</span>
        <h2 class="section-title">5 Langkah <span>Pendaftaran</span></h2>
        <p class="text-muted mt-2" style="max-width:500px;margin:0 auto">Proses pendaftaran mahasiswa baru dilakukan
          secara online melalui sistem PMB STAI Sabilussalam.</p>
      </div>

      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="step-wrapper">
            <div class="step-connector"></div>

            <!-- Step 1 -->
            <div class="step-card" data-aos="fade-up" data-aos-delay="0">
              <div class="step-num">1</div>
              <div class="step-body">
                <div class="step-tag">
                  <span class="material-symbols-outlined" style="font-size:14px">web</span>
                  Persiapan
                </div>
                <h4>Cari Informasi PMB STAI</h4>
                <ul>
                  <li>Kunjungi website resmi STAI Sabilussalam</li>
                  <li>Baca informasi program studi dan jalur seleksi yang tersedia</li>
                  <li>Klik tombol <b>Daftar PMB</b> yang ada di halaman utama</li>
                </ul>
                <a href="../daftar/" class="btn-step">
                  <span class="material-symbols-outlined" style="font-size:16px">open_in_new</span>
                  Halaman Pendaftaran
                </a>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="step-card" data-aos="fade-up" data-aos-delay="80">
              <div class="step-num">2</div>
              <div class="step-body">
                <div class="step-tag">
                  <span class="material-symbols-outlined" style="font-size:14px">person_add</span>
                  Registrasi
                </div>
                <h4>Buat Akun Pendaftaran</h4>
                <ul>
                  <li>Daftarkan diri dengan mengisi form pembuatan akun PMB</li>
                  <li>Masukkan nama lengkap, email aktif, dan nomor HP</li>
                  <li>Verifikasi akun melalui link yang dikirim ke email Anda</li>
                  <li>Login kembali menggunakan akun yang telah diverifikasi</li>
                </ul>
                <div class="d-flex flex-wrap gap-2">
                  <a href="../daftar/" class="btn-step">
                    <span class="material-symbols-outlined" style="font-size:16px">person_add</span>
                    Daftar Akun
                  </a>
                  <a href="../masuk/" class="btn-step-outline">
                    Login Akun
                  </a>
                </div>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="step-card" data-aos="fade-up" data-aos-delay="160">
              <div class="step-num">3</div>
              <div class="step-body">
                <div class="step-tag">
                  <span class="material-symbols-outlined" style="font-size:14px">edit_document</span>
                  Pengisian Data
                </div>
                <h4>Lengkapi Data Diri</h4>
                <ul>
                  <li>Masuk ke dashboard akun PMB Anda</li>
                  <li>Pilih menu <b>Data Diri</b> dan isi seluruh kolom yang tersedia</li>
                  <li>Upload foto formal dan scan dokumen yang diperlukan</li>
                  <li>Simpan data setelah selesai mengisi semua kolom</li>
                </ul>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="step-card" data-aos="fade-up" data-aos-delay="240">
              <div class="step-num">4</div>
              <div class="step-body">
                <div class="step-tag">
                  <span class="material-symbols-outlined" style="font-size:14px">payments</span>
                  Registrasi &amp; Pembayaran
                </div>
                <h4>Lengkapi Data Registrasi &amp; Bayar PIN</h4>
                <ul>
                  <li>Isi kuisioner dan data pemesanan formulir pendaftaran</li>
                  <li>Masukkan kode referral (jika ada) untuk mendapat keuntungan tambahan</li>
                  <li>Pilih program studi dan jalur seleksi yang diinginkan</li>
                  <li>Lakukan pembayaran PIN aktivasi melalui metode yang tersedia</li>
                  <li>Setelah pembayaran dikonfirmasi, lengkapi data seleksi Anda</li>
                  <li>Cetak dan simpan <b>kartu peserta seleksi</b> sebagai bukti pendaftaran</li>
                </ul>

              </div>
            </div>

            <!-- Step 5 -->
            <div class="step-card" data-aos="fade-up" data-aos-delay="320">
              <div class="step-num">5</div>
              <div class="step-body">
                <div class="step-tag">
                  <span class="material-symbols-outlined" style="font-size:14px">verified</span>
                  Pengumuman
                </div>
                <h4>Cek Laporan Kelulusan</h4>
                <ul>
                  <li>Login kembali ke aplikasi PMB STAI Sabilussalam</li>
                  <li>Pilih menu <b>Data Registrasi</b> dari dashboard akun</li>
                  <li>Klik <b>Laporan Kelulusan</b> untuk melihat status seleksi Anda</li>
                  <li>Jika dinyatakan lulus, cetak dan simpan surat kelulusan</li>
                  <li>Ikuti proses daftar ulang sesuai jadwal yang ditentukan</li>
                </ul>
              </div>
            </div>

          </div><!-- end step-wrapper -->
        </div>
      </div>
    </div>
  </section>


  <!-- ===== VIDEO SECTION ===== -->
  <section class="video-section" id="video">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="section-eyebrow">Tutorial</span>
        <h2 class="section-title">Video Petunjuk <span>Pendaftaran</span></h2>
        <p class="text-muted mt-2" style="max-width:480px;margin:0 auto">Saksikan panduan visual langkah demi langkah
          proses pendaftaran mahasiswa baru STAI.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
          <div class="video-card">
            <iframe src="https://www.youtube.com/embed/PwtF37m9B0I" title="Petunjuk Pendaftaran Part 1"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
            <div class="vid-info">
              <h6>Panduan Pendaftaran Bagian 1</h6>
              <p>Cara membuat akun dan mengisi data diri di sistem PMB STAI</p>
            </div>
          </div>
        </div>

        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="video-card">
            <iframe src="https://www.youtube.com/embed/pBnelkCkztY" title="Petunjuk Pendaftaran Part 2"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
            <div class="vid-info">
              <h6>Panduan Pendaftaran Bagian 2</h6>
              <p>Cara pembayaran PIN, melengkapi data registrasi, dan mencetak kartu peserta</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ===== CTA ===== -->
  <section class="cta-section">
    <div class="container position-relative" style="z-index:2">
      <div data-aos="fade-up">
        <h2>Siap Bergabung Bersama Kami?</h2>
        <p>Daftarkan diri Anda sekarang dan mulai perjalanan akademik Anda di STAI Sabilussalam.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <?php if (isset($_SESSION["role"])): ?>
            <a href="<?= BASE_URL ?>/dashboard/" class="btn-cta-white">
              Masuk ke Dashboard
              <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
            </a>
          <?php else: ?>
            <a href="<?= BASE_URL ?>/daftar/" class="btn-cta-white">
              Daftar Sekarang
              <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
            </a>
            <a href="<?= BASE_URL ?>/masuk/" class="btn-cta-outline">Sudah Punya Akun? Masuk</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php include __DIR__ . '/../footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 750, once: true, offset: 60 });
  </script>

</body>

</html>