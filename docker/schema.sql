-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: CC
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `Orders`
--
use CC;
DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `prodid` int(11) DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL,
  `createtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (1,2,1,1000,'2019-07-10 07:30:20'),(2,3,3,0,'2019-07-10 07:30:39'),(3,4,3,0,'2019-07-10 07:32:25'),(4,6,3,0,'2019-07-10 07:33:30'),(5,7,3,0,'2019-07-10 07:33:54'),(6,8,3,0,'2019-07-10 07:34:04'),(7,1,1,1000,'2019-07-10 07:35:17'),(8,1,1,1000,'2019-07-10 07:35:57');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `placeAnOrder` AFTER  INSERT ON  `Orders` 
        FOR EACH ROW BEGIN 
    update Products set inventory=inventory - 1 where id= new.prodid;
update User set money=money - new.totalPrice where id= new.userid;
        END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'flag',1000,2142309,'bug this product to get flag'),(2,'fake flag ',1,33332423,'buy this to ...'),(3,'kidding....',0,2142306,'hello');
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'VIP_FIND_MY_PHONE','wzdcd132re','13300001111',999998000),(2,'TEST_REGISTER','$2y$10$bFyHG4db7xkpGur1is8cae/s.dYqtLUnqSTvbSSGk0caYbPMf5MEq',NULL,-2000),(3,'0.49280412044247246','$2y$10$ulwmj2liJAV.7PapdTycC.dVb3VE9DFFb2J5ibY7uRWXqq8zJKHJK',NULL,0),(4,'0.778590968008891','$2y$10$RFS1S66GnAs9MahlMTqAFe9Gyvn3U5IdS85f7LzC7pfi1zj451wNC',NULL,0),(5,'0.8904803340982146','$2y$10$xhC3ZELyCRWLC1W1w.ar8OOEeINalZ0T2zvbTjXjvBoNrlTByhbIa',NULL,0),(6,'0.331187291262632','$2y$10$/3Ne87wLEcEZVDI.oyZWoOQ4ox3zm.dvrzN8XkYULx18CtnlzULWq',NULL,0),(7,'0.5153596613762649','$2y$10$dlyOc2vvIjZQcVbypbBP3uxs1qXgp.TpaAHz70k9geL.mE5Am7x4K',NULL,0),(8,'0.13388254998865723','$2y$10$J3x0E4nnum9MKQ.Q8RoC4OAT070I38kAdx4leMaqrGONUVBpkhgSy',NULL,0),(9,'0.9579889737367355','$2y$10$itT9E.DGFUYjGyaMKVO39OFerviAmgp1SVi1V/EABAtr7nac9E6w2',NULL,0),(10,'0.006376489016409637','$2y$10$0AQpiZO4wHpz39A1YcEOi.Cn1Y518PzUZimY7UAmh3YkwytsBGRqG',NULL,0),(11,'0.040932858233977965','$2y$10$ZX9G5HDhex67TIhMVyiXAeaZX2lZwOXnTvBl3VgW9VIDvcN18TTDC',NULL,0),(12,'0.12157530054921095','$2y$10$k7XxEiVBo1F42d/Ep3mPMuWKFMMXlxErVzM3CjPEVGkFA6d1dzcDq',NULL,0);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

    DELIMITER $$ 
    DROP TRIGGER IF EXISTS `placeAnOrder`$$ 
    CREATE 
        TRIGGER `placeAnOrder` AFTER  INSERT ON  `Orders` 
        FOR EACH ROW BEGIN 
    update Products set inventory=inventory - 1 where id= new.prodid;
	update User set money=money - new.totalPrice where id= new.userid;
        END$$ 
    DELIMITER ; 


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-10  7:36:49
