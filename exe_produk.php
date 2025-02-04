<?php
// Ambil data dari form
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Pastikan file foto diupload dengan benar
$foto_produk = $_FILES['foto_produk']['name']; // Nama file yang diupload
$foto_tmp = $_FILES['foto_produk']['tmp_name']; // Lokasi sementara file
$foto_path = "uploads" . $foto_produk; // Lokasi tujuan penyimpanan

// Cek apakah file foto diupload dengan sukses
if (move_uploaded_file($foto_tmp, $foto_path)) {
    // Jika foto berhasil diupload, simpan data produk ke database
    include "koneksi.php";
    
    $tambah_produk = mysqli_query($koneksi, "INSERT INTO produk (id_produk, nama_produk, harga, stok, foto_produk) 
                                            VALUES ('$id_produk', '$nama_produk', '$harga', '$stok', '$foto_produk')");

    if (!$tambah_produk) {
        echo "<script>alert('Data Produk Gagal Disimpan!');</script>";
        echo "<script>setTimeout(() => { window.location.href = 'form_input_produk.php'; }, 10);</script>";
    } else {
        echo "<script>alert('Data Produk Berhasil Disimpan!');</script>";
        echo "<script>setTimeout(() => { window.location.href = 'index.php'; }, 10);</script>";
    }
} else {
    // Jika foto gagal diupload
    echo "<script>alert('Gagal mengupload foto produk!');</script>";
    echo "<script>setTimeout(() => { window.location.href = 'index.php'; }, 10);</script>";
}
?>
