-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2014 at 01:14 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pollsysdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(16) NOT NULL,
  `password` varchar(41) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '1234'),
('admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `counter_idn`
--

CREATE TABLE IF NOT EXISTS `counter_idn` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `used_for` varchar(3) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `counter_idn`
--

INSERT INTO `counter_idn` (`cid`, `used_for`) VALUES
(1, 'yes'),
(2, 'no'),
(3, 'no'),
(4, 'yes'),
(5, 'yes'),
(6, 'yes'),
(7, 'yes'),
(8, 'yes'),
(9, 'yes'),
(10, 'yes'),
(11, 'yes'),
(12, 'yes'),
(13, 'yes'),
(14, 'yes'),
(15, 'yes'),
(16, 'yes'),
(17, 'yes'),
(18, 'no'),
(19, 'yes'),
(20, 'yes'),
(21, 'yes'),
(22, 'yes'),
(23, 'no'),
(24, 'yes'),
(25, 'yes'),
(26, 'no'),
(27, 'yes'),
(28, 'yes'),
(29, 'yes'),
(30, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `count_in_counter`
--

CREATE TABLE IF NOT EXISTS `count_in_counter` (
  `countvote` int(11) NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `counting_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`counting_id`),
  KEY `cid` (`cid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `count_in_counter`
--

INSERT INTO `count_in_counter` (`countvote`, `pid`, `cid`, `counting_id`) VALUES
(3, 7, 1, 30),
(4, 7, 2, 31),
(0, 7, 16, 45),
(7, 7, 17, 48),
(0, 7, 18, 49),
(0, 7, 20, 50),
(3, 7, 23, 53),
(1, 7, 24, 54),
(10, 7, 25, 62),
(10, 7, 26, 63),
(13, 7, 28, 72),
(26, 6, 30, 84);

-- --------------------------------------------------------

--
-- Table structure for table `poll_duration`
--

CREATE TABLE IF NOT EXISTS `poll_duration` (
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `pid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll_list`
--

CREATE TABLE IF NOT EXISTS `poll_list` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `creation_time` datetime NOT NULL,
  `validity` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `poll_list`
--

INSERT INTO `poll_list` (`pid`, `description`, `creation_time`, `validity`) VALUES
(6, 'Are you human?', '2014-12-20 01:52:45', 1),
(7, 'Are you a developer?', '2014-12-20 01:53:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `testing_nid`
--

CREATE TABLE IF NOT EXISTS `testing_nid` (
  `nid` bigint(13) NOT NULL,
  `name` varchar(16) NOT NULL,
  `district` varchar(16) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing_nid`
--

INSERT INTO `testing_nid` (`nid`, `name`, `district`, `age`) VALUES
(987654321, 'abc', 'dhaka', 21),
(1234567890, 'anik', 'sylet', 20),
(1234567890123, 'Nowaz', 'Bhola', 28),
(2222222222222, 'Mouse', 'sylet', 20),
(5555555555555, 'anik', 'sylet', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `nid` bigint(13) unsigned NOT NULL,
  `vote_status` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`nid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nid`, `vote_status`, `pid`) VALUES
(123, 4, 6),
(12345, 1, 6),
(122222, 1, 6),
(786768687, 1, 6),
(987654321, 3, 6),
(1234567890, 1, 7),
(123456789012, 3, 7),
(222222222222, 2, 6),
(1234567890123, 46, 7),
(2222222222222, 1, 7);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `count_in_counter`
--
ALTER TABLE `count_in_counter`
  ADD CONSTRAINT `count_in_counter_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `counter_idn` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `count_in_counter_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `poll_list` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `poll_duration`
--
ALTER TABLE `poll_duration`
  ADD CONSTRAINT `poll_duration_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `poll_list` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `poll_list` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
