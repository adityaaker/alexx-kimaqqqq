<?php
    include "koneksi.php";  // Pastikan koneksi.php sudah benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Produk</title>
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
            padding: 12px;
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
    $id_produk=$_REQUEST['id_produk'];
    
       include "koneksi.php";
       $sql_edit=mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id_produk'");
       $edit_produk=mysqli_fetch_array($sql_edit);
    ?>
<body>

    <div class="container">
       
        <form name="form_produk" method="post" action="exe_edit_produk.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <th colspan="3">Input Data Produk</th>
                </tr>
                <tr>
                    <td>ID Produk</td>
                    <td><input type="text" name="id_produk" value="<?php echo "$edit_produk[id_produk]";?>" size="10" required></td>
                </tr>
                <tr>
                    <td>Nama Produk</td>
                    <td><input type="text" name="nama_produk" value="<?php echo "$edit_produk[nama_produk]";?>" size="40" required></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="harga" value="<?php echo "$edit_produk[harga]";?>" size="25" required></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="text" name="stok" value="<?php echo "$edit_produk[stok]";?>" size="25" required></td>
                </tr>
                <tr>
                    <td>Foto Produk</td>
                    <td><input type="file" name="foto_produk" value="<?php echo "$edit_produk[foto_produk]";?>" accept="image/*" required></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <input type="submit" name="simpan" value="Simpan">
                        <input type="reset" value="Batal">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>
