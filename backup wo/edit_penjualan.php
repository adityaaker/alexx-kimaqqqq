<?php
    include "koneksi.php";  // Pastikan koneksi.php sudah benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #0082e6;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
        }

        table th {
            background-color: #0082e6;
            color: white;
            padding: 10px;
            text-align: center;
        }

        table td {
            padding: 10px;
        }

        input[type="text"], input[type="date"], input[type="submit"], input[type="reset"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        input[type="reset"] {
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="reset"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<?php
    // Mengambil ID penjualan dari parameter URL
    $id_penjualan = $_REQUEST['id_penjualan'];

    // Mengambil data penjualan dari database untuk ID tertentu
    $sql_edit = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan='$id_penjualan'");
    $edit_penjualan = mysqli_fetch_array($sql_edit);

    // Mengambil nama pelanggan berdasarkan id_pelanggan
    $id_pelanggan = $edit_penjualan['id_pelanggan'];
    $sql_pelanggan = mysqli_query($koneksi, "SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
    $pelanggan = mysqli_fetch_array($sql_pelanggan);
?>

<body>

    <div class="container">
        <h2>Edit Data Penjualan</h2>
        <form name="form_penjualan" method="post" action="exe_edit_penjualan.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID Penjualan</td>
                    <td><input type="text" name="id_penjualan" value="<?php echo $edit_penjualan['id_penjualan']; ?>" size="10" required readonly></td>
                </tr>
                <tr>
                    <td>Tanggal Penjualan</td>
                    <td><input type="date" name="tanggal_penjualan" value="<?php echo $edit_penjualan['tanggal_penjualan']; ?>" required></td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td><input type="text" name="total_harga" value="<?php echo $edit_penjualan['total_harga']; ?>" size="25" required></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>
                        <select name="nama_pelanggan" required>
                            <option value="">Pilih Pelanggan</option>
                            <?php
                                // Menampilkan daftar pelanggan
                                $sql_pelanggan_list = mysqli_query($koneksi, "SELECT id_pelanggan, nama_pelanggan FROM pelanggan");
                                while ($p = mysqli_fetch_assoc($sql_pelanggan_list)) {
                                    $selected = ($p['nama_pelanggan'] == $pelanggan['nama_pelanggan']) ? 'selected' : '';
                                    echo "<option value='{$p['nama_pelanggan']}' $selected>{$p['nama_pelanggan']}</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="simpan" value="Simpan">
                        <input type="reset" value="Batal">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>
