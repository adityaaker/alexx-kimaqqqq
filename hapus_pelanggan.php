<?php
include "koneksi.php";
$id_pelanggan = $_REQUEST['id_pelanggan'];
$delete_pelanggan = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

if (!$delete_pelanggan) {
    ?>
    <script language="javascript">
        alert("Data Gagal dihapus..!!");
        setTimeout(() => window.location.href = "daftar_pelanggan.php", 10);
    </script>
    <?php
} else {
    ?>
    <script language="javascript">
        alert("Data Berhasil dihapus..!!");
        window.location.href = "index.php";
    </script>
    <?php
}
?>
