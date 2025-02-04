<?php
// Koneksi ke database
include "koneksi.php";

// Ambil id_produk dari URL
$id_produk = $_REQUEST['id_produk'];

// Query untuk menghapus data produk berdasarkan id_produk
$delete_produk = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id_produk'");

// Cek apakah penghapusan berhasil
if (!$delete_produk) {
    ?>
    <script language="javascript">
        alert("Data Gagal dihapus..!!");
        setTimeout('self.location.href="daftar_produk.php"', 10); // Arahkan kembali ke daftar produk setelah gagal
    </script>
    <?php
} else {
    ?>
    <script language="javascript">
        alert("Data Berhasil dihapus..!!");
    </script>
    <?php
    // Redirect ke daftar produk setelah berhasil menghapus data
    print ("<html><head><meta http-equiv='refresh' content='0; url=index.php'></head><body></body></html>");
}
?>
