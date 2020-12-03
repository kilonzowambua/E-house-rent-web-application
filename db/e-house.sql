-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2020 at 09:11 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-house`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cid` int(11) NOT NULL,
  `fname` varchar(10) DEFAULT NULL,
  `mname` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `photo` varchar(120) DEFAULT 'dummy.jpeg',
  `password` varchar(120) DEFAULT NULL,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cid`, `fname`, `mname`, `lname`, `age`, `email`, `photo`, `password`, `rdate`) VALUES
(11, 'Big', 'boss', 'lady', 2013, 'test@test.com', 'dummy.jpeg', 'test', '2019-11-19 11:41:33'),
(13, 'csfds', 'dsgfdg', 'sgwer', 2019, 'demo@demo.com', 'dummy.jpeg', 'student', '2019-11-03 11:40:19'),
(14, 'Big', 'Charle', 'lady', 2019, 'martdevelopers254@gmail.com', 'dummy.jpeg', 'demo', '2019-11-03 11:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `hid` int(11) NOT NULL,
  `housename` varchar(100) DEFAULT NULL,
  `housetype` varchar(100) DEFAULT NULL,
  `cost` varchar(8) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(123) NOT NULL DEFAULT 'Vacant'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`hid`, `housename`, `housetype`, `cost`, `location`, `image`, `from`, `status`) VALUES
(1, 'Green park', 'apartment', '1400', 'Machakos', 'apart1.jpg', '2019-10-22 11:24:39', 'occupied'),
(2, 'Ross hood2', 'Villa2', '2.12', 'Machakos', 'house_for_rent_in_nairobi_nairobi_area_4020135512933548042.jpg', '2019-10-23 13:58:32', 'Vacant'),
(3, 'Ross joys', 'Villa', '2.1', 'Kenya isreal', 'villa1.jpg', '2019-10-23 13:58:42', 'Vacant'),
(4, 'Old Reggu', 'Town house', '500', 'Kitui', 'house1.jpeg', '2019-10-23 14:00:47', 'occupied'),
(5, 'Old farm', 'Town house', '500', 'Makueni', 'house2.jpeg', '2019-10-23 14:02:28', 'occupied'),
(6, 'Unite squad', 'Apartment', '123', 'Nairobi', 'apart1.jpg', '2019-10-23 14:07:35', 'Vacant'),
(7, 'CLixx', NULL, 'ksh 10m', 'Machakos', 'image_2.jpg', '2019-11-06 16:49:42', 'occupied'),
(8, 'MAX2', 'valli', '120000', 'Machakos', 'house_for_rent_in_nairobi_nairobi_area_4020135512933548042.jpg', '2019-11-06 16:59:31', 'Vacant');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rid` int(11) NOT NULL,
  `userid` varchar(123) DEFAULT NULL,
  `houseid` varchar(123) DEFAULT NULL,
  `housename` varchar(100) DEFAULT NULL,
  `housetype` varchar(134) DEFAULT NULL,
  `cost` varchar(100) DEFAULT NULL,
  `location` varchar(132) DEFAULT NULL,
  `rdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(123) NOT NULL DEFAULT 'Being processed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rid`, `userid`, `houseid`, `housename`, `housetype`, `cost`, `location`, `rdate`, `status`) VALUES
(2, '8', '1', '', '', '', '', '2019-10-23 08:50:45', 'Being processed'),
(3, '8', '1', 'Greenpark', '', '', '', '2019-10-23 08:53:26', 'Being processed'),
(4, '8', '1', 'Greenpark', '', '', '', '2019-10-23 08:54:31', 'Being processed'),
(5, '8', '1', 'Greenpark', '', '', '', '2019-10-23 08:55:48', 'Being processed'),
(6, '8', '1', '', '', '1400', '', '2019-10-23 08:56:14', 'Being processed'),
(7, '8', '1', '', '', '1400', '', '2019-10-23 08:57:30', 'Being processed'),
(8, '8', '1', 'Green park', 'apartment', '1400', 'Machakos', '2019-10-23 08:58:14', 'Being processed'),
(9, '8', '1', 'Green park', 'apartment', '1400', 'Machakos', '2019-10-23 09:00:19', 'Being processed'),
(10, '8', '1', 'Green park', 'apartment', '1400', 'Machakos', '2019-10-23 09:26:16', 'Being processed'),
(11, '8', '1', 'Green park', 'apartment', '1400', 'Machakos', '2019-10-23 09:52:18', 'Being processed'),
(12, '8', '1', 'Green park', 'apartment', '1400', 'Machakos', '2019-10-23 10:27:04', 'Being processed'),
(13, '8', '1', 'Green park', 'apartment', '1400', 'Machakos', '2019-10-23 10:27:18', 'Being processed'),
(14, '8', '5', 'Old farm', 'Town house', '500', 'Makueni', '2019-10-23 14:41:24', 'Approved'),
(15, '8', '2', 'Ross hood', 'Villa', '2.1', 'Machakos', '2019-10-25 13:40:41', 'approved'),
(16, '8', '6', 'Unite squad', 'Apartment', '123', 'Nairobi', '2019-10-31 10:46:23', 'Being processed'),
(17, '11', '7', 'CLixx', '', 'ksh 10m', 'Machakos', '2019-11-19 11:43:17', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(123) DEFAULT NULL,
  `email` varchar(123) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `email`, `password`) VALUES
(0, 'admin', 'sysadmin@liteerp.org', 'a69681bcf334ae130217fea4505fd3c994f5683f'),
(3, 'Demo', 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
