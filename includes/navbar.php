<?php
require_once __DIR__ . '/../config/config.php';
?>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">

    <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>/index.php">
      <img src="<?= BASE_URL ?>/assets/img/logo_transparent.png" alt="logo">
      RentalTech
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">

        <?php if (!isset($_SESSION['id_user'])): ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php">Beranda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/katalog.php">Katalog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/auth/login.php">Login</a>
          </li>

          <li class="nav-item">
            <a class="btn btn-daftar btn-sm ms-2 px-3"
               href="<?= BASE_URL ?>/auth/register.php">
               Daftar
            </a>
          </li>

        <?php elseif ($_SESSION['role'] == 'admin'): ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php">Beranda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/katalog.php">Katalog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/admin/dashboard.php">Admin</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-danger"
               href="<?= BASE_URL ?>/auth/logout.php">
               Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php else: ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php">Beranda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/katalog.php">Katalog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/riwayat.php">Riwayat Sewa</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-danger"
               href="<?= BASE_URL ?>/auth/logout.php">
               Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>