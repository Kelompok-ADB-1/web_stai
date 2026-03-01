<?php
require_once __DIR__ . '/../../config.php';
 ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendidikan Agama Islam - STAI Sabilussalam</title>
  <meta name="description"
    content="Program Studi Pendidikan Agama Islam STAI Sabilussalam mencetak tenaga pendidik profesional yang berintegritas, kompeten, dan berkarakter Islami.">

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
      --teal: #0d7a6e;
      --teal-light: #e0f5f2;
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
      background: linear-gradient(135deg, #0d5c4a 0%, var(--teal) 50%, var(--primary-main) 100%);
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
      color: var(--teal);
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
      background: linear-gradient(135deg, var(--teal), var(--primary-main));
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
      background: linear-gradient(135deg, #0d5c4a, var(--teal));
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
      background: linear-gradient(180deg, var(--teal), var(--primary-main));
      border-radius: 4px 0 0 4px;
      transition: width 0.3s;
    }

    .mk-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 40px rgba(13, 122, 110, 0.12);
      border-color: transparent;
    }

    .mk-card:hover::before {
      width: 6px;
    }

    .mk-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, var(--teal-light), #c3ece7);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .mk-icon span {
      color: var(--teal);
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
      background: var(--teal-light);
      color: var(--teal);
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
      border-color: #ADCE24;
      transform: translateY(-6px);
      box-shadow: 0 12px 32px rgba(13, 122, 110, 0.1);
    }

    .karir-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--teal), #0d5c4a);
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

    /* ===== INFO SECTION ===== */
    .info-section {
      padding: 80px 0;
      background: linear-gradient(135deg, var(--teal-light), #d4f0eb);
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
      color: var(--teal);
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
      background: var(--teal);
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* ===== VISI MISI ===== */
    .visimisi-section {
      padding: 80px 0;
      background: white;
    }

    .visimisi-card {
      border-radius: 20px;
      padding: 36px 28px;
      height: 100%;
    }

    .vm-visi {
      background: linear-gradient(135deg, #0d5c4a, var(--teal));
      color: white;
    }

    .vm-misi {
      background: #f6f8f5;
      border: 2px solid #e0f5f2;
    }

    .vm-misi h3 {
      color: var(--teal);
    }

    .vm-label {
      font-size: 0.8rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      opacity: 0.75;
      margin-bottom: 10px;
    }

    .vm-visi .vm-label {
      color: rgba(255, 255, 255, 0.75);
    }

    .vm-misi-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .vm-misi-list li {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      padding: 8px 0;
      font-size: 0.9rem;
      color: #444;
      border-bottom: 1px solid #eee;
    }

    .vm-misi-list li:last-child {
      border-bottom: none;
    }

    .vm-misi-list .num {
      font-weight: 700;
      color: var(--teal);
      flex-shrink: 0;
    }

    /* ===== CTA ===== */
    .cta-section {
      padding: 100px 0;
      background: linear-gradient(135deg, #0d5c4a 0%, var(--teal) 50%, var(--primary-main) 100%);
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
      <div class="container position-relative" style="z-index:2;text-align:center">
        <div data-aos="fade-up">
          <div class="hero-badge">📚 Program Studi Pendidikan</div>
          <h1 class="mb-3">Pendidikan <br>Agama Islam</h1>
          <p class="lead mb-4" style="opacity:0.9;max-width:580px;margin:0 auto 28px;">
            Mencetak tenaga pendidik profesional yang berintegritas, kompeten, dan berkarakter Islami untuk generasi
            masa
            depan bangsa.
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
            <span class="num">S.Pd.I.</span>
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
                src="https://st.depositphotos.com/1003697/53141/i/450/depositphotos_531419522-stock-photo-two-muslim-people-mosque-reading.jpg"
                alt="Pendidikan Agama Islam"
                onerror="this.style.background='linear-gradient(135deg,#0d5c4a,#0d7a6e)';this.removeAttribute('src')">
              <div class="about-badge-float">
                <div class="icon-circle">
                  <span class="material-symbols-outlined">school</span>
                </div>
                <div>
                  <div style="font-weight:700;font-size:0.9rem;color:#111">Prodi Pendidikan Agama Islam</div>
                  <div style="font-size:0.78rem;color:#666">STAI Sabilussalam</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left">
            <span class="section-eyebrow">Tentang Program Studi</span>
            <h2 class="section-title mb-3">Mendidik Generasi <span>Islami</span> yang Profesional &amp; Berdedikasi</h2>
            <p class="text-muted mb-4" style="line-height:1.8">
              Program Studi Pendidikan Agama Islam (PAI) bertujuan menghasilkan pendidik yang profesional dalam bidang
              pendidikan Islam, baik di sekolah formal maupun non-formal. Mahasiswa dibekali dengan ilmu pedagogik,
              metodologi pembelajaran, manajemen pendidikan, serta penguatan nilai-nilai keislaman.
            </p>

            <ul class="about-list">
              <li>
                <span class="check">•</span>
                <span>Kurikulum berbasis Merdeka Belajar (MBKM) yang inovatif dan adaptif</span>
              </li>
              <li>
                <span class="heck">•</span>
                <span>Praktik mengajar langsung di sekolah mitra sejak semester awal</span>
              </li>
              <li>
                <span class="check">•</span>
                <span>Dosen berpengalaman di bidang pendidikan Islam &amp; profesional</span>
              </li>
              <li>
                <span class="check">•</span>
                <span>Program pembinaan karakter Islami &amp; kepemimpinan mahasiswa</span>
              </li>
              <li>
                <span class="check">•</span>
                <span>Jaringan sekolah mitra yang luas untuk penempatan kerja lulusan</span>
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


      <!-- ===== VISI MISI ===== -->
      <section class="visimisi-section" id="visimisi">
        <div class="container">
          <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-eyebrow">Arah &amp; Tujuan</span>
            <h2 class="section-title">Visi &amp; <span>Misi</span> Prodi</h2>
          </div>

          <div class="row g-4">
            <div class="col-md-5" data-aos="fade-right">
              <div class="visimisi-card vm-visi">
                <div class="vm-label">🌟 Visi</div>
                <h3 class="fw-bold mb-3">Menjadi Prodi PAI Unggulan yang Menghasilkan Pendidik Islami Berkualitas</h3>
                <p style="opacity:0.9;line-height:1.8;font-size:0.95rem">
                  Pada tahun 2030, Program Studi PAI STAI Sabilussalam menjadi program studi terdepan dalam mencetak
                  pendidik agama Islam yang unggul, berakhlak mulia, profesional, dan berdaya saing nasional.
                </p>
              </div>
            </div>

            <div class="col-md-7" data-aos="fade-left">
              <div class="visimisi-card vm-misi">
                <div class="vm-label" style="color:var(--teal)">🎯 Misi</div>
                <h3>Langkah Kami Mewujudkan Visi</h3>
                <ul class="vm-misi-list mt-3">
                  <li><span class="num">01</span>Menyelenggarakan pendidikan dan pengajaran PAI yang berkualitas,
                    inovatif,
                    dan berbasis teknologi.</li>
                  <li><span class="num">02</span>Melaksanakan penelitian dan pengembangan ilmu pendidikan Islam yang
                    relevan
                    dengan kebutuhan masyarakat.</li>
                  <li><span class="num">03</span>Mengembangkan kerjasama dengan lembaga pendidikan, pemerintah, dan
                    masyarakat dalam dan luar negeri.</li>
                  <li><span class="num">04</span>Membina mahasiswa berkarakter Islami, berjiwa pemimpin, dan berwawasan
                    kebangsaan.</li>
                  <li><span class="num">05</span>Melaksanakan pengabdian masyarakat berbasis nilai-nilai pendidikan
                    Islam
                    untuk kemaslahatan umat.</li>
                </ul>
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
              Dirancang untuk membentuk pendidik yang kompeten, inovatif, dan berjiwa Islami dalam menghadapi tantangan
              pendidikan modern.
            </p>
          </div>

          <div class="row g-4">

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
              <div class="mk-card">
                <div class="mk-icon"><span class="material-symbols-outlined">menu_book</span></div>
                <h5>Metodologi Pembelajaran PAI</h5>
                <p>Strategi dan teknik mengajar yang efektif dan inovatif dalam menyampaikan materi pendidikan agama
                  Islam.
                </p>
                <span class="mk-sem-badge">Semester 3–4</span>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="mk-card">
                <div class="mk-icon"><span class="material-symbols-outlined">psychology</span></div>
                <h5>Psikologi Pendidikan</h5>
                <p>Pemahaman mendalam tentang perkembangan karakter, kognitif, dan emosional peserta didik dalam konteks
                  Islam.</p>
                <span class="mk-sem-badge">Semester 2–3</span>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="mk-card">
                <div class="mk-icon"><span class="material-symbols-outlined">workspace_premium</span></div>
                <h5>Manajemen Pendidikan Islam</h5>
                <p>Tata kelola, administrasi, dan kepemimpinan dalam lembaga pendidikan Islam formal maupun non-formal.
                </p>
                <span class="mk-sem-badge">Semester 5–6</span>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
              <div class="mk-card">
                <div class="mk-icon"><span class="material-symbols-outlined">auto_stories</span></div>
                <h5>Tafsir &amp; Hadits Tarbawi</h5>
                <p>Kajian ayat-ayat Al-Qur'an dan hadits Nabi yang berkaitan dengan pendidikan, akhlak, dan pengembangan
                  diri.</p>
                <span class="mk-sem-badge">Semester 1–2</span>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="mk-card">
                <div class="mk-icon"><span class="material-symbols-outlined">diversity_3</span></div>
                <h5>Pendidikan Karakter Islami</h5>
                <p>Pengembangan modul dan implementasi pendidikan karakter berbasis nilai-nilai akhlakul karimah di
                  sekolah.
                </p>
                <span class="mk-sem-badge">Semester 4–5</span>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="mk-card">
                <div class="mk-icon"><span class="material-symbols-outlined">star</span></div>
                <h5>Praktik Pengalaman Lapangan</h5>
                <p>Program PPL intensif di sekolah mitra untuk membangun kompetensi mengajar secara langsung dan
                  profesional.</p>
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
              Lulusan PAI memiliki peluang karir yang luas di bidang pendidikan, dakwah, dan manajemen lembaga Islam.
            </p>
          </div>

          <div class="row g-4">

            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
              <div class="karir-card">
                <div class="karir-icon"><span class="material-symbols-outlined">menu_book</span></div>
                <h5>Guru PAI</h5>
                <p>Mengajar Pendidikan Agama Islam di SD, SMP, SMA/SMK negeri maupun swasta di seluruh Indonesia.</p>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <div class="karir-card">
                <div class="karir-icon"><span class="material-symbols-outlined">school</span></div>
                <h5>Dosen &amp; Akademisi</h5>
                <p>Melanjutkan S2/S3 untuk berkarir sebagai dosen atau peneliti di perguruan tinggi Islam.</p>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
              <div class="karir-card">
                <div class="karir-icon"><span class="material-symbols-outlined">workspace_premium</span></div>
                <h5>Pengelola Lembaga Pendidikan</h5>
                <p>Kepala sekolah, wakil kepala, atau administrator di pondok pesantren &amp; madrasah.</p>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
              <div class="karir-card">
                <div class="karir-icon"><span class="material-symbols-outlined">diversity_3</span></div>
                <h5>Da'i &amp; Penyuluh Agama</h5>
                <p>Berkarir sebagai penyuluh agama Islam di Kemenag, konselor keluarga, atau tokoh dakwah masyarakat.
                </p>
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
                  <li><span class="dot"></span>Gelar: Sarjana Pendidikan Islam (S.Pd.I.)</li>
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
                  <li><span class="dot"></span>Skripsi (Penelitian Pendidikan)</li>
                  <li><span class="dot"></span>Praktik Pengalaman Lapangan (PPL)</li>
                  <li><span class="dot"></span>Magang MBKM di Lembaga Pendidikan</li>
                  <li><span class="dot"></span>Proyek Sosial / KKN Tematik</li>
                  <li><span class="dot"></span>Ujian Komprehensif Agama</li>
                </ul>
              </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
              <div class="info-card">
                <h4>🏛️ Fasilitas Pendukung</h4>
                <ul class="info-list">
                  <li><span class="dot"></span>Laboratorium Micro-Teaching</li>
                  <li><span class="dot"></span>Perpustakaan Ilmu Pendidikan Islam</li>
                  <li><span class="dot"></span>Studio Multimedia Pembelajaran</li>
                  <li><span class="dot"></span>Ruang Baca &amp; Diskusi Al-Qur'an</li>
                  <li><span class="dot"></span>80+ Sekolah Mitra PPL</li>
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
            <h2>Siap Menjadi Pendidik<br>Generasi Islami?</h2>
            <p>Bergabunglah bersama ratusan mahasiswa PAI yang telah memilih jalan mulia sebagai pendidik umat.</p>
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