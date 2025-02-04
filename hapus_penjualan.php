<?php
 include "koneksi.php";
 $id_penjualan =$_REQUEST['id_penjualan'];
 $delete_penjualan=mysqli_query($koneksi,"DELETE FROM penjualan WHERE id_penjualan='$id_penjualan'");

 if(!$delete_penjualan){
    ?>
      <script language="javascript">
        alert("Data Gagal dihapus..!!");
        setTimeout('self.location.href="/daftar_penjualan.php"', 10);
    
        </script>
    <?php
    }
    else{
        ?>
        <script language="javascript">
        alert("Data Berhasil dihapus..!!");
        </script>
        <?php
    }
            print ("<html><head><meta http-equiv='refresh' content='0; url=index.php'></head><body></body></html>");
       
    ?>