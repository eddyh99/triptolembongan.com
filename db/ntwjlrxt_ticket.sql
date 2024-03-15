-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2024 at 08:17 AM
-- Server version: 10.3.39-MariaDB-cll-lve
-- PHP Version: 8.2.14

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
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `tipe` enum('company','general') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_agen`
--

INSERT INTO `tbl_agen` (`id`, `nama`, `alamat`, `kota`, `kontak`, `tipe`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(1, '12GO ASIA', 'Singapore', 'Singapore', '6289531578466', 'company', 'no', 'admin', '2024-01-09 11:46:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agenpaket`
--

CREATE TABLE `tbl_agenpaket` (
  `id` int(11) NOT NULL,
  `id_agen` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `berlaku` datetime DEFAULT NULL,
  `berakhir` date DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agentiket`
--

CREATE TABLE `tbl_agentiket` (
  `id` int(11) NOT NULL,
  `id_agen` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `berlaku` datetime DEFAULT NULL,
  `berakhir` date DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_agentiket`
--

INSERT INTO `tbl_agentiket` (`id`, `id_agen`, `id_tiket`, `berlaku`, `berakhir`, `harga`, `userid`, `created_at`, `update_at`) VALUES
(1, 1, 1, '2024-01-09 11:51:08', NULL, 100000, 'admin', '2024-01-09 11:51:08', '0000-00-00 00:00:00'),
(2, 1, 2, '2024-01-09 11:51:38', NULL, 100000, 'admin', '2024-01-09 11:51:38', '0000-00-00 00:00:00'),
(3, 1, 3, '2024-01-09 11:52:00', NULL, 100000, 'admin', '2024-01-09 11:52:00', '0000-00-00 00:00:00'),
(4, 1, 4, '2024-01-09 11:52:15', NULL, 100000, 'admin', '2024-01-09 11:52:15', '0000-00-00 00:00:00'),
(5, 1, 5, '2024-01-09 11:52:30', NULL, 100000, 'admin', '2024-01-09 11:52:30', '0000-00-00 00:00:00'),
(6, 1, 6, '2024-01-09 11:52:39', NULL, 100000, 'admin', '2024-01-09 11:52:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int(11) NOT NULL,
  `kode_tiket` varchar(10) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `berangkat` date DEFAULT NULL,
  `kembali` date DEFAULT NULL,
  `pickup` varchar(100) NOT NULL,
  `r_pickup` varchar(100) DEFAULT NULL,
  `r_dropoff` varchar(100) DEFAULT NULL,
  `dropoff` varchar(100) NOT NULL,
  `depart` int(11) NOT NULL,
  `is_open` enum('yes','no') NOT NULL DEFAULT 'no',
  `return_from` int(11) DEFAULT NULL,
  `agentid` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `payment` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `komisi` int(11) NOT NULL DEFAULT 0,
  `userid` varchar(10) NOT NULL,
  `checkin_by` varchar(10) DEFAULT NULL,
  `checkin_return` varchar(10) DEFAULT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `kode_tiket`, `tgl_pesan`, `berangkat`, `kembali`, `pickup`, `r_pickup`, `r_dropoff`, `dropoff`, `depart`, `is_open`, `return_from`, `agentid`, `remarks`, `payment`, `charge`, `komisi`, `userid`, `checkin_by`, `checkin_return`, `is_deleted`, `created_at`, `update_at`) VALUES
(1, 'DRC882439', '2024-01-09 12:58:34', '2024-01-10', NULL, 'OT', NULL, NULL, 'OT', 1, 'no', NULL, 1, '', 1, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-09 12:58:34', '2024-01-09 12:58:34'),
(2, 'DRC893117', '2024-01-09 14:37:06', '2024-01-09', '2024-01-11', 'ot', 'ot', 'ot', 'ot', 2, 'no', 5, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-09 14:37:06', '2024-01-09 14:37:06'),
(3, 'DRC976361', '2024-01-09 14:38:14', '2024-01-09', '2024-01-10', 'ot', 'ot', 'ot', 'ot', 3, 'no', 5, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-09 14:38:14', '2024-01-09 14:38:14'),
(5, 'DRC421409', '2024-01-11 10:34:34', '2024-01-15', NULL, 'ot', NULL, NULL, 'ot', 3, 'no', NULL, 1, '', 1, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-11 10:34:34', '2024-01-11 10:34:34'),
(6, 'DRC579794', '2024-01-11 10:36:11', '2024-01-11', '2024-01-13', 'ot', 'ot', 'ot', 'ot', 1, 'no', 6, 1, 'check in 3.30', 4, 0, 0, 'admin', 'admin', NULL, 'no', '2024-01-11 10:36:11', '2024-01-11 10:51:37'),
(7, 'DRC166213', '2024-01-11 10:37:53', '2024-01-18', '2024-01-20', 'Sanur  Guest House', 'Indiana Kenanga', 'Hardrock kuta', 'Lembongan Guest House', 3, 'no', 5, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-11 10:37:53', '2024-01-11 10:37:53'),
(10, 'DRC738997', '2024-01-11 10:43:26', '2024-01-13', NULL, 'Legian beach hotel', NULL, NULL, 'ddive concept', 2, 'no', NULL, 1, '', 1, 650000, 0, 'admin', NULL, NULL, 'no', '2024-01-11 10:43:26', '2024-01-11 10:43:26'),
(12, 'DRC970123', '2024-01-11 10:46:02', '2024-01-19', NULL, 'OT', NULL, NULL, 'OT', 4, 'no', NULL, 1, '', 1, 75000, 0, 'admin', NULL, NULL, 'no', '2024-01-11 10:46:02', '2024-01-11 10:46:02'),
(13, 'DRC414558', '2024-01-11 10:46:39', '2024-01-19', NULL, 'ot', NULL, NULL, 'ot', 2, 'no', NULL, 1, '', 1, 75000, 0, 'admin', NULL, NULL, 'no', '2024-01-11 10:46:39', '2024-01-11 10:46:39'),
(14, 'DRC155938', '2024-01-11 11:17:50', '2024-01-11', '2024-01-20', 'hardrock kuta', 'bali belva', 'potato seminyak', 'bali belva', 2, 'no', 4, 1, 'include pick up time 07.00-07.15', 1, 2000000, 0, 'admin', 'admin', NULL, 'no', '2024-01-11 11:17:50', '2024-01-11 11:18:19'),
(15, 'DRC731588', '2024-01-11 11:35:12', '2024-01-15', '2024-01-17', 'OT', 'OT', 'OT', 'OT', 6, 'no', 1, 1, '', 1, 250000, 0, 'admin', NULL, NULL, 'no', '2024-01-11 11:35:12', '2024-01-11 11:35:12'),
(16, 'DRC103212', '2024-01-11 14:35:32', '2024-01-11', '2024-01-13', 'ot', 'ot', 'ot', 'ot', 3, 'no', 4, 1, '', 4, 0, 0, 'admin', 'admin', NULL, 'no', '2024-01-11 14:35:32', '2024-01-11 14:35:44'),
(17, 'DRC259936', '2024-01-11 15:46:18', '2024-01-13', '2024-01-14', 'OT', NULL, NULL, 'OT', 2, 'no', 4, 1, '', 1, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-11 15:46:18', '2024-01-11 15:46:18'),
(18, 'DRC448140', '2024-01-13 10:05:07', '2024-01-13', '2024-01-23', 'ot', 'ot', 'ot', 'ot', 2, 'no', 5, 1, 'ot check in 12.30', 1, 300000, 0, 'admin', NULL, NULL, 'no', '2024-01-13 10:05:07', '2024-01-13 10:05:07'),
(19, 'DRC139870', '2024-01-13 10:06:51', '2024-01-13', '2024-02-01', 'ot', 'ot', 'ot', 'ot', 1, 'no', 6, 1, 'ot check in 3.30', 1, 300000, 0, 'admin', 'admin', NULL, 'no', '2024-01-13 10:06:51', '2024-01-13 10:10:03'),
(20, 'DRC494884', '2024-01-13 10:13:22', '2024-01-13', NULL, 'ot', NULL, NULL, 'ot', 6, 'no', NULL, 1, 'ot', 1, 100000, 0, 'admin', NULL, NULL, 'no', '2024-01-13 10:13:22', '2024-01-13 10:13:22'),
(21, 'DRC724606', '2024-01-13 10:18:18', '2024-01-27', '2024-02-02', 'ot', 'ot', 'ot', 'ot', 1, 'no', 5, 1, 'ot check in 12.30', 1, 300000, 0, 'admin', NULL, NULL, 'no', '2024-01-13 10:18:18', '2024-01-13 10:18:18'),
(22, 'DRC319553', '2024-01-24 07:54:33', '2024-01-24', '2024-01-30', 'Sini', NULL, NULL, 'Sana', 6, 'no', NULL, 1, 'Ga tau', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2024-01-24 07:54:33', '2024-01-24 07:55:36'),
(23, 'DRC335844', '2024-01-29 13:34:13', '2024-01-30', NULL, 'OT', NULL, NULL, 'OT', 1, 'no', NULL, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-01-29 13:34:13', '2024-01-29 13:34:13'),
(24, 'DRC613530', '2024-01-29 13:49:15', '2024-01-30', '2024-01-31', 'AIRPORT', 'INDIANA KENANGA', 'GRAND INNA KUTA', 'LEMBONGAN BEACH CLUB', 2, 'no', 4, 1, '', 1, 1300000, 0, 'admin', NULL, NULL, 'no', '2024-01-29 13:49:15', '2024-01-29 13:49:15'),
(25, 'DRC695500', '2024-01-29 15:23:27', '2024-01-29', NULL, 'ot', NULL, NULL, 'ot', 3, 'no', NULL, 1, '', 1, 150000, 0, 'admin', 'admin', NULL, 'no', '2024-01-29 15:23:27', '2024-01-29 15:25:11'),
(26, 'DRC110930', '2024-01-29 15:45:13', '2024-01-30', '2024-02-14', 'ot', 'ot', 'ot', 'ot', 1, 'no', 5, 1, 'ot check in 12.00', 1, 600000, 0, 'admin', NULL, NULL, 'no', '2024-01-29 15:45:13', '2024-01-29 15:45:13'),
(27, 'DRC106618', '2024-01-30 12:16:52', '2024-01-30', NULL, 'ot', NULL, NULL, 'batu karang', 3, 'yes', NULL, 1, '', 1, 250000, 0, 'admin', NULL, NULL, 'no', '2024-01-30 12:16:52', '2024-01-30 12:16:52'),
(28, 'DRC311488', '2024-02-01 17:49:47', '2024-02-08', '2024-02-09', 'mercure', 'lembongan hostel', 'maya sanur', 'lemnbongan hostel', 1, 'no', 6, 1, '', 1, 500000, 0, 'admin', 'admin', NULL, 'no', '2024-02-01 17:49:47', '2024-02-08 11:04:27'),
(29, 'DRC348889', '2024-02-09 14:21:00', '2024-02-10', NULL, 'ot', NULL, NULL, 'ot', 1, 'no', NULL, 1, '', 1, 150000, 0, 'admin', 'admin', NULL, 'no', '2024-02-09 14:21:00', '2024-02-10 09:51:37'),
(30, 'DRC857579', '2024-02-09 14:22:36', '2024-02-10', '2024-02-10', 'harmoni', 'mahagiri', 'hyatt', 'lbc', 1, 'no', 6, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-02-09 14:22:36', '2024-02-09 14:22:36'),
(31, 'DRC272821', '2024-02-10 12:43:15', '2024-02-13', NULL, 'mercure', NULL, NULL, 'mahagiri', 1, 'no', NULL, 1, 'extra  pu 500.000', 1, 650000, 0, 'admin', NULL, NULL, 'no', '2024-02-10 12:43:15', '2024-02-10 12:43:15'),
(32, 'DRC746928', '2024-02-10 12:49:52', '2024-02-12', '2024-02-13', 'hyatt', 'LBC', 'GRAND INNA', 'LBC', 1, 'no', 4, 1, '', 1, 200000, 0, 'admin', NULL, NULL, 'no', '2024-02-10 12:49:52', '2024-02-10 12:49:52'),
(33, 'DRC669669', '2024-02-10 13:45:04', '2024-02-12', NULL, 'OHANA', NULL, NULL, 'GRIYA SANTRIAN', 5, 'no', NULL, 1, '', 1, 400000, 0, 'admin', NULL, NULL, 'no', '2024-02-10 13:45:04', '2024-02-10 13:45:04'),
(34, 'DRC706495', '2024-02-17 12:21:41', '2024-02-18', NULL, 'OT', NULL, NULL, 'OT', 1, 'no', NULL, 1, 'SUKA BOONG', 1, 100000, 0, 'admin', NULL, NULL, 'no', '2024-02-17 12:21:41', '2024-02-17 12:21:41'),
(35, 'DRC279982', '2024-02-17 12:22:35', '2024-02-18', NULL, 'OT', NULL, NULL, 'OT', 1, 'no', NULL, 1, '', 1, 75000, 0, 'admin', NULL, NULL, 'no', '2024-02-17 12:22:35', '2024-02-17 12:22:35'),
(36, 'DRC983938', '2024-02-17 12:25:36', '2024-02-18', '2024-02-20', 'OT', 'OT', 'OT', 'OT', 1, 'no', 6, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-02-17 12:25:36', '2024-02-17 12:25:36'),
(37, 'DRC151458', '2024-02-17 12:27:32', '2024-02-18', '2024-02-21', 'OT', 'OT', 'OT', 'OT', 2, 'no', 6, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-02-17 12:27:32', '2024-02-17 12:27:32'),
(38, 'DRC290155', '2024-02-17 12:29:30', '2024-02-19', '2024-02-22', 'MERCURE SANUR', 'MAHAGIRI', 'GRAND HYATT', 'BATUKARANG', 3, 'no', 4, 1, '', 1, 650000, 0, 'admin', NULL, NULL, 'no', '2024-02-17 12:29:30', '2024-02-17 12:29:30'),
(39, 'DRC325832', '2024-02-20 12:55:54', '2024-02-22', NULL, 'ot', NULL, NULL, 'ot', 1, 'no', NULL, 1, '', 1, 100000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 12:55:54', '2024-02-20 12:55:54'),
(40, 'DRC221413', '2024-02-20 12:56:48', '2024-02-22', NULL, 'ot', NULL, NULL, 'ot', 1, 'no', NULL, 1, '', 1, 100000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 12:56:48', '2024-02-20 12:56:48'),
(41, 'DRC462314', '2024-02-20 12:58:27', '2024-02-22', NULL, 'mercure', NULL, NULL, 'lbc', 1, 'no', NULL, 1, 'collect extra pu 500.000', 1, 1000000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 12:58:27', '2024-02-20 12:58:27'),
(42, 'DRC314053', '2024-02-20 12:59:47', '2024-02-22', NULL, 'uluwatu', NULL, NULL, 'mahagiri', 2, 'no', NULL, 1, 'collect extra PU 250.000', 1, 1500000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 12:59:47', '2024-02-20 12:59:47'),
(43, 'DRC725009', '2024-02-20 13:01:58', '2024-02-22', '2024-02-22', 'LEGIAN BEACH HOTEL', 'OT', 'HYATT SANUR', 'OT', 1, 'no', 6, 1, '', 1, 2500000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 13:01:58', '2024-02-20 13:01:58'),
(44, 'DRC245155', '2024-02-20 13:02:54', '2024-02-22', NULL, 'OT', NULL, NULL, 'OT', 1, 'yes', NULL, 1, '', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 13:02:54', '2024-02-20 13:02:54'),
(45, 'DRC206871', '2024-02-20 13:04:08', '2024-02-21', '2024-02-23', 'PULL MAN', 'BOBO', 'GRAND INNA', 'MAHAGIRI', 1, 'no', 4, 1, '', 1, 1350000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 13:04:08', '2024-02-20 13:04:08'),
(46, 'DRC981231', '2024-02-20 13:37:23', '2024-02-21', '2024-02-23', 'KFC', 'AQUA NUSA', 'MOVENPICK', 'OHANA', 1, 'no', 4, 1, '', 4, 0, 0, 'admin', NULL, NULL, 'no', '2024-02-20 13:37:23', '2024-02-20 13:37:23'),
(47, 'DRC569841', '2024-02-20 13:40:29', '2024-02-20', NULL, 'OT', NULL, NULL, 'BATUKARANG', 3, 'yes', NULL, 1, '', 1, 150000, 0, 'admin', 'admin', NULL, 'no', '2024-02-20 13:40:29', '2024-02-20 13:42:00'),
(48, 'DRC592819', '2024-02-20 15:18:00', '2024-02-20', NULL, 'OT', NULL, NULL, 'OT', 3, 'yes', NULL, 1, '', 1, 250000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 15:18:00', '2024-02-20 15:18:00'),
(50, 'DRC326370', '2024-02-20 16:10:07', '2024-02-20', '2024-02-21', 'ubud coco supermarket', 'acala', 'potao head', 'radya homestay', 3, 'no', 4, 1, '', 1, 1300000, 0, 'admin', NULL, NULL, 'no', '2024-02-20 16:10:07', '2024-02-20 16:10:07'),
(51, 'DRC552139', '2024-03-02 13:35:43', '2024-03-02', NULL, 'ot', NULL, NULL, 'ot', 3, 'no', NULL, 1, '', 1, 100000, 0, 'admin', 'admin', NULL, 'no', '2024-03-02 13:35:43', '2024-03-02 14:00:43'),
(52, 'DRC596685', '2024-03-02 13:37:12', '2024-03-02', NULL, 'mercure sanur', NULL, NULL, 'pondok baruna', 3, 'no', NULL, 1, '', 1, 400000, 0, 'admin', NULL, NULL, 'no', '2024-03-02 13:37:12', '2024-03-02 13:37:12'),
(53, 'DRC807396', '2024-03-02 13:38:20', '2024-03-02', NULL, 'OT', NULL, NULL, 'Ohanas', 3, 'no', NULL, 1, '', 1, 800000, 0, 'admin', NULL, NULL, 'no', '2024-03-02 13:38:20', '2024-03-02 13:38:20'),
(54, 'DRC321269', '2024-03-02 13:39:08', '2024-03-02', NULL, 'OT', NULL, NULL, 'World divingg', 3, 'no', NULL, 1, 'collecct extra pu 200.000', 1, 600000, 0, 'admin', NULL, NULL, 'no', '2024-03-02 13:39:08', '2024-03-02 13:39:08'),
(55, 'DRC287116', '2024-03-02 13:40:07', '2024-03-02', NULL, 'ot', NULL, NULL, 'ot', 3, 'no', NULL, 1, '', 1, 700000, 0, 'admin', NULL, NULL, 'no', '2024-03-02 13:40:07', '2024-03-02 13:40:07'),
(56, 'DRC189300', '2024-03-02 13:54:37', '2024-03-02', '2024-03-03', 'grand inna', 'aqua nusa', 'plaza renon', 'the sampan', 3, 'no', 6, 1, 'collect extra 500.000', 1, 1500000, 0, 'admin', NULL, NULL, 'no', '2024-03-02 13:54:37', '2024-03-02 13:54:37'),
(57, 'DRC798547', '2024-03-02 13:55:41', '2024-03-02', NULL, 'OT', NULL, NULL, 'OT', 3, 'yes', NULL, 1, '', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2024-03-02 13:55:41', '2024-03-02 13:55:41'),
(58, 'DRC172441', '2024-03-06 11:33:53', '2024-03-06', '2024-03-07', 'mercure', 'Mahagiri', 'Jimbaran', 'LBC', 2, 'no', 4, 1, '', 1, 650000, 0, 'admin', 'admin', NULL, 'no', '2024-03-06 11:33:53', '2024-03-06 11:45:18'),
(59, 'DRC738838', '2024-03-06 11:40:13', '2024-03-07', '2024-03-08', 'OT', 'gogo lemb', 'ot', 'gogo lemb', 4, 'no', 3, 1, '', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2024-03-06 11:40:13', '2024-03-06 11:40:13'),
(60, 'DRC693707', '2024-03-06 11:40:51', '2024-03-07', NULL, 'OT', NULL, NULL, 'OT', 4, 'no', NULL, 1, '', 1, 250000, 0, 'admin', NULL, NULL, 'no', '2024-03-06 11:40:51', '2024-03-06 11:40:51'),
(62, 'DRC928180', '2024-03-06 11:46:48', '2024-03-07', NULL, 'OT', NULL, NULL, 'OT', 1, 'no', 5, 1, '', 1, 700000, 0, 'admin', NULL, NULL, 'no', '2024-03-06 11:46:48', '2024-03-06 11:46:48'),
(63, 'DRC467823', '2024-03-06 11:47:26', '2024-03-07', NULL, 'OT', NULL, NULL, 'OT', 3, 'yes', NULL, 1, '', 1, 666666, 0, 'admin', NULL, NULL, 'no', '2024-03-06 11:47:26', '2024-03-06 11:47:26'),
(64, 'DRC340315', '2024-03-06 11:49:20', '2024-03-06', NULL, 'ot', NULL, NULL, 'ot', 2, 'yes', NULL, 1, '', 1, 799999, 0, 'admin', 'admin', NULL, 'no', '2024-03-06 11:49:20', '2024-03-06 11:49:33'),
(65, 'DRC424579', '2024-03-06 12:15:14', '2024-03-08', NULL, 'ot', NULL, NULL, 'ot', 3, 'no', NULL, 1, '', 1, 70000, 0, 'admin', NULL, NULL, 'no', '2024-03-06 12:15:14', '2024-03-06 12:15:14'),
(66, 'DRC452619', '2024-03-06 12:17:08', '2024-03-06', NULL, 'ot', NULL, NULL, 'ot', 3, 'no', NULL, 1, '', 1, 250000, 0, 'admin', 'admin', NULL, 'no', '2024-03-06 12:17:08', '2024-03-06 12:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_detail`
--

CREATE TABLE `tbl_booking_detail` (
  `unik` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `namatamu` varchar(100) NOT NULL,
  `nasionality` varchar(100) NOT NULL,
  `nope` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jenis` enum('dewasa','anak','foc') NOT NULL,
  `jnskel` enum('pria','wanita') NOT NULL DEFAULT 'pria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_booking_detail`
--

INSERT INTO `tbl_booking_detail` (`unik`, `id`, `namatamu`, `nasionality`, `nope`, `email`, `jenis`, `jnskel`) VALUES
(1, 1, 'sarah', 'Germany', '', '', 'dewasa', 'pria'),
(2, 2, 'mirah', 'Indonesia', '', '', 'dewasa', 'pria'),
(3, 2, 'nikol', 'Indonesia', '', '', 'anak', 'pria'),
(4, 2, 'sisi', 'Indonesia', '', '', 'foc', 'pria'),
(5, 3, 'riko', 'Indonesia', '', '', 'dewasa', 'pria'),
(7, 5, 'siska', 'Indonesia', '', '', 'dewasa', 'pria'),
(8, 6, 'yohanes', 'Ireland', '', '', 'dewasa', 'pria'),
(9, 7, 'umi', 'Indonesia', '', '', 'dewasa', 'pria'),
(10, 7, 'putri', 'Indonesia', '', '', 'anak', 'pria'),
(15, 10, 'gilbert', 'British Indian Ocean Territory (the),', '0154212246554', 'gilbert@gmail.com', 'dewasa', 'pria'),
(19, 12, 'Diah', 'Indonesia', '', '', 'dewasa', 'pria'),
(20, 12, 'Gung silvi', 'Indonesia', '', '', 'foc', 'pria'),
(21, 13, 'mita', 'Indonesia', '', '', 'dewasa', 'pria'),
(22, 14, 'alexander', 'Kuwait', '', '', 'dewasa', 'pria'),
(23, 14, 'miami', 'Kuwait', '', '', 'dewasa', 'pria'),
(24, 14, 'raju', 'Kuwait', '', '', 'dewasa', 'pria'),
(25, 14, 'nana', 'Kuwait', '', '', 'dewasa', 'pria'),
(26, 15, 'Indratama', 'Indonesia', '', '', 'dewasa', 'pria'),
(27, 15, 'onez', 'Indonesia', '', '', 'anak', 'pria'),
(28, 15, 'iketut parthy', 'Indonesia', '', '', 'foc', 'pria'),
(29, 16, 'gunawan', 'Indonesia', '', '', 'dewasa', 'pria'),
(30, 17, 'kim jenny', 'Korea (the Democratic Peoples Republic of),', '+16824558622', 'kim@gmail.com', 'dewasa', 'pria'),
(31, 17, 'rose', 'Korea (the Democratic Peoples Republic of),', '', '', 'foc', 'pria'),
(32, 18, 'yumi', 'Indonesia', '', '', 'dewasa', 'pria'),
(33, 18, 'parta', 'Indonesia', '', '', 'dewasa', 'pria'),
(34, 19, 'jack karmen', 'Indonesia', '', '', 'dewasa', 'pria'),
(35, 19, 'putri yanti', 'Indonesia', '', '', 'dewasa', 'pria'),
(36, 20, 'alex', 'Iceland', '', '', 'dewasa', 'pria'),
(37, 21, 'arik', 'Indonesia', '', '', 'dewasa', 'pria'),
(38, 21, 'cas', '', '', '', 'dewasa', 'pria'),
(39, 22, 'Bayu', 'Indonesia', '', '', 'dewasa', 'pria'),
(40, 23, 'SAMSUL', 'Indonesia', '1234567890', 'SAMSUL.003@GMAIL.COM', 'dewasa', 'pria'),
(41, 24, 'iwan', 'Japan', '1542005151', 'iman@gmail.com', 'dewasa', 'pria'),
(42, 24, 'sri', 'Iraq', '', '', 'anak', 'wanita'),
(43, 25, 'HAN BIN', 'Korea (the Democratic Peoples Republic of),', '+62115868975', 'HANBIN@GMAIL.COM', 'dewasa', 'pria'),
(44, 26, 'sugiono', 'Japan', '', '', 'dewasa', 'pria'),
(45, 26, 'sumanto', '', '', '', 'dewasa', 'pria'),
(46, 27, 'justin', 'Canada', '', '', 'dewasa', 'pria'),
(47, 27, 'ben', 'Iran (Islamic Republic of),', '', '', 'foc', 'pria'),
(48, 28, 'sari', 'Indonesia', '', '', 'dewasa', 'pria'),
(49, 29, 'mita', 'Indonesia', '', '', 'dewasa', 'wanita'),
(50, 29, 'diah', 'Indonesia', '+628113883334', 'diah@123.com', 'anak', 'wanita'),
(51, 30, 'indra', 'Indonesia', '0812354879552', 'indra@gmail.com', 'dewasa', 'pria'),
(52, 31, 'sarah', 'Indonesia', '08113859644', '', 'dewasa', 'wanita'),
(53, 32, 'ones', 'Indonesia', '', '', 'dewasa', 'pria'),
(54, 32, 'susi', '', '', '', 'dewasa', 'pria'),
(55, 32, 'osi', 'Indonesia', '', '', 'anak', 'pria'),
(56, 32, 'nesi (infant)', 'Indonesia', '', '', 'foc', 'pria'),
(57, 33, 'DODI', 'Indonesia', '', '', 'dewasa', 'pria'),
(58, 34, 'PARTA', 'Indonesia', '0811235577954', 'PARTA@GMAIL.COM', 'dewasa', 'pria'),
(59, 35, 'RICO', 'Indonesia', '', '', 'dewasa', 'pria'),
(60, 36, 'PUTRI', 'Indonesia', '', '', 'dewasa', 'wanita'),
(61, 36, 'JACK', '', '', '', 'dewasa', 'pria'),
(62, 36, 'YUMI', 'Indonesia', '', '', 'anak', 'wanita'),
(63, 37, 'YOGI', 'Indonesia', '', '', 'dewasa', 'pria'),
(64, 37, 'ONES', 'Indonesia', '', '', 'anak', 'pria'),
(65, 37, 'KOMANG', 'Indonesia', '', '', 'foc', 'pria'),
(66, 38, 'MITA', 'Indonesia', '', '', 'dewasa', 'wanita'),
(67, 39, 'sarah', 'Indonesia', '', '', 'dewasa', 'pria'),
(68, 40, 'yogik', 'Indonesia', '', '', 'dewasa', 'pria'),
(69, 41, 'mita', 'Indonesia', '', '', 'dewasa', 'pria'),
(70, 41, 'sisi', 'Indonesia', '', '', 'anak', 'pria'),
(71, 42, 'didik', 'Indonesia', '', '', 'dewasa', 'pria'),
(72, 42, 'angga', '', '', '', 'dewasa', 'pria'),
(73, 43, 'mirah', 'Indonesia', '', '', 'dewasa', 'pria'),
(74, 43, 'gandi', '', '', '', 'dewasa', 'pria'),
(75, 43, 'roni', 'Indonesia', '', '', 'anak', 'pria'),
(76, 44, 'MIMIN', 'Indonesia', '', '', 'dewasa', 'pria'),
(77, 45, 'BIBI', 'Indonesia', '', '', 'dewasa', 'pria'),
(78, 45, 'PAMAN', '', '', '', 'dewasa', 'pria'),
(79, 46, 'ANNIE', 'Indonesia', '', '', 'dewasa', 'pria'),
(80, 46, 'YUMI', 'Indonesia', '', '', 'anak', 'pria'),
(81, 46, 'PARTA', 'Indonesia', '', '', 'foc', 'pria'),
(82, 47, 'INDRA', 'Indonesia', '', '', 'dewasa', 'pria'),
(83, 48, 'MUNI', 'Indonesia', '', '', 'dewasa', 'pria'),
(85, 50, 'susan', 'Indonesia', '', '', 'dewasa', 'pria'),
(86, 51, 'rico', 'Indonesia', '0811239211639', 'rico@gmail.com', 'dewasa', 'pria'),
(87, 52, 'mita', 'Indonesia', '08113883334', 'mita@gmail.com', 'dewasa', 'wanita'),
(88, 53, 'diah', 'Indonesia', '05120000', 'diah@gmail.com', 'dewasa', 'wanita'),
(89, 53, 'yogik', 'British Indian Ocean Territory (the),', '', '', 'dewasa', 'pria'),
(90, 54, 'dodik', 'Indonesia', '', '', 'dewasa', 'pria'),
(91, 55, 'indra', 'Indonesia', '', '', 'dewasa', 'pria'),
(92, 55, 'gung silvvi', 'Indonesia', '', '', 'anak', 'wanita'),
(93, 56, 'anik', 'India', '245420032', '', 'dewasa', 'wanita'),
(94, 56, 'basir', 'Indonesia', '', '', 'anak', 'pria'),
(95, 56, 'cetta', 'Indonesia', '', '', 'foc', 'pria'),
(96, 57, 'sastra', 'Indonesia', '', '', 'dewasa', 'wanita'),
(97, 58, 'dodi', 'Indonesia', '', '', 'dewasa', 'pria'),
(98, 59, 'mita', 'Indonesia', '', '', 'dewasa', 'pria'),
(99, 60, 'sinta', 'Indonesia', '', '', 'dewasa', 'pria'),
(101, 62, 'mira', 'Indonesia', '', '', 'dewasa', 'pria'),
(102, 63, 'yogi', 'Indonesia', '', '', 'dewasa', 'pria'),
(103, 64, 'sarah', 'Indonesia', '', '', 'dewasa', 'pria'),
(104, 65, 'putri', 'Indonesia', '', '', 'dewasa', 'pria'),
(105, 65, 'jack', 'Indonesia', '', '', 'anak', 'pria'),
(106, 66, 'wiwin', 'Indonesia', '', '', 'dewasa', 'pria'),
(107, 66, 'wawan', 'Indonesia', '', '', 'anak', 'pria');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_paket`
--

CREATE TABLE `tbl_booking_paket` (
  `id` int(11) NOT NULL,
  `kode_tiket` varchar(10) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `berangkat` date NOT NULL,
  `kembali` date NOT NULL,
  `pickup` varchar(100) NOT NULL,
  `dropoff` varchar(100) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `agentid` int(11) DEFAULT NULL,
  `remarks` varchar(100) NOT NULL,
  `payment` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `komisi` int(11) NOT NULL DEFAULT 0,
  `userid` varchar(10) NOT NULL,
  `checkin_by` varchar(10) DEFAULT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_paket_detail`
--

CREATE TABLE `tbl_booking_paket_detail` (
  `id` int(11) NOT NULL,
  `namatamu` varchar(100) NOT NULL,
  `nasionality` varchar(100) NOT NULL,
  `nope` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jenis` enum('dewasa','anak','foc') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id` int(11) NOT NULL,
  `namapaket` varchar(50) DEFAULT NULL,
  `keterangan` tinytext NOT NULL,
  `userid` varchar(10) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `payment`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(1, 'Cash', 'no', 'admin', '2023-12-06 08:03:34', '0000-00-00 00:00:00'),
(2, 'Mandiri Debit / Credit', 'no', 'admin', '2023-12-06 08:03:44', '0000-00-00 00:00:00'),
(3, 'BNI Debit / Credit', 'no', 'admin', '2023-12-06 08:03:53', '0000-00-00 00:00:00'),
(4, 'Voucher', 'no', 'admin', '2023-12-06 08:04:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `username` varchar(10) NOT NULL,
  `role` varchar(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`username`, `role`, `keterangan`) VALUES
('adm', 'stu', 'Setup User'),
('adm', 'stpy', 'Setup Payment'),
('adm', 'sttkt', 'Setup Ticket'),
('ari', 'stu', 'Setup User'),
('ari', 'stag', 'Setup Agent'),
('ari', 'stpy', 'Setup Payment'),
('admin', 'stu', 'Setup User'),
('admin', 'stag', 'Setup Agent'),
('admin', 'stpy', 'Setup Payment'),
('admin', 'sttkt', 'Departure Schedule'),
('admin', 'stpkt', 'Setup Paket'),
('admin', 'tpag', 'Ticket per Agent'),
('admin', 'ppag', 'Paket per Agent'),
('admin', 'bootk', 'Booking Ticket'),
('admin', 'boopk', 'Booking Paket'),
('admin', 'depto', 'Departure Today'),
('admin', 'pentk', 'Pendapatan Ticket'),
('admin', 'penpk', 'Pendapatan Paket'),
('admin', 'ttpa', 'Transaksi Ticket per Agent'),
('admin', 'tppa', 'Transaksi Paket per Agent'),
('admin', 'rkt', 'Rekap Komisi Ticket'),
('admin', 'rkp', 'Rekap Komisi Paket'),
('admin', 'rabul', 'Rangkuman Bulanan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket`
--

CREATE TABLE `tbl_tiket` (
  `id` int(11) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `berangkat` time NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `userid` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_tiket`
--

INSERT INTO `tbl_tiket` (`id`, `tujuan`, `berangkat`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(1, 'Sanur-Lembongan', '09:15:00', 'no', 'admin', '2024-01-09 11:47:13', '2024-01-09 11:49:18'),
(2, 'Sanur-Lembongan', '14:30:00', 'no', 'admin', '2024-01-09 11:48:54', NULL),
(3, 'Sanur-Lembongan', '17:00:00', 'no', 'admin', '2024-01-09 11:49:32', NULL),
(4, 'Lembongan-Sanur', '08:15:00', 'no', 'admin', '2024-01-09 11:49:55', NULL),
(5, 'Lembongan-Sanur', '13:00:00', 'no', 'admin', '2024-01-09 11:50:07', NULL),
(6, 'Lembongan-Sanur', '16:00:00', 'no', 'admin', '2024-01-09 11:50:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(10) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `role` enum('admin','kasir','marketing') DEFAULT NULL,
  `lokasi` enum('Sanur','Lembongan') NOT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `passwd`, `role`, `lokasi`, `is_deleted`, `created_at`, `update_at`) VALUES
('admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 'Sanur', 'no', '2023-12-18 10:06:24', '2024-01-08 17:14:10'),
('agus', 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 'Sanur', 'no', '2023-12-18 07:11:31', '2023-12-18 10:50:53'),
('ari', 'd58a1a35e01b9a894fae8677c08062ec90f07c91', NULL, 'Sanur', 'no', '2023-12-16 11:34:52', '2023-12-18 11:33:11');

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
  ADD KEY `userid` (`userid`),
  ADD KEY `payment` (`payment`),
  ADD KEY `checkin_by` (`checkin_by`),
  ADD KEY `tbl_booking_ibfk_7` (`checkin_return`);

--
-- Indexes for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  ADD PRIMARY KEY (`unik`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agentid` (`agentid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `payment` (`payment`),
  ADD KEY `checkin_by` (`checkin_by`);

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
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD KEY `username` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_agenpaket`
--
ALTER TABLE `tbl_agenpaket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_agentiket`
--
ALTER TABLE `tbl_agentiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  MODIFY `unik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `tbl_booking_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`),
  ADD CONSTRAINT `tbl_booking_ibfk_5` FOREIGN KEY (`payment`) REFERENCES `tbl_payment` (`id`),
  ADD CONSTRAINT `tbl_booking_ibfk_6` FOREIGN KEY (`checkin_by`) REFERENCES `tbl_user` (`username`),
  ADD CONSTRAINT `tbl_booking_ibfk_7` FOREIGN KEY (`checkin_return`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  ADD CONSTRAINT `tbl_booking_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_booking` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  ADD CONSTRAINT `tbl_booking_paket_ibfk_1` FOREIGN KEY (`agentid`) REFERENCES `tbl_agen` (`id`),
  ADD CONSTRAINT `tbl_booking_paket_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`),
  ADD CONSTRAINT `tbl_booking_paket_ibfk_3` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id`),
  ADD CONSTRAINT `tbl_booking_paket_ibfk_4` FOREIGN KEY (`payment`) REFERENCES `tbl_payment` (`id`),
  ADD CONSTRAINT `tbl_booking_paket_ibfk_5` FOREIGN KEY (`checkin_by`) REFERENCES `tbl_user` (`username`);

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
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);

--
-- Constraints for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD CONSTRAINT `tbl_role_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbl_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD CONSTRAINT `tbl_tiket_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
