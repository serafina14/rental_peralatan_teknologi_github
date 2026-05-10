<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// cek lokasi file yang sedang dijalankan, bukan role user
// DIRECTORY_SEPARATOR supaya kompatibel di Windows (\) dan Linux (/)
$is_in_admin_folder = (
    strpos($_SERVER['SCRIPT_FILENAME'], DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR) !== false
);
$base = $is_in_admin_folder ? '../' : '';
?>
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $base ?>index.php">
      <img src="<?= $base ?>../assets/img/logo_transparent.png" alt="logo">
      RentalTech
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">

        <?php if (!isset($_SESSION['id_user'])): ?>
          <!-- Belum login -->
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>auth/login.php">Login</a></li>
          <li class="nav-item">
            <a class="btn btn-daftar btn-sm ms-2 px-3" href="<?= $base ?>auth/register.php">Daftar</a>
          </li>

        <?php elseif ($_SESSION['role'] == 'admin'): ?>
          <!-- Admin -->
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>admin/dashboard.php">Admin</a></li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="<?= $base ?>auth/logout.php">
              Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php else: ?>
          <!-- User biasa -->
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>riwayat.php">Riwayat Sewa</a></li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="<?= $base ?>auth/logout.php">
              Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>