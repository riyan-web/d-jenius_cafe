-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2021 at 11:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juice`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_jual`
--

CREATE TABLE `detail_jual` (
  `kd_jual` varchar(25) NOT NULL,
  `kd_barang` int(6) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `harga_satuan` int(15) NOT NULL,
  `sub_total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_jual`
--

INSERT INTO `detail_jual` (`kd_jual`, `kd_barang`, `jumlah`, `harga_satuan`, `sub_total`) VALUES
('TJ-200312483101', 19, 1, 100033, 100033),
('TJ-200312130502', 19, 1, 100033, 100033),
('TJ-200316561502', 19, 1, 100033, 100033),
('TJ-200331040303', 19, 2, 100033, 200066),
('TJ-200331371004', 31, 1, 0, 0),
('TJ-200331371004', 23, 6, 1000, 6000),
('TJ-200331371004', 33, 1, 0, 0),
('TJ-200405335405', 55, 1, 10000, 10000),
('TJ-200405345106', 62, 1, 5500, 5500),
('TJ-200405351107', 63, 1, 7000, 7000),
('TJ-210318595908', 19, 1, 8000, 8000),
('TJ-210318595908', 24, 1, 9000, 9000),
('TJ-210318595908', 31, 1, 7500, 7500);

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kd_barang` int(6) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(15) NOT NULL,
  `kd_kategori` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kd_barang`, `nama_barang`, `harga`, `kd_kategori`) VALUES
(19, 'Ayam Kepruk', 8000, 2),
(23, 'Kopi Madu Tubruk Arb', 7000, 4),
(24, 'Ayam Kepruk Crispy', 9000, 2),
(31, 'Lele Kepruk', 7500, 2),
(33, 'Telur Gepruk', 6500, 2),
(40, 'Jus Jambu', 5500, 7),
(44, 'Tempe Gepruk', 6000, 2),
(45, 'Tahu Gepruk', 6000, 2),
(55, 'Iwak Peyek', 10000, 2),
(60, 'sate soto madura ', 12000, 2),
(62, 'Jus Buah Naga', 5500, 7),
(63, 'Jus Alpukat', 7000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `nama_kategori`) VALUES
(2, 'D`jenius Food'),
(4, 'D`jenius Coffe'),
(7, 'D`jenius Juice');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keuangan`
--

CREATE TABLE `tb_keuangan` (
  `kd_keuangan` int(6) NOT NULL,
  `tanggal` date NOT NULL,
  `modal_awal` int(15) NOT NULL,
  `sisa_modal` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_keuangan`
--

INSERT INTO `tb_keuangan` (`kd_keuangan`, `tanggal`, `modal_awal`, `sisa_modal`) VALUES
(1, '2020-03-31', 30000000, 30206066);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `kd_login` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`kd_login`, `username`, `password`, `nama_user`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'yudistiono', 'avatar5.png'),
(2, 'rendi', '$2y$10$y7CTxPIeOsBx9jzOCdfIFu5lm.BLqLe8xWZkS3wkXsDteaOTGe.Bq', '', ''),
(3, 'riyan', '88b4eab29f93f81517eafb67774c73c2', 'yudi iriyanto', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_operasional`
--

CREATE TABLE `tb_operasional` (
  `kd_operasional` int(6) NOT NULL,
  `nama_operasional` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah` int(6) NOT NULL,
  `tanggal` date NOT NULL,
  `tipe` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_operasional`
--

INSERT INTO `tb_operasional` (`kd_operasional`, `nama_operasional`, `deskripsi`, `jumlah`, `tanggal`, `tipe`) VALUES
(2, 'buah alpukat', 'untuk keperluan jus', 50000, '2021-03-19', 'inventaris'),
(3, 'Timun', 'Untuk keperluan jus', 20000, '2021-03-19', 'baru'),
(4, 'dd', 'dd', 21111, '2021-03-21', 'daa'),
(5, 'dd', 'dd', 21111, '2021-03-02', 'daa'),
(9, 'beli cabe hijau', 'cabe rawit murah h', 200002, '2021-03-22', 'cabean');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_jual`
--

CREATE TABLE `transaksi_jual` (
  `kd_jual` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_total` int(4) NOT NULL,
  `total_harga` int(15) NOT NULL,
  `bayar` int(15) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_jual`
--

INSERT INTO `transaksi_jual` (`kd_jual`, `tanggal`, `jumlah_total`, `total_harga`, `bayar`, `catatan`) VALUES
('TJ-200312130502', '2020-03-12', 1, 100033, 80000000, ''),
('TJ-200312483101', '2020-03-12', 1, 100033, 1000000, ''),
('TJ-200316561502', '2020-03-16', 1, 100033, 900000, ''),
('TJ-200331040303', '2020-03-31', 2, 200066, 300000, ''),
('TJ-200331371004', '2020-03-31', 8, 6000, 10000, ''),
('TJ-200405335405', '2020-04-05', 1, 10000, 10000, ''),
('TJ-200405345106', '2020-04-05', 1, 5500, 10000, ''),
('TJ-200405351107', '2021-03-20', 1, 7000, 10000, ''),
('TJ-210318595908', '2021-03-20', 3, 24500, 50000, 'Meja 5');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(2) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `password`, `role_id`, `foto`) VALUES
(1, 'Lliyana Putri', 'liyana', 'liyana123', 1, 'default.jpg'),
(2, 'Raden Saputra', 'raden', 'raden123', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(2) NOT NULL,
  `menu_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 1),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 7),
(14, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'home'),
(2, 'dashboard'),
(3, 'barang'),
(4, 'kategori'),
(5, 'pengeluaran'),
(6, 'penjualan'),
(7, 'transaksi'),
(8, 'laporan'),
(9, 'lappenjualan'),
(10, 'laplabarugi');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD KEY `kd_jual` (`kd_jual`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_kategori` (`kd_kategori`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `tb_keuangan`
--
ALTER TABLE `tb_keuangan`
  ADD PRIMARY KEY (`kd_keuangan`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`kd_login`);

--
-- Indexes for table `tb_operasional`
--
ALTER TABLE `tb_operasional`
  ADD PRIMARY KEY (`kd_operasional`);

--
-- Indexes for table `transaksi_jual`
--
ALTER TABLE `transaksi_jual`
  ADD PRIMARY KEY (`kd_jual`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`menu_id`),
  ADD KEY `id_user` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `kd_barang` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_keuangan`
--
ALTER TABLE `tb_keuangan`
  MODIFY `kd_keuangan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `kd_login` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_operasional`
--
ALTER TABLE `tb_operasional`
  MODIFY `kd_operasional` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD CONSTRAINT `detail_jual_ibfk_1` FOREIGN KEY (`kd_jual`) REFERENCES `transaksi_jual` (`kd_jual`),
  ADD CONSTRAINT `detail_jual_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`);

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `tb_kategori` (`kd_kategori`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
