CREATE DATABASE  IF NOT EXISTS `csci2141_project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `csci2141_project`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 138.197.129.252    Database: csci2141_project
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `EPISODE`
--

DROP TABLE IF EXISTS `EPISODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EPISODE` (
  `episode_id` int(15) NOT NULL AUTO_INCREMENT,
  `dateCasted` text,
  `runtimeMinutes` int(10) DEFAULT NULL,
  `seasonNumber` int(10) DEFAULT NULL,
  `episodeNumber` int(10) DEFAULT NULL,
  `averageRating` decimal(10,0) DEFAULT NULL,
  `show_id` int(15) DEFAULT NULL,
  PRIMARY KEY (`episode_id`),
  UNIQUE KEY `episode_id_UNIQUE` (`episode_id`),
  KEY `EPSHOW_idx` (`show_id`),
  CONSTRAINT `EPSHOW` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EPISODE`
--

LOCK TABLES `EPISODE` WRITE;
/*!40000 ALTER TABLE `EPISODE` DISABLE KEYS */;
/*!40000 ALTER TABLE `EPISODE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TV_SHOW`
--

DROP TABLE IF EXISTS `TV_SHOW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TV_SHOW` (
  `show_id` int(15) NOT NULL,
  `isAdult` text,
  `startYear` date DEFAULT NULL,
  `endYear` date DEFAULT NULL,
  `runtimeMinutes` int(10) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `show_name` varchar(45) DEFAULT NULL,
  `prod_id` int(11) NOT NULL,
  PRIMARY KEY (`show_id`),
  UNIQUE KEY `tconst_UNIQUE` (`show_id`),
  KEY `showgen_idx` (`genre_id`),
  KEY `prodshow_idx` (`prod_id`),
  CONSTRAINT `prodshow` FOREIGN KEY (`prod_id`) REFERENCES `production` (`prod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `showgen` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TV_SHOW`
--

LOCK TABLES `TV_SHOW` WRITE;
/*!40000 ALTER TABLE `TV_SHOW` DISABLE KEYS */;
/*!40000 ALTER TABLE `TV_SHOW` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `actor_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contract_id`),
  UNIQUE KEY `contract_id` (`contract_id`),
  KEY `actor_id` (`actor_id`),
  KEY `CONTRACT_ibfk_1_idx` (`show_id`),
  CONSTRAINT `CONTRACT_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`),
  CONSTRAINT `CONTRACT_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `creditors` (`crediter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditors`
--

DROP TABLE IF EXISTS `creditors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditors` (
  `crediter_id` int(11) NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(25) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `show_id` int(15) NOT NULL,
  PRIMARY KEY (`crediter_id`),
  KEY `profShow_idx` (`show_id`),
  CONSTRAINT `profShow` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditors`
--

LOCK TABLES `creditors` WRITE;
/*!40000 ALTER TABLE `creditors` DISABLE KEYS */;
/*!40000 ALTER TABLE `creditors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`genre_id`),
  UNIQUE KEY `genre_id` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production`
--

DROP TABLE IF EXISTS `production`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production`
--

LOCK TABLES `production` WRITE;
/*!40000 ALTER TABLE `production` DISABLE KEYS */;
INSERT INTO `production` VALUES (1,'Sony Pictures'),(2,'LIONSGATE'),(3,'Paramount Pictures'),(4,'Universal'),(5,'Warner Bros.'),(6,'MGM'),(7,'The Walt Disney');
/*!40000 ALTER TABLE `production` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professions`
--

DROP TABLE IF EXISTS `professions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professions` (
  `profession_id` int(15) NOT NULL AUTO_INCREMENT,
  `crediter_id` int(11) DEFAULT NULL,
  `profession` text,
  `characters` text,
  PRIMARY KEY (`profession_id`),
  KEY `profcredit_idx` (`crediter_id`),
  CONSTRAINT `profcredit` FOREIGN KEY (`crediter_id`) REFERENCES `creditors` (`crediter_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professions`
--

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;
/*!40000 ALTER TABLE `professions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtitle`
--

DROP TABLE IF EXISTS `subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtitle` (
  `subtitle_id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT NULL,
  `subtitles_language` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`subtitle_id`),
  UNIQUE KEY `subtitle_id` (`subtitle_id`),
  KEY `subshow_idx` (`show_id`),
  CONSTRAINT `subshow` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtitle`
--

LOCK TABLES `subtitle` WRITE;
/*!40000 ALTER TABLE `subtitle` DISABLE KEYS */;
/*!40000 ALTER TABLE `subtitle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'csci2141_project'
--

--
-- Dumping routines for database 'csci2141_project'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-16 12:21:07
