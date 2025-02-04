<?php
session_start();
include "koneksi.php";

// Cek apakah sesi user ada
if (!isset($_SESSION['user'])) {
    die("Error: Anda belum login atau sesi sudah berakhir.");
}

$id_penjualan = $_SESSION['user']['id_penjualan']; // id_penjualan

// Ambil data penjualan & pelanggan
$sql_jual = mysqli_prepare($koneksi, "SELECT p.*, pl.id_pelanggan, pl.nama_pelanggan
    FROM penjualan p 
    JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan 
    WHERE p.id_penjualan = ?");
mysqli_stmt_bind_param($sql_jual, "i", $id_penjualan);
mysqli_stmt_execute($sql_jual);
$result_jual = mysqli_stmt_get_result($sql_jual);
$tampil1 = mysqli_fetch_array($result_jual, MYSQLI_ASSOC);

if (!$tampil1) {
    die("Error: Data penjualan tidak ditemukan.");
}

$totalharga = $tampil1['total_harga'];

if (isset($_POST['cetak'])) {
    if (!isset($_POST['bayar']) || !is_numeric($_POST['bayar'])) {
        die("Error: Nominal bayar tidak valid.");
    }

    $bayar = $_POST['bayar'];
    $sisabayar = $bayar - $totalharga;

    // Update pembayaran di database
    $sql_update = mysqli_prepare($koneksi, "UPDATE penjualan SET bayar = ?, sisa_bayar = ? WHERE id_penjualan = ?");
    mysqli_stmt_bind_param($sql_update, "dii", $bayar, $sisabayar, $id_penjualan);
    mysqli_stmt_execute($sql_update);
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
            border: none;
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
            <td><?php echo $tampil1['id_penjualan']; ?></td>
            <td>Tanggal Penjualan</td>
            <td>:</td>
            <td><?php echo $tampil1['tanggal_penjualan']; ?></td>
        </tr>
        <tr>
            <td>ID Pelanggan</td>
            <td>:</td>
            <td><?php echo $tampil1['id_pelanggan']; ?></td>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><?php echo $tampil1['nama_pelanggan']; ?></td>
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
        $sql2 = mysqli_prepare($koneksi, "SELECT dp.*, pr.nama_produk, pr.harga 
            FROM detail_penjualan dp
            JOIN produk pr ON dp.id_produk = pr.id_produk
            WHERE dp.id_penjualan = ?");
        mysqli_stmt_bind_param($sql2, "i", $id_penjualan);
        mysqli_stmt_execute($sql2);
        $result2 = mysqli_stmt_get_result($sql2);

        $no = 1;
        while ($tampil = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$tampil['id_produk']}</td>
                    <td>{$tampil['nama_produk']}</td>
                    <td>{$tampil['jumlah_produk']}</td>
                    <td>Rp " . number_format($tampil['harga'], 0, ',', '.') . "</td>
                    <td>Rp " . number_format($tampil['sub_total'], 0, ',', '.') . "</td>
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
?>
