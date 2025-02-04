<?php
include "koneksi.php";

// Ambil ID pelanggan terakhir dan tambahkan 1 untuk ID baru
$data = mysqli_fetch_row(mysqli_query($koneksi, "SELECT MAX(id_pelanggan) FROM pelanggan"));
$no = $data[0] + 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Pelanggan</title>
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
            border-collapse: collapse;
        }
        th {
            background-color: #0082e6;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 18px;
        }
        td {
            padding: 8px;
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #0082e6;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005bb5;
        }
        input[type="reset"] {
            background-color: #e0e0e0;
            color: #333333;
            border: none;
            cursor: pointer;
        }
        input[type="reset"]:hover {
            background-color: #b0b0b0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Input Data Pelanggan</h2>
        <form name="form_pelanggan" method="post" action="exe_pelanggan.php" enctype="multipart/form-data">
            <table border="0">
                <tr>
                    <th colspan="3">Input Data Pelanggan</th>
                </tr>
                <tr>
                    <td>ID Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="id_pelanggan" value="<?php echo $no; ?>" size="10" readonly></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="nama_pelanggan" size="40" required></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><input type="text" name="alamat" size="25" required></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td><input type="text" name="no_telepon" size="25" required></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" name="simpan" value="Simpan">
                        <input type="reset" value="Batal">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>