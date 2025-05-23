--
-- Host: localhost    Database: final_project
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `contactMod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactMod` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(250) NOT NULL DEFAULT 'no data entered',
  `lastName` varchar(250) NOT NULL DEFAULT 'no data entered',
  `address` varchar(250) NOT NULL DEFAULT 'no data entered',
  `state` varchar(250) NOT NULL DEFAULT 'no data entered',
  `zip` varchar(250) NOT NULL DEFAULT 'no data entered',
  `phone` varchar(250) NOT NULL DEFAULT 'no data entered',
  `email` varchar(250) NOT NULL DEFAULT 'no data entered',
  `age_range` varchar(10) NOT NULL DEFAULT '',
  `contact_method` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

ALTER TABLE contactMod ADD COLUMN age_range VARCHAR(10) NOT NULL DEFAULT 'no data entered';

-- Create admin table
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(250) NOT NULL DEFAULT 'no data entered',
  `lastName` varchar(250) NOT NULL DEFAULT 'no data entered',
  `email` varchar(250) NOT NULL UNIQUE,
  `password` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;