-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2011 at 06:01 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adres_development`
--

-- --------------------------------------------------------

--
-- Table structure for table `type_encrypt`
--

CREATE TABLE IF NOT EXISTS `type_encrypt` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(512) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `contact_id` (`contact_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_encrypt`
--

INSERT INTO `type_encrypt` (`field_id`, `contact_id`, `data`) VALUES
(29, 67, 'gUgp7dSDTHm7tuNBMOFIcA=='),
(29, 68, 'yZf3x1qZUlIwdmyQPq7xXg==');

-- --------------------------------------------------------

--
-- Table structure for table `type_encrypt_options`
--

CREATE TABLE IF NOT EXISTS `type_encrypt_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `hash` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `encrypt_contact_type_fkey` (`contact_type_id`),
  UNIQUE KEY `encrypt_field_fkey` (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `type_encrypt_options`
--

INSERT INTO `type_encrypt_options` (`id`, `contact_type_id`, `field_id`, `hash`) VALUES
(1, 12, 29, 'hello test');
