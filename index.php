<?php
session_start();
include "includes/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>RentalTech</title>
</head>
<body>
    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- hero section -->
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">

            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/img/fotografi_sonyA7.jpeg" class="d-block mx-lg-auto img-fluid rounded-4 shadow-lg" alt="Hero Image" width="700" height="500" loading="lazy">
            </div>

            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3" style="color: var(--navy);">Eksplor Teknologi Tanpa Harus Membeli.</h1>
                <p class="lead">Sewa kamera profesional, laptop high-end, dan console gaming terbaru dengan harga terjangkau. Proses cepat, syarat mudah, dan barang terjamin kualitasnya.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                    <a href="katalog.php" class="btn btn-primary btn-lg px-4 me-md-2" style="background-color: var(--blue); border: none;">Mulai Sewa</a>
                </div>
            </div>

        </div>
    </div>

    <div class="container my-5 pb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--navy);">Kategori Peralatan</h2>
            <p class="text-muted">Temukan alat yang tepat untuk kebutuhan profesionalmu</p>
        </div>

        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-kategori">
                    <div class="p-4 text-center">
                        <img src="assets/img/fotografi_sonyA7.jpeg" class="img-fluid rounded mb-3" style="height: 120px; object-fit: contain;" alt="Fotografi">
                        <h5 class="fw-bold">Fotografi & Videografi</h5>
                        <p class="small text-muted">Kamera Profesional</p>
                        <a href="katalog.php?kategori=fotografi" class="btn btn-sm btn-outline-primary stretched-link">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-kategori">
                    <div class="p-4 text-center">
                        <img src="assets/img/kantor_mackBook.jpeg" class="img-fluid rounded mb-3" style="height: 120px; object-fit: contain;" alt="Kantor">
                        <h5 class="fw-bold">Produktivitas & Kantor</h5>
                        <p class="small text-muted">MacBook & Perangkat kerja</p>
                        <a href="katalog.php?kategori=kantor" class="btn btn-sm btn-outline-primary stretched-link">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-kategori">
                    <div class="p-4 text-center">
                        <img src="assets/img/gaming_ps5.jpeg" class="img-fluid rounded mb-3" style="height: 120px; object-fit: contain;" alt="Gaming">
                        <h5 class="fw-bold">Gaming & Hiburan</h5>
                        <p class="small text-muted">Console & Gaming Gear</p>
                        <a href="katalog.php?kategori=gaming" class="btn btn-sm btn-outline-primary stretched-link">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-kategori">
                    <div class="p-4 text-center">
                        <img src="assets/img/audio_recording.jpeg" class="img-fluid rounded mb-3" style="height: 120px; object-fit: contain;" alt="Audio">
                        <h5 class="fw-bold">Audio</h5>
                        <p class="small text-muted">Microphone & Speakers</p>
                        <a href="katalog.php?kategori=audio" class="btn btn-sm btn-outline-primary stretched-link">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>