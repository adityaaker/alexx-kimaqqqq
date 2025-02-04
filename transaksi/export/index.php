<?php
session_start();
include "../../../../config.php";

if (isset($_SESSION['ShowPayment'])) {
    $id_penjualan = ucwords($_SESSION['ShowPayment']['id_penjualan']); //PenjualanID

    // Ambil data penjualan & pelanggan
    $sql_jual = mysqli_query($config, "SELECT p.*, pl.PelangganID, pl.NamaPelanggan 
        FROM penjualan p 
        JOIN pelanggan pl ON p.PelangganID = pl.PelanggaID 
        WHERE p.PenjualanID = '$id_penjualan'");

    $tampil1 = mysqli_fetch_array($sql_jual);
    $totalharga = $tampil1['TotalHarga'];

    if (isset($_POST['cetak'])) {
        $bayar = $_POST['Bayar'];
        $sisabayar = $bayar - $totalharga;

        // Update pembayaran di database
        mysqli_query($config, "UPDATE penjualan SET Bayar='$bayar', SisaBayar='$sisabayar' WHERE PenjualanID='$id_penjualan'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: none; /* border */
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4a99b9;
            color: white;
        }
        .footer-table {
            width: 80%;
            margin: 20px auto 0;
            text-align: right;
            border: none;
        }
        .footer-table td {
            border: none;
            padding: 5px;
        }
    </style>
</head>
<body>

    <h2>Nota Penjualan</h2>

    <table>
        <tr>
            <td>No Penjualan</td>
            <td>:</td>
            <td><?php echo $tampil1['PenjualanID']; ?></td>
            <td>Tanggal Penjualan</td>
            <td>:</td>
            <td><?php echo $tampil1['TanggalPenjualan']; ?></td>
        </tr>
        <tr>
            <td>ID Pelanggan</td>
            <td>:</td>
            <td><?php echo $tampil1['PelangganID']; ?></td>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><?php echo $tampil1['NamaPelanggan']; ?></td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <th>No</th>
            <th>Produk ID</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub Total</th>
        </tr>

        <?php
        $sql2 = mysqli_query($config, "SELECT dp.*, pr.NamaProduk, pr.Harga 
            FROM detailpenjualan dp
            JOIN produk pr ON dp.ProdukID = pr.ProdukID
            WHERE dp.PenjualanID = '$id_penjualan'");

        $no = 1;
        while ($tampil = mysqli_fetch_array($sql2)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$tampil['ProdukID']}</td>
                    <td>{$tampil['NamaProduk']}</td>
                    <td>{$tampil['JumlahProduk']}</td>
                    <td>Rp " . number_format($tampil['Harga'], 0, ',', '.') . "</td>
                    <td>Rp " . number_format($tampil['Subtotal'], 0, ',', '.') . "</td>
                </tr>";
            $no++;
        }
        ?>

        <tr>
            <td colspan="5" align="right"><b>Total Harga</b></td>
            <td><b>Rp <?php echo number_format($totalharga, 0, ',', '.'); ?></b></td>
        </tr>
        <tr>
            <td colspan="5" align="right"><b>Bayar</b></td>
            <td><b>Rp <?php echo number_format($bayar, 0, ',', '.'); ?></b></td>
        </tr>
        <tr>
            <td colspan="5" align="right"><b>Sisa Bayar</b></td>
            <td><b>Rp <?php echo number_format($sisabayar, 0, ',', '.'); ?></b></td>
        </tr>
    </table>

    <table class="footer-table">
        <tr>
            <td>Bantul, ........ / ........ / 202...</td>
        </tr>
        <tr>
            <td height="50">Petugas Toko</td>
        </tr>
        <tr>
            <td height="100">........................................................</td>
        </tr>
    </table>

    <script>
        window.print();
    </script>

</body>
</html>

<?php
    }
}
?>
