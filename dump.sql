-- MySQL dump 10.13  Distrib 5.1.61, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: orep
-- ------------------------------------------------------
-- Server version	5.1.61-0+squeeze1

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
-- Table structure for table `permission`
--
CREATE DATABASE orep;
use orep;

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `siteid` char(20) DEFAULT NULL,
  `userid` char(20) DEFAULT NULL,
  `siteuserid` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES ('A7CWhp1z3vOi1E1pWPkk','Af07KoMzwlPXYv4vc7CF','mK0pWhN7xdyRoHmn5Pgc');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siteinfo`
--

DROP TABLE IF EXISTS `siteinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siteinfo` (
  `siteid` char(20) DEFAULT NULL,
  `sitekey` binary(20) DEFAULT NULL,
  `weight` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siteinfo`
--

LOCK TABLES `siteinfo` WRITE;
/*!40000 ALTER TABLE `siteinfo` DISABLE KEYS */;
INSERT INTO `siteinfo` VALUES ('A7CWhp1z3vOi1E1pWPkk','vtdFcUrd54BgIzF1ymV3',0.8),('MryNgenPtqBp1VcMVwlS','HODUkBQyTpsL7e0VJsYG',1);
/*!40000 ALTER TABLE `siteinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ssidtable`
--

DROP TABLE IF EXISTS `ssidtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ssidtable` (
  `siteid` char(20) DEFAULT NULL,
  `ssid` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ssidtable`
--

LOCK TABLES `ssidtable` WRITE;
/*!40000 ALTER TABLE `ssidtable` DISABLE KEYS */;
/*!40000 ALTER TABLE `ssidtable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_Af07KoMzwlPXYv4vc7CF`
--

DROP TABLE IF EXISTS `user_Af07KoMzwlPXYv4vc7CF`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_Af07KoMzwlPXYv4vc7CF` (
  `siteid` char(20) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `points` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_Af07KoMzwlPXYv4vc7CF`
--

LOCK TABLES `user_Af07KoMzwlPXYv4vc7CF` WRITE;
/*!40000 ALTER TABLE `user_Af07KoMzwlPXYv4vc7CF` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_Af07KoMzwlPXYv4vc7CF` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `userid` char(20) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `globalpoint` int(11) DEFAULT NULL,
  `passwordhash` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES ('Af07KoMzwlPXYv4vc7CF','abhimanyuma',-5795,'c0f16e3bf06ffd7680e36360d272588c');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-08-25 19:44:34
