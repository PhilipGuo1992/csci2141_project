CREATE DATABASE  IF NOT EXISTS `csci2141_project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `csci2141_project`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: XYZ    Database: csci2141_project
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
-- Table structure for table `ACTOR`
--

DROP TABLE IF EXISTS `ACTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTOR` (
  `actor_id` int(11) NOT NULL,
  `actor_FName` varchar(25) DEFAULT NULL,
  `actor_LName` varchar(25) DEFAULT NULL,
  `actor_age` int(11) DEFAULT NULL,
  `actor_gender` char(1) DEFAULT NULL,
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACTOR`
--

LOCK TABLES `ACTOR` WRITE;
/*!40000 ALTER TABLE `ACTOR` DISABLE KEYS */;
/*!40000 ALTER TABLE `ACTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMMERCIAL`
--

DROP TABLE IF EXISTS `COMMERCIAL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMERCIAL` (
  `commercial_id` int(11) NOT NULL,
  `commercial_brand` varchar(20) DEFAULT NULL,
  `revenue` float DEFAULT NULL,
  `duration` time DEFAULT NULL,
  PRIMARY KEY (`commercial_id`),
  UNIQUE KEY `commercial_id` (`commercial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMMERCIAL`
--

LOCK TABLES `COMMERCIAL` WRITE;
/*!40000 ALTER TABLE `COMMERCIAL` DISABLE KEYS */;
/*!40000 ALTER TABLE `COMMERCIAL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMMERCIAL_SLOT`
--

DROP TABLE IF EXISTS `COMMERCIAL_SLOT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMERCIAL_SLOT` (
  `commercial_slot_id` int(11) NOT NULL,
  `commercial_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  PRIMARY KEY (`commercial_slot_id`),
  UNIQUE KEY `commercial_slot_id` (`commercial_slot_id`),
  KEY `commercial_id` (`commercial_id`),
  KEY `show_id` (`show_id`),
  CONSTRAINT `COMMERCIAL_SLOT_ibfk_1` FOREIGN KEY (`commercial_id`) REFERENCES `COMMERCIAL` (`commercial_id`),
  CONSTRAINT `COMMERCIAL_SLOT_ibfk_2` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMMERCIAL_SLOT`
--

LOCK TABLES `COMMERCIAL_SLOT` WRITE;
/*!40000 ALTER TABLE `COMMERCIAL_SLOT` DISABLE KEYS */;
/*!40000 ALTER TABLE `COMMERCIAL_SLOT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CONTRACT`
--

DROP TABLE IF EXISTS `CONTRACT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTRACT` (
  `contract_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `actor_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contract_id`),
  UNIQUE KEY `contract_id` (`contract_id`),
  KEY `show_id` (`show_id`),
  KEY `actor_id` (`actor_id`),
  CONSTRAINT `CONTRACT_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`),
  CONSTRAINT `CONTRACT_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `ACTOR` (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTRACT`
--

LOCK TABLES `CONTRACT` WRITE;
/*!40000 ALTER TABLE `CONTRACT` DISABLE KEYS */;
/*!40000 ALTER TABLE `CONTRACT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EPISODE`
--

DROP TABLE IF EXISTS `EPISODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EPISODE` (
  `episode_id` int(11) NOT NULL,
  `season_id` int(11) DEFAULT NULL,
  `episode_num` int(11) DEFAULT NULL,
  `episode_name` varchar(50) DEFAULT NULL,
  `viewer_rating` float DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`episode_id`),
  UNIQUE KEY `episode_id` (`episode_id`),
  KEY `season_id` (`season_id`),
  CONSTRAINT `EPISODE_ibfk_1` FOREIGN KEY (`season_id`) REFERENCES `SEASON` (`season_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EPISODE`
--

LOCK TABLES `EPISODE` WRITE;
/*!40000 ALTER TABLE `EPISODE` DISABLE KEYS */;
INSERT INTO `EPISODE` VALUES (1,NULL,1,'Test Episode',5,NULL);
/*!40000 ALTER TABLE `EPISODE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GENRE`
--

DROP TABLE IF EXISTS `GENRE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GENRE` (
  `genre_id` int(11) NOT NULL,
  `genre_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`genre_id`),
  UNIQUE KEY `genre_id` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GENRE`
--

LOCK TABLES `GENRE` WRITE;
/*!40000 ALTER TABLE `GENRE` DISABLE KEYS */;
INSERT INTO `GENRE` VALUES (1,'Comedy'),(2,'Horror'),(3,'Musical'),(4,'Action'),(5,'Animated Shows'),(6,'April Fools\' Plot'),(7,'Australian Series'),(8,'Belgian Series'),(9,'Black Comedy'),(10,'Brit Com'),(12,'British Series'),(13,'Canadian Series'),(14,'Christmas Special'),(15,'Cop Show'),(16,'Costume Drama'),(17,'Criminal Procedural'),(18,'Docudrama'),(19,'Docu Soap'),(20,'Dom Com'),(21,'Dorama'),(22,'Dramedy'),(23,'Dutch Series'),(24,'Easter Special'),(25,'Edutainment Show'),(26,'Experiment Show'),(27,'Family Drama'),(28,'Fighting Series'),(29,'Gag Series'),(30,'Game Show'),(31,'Gekiga'),(32,'Government Conspiracy'),(33,'Government Procedural'),(34,'Halloween Special'),(35,'A Hallmark Presentation'),(36,'Heroic Fantasy'),(37,'Heroic Pet Story'),(38,'Historical Fiction'),(39,'Horror'),(40,'Jiggle Show'),(41,'Kid Com'),(42,'Korean Drama'),(43,'Kitchen Sink Drama'),(45,'Matchmaker Game'),(46,'Mecha Show'),(47,'Medical Drama'),(48,'Military and Warfare'),(49,'Mind Screw'),(50,'The Musical'),(51,'Noughties Drama Series'),(52,'Mix and Match'),(53,'Pantomime'),(54,'Paranormal Investigation'),(55,'Parody'),(56,'Pilot Movie'),(57,'Point-and-Laugh Show'),(58,'Prime Time Cartoon'),(59,'Prime Time Soap'),(60,'Reality Show'),(61,'Reality TV'),(62,'Religious Edutainment'),(63,'Rescue'),(64,'Reunion Show'),(65,'Romantic Comedy'),(66,'Roommate Com'),(67,'Sadist Show'),(68,'Saturday Morning Cartoon'),(69,'Series Franchise'),(70,'Sketch Comedy'),(71,'Soap Opera'),(72,'Spy Fiction'),(73,'Stop Motion'),(74,'Super Hero'),(75,'Supernatural Soap Opera'),(76,'Teen Drama'),(77,'Two-Fisted Tales'),(78,'Toku'),(79,'The Western'),(80,'Widget Series'),(81,'Work Com'),(82,'Urban Fantasy'),(83,'News Broadcast'),(84,'Analysis Channel'),(85,'Award Show'),(86,'Biography'),(87,'Cooking Show'),(88,'Companion Show'),(89,'Documentary'),(90,'Educational Short'),(91,'Gearhead Show'),(92,'Home and Garden'),(93,'Nature Documentary'),(94,'Political Programmes'),(95,'Science Show'),(96,'Talk Show');
/*!40000 ALTER TABLE `GENRE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCTION`
--

DROP TABLE IF EXISTS `PRODUCTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCTION` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCTION`
--

LOCK TABLES `PRODUCTION` WRITE;
/*!40000 ALTER TABLE `PRODUCTION` DISABLE KEYS */;
INSERT INTO `PRODUCTION` VALUES (1,'Advantage-studio'),(2,'Argentina Sono Film'),(3,'Aleph Producciones'),(4,'Allude Entertainment'),(5,'BD Cine'),(6,'Guacamole Films'),(7,'Patagonik Film Group'),(8,'Pol-ka'),(9,'Efftee Studios'),(11,'Rising Sun Pictures'),(12,'Village Roadshow'),(15,'Jaaz Multimedia'),(16,'Monsoon Films'),(18,'Belarusfilm'),(19,'Globo Filmes'),(20,'Studio 100'),(22,'Atopia'),(25,'The Bridge Studios'),(26,'Brightlight Pictures'),(27,'Cloud Ten Pictures'),(30,'Leda Serene Films'),(31,'Malofilm'),(34,'Shaftesbury Films'),(36,'sisu production'),(37,'Suneeva'),(38,'Alibaba Pictures'),(39,'Asia Film Company'),(44,'Cinema Popular'),(46,'DMG Entertainment'),(47,'Fantasy Pictures'),(48,'Film Workshop'),(49,'Fly Films'),(50,'Fundamental Films'),(54,'Heyi Pictures'),(55,'Huayi Brothers'),(56,'Imar Film Company'),(57,'L\'est Films Group'),(58,'Laurel Films'),(59,'Lianhua Film Company'),(63,'Minxin Film Company'),(64,'MZ Pictures'),(68,'Oriental DreamWorks'),(69,'Polybona Films'),(72,'Shanghai Film Studio'),(73,'Shaw Brothers'),(76,'Tianyi Film Company'),(77,'Wanda Media'),(78,'Wenhua Film Company'),(79,'Win\'s Entertainment'),(80,'Xinhua Film Company'),(81,'Xstream Pictures'),(82,'Zagreb Film'),(83,'Jadran Film'),(84,'Croatia Film'),(85,'Barrandov Studios'),(86,'Nordisk Film'),(87,'Saga Studios'),(89,'ADASTRA Films'),(90,'Disneynature'),(91,'Les Films du Poisson'),(92,'Gaumont Film Company'),(93,'Pathé'),(94,'StudioCanal'),(95,'Bavaria Film'),(96,'Constantin Film'),(99,'Rialto Film'),(100,'Studio Babelsberg'),(102,'Wild Bunch'),(103,'Finos Film'),(104,'Pannonia Film Studio'),(105,'Blueeyes Productions'),(106,'RVK Studios'),(107,'True north'),(108,'Sagafilm'),(111,'Aashirvad Cinemas'),(112,'Annapurna Studios'),(113,'Anurag Kashyap Films'),(114,'AVM Productions'),(116,'Balaji Telefilms'),(117,'Bombay Talkies'),(119,'CineMan Productions'),(120,'Clean Slate Films'),(121,'Cloud Nine Movies'),(122,'DAR Motion Pictures'),(123,'Dharma Productions'),(124,'Eros International'),(125,'Eskay Movies'),(126,'Excel Entertainment'),(127,'Felis Creations'),(128,'Fox Star Studios'),(129,'Gemini Studios'),(130,'Geetha Arts'),(132,'Illuminati Films'),(133,'Kanteerava Studios'),(135,'Madras Talkies'),(136,'Mukta Arts'),(138,'Padmalaya Studios'),(142,'PVR Pictures'),(143,'Rajshri Productions'),(147,'R.K. Films'),(148,'S Pictures'),(149,'Sahara One'),(153,'Sivaji Productions'),(154,'Studio Green'),(155,'Sudha Productions'),(156,'Sun Pictures'),(157,'Suresh Productions'),(158,'Surinder Films'),(159,'T-Series'),(161,'Trimurti Films'),(162,'T-Series'),(163,'UTV Motion Pictures'),(165,'Vinod Chopra Films'),(166,'Vishesh Films'),(167,'Yash Raj Films'),(169,'Rapi Films'),(170,'Ardmore Studios'),(171,'Cinecittà'),(172,'Titanus'),(173,'Eiken'),(174,'Enoki Films'),(175,'Kadokawa Pictures'),(177,'Nikkatsu'),(178,'Shintoho'),(179,'Shochiku'),(180,'Studio Ghibli'),(183,'Toei Company'),(184,'Toho'),(187,'KRU Studios'),(188,'Astro Shaw'),(190,'New Zealand On Air'),(191,'WingNut Films'),(192,'Rok Studios'),(194,'Bug AS'),(195,'Fuuse Films'),(196,'GMA Films'),(197,'LVN Pictures'),(198,'OctoArts Films'),(199,'Regal Films'),(200,'Reyna Films'),(201,'Sampaguita Pictures'),(202,'Star Cinema'),(203,'Viva Films'),(204,'Appetite Production'),(205,'Se-ma-for'),(206,'Rosa Filmes'),(207,'MediaPro Pictures'),(208,'Castel Film Romania'),(209,'Gorky Film Studio'),(210,'Lenfilm'),(212,'Wizart Animation'),(213,'InlayFilm'),(216,'Mosfilm'),(217,'Soyuzmultfilm'),(219,'Lesta Studio'),(220,'Toondra'),(221,'Art Pictures Studio'),(222,'Non-Stop Production'),(223,'Bazelevs Company'),(225,'Central Partnership'),(226,'Enjoy Movies'),(227,'Glavkino'),(228,'Lennauchfilm'),(230,'Nevafilm'),(231,'Costafilm'),(232,'Proline Film'),(233,'Svarog Films'),(234,'Soho Media'),(236,'Triglav Film'),(238,'Cinema Service'),(239,'CJ E&M Film Division'),(241,'DSP'),(242,'I Star Cinema'),(243,'LOEN Entertainment'),(244,'Lotte Entertainment'),(245,'Myung Films'),(247,'Showbox'),(248,'Sidus Pictures'),(249,'Europafilm'),(250,'Film i Väst'),(251,'Sonet Film'),(253,'Benetone Films'),(254,'Five Star Production'),(255,'GDH 559'),(256,'GMM Tai Hub'),(257,'Kantana Group'),(258,'Phranakorn film'),(260,'Star Films'),(262,'ACT 2 CAM'),(264,'Aura Films'),(265,'BBC Films'),(266,'British Lion Films'),(267,'DNA Films'),(269,'Ealing Films Ltd.'),(270,'Elstree Studios'),(271,'Eon Productions'),(272,'Film Tank'),(273,'Film4 Productions'),(276,'Gate Studios'),(278,'Heyday Films'),(279,'Intermedia'),(281,'Magma Pictures'),(282,'Marv Films'),(283,'Merton Park Studios'),(284,'MGM-British Studios'),(285,'Pinewood Studios'),(288,'Shepperton Studios'),(289,'Syncopy Inc.'),(290,'Teddington Studios'),(291,'Three Mills Studios'),(293,'Vertigo Films'),(294,'Warp Films'),(295,'Working Title Films'),(297,'606 Films'),(298,'2929 Productions'),(300,'Amblin Entertainment'),(302,'American Zoetrope'),(304,'Batjac Productions'),(306,'Blue Sky Studios'),(307,'Capitol Films'),(308,'Caravan Pictures'),(309,'Carolco Pictures'),(311,'CBS Films'),(315,'Cinergi Pictures'),(316,'Columbia Pictures'),(318,'Davis Entertainment'),(319,'Destination Films'),(320,'Dimension Films'),(321,'DreamWorks'),(322,'DreamWorks Animation'),(323,'E1 Entertainment'),(324,'Edison\'s Black Maria'),(327,'Embassy Pictures'),(328,'Esperanto Filmoj'),(329,'Essanay Studios'),(331,'Famous Players-Lasky'),(333,'Filmways'),(334,'Fine Line Features'),(335,'First Look Studios'),(336,'First National'),(337,'Five & Two Pictures'),(339,'Focus Features'),(341,'Fox Atomic'),(342,'Fox Film Corporation'),(346,'Golan-Globus'),(347,'Goldwyn Pictures'),(349,'Hallmark Productions'),(350,'Hannover House'),(353,'Hollywood Pictures'),(354,'IFC Films'),(355,'Image Entertainment'),(356,'Interscope Pictures'),(357,'Kalem Company'),(358,'Keystone Studios'),(359,'Legendary Pictures'),(360,'Liberty Films'),(363,'Limelight Department'),(365,'Lubin Studios'),(366,'Lucasfilm'),(367,'Magnolia Pictures'),(368,'Marvel Studios'),(370,'Mercury Radio Arts'),(371,'Metro Pictures'),(372,'Metro-Goldwyn-Mayer'),(373,'Miramax Films'),(374,'Mutual Film'),(375,'Newmarket Films'),(376,'Nestor Studios'),(377,'New Line Cinema'),(378,'Original Film'),(380,'Overture Films'),(382,'Paramount Pictures'),(383,'Paramount Vantage'),(384,'Picturehouse'),(385,'Possibility Pictures'),(386,'Praise Pictures'),(389,'Promenade Pictures'),(392,'Republic Pictures'),(393,'RKO Pictures'),(394,'Rogue Pictures'),(395,'Rolfe Photoplays'),(397,'Samuel Goldwyn Films'),(398,'Scott Free'),(399,'Screen Gems'),(400,'Screen Media Films'),(403,'Sherwood Pictures'),(404,'Silver Pictures'),(405,'Skydance Productions'),(406,'Solax Studios'),(410,'Strand Releasing'),(411,'Sun Haven Studios'),(412,'Summit Entertainment'),(414,'Thanhouser Company'),(416,'THINKFilm'),(418,'Tiffany Pictures'),(419,'Touchstone Pictures'),(420,'Trimark Pictures'),(422,'TriStar Pictures'),(423,'Troma Entertainment'),(424,'20th Century Fox'),(426,'Uncommon Productions'),(429,'Universal Studios'),(430,'Victor Studios'),(431,'Vitagraph Studios'),(433,'Walden Media'),(435,'Walt Disney Pictures'),(436,'Warner Bros.'),(439,'Tyler Perry Studios'),(440,'Welling Films'),(442,'The Whartons Studio'),(443,'World Wide Pictures'),(445,'WWE Studios'),(446,'Yari Film Group');
/*!40000 ALTER TABLE `PRODUCTION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SEASON`
--

DROP TABLE IF EXISTS `SEASON`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SEASON` (
  `season_id` int(11) NOT NULL,
  `show_id` int(11) DEFAULT NULL,
  `season_num` int(11) NOT NULL,
  `season_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`season_id`),
  UNIQUE KEY `season_id` (`season_id`),
  KEY `SEASON_ibfk_1` (`show_id`),
  CONSTRAINT `SEASON_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SEASON`
--

LOCK TABLES `SEASON` WRITE;
/*!40000 ALTER TABLE `SEASON` DISABLE KEYS */;
/*!40000 ALTER TABLE `SEASON` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SUBTITLE`
--

DROP TABLE IF EXISTS `SUBTITLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUBTITLE` (
  `subtitle_id` int(11) NOT NULL,
  `show_id` int(11) DEFAULT NULL,
  `subtitles_language` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`subtitle_id`),
  UNIQUE KEY `subtitle_id` (`subtitle_id`),
  KEY `show_id` (`show_id`),
  CONSTRAINT `SUBTITLE_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `TV_SHOW` (`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SUBTITLE`
--

LOCK TABLES `SUBTITLE` WRITE;
/*!40000 ALTER TABLE `SUBTITLE` DISABLE KEYS */;
/*!40000 ALTER TABLE `SUBTITLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIMESLOT`
--

DROP TABLE IF EXISTS `TIMESLOT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIMESLOT` (
  `timeslot_id` int(11) NOT NULL,
  `episode_id` int(11) DEFAULT NULL,
  `timeslot_time` date NOT NULL,
  `timeslot_start` date GENERATED ALWAYS AS (`timeslot_time`) VIRTUAL,
  `timeslot_end` date DEFAULT NULL COMMENT 'Change this soon to be timeslot_time + tvshow.duration',
  PRIMARY KEY (`timeslot_id`),
  UNIQUE KEY `timeslot_id` (`timeslot_id`),
  UNIQUE KEY `timeslot_time` (`timeslot_time`),
  KEY `episode_id` (`episode_id`),
  CONSTRAINT `TIMESLOT_ibfk_1` FOREIGN KEY (`episode_id`) REFERENCES `EPISODE` (`episode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIMESLOT`
--

LOCK TABLES `TIMESLOT` WRITE;
/*!40000 ALTER TABLE `TIMESLOT` DISABLE KEYS */;
/*!40000 ALTER TABLE `TIMESLOT` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`%`*/ /*!50003 TRIGGER `csci2141_project`.`TIMESLOT_BEFORE_INSERT` BEFORE INSERT ON `TIMESLOT` FOR EACH ROW
BEGIN

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `TOP_RATED`
--

DROP TABLE IF EXISTS `TOP_RATED`;
/*!50001 DROP VIEW IF EXISTS `TOP_RATED`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `TOP_RATED` AS SELECT 
 1 AS `show_id`,
 1 AS `genre_id`,
 1 AS `prod_id`,
 1 AS `duration`,
 1 AS `show_language`,
 1 AS `time_slot_id`,
 1 AS `rating`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `TV_SHOW`
--

DROP TABLE IF EXISTS `TV_SHOW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TV_SHOW` (
  `show_id` int(11) NOT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `show_language` varchar(25) DEFAULT NULL,
  `time_slot_id` date DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`show_id`),
  UNIQUE KEY `show_id` (`show_id`),
  KEY `genre_id` (`genre_id`),
  KEY `prod_id` (`prod_id`),
  KEY `fk_TV_SHOW_TIMESLOT1_idx` (`time_slot_id`),
  CONSTRAINT `TV_SHOW_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `GENRE` (`genre_id`),
  CONSTRAINT `TV_SHOW_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `PRODUCTION` (`prod_id`),
  CONSTRAINT `fk_TV_SHOW_TIMESLOT1` FOREIGN KEY (`time_slot_id`) REFERENCES `TIMESLOT` (`timeslot_time`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Dumping events for database 'csci2141_project'
--

--
-- Dumping routines for database 'csci2141_project'
--

--
-- Final view structure for view `TOP_RATED`
--

/*!50001 DROP VIEW IF EXISTS `TOP_RATED`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`admin`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `TOP_RATED` AS select `TV_SHOW`.`show_id` AS `show_id`,`TV_SHOW`.`genre_id` AS `genre_id`,`TV_SHOW`.`prod_id` AS `prod_id`,`TV_SHOW`.`duration` AS `duration`,`TV_SHOW`.`show_language` AS `show_language`,`TV_SHOW`.`time_slot_id` AS `time_slot_id`,`TV_SHOW`.`rating` AS `rating` from `TV_SHOW` where (`TV_SHOW`.`rating` > 4) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-08 18:07:30
