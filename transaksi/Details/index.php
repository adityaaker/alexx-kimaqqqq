<?php
session_start();//MASALAH TERAKHIR
include "../../koneksi.php"; // Pastikan koneksi ke database sudah benar

if ($_SESSION['ShowPayment']) {
    $PenjualanID = $_SESSION['ShowPayment']['id_penjualan']; //PenjualanID

    // Ambil data penjualan berdasarkan id_penjualan
    $sql_jual = mysqli_query($config, "SELECT penjualan.*, pelanggan.PelangganID, pelanggan.NamaPelanggan 
                                      FROM penjualan 
                                      JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID
                                      WHERE penjualan.PenjualanID = '$PenjualanID'");
    $Show = mysqli_fetch_array($sql_jual);
    $tglpenjualan = $Show['TanggalPenjualan'];
    $namapelanggan = $Show['NamaPelanggan'];
    $totalharga = $Show['TotalHarga'];
    ?>
    <link rel="stylesheet" href="../../css/styles.css">
        <div class="form-container">
            <div class="form-header">TRANSAKSI PENJUALAN</div>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td>No Penjualan</td>
                    <td>:</td>
                    <td><?php echo $PenjualanID; ?></td>
                    <td>Tanggal Penjualan</td>
                    <td>:</td>
                    <td><?php echo $tglpenjualan; ?></td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td>:</td>
                    <td><?php echo $namapelanggan; ?></td>
                    <td>Total Harga</td>
                    <td>:</td>
                    <td><?php echo number_format($totalharga, 0, ',', '.'); ?></td>
                </tr>
            </table>

            <br>

            <form method="post" action="../context/index.php">
                <table cellspacing="0" cellpadding="5">
                    <tr>
                        <td>ID Produk</td>
                        <td>: </td>
                        <td>
                            <select name="id_produk">
                                <option value="">Pilih Produk</option>
                                <?php
                                $sql = "SELECT * FROM produk ORDER BY ProdukID";
                                $array = mysqli_query($config, $sql);
                                while ($hasil = mysqli_fetch_array($array)) {
                                    echo "<option value='$hasil[ProdukID]'>$hasil[ProdukID] ~ $hasil[NamaProduk]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Produk</td>
                        <td>: </td>
                        <td>
                            <input type="number" name="jml_produk" value="0" min="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="center">
                            <input type="submit" name="cari" value="Tambah Produk" class="btn">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            // Ambil data detail penjualan
            $sql2 = mysqli_query($config, "SELECT detailpenjualan.ProdukID, produk.NamaProduk, detailpenjualan.JumlahProduk, produk.Harga, 
                                                 (detailpenjualan.JumlahProduk * produk.Harga) AS subtotal 
                                          FROM detailpenjualan 
                                          JOIN produk ON detailpenjualan.ProdukID = produk.ProdukID 
                                          WHERE detailpenjualan.PenjualanID = '$PenjualanID'");

            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Produk ID</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>";

            while ($Show = mysqli_fetch_array($sql2)) {
                echo "<tr>
                        <td align='center'>{$Show['ProdukID']}</td>
                        <td>{$Show['NamaProduk']}</td>
                        <td align='center'>{$Show['JumlahProduk']}</td>
                        <td align='right'>" . number_format($Show['Harga'], 0, ',', '.') . "</td>
                        <td align='right'>" . number_format($Show['Subtotal'], 0, ',', '.') . "</td>
                      </tr>";
            }
            ?>

            <form method="POST" action="../export/index.php">
                <tr>
                    <td colspan="4" class="align-right">Bayar</td>
                    <td><input type="text" name="bayar"></td>
                </tr>
                <tr>
                    <td colspan="5" class="center">
                        <input type="submit" name="cetak" value="Cetak dan Selesai" class="btn">
                    </td>
                </tr>
            </form>
        </div>
<?php
}
?>
