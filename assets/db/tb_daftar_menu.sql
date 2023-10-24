-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 13, 2023 at 01:32 AM
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
-- Table structure for table `tb_daftar_menu`
--

CREATE TABLE `tb_daftar_menu` (
  `id` int NOT NULL,
  `foto` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama_menu` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `keterangan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kategori` int DEFAULT NULL,
  `harga` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `stock` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_daftar_menu`
--

INSERT INTO `tb_daftar_menu` (`id`, `foto`, `nama_menu`, `keterangan`, `kategori`, `harga`, `stock`) VALUES
(1, '7720514-progress_pict.png', 'Mie Goreng Seafood', '', 1, '25000', '777'),
(2, '779501-progress_pict.png', 'Nasi Goreng Seafood', '', 1, '25000', '777'),
(3, '5579696-progress_pict.png', 'Pangsit Goreng', '', 2, '10000', '777'),
(4, '6693779-progress_pict.png', 'Dimsum', '', 2, '10000', '777'),
(5, '4573285-progress_pict.png', 'Banana Split', '', 3, '10000', '777'),
(6, '8852715-progress_pict.png', 'Manggo King', '', 3, '20000', '777'),
(7, '605019-progress_pict.png', 'Kopi Latte Queen', '', 4, '15000', '777'),
(8, '6093226-progress_pict.png', 'Manggo Juice', '', 5, '15000', '777'),
(9, '1643467-progress_pict.png', 'Mojito', '', 6, '15000', '777'),
(10, '6019830-progress_pict.png', 'Viral Tea', '', 7, '10000', '777'),
(11, '8092216-progress_pict.png', 'Nasi Goreng Ayam', '', 1, '20000', '777'),
(12, '6700-progress_pict.png', 'Nasi Goreng Sosis', '', 1, '20000', '777'),
(13, '3143076-progress_pict.png', 'Mie Goreng Ayam', '', 1, '20000', '777'),
(14, '5846131-progress_pict.png', 'Bihun Goreng Ayam', '', 1, '20000', '777'),
(15, '2659755-progress_pict.png', 'Bihun Goreng Seafood', '', 1, '25000', '777'),
(16, '2019107-progress_pict.png', 'Kwetiaw Goreng Ayam', '', 1, '20000', '777'),
(17, '3985679-progress_pict.png', 'Kwetiaw Goreng Seafood', '', 1, '25000', '777'),
(18, '862006-progress_pict.png', 'French Fries', '', 2, '10000', '777');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kategori` (`kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  ADD CONSTRAINT `tb_daftar_menu_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_menu` (`id_kat_menu`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
