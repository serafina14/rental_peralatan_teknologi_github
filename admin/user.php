<?php
include "cek_admin.php";
include "../includes/koneksi.php";
include "../includes/navbar.php";
$query  = "SELECT * FROM users WHERE role = 'user'
           ORDER BY id_user ASC";
$result = mysqli_query($conn, $query);
?>
<table class="table table-bordered">
  <thead>
    <tr><th>No</th><th>Nama</th><th>Email</th></tr>
  </thead>
  <tbody>
  <?php $no=1; while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
