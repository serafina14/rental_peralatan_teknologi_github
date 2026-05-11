<?php
include "cek_admin.php";
include "../includes/koneksi.php";

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    $query = mysqli_query($conn, "SELECT id_barang, jumlah FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $id_barang = $data['id_barang'];
        $jumlah = $data['jumlah'];

        mysqli_query($conn, "UPDATE transaksi SET status = 'selesai' WHERE id_transaksi = '$id_transaksi'");

        mysqli_query($conn, "UPDATE barang SET stok = stok + $jumlah WHERE id_barang = '$id_barang'");

        header("Location: transaksi.php?pesan=berhasil");
    } else {
        header("Location: transaksi.php?pesan=gagal");
    }
}
?>