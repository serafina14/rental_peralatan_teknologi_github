<?php
session_start();
include "../includes/koneksi.php";

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = 'user'; // Default pendaftar baru adalah user

    // Cek apakah email sudah terdaftar
    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "Email sudah terdaftar! Gunakan email lain.";
    } else {
        // Simpan ke database
        $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            $success = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Gagal mendaftar, coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- css sendiri -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Registrasi</title>
</head>

<body class="auth-container">

    <div class="container d-flex justify-content-center">
        <div class="card login-card border-0 shadow-sm">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: var(--navy);">Daftar Akun</h2>
                <p class="text-muted">Lengkapi data untuk bergabung dengan RentalTech</p>
            </div>

            <?php if ($error) : ?>
                <div class="alert alert-danger small py-2"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success) : ?>
                <div class="alert alert-success small py-2"><?php echo $success; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="........" required>
                </div>
                <button type="submit" name="register" class="btn btn-auth w-100 py-2 text-white">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold" style="color: var(--blue);">Login di sini</a></p>
                <hr>
                <a href="../index.php" class="small text-decoration-none text-secondary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>