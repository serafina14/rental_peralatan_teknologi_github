<?php
// Cek session sebelum include navbar
if (session_status() === PHP_SESSION_NONE) {
    session_start();   
}

// Redirect ke login jika belum login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Koneksi database
include "includes/koneksi.php";

// Ambil pesan sukses dari session jika ada (dikirim oleh proses_sewa.php)
$pesan_sukses = '';
if (isset($_SESSION['pesan_sukses'])) {
    $pesan_sukses = $_SESSION['pesan_sukses'];
    unset($_SESSION['pesan_sukses']); // hapus setelah ditampilkan sekali
}

// Ambil riwayat transaksi milik user yang sedang login
// JOIN barang untuk mendapatkan nama_barang
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS dari teman -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* ===== JUDUL HALAMAN ===== */
        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .page-title i {
            color: var(--blue);
            font-size: 22px;
        }

        /* ===== ALERT SUKSES ===== */
        .alert-sukses {
            background-color: #d1f7d6;
            border: 1px solid #a3e6ab;
            color: #1a6e2e;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* ===== CARD PEMBUNGKUS KONTEN ===== */
        .card-riwayat {
            background-color: var(--white);
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* ===== TABEL RIWAYAT ===== */
        .table-riwayat {
            width: 100%;
            border-collapse: collapse;
        }

        .table-riwayat thead tr {
            background-color: var(--navy);
            color: var(--white);
        }

        .table-riwayat thead th {
            padding: 12px 16px;
            font-weight: 600;
            font-size: 14px;
            text-align: left;
        }

        .table-riwayat tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .table-riwayat tbody tr:last-child {
            border-bottom: none;
        }

        .table-riwayat tbody td {
            padding: 12px 16px;
            font-size: 14px;
            color: var(--text-dark);
        }

        /* ===== BADGE STATUS ===== */
        .badge-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Status aktif → hijau muda */
        .badge-aktif {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        /* Status selesai → abu-abu */
        .badge-selesai {
            background-color: #e5e7eb;
            color: #374151;
            border: 1px solid #d1d5db;
        }
    </style>
</head>
<body>

    <!-- Navbar bersama (handles session & role otomatis) -->
    <?php include "includes/navbar.php"; ?>

    <!-- Konten utama -->
    <main class="content py-4">
        <div class="container">

            <div class="card-riwayat">

                <!-- Judul halaman -->
                <div class="page-title">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Penyewaan
                </div>

                <!-- Pesan sukses dari proses_sewa.php (via session flash) -->
                <?php if (!empty($pesan_sukses)): ?>
                    <div class="alert-sukses">
                        <?= htmlspecialchars($pesan_sukses) ?>
                    </div>
                <?php endif; ?>

                <!-- Tabel riwayat penyewaan -->
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

            </div><!-- end card-riwayat -->

        </div>
    </main>

    <!-- Footer bersama (sudah include Bootstrap JS + close body/html) -->
    <?php include "includes/footer.php"; ?>

</body>
</html>
