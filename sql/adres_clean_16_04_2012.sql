# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.37)
# Database: adres5
# Generation Time: 2012-04-16 16:27:55 +0200
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table affiliations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `affiliations`;

CREATE TABLE `affiliations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_father_id` int(11) NOT NULL,
  `contact_type_child_id` int(11) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `child_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_type_father_id` (`contact_type_father_id`),
  KEY `contact_type_child_id` (`contact_type_child_id`),
  CONSTRAINT `affiliations_ibfk_2` FOREIGN KEY (`contact_type_child_id`) REFERENCES `contact_types` (`id`),
  CONSTRAINT `affiliations_ibfk_1` FOREIGN KEY (`contact_type_father_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table affiliations_contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `affiliations_contacts`;

CREATE TABLE `affiliations_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliation_id` int(11) NOT NULL,
  `contact_father_id` int(11) NOT NULL,
  `contact_child_id` int(11) NOT NULL,
  `after_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`contact_child_id`,`contact_father_id`,`affiliation_id`),
  KEY `fk_affiliations_contacts_contacts_father` (`contact_father_id`),
  KEY `fk_affiliations_contacts_affiliations` (`affiliation_id`),
  KEY `fk_affiliations_contacts_contacts_child` (`contact_child_id`),
  CONSTRAINT `fk_affiliations_contacts_affiliations` FOREIGN KEY (`affiliation_id`) REFERENCES `affiliations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_affiliations_contacts_contacts_child` FOREIGN KEY (`contact_child_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_affiliations_contacts_contacts_father` FOREIGN KEY (`contact_father_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table contact_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact_types`;

CREATE TABLE `contact_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `contact_counter` int(11) unsigned NOT NULL,
  `implementation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_types_implementations` (`implementation_id`),
  CONSTRAINT `contact_types_ibfk_1` FOREIGN KEY (`implementation_id`) REFERENCES `implementations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

LOCK TABLES `contact_types` WRITE;
/*!40000 ALTER TABLE `contact_types` DISABLE KEYS */;
INSERT INTO `contact_types` (`id`,`name`,`contact_counter`,`implementation_id`)
VALUES
	(14,'Default',0,1);

/*!40000 ALTER TABLE `contact_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `trash_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contacts_contact_types` (`contact_type_id`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



# Dump of table contacts_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts_groups`;

CREATE TABLE `contacts_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`group_id`,`contact_id`),
  KEY `fk_contacts_groups_contacts` (`contact_id`),
  KEY `fk_contacts_groups_groups` (`group_id`),
  CONSTRAINT `contacts_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `contacts_groups_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table field_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `field_types`;

CREATE TABLE `field_types` (
  `class_name` varchar(45) NOT NULL,
  `nice_name` varchar(45) NOT NULL,
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `field_types` WRITE;
/*!40000 ALTER TABLE `field_types` DISABLE KEYS */;
INSERT INTO `field_types` (`class_name`,`nice_name`)
VALUES
	('TypeAutoincrement','Auto increment'),
	('TypeBirthdate','Birthdate'),
	('TypeBoolean','True/false'),
	('TypeDate','Date'),
	('TypeDisplayaffiliation','Display affiliations '),
	('TypeDisplaygroup ','Display groups '),
	('TypeEmail','Email'),
	('TypeEncrypt','Encryptor'),
	('TypeInteger','integer'),
	('TypePhone','phone'),
	('TypeSelect','Select'),
	('TypeString','text'),
	('TypeStringEllipses','EllipsesString'),
	('TypeText','TextArea');

/*!40000 ALTER TABLE `field_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fields`;

CREATE TABLE `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `field_type_class_name` varchar(45) NOT NULL,
  `is_descriptive` tinyint(1) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_fields_contact_types` (`contact_type_id`),
  KEY `fk_fields_field_types` (`field_type_class_name`),
  CONSTRAINT `fields_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table filters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `filters`;

CREATE TABLE `filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `criteria` mediumtext NOT NULL,
  `keyword` varchar(512) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_filters_contact_types` (`contact_type_id`),
  CONSTRAINT `filters_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table forms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `forms`;

CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `beforeHtml` longtext NOT NULL,
  `afterHtml` longtext NOT NULL,
  `admin_approval` tinyint(1) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table forms_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `forms_fields`;

CREATE TABLE `forms_fields` (
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `default_value` varchar(45) NOT NULL,
  `is_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rght` int(10) unsigned NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_parent_fk` (`parent_id`),
  KEY `contact_type_id` (`contact_type_id`),
  CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table hidden_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hidden_fields`;

CREATE TABLE `hidden_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hidden_fields_contact_types` (`contact_type_id`),
  KEY `fk_hidden_fields_fields` (`field_id`),
  KEY `fk_hidden_fields_users` (`user_id`),
  CONSTRAINT `hidden_fields_ibfk_3` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `hidden_fields_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`),
  CONSTRAINT `hidden_fields_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table implementations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `implementations`;

CREATE TABLE `implementations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

LOCK TABLES `implementations` WRITE;
/*!40000 ALTER TABLE `implementations` DISABLE KEYS */;
INSERT INTO `implementations` (`id`,`name`)
VALUES
	(1,'Default implementation');

/*!40000 ALTER TABLE `implementations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `log_dt` datetime NOT NULL,
  `description` mediumtext NOT NULL,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`contact_id`),
  KEY `fk_logs_contacts` (`contact_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tokens`;

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sceret_value` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test` char(0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table trashes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trashes`;

CREATE TABLE `trashes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `contact_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`contact_id`),
  KEY `fk_trashes_contacts` (`contact_id`),
  CONSTRAINT `trashes_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_auto_increments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_auto_increments`;

CREATE TABLE `type_auto_increments` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_integer_contacts` (`contact_id`),
  KEY `fk_type_integer_fields` (`field_id`),
  CONSTRAINT `type_auto_increments_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `type_auto_increments_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_boolean
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_boolean`;

CREATE TABLE `type_boolean` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`,`field_id`),
  UNIQUE KEY `boolean_fk_unique` (`field_id`,`contact_id`),
  KEY `fk_type_boolean_contacts` (`contact_id`),
  KEY `fk_type_boolean_fields` (`field_id`),
  CONSTRAINT `type_boolean_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `type_boolean_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_date
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_date`;

CREATE TABLE `type_date` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`contact_id`,`field_id`),
  KEY `fk_type_date_contacts` (`contact_id`),
  KEY `fk_type_date_fields` (`field_id`),
  CONSTRAINT `type_date_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `type_date_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_date_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_date_options`;

CREATE TABLE `type_date_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `format` varchar(255) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_type_date_options` (`field_id`),
  KEY `contact_type_id` (`contact_type_id`),
  CONSTRAINT `type_date_options_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_date_options_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



# Dump of table type_displayaffiliations_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_displayaffiliations_options`;

CREATE TABLE `type_displayaffiliations_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `affiliation` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type_date_options` (`field_id`),
  KEY `contact_type_id` (`contact_type_id`),
  CONSTRAINT `type_displayaffiliations_options_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_displayaffiliations_options_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



# Dump of table type_displaygroups_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_displaygroups_options`;

CREATE TABLE `type_displaygroups_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `parentgroup` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type_date_options` (`field_id`),
  KEY `contact_type_id` (`contact_type_id`),
  CONSTRAINT `type_displaygroups_options_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_displaygroups_options_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



# Dump of table type_email
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_email`;

CREATE TABLE `type_email` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(50) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_email_contacts` (`contact_id`),
  KEY `fk_type_email_fields` (`field_id`),
  CONSTRAINT `type_email_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `type_email_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_encrypt
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_encrypt`;

CREATE TABLE `type_encrypt` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(512) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `contact_id` (`contact_id`),
  KEY `field_id` (`field_id`),
  CONSTRAINT `type_encrypt_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_encrypt_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_encrypt_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_encrypt_options`;

CREATE TABLE `type_encrypt_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `hash` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_type_id` (`contact_type_id`),
  KEY `field_id` (`field_id`),
  CONSTRAINT `type_encrypt_options_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_encrypt_options_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_integer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_integer`;

CREATE TABLE `type_integer` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_integer_contacts` (`contact_id`),
  KEY `fk_type_integer_fields` (`field_id`),
  CONSTRAINT `type_integer_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `type_integer_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_phone
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_phone`;

CREATE TABLE `type_phone` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(23) NOT NULL,
  KEY `field_id` (`field_id`),
  KEY `contact_id` (`contact_id`),
  CONSTRAINT `type_phone_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `type_phone_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_phone_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_phone_options`;

CREATE TABLE `type_phone_options` (
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `rules` varchar(512) NOT NULL,
  UNIQUE KEY `fk_phone_field_id` (`field_id`),
  KEY `fk_phone_contact_typeid` (`contact_type_id`),
  CONSTRAINT `type_phone_options_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_phone_options_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_select
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_select`;

CREATE TABLE `type_select` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_select_contacts` (`contact_id`),
  KEY `fk_type_select_fields` (`field_id`),
  CONSTRAINT `type_select_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_select_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_select_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_select_options`;

CREATE TABLE `type_select_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type_select_options_fields` (`field_id`),
  KEY `contact_type_id` (`contact_type_id`),
  CONSTRAINT `type_select_options_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_select_options_ibfk_1` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;



# Dump of table type_string
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_string`;

CREATE TABLE `type_string` (
  `field_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `data` varchar(512) NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_string_contacts` (`contact_id`),
  KEY `fk_type_string_fields` (`field_id`),
  CONSTRAINT `type_string_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `type_string_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_string_ellipses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_string_ellipses`;

CREATE TABLE `type_string_ellipses` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` varchar(512) NOT NULL,
  PRIMARY KEY (`contact_id`,`field_id`),
  KEY `fk_types_string_ellipses_contacts` (`contact_id`),
  KEY `fk_type_string_ellipses_fields` (`field_id`),
  CONSTRAINT `type_string_ellipses_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_string_ellipses_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table type_text
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type_text`;

CREATE TABLE `type_text` (
  `contact_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`field_id`,`contact_id`),
  KEY `fk_type_text_contacts` (`contact_id`),
  KEY `fk_field_id` (`field_id`),
  CONSTRAINT `type_text_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `type_text_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`first_name`,`last_name`,`username`,`email`,`password`,`is_active`,`created`,`modified`)
VALUES
	(1,'test','test','test','test@test.com','c4a58768bbcec0a0c8e4abc84cc3e3c13d4bc1f8',1,'2010-02-16 19:18:07','2011-08-09 22:54:35');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
