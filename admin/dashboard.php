<?php
include "cek_admin.php";
include "../includes/koneksi.php";
include "../includes/navbar.php";
$total_barang    = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM barang"))[0];
$total_user      = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM users WHERE role='user'"))[0];
$total_transaksi = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM transaksi"))[0];
$total_kategori  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM kategori"))[0];
?>

<!-- card statistik -->
<div class="row g-4">
  <div class="col-md-3">
    <div class="card text-center shadow-sm p-4">
      <h2><?= $total_barang ?></h2>
      <p>Total Barang</p>
    </div>
  </div>
</div>
