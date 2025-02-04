<?php
// Ambil data dari form
$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];

// Include file koneksi database
include "koneksi.php";

// Query untuk menambahkan data pelanggan
$tambah_pelanggan = mysqli_query($koneksi, "INSERT INTO `pelanggan`(`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telepon`) VALUES ('$id_pelanggan', '$nama_pelanggan', '$alamat', '$no_telepon')");

// Cek hasil query
if (!$tambah_pelanggan) {
    ?>
    <script language="javascript">
        alert("Data Pelanggan Gagal disimpan..!!");
        setTimeout(() => {
            window.location.href = "/form_input_pelanggan.php";
        }, 10);
    </script>
    <?php
} else {
    ?>
    <script language="javascript">
        alert("Data Pelanggan Berhasil disimpan..!!");
    </script>
    <?php
}

// Redirect ke halaman daftar pelanggan
print("<html><head><meta http-equiv='refresh' content='0; url=index.php'></head><body></body></html>");
?>
