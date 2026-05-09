<?php
// cek session sblm include navbar
if (session_status() === PHP_SESSION_NONE) {
    session_start();   
}

// redirect ke login kl belum login
if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

include "includes/koneksi.php";

// ambil pesan sukses dari session kl ada (dikirim dr proses_sewa.php)
$pesan_sukses = '';
if (isset($_SESSION['pesan_sukses'])) {
    $pesan_sukses = $_SESSION['pesan_sukses'];
    unset($_SESSION['pesan_sukses']); // hapus abis ditampilin sekali
}

// ambil riwayat transaksi punya user yang lg login
// JOIN barang buat dapetin nama_barang
$id_user = $_SESSION['id_user'];
$query = "SELECT t.id_transaksi, b.nama_barang, t.tanggal_sewa, t.tanggal_kembali,
                 t.jumlah, t.total_harga, t.status
          FROM transaksi t
          JOIN barang b ON t.id_barang = b.id_barang
          WHERE t.id_user = $id_user
          ORDER BY t.created_at DESC";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - RentalTech</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

    <?php include "includes/navbar.php"; ?>

    <!-- kontek utama -->
    <main class="content py-4">
        <div class="container">

            <div class="card-riwayat">

                <!-- judul halaman -->
                <div class="page-title">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Penyewaan
                </div>

                <!-- pesan sukses dari proses_sewa.php -->
                <?php if (!empty($pesan_sukses)): ?>
                    <div class="alert-sukses">
                        <?= htmlspecialchars($pesan_sukses) ?>
                    </div>
                <?php endif; ?>

                <!-- tabel riwayat penyewaan -->
                <div class="table-responsive">
                    <table class="table-riwayat">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Jml</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td><?= $row['tanggal_sewa'] ?></td>
                                        <td><?= $row['tanggal_kembali'] ?></td>
                                        <td><?= $row['jumlah'] ?> unit</td>
                                        <!-- Format angka ribuan: 450000 → 450.000 -->
                                        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <!-- Nilai status di DB: 'aktif' atau 'selesai' (lowercase) -->
                                            <?php if ($row['status'] === 'aktif'): ?>
                                                <span class="badge-status badge-aktif">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge-status badge-selesai">Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4" style="color: var(--gray-text);">
                                        Belum ada riwayat penyewaan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </main>

    <?php include "includes/footer.php"; ?>

</body>
</html>
