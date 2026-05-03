<?php
// Simulasi session user yang sudah login
session_start();
$_SESSION['username'] = 'Budi'; // Simulasi user login

// Simulasi data riwayat penyewaan
$riwayat = [
    [
        'no'          => 1,
        'barang'      => 'Kamera Canon EOS M50',
        'tgl_sewa'    => '2026-05-03',
        'tgl_kembali' => '2026-05-06',
        'jumlah'      => '1 unit',
        'total'       => 'Rp 450.000',
        'status'      => 'Aktif',
    ],
    [
        'no'          => 2,
        'barang'      => 'DJI Mini 3 Drone',
        'tgl_sewa'    => '2026-04-10',
        'tgl_kembali' => '2026-04-12',
        'jumlah'      => '1 unit',
        'total'       => 'Rp 500.000',
        'status'      => 'Selesai',
    ],
];

// Simulasi pesan sukses setelah penyewaan berhasil
$pesan_sukses = 'Penyewaan berhasil! Total: Rp 450.000';
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

    <style>
        /* ===== CSS VARIABLES (dari teman) ===== */
        :root {
            --navy: #062b63;
            --blue: #1E88E5;
            --blue-light: #8fc9ff;
            --bg: #F4F7FB;
            --white: #FFFFFF;
            --gray-text: #cbcdce;
            --text-dark: #1F2937;
        }

        /* ===== GLOBAL ===== */
        body {
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background-color: var(--white);
            border-bottom: 2px solid var(--navy);
            padding: 8px 0;
        }

        .navbar-brand {
            color: var(--blue);
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .nav-link {
            color: var(--navy);
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--blue);
            transform: translateY(-1px);
        }

        /* Nav link aktif (halaman saat ini) */
        .nav-link.active {
            color: var(--blue);
            font-weight: 700;
        }

        .btn-daftar {
            background-color: var(--blue);
            color: var(--white);
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
            padding: 8px 8px;
        }

        .btn-daftar:hover {
            background-color: var(--navy);
            color: var(--white);
        }

        /* ===== CONTENT ===== */
        .content {
            flex: 1;
        }

        /* ===== HALAMAN RIWAYAT ===== */
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

        /* ===== TABEL RIWAYAT ===== */
        .table-riwayat {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
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

        .badge-aktif {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .badge-selesai {
            background-color: #e5e7eb;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        /* ===== CARD WRAPPER ===== */
        .card-riwayat {
            background-color: var(--white);
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: var(--navy);
            color: var(--gray-text);
            text-align: center;
            padding: 14px 0;
            font-size: 13px;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Brand / Logo -->
            <a class="navbar-brand" href="#">
                <i class="bi bi-cpu-fill" style="font-size:28px; color: var(--blue);"></i>
                RentalTech
            </a>

            <!-- Toggle untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu navigasi -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <!-- Halaman aktif ditandai dengan warna biru dan bold -->
                        <a class="nav-link active" href="riwayat.php">Riwayat Sewa</a>
                    </li>
                    <li class="nav-item">
                        <!-- Logout menampilkan nama user dari session -->
                        <a class="nav-link" href="#">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== KONTEN UTAMA ===== -->
    <main class="content py-4">
        <div class="container">

            <!-- Card pembungkus seluruh konten riwayat -->
            <div class="card-riwayat">

                <!-- Judul halaman -->
                <div class="page-title">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Penyewaan
                </div>

                <!-- Pesan sukses (ditampilkan setelah transaksi berhasil) -->
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
                            <?php if (!empty($riwayat)): ?>
                                <?php foreach ($riwayat as $item): ?>
                                    <tr>
                                        <td><?= $item['no'] ?></td>
                                        <td><?= htmlspecialchars($item['barang']) ?></td>
                                        <td><?= $item['tgl_sewa'] ?></td>
                                        <td><?= $item['tgl_kembali'] ?></td>
                                        <td><?= $item['jumlah'] ?></td>
                                        <td><?= $item['total'] ?></td>
                                        <td>
                                            <!-- Badge status dengan warna berbeda sesuai kondisi -->
                                            <?php if ($item['status'] === 'Aktif'): ?>
                                                <span class="badge-status badge-aktif">Aktif</span>
                                            <?php elseif ($item['status'] === 'Selesai'): ?>
                                                <span class="badge-status badge-selesai">Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Baris kosong jika belum ada riwayat -->
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

    <!-- ===== FOOTER ===== -->
    <footer>
        &copy; 2026 RentalTech - Sewa Peralatan Teknologi
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
