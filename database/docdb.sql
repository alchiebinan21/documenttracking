-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2016 at 01:25 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `docdb`
--
CREATE DATABASE IF NOT EXISTS `docdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `docdb`;

-- --------------------------------------------------------

--
-- Table structure for table `e_doc`
--

CREATE TABLE IF NOT EXISTS `e_doc` (
  `ed_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `holder` varchar(255) NOT NULL,
  `pdf` longblob NOT NULL,
  `date` date NOT NULL,
  `qrcode` mediumblob NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `source_file` varchar(255) NOT NULL,
  PRIMARY KEY (`ed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flow`
--

CREATE TABLE IF NOT EXISTS `flow` (
  `flowid` int(50) NOT NULL AUTO_INCREMENT,
  `creatorid` int(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`flowid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flowdetails`
--

CREATE TABLE IF NOT EXISTS `flowdetails` (
  `flowdetailsid` int(11) NOT NULL AUTO_INCREMENT,
  `flowid` int(11) NOT NULL,
  `sendto` int(11) NOT NULL,
  `countpos` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  PRIMARY KEY (`flowdetailsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `historyid` int(250) NOT NULL AUTO_INCREMENT,
  `flow` int(11) NOT NULL,
  `sender` int(250) NOT NULL,
  `pd_id` int(250) DEFAULT NULL,
  `ed_id` int(255) DEFAULT NULL,
  `comment` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `sendto` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `msg_id` int(255) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `recepient` varchar(255) NOT NULL,
  `readmsg` varchar(255) NOT NULL,
  `physical` tinyint(1) NOT NULL,
  `electronic` tinyint(1) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p_doc`
--

CREATE TABLE IF NOT EXISTS `p_doc` (
  `pd_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `holder` varchar(250) NOT NULL,
  `image` mediumblob NOT NULL,
  `qrcode` mediumblob NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `flow` int(255) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `received` tinyint(1) NOT NULL,
  `sent` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `sento` varchar(255) NOT NULL,
  `flowsent` tinyint(1) NOT NULL DEFAULT '0',
  `source_file` varchar(255) NOT NULL,
  PRIMARY KEY (`pd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sharedocs`
--

CREATE TABLE IF NOT EXISTS `sharedocs` (
  `shdoc_id` int(255) NOT NULL AUTO_INCREMENT,
  `ed_id` varchar(255) NOT NULL,
  `sharedmem` varchar(255) NOT NULL,
  `receive_edoc` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`shdoc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `position`, `department`) VALUES
(1, 'Shri', 'reyes', 'admin', 'admin', 'admin@yahoo.com', 'developer', 'HR'),
(2, 'alchie', 'binan', 'albinan', 'poporing', 'alchiebinan21@gmail.com', 'Treasurer', 'HR'),
(3, 'Hans', 'Montecalvo', 'hans', 'hans', 'hans@gmail.com', 'Secretary', 'CS'),
(4, 'nishee', 'yap', 'nish', 'nish', 'nish@yahoo.com', 'SAP Support', 'HR'),
(5, 'Kevin', 'Mondragon', 'kevin', '123456', 'kevin@yahoo.com', 'HR', 'HR'),
(6, 'Shri Angelo ', 'Reyes', 'shri', 'shri', 'shri@yahoo.com', 'Support', 'HR'),
(7, 'Secretary', 'CS', 'sec', 'sec', 'sec@yahoo.com', 'Secretary', 'CS'),
(8, 'Secretary', 'HR', 'sechr', 'sechr', 'sechr@yahoo.com', 'Secretary', 'HR'),
(9, 'Secretary', 'VP', 'secvp', 'secvp', 'secvp@yahoo.com', 'Secretary', 'VP');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
