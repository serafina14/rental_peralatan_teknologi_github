<?php
include "cek_admin.php";
include "../includes/koneksi.php";

// tambah barang
if (isset($_POST['tambah'])) {
    $nama   = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $id_kat = (int) $_POST['id_kategori'];
    $harga  = (int) $_POST['harga_sewa'];
    $stok   = (int) $_POST['stok'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/$gambar");
    }

    mysqli_query($conn,
        "INSERT INTO barang (nama_barang, id_kategori, harga_sewa, stok, deskripsi, gambar)
         VALUES ('$nama', '$id_kat', '$harga', '$stok', '$deskripsi', '$gambar')"
    );
    header("Location: barang.php"); exit;
}

// update barang
if (isset($_POST['update'])) {
    $id     = (int) $_POST['id_barang'];
    $nama   = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $id_kat = (int) $_POST['id_kategori'];
    $harga  = (int) $_POST['harga_sewa'];
    $stok   = (int) $_POST['stok'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $gambar = mysqli_real_escape_string($conn, $_POST['gambar_lama']);
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/$gambar");
    }

    mysqli_query($conn,
        "UPDATE barang SET nama_barang='$nama', id_kategori='$id_kat',
         harga_sewa='$harga', stok='$stok', deskripsi='$deskripsi', gambar='$gambar'
         WHERE id_barang='$id'"
    );
    header("Location: barang.php"); exit;
}

// hapus barang
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id'");
    header("Location: barang.php"); exit;
}

$edit_data = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $q  = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
    $edit_data = mysqli_fetch_assoc($q);
}

$q_kat = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori ASC");
$kategori_list = [];
while ($k = mysqli_fetch_assoc($q_kat)) {
    $kategori_list[] = $k;
}

// ambil semua barang
$result = mysqli_query($conn,
    "SELECT barang.*, kategori.nama_kategori FROM barang
     JOIN kategori ON barang.id_kategori = kategori.id_kategori
     ORDER BY barang.id_barang ASC"
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang - RentalTech Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include "../includes/navbar.php"; ?>

<main class="content py-4">
    <div class="container">

        <div class="page-title">Kelola Barang</div>

        <!-- form tambah/edit -->
        <div class="card-form">
            <h6><?= $edit_data ? 'Edit Barang' : 'Tambah Barang Baru' ?></h6>

            <form method="POST" action="barang.php" enctype="multipart/form-data">

                <?php if ($edit_data): ?>
                    <input type="hidden" name="id_barang" value="<?= $edit_data['id_barang'] ?>">
                    <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($edit_data['gambar']) ?>">
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control"
                               value="<?= $edit_data ? htmlspecialchars($edit_data['nama_barang']) : '' ?>"
                               placeholder="Contoh: Sony Alpha A7 IV" required>
                    </div>

                    <!-- dropdown kategori -->
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_list as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>"
                                    <?= ($edit_data && $edit_data['id_kategori'] == $kat['id_kategori']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kat['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga Sewa/Hari (Rp)</label>
                        <input type="number" name="harga_sewa" class="form-control" min="0"
                               value="<?= $edit_data ? $edit_data['harga_sewa'] : '' ?>"
                               placeholder="Contoh: 150000" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="0"
                               value="<?= $edit_data ? $edit_data['stok'] : '' ?>"
                               placeholder="Contoh: 3" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2"
                                  placeholder="Deskripsi singkat barang..."><?= $edit_data ? htmlspecialchars($edit_data['deskripsi']) : '' ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Gambar <?= $edit_data ? '(kosongkan jika tidak diganti)' : '' ?>
                        </label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <?php if ($edit_data && !empty($edit_data['gambar'])): ?>
                            <small class="text-muted mt-1 d-block">
                                Gambar saat ini: <?= htmlspecialchars($edit_data['gambar']) ?>
                            </small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <?php if ($edit_data): ?>
                        <button type="submit" name="update" class="btn-tambah">Simpan Perubahan</button>
                        <a href="barang.php" class="btn-batal">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah" class="btn-tambah">Tambah Barang</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- tabel daftar barang -->
        <div class="card-table">
            <div class="table-responsive">
                <table class="tabel-barang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga/Hari</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                                    <td>Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?></td>
                                    <td><?= $row['stok'] ?></td>
                                    <td>
                                        <a href="barang.php?edit=<?= $row['id_barang'] ?>" class="btn-edit">Edit</a>
                                        <a href="barang.php?hapus=<?= $row['id_barang'] ?>"
                                           class="btn-hapus ms-1"
                                           onclick="return confirm('Yakin hapus barang ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4" style="color: var(--gray-text);">
                                    Belum ada data barang.
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