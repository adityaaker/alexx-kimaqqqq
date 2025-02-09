-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Feb 2025 pada 15.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hadit_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah_produk` decimal(10,2) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `tanggal_penjualan` date DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `id_penjualan`, `id_produk`, `jumlah_produk`, `sub_total`, `tanggal_penjualan`, `update_at`) VALUES
(3, 19, 1, 1.00, 2000, NULL, '2025-02-04 16:36:44'),
(4, 19, 3, 1.00, 10000, NULL, '2025-02-04 16:36:57'),
(5, 19, 3, 1.00, 10000, NULL, '2025-02-04 16:49:15'),
(6, 19, 3, 1.00, 10000, NULL, '2025-02-04 16:49:24'),
(7, 19, 1, 1.00, 2000, NULL, '2025-02-04 16:50:53'),
(8, 19, 1, 1.00, 2000, NULL, '2025-02-04 16:51:04'),
(9, 19, 1, 1.00, 2000, NULL, '2025-02-04 16:52:24'),
(10, 37, 1, 9.00, 18000, NULL, '2025-02-05 13:10:35'),
(11, 38, 1, 10.00, 20000, NULL, '2025-02-05 13:18:02'),
(12, 38, 2, 1.00, 5000, NULL, '2025-02-05 13:18:10'),
(13, 39, 1, 1.00, 2000, NULL, '2025-02-05 13:23:13'),
(14, 39, 3, 5.00, 50000, NULL, '2025-02-05 13:23:54'),
(15, 39, 1, 1.00, 2000, NULL, '2025-02-05 13:24:08'),
(16, 40, 1, 1.00, 2000, NULL, '2025-02-05 14:37:42'),
(17, 43, 2, 6.00, 30000, NULL, '2025-02-05 16:10:38'),
(18, 44, 1, 1.00, 2000, NULL, '2025-02-05 16:15:38'),
(19, 45, 3, 6.00, 60000, NULL, '2025-02-06 14:30:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telepon`) VALUES
(1, 'aditya', 'jogja', '0896043985'),
(2, 'alex', 'depok', '089608985666'),
(3, 'yoga', 'pajangan', '0983830101');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `bayar` decimal(10,2) NOT NULL,
  `sisa_bayar` decimal(10,2) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal_penjualan`, `total_harga`, `bayar`, `sisa_bayar`, `id_pelanggan`, `update_at`) VALUES
(40, '2025-02-05', 2000.00, 0.00, 0.00, 1, '2025-02-05 14:37:42'),
(41, '2025-02-05', 0.00, 0.00, 0.00, 1, '2025-02-05 14:37:52'),
(42, '2025-02-05', 0.00, 0.00, 0.00, 1, '2025-02-05 14:44:33'),
(43, '2025-02-05', 30000.00, 80000.00, 50000.00, 1, '2025-02-05 16:11:10'),
(44, '2025-02-05', 2000.00, 40000.00, 38000.00, 1, '2025-02-05 16:15:42'),
(45, '2025-02-06', 60000.00, 100000.00, 40000.00, 3, '2025-02-06 14:30:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `foto_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `foto_produk`) VALUES
(1, 'Gelang Tridatu', 2000.00, 972, 'WhatsApp-Image-2024-01-13-at-13.23.35_30dda336.jpg'),
(2, 'Gelang Mutiara', 5000.00, 992, 'WhatsApp Image 2025-01-24 at 22.08.33_0aff7110.jpg'),
(3, 'kalung preman', 10000.00, 985, 'data.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(2, 'petugas', 'petugas', 'petugas', 'petugas'),
(22, 'hadit', 'adit', 'adit', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9230934;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
