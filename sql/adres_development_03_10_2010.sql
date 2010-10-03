-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2010 at 02:31 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adres_dev`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`id`, `contact_type_father_id`, `contact_type_child_id`, `father_name`, `child_name`, `created`, `modified`) VALUES
(1, 5, 5, 'is the father of', 'is the son of', '2010-02-26 13:08:55', 1267189735),
(3, 5, 11, 'is a boss of', 'is lead by', '2010-06-23 10:12:44', 1277287964),
(4, 5, 11, 'is a manager in', 'is managed by', '2010-06-23 10:13:30', 1277288010),
(5, 5, 11, 'is a employee of ', 'is employs', '2010-06-23 10:14:40', 1277288080);

-- --------------------------------------------------------

--
-- Table structure for table `affiliations_contacts`
--

CREATE TABLE IF NOT EXISTS `affiliations_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliation_id` int(10) unsigned NOT NULL,
  `contact_father_id` int(10) unsigned NOT NULL,
  `contact_child_id` int(10) unsigned NOT NULL,
  `after_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `affiliations_contacts`
--

INSERT INTO `affiliations_contacts` (`id`, `affiliation_id`, `contact_father_id`, `contact_child_id`, `after_id`) VALUES
(2, 5, 1, 7, 0),
(1, 1, 1, 3, 0),
(3, 1, 3, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `trash_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_type_id`, `trash_id`) VALUES
(1, 5, 1),
(2, 5, 0),
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
(45, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_groups`
--

CREATE TABLE IF NOT EXISTS `contacts_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `contacts_groups`
--

INSERT INTO `contacts_groups` (`id`, `contact_id`, `group_id`) VALUES
(40, 2, 2),
(41, 71, 2),
(30, 3, 3),
(42, 1, 2),
(43, 3, 2),
(44, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `contact_types`
--

CREATE TABLE IF NOT EXISTS `contact_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `contact_counter` int(11) unsigned NOT NULL,
  `implementation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `contact_counter`, `implementation_id`) VALUES
(5, 'People', 27, 4),
(8, 'Kids', 1, 4),
(11, 'Company', 4, 4);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
(14, 'Rubish', 11, 2, 'TypeBoolean', 1, 1),
(15, 'Full Name', 8, 1, 'TypeString', 1, 1),
(19, 'Instruments', 5, 1, 'TypeSelect', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `field_types`
--

CREATE TABLE IF NOT EXISTS `field_types` (
  `class_name` varchar(45) NOT NULL,
  `nice_name` varchar(45) NOT NULL,
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_types`
--

INSERT INTO `field_types` (`class_name`, `nice_name`) VALUES
('TypeString', 'text'),
('TypeInteger', 'integer'),
('TypeDate', 'Date'),
('TypeBoolean', 'True/false'),
('TypeSelect', 'Select');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `hidden_fields`
--

INSERT INTO `hidden_fields` (`id`, `user_id`, `contact_type_id`, `field_id`) VALUES
(3, 1, 8, 21);

-- --------------------------------------------------------

--
-- Table structure for table `implementations`
--

CREATE TABLE IF NOT EXISTS `implementations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
  `log_dt` datetime NOT NULL,
  `description` mediumtext NOT NULL,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_dt`, `description`, `contact_id`, `user_id`) VALUES
(1, '2010-10-01 04:15:31', 'hello world', 1, 1),
(2, '2010-10-01 04:16:06', 'Changed <strong>Last Name</strong> from <i>Doe</i> to <i>Doeee</i>', 2, 1),
(3, '2010-10-03 02:10:10', 'Changed <strong>Instruments</strong> from <i>1</i> to <i>2</i>', 2, 1),
(4, '2010-10-03 02:10:35', 'Changed <strong>Instruments</strong> from <i>0</i> to <i>4</i>', 3, 1);

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
  PRIMARY KEY (`id`)
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
  UNIQUE KEY `boolean_fk_unique` (`field_id`,`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_boolean`
--

INSERT INTO `type_boolean` (`field_id`, `contact_id`, `data`) VALUES
(14, 22, 0),
(14, 24, 1),
(14, 25, 1),
(14, 26, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_date`
--

CREATE TABLE IF NOT EXISTS `type_date` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  KEY `date_fk_field_id` (`field_id`),
  KEY `date_fk_contact_id` (`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_date`
--

INSERT INTO `type_date` (`field_id`, `contact_id`, `data`) VALUES
(12, 1, '2010-07-24 00:00:00'),
(12, 2, '2010-06-01 00:00:00'),
(12, 3, '2010-06-30 00:00:00'),
(12, 4, '2010-07-02 00:00:00'),
(12, 5, '2010-06-16 00:00:00'),
(12, 6, '2010-03-11 00:00:00'),
(12, 7, '2010-06-09 00:00:00'),
(12, 8, '2010-06-25 00:00:00'),
(12, 9, '2010-06-23 00:00:00'),
(12, 10, '2010-08-06 00:00:00'),
(12, 11, '2010-06-30 00:00:00'),
(12, 12, '2010-06-15 00:00:00'),
(12, 13, '2010-07-30 00:00:00'),
(12, 14, '0000-00-00 00:00:00'),
(12, 15, '2010-09-24 00:00:00'),
(12, 16, '0000-00-00 00:00:00'),
(12, 17, '0000-00-00 00:00:00'),
(12, 18, '0000-00-00 00:00:00'),
(12, 19, '0000-00-00 00:00:00'),
(12, 20, '0000-00-00 00:00:00'),
(12, 21, '0000-00-00 00:00:00'),
(12, 22, '0000-00-00 00:00:00'),
(12, 27, '2010-07-30 00:00:00'),
(12, 28, '0000-00-00 00:00:00'),
(12, 29, '0000-00-00 00:00:00'),
(12, 30, '2010-07-31 00:00:00'),
(12, 31, '2010-07-07 00:00:00'),
(12, 32, '2010-07-27 00:00:00'),
(12, 33, '2010-07-24 00:00:00'),
(12, 34, '2010-07-31 00:00:00'),
(12, 35, '2010-07-31 00:00:00'),
(12, 36, '0000-00-00 00:00:00'),
(12, 37, '2010-07-31 00:00:00'),
(12, 38, '0000-00-00 00:00:00'),
(12, 39, '2010-07-01 00:00:00'),
(12, 41, '2010-07-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `type_date_options`
--

CREATE TABLE IF NOT EXISTS `type_date_options` (
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `selected_option` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_date_options`
--


-- --------------------------------------------------------

--
-- Table structure for table `type_integer`
--

CREATE TABLE IF NOT EXISTS `type_integer` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_integer`
--

INSERT INTO `type_integer` (`field_id`, `contact_id`, `data`) VALUES
(5, 1, 26),
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
(5, 41, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_select`
--

CREATE TABLE IF NOT EXISTS `type_select` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_select`
--

INSERT INTO `type_select` (`contact_id`, `field_id`, `data`) VALUES
(2, 19, 2),
(3, 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `type_select_options`
--

CREATE TABLE IF NOT EXISTS `type_select_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `type_select_options`
--

INSERT INTO `type_select_options` (`id`, `contact_type_id`, `field_id`, `value`) VALUES
(1, 5, 19, 'Guitar'),
(2, 5, 19, 'Tabla'),
(4, 5, 19, 'hello world');

-- --------------------------------------------------------

--
-- Table structure for table `type_string`
--

CREATE TABLE IF NOT EXISTS `type_string` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(50) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_string`
--

INSERT INTO `type_string` (`field_id`, `contact_id`, `data`) VALUES
(3, 1, 'Rajib'),
(4, 1, 'Ahmed'),
(6, 1, 'male'),
(3, 2, 'John'),
(4, 2, 'Doeee'),
(6, 2, 'male'),
(3, 3, 'Jonathan'),
(4, 3, 'Bigler'),
(6, 3, 'male'),
(3, 4, 'Andy'),
(4, 4, 'James'),
(6, 4, 'male'),
(3, 5, 'Utpol'),
(4, 5, 'Quraishy'),
(6, 5, 'male'),
(3, 6, 'Andy '),
(4, 6, 'Timmons'),
(6, 6, 'male'),
(3, 7, 'Hello'),
(4, 7, 'World'),
(6, 7, 'female'),
(3, 8, 'Test1'),
(4, 8, 'test2'),
(6, 8, 'test'),
(3, 9, 'Scarlet'),
(4, 9, 'Johanson'),
(6, 9, 'female'),
(3, 10, 'Jessica'),
(4, 10, 'Beil'),
(6, 10, 'female'),
(3, 11, 'Jessica'),
(4, 11, 'Alba'),
(6, 11, 'female'),
(3, 12, 'Frank'),
(4, 12, 'Lamperd'),
(6, 12, 'male'),
(3, 13, 'Rajib A'),
(4, 13, 'sasdfas'),
(6, 13, 'male'),
(3, 14, ''),
(4, 14, ''),
(6, 14, ''),
(3, 15, 'TT''T'),
(4, 15, 'Hello''s'),
(6, 15, 'M'),
(3, 16, ''),
(4, 16, ''),
(6, 16, ''),
(3, 17, ''),
(4, 17, ''),
(6, 17, ''),
(3, 18, ''),
(4, 18, ''),
(6, 18, ''),
(3, 19, ''),
(4, 19, ''),
(6, 19, ''),
(3, 20, ''),
(4, 20, ''),
(6, 20, ''),
(3, 21, ''),
(4, 21, ''),
(6, 21, ''),
(3, 22, ''),
(4, 22, ''),
(6, 22, ''),
(9, 23, 'Bhowa'),
(13, 23, 'as'),
(15, 23, 'asda'),
(3, 27, 'Hello'),
(4, 27, 'World'),
(6, 27, 'male'),
(3, 28, ''),
(4, 28, ''),
(6, 28, ''),
(3, 29, 'erqwerqw'),
(4, 29, 'qwerwqerew'),
(6, 29, 'male'),
(3, 30, 'fsadfa'),
(4, 30, 'fsadfa'),
(6, 30, 'asdfas'),
(3, 31, 'fasdf'),
(4, 31, 'sdfs'),
(6, 31, 'madfs'),
(3, 32, 'hkjhk'),
(4, 32, 'uiouoi'),
(6, 32, 'kjhkj'),
(3, 33, 'koppi'),
(4, 33, 'gjhhgj'),
(6, 33, 'ljkjlk'),
(3, 34, 'wajkk'),
(4, 34, 'gjgh'),
(6, 34, 'kjkj'),
(3, 35, 'Hello'),
(4, 35, 'dhdfd'),
(6, 35, 'hhkj'),
(3, 36, ''),
(4, 36, ''),
(6, 36, ''),
(3, 37, 'jgjhg'),
(4, 37, 'dgfdg'),
(6, 37, 'fhfh'),
(3, 38, 'asa'),
(4, 38, 'adfa'),
(6, 38, 'ma'),
(3, 39, 'asfasd'),
(4, 39, 'dasdfsa'),
(6, 39, 'sfasdfas'),
(16, 40, '01212121'),
(4, 41, 'ffsdfa'),
(6, 41, 'dfasd'),
(3, 41, 'fdfasd');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `is_active`, `created`, `modified`) VALUES
(1, 'test', 'test', 'test', 'test@hotmail.com', 'c4a58768bbcec0a0c8e4abc84cc3e3c13d4bc1f8', 1, '2010-02-16 19:18:07', '2010-02-16 19:18:07'),
(3, 'Rajib', 'Ahmed', 'rajib', 'l.rajibahmed@gmail.com', '413eb47b96ca90c897dda9685f4d0374a7393c32', 1, '2010-06-15 13:59:43', '2010-06-15 13:59:43'),
(4, 'Jonathan', 'Bigler', 'mybigler', 'mybigler@gmail.com', '52340dec5d55864c9c63f0e5e57ecfbbd6d0b025', 1, '2010-07-07 01:54:24', '2010-07-07 01:54:24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
