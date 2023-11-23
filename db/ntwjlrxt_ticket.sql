-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2023 at 12:33 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntwjlrxt_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agen`
--

CREATE TABLE `tbl_agen` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_agen`
--

INSERT INTO `tbl_agen` (`id`, `nama`, `alamat`, `kota`, `kontak`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(1, 'Ari Putra', 'Mengwi', 'Badung', '23', 'no', 'admin', NULL, '2023-11-15 14:16:25'),
(2, 'William', 'br anyar', 'Tabanan', '087123123123', 'no', 'admin', NULL, NULL),
(3, 'Hanabi', 'Hayam Wuruk', 'Denpasar', '0912123123', 'no', 'admin', NULL, NULL),
(4, 'sadasdccc', 'cscsc', '111', '22', 'yes', 'admin', NULL, NULL),
(6, 'sda', 'asd', 'sad', '22', 'yes', 'admin', '2023-11-15 13:41:21', '2023-11-15 14:19:35'),
(11, 'Ari', 'Mengwi', 'Badung', '12313', 'no', 'admin', '2023-11-15 13:48:44', NULL),
(29, 'Ari Pramana dg', 'Mengwi', 'Badung', '33333', 'no', 'admin', '2023-11-15 14:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agenpaket`
--

CREATE TABLE `tbl_agenpaket` (
  `id` int NOT NULL,
  `id_agen` int NOT NULL,
  `id_paket` int NOT NULL,
  `berlaku` datetime NOT NULL,
  `harga` int NOT NULL,
  `userid` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_agenpaket`
--

INSERT INTO `tbl_agenpaket` (`id`, `id_agen`, `id_paket`, `berlaku`, `harga`, `userid`, `created_at`, `update_at`) VALUES
(3, 2, 8, '2023-11-16 02:00:53', 20000, 'admin', '2023-11-16 02:00:53', '2023-11-16 02:00:53'),
(4, 2, 8, '2023-11-16 03:39:13', 30000, 'admin', '2023-11-16 03:39:13', '2023-11-16 03:39:13'),
(5, 11, 8, '2023-11-16 11:51:02', 20000, 'admin', '2023-11-16 11:51:02', '0000-00-00 00:00:00'),
(6, 11, 8, '2023-11-16 11:51:40', 5000, 'admin', '2023-11-16 11:51:40', '0000-00-00 00:00:00'),
(7, 11, 8, '2023-11-16 12:08:49', 100000, 'admin', '2023-11-16 12:08:49', '0000-00-00 00:00:00'),
(8, 2, 8, '2023-11-16 15:31:36', 99999, 'admin', '2023-11-16 15:31:36', '0000-00-00 00:00:00'),
(9, 2, 8, '2023-11-16 15:37:43', 91234, 'admin', '2023-11-16 15:37:43', '0000-00-00 00:00:00'),
(10, 2, 8, '2023-11-16 20:00:28', 99999999, 'admin', '2023-11-16 20:00:28', '0000-00-00 00:00:00'),
(11, 11, 8, '2023-11-16 20:01:18', 101000, 'admin', '2023-11-16 20:01:18', '0000-00-00 00:00:00'),
(12, 11, 8, '2023-11-21 07:23:08', 15000, 'admin', '2023-11-21 07:23:08', '0000-00-00 00:00:00'),
(13, 2, 8, '2023-11-21 07:23:38', 1500000, 'admin', '2023-11-21 07:23:38', '0000-00-00 00:00:00'),
(14, 11, 8, '2023-11-21 07:23:49', 55000, 'admin', '2023-11-21 07:23:49', '0000-00-00 00:00:00'),
(15, 11, 8, '2023-11-21 07:23:55', 550000, 'admin', '2023-11-21 07:23:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agentiket`
--

CREATE TABLE `tbl_agentiket` (
  `id` int NOT NULL,
  `id_agen` int NOT NULL,
  `id_tiket` int NOT NULL,
  `berlaku` datetime NOT NULL,
  `harga` int NOT NULL,
  `userid` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_agentiket`
--

INSERT INTO `tbl_agentiket` (`id`, `id_agen`, `id_tiket`, `berlaku`, `harga`, `userid`, `created_at`, `update_at`) VALUES
(12, 11, 38, '2023-11-16 11:54:29', 10000, 'admin', '2023-11-16 11:54:29', '0000-00-00 00:00:00'),
(13, 11, 38, '2023-11-16 11:54:46', 15000, 'admin', '2023-11-16 11:54:46', '0000-00-00 00:00:00'),
(14, 3, 38, '2023-11-16 20:00:55', 15000, 'admin', '2023-11-16 20:00:55', '0000-00-00 00:00:00'),
(15, 11, 38, '2023-11-16 20:25:46', 100000, 'admin', '2023-11-16 20:25:46', '0000-00-00 00:00:00'),
(16, 11, 38, '2023-11-16 20:25:59', 99999999, 'admin', '2023-11-16 20:25:59', '0000-00-00 00:00:00'),
(17, 11, 38, '2023-11-16 20:26:14', 12000, 'admin', '2023-11-16 20:26:14', '0000-00-00 00:00:00'),
(18, 3, 14, '2023-11-18 09:23:53', 30000, 'admin', '2023-11-18 09:23:53', '0000-00-00 00:00:00'),
(19, 11, 38, '2023-11-21 07:24:45', 50000, 'admin', '2023-11-21 07:24:45', '0000-00-00 00:00:00'),
(20, 3, 38, '2023-11-21 07:24:57', 100000, 'admin', '2023-11-21 07:24:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int NOT NULL,
  `kode_tiket` varchar(10) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `berangkat` date NOT NULL,
  `kembali` date NOT NULL,
  `pickup` varchar(100) NOT NULL,
  `dropoff` varchar(100) NOT NULL,
  `depart` int NOT NULL,
  `return_from` int DEFAULT NULL,
  `agentid` int NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `kode_tiket`, `tgl_pesan`, `berangkat`, `kembali`, `pickup`, `dropoff`, `depart`, `return_from`, `agentid`, `remarks`, `userid`, `is_deleted`, `created_at`, `update_at`) VALUES
(50, 'TIX899861', '2023-11-18 07:57:22', '2023-11-20', '2023-11-21', 'Pickup pada lembongan', 'Drop off Bali dulu', 14, 14, 1, 'catatan kecil', 'admin', 'no', '2023-11-18 07:57:22', '2023-11-18 07:57:22'),
(51, 'TIX246144', '2023-11-18 08:13:04', '2023-11-18', '2023-11-19', 'Pickup pada lembongan', 'Drop off Bali dulu', 14, 14, 1, 'catatan untuk starla', 'admin', 'no', '2023-11-18 08:13:04', '2023-11-18 08:13:04'),
(52, 'TIX889570', '2023-11-20 08:14:23', '2023-11-20', '2023-11-21', 'Pickup pada lembongan', 'Drop off Bali dulu', 38, NULL, 3, 'catatan untuk starla', 'admin', 'no', '2023-11-20 08:14:23', '2023-11-20 08:14:23'),
(53, 'TIX983921', '2023-11-20 23:08:41', '1970-01-01', '1970-01-01', '', '', 38, NULL, 3, '', 'admin', 'no', '2023-11-20 23:08:41', '2023-11-20 23:08:41'),
(54, 'TIX483072', '2023-11-21 06:09:12', '2023-11-21', '2023-11-21', 'Saya mau di pickup oleh grab', 'Di Bandara', 38, 38, 3, 'jangan ngebut-ngebut', 'admin', 'no', '2023-11-21 06:09:12', '2023-11-21 06:09:12'),
(55, 'TIX630084', '2023-11-21 06:11:11', '2023-11-22', '2023-11-30', 'Pickup pada lembongan', 'drop off', 14, NULL, 3, 'catatan kecil', 'admin', 'no', '2023-11-21 06:11:11', '2023-11-21 06:11:11'),
(56, 'TIX546028', '2023-11-21 06:12:40', '2023-11-21', '2023-11-30', '', '', 14, NULL, 3, '', 'admin', 'no', '2023-11-21 06:12:40', '2023-11-21 06:12:40'),
(57, 'TIX929757', '2023-11-21 06:15:06', '2023-11-21', '2023-11-29', 'sdad', 'asdsd', 38, 38, 11, 'asdsd', 'admin', 'no', '2023-11-21 06:15:06', '2023-11-21 06:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_detail`
--

CREATE TABLE `tbl_booking_detail` (
  `id` int NOT NULL,
  `namatamu` varchar(100) NOT NULL,
  `nasionality` varchar(100) NOT NULL,
  `jenis` enum('dewasa','anak','foc') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_booking_detail`
--

INSERT INTO `tbl_booking_detail` (`id`, `namatamu`, `nasionality`, `jenis`) VALUES
(49, 'satu dewasa', 'Afghanistan', 'dewasa'),
(49, 'satu anak', 'Andorra', 'anak'),
(49, 'satu foc', 'Australia', 'foc'),
(50, 'dewasa satu', 'Indonesia', 'dewasa'),
(50, 'anak anak dua', 'Indonesia', 'anak'),
(50, 'anak anak satu', 'Indonesia', 'anak'),
(50, 'artis satu', 'Indonesia', 'foc'),
(50, 'pejabat satu', 'Indonesia', 'foc'),
(51, 'wayan', 'Indonesia', 'dewasa'),
(51, 'wayan kecil', 'Indonesia', 'anak'),
(51, 'wayan foc', 'Indonesia', 'foc'),
(52, 'ari', 'Aland Islands', 'dewasa'),
(52, 'anak tamu 1', 'Indonesia', 'anak'),
(53, 'sadsad', 'Aland Islands', 'dewasa'),
(54, 'Yudik', 'Indonesia', 'dewasa'),
(54, 'Putri', 'Indonesia', 'dewasa'),
(54, 'dermawa', 'Indonesia', 'anak'),
(54, 'sadil', 'Indonesia', 'anak'),
(54, 'Rich Brian', 'Indonesia', 'foc'),
(55, 'Farhan', 'Indonesia', 'dewasa'),
(56, 'Raffi Ahmad', 'Indonesia', 'foc'),
(57, 'sdad', 'Aland Islands', 'dewasa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_paket`
--

CREATE TABLE `tbl_booking_paket` (
  `id` int NOT NULL,
  `kode_tiket` varchar(10) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `berangkat` date NOT NULL,
  `kembali` date NOT NULL,
  `pickup` varchar(100) NOT NULL,
  `dropoff` varchar(100) NOT NULL,
  `id_paket` int NOT NULL,
  `agentid` int DEFAULT NULL,
  `remarks` int NOT NULL,
  `userid` varchar(10) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_paket_detail`
--

CREATE TABLE `tbl_booking_paket_detail` (
  `id` int NOT NULL,
  `namatamu` varchar(100) NOT NULL,
  `nasionality` varchar(100) NOT NULL,
  `jenis` enum('dewasa','anak','foc') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id` int NOT NULL,
  `namapaket` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `keterangan` tinytext NOT NULL,
  `userid` varchar(10) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id`, `namapaket`, `keterangan`, `userid`, `is_deleted`, `created_at`, `update_at`) VALUES
(8, 'Super Cepat', 'paket super cepattt', 'admin', 'no', '2023-11-15 13:23:24', '0000-00-00 00:00:00'),
(9, 'lorem paket', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'admin', 'no', '2023-11-15 13:23:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket`
--

CREATE TABLE `tbl_tiket` (
  `id` int NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `berangkat` time NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_tiket`
--

INSERT INTO `tbl_tiket` (`id`, `tujuan`, `berangkat`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(13, 'Sanur-Lembongan', '06:30:00', 'no', 'admin', '2023-11-15 08:09:37', '2023-11-15 15:01:56'),
(14, 'Lembongan-Sanur', '08:00:00', 'no', 'admin', '2023-11-15 08:09:53', '2023-11-15 08:09:53'),
(17, 'Sanur-Lembongan', '07:00:00', 'no', 'admin', '2023-11-15 09:31:43', '2023-11-15 09:31:43'),
(22, 'Sanur-Lembongan', '12:30:00', 'yes', 'admin', '2023-11-15 14:21:56', '2023-11-15 14:21:58'),
(38, 'Sanur-Lembongan', '06:00:00', 'no', 'admin', '2023-11-15 14:50:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(10) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `role` enum('admin','kasir','marketing') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `passwd`, `role`, `is_deleted`, `created_at`, `update_at`) VALUES
('admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin', 'no', NULL, NULL),
('budiman', '72527187509a27cae95b0c1003e9fcedc383b8ca', 'marketing', 'yes', NULL, '2023-11-14 15:46:49'),
('kasir', '8cfab3d2724448440ea03b9cfa0194cb962a7723', 'kasir', 'no', '2023-11-15 05:44:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agen`
--
ALTER TABLE `tbl_agen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_agenpaket`
--
ALTER TABLE `tbl_agenpaket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_agen` (`id_agen`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `tbl_agentiket`
--
ALTER TABLE `tbl_agentiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `tbl_agentiket_ibfk_1` (`id_agen`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depart` (`depart`),
  ADD KEY `return_from` (`return_from`),
  ADD KEY `agentid` (`agentid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agentid` (`agentid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `tbl_booking_paket_detail`
--
ALTER TABLE `tbl_booking_paket_detail`
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tujuan_berangkat` (`tujuan`,`berangkat`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_agen`
--
ALTER TABLE `tbl_agen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_agenpaket`
--
ALTER TABLE `tbl_agenpaket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_agentiket`
--
ALTER TABLE `tbl_agentiket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_agen`
--
ALTER TABLE `tbl_agen`
  ADD CONSTRAINT `tbl_agen_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_agenpaket`
--
ALTER TABLE `tbl_agenpaket`
  ADD CONSTRAINT `tbl_agenpaket_ibfk_1` FOREIGN KEY (`id_agen`) REFERENCES `tbl_agen` (`id`),
  ADD CONSTRAINT `tbl_agenpaket_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id`);

--
-- Constraints for table `tbl_agentiket`
--
ALTER TABLE `tbl_agentiket`
  ADD CONSTRAINT `tbl_agentiket_ibfk_1` FOREIGN KEY (`id_agen`) REFERENCES `tbl_agen` (`id`),
  ADD CONSTRAINT `tbl_agentiket_ibfk_2` FOREIGN KEY (`id_tiket`) REFERENCES `tbl_tiket` (`id`),
  ADD CONSTRAINT `tbl_agentiket_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD CONSTRAINT `tbl_booking_ibfk_1` FOREIGN KEY (`depart`) REFERENCES `tbl_tiket` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_2` FOREIGN KEY (`return_from`) REFERENCES `tbl_tiket` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_3` FOREIGN KEY (`agentid`) REFERENCES `tbl_agen` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  ADD CONSTRAINT `tbl_booking_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_booking` (`id`);

--
-- Constraints for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  ADD CONSTRAINT `tbl_booking_paket_ibfk_1` FOREIGN KEY (`agentid`) REFERENCES `tbl_agen` (`id`),
  ADD CONSTRAINT `tbl_booking_paket_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`),
  ADD CONSTRAINT `tbl_booking_paket_ibfk_3` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_booking_paket_detail`
--
ALTER TABLE `tbl_booking_paket_detail`
  ADD CONSTRAINT `tbl_booking_paket_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_booking_paket` (`id`);

--
-- Constraints for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD CONSTRAINT `tbl_paket_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD CONSTRAINT `tbl_tiket_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
