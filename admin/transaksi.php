<?php
include "cek_admin.php";
include "../includes/koneksi.php";

$result = mysqli_query(
    $conn,
    "SELECT transaksi.*, users.nama AS nama_user, barang.nama_barang
     FROM transaksi
     JOIN users ON transaksi.id_user = users.id_user
     JOIN barang ON transaksi.id_barang = barang.id_barang
     ORDER BY transaksi.id_transaksi DESC"
);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan - RentalTech Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php require_once __DIR__ . '/../includes/navbar.php'; ?>

    <main class="content py-4">
        <div class="container">

            <div class="page-title">Data Penyewaan</div>

            <div class="card-table">
                <div class="table-responsive">
                    <table class="tabel-transaksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengguna</th>
                                <th>Barang</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_user']) ?></td>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td><?= $row['tanggal_sewa'] ?></td>
                                        <td><?= $row['tanggal_kembali'] ?></td>
                                        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'aktif'): ?>
                                                <span class="badge-status badge-aktif">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge-status badge-selesai">Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['status'] === 'aktif'): ?>
                                                <a href="selesaikan_sewa.php?id=<?= $row['id_transaksi'] ?>"
                                                    class="badge-status badge-selesai">
                                                    Selesaikan
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted small">Sudah Kembali</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4" style="color: var(--gray-text);">
                                        Belum ada data transaksi.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>