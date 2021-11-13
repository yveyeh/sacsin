-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 13, 2021 at 08:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sacsin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `expected_response`
--

CREATE TABLE `expected_response` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `details` varchar(256) NOT NULL,
  `last_edited` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expected_response`
--

INSERT INTO `expected_response` (`id`, `name`, `details`, `last_edited`) VALUES
(1, 'Confirmation of continous compliance', 'Confirmation of continous compliance, Yes/No/Not applicable, Comment, text', '2 mins'),
(2, 'Measured result', 'Measured result, value, Document id, text, Issue date, date, document issuer, text', '30 mins'),
(3, 'Estimated amount', 'Estimated amount, value, Date, date', '2 hrs'),
(4, 'Calculated amount', 'Calculated amount, value, Date, date', '30 mins'),
(5, 'Estimated amount, Estimation  model', 'Estimated amount, value, Date, date, Estimation model, text', '1 hr'),
(6, 'Measured result', 'Measured result accordning to standard, Document id, text, Issue date, date, document issuer, text', '15 mins'),
(7, 'Certified production', 'Confirmed, Yes/No/Not applicable, Document ID, text, Issue date, date, document issuer, text, Comment, text', '2 hrs');

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `response_sentence` varchar(256) NOT NULL,
  `last_edited` varchar(65) NOT NULL,
  `alert_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `name`, `response_sentence`, `last_edited`, `alert_status`) VALUES
(1, 'Toy requirements EN 71-3:2019', ' 9 + 10 + 11 +12', '2 mins', 'success'),
(2, 'CO2 footprint production', '15', '30 mins', 'success'),
(3, 'CO2 footprint production and external parts and components', '15+16', '2 hrs', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `response_package` varchar(256) NOT NULL,
  `last_edited` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(15) NOT NULL,
  `request_id` varchar(15) NOT NULL,
  `product_id` int(15) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `responder_id` varchar(15) NOT NULL,
  `status` enum('Completed','Pending') NOT NULL,
  `is_sub_request` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_packages`
--

CREATE TABLE `request_packages` (
  `id` int(11) NOT NULL,
  `package_number` varchar(45) NOT NULL,
  `request_id` varchar(15) NOT NULL,
  `product` varchar(128) NOT NULL,
  `seller` varchar(128) NOT NULL,
  `objects` varchar(2048) NOT NULL,
  `last_edited` varchar(15) NOT NULL,
  `exp_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_packages`
--

INSERT INTO `request_packages` (`id`, `package_number`, `request_id`, `product`, `seller`, `objects`, `last_edited`, `exp_file`) VALUES
(7, '12345678', '224164', 'Toy crane', 'The Toy Factory Ltd', 'a:3:{i:0;s:29:\"Toy requirements EN 71-3:2019\";i:1;s:24:\"CO2 footprint production\";i:2;s:58:\"CO2 footprint production and external parts and components\";}', '3 mins', ''),
(9, '12345679', '196241', 'Chique dining chair', 'Furntech Bright day Ltd', 'a:3:{i:0;s:29:\"Toy requirements EN 71-3:2019\";i:1;s:24:\"CO2 footprint production\";i:2;s:58:\"CO2 footprint production and external parts and components\";}', '3 mins', ''),
(27, '24524054', '167920', 'Toy crane', 'The Toy Factory Ltd', 'a:3:{i:0;s:29:\"Toy requirements EN 71-3:2019\";i:1;s:24:\"CO2 footprint production\";i:2;s:58:\"CO2 footprint production and external parts and components\";}', '3 mins', 'SR-167920-1636763878.scsn');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(1, 'buyer@sacsin.com', '@buyer123#', 'buyer'),
(2, 'seller@sacsin.com', '@seller123#', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expected_response`
--
ALTER TABLE `expected_response`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `request_packages`
--
ALTER TABLE `request_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_id` (`request_id`),
  ADD UNIQUE KEY `package_number` (`package_number`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expected_response`
--
ALTER TABLE `expected_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_packages`
--
ALTER TABLE `request_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
