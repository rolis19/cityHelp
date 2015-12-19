-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2015 at 07:39 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartcity`
--

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `idioms` varchar(500) NOT NULL,
  `author` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `idioms`, `author`) VALUES
(1, '"Kita memiliki banyak masalah itu bukan karena semata orang jahat banyak, tapi juga karena orang-orang baik yang ada hanya diam dan mendiamkan kejahatan yang terjadi."', 'Anies Baswedan - Menteri Pendidikan dan Kebudayaan '),
(2, 'Do your creativity to change your Society', '@ridwankamil - Mayor of West Java'),
(3, 'A great city is not to be confounded with a populous one.', 'Aristotle - Greek Philosopher'),
(4, 'A city is a place where there is no need to wait for next week to get the answer to a question, to taste the food of any country, to find new voices to listen to and familiar ones to listen to again.', 'Margaret Mead - American Anthropologist'),
(5, 'A great city is that which has the greatest men and women.', 'Walt Whitman - American Poet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
