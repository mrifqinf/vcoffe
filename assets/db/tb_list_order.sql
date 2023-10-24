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
-- Table structure for table `tb_list_order`
--

CREATE TABLE `tb_list_order` (
  `id_list_order` int NOT NULL,
  `menu` int DEFAULT NULL,
  `kode_order` bigint NOT NULL,
  `jumlah` int DEFAULT NULL,
  `catatan_item` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_list_order`
--

INSERT INTO `tb_list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `catatan_item`, `status`) VALUES
(1, 1, 13230210856, 1, 'Sedang', 2),
(2, 9, 13230210856, 1, '', 2),
(3, 7, 13250210845, 1, '', 2),
(5, 3, 13250210845, 1, '', 2),
(9, 4, 13260210809, 2, '', 2),
(10, 6, 13260210809, 1, '', 2),
(11, 7, 13260210809, 1, '', 2),
(12, 9, 13260210809, 1, '', 2),
(13, 2, 19050210262, 11, '', 2),
(14, 1, 19050210262, 11, '', 2),
(18, 4, 19050210262, 1, '', 2),
(19, 7, 19050210262, 2, '', 2),
(20, 1, 19340610622, 1, 'Pedas', 2),
(21, 2, 19340610622, 2, '1 Pedas 1 Sedang', 2),
(22, 7, 19340610622, 2, '', 2),
(23, 9, 19340610622, 1, '', 2),
(24, 1, 21340810801, 1, 'Pedas', 2),
(25, 8, 21340810801, 1, '', 2),
(28, 17, 7580910815, 1, '', 2),
(31, 6, 11261010431, 20, '', 2),
(32, 3, 11261010431, 30, '', 2),
(33, 1, 11261010431, 26, '', 2),
(34, 5, 11261010431, 20, '', 2),
(64, 7, 15521010231, 7, '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `menu` (`menu`),
  ADD KEY `order` (`kode_order`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  MODIFY `id_list_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD CONSTRAINT `FK_tb_list_order_tb_daftar_menu` FOREIGN KEY (`menu`) REFERENCES `tb_daftar_menu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_list_order_tb_order` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
