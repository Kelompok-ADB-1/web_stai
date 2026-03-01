<?php
require_once __DIR__ . '/../config.php';
// navbar-dashboard.php
// This file contains the sidebar, topbar, and overlay for the dashboard.
// It detects whether to show the Admin menu or User portal menu based on the URL path.

$currentPath = $_SERVER['PHP_SELF'];
$isAdminArea = (strpos($currentPath, '/dashboard/admin/') !== false);

// Special case: If user is admin and on the 'Akun' page, show the admin menu
if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin" && strpos($currentPath, '/dashboard/akun/') !== false) {
    $isAdminArea = true;
}

// Active link detection helper
function isActive($path, $exact = false) {
    $current = $_SERVER['PHP_SELF'];
    if ($exact) {
        return ($current === $path) ? 'active' : '';
    }
    return (strpos($current, $path) !== false) ? 'active' : '';
}
?>
<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <a href="<?= BASE_URL ?>/">    
        <div class="sidebar-logo">
            <img src="<?= BASE_URL ?>/logo_stai-01.svg" alt="Logo" >
              <div class="lh-sm">
                <span class="d-block">Sekolah Tinggi Agama Islam</span>
                <strong>SABILU SALAM</strong>
              </div>
        </div>
    </a>        
    
    <ul class="nav-menu">
        <?php if ($isAdminArea): ?>
            <!-- ADMIN MENU -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/admin/" class="nav-link <?php echo isActive('/dashboard/admin/index.php', true); ?>">
                    <span class="material-symbols-rounded">dashboard</span>
                    <span>Overview</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/admin/data-akun/" class="nav-link <?php echo isActive('/dashboard/admin/data-akun/'); ?>">
                    <span class="material-symbols-rounded">group</span>
                    <span>Kelola Akun</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/admin/mata-kuliah/" class="nav-link <?php echo isActive('/dashboard/admin/mata-kuliah/'); ?>">
                    <span class="material-symbols-rounded">menu_book</span>
                    <span>Mata Kuliah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/admin/keuangan/" class="nav-link <?php echo isActive('/dashboard/admin/keuangan/'); ?>">
                    <span class="material-symbols-rounded">payments</span>
                    <span>Keuangan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/admin/seleksi/" class="nav-link <?php echo isActive('/dashboard/admin/seleksi/'); ?>">
                    <span class="material-symbols-rounded">assignment_turned_in</span>
                    <span>Seleksi PMB</span>
                </a>
            </li>
        <?php else: ?>
            <!-- USER PORTAL MENU -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/" class="nav-link <?php echo isActive('/dashboard/index.php', true); ?>">
                    <span class="material-symbols-rounded">home</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/profil/" class="nav-link <?php echo isActive('/dashboard/profil/'); ?>">
                    <span class="material-symbols-rounded">person</span>
                    <span>Profil & Biodata</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/upload-berkas/" class="nav-link <?php echo isActive('/dashboard/upload-berkas/'); ?>">
                    <span class="material-symbols-rounded">cloud_upload</span>
                    <span>Upload Berkas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/pembayaran/" class="nav-link <?php echo isActive('/dashboard/pembayaran/'); ?>">
                    <span class="material-symbols-rounded">account_balance_wallet</span>
                    <span>Pembayaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard/hasil-seleksi/" class="nav-link <?php echo isActive('/dashboard/hasil-seleksi/'); ?>">
                    <span class="material-symbols-rounded">description</span>
                    <span>Hasil Seleksi</span>
                </a>
            </li>
        <?php endif; ?>
    


    <div class="sidebar-footer">
        <?php if ($isAdminArea): ?>
            <!-- ADMIN FOOTER -->
            <a href="<?= BASE_URL ?>/dashboard/" class="nav-link text-primary">
                <span class="material-symbols-rounded">open_in_new</span>
                <span>Lihat User Portal</span>
            </a>
            <a href="<?= BASE_URL ?>/dashboard/admin/settings/" class="nav-link <?php echo isActive('/dashboard/admin/settings/'); ?>">
                <span class="material-symbols-rounded">settings</span>
                <span>Settings</span>
            </a>

        <?php else: ?>
            <!-- USER PORTAL FOOTER -->
            <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
                <a href="<?= BASE_URL ?>/dashboard/admin/" class="nav-link text-primary">
                    <span class="material-symbols-rounded">admin_panel_settings</span>
                    <span>Lihat Admin Portal</span>
                </a>
            <?php endif; ?>


        <?php endif; ?>

        <a href="<?= BASE_URL ?>/dashboard/akun/" class="nav-link <?php echo isActive('/dashboard/akun/'); ?>">
            <span class="material-symbols-rounded">manage_accounts</span>
            <span>Akun</span>
        </a>

        <a href="<?= BASE_URL ?>/masuk/logout.php" class="nav-link text-danger">
            <span class="material-symbols-rounded">logout</span>
            <span>Logout</span>
        </a>
    </div>

    </ul>
</aside>

<!-- Main Content -->
<main class="main-content">
    <!-- Topbar -->
    <header class="topbar">
        <button class="sidebar-toggle" id="sidebarToggle">
            <span class="material-symbols-rounded">menu</span>
        </button>
        <div class="flex-grow-1"></div>
        
        <div class="topbar-actions">
            <div class="user-profile">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold fs-6 lh-1"><?php echo htmlspecialchars($displayName ?? 'User'); ?></div>
                    <small class="text-muted"><?php echo ($userRole === 'Calon_mahasiswa') ? 'Calon Mahasiswa' : htmlspecialchars($userRole); ?></small>
                </div>
                <div class="user-avatar"><?php echo substr(htmlspecialchars($displayName ?? 'U'), 0, 1); ?></div>
            </div>
        </div>
    </header>

    <script>
        // Sidebar Toggle Logic
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebar && sidebarToggle && sidebarOverlay) {
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
                document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
            }

            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking a nav link (mobile)
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });
        }
    </script>
