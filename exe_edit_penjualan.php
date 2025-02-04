<?php
// Inisialisasi variabel
$id_penjualan = $_POST['id_penjualan'];
$tgl_penjualan = $_POST['tanggal_penjualan'];
$total_harga = $_POST['total_harga'];
$nama_pelanggan = $_POST['nama_pelanggan'];

// Menyambungkan dengan database
include "koneksi.php";

// Mendapatkan id_pelanggan berdasarkan nama_pelanggan
$query_pelanggan = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan WHERE nama_pelanggan='$nama_pelanggan'");
$data_pelanggan = mysqli_fetch_assoc($query_pelanggan);
$id_pelanggan = $data_pelanggan['id_pelanggan'];

// Update data penjualan
$edit_penjualan = mysqli_query($koneksi, "UPDATE penjualan 
    SET tanggal_penjualan='$tgl_penjualan', total_harga='$total_harga', id_pelanggan='$id_pelanggan'
    WHERE id_penjualan='$id_penjualan'");

if (!$edit_penjualan) {
    // Menampilkan pesan jika gagal
    echo "<script language='JavaScript'>
            alert('Data gagal diperbaiki...!!');
            setTimeout(function(){ window.location.href='form_edit_penjualan.php'; }, 10);
          </script>";
} else {
    // Menampilkan pesan jika berhasil
    echo "<script language='JavaScript'>
            alert('Data berhasil diedit!!');
          </script>";
}

// Redirect ke halaman index.php setelah 2 detik
echo "<html><head><meta http-equiv='refresh' content='2;url=index.php'></head><body></body></html>";
?>
