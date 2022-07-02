-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 11:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'oli mesin'),
(2, 'suku cadang ban');

-- --------------------------------------------------------

--
-- Table structure for table `pembukuan`
--

CREATE TABLE `pembukuan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `invoice` varchar(200) NOT NULL,
  `kostumer` varchar(200) NOT NULL,
  `motor` varchar(200) NOT NULL,
  `no_plat` varchar(200) NOT NULL,
  `mekanik` varchar(200) DEFAULT NULL,
  `harga_servis` int(11) DEFAULT NULL,
  `nama_sparepart` varchar(200) DEFAULT NULL,
  `qty_sparepart` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `harga_jual_sparepart` int(11) DEFAULT NULL,
  `harga_beli_sparepart` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `invoice` varchar(200) NOT NULL,
  `kostumer` varchar(200) NOT NULL,
  `motor` varchar(200) NOT NULL,
  `no_plat` varchar(200) NOT NULL,
  `mekanik` varchar(200) DEFAULT NULL,
  `harga_servis` int(11) DEFAULT NULL,
  `nama_sparepart` varchar(200) DEFAULT NULL,
  `qty_sparepart` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `harga_jual_sparepart` int(11) DEFAULT NULL,
  `harga_beli_sparepart` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'owner'),
(3, 'kasir'),
(4, 'mekanik');

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `tanggal_masuk` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_keluar` datetime DEFAULT NULL,
  `kostumer` varchar(200) NOT NULL,
  `motor` varchar(200) NOT NULL,
  `no_plat` varchar(200) NOT NULL,
  `keterangan` int(1) NOT NULL,
  `harga_servis` int(11) NOT NULL,
  `mekanik` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `servis_selesai`
--

CREATE TABLE `servis_selesai` (
  `id` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `kostumer` varchar(200) NOT NULL,
  `motor` varchar(200) NOT NULL,
  `no_plat` varchar(200) NOT NULL,
  `harga_servis` int(11) NOT NULL,
  `mekanik` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servis_selesai`
--

INSERT INTO `servis_selesai` (`id`, `invoice`, `tanggal_masuk`, `tanggal_keluar`, `kostumer`, `motor`, `no_plat`, `harga_servis`, `mekanik`) VALUES
(5, 'BK2202270001', '2022-02-27 16:21:29', '2022-02-27 04:02:07', 'mbambing', 'mio', 'b1256kf', 50000, 'mekanik'),
(6, 'BK2202270002', '2022-02-27 17:20:05', '2022-02-27 05:02:16', 'zaki', 'CBR', 'AA3223FG', 80000, 'mekanik'),
(13, 'BK2202280001', '2022-02-28 10:57:08', '2022-02-28 11:06:38', 'test', 'mio', 'b1256kf', 50000, 'mekanik'),
(14, 'BK2202280002', '2022-02-28 10:58:21', '2022-02-28 11:06:38', 'test123', 'mio', 'f123hk', 50000, 'mekanik');

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`id`, `nama`, `harga_jual`, `harga_beli`, `stok`, `id_kategori`) VALUES
(1, 'Castrol Active Matic', 50000, 45000, 98, 1),
(2, 'Shell Advance AX7 Matic', 55000, 50000, 93, 1),
(3, 'Suzuki Genuine Oil SGO', 45000, 40000, 97, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `kostumer` varchar(200) NOT NULL,
  `motor` varchar(200) NOT NULL,
  `no_plat` varchar(200) NOT NULL,
  `mekanik` varchar(200) NOT NULL,
  `harga_servis` int(11) NOT NULL,
  `nama_sparepart` varchar(200) NOT NULL,
  `qty_sparepart` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `harga_jual_sparepart` int(11) NOT NULL,
  `harga_beli_sparepart` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `invoice`, `kostumer`, `motor`, `no_plat`, `mekanik`, `harga_servis`, `nama_sparepart`, `qty_sparepart`, `sub_total`, `pembayaran`, `kembalian`, `harga_jual_sparepart`, `harga_beli_sparepart`, `total`) VALUES
(13, '2022-02-27', 'BK2202270001', 'mbambing', 'mio', 'b1256kf', 'mekanik', 50000, 'Castrol Active Matic', 2, 100000, 200000, 50000, 50000, 45000, 150000),
(15, '2022-02-27', 'BK2202270002', 'zaki', 'CBR', 'AA3223FG', 'mekanik', 80000, 'Shell Advance AX7 Matic', 1, 55000, 250000, 25000, 55000, 50000, 225000),
(16, '2022-02-27', 'BK2202270002', 'zaki', 'CBR', 'AA3223FG', 'mekanik', 80000, 'Suzuki Genuine Oil SGO', 2, 90000, 250000, 25000, 45000, 40000, 225000),
(17, '2022-02-28', 'BK2202280001', 'test', 'mio', 'b1256kf', 'mekanik', 50000, 'Shell Advance AX7 Matic', 3, 165000, 220000, 5000, 55000, 50000, 215000),
(18, '2022-02-28', 'BK2202280002', 'test123', 'mio', 'f123hk', 'mekanik', 50000, 'Suzuki Genuine Oil SGO', 1, 45000, 100000, 5000, 45000, 40000, 95000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `telepon` int(15) NOT NULL,
  `id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `gambar`, `telepon`, `id_role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'borobudur', 'default.png', 123456789, 1),
(5, 'owner', '72122ce96bfec66e2396d2e25225d70a', 'owner', 'magelang', 'default.png', 9870789, 2),
(6, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'mungkid', 'default.png', 3321233, 3),
(7, 'mekanik', 'ea7cd15c9b11cb84e14b3a6b7520c400', 'mekanik', 'mertoyudan', 'default.png', 123, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembukuan`
--
ALTER TABLE `pembukuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servis_selesai`
--
ALTER TABLE `servis_selesai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembukuan`
--
ALTER TABLE `pembukuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `servis`
--
ALTER TABLE `servis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `servis_selesai`
--
ALTER TABLE `servis_selesai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sparepart`
--
ALTER TABLE `sparepart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
