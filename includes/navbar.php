<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-light
 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ? '../index.php' : 'index.php' ?>"> <img src="assets/img/logo_transparent.png" alt="logo">
     RentalTech
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">

        <?php if (!isset($_SESSION['id_user'])): ?>
          <!-- Belum login -->
          <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item">
            <a class="btn btn-daftar btn-sm ms-2 px-3" href="register.php">Daftar</a>
          </li>

        <?php elseif ($_SESSION['role'] == 'admin'): ?>
          <!-- Admin -->
          <li class="nav-item"><a class="nav-link" href="../index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="../katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Admin</a></li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="../logout.php">
              Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php else: ?>
          <!-- User login -->
          <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat Sewa</a></li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">
              Logout (<?= htmlspecialchars($_SESSION['nama']) ?>)
            </a>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>