-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2010 at 10:16 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `affiliations_contacts`
--

INSERT INTO `affiliations_contacts` (`id`, `affiliation_id`, `contact_father_id`, `contact_child_id`, `after_id`) VALUES
(1, 3, 2, 21, 0),
(2, 1, 5, 71, 0),
(3, 5, 5, 55, 0),
(4, 1, 12, 5, 0),
(5, 3, 5, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `trash_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_type_id`, `trash_id`) VALUES
(1, 5, 0),
(2, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_groups`
--

CREATE TABLE IF NOT EXISTS `contacts_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `contacts_groups`
--

INSERT INTO `contacts_groups` (`id`, `contact_id`, `group_id`) VALUES
(40, 2, 2),
(41, 71, 2),
(30, 3, 3);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `contact_counter`, `implementation_id`) VALUES
(5, 'People', 12, 4),
(8, 'Kids', 3, 4),
(11, 'Company', 0, 4),
(12, '', 1, 0),
(13, '', 1, 0),
(14, '', 1, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `contact_type_id`, `order`, `field_type_class_name`, `is_descriptive`, `required`) VALUES
(3, 'First Name', 5, 5, 'TypeString', 1, 1),
(4, 'Last Name', 5, 3, 'TypeString', 1, 1),
(5, 'Age', 5, 4, 'TypeInteger', 1, 1),
(6, 'sex', 5, 4, 'TypeString', 1, 1),
(9, 'name', 8, 2, 'TypeString', 1, 1),
(12, 'created_at', 5, 10, 'TypeDate', 1, 1);

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
('TypeDate', 'Date');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

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
(2, 'testG2', 0, 5, '2010-02-19 20:18:52', '0000-00-00 00:00:00'),
(3, 'testestsf', 0, 8, '2010-02-20 23:29:53', '2010-02-20 23:29:53');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_dt`, `description`, `contact_id`, `user_id`) VALUES
(1, '2010-06-25 11:40:08', 'fdsf sdf sadf asdf sd fsd fs trashed', 2, 1),
(2, '2010-06-25 11:41:12', 'Changed <strong>First Name</strong> from <i>Hello</i> to <i>HelloWWW</i>', 5, 1),
(3, '2010-06-25 12:00:36', 'a kid is trashed', 3, 1),
(4, '2010-06-24 21:45:19', 'It is being deleted by me to restore some space', 5, 1),
(5, '2010-06-24 21:49:44', 'fdsafsd fsad fsd fasdf asdf asdf ', 2, 1),
(6, '2010-06-25 07:20:42', 'Contact saved', 1, 1),
(7, '2010-06-25 08:03:24', 'Contact saved', 1, 1),
(8, '2010-06-25 08:04:10', 'Changed <strong>created_at</strong> from <i>0000-00-00 00:00:00</i> to <i>2010:06:26</i>', 1, 1),
(9, '2010-06-25 08:05:19', 'Contact saved', 2, 1),
(10, '2010-06-25 08:06:02', 'Changed <strong>created_at</strong> from <i>0000-00-00 00:00:00</i> to <i>2010:06:30</i>', 2, 1),
(11, '2010-06-25 10:06:46', 'Contact saved', 1, 1),
(12, '2010-06-25 10:07:25', 'Changed <strong>created_at</strong> from <i>0000-00-00 00:00:00</i> to <i>2010:06:20</i>', 1, 1),
(13, '2010-06-25 10:07:56', 'Contact saved', 2, 1),
(14, '2010-06-25 10:08:22', 'Changed <strong>created_at</strong> from <i>0000-00-00 00:00:00</i> to <i>2010:06:26</i>', 2, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trashes`
--


-- --------------------------------------------------------

--
-- Table structure for table `type_date`
--

CREATE TABLE IF NOT EXISTS `type_date` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_date`
--

INSERT INTO `type_date` (`field_id`, `contact_id`, `data`) VALUES
(12, 1, '2010-06-20 00:00:00'),
(12, 2, '2010-06-26 00:00:00');

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
(5, 2, 28);

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
(3, 1, 'Rajib'),
(4, 1, 'Ahmed'),
(6, 1, 'male'),
(3, 2, 'Jonathan'),
(4, 2, 'Bigler'),
(6, 2, 'male');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `is_active`, `created`, `modified`) VALUES
(1, 'test', 'test', 'test', 'test@hotmail.com', 'c4a58768bbcec0a0c8e4abc84cc3e3c13d4bc1f8', 1, '2010-02-16 19:18:07', '2010-02-16 19:18:07'),
(3, 'Rajib', 'Ahmed', 'rajib', 'l.rajibahmed@gmail.com', '413eb47b96ca90c897dda9685f4d0374a7393c32', 1, '2010-06-15 13:59:43', '2010-06-15 13:59:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
