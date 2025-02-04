<?php
$id_penjualan=$_POST['id_penjualan'];
$tgl_penjualan=$_POST['tanggal_penjualan'];
$total_harga=$_POST['total_harga'];
$id_pelanggan=$_POST['id_pelanggan'];



include "koneksi.php";
$tambah_penjualan=mysqli_query ($koneksi, "INSERT INTO `penjualan`(`id_penjualan`, `tanggal_penjualan`, `total_harga`, `id_pelanggan`) VALUES ('$id_penjualan','$tgl_penjualan','$total_harga','$id_pelanggan')");

if(!$tambah_penjualan){
?>
  <script language="javascript">
    alert("Data Pelanggan Gagal di Simpan..!!");
    setTimeout('self.location.href="/daftar_penjualan.php"', 10);

    </script>
<?php
}
else{
    ?>
    <script language="javascript">
    alert("Data Pelanggan Berhasil disimpan..!!");
    </script>
    <?php
}
        print ("<html><head><meta http-equiv='refresh' content='0; url=index.php'></head><body></body></html>");
   
?>
