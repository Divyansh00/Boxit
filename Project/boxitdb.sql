-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 07:45 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boxitdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `name` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `islandlocked` tinyint(1) NOT NULL,
  `xcoord` decimal(5,1) NOT NULL,
  `ycoord` decimal(5,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`name`, `country`, `islandlocked`, `xcoord`, `ycoord`) VALUES
('Anchorage', 'Alaska', 0, '168.5', '217.0'),
('Bangkok', 'Thailand', 0, '1014.5', '441.5'),
('Beijing', 'China', 1, '1079.5', '329.5'),
('Berlin', 'Germany', 1, '710.5', '281.5'),
('Bogota', 'Colombia', 0, '417.5', '472.5'),
('Buenos', 'Spain', 0, '472.5', '617.0'),
('Cairo', 'Egypt', 1, '778.0', '384.5'),
('Calcutta', 'India', 0, '975.5', '416.5'),
('Cape', 'South Africa', 0, '736.0', '609.5'),
('Casablanca', 'Morocco', 0, '640.0', '379.5'),
('Chicago', 'USA', 1, '370.0', '333.5'),
('Churchill', 'Canada', 1, '353.5', '239.5'),
('Delhi', 'India', 1, '936.0', '381.5'),
('Durban', 'South Africa', 0, '780.5', '593.0'),
('Guangzhou', 'China', 0, '1061.0', '410.0'),
('Istanbul', 'Turkey', 1, '772.0', '344.0'),
('Jakarta', 'Indonesia', 0, '1043.5', '517.5'),
('Karachi', 'Pakistan', 0, '901.0', '399.0'),
('Lagos', 'Nigeria', 0, '688.0', '470.0'),
('Lima', 'Peru', 0, '409.0', '529.5'),
('London', 'England', 0, '665.0', '280.5'),
('Los', 'USA', 0, '262.0', '363.5'),
('Mexico', 'Mexico', 0, '334.5', '422.5'),
('Moscow', 'Russia', 1, '803.5', '261.5'),
('Mumbai', 'India', 0, '923.5', '422.0'),
('New', 'USA', 0, '421.0', '341.5'),
('Paris', 'France', 1, '676.5', '306.0'),
('Rio', 'Brazil', 0, '533.5', '561.0'),
('Riyadh', 'Saudi Arabia', 1, '829.0', '406.0'),
('Rome', 'Italy', 1, '721.0', '335.5'),
('Sao', 'Brazil', 0, '522.0', '574.5'),
('Seoul', 'South Korea', 0, '1112.0', '357.5'),
('Shanghai', 'China', 0, '1086.0', '386.5'),
('Singapore', 'Singapore', 0, '1027.5', '484.0'),
('Sydney', 'New South Wales', 0, '1179.5', '617.5'),
('Tokyo', 'Japan', 0, '1144.0', '363.5'),
('Toronto', 'Canada', 1, '407.5', '317.5');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('abcd', 'abcd'),
('root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `orderaddr`
--

CREATE TABLE `orderaddr` (
  `orderid` varchar(20) NOT NULL,
  `fromname` varchar(30) NOT NULL,
  `frommobno` int(10) NOT NULL,
  `fromemail` varchar(50) NOT NULL,
  `fromaddr` varchar(100) NOT NULL,
  `fromlandmark` varchar(30) NOT NULL,
  `fromcity` varchar(30) NOT NULL,
  `frompincode` int(10) NOT NULL,
  `toname` varchar(30) NOT NULL,
  `tomobno` int(10) NOT NULL,
  `toemail` varchar(50) NOT NULL,
  `toaddr` varchar(100) NOT NULL,
  `tolandmark` varchar(30) NOT NULL,
  `tocity` varchar(30) NOT NULL,
  `topincode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderaddr`
--

INSERT INTO `orderaddr` (`orderid`, `fromname`, `frommobno`, `fromemail`, `fromaddr`, `fromlandmark`, `fromcity`, `frompincode`, `toname`, `tomobno`, `toemail`, `toaddr`, `tolandmark`, `tocity`, `topincode`) VALUES
('1', 'Kamles', 82643562, 'kamles', 'kamiresi', 'kamles', 'Anchorage', 326136, 'Bhai', 63896216, 'bjhai', 'bhao', 'bhaibhai', 'Berlin', 326252);

-- --------------------------------------------------------

--
-- Table structure for table `ordertb`
--

CREATE TABLE `ordertb` (
  `orderid` varchar(20) NOT NULL,
  `ordertime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `custname` varchar(20) NOT NULL,
  `pickupdt` datetime NOT NULL,
  `content` varchar(30) NOT NULL,
  `weight` int(3) NOT NULL,
  `quantity` int(2) NOT NULL,
  `method` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertb`
--

INSERT INTO `ordertb` (`orderid`, `ordertime`, `custname`, `pickupdt`, `content`, `weight`, `quantity`, `method`) VALUES
('1', '2017-10-30 18:30:47', 'root', '2017-11-01 00:06:00', 'comi', 1, 2, 'air');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobno` int(10) NOT NULL,
  `paddr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `email`, `mobno`, `paddr`) VALUES
('abcd', 'abcd', 'abcd@example.com', 123456789, 'localhost2'),
('root', 'root', 'admin@example.com', 123456789, 'localhost');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `orderaddr`
--
ALTER TABLE `orderaddr`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `fromcity` (`fromcity`),
  ADD KEY `tocity` (`tocity`);

--
-- Indexes for table `ordertb`
--
ALTER TABLE `ordertb`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `custname` (`custname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `LOGIN_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `orderaddr`
--
ALTER TABLE `orderaddr`
  ADD CONSTRAINT `ORDERADDR_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `ordertb` (`orderid`),
  ADD CONSTRAINT `ORDERADDR_ibfk_2` FOREIGN KEY (`fromcity`) REFERENCES `city` (`name`),
  ADD CONSTRAINT `ORDERADDR_ibfk_3` FOREIGN KEY (`tocity`) REFERENCES `city` (`name`);

--
-- Constraints for table `ordertb`
--
ALTER TABLE `ordertb`
  ADD CONSTRAINT `ORDERTB_ibfk_1` FOREIGN KEY (`custname`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
