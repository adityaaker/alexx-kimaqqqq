<?php
session_start();
include "../../../../config.php";

if ($_SESSION['ShowPayment']) {
    $id_penjualan = ucwords($_SESSION['ShowPayment']['id_penjualan']); //PenjualanID
    $id_produk = $_POST['ProdukID'];
    $jumlah = $_POST['JumlahProduk'];

    // Ambil data penjualan berdasarkan id_penjualan
    $sql1 = mysqli_query($config, "SELECT * FROM penjualan WHERE id_penjualan='$id_penjualan'");
    $datajual = mysqli_fetch_array($sql1);

    // Ambil data produk berdasarkan id_produk
    $sql_cari = mysqli_query($config, "SELECT * FROM produk WHERE ProdukID='$id_produk'");
    $dataproduk = mysqli_fetch_array($sql_cari);

    $stok = $dataproduk['Stok'];
    $subtotal = $jumlah * $dataproduk['Harga'];
    $totalharga = $datajual['TotalHarga'] + $subtotal;

    // Cek stok produk
    if ($stok <= 0) {
        echo "<script>
                alert('Stok barang habis!!');
                setTimeout(function(){ window.location.href='./input_penjualan.php'; }, 10);
              </script>";

        // Hapus transaksi jika stok tidak cukup
        mysqli_query($config, "DELETE FROM penjualan WHERE PenjualanID='$id_penjualan'");
    } else if (isset($_POST['cari'])) {
        // Tambahkan detail penjualan
        mysqli_query($config, "INSERT INTO detailpenjualan (PenjualanID, ProdukID, JumlahProduk, Subtotal)
                               VALUES ('$id_penjualan', '$id_produk', '$jumlah', '$subtotal')");

        // Update total harga di tabel penjualan
        mysqli_query($config, "UPDATE penjualan SET TotalHarga='$totalharga' WHERE PenjualanID='$id_penjualan'");

        // Update stok produk setelah transaksi
        $stok_baru = $stok - $jumlah;
        mysqli_query($config, "UPDATE produk SET Stok='$stok_baru' WHERE ProdukID='$id_produk'");
    }
}

include "../Details/index.php";
?>
