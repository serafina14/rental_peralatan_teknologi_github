<?php
include "cek_admin.php";
include "../includes/koneksi.php";
include "../includes/navbar.php";
$query = "SELECT transaksi.*, users.nama AS nama_user,
          barang.nama_barang
          FROM transaksi
          JOIN users ON transaksi.id_user = users.id_user
          JOIN barang ON transaksi.id_barang = barang.id_barang
          ORDER BY transaksi.id_transaksi DESC";
$result = mysqli_query($conn, $query);
?>
<table class="table table-bordered">
  <thead>
    <tr><th>No</th><th>Pengguna</th><th>Barang</th>
        <th>Tgl Sewa</th><th>Tgl Kembali</th>
        <th>Total</th><th>Status</th></tr>
  </thead>
  <tbody>
  <?php $no=1; while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama_user'] ?></td>
      <td><?= $row['nama_barang'] ?></td>
      <td><?= $row['tanggal_sewa'] ?></td>
      <td><?= $row['tanggal_kembali'] ?></td>
      <td>Rp <?= number_format($row['total_biaya'],0,',','.') ?></td>
      <td><?= $row['status'] ?></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
