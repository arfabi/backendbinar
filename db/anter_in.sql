-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2017 at 02:11 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anter.in`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL,
  `id_toko` int(12) DEFAULT NULL,
  `nama_admin` tinytext,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `foto` varchar(32) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `level` enum('Owner','Staff','Kasir') DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_toko`, `nama_admin`, `username`, `password`, `foto`, `no_hp`, `level`, `token`, `last_login`) VALUES
(1, NULL, 'Ridlo Fadlli', 'admin', 'ef690437b31298621e42641bbe87862e', '720160922142900.png', NULL, 'Owner', 'c4ca4238a0b923820dcc509a6f75849b', '2017-12-22 20:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(12) NOT NULL,
  `id_kategori` int(12) DEFAULT NULL,
  `kd_barang` varchar(15) DEFAULT NULL,
  `nama_barang` tinytext,
  `harga_beli` float DEFAULT NULL,
  `harga_jual` float DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `kd_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`) VALUES
(1, 1, 'SF-001', 'Burger King', 25000, 40000, 14),
(2, 1, 'SF-002', 'Frienc Fries', 35000, 50000, 16),
(3, 1, 'SF-003', 'Chicken Wing', 37500, 60000, 9),
(4, 1, 'SF-004', 'Corn Tomatos', 10000, 60000, 6),
(5, 1, 'SF-005', 'Seblak', 69000, 100000, 2),
(6, 1, 'KD001', 'Burger', 100000, 30000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `barang_kategori`
--

CREATE TABLE `barang_kategori` (
  `id_kategori` int(12) NOT NULL,
  `nama_kategori` tinytext,
  `status_kategori` enum('A','T','D') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_kategori`
--

INSERT INTO `barang_kategori` (`id_kategori`, `nama_kategori`, `status_kategori`) VALUES
(1, 'Fast Food', 'A'),
(2, 'Dieting', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_trans_kas` int(12) NOT NULL,
  `tipe` enum('Pengeluaran','Pemasukan') DEFAULT NULL,
  `keterangan` text,
  `jumlah` float DEFAULT NULL,
  `id_admin` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tentang_toko`
--

CREATE TABLE `tentang_toko` (
  `id_toko` int(12) NOT NULL,
  `nama_toko` tinytext,
  `alamat` text,
  `logo` varchar(15) DEFAULT NULL,
  `nama_pemilik` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(12) NOT NULL,
  `wkt_transaksi` datetime DEFAULT NULL,
  `id_pelanggan` int(12) DEFAULT NULL,
  `harga_total` float DEFAULT NULL,
  `jum_uang` float DEFAULT NULL,
  `kembalian` float DEFAULT NULL,
  `status` enum('1','0','9') DEFAULT NULL COMMENT '1= Lunas, 0=Belum Lunas, 9=Hapus',
  `id_admin` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail_transaksi` int(12) NOT NULL,
  `id_transaksi` int(12) DEFAULT NULL,
  `id_barang` int(12) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `sub_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `barang_kategori`
--
ALTER TABLE `barang_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_trans_kas`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `tentang_toko`
--
ALTER TABLE `tentang_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `transaksi_detail_ibfk_2` (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang_kategori`
--
ALTER TABLE `barang_kategori`
  MODIFY `id_kategori` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_trans_kas` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tentang_toko`
--
ALTER TABLE `tentang_toko`
  MODIFY `id_toko` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail_transaksi` int(12) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `tentang_toko` (`id_toko`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `barang_kategori` (`id_kategori`);

--
-- Constraints for table `kas`
--
ALTER TABLE `kas`
  ADD CONSTRAINT `kas_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
