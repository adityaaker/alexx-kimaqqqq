<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f7f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
        .foto-produk {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-zoom {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        .modal-zoom img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }
        .btn-add {
            display: block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin: 20px auto 0;
            text-align: center;
            cursor: pointer;
            width: max-content;
        }
        .btn-add:hover {
            background-color: #218838;
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
        echo "<p>Jumlah data produk: " . htmlspecialchars($jumlah) . "</p>";
        ?>
        <table>
            <tr>
                <th>ID PRODUK</th>
                <th>NAMA PRODUK</th>
                <th>HARGA</th>
                <th>STOK</th>
                <th>FOTO</th>
                <th>EDIT</th>
                <th>HAPUS</th>
            </tr>
            <?php
            while ($baris = mysqli_fetch_array($sql_produk)) {
                $id_produk = htmlspecialchars($baris['id_produk']);
                $nama_produk = htmlspecialchars($baris['nama_produk']);
                $harga = htmlspecialchars($baris['harga']);
                $stok = htmlspecialchars($baris['stok']);
                $foto_produk = htmlspecialchars($baris['foto_produk']);
                $foto_path = "uploads/" . $foto_produk;
                echo "<tr>
                    <td>{$id_produk}</td>
                    <td>{$nama_produk}</td>
                    <td>{$harga}</td>
                    <td>{$stok}</td>
                    <td>" . (file_exists($foto_path) ? "
                        <img src='{$foto_path}' alt='Foto Produk' class='foto-produk' onclick='openZoomModal(\"{$foto_path}\")'>
                    " : "Tidak Ada Foto") . "</td>
                    <td><a href='edit_produk.php?id_produk={$id_produk}'>Edit</a></td>
                    <td><a href='hapus_produk.php?id_produk={$id_produk}' onclick='return confirm(\"Apakah Anda ingin menghapus data produk {$id_produk} ... ?\")'>Hapus</a></td>
                </tr>";
            }
            ?>
        </table>
        <button class="btn-add" onclick="window.location.href='form_input_produk.php'">Tambah Produk</button>
    </div>

    <!-- Modal untuk Zoom Gambar -->
    <div id="zoomModal" class="modal-zoom" onclick="closeZoomModal()">
        <img id="zoomImage" src="" alt="Gambar Zoom">
    </div>

    <script>
    function openZoomModal(src) {
        if (src) {
            document.getElementById('zoomImage').src = src;
            document.getElementById('zoomModal').style.display = "flex";
        }
    }

    function closeZoomModal() {
        document.getElementById('zoomModal').style.display = "none";
    }
    </script>
</body>
</html>