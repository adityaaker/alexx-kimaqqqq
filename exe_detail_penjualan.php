<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

// Cek apakah sesi user ada
if (!isset($_SESSION['user'])) {
    die("Error: Anda belum login atau sesi sudah berakhir.");
}

$id_penjualan = $_SESSION['user']['id_penjualan']; // id_penjualan
$id_produk = $_POST['id_produk']; // Sesuai dengan name di form sebelumnya
$jumlah = $_POST['jml_produk']; // Sesuai dengan form sebelumnya

// Ambil data penjualan berdasarkan id_penjualan
$sql1 = mysqli_prepare($koneksi, "SELECT total_harga FROM penjualan WHERE id_penjualan = ?");
mysqli_stmt_bind_param($sql1, "i", $id_penjualan);
mysqli_stmt_execute($sql1);
$result1 = mysqli_stmt_get_result($sql1);
$datajual = mysqli_fetch_array($result1, MYSQLI_ASSOC);

if (!$datajual) {
    die("Error: Data penjualan tidak ditemukan.");
}

// Ambil data produk berdasarkan id_produk
$sql2 = mysqli_prepare($koneksi, "SELECT stok, harga FROM produk WHERE id_produk = ?");
mysqli_stmt_bind_param($sql2, "i", $id_produk);
mysqli_stmt_execute($sql2);
$result2 = mysqli_stmt_get_result($sql2);
$dataproduk = mysqli_fetch_array($result2, MYSQLI_ASSOC);

if (!$dataproduk) {
    die("Error: Produk tidak ditemukan.");
}

$stok = $dataproduk['stok'];
$subtotal = $jumlah * $dataproduk['harga'];
$totalharga = $datajual['total_harga'] + $subtotal;

// Cek stok produk
if ($stok < $jumlah) {
    echo "<script>
            alert('Stok barang tidak cukup! Stok tersedia: $stok');
            window.location.href = 'form_penjualan.php';
          </script>";
    exit();
}

// Tambahkan detail penjualan
$sql3 = mysqli_prepare($koneksi, "INSERT INTO detail_penjualan (id_penjualan, id_produk, jumlah_produk, sub_total) 
                                  VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($sql3, "iiii", $id_penjualan, $id_produk, $jumlah, $subtotal);
mysqli_stmt_execute($sql3);

// Update total harga di tabel penjualan
$sql4 = mysqli_prepare($koneksi, "UPDATE penjualan SET total_harga = ? WHERE id_penjualan = ?");
mysqli_stmt_bind_param($sql4, "ii", $totalharga, $id_penjualan);
mysqli_stmt_execute($sql4);

// Update stok produk setelah transaksi
$stok_baru = $stok - $jumlah;
$sql5 = mysqli_prepare($koneksi, "UPDATE produk SET stok = ? WHERE id_produk = ?");
mysqli_stmt_bind_param($sql5, "ii", $stok_baru, $id_produk);
mysqli_stmt_execute($sql5);

include "detail_penjualan.php";
?>
