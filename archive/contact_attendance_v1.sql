# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.211.55.8 (MySQL 5.5.29-0ubuntu0.12.04.1)
# Database: contact_attendance_v1
# Generation Time: 2013-02-16 19:04:39 +0000
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

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL DEFAULT '',
  `lname` varchar(100) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;

INSERT INTO `accounts` (`id`, `email`, `password`, `fname`, `lname`, `created`)
VALUES
	(15,'nick@nickradford.net','75ef9faee755c70589550b513ad881e5a603182c','Nick','Radford','2013-02-09 12:15:07');

/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attendance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attendance` int(3) NOT NULL DEFAULT '0',
  `offering` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;

INSERT INTO `attendance` (`date`, `id`, `contact_id`, `attendance`, `offering`)
VALUES
	('20081116',4,'51',1,'3.1'),
	('20081116',5,'44',0,''),
	('20081116',6,'21',1,''),
	('20081116',7,'54',1,''),
	('20081116',8,'24',1,''),
	('20081116',9,'23',1,''),
	('20081116',10,'57',1,''),
	('20081116',11,'47',1,''),
	('20081116',12,'27',1,''),
	('20081116',13,'55',1,''),
	('20081116',14,'25',1,''),
	('20081116',15,'58',1,''),
	('20081116',16,'26',1,''),
	('20081116',17,'28',1,''),
	('20081116',18,'29',1,''),
	('20081116',19,'30',1,''),
	('20081116',20,'31',1,''),
	('20081116',21,'56',1,''),
	('20081116',22,'50',1,''),
	('20081116',23,'33',1,''),
	('20081116',24,'49',1,''),
	('20081116',25,'35',1,''),
	('20081116',26,'34',1,''),
	('20081116',27,'32',1,''),
	('20081116',28,'53',1,''),
	('20081116',29,'42',1,''),
	('20081116',30,'52',1,''),
	('20081116',31,'38',1,''),
	('20081116',32,'36',1,''),
	('20081116',33,'37',1,''),
	('20081116',34,'41',1,''),
	('20081116',35,'43',1,''),
	('20081116',36,'39',1,''),
	('20081116',37,'40',1,'10.65'),
	('20081116',38,'45',0,'1'),
	('20081116',39,'46',1,'2'),
	('20081116',40,'48',0,'3'),
	('20081116',41,'51',1,'3.1'),
	('20081116',42,'44',0,''),
	('20081116',43,'21',1,''),
	('20081116',44,'54',1,''),
	('20081116',45,'24',1,''),
	('20081116',46,'23',1,''),
	('20081116',47,'57',1,''),
	('20081116',48,'47',1,''),
	('20081116',49,'27',1,''),
	('20081116',50,'55',1,''),
	('20081116',51,'25',1,''),
	('20081116',52,'58',1,''),
	('20081116',53,'26',1,''),
	('20081116',54,'28',1,''),
	('20081116',55,'29',1,''),
	('20081116',56,'30',1,''),
	('20081116',57,'31',1,''),
	('20081116',58,'56',1,''),
	('20081116',59,'50',1,''),
	('20081116',60,'33',1,''),
	('20081116',61,'49',1,''),
	('20081116',62,'35',1,''),
	('20081116',63,'34',1,''),
	('20081116',64,'32',1,''),
	('20081116',65,'53',1,''),
	('20081116',66,'42',1,''),
	('20081116',67,'52',1,''),
	('20081116',68,'38',1,''),
	('20081116',69,'36',1,''),
	('20081116',70,'37',1,''),
	('20081116',71,'41',1,''),
	('20081116',72,'43',1,''),
	('20081116',73,'39',1,''),
	('20081116',74,'40',1,'10.65');

/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table check_in
# ------------------------------------------------------------

DROP TABLE IF EXISTS `check_in`;

CREATE TABLE `check_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `check_date` int(11) NOT NULL DEFAULT '0',
  `checked_in` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `check_in` WRITE;
/*!40000 ALTER TABLE `check_in` DISABLE KEYS */;

INSERT INTO `check_in` (`id`, `contact_id`, `check_date`, `checked_in`, `checked_out`)
VALUES
	(54,90,20100314,95812,0),
	(56,24,20100314,95820,0),
	(57,90,20100314,95826,0),
	(58,90,20100320,151926,0),
	(60,90,20100320,151948,0),
	(62,90,20100320,162159,0),
	(63,90,20100320,162202,0),
	(64,90,20100320,162205,0),
	(66,90,20100321,93550,0),
	(67,90,20100515,132636,0),
	(68,43,20100515,132643,0),
	(69,57,20100515,133323,0),
	(70,57,20100515,133339,0),
	(71,41,20100515,133343,0),
	(72,24,20100515,133358,0),
	(74,41,20100515,133633,0),
	(76,43,20100515,134711,0),
	(85,26,20110103,124847,0),
	(90,26,20110213,152416,0),
	(108,56,20110214,104618,0),
	(116,27,20110214,105654,0),
	(117,28,20110214,105937,0),
	(118,32,20110214,105944,0),
	(119,23,20110214,110332,0),
	(120,33,20110214,1297703105,0),
	(121,25,20110214,1297703164,0),
	(122,21,20110214,1297704491,0),
	(123,25,20110214,1297704644,0),
	(124,26,20110214,1297704924,0),
	(125,26,20110214,1297704929,0),
	(127,26,20110515,1305501406,0),
	(128,43,20110515,1305501413,0);

/*!40000 ALTER TABLE `check_in` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ci_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` longtext NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`)
VALUES
	('2c0743585b12f2b27049ba5b6ff74d00','10.211.55.2','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) App',1360729179,''),
	('5df5d9a15472389ee7f6e5f553b049b3','10.211.55.2','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) App',1360764381,''),
	('c4d2d5d9d61be569c727421df0b7464e','10.211.55.2','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) App',1360806450,'');

/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` int(3) NOT NULL DEFAULT '0',
  `last_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `first_name` varchar(15) CHARACTER SET latin1 NOT NULL,
  `birthdate` int(8) NOT NULL,
  `email` varchar(25) CHARACTER SET latin1 NOT NULL,
  `mobile_phone` varchar(15) CHARACTER SET latin1 NOT NULL,
  `home_phone` varchar(15) CHARACTER SET latin1 NOT NULL,
  `address` varchar(40) CHARACTER SET latin1 NOT NULL,
  `address2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `city` varchar(30) CHARACTER SET latin1 NOT NULL,
  `state` varchar(2) CHARACTER SET latin1 NOT NULL,
  `zip` int(5) NOT NULL,
  `class` int(1) NOT NULL DEFAULT '1',
  `school` varchar(30) CHARACTER SET latin1 NOT NULL,
  `notes` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;

INSERT INTO `contacts` (`id`, `status`, `last_name`, `first_name`, `birthdate`, `email`, `mobile_phone`, `home_phone`, `address`, `address2`, `city`, `state`, `zip`, `class`, `school`, `notes`)
VALUES
	(21,1,'Cross','Savanya',19691231,'','','','4670 Flat River Rd. apt 42','','Farmington','MO',63640,2,'Farmington',''),
	(23,1,'Dean','McKenzie ',0,'','','3447','10833 Springtown Rd.','','Mineral Point','MO',63660,2,'Potosi',''),
	(24,1,'Dean','Abigail ',19691231,'','','0446','10833 Springtown Rd.','','Mineral Point','MO',63660,3,'Potosi',''),
	(25,1,'Gonzalez','Abigail ',0,'','','','705 Teak St.','','Park Hills','MO',63601,1,'Central',''),
	(26,1,'Gonzalez','Austen',19691231,'','','1409','705 Teak St.','','Park Hills','MO',63601,1,'Central',''),
	(27,1,'Gillam','Kendra',0,'','','3371','203 Hampton Ave.','','Park Hills','MO',63601,1,'Central',''),
	(28,1,'Jones','Gabby',0,'','','9506','1655 Hwy H','','Farmington','MO',63640,1,'Farmington',''),
	(29,1,'Jones','Sydney ',0,'','','9506','1655 Hwy H','','Farmington','MO',63640,1,'Farmington',''),
	(30,1,'Kostic','Abigail ',0,'','','3830','P.O. Box 243 ','','Irondale','MO',63648,3,'',''),
	(31,1,'Kostic','Amber',0,'','','3830','P.O. Box 243 ','','Irondale','MO',63648,2,'',''),
	(32,1,'Miniex','Caitlin',0,'','','0929','402 Fifth St.','','Park Hills','MO',63601,2,'',''),
	(33,1,'Massey','Heather ',0,'','5709','','5337 westmeyer Rd.','','Farmington','MO',63640,1,'Farmington',''),
	(34,1,'Melville','Isaiah',0,'','','','108 N. Franklin','','Farmington','MO',63640,2,'Farmington',''),
	(35,1,'McKenzie','Aubrie',0,'','','9296','6 Redbud Ct.','','Desloge','MO',63601,3,'North County',''),
	(36,1,'Rosalea','laryssa',0,'','','','108 N. Franklin','','Farmington','MO',63640,2,'Farmington',''),
	(37,1,'Rosales','Matthew',0,'','','','108 N. Franklin','','Farmington','MO',63640,1,'Farmington',''),
	(38,1,'Roesch','Georgie',0,'','','','4670 Flat River Rd. apt 42','','Farmington','MO',63640,3,'Farmington',''),
	(39,1,'Stahl','Andrew',0,'','','','108 N. Franklin','','Farmington','MO',63640,1,'Farmington',''),
	(40,1,'Stahl','Rachel',0,'','','','108 N. Franklin','','Farmington','MO',63640,1,'Farmington',''),
	(41,1,'Smith','Morgan',0,'','5293','1737','P.O. Box 415 ','','Doe Run','MO',63637,1,'',''),
	(42,1,'Price','Savannah',0,'','','8187','224 Leann Drive','','Desloge','MO',63601,1,'North County',''),
	(43,1,'Smith','Scotty',0,'','','9458','122 Judy Street','','Desloge','MO',63601,2,'North County',''),
	(44,1,'Brawley','Missy',20000516,'','','home_phone','303 South A Street','','Farmington','MO',63640,0,'Farmington',''),
	(45,1,'Barton','Taylor',20080101,'taylor@taylor.com','5555555555','5555555555','670 Hwy AA','','Farmington','MO',63640,0,'Farmimgton','Lorem ipsum dolor sit amet, consectetur adipisicing elit,\r\n\r\n&quot;test&quot;'),
	(46,1,'Berry','Brett ',0,'','','6061','','','','MO',0,2,'Bismark',''),
	(47,1,'Garst','Taylor',0,'','','','','','','MO',0,2,'',''),
	(48,1,'Berry','Larry Dean',19691231,'','','5555551234','','','','MO',636,0,'Bismark',''),
	(49,1,'McEntire','Mary Sue',0,'','','6523','','','Farmington','MO',63640,3,'','Likes to play'),
	(50,1,'Leonard','Heather',0,'','','3710','210 Aldergate Dr.','','Bonne Terre','MO',63628,1,'North County','Likes to swim,talk & eat'),
	(51,1,'Boyster','Aaron ',20080101,'aaron@aaron.com','','home_phone','207 Loraine Rd.','','Bonne Terre','MO',63628,0,'North County',''),
	(52,1,'Robinson','Destiny ',0,'','1105','','','','Bonne Terre','MO',63628,1,'North County','Likes to hang out with her friends.'),
	(53,1,'Price','James',0,'','5736311751','5733585784','','','','MO',0,1,'North County',''),
	(54,1,'Dalton','Matt',0,'','','','230 Low Street','','','MO',0,1,'',''),
	(55,1,'Godet','Levi',0,'','','','','','Bonne Terre','MO',63628,1,'North County',''),
	(56,1,'Leach','Austin',0,'','','0966','10055 Pond Creek Rd.','','Bonne Terre','MO',63628,1,'North County','Likes playing games, reading books and hanging out with his friends.'),
	(57,1,'Dominick','Halsie ',19691231,'','','6523','306 Kanwood Dr.','','Farmington','MO',63640,1,'Farmington','Band, Music, Gymnastics and dance'),
	(90,1,'Radford','Nick',19911224,'nickradford@gmail.com','5736311751','5737011056','510 Norwood Dr','','Bonne Terre','MO',63628,0,'evangel','note\r\nthis is a test\r\n');

/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table offering
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offering`;

CREATE TABLE `offering` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` varchar(20) CHARACTER SET latin1 NOT NULL,
  `contact_id` int(10) NOT NULL,
  `date` varchar(15) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
