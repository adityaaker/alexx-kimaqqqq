<?php
    include "koneksi.php";  // Pastikan koneksi.php sudah benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan</title>
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

        input[type="text"], input[type="submit"], input[type="reset"] {
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
    $id_pelanggan = $_REQUEST['id_pelanggan'];
    $sql_edit = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
    $edit_pelanggan = mysqli_fetch_array($sql_edit);
?>
<body>

    <div class="container">
        <h2>Edit Data Pelanggan</h2>
        <form name="form_pelanggan" method="post" action="exe_edit_pelanggan.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID Pelanggan</td>
                    <td><input type="text" name="id_pelanggan" value="<?php echo $edit_pelanggan['id_pelanggan']; ?>" size="10" required readonly></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td><input type="text" name="nama_pelanggan" value="<?php echo $edit_pelanggan['nama_pelanggan']; ?>" size="40" required></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="<?php echo $edit_pelanggan['alamat']; ?>" size="25" required></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td><input type="text" name="no_telepon" value="<?php echo $edit_pelanggan['no_telepon']; ?>" size="25" required></td>
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
