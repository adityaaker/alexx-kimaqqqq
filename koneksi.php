<?php

$host = "localhost";
$user = "root";
$password = "";
$namadatabase = "hadit_kasir";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password);
if (!$koneksi) {
    die("Gagal koneksi karena: " . mysqli_connect_error());
}

// Memilih database
$dbkonek = mysqli_select_db($koneksi, $namadatabase);
if (!$dbkonek) {
    die("Gagal memilih database $namadatabase: " . mysqli_error($koneksi));
}

?>