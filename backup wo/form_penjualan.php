<?php
include "koneksi.php";

// Ambil ID penjualan terakhir
$data = mysqli_fetch_row(mysqli_query($koneksi, "SELECT MAX(id_penjualan) FROM penjualan"));
$no = $data[0] + 1;

// Ambil daftar pelanggan
$pelanggan = mysqli_query($koneksi, "SELECT id_pelanggan, nama_pelanggan FROM pelanggan");

// Ambil daftar produk
$produk = mysqli_query($koneksi, "SELECT id_produk, nama_produk, harga FROM produk");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #0082e6;
        }
        table {
            width: 100%;
        }
        td {
            padding: 8px;
        }
        select, input[type="text"], input[type="date"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #0082e6;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Input Data Penjualan</h2>
        <form name="form_penjualan" method="post" action="exe_penjualan.php">
            <table>
                <tr>
                    <td>ID Penjualan</td>
                    <td><input type="text" name="id_penjualan" value="<?php echo $no; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Tanggal Penjualan</td>
                    <td><input type="date" name="tanggal_penjualan" required></td>
                </tr>
                <tr>
    <td>Nama Pelanggan</td>
    <td>
        <select name="id_pelanggan" required>
            <option value="">Pilih Pelanggan</option>
            <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $p['id_pelanggan']; ?>"><?= $p['nama_pelanggan']; ?></option>
            <?php } ?>
        </select>
    </td>
</tr>

                <tr>
                    <td>Produk</td>
                    <td>
                        <select name="id_produk" id="id_produk" required onchange="updateHarga()">
                            <option value="">Pilih Produk</option>
                            <?php while ($p = mysqli_fetch_assoc($produk)) { ?>
                                <option value="<?= $p['id_produk']; ?>" data-harga="<?= $p['harga']; ?>">
                                    <?= $p['nama_produk']; ?> - Rp<?= number_format($p['harga'], 0, ',', '.'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td><input type="number" name="jumlah" id="jumlah" min="1" value="1" required oninput="hitungTotal()"></td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td><input type="text" name="total_harga" id="total_harga" readonly></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="simpan" value="Simpan">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        function updateHarga() {
            var produk = document.getElementById("id_produk");
            var harga = produk.options[produk.selectedIndex].getAttribute("data-harga");
            document.getElementById("total_harga").value = harga;
            hitungTotal();
        }

        function hitungTotal() {
            var produk = document.getElementById("id_produk");
            var harga = produk.options[produk.selectedIndex].getAttribute("data-harga");
            var jumlah = document.getElementById("jumlah").value;
            if (harga && jumlah) {
                document.getElementById("total_harga").value = harga * jumlah;
            }
        }
    </script>
</body>
</html>
