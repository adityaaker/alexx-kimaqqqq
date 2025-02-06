<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

$id = $_POST['id_penjualan'];
$tgl = $_POST['tgl_penjualan'];
$harga = $_POST['total_harga'];
$idpelanggan = $_POST['id_pelanggan'];

if (isset($_POST['tambah'])) {
    // Memasukkan data ke tabel penjualan
    $sql_penjualan = mysqli_query($koneksi, "INSERT INTO penjualan (tanggal_penjualan, total_harga, id_pelanggan, bayar, sisa_bayar) 
    VALUES ('$tgl', '$harga', '$idpelanggan', '0', '0')");

    // Ambil ID terbaru jika menggunakan AUTO_INCREMENT
    $id = mysqli_insert_id($koneksi);
}

// Mengambil data penjualan dan pelanggan dengan INNER JOIN
$sql_jual = mysqli_query($koneksi, 
    "SELECT penjualan.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan 
    FROM penjualan 
    INNER JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
    WHERE penjualan.id_penjualan = '$id'"
);

$ShowPayment = mysqli_fetch_array($sql_jual);
$_SESSION['user'] = $ShowPayment;

include "detail_penjualan.php";

// Pengalihan ke index.php setelah proses selesai
//header("Location: index.php");
//exit();
?>
