
<!-- start of navbar html -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container-fluid position-relative p-2" style="width: 100%">

    <!-- LEFT: Logo -->
    <div class="d-flex align-items-center" style="width: 260px;">
      <div class="d-flex align-items-center" style="width: 100%;">
        <a class="navbar-brand-main d-flex align-items-center" href="/"
          style="width: 100%; white-space: nowrap; text-decoration: none; color: black;">
          <img src="/logo_stai-01.svg" alt="Logo" style="max-height:55px" class="me-2">
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
              <li><a class="dropdown-item" href="/jurusan/hukum-ekonomi-syariah/">Hukum Ekonomi Syariah</a></li>
              <li><a class="dropdown-item" href="/jurusan/pendidikan-agama-islam/">Pendidikan Agama Islam</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="/petunjuk-pendaftaran/">Petunjuk Pendaftaran</a></li>
          <li class="nav-item"><a class="nav-link" href="/faq/">FAQ</a></li>
        </ul>
      </div>

      <!-- RIGHT: Buttons (Left on Mobile, Right on PC) -->
      <div class="navbar-right-actions d-flex flex-column flex-lg-row gap-3 mt-3 mt-lg-0 ms-lg-auto align-items-start align-items-lg-center" style="text-decoration: none;">
        <?php if (isset($_SESSION["role"])): ?>
          <a class="btn-nav-register d-flex align-items-center gap-2 shadow-sm" href="/dashboard/">
            Dashboard
            <span class="material-symbols-outlined fs-5">dashboard</span>
          </a>
        <?php else: ?>
          <a class="btn-nav-login d-flex align-items-center gap-2" href="/masuk/">
            <span class="material-symbols-outlined fs-5">login</span>
            Masuk
          </a>
          <a class="btn-nav-register d-flex align-items-center gap-2 shadow-sm" href="/daftar/">
            Daftar
            <span class="material-symbols-outlined fs-5">person_add</span>
          </a>
        <?php endif; ?>
      </div>
    </div>

  </div>
</nav>

<!-- end of navbar html -->
