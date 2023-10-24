-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 13, 2023 at 01:33 AM
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
-- Database: `db_vcoffe`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` bigint NOT NULL DEFAULT '0',
  `meja` int DEFAULT NULL,
  `pelanggan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `catatan` varchar(200) DEFAULT NULL,
  `pelayan` int DEFAULT NULL,
  `waktu_order` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `meja`, `pelanggan`, `catatan`, `pelayan`, `waktu_order`) VALUES
(7580910815, 7, 'Muhammad', '', 1, '2023-10-09 00:58:28'),
(11261010431, 8, 'Daffa', '', 2, '2023-10-10 04:26:26'),
(13230210856, 1, 'Super Admin', '', 2, '2023-10-02 06:23:56'),
(13250210845, 2, 'Super User', '', 2, '2023-10-02 06:25:43'),
(13260210809, 3, 'Muhammad', '', 2, '2023-10-02 06:26:42'),
(15521010231, 10, 'Hibban', '', 2, '2023-10-10 08:52:21'),
(19050210262, 4, 'Rifqi', '', 2, '2023-10-02 12:05:45'),
(19340610622, 1, 'Nur', '', 3, '2023-10-06 12:34:33'),
(21340810801, 5, 'Fadillah', '', 3, '2023-10-08 14:34:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`) USING BTREE,
  ADD KEY `pelayan` (`pelayan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `FK_tb_order_tb_user` FOREIGN KEY (`pelayan`) REFERENCES `tb_user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
