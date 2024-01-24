-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 12:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_agen`
--

INSERT INTO `tbl_agen` (`id`, `nama`, `alamat`, `kota`, `kontak`, `tipe`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(1, 'Gede Wirya', 'JALAN TAMAN AYU II B1 GIRI ASRI LINGKUNGAN MUMBUL', 'Badung', '081353523256', 'general', 'yes', 'admin', '2023-12-06 08:02:09', '2023-12-22 08:52:46'),
(2, 'Surya Travel', 'Jalan Merdeka No. 2 Denpasar', 'Denpasar', '0361912345', 'company', 'no', 'admin', '2023-12-06 08:02:44', NULL),
(3, 'Air Travel', 'Jalan Tukad Air  No. 2 Denpasar', 'Denpasar', '036187654', 'company', 'no', 'admin', '2023-12-06 08:03:22', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_agenpaket`
--

INSERT INTO `tbl_agenpaket` (`id`, `id_agen`, `id_paket`, `berlaku`, `berakhir`, `harga`, `userid`, `created_at`, `update_at`) VALUES
(1, 2, 1, '2023-12-06 08:16:53', NULL, 1000000, 'admin', '2023-12-06 08:16:53', '0000-00-00 00:00:00'),
(2, 2, 2, '2023-12-06 08:17:05', NULL, 1000000, 'admin', '2023-12-06 08:17:05', '0000-00-00 00:00:00'),
(3, 2, 3, '2023-12-06 08:17:15', NULL, 1000000, 'admin', '2023-12-06 08:17:15', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_agentiket`
--

INSERT INTO `tbl_agentiket` (`id`, `id_agen`, `id_tiket`, `berlaku`, `berakhir`, `harga`, `userid`, `created_at`, `update_at`) VALUES
(1, 2, 1, '2023-12-06 08:06:57', NULL, 300000, 'admin', '2023-12-06 08:06:57', '0000-00-00 00:00:00'),
(2, 2, 2, '2023-12-06 08:10:17', NULL, 300000, 'admin', '2023-12-06 08:10:17', '0000-00-00 00:00:00'),
(3, 2, 3, '2023-12-06 08:16:09', NULL, 300000, 'admin', '2023-12-06 08:16:09', '0000-00-00 00:00:00'),
(4, 2, 5, '2023-12-06 08:16:22', NULL, 300000, 'admin', '2023-12-06 08:16:22', '0000-00-00 00:00:00'),
(5, 2, 4, '2023-12-06 08:16:38', NULL, 300000, 'admin', '2023-12-06 08:16:38', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `kode_tiket`, `tgl_pesan`, `berangkat`, `kembali`, `pickup`, `r_pickup`, `r_dropoff`, `dropoff`, `depart`, `is_open`, `return_from`, `agentid`, `remarks`, `payment`, `charge`, `komisi`, `userid`, `checkin_by`, `checkin_return`, `is_deleted`, `created_at`, `update_at`) VALUES
(1, 'TIX995397', '2023-12-06 08:19:25', '2023-12-06', '2023-12-07', 'Hotel Cakra', 'Pelabuhan', 'Hotel Cakra', 'Pelabuhan', 4, 'no', 5, 2, 'TBA', 1, 1500000, 0, 'admin', NULL, NULL, 'no', '2023-12-06 08:19:25', '2023-12-06 08:19:25'),
(2, 'TIX363297', '2023-12-10 18:25:04', '2023-12-10', '2023-12-13', 'Pelabuhan Sanur', 'Sea La Vie', 'Pelabuhan Sanur', 'Sea La Vie', 4, 'no', 5, 2, 'Jemput', 1, 1000000, 0, 'admin', NULL, NULL, 'no', '2023-12-10 18:25:04', '2023-12-10 18:25:04'),
(3, 'TIX375865', '2023-12-11 15:28:09', '2023-12-11', '2023-12-12', 'hotel', 'pelabuhan', 'hotel', 'pelabuhan', 4, 'no', 5, 2, '-', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-11 15:28:09', '2023-12-11 15:28:09'),
(4, 'TIX375865', '2023-12-11 15:28:12', '2023-12-11', '2023-12-12', 'hotel', 'pelabuhan', 'hotel', 'pelabuhan', 4, 'no', 5, 2, '-', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-11 15:28:12', '2023-12-11 15:28:12'),
(5, 'TIX887126', '2023-12-14 04:20:24', NULL, NULL, 'pickup beach', NULL, NULL, 'dropoff beach', 1, 'yes', NULL, 2, 'remarks', 1, 4000000, 0, 'admin', NULL, NULL, 'no', '2023-12-14 04:20:24', '2023-12-14 04:20:24'),
(6, 'TIX715905', '2023-12-14 09:21:32', '2023-12-14', NULL, 'asd', NULL, NULL, 'asd', 1, 'no', NULL, 2, 'asd', 1, 700000, 0, 'admin', NULL, NULL, 'no', '2023-12-14 09:21:32', '2023-12-14 09:21:32'),
(7, 'TIX238581', '2023-12-14 09:32:41', '2023-12-19', NULL, 'cas', NULL, NULL, 'cas', 1, 'no', NULL, 2, 'cas', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-14 09:32:41', '2023-12-14 09:32:41'),
(8, 'TIX831126', '2023-12-15 00:16:05', '2023-12-16', NULL, 'assss', NULL, NULL, 'asss', 1, 'no', NULL, 2, 'sass', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-15 00:16:05', '2023-12-15 00:16:05'),
(9, 'TIX336719', '2023-12-15 00:31:35', NULL, NULL, 'cccc', NULL, NULL, 'ccccc', 1, 'yes', NULL, 2, 'ccccc', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-15 00:31:35', '2023-12-15 00:31:35'),
(10, 'TIX954219', '2023-12-15 00:33:21', '2023-12-16', '2023-12-19', 'aa', 'aaaaa', 'ddddd', 'ddd', 1, 'no', 1, 2, 'rrrr', 1, 10000000, 0, 'admin', 'admin', NULL, 'no', '2023-12-15 00:33:21', '2023-12-15 00:33:21'),
(11, 'TIX267935', '2023-12-15 02:41:33', '2023-12-15', NULL, 'hotel', NULL, NULL, 'pelabuhan', 2, 'no', NULL, 2, '', 1, 10000000, 0, 'admin', 'kasir', NULL, 'no', '2023-12-15 02:41:33', '2023-12-15 06:10:23'),
(12, 'TIX398168', '2023-12-15 05:25:42', '2023-12-15', '2023-12-18', 'qqqqq', 'qqq', 'qqq', 'qqqqq', 2, 'no', 5, 2, 'qqq', 1, 700000, 0, 'admin', 'kasir', NULL, 'no', '2023-12-15 05:25:42', '2023-12-15 06:10:21'),
(14, 'TIX186969', '2023-12-15 08:37:14', '2023-12-15', NULL, 'ccc', NULL, NULL, 'ccc', 5, 'no', NULL, 2, 'ccc', 1, 700000, 0, 'admin', NULL, NULL, 'no', '2023-12-15 08:37:14', '2023-12-15 08:37:14'),
(15, 'TIX810719', '2023-12-15 08:38:53', '2023-12-20', NULL, 'aaa', NULL, NULL, 'sss', 1, 'no', NULL, 2, 'ddd', 1, 1500000, 0, 'admin', NULL, NULL, 'no', '2023-12-15 08:38:53', '2023-12-15 08:38:53'),
(16, 'TIX394293', '2023-12-16 12:22:06', '2023-12-16', '2023-12-18', 'aaa', 'aa', 'aaa', 'aaa', 1, 'no', 2, 2, 'aaa', 1, 1000000, 0, 'admin', NULL, NULL, 'no', '2023-12-16 12:22:06', '2023-12-16 12:22:06'),
(17, 'TIX676372', '2023-12-16 12:48:12', '2023-12-17', NULL, 'ppp', NULL, NULL, 'dddd', 1, 'yes', NULL, 2, 'rrr', 1, 1500000, 0, 'admin', NULL, NULL, 'no', '2023-12-16 12:48:12', '2023-12-16 12:48:12'),
(18, 'TIX665161', '2023-12-16 12:49:37', '2023-12-18', NULL, 'asd', NULL, NULL, 'asd', 2, 'yes', NULL, 2, 'sad', 1, 700000, 0, 'admin', NULL, NULL, 'no', '2023-12-16 12:49:37', '2023-12-16 12:49:37'),
(19, 'TIX656570', '2023-12-18 07:21:39', '2023-12-21', '2023-12-21', 'asd', NULL, NULL, 'asd', 1, 'yes', NULL, 2, 'asd', 1, 1000000, 0, 'ari', NULL, NULL, 'no', '2023-12-18 07:21:39', '2023-12-18 08:06:51'),
(20, 'TIX760949', '2023-12-18 07:30:08', '2023-12-21', NULL, 'aaa', NULL, NULL, 'aaa', 1, 'no', NULL, 2, 'aaa', 1, 500000, 0, 'ari', NULL, NULL, 'no', '2023-12-18 07:30:08', '2023-12-18 07:30:08'),
(21, 'TIX240081', '2023-12-18 08:15:38', '2023-12-27', '2023-12-30', 'fff', NULL, NULL, 'fff', 4, 'no', NULL, 2, 'fff', 1, 1000000, 0, 'ari', NULL, NULL, 'no', '2023-12-18 08:15:38', '2023-12-18 08:15:59'),
(22, 'TIX339988', '2023-12-26 14:16:20', '2023-12-27', '2023-12-29', 'pantai', 'pantai', 'hotel sanur', 'hotel nusa penida', 5, 'no', 4, 2, 'slowly', 1, 4000000, 0, 'admin', NULL, NULL, 'no', '2023-12-26 14:16:20', '2023-12-26 14:16:20'),
(23, 'TIX388427', '2023-12-29 08:00:00', '2023-12-29', NULL, 'Sini Saja', NULL, NULL, 'situ yah', 5, 'no', NULL, 2, '', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-29 08:00:00', '2023-12-29 08:00:15'),
(24, 'TIX165620', '2023-12-29 08:16:25', '2023-12-30', NULL, 'pickup harbour', NULL, NULL, 'drop off hotel', 5, 'yes', NULL, 2, 'remarks', 1, 1000000, 0, 'admin', 'admin', NULL, 'no', '2023-12-29 08:16:25', '2023-12-30 13:24:23'),
(25, 'TIX314605', '2023-12-30 07:43:47', '2023-12-30', '2023-12-31', 'habour', NULL, NULL, 'habour', 4, 'no', 5, 2, '', 1, 700000, 0, 'admin', NULL, NULL, 'no', '2023-12-30 07:43:47', '2023-12-30 07:43:47'),
(26, 'TIX332926', '2023-12-30 07:48:24', '2024-01-01', NULL, 'Harbour', NULL, NULL, 'Harbour', 4, 'no', NULL, 2, '', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2023-12-30 07:48:24', '2023-12-30 07:48:24'),
(27, 'TIX248328', '2024-01-04 15:34:44', '2024-01-06', '2024-01-08', 'mercure', 'krisna home stay 12.00-12.30', 'jimbaran mcd', 'krisna homestay', 4, 'no', 5, 2, 'include', 1, 2000000, 0, 'admin', NULL, NULL, 'no', '2024-01-04 15:34:44', '2024-01-04 15:34:44'),
(28, 'DRC932300', '2024-01-08 14:48:01', '2024-01-09', NULL, 'Disini', NULL, NULL, 'Disana', 5, 'no', NULL, 2, 'no at all', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2024-01-08 14:48:01', '2024-01-08 14:48:01'),
(39, 'DRC614347', '2024-01-08 15:45:10', '2024-01-08', NULL, 'Sanur', NULL, NULL, 'Lembongan', 5, 'no', NULL, 2, 'no at all', 1, 500000, 0, 'admin', NULL, NULL, 'no', '2024-01-08 15:45:10', '2024-01-08 15:45:10');

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
  `jenis` enum('dewasa','anak','foc') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking_detail`
--

INSERT INTO `tbl_booking_detail` (`unik`, `id`, `namatamu`, `nasionality`, `nope`, `email`, `jenis`) VALUES
(1, 1, 'Putu Andi', 'Indonesia', '', '', 'dewasa'),
(2, 1, 'Nyoman Gede', 'Indonesia', '', '', 'dewasa'),
(3, 1, 'Alex', 'United Kingdom of Great Britain and Northern Ireland (the),', '', '', 'dewasa'),
(4, 2, 'Adi', 'Indonesia', '', '', 'dewasa'),
(5, 2, 'Ani', 'Indonesia', '', '', 'dewasa'),
(6, 2, 'Budi', 'Indonesia', '', '', 'anak'),
(7, 2, 'Nyoman', 'Indonesia', '', '', 'foc'),
(8, 3, 'Adi', 'Indonesia', '', '', 'dewasa'),
(9, 4, 'Adi', 'Indonesia', '', '', 'dewasa'),
(10, 5, 'dessy', 'Afghanistan', '', '', 'dewasa'),
(11, 5, 'anak dessy', 'Afghanistan', '', '', 'anak'),
(12, 5, 'anak dessy 2', 'Afghanistan', '', '', 'anak'),
(13, 6, 'aaaa', 'Afghanistan', '', '', 'dewasa'),
(14, 6, 'bbb', 'Algeria', '', '', 'dewasa'),
(15, 6, 'dddd', 'Belgium', '', '', 'dewasa'),
(16, 6, 'cccc', 'Albania', '', '', 'anak'),
(17, 6, 'eeee', 'Benin', '', '', 'anak'),
(18, 7, 'aaaa', 'Afghanistan', '1111', 'a@.com', 'dewasa'),
(19, 7, 'bbb', 'Bahrain', '', '', 'dewasa'),
(20, 7, 'cccc', 'Bhutan', '3333', 'c@.com', 'anak'),
(21, 7, 'dddd', 'Canada', '', '', 'anak'),
(22, 7, 'eeee', 'Bermuda', '555', 'e@.com', 'foc'),
(23, 7, 'fffffff', 'Cocircte dIvoire', '', '', 'foc'),
(24, 8, 'a', 'Afghanistan', '', '', 'dewasa'),
(25, 9, 'ari', 'Indonesia', '111111111', '', 'dewasa'),
(26, 9, 'ariana', 'Indonesia', '222222', '', 'anak'),
(27, 10, 'bebe', 'Aland Islands', '0000000', 'a@a.com', 'dewasa'),
(28, 10, 'baba anak', 'Belarus', '123', '', 'anak'),
(29, 10, 'Dede', 'Belarus', '', '', 'foc'),
(30, 11, 'fahri', 'Afghanistan', '111111', '', 'dewasa'),
(31, 11, 'Lady Gaga', 'Benin', '', 'gaga@gmail.com', 'foc'),
(32, 12, 'Ari', 'Bahrain', '1111111', '', 'dewasa'),
(33, 12, 'Rade', 'Antarctica', '', '', 'dewasa'),
(34, 12, 'Raffi Ahmad', 'Albania', '', '', 'foc'),
(35, 14, 'Babe', 'Afghanistan', '', '', 'dewasa'),
(36, 15, 'aaa', 'Afghanistan', '', '', 'dewasa'),
(37, 15, 'bbbb', 'American Samoa', '', '', 'dewasa'),
(38, 15, 'ccccc', 'Algeria', '', '', 'dewasa'),
(39, 15, 'dddd', 'American Samoa', '', '', 'dewasa'),
(40, 16, 'hehehe', 'Afghanistan', '', '', 'dewasa'),
(41, 16, 'foc', 'Afghanistan', '', '', 'foc'),
(42, 17, 'jjj', 'Afghanistan', '111', '', 'dewasa'),
(43, 18, 'ssss', 'Afghanistan', '1111', '', 'dewasa'),
(44, 19, 'dede', 'Afghanistan', '1111', '', 'dewasa'),
(45, 20, 'cek', 'Andorra', '', '', 'dewasa'),
(46, 21, 'xxx', 'Afghanistan', '', '', 'dewasa'),
(47, 22, 'Ari Putra', 'Indonesia', '081231231213', '', 'dewasa'),
(48, 23, 'badu', 'Indonesia', '08123912381', 'badu@badu.com', 'dewasa'),
(49, 23, 'rudi', 'Indonesia', '081234812931', 'rudi@rudi.com', 'dewasa'),
(50, 24, 'Handi', 'Indonesia', '085123123123', 'handi@.com', 'dewasa'),
(51, 24, 'yes', 'Indonesia', '081212312312', 'yes@gmail.com', 'dewasa'),
(52, 25, 'gede', 'Indonesia', '87762000722', '', 'dewasa'),
(53, 26, 'Kadek', 'Indonesia', '087762000722', '', 'dewasa'),
(54, 27, 'susan', 'Indonesia', '', '', 'dewasa'),
(55, 27, 'mira', 'Indonesia', '', '', 'anak'),
(56, 27, 'sarah', 'Indonesia', '', '', 'foc'),
(57, 28, 'Bagus', 'Indonesia', '081234712819', '', 'dewasa'),
(82, 39, 'Rudiman', 'Indonesia', '', '', 'dewasa');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking_paket`
--

INSERT INTO `tbl_booking_paket` (`id`, `kode_tiket`, `tgl_pesan`, `berangkat`, `kembali`, `pickup`, `dropoff`, `id_paket`, `agentid`, `remarks`, `payment`, `charge`, `komisi`, `userid`, `checkin_by`, `is_deleted`, `created_at`, `update_at`) VALUES
(1, 'TIX430756', '2023-12-14 09:58:10', '2023-12-15', '2023-12-23', 'asd', 'asd', 1, 2, 'asd', 1, 1500000, 0, 'admin', NULL, 'no', '2023-12-14 09:58:10', '2023-12-14 09:58:10'),
(2, 'TIX552847', '2023-12-16 13:29:37', '2023-12-16', '2023-12-24', 'aaa', 'aaa', 3, 2, 'aaa', 1, 10000000, 0, 'admin', 'admin', 'no', '2023-12-16 13:29:37', '2023-12-16 13:29:37');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking_paket_detail`
--

INSERT INTO `tbl_booking_paket_detail` (`id`, `namatamu`, `nasionality`, `nope`, `email`, `jenis`) VALUES
(1, 'aaa', 'Afghanistan', '111', 'a@.com', 'dewasa'),
(1, 'bbbb', 'Australia', '', '', 'dewasa'),
(1, 'cccc', 'Algeria', '3333', 'c@.com', 'anak'),
(1, 'ddd', 'Bahrain', '', '', 'anak'),
(1, 'eeee', 'Aruba', '', '', 'anak'),
(1, 'fff', 'Aland Islands', '77777', 'f@.com', 'foc'),
(1, 'ggg', 'Albania', '', '', 'foc'),
(2, 'add', 'Afghanistan', '', '', 'dewasa');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id`, `namapaket`, `keterangan`, `userid`, `is_deleted`, `created_at`, `update_at`) VALUES
(1, 'Paket I', 'Paket I', 'admin', 'no', '2023-12-06 08:06:22', '0000-00-00 00:00:00'),
(2, 'Paket II', 'Paket II', 'admin', 'no', '2023-12-06 08:06:34', '0000-00-00 00:00:00'),
(3, 'Paket III', 'Paket III', 'admin', 'no', '2023-12-06 08:06:43', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tiket`
--

INSERT INTO `tbl_tiket` (`id`, `tujuan`, `berangkat`, `is_deleted`, `userid`, `created_at`, `update_at`) VALUES
(1, 'Sanur-Lembongan', '07:00:00', 'no', 'admin', '2023-12-06 08:04:43', NULL),
(2, 'Sanur-Lembongan', '08:00:00', 'no', 'admin', '2023-12-06 08:04:50', NULL),
(3, 'Sanur-Lembongan', '09:00:00', 'no', 'admin', '2023-12-06 08:04:56', NULL),
(4, 'Sanur-Lembongan', '11:00:00', 'no', 'admin', '2023-12-06 08:05:37', NULL),
(5, 'Lembongan-Sanur', '12:00:00', 'no', 'admin', '2023-12-06 08:05:45', NULL),
(6, 'Lembongan-Sanur', '14:00:00', 'no', 'admin', '2023-12-06 08:05:55', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_agenpaket`
--
ALTER TABLE `tbl_agenpaket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_agentiket`
--
ALTER TABLE `tbl_agentiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_booking_detail`
--
ALTER TABLE `tbl_booking_detail`
  MODIFY `unik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_booking_paket`
--
ALTER TABLE `tbl_booking_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
