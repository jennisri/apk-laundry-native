-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 02:16 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `alamat_karyawan` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `username`, `password`, `alamat_karyawan`, `nohp`, `gender`, `role`) VALUES
(3, 'M. Ridho Saputra', 'ridhoganteng', '$2y$10$zwm6D57bOmPQjSPMUkZE0.qLdAGu8YNhGq5PvnKX0585woWKEsl7K', 'Sukarami', '0836254366', 'Laki-Laki', '2'),
(6, 'Tiya Maharani', 'tiyamaharani', '$2y$10$GQCD/sihGXC.3ZNomlbei.5GbrPC13weB9orGto2mE69ehE4.StQy', 'jdsgfjhds', '23784238', 'Perempuan', '1'),
(9, 'Tiya Maharani', 'srijenniecantik', '$2y$10$vtUWG132jMkL5i2FmuULduKaIyTzmIsCeLiw6K2K8yeqqvuRd9Wbe', 'kasmaran', '088675', 'Perempuan', '2');

-- --------------------------------------------------------

--
-- Table structure for table `paket_laundry`
--

CREATE TABLE `paket_laundry` (
  `id_paket` int(11) NOT NULL,
  `jenis_paket` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_laundry`
--

INSERT INTO `paket_laundry` (`id_paket`, `jenis_paket`, `harga`) VALUES
(2, 'Bed Cover', '30000'),
(3, 'Jeans', '20000'),
(4, 'Random', '7000'),
(5, 'Baju Tidur', '12000'),
(6, 'Sprei', '5000'),
(7, 'Tikar', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telepon`, `jenis_kelamin`) VALUES
(1, 'Leo Candra', 'Plakat Tinggi', '085380452063', 'Laki-Laki'),
(2, 'Sri Jenni Murniati', 'Kasmaran', '0374987348', 'Perempuan'),
(4, 'Nidia Natalia', 'Palembang', '0832565323', 'Perempuan'),
(5, 'Frengky', 'Rantau Panjang', '08457625362', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pembayaran`
--

CREATE TABLE `tipe_pembayaran` (
  `id_tipe` int(11) NOT NULL,
  `nama_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_pembayaran`
--

INSERT INTO `tipe_pembayaran` (`id_tipe`, `nama_pembayaran`) VALUES
(1, 'DANA'),
(2, 'Bank Mandiri'),
(4, 'Bank BRI'),
(5, 'ShopeePay'),
(6, 'BSI 123');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `berat` varchar(100) NOT NULL,
  `tgl_ambil` datetime NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sts_pembayaran` varchar(1) NOT NULL,
  `sts_order` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_order`, `id_pelanggan`, `id_paket`, `id_tipe`, `berat`, `tgl_ambil`, `tgl_transaksi`, `sts_pembayaran`, `sts_order`) VALUES
(1, 'BRG000', 1, 2, 1, '1', '2022-08-21 00:00:00', '2022-08-19 23:26:54', '2', '1'),
(2, 'BRG001', 1, 2, 2, '67', '2022-08-25 00:00:00', '2022-08-19 23:32:02', '2', '2'),
(3, 'BRG001', 1, 2, 4, '12', '2022-08-24 00:00:00', '2022-08-19 23:36:16', '1', '2'),
(4, 'BRG001', 1, 2, 2, '12', '2022-08-29 00:00:00', '2022-08-19 23:40:10', '1', '2'),
(5, 'ORD-001', 1, 2, 4, '1', '2022-08-29 00:00:00', '2022-08-19 23:50:00', '1', '1'),
(6, '1', 1, 2, 4, '1', '2022-08-16 00:00:00', '2022-08-20 00:27:07', '2', '1'),
(7, '1', 1, 2, 2, '2', '2022-08-30 00:00:00', '2022-08-20 01:03:29', '1', '1'),
(8, 'ORD-003', 2, 3, 2, '2', '2022-08-21 00:00:00', '2022-08-20 09:07:16', '2', '2'),
(9, 'ORD-004', 3, 4, 5, '3', '2022-08-23 00:00:00', '2022-08-20 11:01:28', '1', '1'),
(10, 'ORD-002', 0, 0, 0, '', '0000-00-00 00:00:00', '2022-08-20 20:39:24', '', ''),
(11, 'ORD-005', 4, 5, 2, '2', '2022-09-21 00:00:00', '2022-09-19 09:49:34', '1', '1'),
(12, 'ORD-006', 5, 3, 4, '12', '2022-09-24 00:00:00', '2022-09-22 22:45:03', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `paket_laundry`
--
ALTER TABLE `paket_laundry`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tipe_pembayaran`
--
ALTER TABLE `tipe_pembayaran`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paket_laundry`
--
ALTER TABLE `paket_laundry`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipe_pembayaran`
--
ALTER TABLE `tipe_pembayaran`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
