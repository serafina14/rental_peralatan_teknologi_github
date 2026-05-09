<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hanya bisa diakses jika sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

// Tolak akses langsung lewat URL (bukan dari form POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: katalog.php");
    exit;
}

include "includes/koneksi.php";

// ambil dr form
$id_user         = $_SESSION['id_user'];
$id_barang       = (int) $_POST['id_barang'];
$tanggal_sewa    = $_POST['tanggal_sewa'];
$tanggal_kembali = $_POST['tanggal_kembali'];
$jumlah          = (int) $_POST['jumlah'];

// semua field wajib isi
if (empty($id_barang) || empty($tanggal_sewa) || empty($tanggal_kembali) || $jumlah < 1) {
    $_SESSION['error_sewa'] = "Semua field wajib diisi.";
    header("Location: detail.php?id=$id_barang");
    exit;
}

// tgl balik hrs sesuai tgl sewa
if ($tanggal_kembali <= $tanggal_sewa) {
    $_SESSION['error_sewa'] = "Tanggal kembali harus setelah tanggal sewa.";
    header("Location: detail.php?id=$id_barang");
    exit;
}

// cek barang dn stok di db
$q_barang = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = $id_barang");

if (mysqli_num_rows($q_barang) === 0) {
    $_SESSION['error_sewa'] = "Barang tidak ditemukan.";
    header("Location: katalog.php");
    exit;
}

$barang = mysqli_fetch_assoc($q_barang);

if ($barang['stok'] < $jumlah) {
    $_SESSION['error_sewa'] = "Stok tidak mencukupi. Tersedia: " . $barang['stok'] . " unit.";
    header("Location: detail.php?id=$id_barang");
    exit;
}

// hitung smua total
$tgl_sewa    = new DateTime($tanggal_sewa);
$tgl_kembali = new DateTime($tanggal_kembali);
$durasi      = $tgl_sewa->diff($tgl_kembali)->days;

$total_harga = $durasi * $barang['harga_sewa'] * $jumlah;

// simpen transaksi ke tbel transaksi
$q_insert = "INSERT INTO transaksi 
                 (id_user, id_barang, tanggal_sewa, tanggal_kembali, jumlah, total_harga, status)
             VALUES 
                 ($id_user, $id_barang, '$tanggal_sewa', '$tanggal_kembali', $jumlah, $total_harga, 'aktif')";

if (mysqli_query($conn, $q_insert)) {

    // ngurangin stok barang sejumlah yang disewa
    mysqli_query($conn, "UPDATE barang SET stok = stok - $jumlah WHERE id_barang = $id_barang");

    // ngirim pesan sukses ke riwayat.php lewat session flash
    $_SESSION['pesan_sukses'] = "Penyewaan berhasil! Total: Rp " . number_format($total_harga, 0, ',', '.');
    header("Location: riwayat.php");
    exit;

} else {
    $_SESSION['error_sewa'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
    header("Location: detail.php?id=$id_barang");
    exit;
}
?>