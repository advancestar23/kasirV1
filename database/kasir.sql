-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2024 at 08:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` double NOT NULL,
  `stock` int NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `stock`, `gambar`) VALUES
(4, 'kuota 500 gb', 20000, 0, ''),
(5, 'kuota 5000 gb', 2000, 299, ''),
(8, 'dasdsas', 12000, 0, ''),
(9, 'dsa12', 1230000, 2, ''),
(21, 'ada', 9900, 10, ''),
(22, 'asdsad', 9900, 29, ''),
(24, 'laptop ada', 990000, 12, ''),
(25, 'asdddd', 990000, 12, ''),
(26, 'sa', 3242, 766, ''),
(27, 'TV Samsung LED 23 Inch', 1230000, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_masuk`
--

CREATE TABLE `stock_masuk` (
  `id_stok_masuk` int NOT NULL,
  `id_produk` int NOT NULL,
  `tanggal_masuk` varchar(40) NOT NULL,
  `jumlah_masuk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_masuk`
--

INSERT INTO `stock_masuk` (`id_stok_masuk`, `id_produk`, `tanggal_masuk`, `jumlah_masuk`) VALUES
(3, 5, '2023-06-11', 13),
(8, 26, '2024-01-13', 100);

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id_stok_keluar` int NOT NULL,
  `id_produk` int NOT NULL,
  `tanggal_keluar` varchar(40) NOT NULL,
  `jumlah_keluar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id_stok_keluar`, `id_produk`, `tanggal_keluar`, `jumlah_keluar`) VALUES
(1, 4, '2023-06-11', 2),
(3, 4, '2023-06-11', 4),
(10, 8, '2024-01-06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_produk` int NOT NULL,
  `tanggal_transaksi` varchar(40) NOT NULL,
  `jumlah_transaksi` int NOT NULL,
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_produk`, `tanggal_transaksi`, `jumlah_transaksi`, `total_harga`) VALUES
(1, 1, '2023-06-11 11:05:00', 0, 0),
(8, 1, '2023-06-11 11:18:47', 1, 1230000),
(11, 1, '2023-06-11 12:25:16', 1, 1230000),
(12, 1, '2023-06-11 12:31:16', 12, 14760000),
(13, 1, '2023-06-11 12:32:49', 12, 14760000),
(14, 1, '2023-06-11 15:12:08', 1, 1230000),
(15, 4, '2023-06-11 15:12:08', 1, 20000),
(16, 1, '2023-06-11 15:12:56', 1, 1230000),
(17, 1, '2023-06-11 15:12:56', 12, 14760000),
(18, 1, '2023-06-11 17:33:08', 1, 1230000),
(19, 1, '2023-06-11 17:43:19', 1, 1230000),
(20, 4, '2023-06-11 17:44:33', 1, 20000),
(21, 4, '2023-06-11 17:47:52', 1, 20000),
(22, 1, '2023-06-11 17:52:36', 1, 1230000),
(23, 1, '2023-06-12 01:12:03', 1, 1230000),
(24, 4, '2023-06-12 01:32:10', 1, 20000),
(25, 8, '2024-01-06 14:12:22', 23, 276000),
(26, 8, '2024-01-06 20:13:21', 1, 12000),
(27, 9, '2024-01-06 20:13:21', 2, 6484),
(28, 9, '2024-01-10 20:25:49', 1, 1230000),
(29, 9, '2024-01-10 20:28:58', 1, 1230000),
(30, 5, '2024-01-10 20:31:22', 1, 2000),
(31, 8, '2024-01-10 20:32:02', 1, 12000),
(32, 9, '2024-01-10 21:27:47', 1, 1230000),
(33, 9, '2024-01-10 21:29:23', 1, 1230000),
(34, 8, '2024-01-10 21:32:06', 1, 12000),
(35, 5, '2024-01-10 21:35:57', 12, 24000),
(36, 1, '2024-01-10 21:46:46', 1, 1230000),
(37, 8, '2024-01-10 21:55:53', 1, 12000),
(38, 8, '2024-01-10 22:37:30', 2, 24000),
(39, 8, '2024-01-10 22:38:48', 1, 12000),
(40, 4, '2024-01-15 12:59:07', 1, 20000),
(41, 4, '2024-01-15 14:22:05', 9, 180000),
(42, 9, '2024-01-15 14:22:05', 15, 18450000),
(43, 8, '2024-01-15 14:22:05', 59, 708000),
(44, 5, '2024-01-15 14:22:45', 1, 2000),
(45, 26, '2024-01-15 14:33:53', 2, 6484),
(46, 26, '2024-01-15 14:34:22', 2, 6484),
(47, 26, '2024-01-15 20:33:28', 1, 3242),
(48, 26, '2024-01-15 20:35:18', 1, 3242),
(49, 26, '2024-01-15 20:38:51', 1, 3242),
(50, 26, '2024-01-15 20:44:23', 1, 3242),
(51, 26, '2024-01-15 20:58:28', 1, 3242),
(52, 26, '2024-01-15 20:59:30', 1, 3242),
(53, 26, '2024-01-15 21:12:33', 1, 3242),
(54, 26, '2024-01-16 23:52:29', 1, 3242),
(55, 26, '2024-01-16 23:54:01', 2, 6484),
(56, 26, '2024-01-16 23:56:17', 2, 6484),
(57, 26, '2024-01-16 23:58:23', 1, 3242),
(58, 26, '2024-01-17 00:00:01', 1, 3242),
(59, 26, '2024-01-17 00:00:32', 1, 3242),
(60, 26, '2024-01-17 00:11:33', 1, 3242),
(61, 26, '2024-01-17 00:13:31', 1, 3242),
(62, 9, '2024-01-17 00:13:31', 1, 1230000),
(63, 26, '2024-01-17 00:13:45', 1, 3242),
(64, 26, '2024-01-17 00:17:26', 1, 3242),
(65, 26, '2024-01-17 00:18:20', 1, 3242),
(66, 21, '2024-01-17 00:18:20', 2, 19800),
(67, 26, '2024-01-17 00:24:18', 2, 6484),
(68, 26, '2024-01-17 00:30:47', 2, 6484),
(69, 26, '2024-01-17 00:31:10', 1, 3242),
(70, 26, '2024-01-17 00:31:52', 1, 3242),
(71, 26, '2024-01-17 00:35:17', 1, 3242),
(72, 26, '2024-01-17 00:36:35', 1, 3242),
(73, 26, '2024-01-17 00:37:44', 2, 6484),
(74, 4, '2024-07-01 06:24:00', 1, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('admin','operator') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `username`, `password`, `pass`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `level`) VALUES
(1, 'ada@gmail.com', '202cb962ac59075b964b07152d234b70', '123', 'pasti', 'Laki-laki', 'pasti', 'admin'),
(3, 'advancestar@gmail.com', '8c8d357b5e872bbacd45197626bd5759', 'ada', 'gada', 'Perempuan', 'fada', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `stock_masuk`
--
ALTER TABLE `stock_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id_stok_keluar`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stock_masuk`
--
ALTER TABLE `stock_masuk`
  MODIFY `id_stok_masuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_stok_keluar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock_masuk`
--
ALTER TABLE `stock_masuk`
  ADD CONSTRAINT `stock_masuk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `stok_keluar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
