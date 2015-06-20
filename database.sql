--
-- DYNAMO
-- Rambod Rahmani <rambodrahmani@yahoo.it>
--

-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2015 at 07:48 PM
-- Server version: 5.5.41
-- PHP Version: 5.4.36-0+deb7u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dynamo`
--

-- --------------------------------------------------------

--
-- Table structure for table `authenticated_devices`
--

CREATE TABLE IF NOT EXISTS `authenticated_devices` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_ip_address` varchar(255) NOT NULL,
  `device_mac_address` varchar(255) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_authentication_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `device_authentication_type` varchar(255) NOT NULL,
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `cached_records`
--

CREATE TABLE IF NOT EXISTS `cached_records` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `record_domain` LONGTEXT NOT NULL,
  `record_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `custom_records`
--

CREATE TABLE IF NOT EXISTS `custom_records` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `record_domain` LONGTEXT NOT NULL,
  `record_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
