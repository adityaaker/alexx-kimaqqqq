<?php
$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];

include "koneksi.php";

$edit_pelanggan = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', alamat='$alamat', no_telepon='$no_telepon' WHERE id_pelanggan='$id_pelanggan'");

if (!$edit_pelanggan) {
    ?>
    <script language="javascript">
        alert("Data gagal diedit..!!");
        setTimeout(function() {
            window.location.href = "/form_editpelanggan.php?id_pelanggan=<?php echo $id_pelanggan; ?>";
        }, 10);
    </script>
    <?php
} else {
    ?>
    <script language="javascript">
        alert("Data berhasil diedit..!!");
        window.location.href = "index.php";
    </script>
    <?php
}
?>
