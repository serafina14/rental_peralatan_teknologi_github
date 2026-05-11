<?php
include "cek_admin.php";
include "../includes/koneksi.php";

$result = mysqli_query(
    $conn,
    "SELECT id_user, nama, email, role FROM users
     WHERE role = 'user'
     ORDER BY id_user ASC"
);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - RentalTech Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include "../includes/navbar.php"; ?>

    <main class="content py-4">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="page-title mb-0">Data User</div>
                <a href="dashboard.php" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
            </div>
            <div class="card-table">
                <div class="table-responsive">
                    <table class="tabel-user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="user-avatar">
                                                <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                                            </span>
                                            <?= htmlspecialchars($row['nama']) ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td><span class="badge-role-user">User</span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4" style="color: var(--gray-text);">
                                        Belum ada data user.
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