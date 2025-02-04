<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../../../config.php";
include "../Details/index.php";

$id = $_POST['id_penjualan'];
$tgl = $_POST['tgl_penjualan'];
$harga = $_POST['total_harga'];
$idpelanggan = $_POST['id_pelanggan'];

if (isset($_POST['tambah'])) {
    // Memasukkan data ke tabel penjualan
    $sql_penjualan = mysqli_query($config, "INSERT INTO penjualan (TanggalPenjualan, TotalHarga, PelangganID, Bayar, SisaBayar) 
    VALUES ('$tgl', '$harga', '$idpelanggan', '0', '0')");
}

// Mengambil data penjualan dan pelanggan dengan INNER JOIN
$sql_jual = mysqli_query($config, 
    "SELECT penjualan.*, pelanggan.PelangganID, pelanggan.NamaPelanggan 
    FROM penjualan 
    INNER JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID
    WHERE penjualan.PenjualanID = '$id'"
);

$ShowPayment = mysqli_fetch_array($sql_jual);
$_SESSION['ShowPayment'] = $ShowPayment;

include "../Details/index.php";
?>
