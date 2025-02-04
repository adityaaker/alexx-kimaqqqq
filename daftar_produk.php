<html>
<head>
<style>
    /* Global Styling */
    body {
        font-family: 'Arial', sans-serif;
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
        max-width: 1000px;
    }

    h1 {
        text-align: center;
        color: #0082e6;
        margin-bottom: 20px;
    }

    .info {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #0082e6;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:nth-child(odd) {
        background-color: #f1f1f1;
    }

    table tr:hover {
        background-color: #dff0d8;
    }

    .btn-refresh {
        background-color: #ff9800;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-refresh:hover {
        background-color: #e68900;
    }

    .btn-add {
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        margin-top: 20px;
        text-align: center;
        cursor: pointer;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    .foto-produk {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>DAFTAR PRODUK</h1>
        <?php
        include "koneksi.php";
        $sql_produk = mysqli_query($koneksi, "SELECT * FROM produk");
        $jumlah = mysqli_num_rows($sql_produk);
        echo ("Jumlah data produk = $jumlah");
        ?>
        <table border="1" width="100%" cellpadding="5" cellspacing="0">
            <tr>
                <th align="center">ID PRODUK</th>
                <th align="center">NAMA PRODUK</th>
                <th align="center">HARGA</th>
                <th align="center">STOK</th>
                <th align="center">FOTO</th>
                <th align="center">EDIT</th>
                <th align="center">HAPUS</th>
            </tr>
            <?php
            while ($baris = mysqli_fetch_array($sql_produk)) {
                $foto_produk = $baris['foto_produk']; // Asumsi ada kolom 'foto_produk' di database
                echo "<tr>
                    <td>{$baris['id_produk']}</td>
                    <td>{$baris['nama_produk']}</td>
                    <td>{$baris['harga']}</td>
                    <td>{$baris['stok']}</td>
                    <td><img src='uploads/{$foto_produk}' alt='Foto Produk' class='foto-produk'></td>
                    <td><a href='edit_produk.php?id_produk={$baris['id_produk']}'>Edit</a></td>
                    <td><a href='hapus_produk.php?id_produk={$baris['id_produk']}' onclick='return confirm(\"Apakah Anda ingin menghapus data produk {$baris['id_produk']} ... ?\")'>Hapus</a></td>
                </tr>";
            }
            ?>
        </table>
        <div>
            <button class="btn-add" onclick="window.location.href='form_input_produk.php'">Tambah Produk</button>
        </div>
    </div>
</body>
</html>