<?php
require_once __DIR__ . '/../config.php';
 ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - STAI Sabilussalam</title>
  <meta name="description"
    content="Temukan jawaban atas pertanyaan yang sering diajukan seputar pendaftaran, biaya kuliah, program studi, dan kehidupan kampus STAI Sabilussalam.">
  <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/logo_stai-01.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">
  <style>
    :root {
      --pm: #109335;
      --pd: #1A6034;
      --pl: #ADCE24;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Signika', sans-serif;
      background: #f6f8f5;
      color: #1a1a1a;
      overflow-x: hidden;
      display: block !important;
    }



    .hero {
      background: linear-gradient(135deg, var(--pd), var(--pm) 65%, #1db954);
      color: white;
      padding: 80px 0 70px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -80px;
      right: -80px;
      width: 350px;
      height: 350px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .05);
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -80px;
      left: -60px;
      width: 260px;
      height: 260px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .06);
    }

    .hero-badge {
      display: inline-block;
      background: rgba(255, 255, 255, .18);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, .3);
      border-radius: 50px;
      padding: 6px 20px;
      font-size: .85rem;
      font-weight: 600;
      margin-bottom: 16px;
    }

    .hero h1 {
      font-size: clamp(2rem, 5vw, 3.2rem);
      font-weight: 700;
    }

    /* Search */
    .search-wrap {
      max-width: 520px;
      margin: 24px auto 0;
      position: relative;
    }

    .search-wrap input {
      width: 100%;
      border: none;
      border-radius: 50px;
      padding: 14px 20px 14px 50px;
      font-family: 'Signika', sans-serif;
      font-size: .95rem;
      outline: none;
      box-shadow: 0 4px 20px rgba(0, 0, 0, .12);
    }

    .search-wrap .s-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
      font-size: 22px;
    }

    /* Category tabs */
    .cats {
      padding: 50px 0 0;
      background: white;
    }

    .cat-tabs {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .cat-tab {
      background: #f6f8f5;
      border: 2px solid #e0e0e0;
      border-radius: 16px;
      padding: 12px 20px;
      font-size: .875rem;
      font-weight: 600;
      font-family: 'Signika', sans-serif;
      cursor: pointer;
      transition: all .25s;
      color: #555;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .cat-tab.active,
    .cat-tab:hover {
      background: #e8f5ee;
      border-color: var(--pm);
      color: var(--pd);
    }

    /* FAQ accordion */
    .faq-section {
      padding: 40px 0 80px;
      background: white;
    }

    .faq-group {
      margin-bottom: 48px;
    }

    .faq-group-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--pd);
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
      padding-bottom: 12px;
      border-bottom: 2px solid #e8f5ee;
    }

    .faq-item {
      background: #f9fbf9;
      border-radius: 16px;
      border: 1px solid #e4eae4;
      margin-bottom: 10px;
      overflow: hidden;
      transition: all .3s;
    }

    .faq-item.open {
      background: white;
      box-shadow: 0 4px 20px rgba(16, 147, 53, .08);
      border-color: rgba(16, 147, 53, .2);
    }

    .faq-q {
      width: 100%;
      background: none;
      border: none;
      padding: 18px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      cursor: pointer;
      font-family: 'Signika', sans-serif;
      font-size: .95rem;
      font-weight: 600;
      color: #111;
      text-align: left;
      transition: color .2s;
    }

    .faq-item.open .faq-q {
      color: var(--pd);
    }

    .faq-q .icon-toggle {
      color: var(--pm);
      font-size: 22px;
      flex-shrink: 0;
      transition: transform .3s;
    }

    .faq-item.open .icon-toggle {
      transform: rotate(45deg);
    }

    .faq-a {
      max-height: 0;
      overflow: hidden;
      transition: max-height .4s ease, padding .3s;
    }

    .faq-item.open .faq-a {
      max-height: 400px;
    }

    .faq-a-inner {
      padding: 0 20px 18px;
      color: #555;
      font-size: .9rem;
      line-height: 1.75;
    }

    .faq-a-inner a {
      color: var(--pm);
      text-decoration: none;
      font-weight: 600;
    }

    .faq-a-inner a:hover {
      text-decoration: underline;
    }

    /* Kontak card */
    .kontak-section {
      padding: 60px 0;
      background: #f6f8f5;
    }

    .kontak-card {
      background: white;
      border-radius: 20px;
      padding: 28px 24px;
      border: 1px solid #e4eae4;
      text-align: center;
      height: 100%;
      transition: all .3s;
    }

    .kontak-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, .08);
    }

    .kontak-icon {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--pm), var(--pd));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 14px;
    }

    .kontak-icon span {
      color: white;
      font-size: 26px;
    }

    .kontak-card h5 {
      font-weight: 700;
      color: #111;
      font-size: .95rem;
      margin-bottom: 6px;
    }

    .kontak-card p {
      font-size: .85rem;
      color: #777;
      margin: 0;
    }

    .kontak-card a {
      color: var(--pm);
      font-weight: 600;
      text-decoration: none;
    }

    /* CTA */
    .cta {
      padding: 130px 0;
      background: linear-gradient(135deg, var(--pd), var(--pm));
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .cta::before {
      content: '';
      position: absolute;
      top: -80px;
      right: -80px;
      width: 280px;
      height: 280px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .05);
    }

    .cta h2 {
      font-size: clamp(1.6rem, 3.5vw, 2.4rem);
      font-weight: 700;
    }

    .cta p {
      opacity: .88;
      max-width: 460px;
      margin: 0 auto 28px;
    }

    .btn-w {
      background: white;
      color: var(--pd);
      border: none;
      border-radius: 50px;
      padding: 12px 32px;
      font-weight: 700;
      font-family: 'Signika', sans-serif;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all .3s;
      font-size: .95rem;
    }

    .btn-w:hover {
      background: var(--primary-main);
      color: var(--white);
      transform: translateY(-2px);
    }

    .btn-o {
      background: transparent;
      color: white;
      border: 2px solid rgba(255, 255, 255, .6);
      border-radius: 50px;
      padding: 12px 28px;
      font-weight: 600;
      font-family: 'Signika', sans-serif;
      text-decoration: none;
      transition: all .3s;
      font-size: .95rem;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-o:hover {
      background: rgba(255, 255, 255, .15);
      border-color: white;
      color: white;
    }


  </style>
</head>

<body>

  <?php include __DIR__ . '/../navbar.php'; ?>

  <section class="hero">
    <div class="container position-relative" style="z-index:2">
      <div data-aos="fade-up">
        <div class="hero-badge">❓ Pusat Bantuan</div>
        <h1 class="mb-3">Pertanyaan yang Sering Diajukan</h1>
        <p style="opacity:.9;max-width:520px;margin:0 auto 0;font-size:1.05rem">Temukan jawaban atas pertanyaan Anda
          seputar pendaftaran, biaya kuliah, program studi, dan kehidupan kampus.</p>
        <div class="search-wrap" data-aos="fade-up" data-aos-delay="100">
          <span class="material-symbols-outlined s-icon">search</span>
          <input type="text" id="faq-search" placeholder="Cari pertanyaan..." oninput="filterFAQ(this.value)">
        </div>
      </div>
    </div>
  </section>

  <section class="cats">
    <div class="container">
      <div class="cat-tabs" data-aos="fade-up">
        <button class="cat-tab active" onclick="filterCat('all',this)"><span class="material-symbols-outlined"
            style="font-size:18px">apps</span>Semua</button>
        <button class="cat-tab" onclick="filterCat('daftar',this)"><span class="material-symbols-outlined"
            style="font-size:18px">person_add</span>Pendaftaran</button>
        <button class="cat-tab" onclick="filterCat('biaya',this)"><span class="material-symbols-outlined"
            style="font-size:18px">payments</span>Biaya &amp; Beasiswa</button>
        <button class="cat-tab" onclick="filterCat('prodi',this)"><span class="material-symbols-outlined"
            style="font-size:18px">school</span>Program Studi</button>
        <button class="cat-tab" onclick="filterCat('kampus',this)"><span class="material-symbols-outlined"
            style="font-size:18px">apartment</span>Kehidupan Kampus</button>
        <button class="cat-tab" onclick="filterCat('akademik',this)"><span class="material-symbols-outlined"
            style="font-size:18px">menu_book</span>Akademik</button>
      </div>
    </div>
  </section>

  <section class="faq-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">

          <!-- Pendaftaran -->
          <div class="faq-group" data-cat="daftar" data-aos="fade-up">
            <div class="faq-group-title"><span class="material-symbols-outlined">person_add</span>Pendaftaran Mahasiswa
              Baru</div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Bagaimana cara mendaftar sebagai mahasiswa baru STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Pendaftaran dilakukan secara online melalui website ini. Klik tombol
                  <strong>Daftar</strong> di pojok kanan atas, isi form pembuatan akun, verifikasi email, lalu login dan
                  lengkapi data diri serta data registrasi. Lihat <a href="../petunjuk-pendaftaran/">Petunjuk
                    Pendaftaran</a> untuk panduan lengkap 5 langkah.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Kapan batas akhir pendaftaran mahasiswa baru?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Pendaftaran dibuka sepanjang tahun sesuai jadwal gelombang penerimaan.
                  Gelombang 1: Januari–April, Gelombang 2: Mei–Agustus, Gelombang 3: September–Desember. Pantau terus
                  website kami untuk info jadwal terbaru.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah ada tes masuk / seleksi untuk mendaftar?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">STAI Sabilussalam membuka beberapa jalur seleksi: <strong>Jalur
                    Prestasi</strong> (tanpa tes, berdasarkan nilai rapor), <strong>Jalur Reguler</strong> (tes tertulis
                  kemampuan dasar dan keislaman), serta <strong>Jalur Beasiswa</strong> (berdasarkan keunggulan
                  akademik/non-akademik).</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apa saja syarat dokumen yang perlu disiapkan saat mendaftar?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Dokumen yang perlu disiapkan: (1) Ijazah SMA/SMK/MA atau Surat Keterangan Lulus
                  (SKL), (2) Kartu Tanda Penduduk (KTP), (3) Kartu Keluarga, (4) Foto formal terbaru ukuran 4×6, (5)
                  Akta kelahiran (opsional). Semua dokumen di-scan dan diunggah secara online.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah ada batasan usia untuk mendaftar?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Tidak ada batasan usia. STAI Sabilussalam menerima calon mahasiswa dari semua
                  usia, termasuk mereka yang ingin kembali kuliah setelah bekerja. Yang penting adalah memiliki ijazah
                  SMA/SMK/MA atau sederajat.</div>
              </div>
            </div>
          </div>

          <!-- Biaya -->
          <div class="faq-group" data-cat="biaya" data-aos="fade-up">
            <div class="faq-group-title"><span class="material-symbols-outlined">payments</span>Biaya Kuliah &amp;
              Beasiswa</div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Berapa biaya kuliah per semester di STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Biaya kuliah bervariasi tergantung program studi dan jalur masuk. Untuk
                  informasi biaya terkini, silakan hubungi bagian administrasi STAI atau kunjungi halaman Biaya
                  Pendidikan di menu Seleksi. Kami juga menyediakan opsi cicilan untuk meringankan beban mahasiswa.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah tersedia beasiswa di STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya, STAI Sabilussalam menyediakan beberapa jenis beasiswa: <strong>Beasiswa
                    Prestasi Akademik</strong> (IPK tinggi), <strong>Beasiswa Ekonomi</strong> (mahasiswa kurang mampu),
                  <strong>Beasiswa Hafidz</strong> (penghafal Al-Qur'an), dan <strong>Beasiswa Prestasi
                    Non-Akademik</strong> (olahraga, seni, kepemimpinan). Info lengkap tersedia di bagian Beasiswa.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apa itu biaya PIN aktivasi dan bagaimana cara membayarnya?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">PIN aktivasi adalah biaya pendaftaran awal yang dibayarkan saat proses
                  registrasi untuk mengaktifkan akun pendaftaran Anda. Pembayaran dapat dilakukan melalui transfer bank
                  atau metode pembayaran digital. Lihat <a href="../petunjuk-pendaftaran/">Petunjuk Pendaftaran</a>
                  untuk detail cara bayar.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah biaya kuliah bisa dicicil?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya, STAI Sabilussalam memahami kondisi mahasiswa dan menyediakan opsi
                  pembayaran cicilan. Mahasiswa dapat mengajukan permohonan cicilan kepada bagian keuangan kampus dengan
                  menyertakan alasan dan bukti yang relevan. Tim kami akan membantu menemukan solusi terbaik.</div>
              </div>
            </div>
          </div>

          <!-- Program Studi -->
          <div class="faq-group" data-cat="prodi" data-aos="fade-up">
            <div class="faq-group-title"><span class="material-symbols-outlined">school</span>Program Studi</div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apa saja program studi yang tersedia di STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">STAI Sabilussalam saat ini membuka 2 program studi jenjang S1: (1) <a
                    href="../jurusan/hukum-ekonomi-syariah/">Hukum Ekonomi Syariah (HES)</a> dengan gelar Sarjana Hukum
                  (S.H.), dan (2) <a href="../jurusan/pendidikan-agama-islam/">Pendidikan Agama Islam (PAI)</a> dengan
                  gelar Sarjana Pendidikan Islam (S.Pd.I.).</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Berapa lama masa studi di STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Masa studi normal adalah 4 tahun (8 semester) dengan total beban studi 144 SKS.
                  Mahasiswa yang berprestasi dapat menempuh studi lebih cepat (3,5 tahun) melalui program akselerasi,
                  tergantung ketersediaan mata kuliah.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah prodi HES dan PAI sudah terakreditasi?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya, kedua program studi telah mendapat akreditasi dari BAN-PT (Badan Akreditasi
                  Nasional Perguruan Tinggi). Ijazah dan gelar yang dikeluarkan STAI Sabilussalam diakui secara resmi
                  oleh pemerintah dan lembaga-lembaga terkait.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah ada program magang atau PPL selama kuliah?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya. Mahasiswa HES mengikuti magang di lembaga keuangan syariah, pengadilan
                  agama, atau firma hukum mitra. Mahasiswa PAI mengikuti PPL (Praktik Pengalaman Lapangan) di sekolah
                  mitra. Keduanya difasilitasi kampus melalui lebih dari 80 lembaga mitra.</div>
              </div>
            </div>
          </div>

          <!-- Kehidupan Kampus -->
          <div class="faq-group" data-cat="kampus" data-aos="fade-up">
            <div class="faq-group-title"><span class="material-symbols-outlined">apartment</span>Kehidupan Kampus</div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Di mana lokasi kampus STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">STAI Sabilussalam berlokasi di Bandung, Jawa Barat. Kampus kami mudah dijangkau
                  dengan kendaraan umum maupun pribadi. Untuk informasi alamat lengkap dan peta lokasi, silakan hubungi
                  kami melalui kontak yang tersedia di halaman ini.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah tersedia asrama atau tempat tinggal mahasiswa?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">STAI Sabilussalam tidak menyediakan asrama sendiri, namun kami memiliki daftar
                  kos dan kontrakan yang sudah terverifikasi di sekitar kampus dengan harga terjangkau. Tim
                  kemahasiswaan siap membantu mahasiswa baru dalam mencari tempat tinggal.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apa saja fasilitas yang tersedia di kampus?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Fasilitas kampus mencakup: perpustakaan dengan koleksi buku hukum Islam dan
                  pendidikan, laboratorium komputer, laboratorium micro-teaching (untuk PAI), laboratorium keuangan
                  syariah (untuk HES), ruang sidang moot court, masjid kampus, kantin, dan area parkir.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah ada kegiatan organisasi mahasiswa di kampus?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya, STAI Sabilussalam memiliki berbagai unit kegiatan mahasiswa (UKM) seperti
                  UKM Dakwah, Tahfidz Qur'an, Debat Bahasa Arab, Seni Musik Islami, Olahraga, dan Pramuka. Ada juga BEM
                  (Badan Eksekutif Mahasiswa) dan Himpunan Mahasiswa per program studi.</div>
              </div>
            </div>
          </div>

          <!-- Akademik -->
          <div class="faq-group" data-cat="akademik" data-aos="fade-up">
            <div class="faq-group-title"><span class="material-symbols-outlined">menu_book</span>Akademik &amp;
              Perkuliahan</div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Bagaimana sistem perkuliahan di STAI Sabilussalam?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Perkuliahan dilaksanakan secara tatap muka dengan pendekatan blended learning
                  (kombinasi offline dan online). Mata kuliah dibagi dalam 8 semester dengan beban 18–22 SKS per
                  semester. Tersedia juga kelas malam untuk mahasiswa yang bekerja.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah tersedia kelas malam untuk mahasiswa yang bekerja?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya, STAI Sabilussalam menyediakan kelas reguler (pagi/siang) dan kelas malam
                  (17.00–21.00). Kelas malam dirancang khusus bagi mahasiswa yang memiliki pekerjaan di siang hari,
                  dengan kurikulum dan standar yang sama.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Bagaimana cara mengajukan cuti akademik?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Mahasiswa dapat mengajukan cuti akademik maksimal 2 semester selama masa studi
                  dengan mengisi formulir yang tersedia di bagian administrasi akademik. Pengajuan dilakukan paling
                  lambat 2 minggu setelah awal semester dengan menyertakan alasan yang valid.</div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-q" onclick="toggleFaq(this)">
                Apakah gelar dari STAI Sabilussalam diakui untuk kerja di instansi pemerintah?
                <span class="material-symbols-outlined icon-toggle">add</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">Ya, gelar Sarjana Hukum (S.H.) dan Sarjana Pendidikan Islam (S.Pd.I.) dari STAI
                  Sabilussalam diakui secara nasional dan dapat digunakan untuk melamar pekerjaan di instansi
                  pemerintah, BUMN, maupun swasta, termasuk untuk mengikuti seleksi CPNS (khususnya guru PAI dan hakim
                  Pengadilan Agama).</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- KONTAK -->
  <section class="kontak-section">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span
          style="display:inline-block;background:linear-gradient(135deg,#e8f5ee,#d0edda);color:var(--pd);border-radius:50px;padding:5px 18px;font-size:.82rem;font-weight:700;text-transform:uppercase;margin-bottom:12px">Masih
          Ada Pertanyaan?</span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.1rem);font-weight:700;color:#111">Hubungi Kami <span
            style="color:var(--pm)">Langsung</span></h2>
        <p class="text-muted mt-2" style="max-width:460px;margin:0 auto">Jika pertanyaan Anda belum terjawab di atas,
          tim kami siap membantu.</p>
      </div>
      <div class="row g-4 justify-content-center">

        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
          <div class="kontak-card">
            <div class="kontak-icon"><span class="material-symbols-outlined">phone</span></div>
            <h5>Telepon</h5>
            <p><a href="tel:+6222123456">+62 22 123 456</a><br><small>Senin–Jumat, 08.00–16.00</small></p>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <div class="kontak-card">
            <div class="kontak-icon"><span class="material-symbols-outlined">chat</span></div>
            <h5>WhatsApp</h5>
            <p><a href="https://wa.me/628123456789" target="_blank">+62 812 3456 789</a><br><small>Respon cepat &lt; 1
                jam</small></p>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
          <div class="kontak-card">
            <div class="kontak-icon"><span class="material-symbols-outlined">mail</span></div>
            <h5>Email</h5>
            <p><a href="mailto:pmb@stai-sabilussalam.ac.id">pmb@stai-sabilussalam.ac.id</a><br><small>Balasan dalam 1×24
                jam</small></p>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
          <div class="kontak-card">
            <div class="kontak-icon"><span class="material-symbols-outlined">location_on</span></div>
            <h5>Datang Langsung</h5>
            <p>Jl. Sabilussalam No. 1<br>Bandung, Jawa Barat<br><small>Buka Senin–Sabtu</small></p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="cta">
    <div class="container position-relative" style="z-index:2">
      <div data-aos="fade-up">
        <h2>Pertanyaan Terjawab? Siap Mendaftar?</h2>
        <p>Mulai perjalanan akademik Anda di STAI Sabilussalam sekarang.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <?php if (isset($_SESSION["role"])): ?>
            <a href="<?= BASE_URL ?>/dashboard/" class="btn-w">Masuk ke Dashboard <span class="material-symbols-outlined"
                style="font-size:18px">arrow_forward</span></a>
          <?php else: ?>
            <a href="<?= BASE_URL ?>/daftar/" class="btn-w">Daftar Sekarang <span class="material-symbols-outlined"
                style="font-size:18px">arrow_forward</span></a>
          <?php endif; ?>
          <a href="<?= BASE_URL ?>/petunjuk-pendaftaran/" class="btn-o">Petunjuk Pendaftaran</a>
        </div>
      </div>
    </div>
  </section>
  <?php include __DIR__ . '/../footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 750, once: true, offset: 60 });

    function toggleFaq(btn) {
      const item = btn.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
      
      // Refresh AOS because page height changed
      setTimeout(() => { AOS.refresh(); }, 400); // Wait for transition
    }

    function filterCat(cat, btn) {
      document.querySelectorAll('.cat-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      document.querySelectorAll('.faq-group').forEach(g => {
        g.style.display = (cat === 'all' || g.dataset.cat === cat) ? 'block' : 'none';
      });
      
      // Refresh AOS because page height changed
      AOS.refresh();
    }

    function filterFAQ(q) {
      const kw = q.toLowerCase();
      document.querySelectorAll('.faq-item').forEach(item => {
        const txt = item.textContent.toLowerCase();
        item.style.display = txt.includes(kw) ? 'block' : 'none';
      });
      document.querySelectorAll('.faq-group').forEach(g => {
        const visible = [...g.querySelectorAll('.faq-item')].some(i => i.style.display !== 'none');
        g.style.display = visible ? 'block' : 'none';
      });
      
      // Refresh AOS because page height changed
      AOS.refresh();
    }
  </script>
</body>

</html>