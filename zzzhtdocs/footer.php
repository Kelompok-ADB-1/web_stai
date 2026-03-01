<?php
require_once __DIR__ . '/config.php';
/**
 * STAI Sabilussalam Footer Component
 * This file contains the footer HTML and its specific CSS.
 */
?>

<style>
  /* Footer Styling */
  .main-footer {
    background: #111;
    color: #888;
    padding: 60px 0 0;
    font-size: 0.9rem;
    border-top: 1px solid rgba(255,255,255,0.05);
  }

  .footer-heading {
    color: white;
    font-weight: 700;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    position: relative;
    padding-bottom: 10px;
  }

  .footer-heading::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 30px;
    height: 2px;
    background: var(--primary);
  }

  .footer-link {
    color: #888;
    text-decoration: none;
    transition: var(--transition);
    display: block;
    margin-bottom: 0.75rem;
  }

  .footer-link:hover {
    color: var(--primary);
    transform: translateX(5px);
  }

  .footer-contact-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
  }

  .footer-contact-icon {
    color: var(--primary);
    font-size: 1.2rem;
  }

  .footer-bottom {
    background: #0a0a0a;
    padding: 25px 0;
    margin-top: 50px;
    text-align: center;
    border-top: 1px solid rgba(255,255,255,0.02);
  }

  .footer-bottom strong {
    color: white;
  }
</style>

<footer class="main-footer">
  <div class="container">
    <div class="row g-4">
      <!-- About -->
      <div class="col-lg-4 col-md-6">
        <div class="pe-lg-5">
          <div class="d-flex align-items-center mb-4">
            <img src="<?= BASE_URL ?>/logo_stai-01.svg" alt="Logo" style="max-height: 45px;" class="me-2">
            <div class="lh-sm">
              <span class="d-block" style="text-transform: none; color: white; font-weight: 300;">Sekolah Tinggi Agama Islam</span>
              <strong style="text-transform: none; color: white; font-weight: 500;">SABILU SALAM</strong>
            </div>
          </div>
          <!-- <div class="d-flex gap-3">
            <a href="#" class="text-white-50 hover-text-primary"><span class="material-symbols-outlined">public</span></a>
            <a href="#" class="text-white-50 hover-text-primary"><span class="material-symbols-outlined">share</span></a>
          </div> -->
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6">
        <h5 class="footer-heading">Menu Cepat</h5>
        <a href="<?= BASE_URL ?>/" class="footer-link">Beranda</a>
        <a href="<?= BASE_URL ?>/#tentang" class="footer-link">Tentang Kami</a>
        <a href="<?= BASE_URL ?>/faq/" class="footer-link">FAQ</a>
        <a href="<?= BASE_URL ?>/petunjuk-pendaftaran/" class="footer-link">Petunjuk</a>
      </div>

      <!-- Categories/Jurusan -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-heading">Program Studi</h5>
        <a href="<?= BASE_URL ?>/jurusan/hukum-ekonomi-syariah/" class="footer-link">Hukum Ekonomi Syariah</a>
        <a href="<?= BASE_URL ?>/jurusan/pendidikan-agama-islam/" class="footer-link">Pendidikan Agama Islam</a>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-heading">Kontak</h5>
        <div class="footer-contact-item">
          <span class="material-symbols-outlined footer-contact-icon">location_on</span>
          <span>Jl. Raya Sabilussalam No. 12, Bandung, Jawa Barat</span>
        </div>
        <div class="footer-contact-item">
          <span class="material-symbols-outlined footer-contact-icon">call</span>
          <span>(022) 1234-5678</span>
        </div>
        <div class="footer-contact-item">
          <span class="material-symbols-outlined footer-contact-icon">mail</span>
          <span>info@staisabilussalam.ac.id</span>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <p class="mb-0">&copy; 2026 <strong>STAI Sabilussalam</strong>. Licensed under CC BY 4.0.</p>
    </div>
  </div>
</footer>
