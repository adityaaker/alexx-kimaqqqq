<?php
session_start();
?>

<html>

<head>
    <title>Form Input Data Penjualan</title>
    <link rel="stylesheet" type="text/css" href="global.main.css">
    <style>
        /* ISI STYLE DISINI */

    </style>
</head>

<body>
    <?php
    include "../../../config.php";
    $data = mysqli_fetch_row(mysqli_query($config, "SELECT MAX(PenjualanID) FROM penjualan"));
    $no = $data[0] + 1;
    ?>
    <form method="post" action="components/index.php" class="container">
        <h1>INPUT DATA TRANSAKSI PENJUALAN</h1>
        <label for="id_penjualan">ID Penjualan</label>
        <input type="text" name="id_penjualan" value="<?php echo $no; ?>" readonly>

        <label for="tgl_penjualan">Tanggal Penjualan</label>
        <input type="date" name="tgl_penjualan" value="<?php echo date('Y-m-d'); ?>">

        <label for="total_harga">Total Harga</label>
        <input type="number" name="total_harga" value="0" required>


        <label for="id_pelanggan">ID Pelanggan</label>
        <select name="id_pelanggan">
            <option value='not_pelanggan'>Pilih Data Pelanggan</option>
            <?php
            $sql = "SELECT * FROM pelanggan ORDER BY PelangganID";
            $array = mysqli_query($config, $sql);
            while ($hasil = mysqli_fetch_array($array)) {
                echo "<option value='{$hasil['PelangganID']}'>{$hasil['PelangganID']} ~ {$hasil['NamaPelanggan']}</option>";
            }
            ?>
        </select>

        <div class="button-group">
            <button type="submit" name="tambah" class="btn">Lanjut</button>
            <button type="reset" name="batal" class="btn">Reset</button>
        </div>
    </form>
</body>

</html>