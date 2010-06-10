-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2010 at 08:45 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`id`, `contact_type_father_id`, `contact_type_child_id`, `father_name`, `child_name`, `created`, `modified`) VALUES
(1, 5, 5, 'is the father of', 'is the son of', '2010-02-26 13:08:55', 1267189735);

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
(2, 1, 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `trash_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_type_id`, `trash_id`, `created`, `modified`) VALUES
(2, 5, 0, '2010-02-19 20:14:17', '2010-04-09 07:34:06'),
(3, 8, 0, '2010-03-18 12:30:00', '2010-04-09 07:16:54'),
(4, 0, 0, '2010-04-06 17:46:16', '2010-04-06 17:46:16'),
(5, 5, 0, '2010-04-06 17:52:01', '2010-04-16 11:01:04'),
(19, 9, 0, '2010-04-15 16:22:03', '2010-04-15 16:22:03'),
(20, 9, 0, '2010-04-15 16:22:37', '2010-04-15 16:22:37'),
(21, 5, 0, '2010-04-18 21:14:26', '2010-04-18 21:14:26'),
(38, 5, 0, '2010-06-10 20:24:07', '2010-06-10 20:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_groups`
--

CREATE TABLE IF NOT EXISTS `contacts_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `contacts_groups`
--

INSERT INTO `contacts_groups` (`id`, `contact_id`, `group_id`) VALUES
(11, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contact_types`
--

CREATE TABLE IF NOT EXISTS `contact_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `implementation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `implementation_id`) VALUES
(5, 'People', 4),
(8, 'Kids', 4);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `contact_type_id`, `order`, `field_type_class_name`, `is_descriptive`) VALUES
(3, 'First Name', 5, 5, 'TypeString', 1),
(4, 'Last Name', 5, 3, 'TypeString', 1),
(5, 'Age', 5, 4, 'TypeInteger', 1),
(6, 'sex', 5, 4, 'TypeString', 1),
(9, 'name', 8, 2, 'TypeString', 1),
(10, 'Phone', 9, 1, 'TypeString', 1),
(11, 'Age', 9, 2, 'TypeString', 1);

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
('TypeInteger', 'integer');

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE IF NOT EXISTS `filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `criteria` varchar(45) NOT NULL,
  `keyword` mediumtext NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `name` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `parent_id`, `contact_type_id`, `created`, `modified`) VALUES
(1, 'testG3', 0, 5, '2010-02-19 20:18:22', '2010-02-19 21:52:37'),
(2, 'testG2', 0, 7, '2010-02-19 20:18:52', '0000-00-00 00:00:00'),
(3, 'testestsf', 0, 0, '2010-02-20 23:29:53', '2010-02-20 23:29:53');

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
  `description` varchar(100) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_dt`, `description`, `contact_id`, `user_id`) VALUES
(1, '2010-06-10 20:24:07', 'Contact saved', 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sceret_value` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trashes`
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
(5, 21, 32),
(5, 2, 50),
(5, 5, 60),
(5, 28, 0),
(5, 29, 0),
(5, 30, 0),
(5, 31, 0),
(5, 38, 90),
(5, 78, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_string`
--

CREATE TABLE IF NOT EXISTS `type_string` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_string`
--

INSERT INTO `type_string` (`field_id`, `contact_id`, `data`) VALUES
(4, 21, 'asa'),
(3, 21, 'ra'),
(9, 3, 'Hello World'),
(4, 2, 'test'),
(3, 2, 'hello'),
(6, 2, 'what is my name'),
(3, 5, 'Hello'),
(4, 5, 'whats up'),
(6, 5, 'male'),
(11, 20, 'sfas'),
(10, 20, '=1-2fsdf'),
(11, 19, '111'),
(10, 19, 'qeqw'),
(6, 21, 'aa'),
(3, 28, ''),
(4, 28, ''),
(6, 28, ''),
(3, 29, ''),
(4, 29, ''),
(6, 29, ''),
(3, 30, ''),
(4, 30, ''),
(6, 30, ''),
(3, 31, ''),
(4, 31, ''),
(6, 31, ''),
(6, 38, 'fgg'),
(3, 38, 'wg'),
(4, 38, 'rtr');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `is_active`, `created`, `modified`) VALUES
(1, 'test', 'test', 'test', 'test@hotmail.com', 'c4a58768bbcec0a0c8e4abc84cc3e3c13d4bc1f8', 1, '2010-02-16 19:18:07', '2010-02-16 19:18:07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
