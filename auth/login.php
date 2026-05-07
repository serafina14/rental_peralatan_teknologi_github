<?php
session_start();
include "../includes/koneksi.php";

// Jika sudah login, langsung lempar ke index
if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Set Session
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['nama']    = $row['nama'];
        $_SESSION['role']    = $row['role'];

        // Redirect berdasarkan role
        if ($row['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Login - RentalTech</title>
</head>

<body class="auth-container">

    <div class="container">
        <div class="card login-card mx-auto border-0 shadow-lg">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: var(--navy);">Login RentalTech</h3>
                <p class="text-muted small">Masuk untuk mulai menyewa alat teknologi</p>
            </div>

            <?php if ($error) : ?>
                <div class="alert alert-danger small py-2"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="......." required>
                </div>
                <button type="submit" name="login" class="btn btn-auth w-100 py-2">
                    Masuk Sekarang
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted">Belum punya akun? <a href="register.php" class="text-decoration-none fw-bold" style="color: var(--blue);">Daftar di sini</a></p>
                <hr>
                <a href="../index.php" class="small text-decoration-none text-secondary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>