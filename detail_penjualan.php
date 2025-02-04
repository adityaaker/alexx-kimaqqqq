<?php

include "koneksi.php"; // Pastikan koneksi sudah benar

if (!isset($_SESSION['user'])) {
    die("Error: Anda belum login atau sesi sudah berakhir.");
}

$PenjualanID = $_SESSION['user']['id_penjualan'];

// Ambil data penjualan berdasarkan id_penjualan
$sql_jual = mysqli_prepare($koneksi, 
    "SELECT penjualan.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan 
    FROM penjualan 
    JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
    WHERE penjualan.id_penjualan = ?"
);

if ($sql_jual) {
    mysqli_stmt_bind_param($sql_jual, "i", $PenjualanID);
    mysqli_stmt_execute($sql_jual);
    $result = mysqli_stmt_get_result($sql_jual);
    $Show = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (!$Show) {
        die("Error: Data penjualan tidak ditemukan.");
    }

    $tglpenjualan = $Show['tanggal_penjualan'];
    $namapelanggan = $Show['nama_pelanggan'];
    $totalharga = $Show['total_harga'];
} else {
    die("Error: " . mysqli_error($koneksi));
}
?>

<link rel="stylesheet" href="global.main.css">

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

    <form method="post" action="exe_detail_penjualan.php">
        <table cellspacing="0" cellpadding="5">
            <tr>
                <td>ID Produk</td>
                <td>: </td>
                <td>
                    <select name="id_produk" required>
                        <option value="">Pilih Produk</option>
                        <?php
                        $sql_produk = "SELECT * FROM produk ORDER BY id_produk";
                        $query_produk = mysqli_query($koneksi, $sql_produk);
                        while ($produk = mysqli_fetch_array($query_produk)) {
                            echo "<option value='{$produk['id_produk']}'>{$produk['id_produk']} ~ {$produk['nama_produk']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah Produk</td>
                <td>: </td>
                <td>
                    <input type="number" name="jml_produk" value="1" min="1" required>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="center">
                    <input type="submit" name="tambah_produk" value="Tambah Produk" class="btn">
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Ambil data detail penjualan
    $sql_detail = mysqli_prepare($koneksi, 
        "SELECT detail_penjualan.id_produk, produk.nama_produk, detail_penjualan.jumlah_produk, produk.harga, 
        (detail_penjualan.jumlah_produk * produk.harga) AS subtotal 
        FROM detail_penjualan 
        JOIN produk ON detail_penjualan.id_produk = produk.id_produk 
        WHERE detail_penjualan.id_penjualan = ?"
    );

    if ($sql_detail) {
        mysqli_stmt_bind_param($sql_detail, "i", $PenjualanID);
        mysqli_stmt_execute($sql_detail);
        $result_detail = mysqli_stmt_get_result($sql_detail);

        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>Produk ID</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                </tr>";

        while ($row = mysqli_fetch_array($result_detail, MYSQLI_ASSOC)) {
            echo "<tr>
                    <td align='center'>{$row['id_produk']}</td>
                    <td>{$row['nama_produk']}</td>
                    <td align='center'>{$row['jumlah_produk']}</td>
                    <td align='right'>" . number_format($row['harga'], 0, ',', '.') . "</td>
                    <td align='right'>" . number_format($row['subtotal'], 0, ',', '.') . "</td>
                  </tr>";
        }

        echo "</table>";
        mysqli_stmt_close($sql_detail);
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
    ?>

    <form method="POST" action="cetak.php">
        <tr>
            <td colspan="4" class="align-right">Bayar</td>
            <td><input type="text" name="bayar" required></td>
        </tr>
        <tr>
            <td colspan="5" class="center">
                <input type="submit" name="cetak" value="Cetak dan Selesai" class="btn">
            </td>
        </tr>
    </form>
</div>
