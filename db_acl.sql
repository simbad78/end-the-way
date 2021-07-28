-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 06:36 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_acl`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_grouping`
--

CREATE TABLE `list_grouping` (
  `id` int(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `direction` varchar(255) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_grouping`
--

INSERT INTO `list_grouping` (`id`, `nama`, `port`, `direction`, `tanggal_input`) VALUES
(3, 'rian', 'Fa0/1', 'out', '2021-01-14 15:24:31'),
(4, 'sss', 'Fa0/1', 'in', '2021-01-14 15:24:25'),
(7, '', 'Fa0/0', '', '2021-02-12 09:44:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_grouping`
--
ALTER TABLE `list_grouping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_grouping`
--
ALTER TABLE `list_grouping`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
