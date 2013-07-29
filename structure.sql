# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.211.55.10 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: contact_attendance
# Generation Time: 2013-07-29 18:42:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table accounts
# ------------------------------------------------------------

CREATE TABLE `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `lname` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table attendance
# ------------------------------------------------------------

CREATE TABLE `attendance` (
  `date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `attendance` int(3) NOT NULL DEFAULT '0',
  `offering` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table check_in
# ------------------------------------------------------------

CREATE TABLE `check_in` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) unsigned NOT NULL DEFAULT '0',
  `check_date` date NOT NULL DEFAULT '0000-00-00',
  `checked_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked_out` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `class_id` int(11) unsigned NOT NULL,
  `check_in_code` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `visitor` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `offering` decimal(11,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table check_in_teachers
# ------------------------------------------------------------

CREATE TABLE `check_in_teachers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) unsigned NOT NULL DEFAULT '0',
  `check_date` date NOT NULL DEFAULT '0000-00-00',
  `checked_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked_out` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `class_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `user_agent` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` longtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table classes
# ------------------------------------------------------------

CREATE TABLE `classes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `age_min` int(2) unsigned NOT NULL DEFAULT '0',
  `age_max` int(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table contacts
# ------------------------------------------------------------

CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(1) unsigned NOT NULL DEFAULT '0',
  `fname` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `lname` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `birthdate` date NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mobile_phone` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `home_phone` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `address` varchar(75) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `address2` varchar(75) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `city` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `state` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `zip` int(5) NOT NULL,
  `class_this_field_is not_used` int(1) unsigned NOT NULL DEFAULT '1',
  `school` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `notes` text CHARACTER SET utf8 NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table incident_reports
# ------------------------------------------------------------

CREATE TABLE `incident_reports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `report` longtext CHARACTER SET utf8 NOT NULL,
  `check_date` date NOT NULL COMMENT 'This is linked the the check_date fields from the check_in table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table teachers
# ------------------------------------------------------------

CREATE TABLE `teachers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `lname` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `email` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `phone` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status` int(1) unsigned NOT NULL DEFAULT '0',
  `birthdate` date NOT NULL,
  `mobile_phone` varchar(15) CHARACTER SET utf8 NOT NULL,
  `home_phone` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `address` varchar(75) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `address2` varchar(75) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `city` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `state` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `zip` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `notes` longtext CHARACTER SET utf8 NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
