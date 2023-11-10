-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2023 at 06:37 PM
-- Server version: 10.3.39-MariaDB-cll-lve
-- PHP Version: 8.2.11

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
-- Table structure for table `tbl_agent`
--

CREATE TABLE `tbl_agent` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int(11) NOT NULL,
  `kode_tiket` varchar(10) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `berangkat` date NOT NULL,
  `kembali` date NOT NULL,
  `pickup` varchar(100) NOT NULL,
  `dropoff` varchar(100) NOT NULL,
  `paket` varchar(100) DEFAULT NULL,
  `hargapaket` int(11) DEFAULT NULL,
  `depart` int(11) NOT NULL,
  `return_from` int(11) DEFAULT NULL,
  `agentid` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_detail`
--

CREATE TABLE `tbl_booking_detail` (
  `id` int(11) NOT NULL,
  `namatamu` varchar(100) NOT NULL,
  `jenis` enum('dewasa','anak','foc') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket`
--

CREATE TABLE `tbl_tiket` (
  `id` int(11) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `berangkat` time NOT NULL,
  `harga` int(11) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(10) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `role` enum('admin','sales','akunting') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD PRIMARY KEY (`id`),
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
-- Indexes for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD CONSTRAINT `tbl_agent_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD CONSTRAINT `tbl_booking_ibfk_1` FOREIGN KEY (`depart`) REFERENCES `tbl_tiket` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_2` FOREIGN KEY (`return_from`) REFERENCES `tbl_tiket` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_3` FOREIGN KEY (`agentid`) REFERENCES `tbl_agent` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  ADD CONSTRAINT `tbl_booking_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_booking` (`id`);

--
-- Constraints for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD CONSTRAINT `tbl_tiket_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
