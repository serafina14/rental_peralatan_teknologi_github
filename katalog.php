<?php
session_start();
include "includes/koneksi.php";
include "includes/navbar.php";

if(!isset($_SESSION['id_user'])){
    header("location: auth/login.php");
    exit;
}

$id_filter = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : "";

if ($id_filter) {
    $query = "SELECT barang.*, kategori.nama_kategori 
              FROM barang 
              JOIN kategori ON barang.id_kategori = kategori.id_kategori 
              WHERE barang.id_kategori = '$id_filter'";
} else {
    $query = "SELECT barang.*, kategori.nama_kategori 
              FROM barang 
              JOIN kategori ON barang.id_kategori = kategori.id_kategori";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Katalog</title>
</head>
<body>
    <div class="container my-5">
        <h3 class="fw-bold mb-4" style="color: var(--navy);">Katalog Peralatan</h3>
        <div class="d-flex flex-wrap gap-2 mb-5">
            <a href="katalog.php" class="btn-filter <?= $id_filter == "" ? 'active' : '' ?>">Semua</a>
            <a href="katalog.php?id_kategori=1" class="btn-filter <?= $id_filter == "1" ? 'active' : '' ?>">Fotografi & Videografi</a>
            <a href="katalog.php?id_kategori=2" class="btn-filter <?= $id_filter == "2" ? 'active' : '' ?>">Gaming & Hiburan</a>
            <a href="katalog.php?id_kategori=3" class="btn-filter <?= $id_filter == "3" ? 'active' : '' ?>">Produktivitas</a>
            <a href="katalog.php?id_kategori=4" class="btn-filter <?= $id_filter == "4" ? 'active' : '' ?>">Audio</a>
        </div>

        <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-produk-katalog">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="background-color: var(--bg); height: 220px;">
                            <img src="assets/img/<?php echo $row['gambar']; ?>" class="img-fluid" alt="Produk" style="max-height: 100%;">
                        </div>

                        <div class="card-body p-4">
                            <span class="badge mb-2" style="background-color: var(--blue-light); color: var(--navy); font-size: 0.7rem;">
                                <?php echo $row['nama_kategori']; ?></span>
                            <h6 class="fw-bold mb-1" style="color: var(--text-dark);"><?php echo $row['nama_barang']; ?></h6>
                            <p class="fw-bold mb-3" style="color: var(--blue);">
                                Rp <?php echo number_format($row['harga_sewa'], 0, ',', '.'); ?>/hari
                            </p>
                            <div class="mb-3">
                                <?php if ($row['stok'] > 0) : ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 0.7rem;">
                                        Tersedia (<?php echo $row['stok']; ?> unit)
                                    </span>
                                <?php else : ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 0.7rem;">
                                        Stok Habis
                                    </span>
                                <?php endif; ?>
                            </div>

                            <a href="detail.php?id=<?php echo $row['id_barang']; ?>" class="btn btn-primary w-100 fw-bold" style="background-color: var(--blue); border-radius: 8px;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>