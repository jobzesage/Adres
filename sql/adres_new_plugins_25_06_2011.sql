-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2011 at 05:00 AM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

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
(12, 12, 'asdfasd'),
(29, 61, '');

-- --------------------------------------------------------

--
-- Table structure for table `type_encrypt_options`
--

CREATE TABLE IF NOT EXISTS `type_encrypt_options` (
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `hash` varchar(512) NOT NULL,
  UNIQUE KEY `encrypt_contact_type_fkey` (`contact_type_id`),
  UNIQUE KEY `encrypt_field_fkey` (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_encrypt_options`
--


-- --------------------------------------------------------

--
-- Table structure for table `type_phone`
--

CREATE TABLE IF NOT EXISTS `type_phone` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_phone`
--


-- --------------------------------------------------------

--
-- Table structure for table `type_phone_options`
--

CREATE TABLE IF NOT EXISTS `type_phone_options` (
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `rules` varchar(512) NOT NULL,
  UNIQUE KEY `fk_phone_field_id` (`field_id`),
  KEY `fk_phone_contact_typeid` (`contact_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_phone_options`
--


-- --------------------------------------------------------

--
-- Table structure for table `type_string_ellipses`
--

CREATE TABLE IF NOT EXISTS `type_string_ellipses` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` varchar(512) NOT NULL,
  PRIMARY KEY (`contact_id`,`field_id`),
  KEY `fk_types_string_ellipses_contacts` (`contact_id`),
  KEY `fk_type_string_ellipses_fields` (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_string_ellipses`
--

INSERT INTO `type_string_ellipses` (`contact_id`, `field_id`, `data`) VALUES
(23, 15, 'thiestd fasd asd fasdf ');
