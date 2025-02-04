<?php
include "koneksi.php";
$hasil = mysqli_query($konek, "SELECT * FROM penjualan_tb");
$jumlah = mysqli_num_rows($hasil);
echo "<p><h3><font color=black> DAFTAR PENJUALAN </h3></font></p>";
echo "<p> Jumlah data penjualan : $jumlah </p>";
echo "
 <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fce4ec; /* Latar belakang pink muda */
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 50px auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
        color: #e91e63; /* Pink cerah untuk judul */
    }

    p {
        font-size: 16px;
        color: #e91e63; /* Pink cerah untuk teks paragraf */
        text-align: center;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 5px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        text-align: left;
        vertical-align: middle;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #ec407a; /* Warna pink cerah untuk header */
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f8bbd0; /* Pink muda untuk baris genap */
    }

    tr:hover {
        background-color: #f1c1d1; /* Warna pink lembut saat hover */
    }

    td {
        color: #333;
    }

    .center {
        text-align: center;
    }
</style>

    <div class='container'>
        <table>
            <tr>
                <th> ID Penjualan </th>
                <th> Tgl Penjualan </th>
                <th> Total Harga </th>
                <th> ID Pelanggan </th>
                <th> Bayar </th>
                <th> Sisa Bayar </th>
            </tr>";
while ($baris = mysqli_fetch_array($hasil)) {
    echo "<tr>
        <td class='center'> $baris[id_penjualan] </td>
        <td> $baris[tgl_penjualan] </td>
        <td> $baris[total_harga] </td>
        <td> $baris[id_pelanggan] </td>
        <td> $baris[bayar] </td>
        <td> $baris[sisabayar] </td>
    </tr>";
}
echo "</table>
    </div>";
?>
