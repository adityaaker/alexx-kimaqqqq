<?php
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Menghubungkan ke database
include "koneksi.php";

// Menangani upload foto produk baru
$foto_produk = $_FILES['foto_produk']['name']; // Nama file gambar

// Jika ada foto baru yang diupload
if ($foto_produk != '') {
    $target_dir = "uploads/"; // Direktori penyimpanan gambar
    $target_file = $target_dir . basename($foto_produk);

    // Cek apakah file yang diupload adalah gambar yang valid
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file)) {
            // Jika upload gambar berhasil, update data produk beserta foto
            $edit_produk = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok', foto_produk='$foto_produk' WHERE id_produk='$id_produk'");
        } else {
            ?>
            <script language="javascript">
                alert("Gagal mengupload foto produk!");
                setTimeout('self.location.href="edit_produk.php?id_produk=<?php echo $id_produk; ?>"', 10);
            </script>
            <?php
            exit();
        }
    } else {
        ?>
        <script language="javascript">
            alert("File yang diupload bukan gambar yang valid!");
            setTimeout('self.location.href="edit_produk.php?id_produk=<?php echo $id_produk; ?>"', 10);
        </script>
        <?php
        exit();
    }
} else {
    // Jika tidak ada foto yang diupload, update produk tanpa mengganti fotonya
    $edit_produk = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id_produk='$id_produk'");
}

// Cek jika query berhasil
if (!$edit_produk) {
    ?>
    <script language="javascript">
        alert("Data Gagal diedit..!!");
        setTimeout('self.location.href="edit_produk.php?id_produk=<?php echo $id_produk; ?>"', 10);
    </script>
    <?php
} else {
    ?>
    <script language="javascript">
        alert("Data Berhasil diedit..!!");
    </script>
    <?php
    // Redirect ke halaman daftar produk setelah sukses
    print ("<html><head><meta http-equiv='refresh' content='0; url=index.php'></head><body></body></html>");
}
?>
