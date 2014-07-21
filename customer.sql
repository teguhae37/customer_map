-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2014 at 06:35 AM
-- Server version: 5.1.69
-- PHP Version: 5.3.6-13ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_map`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `rt` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `rw` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `desa_id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `kecamatan_id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `kabupaten_id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `propinsi_id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `negara` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT 'Indonesia',
  `lat` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `lng` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `desa_id` (`desa_id`),
  KEY `kecamatan_id` (`kecamatan_id`),
  KEY `kabupaten_id` (`kabupaten_id`),
  KEY `propinsi_id` (`propinsi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `rt`, `rw`, `desa_id`, `kecamatan_id`, `kabupaten_id`, `propinsi_id`, `negara`, `lat`, `lng`) VALUES
(1, 'Teguh Andriyanto', 'Jl sersan bakrun II/26', '1', '12', '3571010013', '3571010', '3571', '35', 'Indonesia', '', ''),
(2, 'LILIS EKOWATI', 'Jl KH Wakhid Hasyim Gg. Bandar Lor 5B', '1', '2', '3571010007', '3571010', '3571', '35', 'Indonesia', '-7.822042', '112.004697'),
(3, 'EMI ZURAIDAH', 'JL JAMSAREN I/5B ', '', '', '3571030015', '3571030', '3571', '35', 'Indonesia', '-7.836556', '112.044085'),
(4, 'DIAN EKOWATI', '', '01', '02', '3506220001', '3506220', '3506', '35', 'Indonesia', '-7.764743', '111.910458'),
(5, 'DEWI IRIANTHI RAHARDJ RR', 'PERUM CANDRA KIRANA T26', '', '', '3571010008', '3571010', '3571', '35', 'Indonesia', '-7.817977', '112.001703'),
(6, 'PRASETYONINGSIH', '', '02', '05', '3506210003', '3506210', '3506', '35', 'Indonesia', '', ''),
(8, 'TRIANA PUSPITASARI', 'JL MAUNI II/27A ', '', '', '3571030010', '3571030', '3571', '35', 'Indonesia', '', ''),
(9, 'FANSISCA RINA SUMARSONO', 'Jl Setono Betek 2 no 36', '', '', '3571030004', '3571030', '3571', '35', 'Indonesia', '-7.824482', '112.016019'),
(10, 'MELINNA', 'Jl Botolengket', '', '', '3571010010', '3571010', '3571', '35', 'Indonesia', '', ''),
(11, 'HARAMOKO', 'Jl Dr Saharjo III no 44', '', '', '3571010002', '3571010', '3571', '35', 'Indonesia', '-7.825289', '111.985824');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_4` FOREIGN KEY (`propinsi_id`) REFERENCES `propinsi` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
