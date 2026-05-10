<?php
session_start();
include "includes/koneksi.php";
include "includes/navbar.php";

if (!isset($_SESSION['id_user'])) {
    header("location: auth/login.php");
    exit;
}

$id = isset($_GET['id']) ? $_GET['id'] : "";

$query = "SELECT barang.*, kategori.nama_kategori 
          FROM barang 
          JOIN kategori ON barang.id_kategori = kategori.id_kategori 
          WHERE id_barang = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: katalog.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Detail Produk</title>
</head>

<body>
    <div class="container mt-3 mb-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="katalog.php" class="text-decoration-none">Katalog</a></li>
                <li class="breadcrumb-item active"><?php echo $data['nama_kategori']; ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-md-6">
                <div class="p-5 rounded-4 shadow-sm" style="background-color: var(--bg);">
                    <img src="assets/img/<?php echo $data['gambar']; ?>" class="img-fluid" alt="Produk">
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="fw-bold" style="color: var(--navy);"><?php echo $data['nama_barang']; ?></h2>
                <h3 class="text-primary fw-bold mb-4">Rp <?php echo number_format($data['harga_sewa'], 0, ',', '.'); ?> <span class="text-muted fs-6 fw-normal">/ hari</span></h3>

                <p class="text-muted mb-4"><?php echo $data['deskripsi']; ?></p>

                <div class="card border-0 shadow-sm p-4" style="background-color: #f8f9fa;">
                    <h5 class="fw-bold mb-3">Form Penyewaan</h5>
                    <form action="proses_sewa.php" method="POST">
                        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Tanggal Mulai Sewa</label>
                            <input type="date" name="tanggal_sewa" class="form-control" min="<?= date('Y-m-d'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Jumlah Unit (Tersedia: <?php echo $data['stok']; ?>)</label>
                            <input type="number" name="jumlah" class="form-control" min="1" max="<?php echo $data['stok']; ?>" value="1">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" style="background-color: var(--blue); border: none;">
                            Sewa Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>