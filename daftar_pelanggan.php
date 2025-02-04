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
            background-color: #d1e7fd;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>DAFTAR PELANGGAN</h1>
        <div class="info">
            <?php
            include "koneksi.php";
            $sql_pelanggan = mysqli_query($koneksi, "select * from pelanggan");
            $jumlah = mysqli_num_rows($sql_pelanggan);
            echo ("Jumlah data pelanggan: $jumlah");
            ?>
        </div>
        <table>
            <tr>
                <th>ID PELANGGAN</th>
                <th>NAMA PELANGGAN</th>
                <th>ALAMAT</th>
                <th>NO TELEPON</th>
                <th>EDIT</th>
                <th>HAPUS</th>
            </tr>
            <?php
            while ($baris = mysqli_fetch_array($sql_pelanggan)) {
                echo "<tr>
                    <td>{$baris['id_pelanggan']}</td>
                    <td>{$baris['nama_pelanggan']}</td>
                    <td>{$baris['alamat']}</td>
                    <td>{$baris['no_telepon']}</td>
                    <td><a href='edit_pelanggan.php?id_pelanggan={$baris['id_pelanggan']}'>Edit</a></td>
                    <td><a href='hapus_pelanggan.php?id_pelanggan=$baris[0]' onclick='return confirm(\"Apakah anda ingin menghapus data pelanggan $baris[0] ... ?\")'>Hapus</a></td>
    </tr>";
            }
            ?>
        </table>
        <button class="btn-add" onclick="window.location.href='form_pelanggan.php'">Tambah Pelanggan</button>
    </div>
    
</body>
</html>
