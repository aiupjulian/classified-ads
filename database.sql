-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: classified_ads
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.16.04.1

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
-- Current Database: `classified_ads`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `classified_ads` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `classified_ads`;

--
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `description` varchar(60) NOT NULL,
  `price` int(11) NOT NULL,
  `sold` tinyint(1) DEFAULT '0',
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(60) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `subcategory_id` (`subcategory_id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `ad_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ad_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`),
  CONSTRAINT `ad_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Vehicles'),(2,'Property'),(3,'Electronics & Computers'),(4,'Home, Garden & Tools'),(5,'Hobbies & Interests'),(6,'Sports & Outdoors');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  CONSTRAINT `city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_ind` (`category_id`),
  CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,'Cars',1),(2,'Car Parts & Accessories',1),(3,'Motorcycles',1),(5,'Houses & Flats for rent',2),(6,'Houses & Flats for sale',2),(7,'Land',2),(8,'Cell Phones',3),(9,'TV, Audio & Visual',3),(10,'Computers & Laptops',3),(11,'Furniture & Decor',4),(12,'Tools',4),(13,'Garden',4),(14,'Toys, Games & Remote Control',5),(15,'Musical Instruments',5),(16,'Outdoor & Sports Equipment',6),(17,'Bicycles',6),(18,'Gym & Fitness',6);
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'aiupjulian','$2y$10$zRW89rbjsLggSlg8CghCUO1PKkNXxZMf5gnN/54bOpVK57JHGeqqW','156123456','aiupjulian@test.com','Julian Aiup',0),(2,'test','$2y$10$6jQX14yE4VSUL7l4JNU8neNVu8f7oVK/vNFrYN..sJOcwA2g8dPyK','test','test@test.com','test',0),(3,'test2','$2y$10$yd0dCmGzy1T.T4Twy5v6qe2t8HX8NkIQ4MxjqTVf9WqAXI4WjrVUa','test2','test2@test.com','test2',0),(4,'test3','$2y$10$cOI4F5EmdtkTSnzyDI9TZOxc1vbV.GZCBfezEIxXXyr7gZw30KFpi','test3','test3@test.com','test3',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-14  1:01:22
