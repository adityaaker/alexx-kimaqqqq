<?php
include "koneksi.php";

if (isset($_GET['id_penjualan'])) {
    $id_penjualan = $_GET['id_penjualan'];
    $sql_produk = mysqli_query($koneksi, "SELECT produk.id_produk, produk.nama_produk FROM detail_penjualan 
                                          JOIN produk ON detail_penjualan.id_produk = produk.id_produk 
                                          WHERE detail_penjualan.id_penjualan = '$id_penjualan'");

    echo '<option value="">Pilih Produk</option>';
    while ($produk = mysqli_fetch_array($sql_produk)) {
        echo '<option value="'.$produk['id_produk'].'">'.$produk['nama_produk'].'</option>';
    }
}
?>
