<?php
require_once __DIR__ . '/../../config.php';
 ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hukum Ekonomi Syariah - STAI Sabilussalam</title>
  <meta name="description"
    content="Program Studi Hukum Ekonomi Syariah STAI Sabilussalam mencetak sarjana hukum Islam yang profesional, berintegritas, dan kompeten dalam bidang ekonomi & keuangan syariah.">

  <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/logo_stai-01.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <style>
    :root {
      --primary-main: #109335;
      --primary-dark: #1A6034;
      --primary-light: #ADCE24;
      --accent-main: #F9A856;
      --gold: #C9A84C;
      --gold-light: #F5D87E;
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
    .hero-jurusan {
      position: relative;
      background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-main) 60%, #1db954 100%);
      color: white;
      padding: 110px 0 90px;
      overflow: hidden;
    }

    .hero-jurusan::before {
      content: '';
      position: absolute;
      top: -80px;
      right: -80px;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
    }

    .hero-jurusan::after {
      content: '';
      position: absolute;
      bottom: -100px;
      left: -60px;
      width: 300px;
      height: 300px;
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
      letter-spacing: 0.5px;
      margin-bottom: 20px;
    }

    .hero-jurusan h1 {
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      line-height: 1.2;
    }

    .hero-stats {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 50px;
      flex-wrap: wrap;
    }

    .hero-stat {
      text-align: center;
    }

    .hero-stat .num {
      font-size: 2rem;
      font-weight: 700;
      display: block;
    }

    .hero-stat .label {
      font-size: 0.8rem;
      opacity: 0.8;
    }

    .hero-divider {
      width: 1px;
      background: rgba(255, 255, 255, 0.3);
      align-self: stretch;
    }

    /* ===== BUTTONS ===== */
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

    .btn-hero-outline {
      background: transparent;
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.6);
      border-radius: 50px;
      padding: 12px 32px;
      font-weight: 600;
      font-size: 0.95rem;
      font-family: 'Signika', sans-serif;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-hero-outline:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: white;
      color: white;
    }

    /* ===== SECTIONS ===== */
    section {
      scroll-margin-top: 80px;
    }

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
      margin-bottom: 14px;
    }

    .section-title {
      font-size: clamp(1.6rem, 3vw, 2.4rem);
      font-weight: 700;
      line-height: 1.25;
      color: #111;
    }

    .section-title span {
      color: var(--primary-main);
    }

    /* ===== ABOUT SECTION ===== */
    .about-section {
      padding: 90px 0;
      background: white;
    }

    .about-img-wrap {
      position: relative;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    }

    .about-img-wrap img {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }

    .about-badge-float {
      position: absolute;
      bottom: 24px;
      left: 24px;
      background: white;
      border-radius: 16px;
      padding: 12px 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .about-badge-float .icon-circle {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary-main), var(--primary-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .about-badge-float .icon-circle span {
      color: white;
      font-size: 18px;
    }

    .about-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .about-list li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 10px 0;
      border-bottom: 1px solid #f0f0f0;
      font-size: 0.95rem;
      color: #444;
    }

    .about-list li:last-child {
      border-bottom: none;
    }

    .about-list .check {
      color: var(--primary-main);
      font-size: 20px;
      margin-top: 1px;
      flex-shrink: 0;
    }

    /* ===== STATS BAR ===== */
    .stats-bar {
      background: linear-gradient(135deg, var(--primary-dark), var(--primary-main));
      padding: 50px 0;
    }

    .stat-item {
      text-align: center;
      color: white;
    }

    .stat-item .big-num {
      font-size: 2.8rem;
      font-weight: 700;
      display: block;
      line-height: 1;
    }

    .stat-item .big-label {
      font-size: 0.85rem;
      opacity: 0.85;
      margin-top: 6px;
    }

    .stat-divider {
      width: 1px;
      background: rgba(255, 255, 255, 0.25);
    }

    /* ===== MATAKULIAH SECTION ===== */
    .matakuliah-section {
      padding: 90px 0;
      background: #f6f8f5;
    }

    .mk-card {
      background: white;
      border-radius: 20px;
      padding: 28px 24px;
      border: 1px solid #e8eae8;
      transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
      height: 100%;
      position: relative;
      overflow: hidden;
    }

    .mk-card::before {
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

    .mk-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 40px rgba(16, 147, 53, 0.12);
      border-color: transparent;
    }

    .mk-card:hover::before {
      width: 6px;
    }

    .mk-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #e8f5ee, #d4edda);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .mk-icon span {
      color: var(--primary-dark);
      font-size: 22px;
    }

    .mk-card h5 {
      font-size: 1rem;
      font-weight: 700;
      color: #111;
      margin-bottom: 8px;
    }

    .mk-card p {
      font-size: 0.875rem;
      color: #666;
      line-height: 1.6;
      margin: 0;
    }

    .mk-sem-badge {
      display: inline-block;
      background: #f0f9f3;
      color: var(--primary-dark);
      border-radius: 20px;
      padding: 2px 10px;
      font-size: 0.75rem;
      font-weight: 600;
      margin-top: 12px;
    }

    /* ===== KARIR SECTION ===== */
    .karir-section {
      padding: 90px 0;
      background: white;
    }

    .karir-card {
      background: #f6f8f5;
      border-radius: 20px;
      padding: 32px 24px;
      text-align: center;
      transition: all 0.3s;
      border: 2px solid transparent;
      height: 100%;
    }

    .karir-card:hover {
      background: white;
      border-color: var(--primary-light);
      transform: translateY(-6px);
      box-shadow: 0 12px 32px rgba(16, 147, 53, 0.1);
    }

    .karir-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--primary-main), var(--primary-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
    }

    .karir-icon span {
      color: white;
      font-size: 30px;
    }

    .karir-card h5 {
      font-weight: 700;
      color: #111;
      margin-bottom: 10px;
      font-size: 1rem;
    }

    .karir-card p {
      font-size: 0.85rem;
      color: #666;
      margin: 0;
      line-height: 1.6;
    }

    /* ===== AKREDITASI / INFO SECTION ===== */
    .info-section {
      padding: 80px 0;
      background: linear-gradient(135deg, #f0f9f3, #e8f5ee);
    }

    .info-card {
      background: white;
      border-radius: 20px;
      padding: 30px 28px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      height: 100%;
    }

    .info-card h4 {
      font-weight: 700;
      color: var(--primary-dark);
      margin-bottom: 16px;
    }

    .info-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .info-list li {
      padding: 8px 0;
      border-bottom: 1px solid #f0f0f0;
      font-size: 0.9rem;
      color: #444;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .info-list li:last-child {
      border-bottom: none;
    }

    .info-list .dot {
      width: 8px;
      height: 8px;
      background: var(--primary-main);
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* ===== CTA SECTION ===== */
    .cta-section {
      padding: 100px 0;
      background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-main) 100%);
      position: relative;
      overflow: hidden;
      text-align: center;
      color: white;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: -100px;
      right: -100px;
      width: 350px;
      height: 350px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
    }

    .cta-section h2 {
      font-size: clamp(1.8rem, 4vw, 2.8rem);
      font-weight: 700;
    }

    .cta-section p {
      opacity: 0.85;
      font-size: 1.05rem;
      max-width: 540px;
      margin: 0 auto 36px;
    }



    /* ===== UTILITIES ===== */
    .text-primary-green {
      color: var(--primary-main);
    }

    @media (max-width: 768px) {
      .hero-stat .num {
        font-size: 1.5rem;
      }

      .hero-divider {
        display: none;
      }

      .hero-stats {
        gap: 20px;
      }
    }
  </style>
</head>

<body>
  
  <!-- ===== NAVBAR ===== -->
  <?php include __DIR__ . '/../../navbar.php'; ?>



  <!-- ===== HERO ===== -->
  <section class="hero-jurusan" id="hero">
    <div class="container position-relative" style="z-index:2">
      <div data-aos="fade-up" style="align-items: center; text-align: center;">
        <div class=" hero-badge" style="align-items: center; text-align: center;">⚖️ Program Studi Unggulan</div>
        <h1 class="mb-3" style="align-items: center; text-align: center;">Hukum Ekonomi <br>Syariah</h1>
        <p class="lead mb-4" style="opacity:0.9;max-width:580px;margin:0 auto 28px;">
          Mencetak Sarjana Hukum Islam yang profesional, berintegritas, dan kompeten dalam bidang ekonomi &amp; keuangan
          syariah.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <?php if (isset($_SESSION["role"])): ?>
            <a href="<?= BASE_URL ?>/dashboard/" class="btn-hero-primary">
              Masuk ke Dashboard
              <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
            </a>
          <?php else: ?>
            <a href="<?= BASE_URL ?>/daftar/" class="btn-hero-primary">
              Daftar Sekarang
              <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
            </a>
          <?php endif; ?>
          <a href="#tentang" class="btn-hero-outline">Pelajari Lebih Lanjut</a>
        </div>
      </div>

      <div class="hero-stats" data-aos="fade-up" data-aos-delay="200">
        <div class="hero-stat">
          <span class="num">4 Tahun</span>
          <span class="label">Masa Studi</span>
        </div>
        <div class="hero-divider"></div>
        <div class="hero-stat">
          <span class="num">S.H.</span>
          <span class="label">Gelar Akademik</span>
        </div>
        <div class="hero-divider"></div>
        <div class="hero-stat">
          <span class="num">144 SKS</span>
          <span class="label">Total Kredit</span>
        </div>
        <div class="hero-divider"></div>
        <div class="hero-stat">
          <span class="num">Terakreditasi</span>
          <span class="label">BAN-PT</span>
        </div>
      </div>
    </div>
  </section>


  <!-- ===== TENTANG PRODI ===== -->
  <section class="about-section" id="tentang">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-5" data-aos="fade-right">
          <div class="about-img-wrap">
            <img
              src="https://media.istockphoto.com/id/1380403567/id/foto/hukum-syariah-palu-palu-skala-libra-dan-alquran.jpg?s=612x612&w=0&k=20&c=WkZ8c7L1Sg2MfsAxVv6It0-MfMoZ3DGfAvGfybvN8hE="
              alt="Studi Hukum Ekonomi Syariah"
              onerror="this.style.background='linear-gradient(135deg,#1A6034,#109335)';this.removeAttribute('src')">
            <div class="about-badge-float">
              <div class="icon-circle">
                <span class="material-symbols-outlined">school</span>
              </div>
              <div>
                <div style="font-weight:700;font-size:0.9rem;color:#111">Prodi Hukum Ekonomi Syariah</div>
                <div style="font-size:0.78rem;color:#666">STAI Sabilussalam</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-7" data-aos="fade-left">
          <span class="section-eyebrow">Tentang Program Studi</span>
          <h2 class="section-title mb-3">Mendalami Hukum <span>Islam</span> dalam Ranah Ekonomi Modern</h2>
          <p class="text-muted mb-4" style="line-height:1.8">
            Program Studi Hukum Ekonomi Syariah (HES) mempelajari hukum Islam dalam bidang ekonomi, perbankan syariah,
            bisnis halal, serta penyelesaian sengketa ekonomi berbasis prinsip syariah. Mahasiswa dibekali ilmu fiqh
            muamalah, hukum positif, regulasi keuangan syariah, serta praktik langsung di lembaga mitra.
          </p>

          <ul class="about-list">
            <li>
              <span class="check">•</span>
              <span>Kurikulum berbasis KKNI &amp; MBKM yang relevan dengan kebutuhan industri</span>
            </li>
            <li>
              <span class="check">•</span>
              <span>Dosen profesional, praktisi hukum &amp; ekonomi syariah berpengalaman</span>
            </li>
            <li>
              <span class="check">•</span>
              <span>Program magang di lembaga keuangan syariah &amp; pengadilan agama</span>
            </li>
            <li>
              <span class="check">•</span>
              <span>Fasilitas perpustakaan hukum &amp; laboratorium keuangan syariah</span>
            </li>
            <li>
              <span class="check">•</span>
              <span>Jaringan alumni luas di sektor hukum, perbankan &amp; pemerintahan</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>


  <!-- ===== STATS BAR ===== -->
  <section class="stats-bar">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center g-4">

        <div class="col-6 col-md-3" data-aos="zoom-in">
          <div class="stat-item">
            <span class="big-num">10+</span>
            <div class="big-label">Dosen &amp; Pengajar</div>
          </div>
        </div>

        <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
          <div class="stat-item">
            <span class="big-num">5+</span>
            <div class="big-label">Sekolah Mitra PPL</div>
          </div>
        </div>

        <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
          <div class="stat-item">
            <span class="big-num">1</span>
            <div class="big-label">Tahun Berdiri</div>
          </div>
        </div>

      </div>
    </div>
  </section>


    <!-- ===== MATA KULIAH ===== -->
    <section class="matakuliah-section" id="matakuliah">
      <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
          <span class="section-eyebrow">Kurikulum</span>
          <h2 class="section-title">Mata Kuliah <span>Unggulan</span></h2>
          <p class="text-muted mt-3" style="max-width:560px;margin:0 auto">
            Dirancang untuk membangun kompetensi hukum Islam yang kuat dan relevan dengan kebutuhan industri modern.
          </p>
        </div>

        <div class="row g-4">

          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
            <div class="mk-card">
              <div class="mk-icon"><span class="material-symbols-outlined">balance</span></div>
              <h5>Fiqh Muamalah</h5>
              <p>Dasar-dasar hukum transaksi dalam Islam mencakup jual beli, sewa, mudharabah, musyarakah, dan akad
                syariah lainnya.</p>
              <span class="mk-sem-badge">Semester 1–2</span>
            </div>
          </div>

          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="mk-card">
              <div class="mk-icon"><span class="material-symbols-outlined">account_balance</span></div>
              <h5>Perbankan Syariah</h5>
              <p>Studi mendalam tentang operasional, regulasi, dan produk-produk bank syariah di Indonesia dan global.
              </p>
              <span class="mk-sem-badge">Semester 3–4</span>
            </div>
          </div>

          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="mk-card">
              <div class="mk-icon"><span class="material-symbols-outlined">gavel</span></div>
              <h5>Hukum Bisnis Syariah</h5>
              <p>Regulasi bisnis berbasis prinsip Islam yang mencakup hukum perusahaan, pailit, dan kontrak komersial
                syariah.</p>
              <span class="mk-sem-badge">Semester 3–4</span>
            </div>
          </div>

          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
            <div class="mk-card">
              <div class="mk-icon"><span class="material-symbols-outlined">trending_up</span></div>
              <h5>Ekonomi Syariah</h5>
              <p>Prinsip-prinsip sistem ekonomi Islam, distribusi kekayaan, zakat, wakaf, dan kebijakan ekonomi syariah.
              </p>
              <span class="mk-sem-badge">Semester 2–3</span>
            </div>
          </div>

          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="mk-card">
              <div class="mk-icon"><span class="material-symbols-outlined">work</span></div>
              <h5>Hukum Keluarga Islam</h5>
              <p>Hukum perkawinan, waris, wakaf, dan peradilan agama sesuai kompilasi hukum Islam yang berlaku di
                Indonesia.</p>
              <span class="mk-sem-badge">Semester 5–6</span>
            </div>
          </div>

          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="mk-card">
              <div class="mk-icon"><span class="material-symbols-outlined">star</span></div>
              <h5>Arbitrase &amp; Mediasi Syariah</h5>
              <p>Teknik penyelesaian sengketa ekonomi syariah melalui jalur arbitrase, mediasi, dan Basyarnas.</p>
              <span class="mk-sem-badge">Semester 7</span>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- ===== PROSPEK KARIR ===== -->
    <section class="karir-section" id="karir">
      <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
          <span class="section-eyebrow">Setelah Lulus</span>
          <h2 class="section-title">Prospek <span>Karir</span></h2>
          <p class="text-muted mt-3" style="max-width:540px;margin:0 auto">
            Lulusan HES memiliki peluang karir yang luas di berbagai sektor hukum, keuangan, dan pemerintahan.
          </p>
        </div>

        <div class="row g-4">

          <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
            <div class="karir-card">
              <div class="karir-icon"><span class="material-symbols-outlined">balance</span></div>
              <h5>Hakim &amp; Praktisi Hukum</h5>
              <p>Berkarir di Pengadilan Agama, firma hukum, atau sebagai advokat spesialis syariah.</p>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="karir-card">
              <div class="karir-icon"><span class="material-symbols-outlined">account_balance</span></div>
              <h5>Perbankan Syariah</h5>
              <p>Bekerja di Bank Syariah, pegadaian syariah, asuransi syariah (takaful), dan lembaga keuangan halal.</p>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="karir-card">
              <div class="karir-icon"><span class="material-symbols-outlined">trending_up</span></div>
              <h5>Auditor Syariah</h5>
              <p>Menjadi Dewan Pengawas Syariah (DPS), auditor syariah, atau konsultan kepatuhan halal.</p>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="karir-card">
              <div class="karir-icon"><span class="material-symbols-outlined">school</span></div>
              <h5>Akademisi &amp; Peneliti</h5>
              <p>Melanjutkan S2/S3 dan berkarir sebagai dosen, peneliti atau pengembang kebijakan ekonomi syariah.</p>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- ===== INFO SECTION ===== -->
    <section class="info-section" id="info">
      <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
          <span class="section-eyebrow">Informasi Penting</span>
          <h2 class="section-title">Detail <span>Program Studi</span></h2>
        </div>

        <div class="row g-4">

          <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
            <div class="info-card">
              <h4>📋 Informasi Umum</h4>
              <ul class="info-list">
                <li><span class="dot"></span>Jenjang: Strata 1 (S1)</li>
                <li><span class="dot"></span>Gelar: Sarjana Hukum (S.H.)</li>
                <li><span class="dot"></span>Masa Studi: 4 Tahun (8 Semester)</li>
                <li><span class="dot"></span>Total SKS: 144 SKS</li>
                <li><span class="dot"></span>Akreditasi: BAN-PT</li>
                <li><span class="dot"></span>Status: Aktif</li>
              </ul>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="info-card">
              <h4>🎯 Jalur Kelulusan</h4>
              <ul class="info-list">
                <li><span class="dot"></span>Skripsi (Penelitian Mandiri)</li>
                <li><span class="dot"></span>Magang Industri (MBKM)</li>
                <li><span class="dot"></span>Proyek Sosial / KKN Tematik</li>
                <li><span class="dot"></span>Program Pertukaran Mahasiswa</li>
                <li><span class="dot"></span>Ujian Komprehensif</li>
              </ul>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="info-card">
              <h4>🏛️ Fasilitas Pendukung</h4>
              <ul class="info-list">
                <li><span class="dot"></span>Perpustakaan Hukum Islam</li>
                <li><span class="dot"></span>Lab Keuangan &amp; Perbankan Syariah</li>
                <li><span class="dot"></span>Klinik Hukum Syariah</li>
                <li><span class="dot"></span>Ruang Moot Court (Sidang Semu)</li>
                <li><span class="dot"></span>Akses Jurnal Hukum Internasional</li>
                <li><span class="dot"></span>Beasiswa Prestasi &amp; Ekonomi</li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- ===== CTA ===== -->
    <section class="cta-section">
      <div class="container position-relative" style="z-index:2">
        <div data-aos="fade-up">
          <h2>Siap Menjadi Ahli<br>Hukum Ekonomi Syariah?</h2>
          <p>Bergabunglah bersama ratusan mahasiswa yang telah memilih masa depan di bidang hukum &amp; ekonomi Islam.
          </p>
          <div class="d-flex flex-wrap gap-3 justify-content-center">
            <?php if (isset($_SESSION["role"])): ?>
              <a href="<?= BASE_URL ?>/dashboard/" class="btn-hero-primary">
                Masuk ke Dashboard
                <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
              </a>
            <?php else: ?>
              <a href="<?= BASE_URL ?>/daftar/" class="btn-hero-primary">
                Daftar Sekarang
                <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
              </a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/petunjuk-pendaftaran/" class="btn-hero-outline">Lihat Petunjuk Pendaftaran</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <?php include __DIR__ . '/../../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 750, once: true, offset: 60 });
    </script>
</body>

</html>