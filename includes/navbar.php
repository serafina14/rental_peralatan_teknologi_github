<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$root = "/PRAKPWD_SEM2/rental_peralatan_teknologi_github";
?>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $root ?>/index.php">
      <img src="<?= $root ?>/assets/img/logo_transparent.png" alt="logo">
      RentalTech
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">

        <?php if (!isset($_SESSION['id_user'])): ?>

          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/auth/login.php">Login</a></li>
          <li class="nav-item">
            <a class="btn btn-daftar btn-sm ms-2 px-3" href="<?= $root ?>/auth/register.php">Daftar</a>
          </li>

        <?php elseif ($_SESSION['role'] == 'admin'): ?>

          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/admin/dashboard.php">Admin</a></li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="<?= $root ?>/auth/logout.php">
              Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php else: ?>

          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $root ?>/riwayat.php">Riwayat Sewa</a></li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="<?= $root ?>/auth/logout.php">
              Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>