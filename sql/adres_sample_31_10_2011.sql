-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2011 at 01:12 PM
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
-- Table structure for table `affiliations`
--

CREATE TABLE IF NOT EXISTS `affiliations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_father_id` int(11) NOT NULL,
  `contact_type_child_id` int(11) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `child_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`id`, `contact_type_father_id`, `contact_type_child_id`, `father_name`, `child_name`, `created`, `modified`) VALUES
(18, 5, 12, 'is boss of ', 'is empoyee of', '2011-08-25 20:04:17', 1314364377);

-- --------------------------------------------------------

--
-- Table structure for table `affiliations_contacts`
--

CREATE TABLE IF NOT EXISTS `affiliations_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliation_id` int(11) NOT NULL,
  `contact_father_id` int(11) NOT NULL,
  `contact_child_id` int(11) NOT NULL,
  `after_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`contact_child_id`,`contact_father_id`,`affiliation_id`),
  KEY `fk_affiliations_contacts_contacts_father` (`contact_father_id`),
  KEY `fk_affiliations_contacts_affiliations` (`affiliation_id`),
  KEY `fk_affiliations_contacts_contacts_child` (`contact_child_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `affiliations_contacts`
--

INSERT INTO `affiliations_contacts` (`id`, `affiliation_id`, `contact_father_id`, `contact_child_id`, `after_id`) VALUES
(1, 18, 5, 71, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `trash_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contacts_contact_types` (`contact_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_type_id`, `trash_id`) VALUES
(1, 5, 0),
(2, 5, 3),
(3, 5, 0),
(4, 5, 0),
(5, 5, 0),
(6, 5, 0),
(7, 5, 0),
(8, 5, 0),
(9, 5, 0),
(10, 5, 0),
(11, 5, 0),
(12, 5, 0),
(13, 5, 0),
(14, 5, 0),
(15, 5, 0),
(16, 5, 0),
(17, 5, 0),
(18, 5, 0),
(19, 5, 0),
(20, 5, 0),
(21, 5, 0),
(22, 11, 0),
(23, 8, 0),
(24, 11, 0),
(25, 11, 0),
(26, 11, 0),
(27, 5, 0),
(28, 5, 0),
(29, 5, 0),
(30, 5, 0),
(31, 5, 0),
(32, 5, 0),
(33, 5, 0),
(34, 5, 0),
(35, 5, 0),
(36, 5, 0),
(37, 5, 0),
(38, 5, 0),
(39, 5, 0),
(40, 15, 0),
(41, 5, 0),
(42, 0, 0),
(43, 0, 0),
(44, 0, 0),
(45, 0, 0),
(46, 5, 0),
(47, 5, 0),
(48, 5, 0),
(49, 5, 0),
(50, 5, 0),
(51, 5, 0),
(52, 5, 0),
(53, 5, 0),
(54, 11, 0),
(55, 11, 0),
(56, 5, 0),
(57, 5, 0),
(58, 5, 0),
(59, 8, 0),
(60, 8, 0),
(67, 12, 127),
(68, 12, 126),
(69, 11, 0),
(70, 13, 0),
(71, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_groups`
--

CREATE TABLE IF NOT EXISTS `contacts_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`group_id`,`contact_id`),
  KEY `fk_contacts_groups_contacts` (`contact_id`),
  KEY `fk_contacts_groups_groups` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `contacts_groups`
--

INSERT INTO `contacts_groups` (`id`, `contact_id`, `group_id`) VALUES
(42, 1, 2),
(44, 1, 15),
(40, 2, 2),
(46, 2, 4),
(52, 2, 9),
(30, 3, 3),
(43, 3, 2),
(47, 3, 4),
(49, 5, 8),
(48, 9, 4),
(50, 12, 8),
(51, 13, 8),
(41, 71, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contact_types`
--

CREATE TABLE IF NOT EXISTS `contact_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `contact_counter` int(11) unsigned NOT NULL,
  `implementation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_types_implementations` (`implementation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `contact_counter`, `implementation_id`) VALUES
(5, 'People', 2, 4),
(8, 'Kids', 5, 4),
(11, 'Company', 7, 4),
(12, 'BTH', 5, 4),
(13, 'dates', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `field_type_class_name` varchar(45) NOT NULL,
  `is_descriptive` tinyint(1) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_fields_contact_types` (`contact_type_id`),
  KEY `fk_fields_field_types` (`field_type_class_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `contact_type_id`, `order`, `field_type_class_name`, `is_descriptive`, `required`) VALUES
(3, 'First Name', 5, 5, 'TypeString', 1, 1),
(4, 'Last Name', 5, 3, 'TypeString', 1, 1),
(5, 'Age2', 5, 4, 'TypeInteger', 0, 0),
(6, 'sex', 5, 4, 'TypeString', 0, 1),
(9, 'name', 8, 2, 'TypeString', 1, 1),
(12, 'created_at', 5, 10, 'TypeDate', 0, 1),
(13, 'parent name', 8, 12, 'TypeString', 1, 1),
(15, 'Full Name', 8, 1, 'TypeStringEllipses', 1, 1),
(19, 'Instruments', 5, 1, 'TypeSelect', 0, 0),
(20, 'Test', 11, 1, 'TypeSelect', 0, 1),
(21, 'PPL', 11, 2, 'TypeSelect', 0, 1),
(22, 'birthday', 5, 16, 'TypeBirthdate', 0, 0),
(23, 'Email Adress', 11, 1, 'TypeEmail', 1, 0),
(24, 'mbstu', 8, 1, 'TypeBoolean', 0, 1),
(25, 'large text', 8, 66, 'TypeText', 1, 0),
(26, 'name', 12, 1, 'TypeString', 1, 1),
(27, 'email', 12, 2, 'TypeEmail', 1, 1),
(28, 'Mobile', 12, 1, 'TypePhone', 0, 1),
(29, 'Secret', 12, 3, 'TypeEncrypt', 0, 0),
(30, 'ages', 13, 1, 'TypeBirthdate', 0, 0),
(31, 'test', 13, 12, 'TypeEncrypt', 0, 0),
(32, 'Chakoo', 12, 111, 'TypeEncrypt', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `field_types`
--

CREATE TABLE IF NOT EXISTS `field_types` (
  `class_name` varchar(45) NOT NULL,
  `nice_name` varchar(45) NOT NULL,
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_types`
--

INSERT INTO `field_types` (`class_name`, `nice_name`) VALUES
('TypeBirthdate', 'Birthdate'),
('TypeBoolean', 'True/false'),
('TypeDate', 'Date'),
('TypeEmail', 'Email'),
('TypeEncrypt', 'Encryptor'),
('TypeInteger', 'integer'),
('TypePhone', 'phone'),
('TypeSelect', 'Select'),
('TypeString', 'text'),
('TypeStringEllipses', 'EllipsesString'),
('TypeText', 'TextArea');

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE IF NOT EXISTS `filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `criteria` mediumtext NOT NULL,
  `keyword` varchar(512) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_filters_contact_types` (`contact_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `filters`
--


-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `beforeHtml` longtext NOT NULL,
  `afterHtml` longtext NOT NULL,
  `admin_approval` tinyint(1) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forms`
--


-- --------------------------------------------------------

--
-- Table structure for table `forms_fields`
--

CREATE TABLE IF NOT EXISTS `forms_fields` (
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `default_value` varchar(45) NOT NULL,
  `is_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rght` int(10) unsigned NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_parent_fk` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `parent_id`, `lft`, `rght`, `contact_type_id`, `created`, `modified`) VALUES
(1, 'My Categories', 0, 1, 32, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Fun', 1, 2, 15, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Sport', 2, 3, 8, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Surfing', 3, 4, 5, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Extreme knitting', 3, 6, 7, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Friends', 2, 9, 14, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Gerald', 6, 10, 11, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Gwendolyn', 6, 12, 13, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Work', 1, 16, 29, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Reports', 9, 17, 22, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Annual', 10, 18, 19, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Trips', 9, 23, 28, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'National', 13, 24, 25, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'test', 1, 30, 31, 5, '2010-08-06 11:00:14', '2010-08-06 11:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `hidden_fields`
--

CREATE TABLE IF NOT EXISTS `hidden_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hidden_fields_contact_types` (`contact_type_id`),
  KEY `fk_hidden_fields_fields` (`field_id`),
  KEY `fk_hidden_fields_users` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hidden_fields`
--

INSERT INTO `hidden_fields` (`id`, `user_id`, `contact_type_id`, `field_id`) VALUES
(3, 1, 8, 21),
(4, 1, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `implementations`
--

CREATE TABLE IF NOT EXISTS `implementations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `implementations`
--

INSERT INTO `implementations` (`id`, `name`) VALUES
(4, 'Jesus Church - Database'),
(9, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `log_dt` datetime NOT NULL,
  `description` mediumtext NOT NULL,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`contact_id`),
  KEY `fk_logs_contacts` (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `data`, `log_dt`, `description`, `contact_id`, `user_id`) VALUES
(1, '', '2011-10-10 02:48:21', 'sdfasd fsd a', 1, 1),
(2, '', '2011-10-10 02:49:30', 'sdfasdf', 1, 1),
(3, '', '2011-10-10 02:50:03', 'fsdfas', 2, 1),
(4, '', '2011-10-10 02:52:48', 'fasdfa', 1, 1),
(5, '', '2011-10-10 02:53:24', 'fasdfa', 1, 1),
(6, '', '2011-10-10 02:54:28', 'fasdf asd fsa', 1, 1),
(7, '3,,Hï¿½kon,29,male,Jonathan,30.06.2010,03.08.2009', '2011-10-10 02:55:13', 'dfasd fsa dfsa ', 3, 1),
(8, '', '2011-10-10 02:56:02', 'fsdfs d', 3, 1),
(9, '3, , Hï¿½kon, 29, male, Jonathan, 30.06.2010, 03.08.2009', '2011-10-12 04:14:07', 'ok testing', 3, 1),
(10, '', '2011-10-12 04:19:01', 'Changed <strong>Secret</strong> from <i>M6jRmoGFIrlICGqa+jBgbQ==</i> to <i>Dp2wzTUdmj/gSDw4JmfRkw==</i>', 71, 1),
(11, '', '2011-10-12 04:19:01', 'Changed <strong>Chakoo</strong> from <i>twvuyNxPAw3cYHrd7pkTvA==</i> to <i>ouBcxZ4f6cWpi6hLge/187Ufqir5/zprr7Qhp8UYSkI=</i>', 71, 1),
(12, '', '2011-10-12 04:51:51', 'khkjh', 3, 1),
(13, '', '2011-10-20 06:08:06', 'hello mate !!', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sceret_value` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test` char(0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tokens`
--


-- --------------------------------------------------------

--
-- Table structure for table `trashes`
--

CREATE TABLE IF NOT EXISTS `trashes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `contact_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`contact_id`),
  KEY `fk_trashes_contacts` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trashes`
--


-- --------------------------------------------------------

--
-- Table structure for table `type_boolean`
--

CREATE TABLE IF NOT EXISTS `type_boolean` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`,`field_id`),
  UNIQUE KEY `boolean_fk_unique` (`field_id`,`contact_id`),
  KEY `fk_type_boolean_contacts` (`contact_id`),
  KEY `fk_type_boolean_fields` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_boolean`
--

INSERT INTO `type_boolean` (`field_id`, `contact_id`, `data`) VALUES
(14, 22, 0),
(24, 23, 0),
(14, 24, 1),
(14, 25, 1),
(14, 26, 0),
(24, 59, 1),
(24, 60, 1),
(24, 62, 1),
(24, 63, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_date`
--

CREATE TABLE IF NOT EXISTS `type_date` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`contact_id`,`field_id`),
  KEY `fk_type_date_contacts` (`contact_id`),
  KEY `fk_type_date_fields` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_date`
--

INSERT INTO `type_date` (`field_id`, `contact_id`, `data`) VALUES
(12, 1, '2010-07-24 00:00:00'),
(22, 1, '1983-10-08 00:00:00'),
(12, 2, '2010-11-17 00:00:00'),
(22, 2, '2009-10-17 00:00:00'),
(12, 3, '2010-06-30 00:00:00'),
(22, 3, '2009-08-03 00:00:00'),
(12, 4, '2010-07-02 00:00:00'),
(22, 4, '0000-00-00 00:00:00'),
(12, 5, '2010-06-16 00:00:00'),
(22, 5, '0000-00-00 00:00:00'),
(12, 6, '2010-03-11 00:00:00'),
(12, 7, '2010-06-09 00:00:00'),
(12, 8, '2010-06-25 00:00:00'),
(12, 9, '2010-06-23 00:00:00'),
(12, 10, '2010-08-06 00:00:00'),
(12, 11, '2010-06-30 00:00:00'),
(12, 12, '2010-06-15 00:00:00'),
(12, 13, '2010-07-30 00:00:00'),
(22, 13, '0000-00-00 00:00:00'),
(12, 15, '2010-09-24 00:00:00'),
(12, 27, '2010-07-30 00:00:00'),
(12, 30, '2010-07-31 00:00:00'),
(12, 31, '2010-07-07 00:00:00'),
(12, 32, '2010-07-27 00:00:00'),
(12, 33, '2010-07-24 00:00:00'),
(12, 34, '2010-07-31 00:00:00'),
(12, 35, '2010-07-31 00:00:00'),
(12, 37, '2010-07-31 00:00:00'),
(12, 39, '2010-07-01 00:00:00'),
(12, 41, '2010-07-22 00:00:00'),
(30, 70, '1985-11-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `type_date_options`
--

CREATE TABLE IF NOT EXISTS `type_date_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `format` varchar(255) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_type_date_options` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type_date_options`
--

INSERT INTO `type_date_options` (`id`, `contact_type_id`, `field_id`, `format`, `selected`) VALUES
(1, 5, 12, 'ddmmyyyy', 1),
(3, 5, 22, 'ddmmyyyy', 0),
(4, 13, 30, 'ddmmyyyy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_email`
--

CREATE TABLE IF NOT EXISTS `type_email` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(50) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_email_contacts` (`contact_id`),
  KEY `fk_type_email_fields` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_email`
--

INSERT INTO `type_email` (`field_id`, `contact_id`, `data`) VALUES
(23, 22, 'rajib@d32.com.bd'),
(23, 24, 'adib@d32.com.bd'),
(23, 25, 'jonathan@tbbmi.no'),
(23, 26, 'utpol.quraishy@gmail.com'),
(23, 54, 'test@gmail.com'),
(23, 55, ''),
(23, 69, ''),
(27, 61, 'rajib@gmail.com'),
(27, 64, 'rajib@d32.com'),
(27, 65, 'dfasd@fasdsa.com'),
(27, 66, ''),
(27, 67, 'rajib@d32.com'),
(27, 68, 'rajib@d32.com'),
(27, 71, 'rajib@d32.com');

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
(29, 71, 'Dp2wzTUdmj/gSDw4JmfRkw=='),
(32, 71, 'ouBcxZ4f6cWpi6hLge/187Ufqir5/zprr7Qhp8UYSkI=');

-- --------------------------------------------------------

--
-- Table structure for table `type_encrypt_options`
--

CREATE TABLE IF NOT EXISTS `type_encrypt_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `hash` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `type_encrypt_options`
--

INSERT INTO `type_encrypt_options` (`id`, `contact_type_id`, `field_id`, `hash`) VALUES
(1, 12, 29, 'save'),
(2, 12, 32, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `type_integer`
--

CREATE TABLE IF NOT EXISTS `type_integer` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_integer_contacts` (`contact_id`),
  KEY `fk_type_integer_fields` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_integer`
--

INSERT INTO `type_integer` (`field_id`, `contact_id`, `data`) VALUES
(5, 1, 30),
(5, 2, 50),
(5, 3, 29),
(5, 4, 32),
(5, 5, 25),
(5, 6, 38),
(5, 7, 45),
(5, 8, 343),
(5, 9, 25),
(5, 10, 32),
(5, 11, 31),
(5, 12, 31),
(5, 13, 11),
(5, 14, NULL),
(5, 15, 98),
(5, 16, NULL),
(5, 17, NULL),
(5, 18, NULL),
(5, 19, NULL),
(5, 20, NULL),
(5, 21, NULL),
(5, 22, NULL),
(5, 27, 32),
(5, 28, NULL),
(5, 29, 343),
(5, 30, 2),
(5, 31, 343),
(5, 32, 9),
(5, 33, 9),
(5, 34, 90),
(5, 35, 9088),
(5, 36, NULL),
(5, 37, 90),
(5, 38, 9988),
(5, 39, 33),
(5, 41, NULL),
(5, 46, NULL),
(5, 47, NULL),
(5, 48, NULL),
(5, 49, NULL),
(5, 50, NULL),
(5, 51, NULL),
(5, 52, NULL),
(5, 53, NULL),
(5, 56, NULL),
(5, 57, NULL),
(5, 58, NULL);

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
-- Table structure for table `type_select`
--

CREATE TABLE IF NOT EXISTS `type_select` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_select_contacts` (`contact_id`),
  KEY `fk_type_select_fields` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_select`
--

INSERT INTO `type_select` (`contact_id`, `field_id`, `data`) VALUES
(1, 19, 13),
(2, 19, 14),
(3, 19, 0),
(4, 19, 0),
(5, 19, 0),
(8, 19, 0),
(13, 19, 0),
(21, 19, 0),
(56, 19, 0),
(57, 19, 0),
(58, 19, 0),
(22, 20, 27),
(24, 20, 18),
(69, 20, 0),
(22, 21, 20),
(24, 21, 28),
(69, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_select_options`
--

CREATE TABLE IF NOT EXISTS `type_select_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type_select_options_fields` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `type_select_options`
--

INSERT INTO `type_select_options` (`id`, `contact_type_id`, `field_id`, `value`) VALUES
(12, 5, 19, 'Guitar'),
(13, 5, 19, 'Keybord'),
(14, 5, 19, 'Cycles'),
(17, 11, 20, 'world'),
(18, 11, 20, 'check'),
(19, 11, 20, 'wooden'),
(20, 11, 21, 'Nacho'),
(21, 11, 21, 'libray'),
(27, 11, 20, 'testing'),
(28, 11, 21, ':)');

-- --------------------------------------------------------

--
-- Table structure for table `type_string`
--

CREATE TABLE IF NOT EXISTS `type_string` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(512) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_string_contacts` (`contact_id`),
  KEY `fk_type_string_fields` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_string`
--

INSERT INTO `type_string` (`field_id`, `contact_id`, `data`) VALUES
(3, 1, 'Rajib'),
(3, 2, 'John'),
(3, 3, 'Jonathan'),
(3, 4, 'Andy'),
(3, 5, 'Utpol'),
(3, 6, 'Andy '),
(3, 7, 'Hello'),
(3, 8, 'Test1'),
(3, 9, 'Scarlet'),
(3, 10, 'Jessica'),
(3, 11, 'Jessica'),
(3, 12, 'Frank'),
(3, 13, 'Rajib A'),
(3, 14, ''),
(3, 15, 'TT''T'),
(3, 16, ''),
(3, 17, ''),
(3, 18, ''),
(3, 19, ''),
(3, 20, ''),
(3, 21, ''),
(3, 22, ''),
(3, 27, 'Hello'),
(3, 28, ''),
(3, 29, 'erqwerqw'),
(3, 30, 'fsadfa'),
(3, 31, 'fasdf'),
(3, 32, 'hkjhk'),
(3, 33, 'koppi'),
(3, 34, 'wajkk'),
(3, 35, 'Hello'),
(3, 36, ''),
(3, 37, 'jgjhg'),
(3, 38, 'asa'),
(3, 39, 'asfasd'),
(3, 41, 'fdfasd'),
(3, 46, ''),
(3, 47, ''),
(3, 48, ''),
(3, 49, ''),
(3, 50, ''),
(3, 51, ''),
(3, 52, 'Jako'),
(3, 53, ''),
(3, 56, ''),
(3, 57, ''),
(3, 58, ''),
(3, 71, ''),
(4, 1, 'Ahmed'),
(4, 2, 'EE'),
(4, 3, 'Hï¿½kon'),
(4, 4, 'James'),
(4, 5, 'Quraishy'),
(4, 6, 'Timmons'),
(4, 7, 'World'),
(4, 8, 'test2'),
(4, 9, 'Johanson'),
(4, 10, 'Beil'),
(4, 11, 'Alba'),
(4, 12, 'Lamperd'),
(4, 13, 'sasdfas'),
(4, 14, ''),
(4, 15, 'Hello''s'),
(4, 16, ''),
(4, 17, ''),
(4, 18, ''),
(4, 19, ''),
(4, 20, ''),
(4, 21, ''),
(4, 22, ''),
(4, 27, 'World'),
(4, 28, ''),
(4, 29, 'qwerwqerew'),
(4, 30, 'fsadfa'),
(4, 31, 'sdfs'),
(4, 32, 'uiouoi'),
(4, 33, 'gjhhgj'),
(4, 34, 'gjgh'),
(4, 35, 'dhdfd'),
(4, 36, ''),
(4, 37, 'dgfdg'),
(4, 38, 'adfa'),
(4, 39, 'dasdfsa'),
(4, 41, 'ffsdfa'),
(4, 46, ''),
(4, 47, ''),
(4, 48, ''),
(4, 49, ''),
(4, 50, ''),
(4, 51, ''),
(4, 52, 'Test'),
(4, 53, ''),
(4, 56, ''),
(4, 57, ''),
(4, 58, ''),
(4, 71, ''),
(6, 1, 'male'),
(6, 2, 'male'),
(6, 3, 'male'),
(6, 4, 'male'),
(6, 5, 'male'),
(6, 6, 'male'),
(6, 7, 'female'),
(6, 8, 'test'),
(6, 9, 'female'),
(6, 10, 'female'),
(6, 11, 'female'),
(6, 12, 'male'),
(6, 13, 'male'),
(6, 14, ''),
(6, 15, 'M'),
(6, 16, ''),
(6, 17, ''),
(6, 18, ''),
(6, 19, ''),
(6, 20, ''),
(6, 21, ''),
(6, 22, ''),
(6, 27, 'male'),
(6, 28, ''),
(6, 29, 'male'),
(6, 30, 'asdfas'),
(6, 31, 'madfs'),
(6, 32, 'kjhkj'),
(6, 33, 'ljkjlk'),
(6, 34, 'kjkj'),
(6, 35, 'hhkj'),
(6, 36, ''),
(6, 37, 'fhfh'),
(6, 38, 'ma'),
(6, 39, 'sfasdfas'),
(6, 41, 'dfasd'),
(6, 46, ''),
(6, 47, ''),
(6, 48, ''),
(6, 49, ''),
(6, 50, ''),
(6, 51, ''),
(6, 52, 'male'),
(6, 53, ''),
(6, 56, ''),
(6, 57, ''),
(6, 58, ''),
(9, 23, 'Bhowa'),
(9, 59, 'asdfa'),
(9, 60, 'hkhkhkj'),
(9, 62, 'sdf asd fasd fasd fsadf sda fsdf asd'),
(9, 63, 'sdf asd fasd fasd fsadf sda fsdf asd'),
(13, 23, 'as'),
(13, 59, 'asdfaff'),
(13, 60, 'jgkhkhkjh'),
(13, 62, 'asd fsadf asdf asdf asdf asdf asd fas'),
(13, 63, 'asd fsadf asdf asdf asdf asdf asd fas'),
(15, 23, 'asda'),
(15, 59, 'asdfa'),
(15, 60, 'kjklkj'),
(16, 40, '01212121'),
(26, 61, 'asf'),
(26, 64, 'rajib'),
(26, 65, 'helo'),
(26, 66, ''),
(26, 67, 'safasdfas'),
(26, 68, 'test'),
(26, 71, 'rajib'),
(28, 61, '0123345666'),
(28, 64, '1234577788'),
(28, 65, '12132434q'),
(28, 66, ''),
(28, 67, '1231412'),
(28, 68, '12345566'),
(28, 71, '12345566');

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
(23, 15, 'thiestd fasd '),
(62, 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `type_text`
--

CREATE TABLE IF NOT EXISTS `type_text` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_text_contacts` (`contact_id`),
  KEY `fk_field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_text`
--

INSERT INTO `type_text` (`contact_id`, `field_id`, `data`) VALUES
(23, 25, ''),
(60, 25, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32'),
(62, 25, 'asdf sdf asd fsadf asdf sdf asdfa sd sdaf sdf asdfas dfsdas asd'),
(63, 25, 'sdf sad fasd saf dfsa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `is_active`, `created`, `modified`) VALUES
(1, 'test', 'test', 'test', 'test@hotmail.com', 'cc55dbd6215384f6e2aa67e571b97fc555ad4d5a', 1, '2010-02-16 19:18:07', '2011-08-09 22:54:35'),
(3, 'Rajib', 'Ahmed', 'rajib', 'l.rajibahmed@gmail.com', '413eb47b96ca90c897dda9685f4d0374a7393c32', 1, '2010-06-15 13:59:43', '2010-06-15 13:59:43'),
(4, 'Jonathan', 'Bigler', 'mybigler', 'mybigler@gmail.com', '52340dec5d55864c9c63f0e5e57ecfbbd6d0b025', 1, '2010-07-07 01:54:24', '2010-07-07 01:54:24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliations_contacts`
--
ALTER TABLE `affiliations_contacts`
  ADD CONSTRAINT `fk_affiliations_contacts_affiliations` FOREIGN KEY (`affiliation_id`) REFERENCES `affiliations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_affiliations_contacts_contacts_child` FOREIGN KEY (`contact_child_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_affiliations_contacts_contacts_father` FOREIGN KEY (`contact_father_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
