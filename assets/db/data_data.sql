-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2023 at 05:16 PM
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
-- Database: `directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_data`
--

CREATE TABLE `data_data` (
  `id` int NOT NULL,
  `projectname` varchar(200) NOT NULL,
  `developer` varchar(200) NOT NULL,
  `referensi` varchar(200) NOT NULL,
  `local` varchar(500) NOT NULL,
  `public` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_data`
--

INSERT INTO `data_data` (`id`, `projectname`, `developer`, `referensi`, `local`, `public`) VALUES
(1, 'Cafe V-Coffe', 'Muhammad Rifqi Nurfadillah', 'Markaz Virtual', 'http://localhost/dir/cafevcoffe/', 'https://nooizy.site/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_data`
--
ALTER TABLE `data_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_data`
--
ALTER TABLE `data_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
