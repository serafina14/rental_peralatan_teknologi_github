<?php
include "cek_admin.php";
include "../includes/koneksi.php";

$total_barang    = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang"))[0];
$total_user      = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE role='user'"))[0];
$total_transaksi = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM transaksi"))[0];
$total_kategori  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM kategori"))[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RentalTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include "../includes/navbar.php"; ?>

<main class="content py-4">
    <div class="container">

        <div class="page-title">Dashboard Admin</div>

        <!-- baris statistik -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-barang"><i class="bi bi-box-seam-fill"></i></div>
                    <div class="stat-number"><?= $total_barang ?></div>
                    <div class="stat-label">Total Barang</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-user"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-number"><?= $total_user ?></div>
                    <div class="stat-label">Total User</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-transaksi"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <div class="stat-number"><?= $total_transaksi ?></div>
                    <div class="stat-label">Transaksi</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-kategori"><i class="bi bi-tags-fill"></i></div>
                    <div class="stat-number"><?= $total_kategori ?></div>
                    <div class="stat-label">Kategori</div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <a href="barang.php" class="menu-card">
                    <div class="menu-icon icon-menu-barang"><i class="bi bi-box-seam-fill"></i></div>
                    <div class="menu-title">Kelola Barang</div>
                    <div class="menu-desc">Tambah, ubah, hapus barang</div>
                </a>
            </div>
            <div class="col-12 col-md-6">
                <a href="transaksi.php" class="menu-card">
                    <div class="menu-icon icon-menu-penyewaan"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <div class="menu-title">Data Penyewaan</div>
                    <div class="menu-desc">Lihat semua data sewa</div>
                </a>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>

</body>
</html>