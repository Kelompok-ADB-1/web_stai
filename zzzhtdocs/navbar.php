<?php
require_once __DIR__ . '/config.php';
/**
 * STAI Sabilussalam Navbar Component
 * This file contains the navigation bar HTML and its specific CSS.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Material Symbols & Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<style>
  /* Navbar Modernization */

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

  .navbar {
    background: rgba(255, 255, 255, 0.85) !important;
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding: 0.5rem 4rem;
    transition: var(--transition);
    position: sticky;
    top: 0;
    z-index: 1000;
    line-height: 1.2;
  }

  .nav-link {
    font-weight: 500;
    color: var(--gray-700) !important;
    padding: 0.5rem 0.5rem !important;
    transition: var(--transition);
    border-radius: 12px;
    font-size: 0.95rem;
    line-height: 1.2;
  }

  .navbar-brand-main span {
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--gray-700);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .navbar-brand-main strong {
    font-size: 1.25rem;
    color: var(--primary-dark);
    letter-spacing: -0.5px;
  }



  .nav-link:hover, .nav-link.active {
    color: var(--primary) !important;
    background: var(--primary-soft);
  }

  .dropdown-menu {
    border: none;
    box-shadow: var(--shadow-xl);
    border-radius: 16px;
    padding: 0.75rem;
    margin-top: 10px !important;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
  }

  .dropdown-item {
    border-radius: 10px;
    padding: 0.6rem 1rem;
    font-weight: 500;
    transition: var(--transition);
  }

  .dropdown-item:hover {
    background: var(--primary-soft);
    color: var(--primary);
    transform: translateX(5px);
  }

  @media (min-width: 992px) {
    .dropdown-menu {
      display: block;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.25s ease, visibility 0.25s ease;
      transition-delay: 0.3s;
    }
    .dropdown:hover .dropdown-menu {
      opacity: 1 !important;
      visibility: visible !important;
      transition-delay: 0s !important;
    }

    .dropdown:hover .dropdown-toggle::after {
      transform: rotate(180deg);
    }

    .dropdown-toggle::after {
      transition: transform 0.2s;
    }

    /* Navbar Center Absolute on Desktop */
    .navbar-center-menu {
      position: absolute;
      left: 50%;
      transform: translate(-50%, -50%);
      top: 50%;
      margin: 0 !important;
    }
    
    .navbar-collapse {
      justify-content: flex-end;
    }
  }

  /* Show Jurusan by default on Mobile ONLY when navbar is expanded */
  @media (max-width: 991.98px) {
    .navbar-nav .dropdown-menu.show-always {
      display: block !important;
      position: static !important;
      float: none !important;
      box-shadow: none !important;
      background: transparent !important;
      border: none !important;
      padding-left: 1.5rem !important;
      margin: 0 !important;
    }
  }

  /* Navbar Unique Buttons */
  .btn-nav-login {
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--primary);
    border: 1.5px solid var(--primary);
    background: transparent;
    transition: var(--transition);
    text-decoration: none;
  }

  .btn-nav-login:hover {
    background: var(--primary-soft);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 147, 53, 0.1);
    color: var(--primary);
    text-decoration: none;
  }

  .btn-nav-register {
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 500;
    font-size: 0.9rem;
    color: white !important;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
    box-shadow: 0 4px 15px rgba(16, 147, 53, 0.2);
    transition: var(--transition);
    text-decoration: none;
  }

  .btn-nav-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 147, 53, 0.3);
    filter: brightness(1.1);
    color: white !important;
    text-decoration: none;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container-fluid position-relative p-2" style="width: 100%">

    <!-- LEFT: Logo -->
    <div class="d-flex align-items-center" style="width: 260px;">
      <div class="d-flex align-items-center" style="width: 100%;">
        <a class="navbar-brand-main d-flex align-items-center" href="<?= BASE_URL ?>/"
          style="width: 100%; white-space: nowrap; text-decoration: none; color: black;">
          <img src="<?= BASE_URL ?>/logo_stai-01.svg" alt="Logo" style="max-height:55px" class="me-2">
          <div class="lh-sm">
            <span class="d-block" style="text-transform: none; color: black;">Sekolah Tinggi Agama Islam</span>
            <strong style="text-transform: none; color: black;">SABILU SALAM</strong>
          </div>
        </a>
      </div>
    </div>

    <!-- TOGGLER: Hamburger for mobile -->
    <button class="navbar-toggler border-0 ms-auto" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="material-symbols-outlined">menu</span>
    </button>

    <!-- COLLAPSIBLE CONTENT -->
    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- CENTER: Menu (Centered on PC, Left on Mobile) -->
      <div class="navbar-center-menu mx-lg-auto ms-0">
        <ul class="navbar-nav gap-2 gap-lg-4 align-items-start align-items-lg-center mt-3 mt-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Jurusan</a>
            <ul class="dropdown-menu show-always">
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/jurusan/hukum-ekonomi-syariah/">Hukum Ekonomi Syariah</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/jurusan/pendidikan-agama-islam/">Pendidikan Agama Islam</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/petunjuk-pendaftaran/">Petunjuk Pendaftaran</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/faq/">FAQ</a></li>
        </ul>
      </div>

      <!-- RIGHT: Buttons (Left on Mobile, Right on PC) -->
      <div class="navbar-right-actions d-flex flex-column flex-lg-row gap-3 mt-3 mt-lg-0 ms-lg-auto align-items-start align-items-lg-center" style="text-decoration: none;">
        <?php if (isset($_SESSION["role"])): ?>
          <a class="btn-nav-register d-flex align-items-center gap-2 shadow-sm" href="<?= BASE_URL ?>/dashboard/">
            Dashboard
            <span class="material-symbols-outlined fs-5">dashboard</span>
          </a>
        <?php else: ?>
          <a class="btn-nav-login d-flex align-items-center gap-2" href="<?= BASE_URL ?>/masuk/">
            <span class="material-symbols-outlined fs-5">login</span>
            Masuk
          </a>
          <a class="btn-nav-register d-flex align-items-center gap-2 shadow-sm" href="<?= BASE_URL ?>/daftar/">
            Daftar
            <span class="material-symbols-outlined fs-5">person_add</span>
          </a>
        <?php endif; ?>
      </div>
    </div>

  </div>
</nav>
