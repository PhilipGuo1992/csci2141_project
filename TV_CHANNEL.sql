CREATE DATABASE  IF NOT EXISTS `csci2141_project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `csci2141_project`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 138.197.129.252    Database: csci2141_project
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1-log

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
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `showId` int(11) NOT NULL,
  `actorId` int(11) NOT NULL,
  `actorType` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contractId`),
  UNIQUE KEY `contract_id` (`contractId`),
  KEY `actor_id` (`actorId`),
  KEY `CONTRACT_ibfk_1_idx` (`showId`),
  CONSTRAINT `CONTRACT_ibfk_1` FOREIGN KEY (`showId`) REFERENCES `tvshow` (`showId`),
  CONSTRAINT `CONTRACT_ibfk_2` FOREIGN KEY (`actorId`) REFERENCES `credit` (`creditId`)
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
-- Table structure for table `credit`
--

DROP TABLE IF EXISTS `credit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit` (
  `creditId` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(25) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `showId` int(15) NOT NULL,
  PRIMARY KEY (`creditId`),
  KEY `profShow_idx` (`showId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit`
--

LOCK TABLES `credit` WRITE;
/*!40000 ALTER TABLE `credit` DISABLE KEYS */;
/*!40000 ALTER TABLE `credit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `episode`
--

DROP TABLE IF EXISTS `episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `episode` (
  `episodeId` int(15) NOT NULL AUTO_INCREMENT,
  `dateCasted` date DEFAULT NULL,
  `runtimeMinutes` int(10) DEFAULT NULL,
  `seasonNumber` int(10) DEFAULT NULL,
  `episodeNumber` int(10) DEFAULT NULL,
  `averageRating` decimal(10,0) DEFAULT NULL,
  `showId` int(15) DEFAULT NULL,
  PRIMARY KEY (`episodeId`),
  UNIQUE KEY `episode_id_UNIQUE` (`episodeId`),
  KEY `EPSHOW_idx` (`showId`),
  CONSTRAINT `EPSHOW` FOREIGN KEY (`showId`) REFERENCES `tvshow` (`showId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `episode`
--

LOCK TABLES `episode` WRITE;
/*!40000 ALTER TABLE `episode` DISABLE KEYS */;
/*!40000 ALTER TABLE `episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `genreId` int(11) NOT NULL AUTO_INCREMENT,
  `genreType` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`genreId`),
  UNIQUE KEY `genre_id` (`genreId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Action Series'),(2,'Adventure Series'),(3,'Animated series'),(4,'Documentary'),(5,'Drama'),(6,'Educational'),(7,'Game Show'),(8,'Late night television'),(9,'Comedy');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movie` (
  `movieId` int(11) NOT NULL AUTO_INCREMENT,
  `movieName` varchar(45) NOT NULL,
  `releaseDate` date NOT NULL,
  `runtime` int(15) NOT NULL,
  `prodId` int(11) NOT NULL,
  PRIMARY KEY (`movieId`),
  KEY `prod_id_idx` (`prodId`),
  CONSTRAINT `prod_id` FOREIGN KEY (`prodId`) REFERENCES `production` (`prodId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production`
--

DROP TABLE IF EXISTS `production`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production` (
  `prodId` int(11) NOT NULL AUTO_INCREMENT,
  `prodName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prodId`),
  UNIQUE KEY `prod_id` (`prodId`)
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
-- Table structure for table `profession`
--

DROP TABLE IF EXISTS `profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profession` (
  `professionId` int(15) NOT NULL AUTO_INCREMENT,
  `creditorId` int(11) DEFAULT NULL,
  `profession` text,
  `characters` text,
  PRIMARY KEY (`professionId`),
  KEY `profcredit_idx` (`creditorId`),
  CONSTRAINT `profcredit` FOREIGN KEY (`creditorId`) REFERENCES `credit` (`creditId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession`
--

LOCK TABLES `profession` WRITE;
/*!40000 ALTER TABLE `profession` DISABLE KEYS */;
/*!40000 ALTER TABLE `profession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtitle`
--

DROP TABLE IF EXISTS `subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtitle` (
  `subtitleId` int(11) NOT NULL AUTO_INCREMENT,
  `showId` int(11) DEFAULT NULL,
  `subtitlesLang` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`subtitleId`),
  UNIQUE KEY `subtitle_id` (`subtitleId`),
  KEY `subshow_idx` (`showId`),
  CONSTRAINT `subshow` FOREIGN KEY (`showId`) REFERENCES `tvshow` (`showId`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `tvshow`
--

DROP TABLE IF EXISTS `tvshow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tvshow` (
  `showId` int(15) NOT NULL AUTO_INCREMENT,
  `isAdult` tinyint(4) DEFAULT NULL,
  `startYear` date DEFAULT NULL,
  `endYear` date DEFAULT NULL,
  `runtimeMinutes` int(10) DEFAULT NULL,
  `genreId` int(11) DEFAULT NULL,
  `showName` varchar(45) DEFAULT NULL,
  `prodId` int(11) NOT NULL,
  PRIMARY KEY (`showId`),
  UNIQUE KEY `tconst_UNIQUE` (`showId`),
  KEY `showgen_idx` (`genreId`),
  KEY `prodshow_idx` (`prodId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tvshow`
--

LOCK TABLES `tvshow` WRITE;
/*!40000 ALTER TABLE `tvshow` DISABLE KEYS */;
/*!40000 ALTER TABLE `tvshow` ENABLE KEYS */;
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

-- Dump completed on 2018-03-16 18:38:14
