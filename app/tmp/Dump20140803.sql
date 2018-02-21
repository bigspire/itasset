CREATE DATABASE  IF NOT EXISTS `ceo_apps` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ceo_apps`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: ceo_apps
-- ------------------------------------------------------
-- Server version	5.1.37

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
-- Table structure for table `app_approval`
--

DROP TABLE IF EXISTS `app_approval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_approval` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level1` int(10) unsigned NOT NULL,
  `level2` int(10) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `type` enum('E','A','T','L') NOT NULL COMMENT 'E - Expense Approval\nA - Advance Approval\nT - Task Approval\nL - Leave Approval',
  `auth_amount_l1` float DEFAULT NULL,
  `auth_amount_l2` float DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_app_approval_hr_users` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_approval`
--

LOCK TABLES `app_approval` WRITE;
/*!40000 ALTER TABLE `app_approval` DISABLE KEYS */;
INSERT INTO `app_approval` VALUES (1,7,10,'2014-02-22 12:05:09',NULL,'A',NULL,NULL,1),(2,7,10,'2014-02-22 12:06:53',NULL,'A',NULL,NULL,2),(3,7,10,'2014-02-22 12:07:09',NULL,'A',NULL,NULL,3),(4,19,10,'2014-02-22 12:07:26',NULL,'A',NULL,NULL,4),(5,25,10,'2014-02-22 12:07:44',NULL,'A',NULL,NULL,5),(6,7,10,'2014-02-22 12:08:00',NULL,'A',NULL,NULL,6),(7,10,NULL,'2014-02-22 12:08:15',NULL,'A',NULL,NULL,7),(8,25,10,'2014-02-22 12:08:35',NULL,'A',NULL,NULL,8),(9,10,NULL,'2014-02-22 12:08:46',NULL,'A',NULL,NULL,9),(10,17,10,'2014-02-22 12:09:09',NULL,'A',NULL,NULL,11),(11,19,10,'2014-02-22 12:09:29',NULL,'A',NULL,NULL,12),(12,25,10,'2014-02-22 12:09:46',NULL,'A',NULL,NULL,13),(13,19,10,'2014-02-22 12:10:12',NULL,'A',NULL,NULL,14),(14,10,NULL,'2014-02-22 12:10:25',NULL,'A',NULL,NULL,15),(15,15,10,'2014-02-22 12:10:41',NULL,'A',NULL,NULL,16),(16,10,NULL,'2014-02-22 12:10:51',NULL,'A',NULL,NULL,17),(17,25,10,'2014-02-22 12:11:07',NULL,'A',NULL,NULL,18),(18,10,NULL,'2014-02-22 12:11:18',NULL,'A',NULL,NULL,19),(19,25,10,'2014-02-22 12:11:40',NULL,'A',NULL,NULL,20),(20,10,NULL,'2014-02-22 12:11:51',NULL,'A',NULL,NULL,21),(21,10,NULL,'2014-02-22 12:12:01',NULL,'A',NULL,NULL,22),(22,7,10,'2014-02-22 12:12:20',NULL,'A',NULL,NULL,23),(23,19,10,'2014-02-22 12:12:37',NULL,'A',NULL,NULL,24),(24,10,NULL,'2014-02-22 12:12:49',NULL,'A',NULL,NULL,25),(25,19,10,'2014-02-22 12:13:03',NULL,'A',NULL,NULL,26),(26,7,10,'2014-02-22 12:13:17',NULL,'A',NULL,NULL,27),(27,25,10,'2014-02-22 12:13:32',NULL,'A',NULL,NULL,28),(28,25,10,'2014-02-22 12:13:49',NULL,'A',NULL,NULL,29),(29,15,10,'2014-02-22 12:14:03','2014-02-28 18:11:01','A',NULL,NULL,30),(30,25,10,'2014-02-22 12:14:19',NULL,'A',NULL,NULL,31),(31,7,10,'2014-02-22 12:14:34',NULL,'A',NULL,NULL,32),(32,19,10,'2014-02-22 12:14:50',NULL,'A',NULL,NULL,33),(33,25,10,'2014-02-22 12:15:14','2014-02-28 18:11:30','A',NULL,NULL,34),(36,7,10,'2014-02-22 12:05:09',NULL,'E',NULL,NULL,1),(37,7,10,'2014-02-22 12:06:53',NULL,'E',NULL,NULL,2),(38,7,10,'2014-02-22 12:07:09',NULL,'E',NULL,NULL,3),(39,19,10,'2014-02-22 12:07:26',NULL,'E',NULL,NULL,4),(40,25,10,'2014-02-22 12:07:44',NULL,'E',NULL,NULL,5),(41,7,10,'2014-02-22 12:08:00',NULL,'E',NULL,NULL,6),(42,10,NULL,'2014-02-22 12:08:15',NULL,'E',NULL,NULL,7),(43,25,10,'2014-02-22 12:08:35',NULL,'E',NULL,NULL,8),(44,10,NULL,'2014-02-22 12:08:46',NULL,'E',NULL,NULL,9),(45,17,10,'2014-02-22 12:09:09',NULL,'E',NULL,NULL,11),(46,19,10,'2014-02-22 12:09:29',NULL,'E',NULL,NULL,12),(47,25,10,'2014-02-22 12:09:46',NULL,'E',NULL,NULL,13),(48,19,10,'2014-02-22 12:10:12',NULL,'E',NULL,NULL,14),(49,10,NULL,'2014-02-22 12:10:25',NULL,'E',NULL,NULL,15),(50,15,10,'2014-02-22 12:10:41',NULL,'E',NULL,NULL,16),(51,10,NULL,'2014-02-22 12:10:51',NULL,'E',NULL,NULL,17),(52,25,10,'2014-02-22 12:11:07',NULL,'E',NULL,NULL,18),(53,10,NULL,'2014-02-22 12:11:18',NULL,'E',NULL,NULL,19),(54,25,10,'2014-02-22 12:11:40',NULL,'E',NULL,NULL,20),(55,10,NULL,'2014-02-22 12:11:51',NULL,'E',NULL,NULL,21),(56,10,NULL,'2014-02-22 12:12:01',NULL,'E',NULL,NULL,22),(57,7,10,'2014-02-22 12:12:20',NULL,'E',NULL,NULL,23),(58,19,10,'2014-02-22 12:12:37',NULL,'E',NULL,NULL,24),(59,10,NULL,'2014-02-22 12:12:49',NULL,'E',NULL,NULL,25),(60,19,10,'2014-02-22 12:13:03',NULL,'E',NULL,NULL,26),(61,7,10,'2014-02-22 12:13:17',NULL,'E',NULL,NULL,27),(62,25,10,'2014-02-22 12:13:32',NULL,'E',NULL,NULL,28),(63,25,10,'2014-02-22 12:13:49',NULL,'E',NULL,NULL,29),(64,15,10,'2014-02-22 12:14:03','2014-02-28 18:08:08','E',NULL,NULL,30),(65,25,10,'2014-02-22 12:14:19',NULL,'E',NULL,NULL,31),(66,7,10,'2014-02-22 12:14:34',NULL,'E',NULL,NULL,32),(67,19,10,'2014-02-22 12:14:50',NULL,'E',NULL,NULL,33),(68,25,10,'2014-02-22 12:15:14',NULL,'E',NULL,NULL,34),(69,7,10,'2014-02-22 12:05:09',NULL,'L',NULL,NULL,1),(70,7,10,'2014-02-22 12:06:53',NULL,'L',NULL,NULL,2),(71,7,10,'2014-02-22 12:07:09',NULL,'L',NULL,NULL,3),(72,19,10,'2014-02-22 12:07:26',NULL,'L',NULL,NULL,4),(73,25,10,'2014-02-22 12:07:44',NULL,'L',NULL,NULL,5),(74,7,10,'2014-02-22 12:08:00',NULL,'L',NULL,NULL,6),(75,10,NULL,'2014-02-22 12:08:15',NULL,'L',NULL,NULL,7),(76,25,10,'2014-02-22 12:08:35',NULL,'L',NULL,NULL,8),(77,10,NULL,'2014-02-22 12:08:46',NULL,'L',NULL,NULL,9),(78,17,10,'2014-02-22 12:09:09',NULL,'L',NULL,NULL,11),(79,19,10,'2014-02-22 12:09:29',NULL,'L',NULL,NULL,12),(80,25,10,'2014-02-22 12:09:46',NULL,'L',NULL,NULL,13),(81,19,10,'2014-02-22 12:10:12',NULL,'L',NULL,NULL,14),(82,10,NULL,'2014-02-22 12:10:25',NULL,'L',NULL,NULL,15),(83,15,10,'2014-02-22 12:10:41',NULL,'L',NULL,NULL,16),(84,10,NULL,'2014-02-22 12:10:51',NULL,'L',NULL,NULL,17),(85,25,10,'2014-02-22 12:11:07',NULL,'L',NULL,NULL,18),(86,10,NULL,'2014-02-22 12:11:18',NULL,'L',NULL,NULL,19),(87,25,10,'2014-02-22 12:11:40',NULL,'L',NULL,NULL,20),(88,10,NULL,'2014-02-22 12:11:51',NULL,'L',NULL,NULL,21),(89,10,NULL,'2014-02-22 12:12:01',NULL,'L',NULL,NULL,22),(90,7,10,'2014-02-22 12:12:20',NULL,'L',NULL,NULL,23),(91,19,10,'2014-02-22 12:12:37',NULL,'L',NULL,NULL,24),(92,10,NULL,'2014-02-22 12:12:49',NULL,'L',NULL,NULL,25),(93,19,10,'2014-02-22 12:13:03',NULL,'L',NULL,NULL,26),(94,7,10,'2014-02-22 12:13:17',NULL,'L',NULL,NULL,27),(95,25,10,'2014-02-22 12:13:32',NULL,'L',NULL,NULL,28),(96,25,10,'2014-02-22 12:13:49',NULL,'L',NULL,NULL,29),(97,15,10,'2014-02-22 12:14:03','2014-02-28 18:08:08','L',NULL,NULL,30),(98,25,10,'2014-02-22 12:14:19',NULL,'L',NULL,NULL,31),(99,7,10,'2014-02-22 12:14:34',NULL,'L',NULL,NULL,32),(100,19,10,'2014-02-22 12:14:50',NULL,'L',NULL,NULL,33),(101,25,10,'2014-02-22 12:15:14','2014-04-18 11:28:32','L',NULL,NULL,34),(103,19,NULL,'2014-05-02 20:34:23',NULL,'L',NULL,NULL,10),(104,17,NULL,'2014-05-04 21:13:21',NULL,'A',NULL,NULL,10),(105,17,NULL,'2014-05-04 21:13:31',NULL,'E',NULL,NULL,10),(106,10,NULL,'2014-06-08 16:11:08','2014-07-23 17:55:43','T',NULL,NULL,19),(107,19,NULL,'2014-07-23 17:56:48',NULL,'T',NULL,NULL,12),(108,10,NULL,'2014-07-25 11:20:44',NULL,'T',NULL,NULL,15),(109,16,NULL,'2014-08-03 11:00:46','2014-08-03 11:01:35','T',NULL,NULL,10);
/*!40000 ALTER TABLE `app_approval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_modules`
--

DROP TABLE IF EXISTS `app_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_modules` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'A - Active\nI - Inactive',
  `priority` tinyint(4) NOT NULL,
  `type` enum('H','T','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_modules`
--

LOCK TABLES `app_modules` WRITE;
/*!40000 ALTER TABLE `app_modules` DISABLE KEYS */;
INSERT INTO `app_modules` VALUES (1,'Advance','A',1,'F'),(2,'Approve Advance','A',2,'F'),(3,'Expense','A',4,'F'),(4,'Approve Expense','A',5,'F'),(5,'Settings - Advance Approver','A',16,'F'),(7,'Advance - Pay Amount','A',3,'F'),(8,'Advance - Reports','I',22,'F'),(9,'Projects','A',10,'F'),(10,'Project Contacts','A',9,'F'),(11,'Customers','A',8,'F'),(12,'Expense - Pay Amount','A',6,'F'),(13,'Expense - Discrepancy','A',7,'F'),(14,'Expense - Reports','I',23,'F'),(15,'Company','A',11,'H'),(16,'Employee','A',12,'H'),(17,'Grade','I',13,'H'),(18,'Department','A',14,'H'),(19,'Designation','A',15,'H'),(20,'Settings - Expense Approver','A',17,'F'),(21,'Settings - Role Access','A',18,'F'),(22,'Expense Limit','I',19,'F'),(23,'Expense Category','A',20,'F'),(24,'Employee Email','A',21,'F'),(25,'Leave','A',1,'H'),(26,'Approve Leave','A',2,'H'),(27,'Permission','A',3,'H'),(28,'Approve Permission','A',4,'H'),(29,'Report - Leave','I',5,'H'),(30,'Report - Permission','I',6,'H'),(31,'Settings - Leave Approver','A',7,'H'),(32,'Settings - Role Access','A',8,'H'),(33,'Attendance','A',16,'H'),(34,'Forms','A',17,'H'),(35,'Latest Updates','A',18,'H'),(36,'Org. Updates','A',19,'H'),(37,'Holiday','A',20,'H'),(38,'My Payslips','A',21,'H'),(39,'Upload Payslip','A',22,'H'),(40,'Bank Account','A',23,'H'),(41,'Branch','I',11,'H'),(42,'Bank','A',24,'H'),(43,'Gallery','A',25,'H'),(44,'Approve Gallery','A',26,'H'),(45,'Attendance Change','A',16,'H'),(46,'Approve Profile Change','A',18,'H'),(47,'Approve Attendance Change','A',17,'H'),(48,'Poll','A',21,'H'),(49,'Branch','A',11,'H'),(50,'File','A',17,'H'),(51,'Business Unit','A',11,'H'),(52,'Office Timing','A',12,'H'),(53,'Leave Details','I',12,'H'),(54,'Settings - Role','A',7,'T'),(55,'Settings - Leave Approver','A',8,'T'),(56,'Settings - Task Types','A',9,'T'),(57,'My Task Plan','A',1,'T'),(58,'Team Task Plan','A',2,'T'),(59,'My Events','A',5,'T'),(60,'My Files','A',7,'T'),(61,'My Assigned Task','A',3,'T'),(62,'Team Assigned Task','A',4,'T'),(63,'Settings - Event Type','A',6,'T'),(64,'Team Reports','A',27,'H'),(65,'Team Reports','A',24,'F'),(66,'Company Reports','A',28,'H'),(67,'Company Reports','A',25,'F');
/*!40000 ALTER TABLE `app_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_notification`
--

DROP TABLE IF EXISTS `app_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notify` enum('I','N','V','G') NOT NULL COMMENT 'I - Interact\nN - News\nV - Voice\nG- Gallery',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_app_todo_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_notification`
--

LOCK TABLES `app_notification` WRITE;
/*!40000 ALTER TABLE `app_notification` DISABLE KEYS */;
INSERT INTO `app_notification` VALUES (1,'I','2014-04-16 11:22:43',NULL,1),(2,'N','2014-04-16 11:22:43',NULL,1),(3,'V','2014-04-16 11:22:43',NULL,1),(4,'G','2014-04-16 11:22:43',NULL,1),(5,'I','2014-04-16 11:22:43',NULL,2),(6,'N','2014-04-16 11:22:43',NULL,2),(7,'V','2014-04-16 11:22:43',NULL,2),(8,'G','2014-04-16 11:22:43',NULL,2),(9,'I','2014-04-16 11:22:43',NULL,3),(10,'N','2014-04-16 11:22:43',NULL,3),(11,'V','2014-04-16 11:22:43',NULL,3),(12,'G','2014-04-16 11:22:43',NULL,3),(13,'I','2014-04-16 11:22:43',NULL,4),(14,'N','2014-04-16 11:22:43',NULL,4),(15,'V','2014-04-16 11:22:43',NULL,4),(16,'G','2014-04-16 11:22:43',NULL,4),(17,'I','2014-04-16 11:22:43','2014-07-21 17:29:52',5),(18,'N','2014-04-16 11:22:43','2014-07-26 12:30:55',5),(19,'V','2014-04-16 11:22:43','2014-07-15 17:31:11',5),(20,'G','2014-04-16 11:22:43','2014-07-15 17:31:13',5),(21,'I','2014-04-16 11:22:43',NULL,6),(22,'N','2014-04-16 11:22:43',NULL,6),(23,'V','2014-04-16 11:22:43',NULL,6),(24,'G','2014-04-16 11:22:43',NULL,6),(25,'I','2014-04-16 11:22:43','2014-07-22 16:40:29',7),(26,'N','2014-04-16 11:22:43','2014-07-26 19:32:48',7),(27,'V','2014-04-16 11:22:43','2014-06-24 13:01:41',7),(28,'G','2014-04-16 11:22:43','2014-04-17 18:40:56',7),(29,'I','2014-04-16 11:22:43',NULL,8),(30,'N','2014-04-16 11:22:43',NULL,8),(31,'V','2014-04-16 11:22:43',NULL,8),(32,'G','2014-04-16 11:22:43',NULL,8),(33,'I','2014-04-16 11:22:43',NULL,9),(34,'N','2014-04-16 11:22:43',NULL,9),(35,'V','2014-04-16 11:22:43',NULL,9),(36,'G','2014-04-16 11:22:43',NULL,9),(37,'I','2014-04-16 11:22:43','2014-07-05 10:31:37',10),(38,'N','2014-04-16 11:22:43','2014-07-23 20:08:33',10),(39,'V','2014-04-16 11:22:43','2014-04-26 15:54:36',10),(40,'G','2014-04-16 11:22:43','2014-07-24 10:09:25',10),(41,'I','2014-04-16 11:22:43','2014-07-24 14:11:58',11),(42,'N','2014-04-16 11:22:43','2014-07-31 11:49:58',11),(43,'V','2014-04-16 11:22:43','2014-04-29 12:44:34',11),(44,'G','2014-04-16 11:22:43','2014-07-24 17:59:05',11),(45,'I','2014-04-16 11:22:43',NULL,12),(46,'N','2014-04-16 11:22:43',NULL,12),(47,'V','2014-04-16 11:22:43',NULL,12),(48,'G','2014-04-16 11:22:43',NULL,12),(49,'I','2014-04-16 11:22:43',NULL,13),(50,'N','2014-04-16 11:22:43',NULL,13),(51,'V','2014-04-16 11:22:43',NULL,13),(52,'G','2014-04-16 11:22:43',NULL,13),(53,'I','2014-04-16 11:22:43',NULL,14),(54,'N','2014-04-16 11:22:43',NULL,14),(55,'V','2014-04-16 11:22:43',NULL,14),(56,'G','2014-04-16 11:22:43',NULL,14),(57,'I','2014-04-16 11:22:43','2014-07-23 10:09:43',15),(58,'N','2014-04-16 11:22:43','2014-07-25 10:59:29',15),(59,'V','2014-04-16 11:22:43','2014-07-23 10:09:40',15),(60,'G','2014-04-16 11:22:43','2014-07-23 10:09:44',15),(61,'I','2014-04-16 11:22:43','2014-07-23 10:17:44',16),(62,'N','2014-04-16 11:22:43','2014-07-23 10:17:42',16),(63,'V','2014-04-16 11:22:43','2014-07-23 10:17:37',16),(64,'G','2014-04-16 11:22:43','2014-07-23 10:17:47',16),(65,'I','2014-04-16 11:22:43','2014-07-22 17:20:06',17),(66,'N','2014-04-16 11:22:43','0000-00-00 00:00:00',17),(67,'V','2014-04-16 11:22:43','2014-05-20 17:49:51',17),(68,'G','2014-04-16 11:22:43','2014-04-17 18:01:16',17),(69,'I','2014-04-16 11:22:43',NULL,18),(70,'N','2014-04-16 11:22:43',NULL,18),(71,'V','2014-04-16 11:22:43',NULL,18),(72,'G','2014-04-16 11:22:43',NULL,18),(73,'I','2014-04-16 11:22:43','2014-07-23 12:53:41',19),(74,'N','2014-04-16 11:22:43','2014-07-23 13:32:22',19),(75,'V','2014-04-16 11:22:43','2014-05-20 11:59:36',19),(76,'G','2014-04-16 11:22:43','2014-07-23 11:15:56',19),(77,'I','2014-04-16 11:22:43',NULL,20),(78,'N','2014-04-16 11:22:43',NULL,20),(79,'V','2014-04-16 11:22:43',NULL,20),(80,'G','2014-04-16 11:22:43',NULL,20),(81,'I','2014-04-16 11:22:43','2014-05-23 12:23:32',21),(82,'N','2014-04-16 11:22:43','2014-05-23 12:23:31',21),(83,'V','2014-04-16 11:22:43','2014-05-23 11:35:44',21),(84,'G','2014-04-16 11:22:43','2014-05-23 16:31:16',21),(85,'I','2014-04-16 11:22:43',NULL,22),(86,'N','2014-04-16 11:22:43',NULL,22),(87,'V','2014-04-16 11:22:43',NULL,22),(88,'G','2014-04-16 11:22:43',NULL,22),(89,'I','2014-04-16 11:22:43',NULL,23),(90,'N','2014-04-16 11:22:43',NULL,23),(91,'V','2014-04-16 11:22:43',NULL,23),(92,'G','2014-04-16 11:22:43',NULL,23),(93,'I','2014-04-16 11:22:43',NULL,24),(94,'N','2014-04-16 11:22:43',NULL,24),(95,'V','2014-04-16 11:22:43',NULL,24),(96,'G','2014-04-16 11:22:43',NULL,24),(97,'I','2014-04-16 11:22:43','2014-04-29 18:28:13',25),(98,'N','2014-04-16 11:22:43','2014-04-29 18:28:13',25),(99,'V','2014-04-16 11:22:43','2014-04-29 18:28:13',25),(100,'G','2014-04-16 11:22:43','2014-04-29 18:28:15',25),(101,'I','2014-04-16 11:22:43',NULL,26),(102,'N','2014-04-16 11:22:43',NULL,26),(103,'V','2014-04-16 11:22:43',NULL,26),(104,'G','2014-04-16 11:22:43',NULL,26),(105,'I','2014-04-16 11:22:43','2014-07-31 17:34:07',27),(106,'N','2014-04-16 11:22:43','2014-07-31 17:34:06',27),(107,'V','2014-04-16 11:22:43','2014-07-31 17:34:05',27),(108,'G','2014-04-16 11:22:43',NULL,27),(109,'I','2014-04-16 11:22:43',NULL,28),(110,'N','2014-04-16 11:22:43',NULL,28),(111,'V','2014-04-16 11:22:43',NULL,28),(112,'G','2014-04-16 11:22:43',NULL,28),(113,'I','2014-04-16 11:22:43',NULL,29),(114,'N','2014-04-16 11:22:43',NULL,29),(115,'V','2014-04-16 11:22:43',NULL,29),(116,'G','2014-04-16 11:22:43',NULL,29),(117,'I','2014-04-16 11:22:43',NULL,30),(118,'N','2014-04-16 11:22:43',NULL,30),(119,'V','2014-04-16 11:22:43',NULL,30),(120,'G','2014-04-16 11:22:43',NULL,30),(121,'I','2014-04-16 11:22:43',NULL,31),(122,'N','2014-04-16 11:22:43',NULL,31),(123,'V','2014-04-16 11:22:43',NULL,31),(124,'G','2014-04-16 11:22:43',NULL,31),(125,'I','2014-04-16 11:22:43',NULL,32),(126,'N','2014-04-16 11:22:43',NULL,32),(127,'V','2014-04-16 11:22:43',NULL,32),(128,'G','2014-04-16 11:22:43',NULL,32),(129,'I','2014-04-16 11:22:43',NULL,33),(130,'N','2014-04-16 11:22:43',NULL,33),(131,'V','2014-04-16 11:22:43',NULL,33),(132,'G','2014-04-16 11:22:43',NULL,33),(133,'I','2014-04-16 11:22:43','2014-06-02 06:43:09',34),(134,'N','2014-04-16 11:22:43',NULL,34),(135,'V','2014-04-16 11:22:43',NULL,34),(136,'G','2014-04-16 11:22:43',NULL,34),(137,'I','2014-04-16 11:22:43',NULL,35),(138,'N','2014-04-16 11:22:43',NULL,35),(139,'V','2014-04-16 11:22:43',NULL,35),(140,'G','2014-04-16 11:22:43',NULL,35),(141,'I','2014-04-16 11:22:43','2014-04-17 10:43:17',40),(142,'N','2014-04-16 11:22:43','2014-04-17 12:04:59',40),(143,'V','2014-04-16 11:22:43','2014-04-17 12:04:59',40),(144,'G','2014-04-16 11:22:43','2014-04-17 12:05:00',40),(145,'I','2014-04-16 12:29:41',NULL,41),(146,'N','2014-04-16 12:29:41',NULL,41),(147,'V','2014-04-16 12:29:41',NULL,41),(148,'G','2014-04-16 12:29:41',NULL,41),(149,'I','2014-04-16 12:32:31',NULL,42),(150,'N','2014-04-16 12:32:31',NULL,42),(151,'V','2014-04-16 12:32:31',NULL,42),(152,'G','2014-04-16 12:32:31',NULL,42),(153,'I','2014-04-16 12:46:07',NULL,43),(154,'N','2014-04-16 12:46:07',NULL,43),(155,'V','2014-04-16 12:46:07',NULL,43),(156,'G','2014-04-16 12:46:07',NULL,43),(157,'I','2014-04-16 12:46:35',NULL,44),(158,'N','2014-04-16 12:46:35',NULL,44),(159,'V','2014-04-16 12:46:35',NULL,44),(160,'G','2014-04-16 12:46:35',NULL,44),(161,'I','2014-04-16 12:47:39',NULL,45),(162,'N','2014-04-16 12:47:39',NULL,45),(163,'V','2014-04-16 12:47:39',NULL,45),(164,'G','2014-04-16 12:47:39',NULL,45),(165,'I','2014-04-16 12:48:16',NULL,46),(166,'N','2014-04-16 12:48:16',NULL,46),(167,'V','2014-04-16 12:48:16',NULL,46),(168,'G','2014-04-16 12:48:16',NULL,46),(169,'I','2014-04-16 12:48:41',NULL,47),(170,'N','2014-04-16 12:48:41',NULL,47),(171,'V','2014-04-16 12:48:41',NULL,47),(172,'G','2014-04-16 12:48:41',NULL,47),(173,'I','2014-04-16 12:49:16',NULL,48),(174,'N','2014-04-16 12:49:16',NULL,48),(175,'V','2014-04-16 12:49:16',NULL,48),(176,'G','2014-04-16 12:49:16',NULL,48),(177,'I','2014-04-16 12:49:50',NULL,49),(178,'N','2014-04-16 12:49:50',NULL,49),(179,'V','2014-04-16 12:49:50',NULL,49),(180,'G','2014-04-16 12:49:50',NULL,49),(181,'I','2014-04-16 12:50:05',NULL,50),(182,'N','2014-04-16 12:50:05',NULL,50),(183,'V','2014-04-16 12:50:05',NULL,50),(184,'G','2014-04-16 12:50:05',NULL,50),(185,'I','2014-04-16 12:50:51',NULL,51),(186,'N','2014-04-16 12:50:51',NULL,51),(187,'V','2014-04-16 12:50:51',NULL,51),(188,'G','2014-04-16 12:50:51',NULL,51),(189,'I','2014-04-16 12:51:31',NULL,52),(190,'N','2014-04-16 12:51:31',NULL,52),(191,'V','2014-04-16 12:51:31',NULL,52),(192,'G','2014-04-16 12:51:31',NULL,52),(193,'I','2014-04-16 12:51:50',NULL,53),(194,'N','2014-04-16 12:51:50',NULL,53),(195,'V','2014-04-16 12:51:50',NULL,53),(196,'G','2014-04-16 12:51:50',NULL,53),(197,'I','2014-04-29 17:07:28','2014-06-25 10:05:27',54),(198,'N','2014-04-29 17:07:28','2014-05-27 06:50:56',54),(199,'V','2014-04-29 17:07:28','2014-05-27 06:50:56',54),(200,'G','2014-04-29 17:07:28','2014-05-27 06:50:58',54),(201,'I','2014-05-17 12:32:14',NULL,56),(202,'N','2014-05-17 12:32:14',NULL,56),(203,'V','2014-05-17 12:32:14',NULL,56),(204,'G','2014-05-17 12:32:14',NULL,56);
/*!40000 ALTER TABLE `app_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_permissions`
--

DROP TABLE IF EXISTS `app_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `app_modules_id` tinyint(3) unsigned NOT NULL,
  `app_roles_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_permissions_fin_modules1` (`app_modules_id`),
  KEY `fk_fin_permissions_fin_roles1` (`app_roles_id`)
) ENGINE=MyISAM AUTO_INCREMENT=764 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_permissions`
--

LOCK TABLES `app_permissions` WRITE;
/*!40000 ALTER TABLE `app_permissions` DISABLE KEYS */;
INSERT INTO `app_permissions` VALUES (721,'2014-07-11 21:10:24',40,1,17),(695,'2014-06-29 16:31:29',67,1,17),(694,'2014-06-29 16:31:29',65,1,17),(693,'2014-06-29 16:31:29',24,1,17),(692,'2014-06-29 16:31:29',23,1,17),(691,'2014-06-29 16:31:29',21,1,17),(690,'2014-06-29 16:31:29',20,1,17),(689,'2014-06-29 16:31:29',5,1,17),(688,'2014-06-29 16:31:29',9,1,17),(687,'2014-06-29 16:31:29',10,1,17),(720,'2014-07-11 21:10:24',39,1,17),(719,'2014-07-11 21:10:24',38,1,17),(718,'2014-07-11 21:10:24',48,1,17),(717,'2014-07-11 21:10:24',37,1,17),(716,'2014-07-11 21:10:24',36,1,17),(686,'2014-06-29 16:31:29',11,1,17),(685,'2014-06-29 16:31:29',13,1,17),(684,'2014-06-29 16:31:29',12,1,17),(683,'2014-06-29 16:31:29',4,1,17),(682,'2014-06-29 16:31:29',3,1,17),(681,'2014-06-29 16:31:29',7,1,17),(680,'2014-06-29 16:31:29',2,1,17),(679,'2014-06-29 16:31:29',1,1,17),(50,'2014-02-20 18:21:22',3,2,6),(49,'2014-02-20 18:21:22',1,2,6),(77,'2014-03-02 13:00:53',13,10,17),(76,'2014-03-02 13:00:53',12,10,17),(75,'2014-03-02 13:00:53',4,10,17),(647,'2014-06-27 09:52:24',43,9,19),(646,'2014-06-27 09:52:24',47,9,19),(645,'2014-06-27 09:52:24',45,9,19),(644,'2014-06-27 09:52:24',28,9,19),(51,'2014-02-20 18:21:22',13,2,6),(74,'2014-03-02 13:00:53',3,10,17),(73,'2014-03-02 13:00:53',7,10,17),(72,'2014-03-02 13:00:53',2,10,17),(71,'2014-03-02 13:00:53',1,10,17),(284,'2014-04-12 12:25:09',31,10,17),(283,'2014-04-12 12:25:09',27,10,17),(282,'2014-04-12 12:25:09',25,10,17),(715,'2014-07-11 21:10:24',46,1,17),(714,'2014-07-11 21:10:24',35,1,17),(713,'2014-07-11 21:10:24',34,1,17),(712,'2014-07-11 21:10:24',50,1,17),(711,'2014-07-11 21:10:24',47,1,17),(710,'2014-07-11 21:10:24',45,1,17),(106,'2014-03-27 17:07:56',3,9,17),(105,'2014-03-27 17:07:56',2,9,17),(107,'2014-03-27 17:07:56',4,9,17),(104,'2014-03-27 17:07:56',1,9,17),(108,'2014-03-27 17:07:56',13,9,17),(709,'2014-07-11 21:10:24',33,1,17),(708,'2014-07-11 21:10:24',19,1,17),(707,'2014-07-11 21:10:24',18,1,17),(706,'2014-07-11 21:10:24',52,1,17),(705,'2014-07-11 21:10:24',16,1,17),(704,'2014-07-11 21:10:24',51,1,17),(703,'2014-07-11 21:10:24',15,1,17),(702,'2014-07-11 21:10:24',49,1,17),(701,'2014-07-11 21:10:24',32,1,17),(700,'2014-07-11 21:10:24',31,1,17),(259,'2014-04-12 12:24:32',45,2,17),(258,'2014-04-12 12:24:32',27,2,17),(257,'2014-04-12 12:24:32',25,2,17),(756,'2014-07-20 12:10:10',64,16,19),(755,'2014-07-20 12:10:10',44,16,19),(754,'2014-07-20 12:10:10',43,16,19),(753,'2014-07-20 12:10:10',42,16,19),(752,'2014-07-20 12:10:10',40,16,19),(751,'2014-07-20 12:10:10',39,16,19),(750,'2014-07-20 12:10:10',38,16,19),(749,'2014-07-20 12:10:10',48,16,19),(748,'2014-07-20 12:10:10',37,16,19),(747,'2014-07-20 12:10:10',36,16,19),(746,'2014-07-20 12:10:10',46,16,19),(745,'2014-07-20 12:10:10',35,16,19),(744,'2014-07-20 12:10:10',34,16,19),(743,'2014-07-20 12:10:10',50,16,19),(742,'2014-07-20 12:10:10',47,16,19),(741,'2014-07-20 12:10:10',45,16,19),(740,'2014-07-20 12:10:10',33,16,19),(739,'2014-07-20 12:10:10',19,16,19),(738,'2014-07-20 12:10:10',18,16,19),(643,'2014-06-27 09:52:24',27,9,19),(260,'2014-04-12 12:24:32',43,2,17),(737,'2014-07-20 12:10:10',52,16,19),(736,'2014-07-20 12:10:10',16,16,19),(285,'2014-04-12 12:25:09',45,10,17),(642,'2014-06-27 09:52:24',26,9,19),(699,'2014-07-11 21:10:24',28,1,17),(698,'2014-07-11 21:10:24',27,1,17),(697,'2014-07-11 21:10:24',26,1,17),(696,'2014-07-11 21:10:24',25,1,17),(735,'2014-07-20 12:10:10',51,16,19),(734,'2014-07-20 12:10:10',15,16,19),(733,'2014-07-20 12:10:10',49,16,19),(609,'2014-06-19 17:04:05',3,16,17),(608,'2014-06-19 17:04:05',2,16,17),(607,'2014-06-19 17:04:05',1,16,17),(641,'2014-06-27 09:52:24',25,9,19),(732,'2014-07-20 12:10:10',32,16,19),(731,'2014-07-20 12:10:10',31,16,19),(730,'2014-07-20 12:10:10',28,16,19),(729,'2014-07-20 12:10:10',27,16,19),(728,'2014-07-20 12:10:10',26,16,19),(601,'2014-06-09 18:38:42',55,16,19),(568,'0000-00-00 00:00:00',0,1,0),(600,'2014-06-09 18:38:42',54,16,19),(599,'2014-06-09 18:38:42',60,16,19),(598,'2014-06-09 18:38:42',63,16,19),(597,'2014-06-09 18:38:42',59,16,19),(596,'2014-06-09 18:38:42',62,16,19),(595,'2014-06-09 18:38:42',61,16,19),(594,'2014-06-09 18:38:42',58,16,19),(593,'2014-06-09 18:38:42',57,16,19),(602,'2014-06-09 18:38:42',56,16,19),(603,'2014-06-10 18:40:05',57,2,19),(604,'2014-06-10 18:40:05',61,2,19),(605,'2014-06-10 18:40:05',59,2,19),(606,'2014-06-10 18:40:05',60,2,19),(610,'2014-06-19 17:04:05',4,16,17),(611,'2014-06-19 17:04:05',13,16,17),(648,'2014-06-27 09:52:24',64,9,19),(727,'2014-07-20 12:10:10',25,16,19),(722,'2014-07-11 21:10:24',42,1,17),(723,'2014-07-11 21:10:24',43,1,17),(724,'2014-07-11 21:10:24',44,1,17),(725,'2014-07-11 21:10:24',64,1,17),(726,'2014-07-11 21:10:24',66,1,17),(757,'2014-07-20 12:10:10',66,16,19),(758,'2014-07-21 15:15:06',57,9,19),(759,'2014-07-21 15:15:06',58,9,19),(760,'2014-07-21 15:15:06',61,9,19),(761,'2014-07-21 15:15:06',62,9,19),(762,'2014-07-21 15:15:06',59,9,19),(763,'2014-07-21 15:15:06',60,9,19);
/*!40000 ALTER TABLE `app_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_roles`
--

DROP TABLE IF EXISTS `app_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL,
  `role_desc` varchar(45) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `is_deleted` enum('N','Y') NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_roles`
--

LOCK TABLES `app_roles` WRITE;
/*!40000 ALTER TABLE `app_roles` DISABLE KEYS */;
INSERT INTO `app_roles` VALUES (1,'Administrator','','2014-01-29 00:00:00','2014-07-11 21:10:24','1','N',0,17),(2,'Employee','','2014-01-29 00:00:00','2014-06-10 18:40:05','1','N',0,19),(3,'Approver ',NULL,'2014-01-29 00:00:00','2014-02-22 10:12:32','1','Y',0,6),(4,'My First Role','test roles','2014-02-05 12:43:55','2014-02-05 12:53:34','1','Y',6,6),(5,'test role2','test','2014-02-06 16:52:20','2014-02-06 16:58:42','1','Y',6,6),(6,'advance approver','test','2014-02-13 18:21:56','2014-02-22 10:12:25','1','Y',6,6),(7,'project manager','','2014-02-15 14:06:37','2014-02-22 10:12:28','1','Y',6,6),(8,'test','test','2014-02-20 20:12:19','2014-02-20 20:12:24','1','Y',8,8),(9,'Approver','advance, expense and leave approver','2014-02-22 12:41:41','2014-07-21 15:15:06','1','N',35,19),(10,'Finance Admin','manage all finance activities','2014-02-22 12:45:47','2014-04-12 12:25:09','1','N',35,17),(11,'test','test','2014-03-26 17:02:10','2014-03-26 17:10:26','1','Y',17,17),(12,'test','test','2014-03-26 17:02:24','2014-03-26 17:10:10','1','Y',17,17),(13,'test','test','2014-03-26 17:03:12','2014-03-26 17:09:19','1','Y',17,17),(14,'test','test','2014-03-26 17:10:34','2014-03-26 17:12:32','1','Y',17,17),(15,'test','test','2014-03-26 17:12:52','2014-03-26 17:16:34','1','Y',17,17),(16,'HR Manager','hr manager description','2014-04-04 13:40:22','2014-07-20 12:10:10','1','N',17,19),(17,'test','test','2014-04-19 16:14:35','2014-04-19 16:14:49','1','Y',19,19);
/*!40000 ALTER TABLE `app_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_share`
--

DROP TABLE IF EXISTS `app_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `share` text NOT NULL,
  `created_date` datetime NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `reply_id` int(10) unsigned DEFAULT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `type` enum('S','B','W','A','P') NOT NULL DEFAULT 'S' COMMENT 'S - Share',
  PRIMARY KEY (`id`),
  KEY `fk_app_share_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_share`
--

LOCK TABLES `app_share` WRITE;
/*!40000 ALTER TABLE `app_share` DISABLE KEYS */;
INSERT INTO `app_share` VALUES (1,'test','2014-05-22 11:13:27',19,NULL,NULL,'S'),(2,'test2','2014-05-22 11:13:30',19,NULL,NULL,'S'),(3,'test3','2014-05-22 11:13:32',19,NULL,NULL,'S'),(4,'test4','2014-05-22 11:13:34',19,NULL,NULL,'S'),(5,'test5','2014-05-22 11:13:36',19,NULL,NULL,'S'),(6,'test6','2014-05-22 11:13:39',19,NULL,NULL,'S'),(7,'test7','2014-05-22 11:13:53',19,NULL,NULL,'S'),(8,'test8','2014-05-22 11:13:55',19,NULL,NULL,'S'),(9,'test9','2014-05-22 11:13:57',19,NULL,NULL,'S'),(10,'test10','2014-05-22 11:14:00',19,NULL,NULL,'S'),(11,'test11','2014-05-22 11:14:02',19,NULL,NULL,'S'),(12,'12','2014-05-22 11:14:03',19,NULL,NULL,'S'),(13,'13','2014-05-22 11:14:06',19,NULL,NULL,'S'),(14,'14','2014-05-22 11:14:08',19,NULL,NULL,'S'),(15,'15','2014-05-22 11:14:10',19,NULL,NULL,'S'),(16,'17','2014-05-22 11:14:12',19,NULL,NULL,'S'),(17,'18','2014-05-22 11:14:14',19,NULL,NULL,'S'),(18,'19','2014-05-22 11:14:16',19,NULL,NULL,'S'),(19,'20','2014-05-22 11:14:18',19,NULL,NULL,'S'),(20,'21','2014-05-22 11:14:19',19,NULL,NULL,'S'),(21,'22','2014-05-22 11:14:21',19,NULL,NULL,'S'),(22,'23','2014-05-22 11:14:22',19,NULL,NULL,'S'),(23,'24','2014-05-22 11:16:35',19,NULL,NULL,'S'),(24,'25','2014-05-22 11:16:37',19,NULL,NULL,'S'),(25,'26','2014-05-22 11:16:40',19,NULL,NULL,'S'),(26,'27','2014-05-22 11:16:42',19,NULL,NULL,'S'),(27,'28','2014-05-22 11:16:44',19,NULL,NULL,'S'),(28,'29','2014-05-22 11:16:46',19,NULL,NULL,'S'),(29,'30','2014-05-22 11:16:48',19,NULL,NULL,'S'),(30,'31','2014-05-22 11:17:22',19,NULL,NULL,'S'),(31,'ok','2014-05-22 11:24:53',11,30,NULL,'S'),(32,'k','2014-05-22 11:24:57',11,29,NULL,'S'),(33,'k','2014-05-22 11:25:00',11,26,NULL,'S'),(34,'k','2014-05-22 11:25:03',11,25,NULL,'S'),(35,'k','2014-05-22 11:25:05',11,20,NULL,'S'),(36,'k','2014-05-22 11:25:07',11,15,NULL,'S'),(37,'k','2014-05-22 11:25:10',11,13,NULL,'S'),(38,'k','2014-05-22 11:25:12',11,8,NULL,'S'),(39,'k','2014-05-22 11:25:16',11,4,NULL,'S'),(40,'k','2014-05-22 11:25:19',11,1,NULL,'S'),(41,'test','2014-06-19 17:37:48',19,NULL,NULL,'S'),(42,'Wishing you a Happy Birthday','2014-06-23 13:15:12',1,NULL,NULL,'B'),(43,'Wishing you a Happy Birthday','2014-06-23 13:15:12',2,NULL,NULL,'B'),(44,'Wishing you a Happy Birthday','2014-06-23 13:15:12',3,NULL,NULL,'B'),(45,'Wishing you a Happy Birthday','2014-06-23 13:15:12',4,NULL,NULL,'B'),(46,'Wishing you a Happy Birthday','2014-06-23 13:15:12',5,NULL,NULL,'B'),(47,'Wishing you a Happy Birthday','2014-06-23 13:15:12',6,NULL,NULL,'B'),(48,'Wishing you a Happy Birthday','2014-06-23 13:15:12',7,NULL,NULL,'B'),(49,'Wishing you a Happy Birthday','2014-06-23 13:15:12',8,NULL,NULL,'B'),(50,'Wishing you a Happy Birthday','2014-06-23 13:15:12',9,NULL,NULL,'B'),(51,'Wishing you a Happy Birthday','2014-06-23 13:15:12',10,NULL,NULL,'B'),(52,'Wishing you a Happy Birthday','2014-06-23 13:15:12',11,NULL,NULL,'B'),(53,'Wishing you a Happy Birthday','2014-06-23 13:15:12',12,NULL,NULL,'B'),(54,'Wishing you a Happy Birthday','2014-06-23 13:15:12',13,NULL,NULL,'B'),(55,'Wishing you a Happy Birthday','2014-06-23 13:15:12',14,NULL,NULL,'B'),(56,'Wishing you a Happy Birthday','2014-06-23 13:15:12',15,NULL,NULL,'B'),(57,'Wishing you a Happy Birthday','2014-06-23 13:15:12',16,NULL,NULL,'B'),(58,'Wishing you a Happy Birthday','2014-06-23 13:15:12',17,NULL,NULL,'B'),(59,'Wishing you a Happy Birthday','2014-06-23 13:15:12',18,NULL,NULL,'B'),(60,'Wishing you a Happy Birthday','2014-06-23 13:15:12',19,NULL,NULL,'B'),(61,'Wishing you a Happy Birthday','2014-06-23 13:15:12',20,NULL,NULL,'B'),(62,'Wishing you a Happy Birthday','2014-06-23 13:15:12',21,NULL,NULL,'B'),(63,'Wishing you a Happy Birthday','2014-06-23 13:15:12',22,NULL,NULL,'B'),(64,'Wishing you a Happy Birthday','2014-06-23 13:15:12',23,NULL,NULL,'B'),(65,'Wishing you a Happy Birthday','2014-06-23 13:15:12',24,NULL,NULL,'B'),(66,'Wishing you a Happy Birthday','2014-06-23 13:15:12',25,NULL,NULL,'B'),(67,'Wishing you a Happy Birthday','2014-06-23 13:15:12',26,NULL,NULL,'B'),(68,'Wishing you a Happy Birthday','2014-06-23 13:15:12',27,NULL,NULL,'B'),(69,'Wishing you a Happy Birthday','2014-06-23 13:15:12',28,NULL,NULL,'B'),(70,'Wishing you a Happy Birthday','2014-06-23 13:15:12',29,NULL,NULL,'B'),(71,'Wishing you a Happy Birthday','2014-06-23 13:15:12',30,NULL,NULL,'B'),(72,'Wishing you a Happy Birthday','2014-06-23 13:15:12',31,NULL,NULL,'B'),(73,'Wishing you a Happy Birthday','2014-06-23 13:15:12',32,NULL,NULL,'B'),(74,'Wishing you a Happy Birthday','2014-06-23 13:15:12',33,NULL,NULL,'B'),(75,'Wishing you a Happy Birthday','2014-06-23 13:15:12',34,NULL,NULL,'B'),(76,'Wishing you a Happy Birthday','2014-06-23 13:15:12',35,NULL,NULL,'B'),(77,'Wishing you a Happy Birthday','2014-06-23 13:15:12',54,NULL,NULL,'B'),(78,'Wishing you a Happy Birthday','2014-06-23 13:15:12',56,NULL,NULL,'B'),(79,'test','2014-06-24 10:32:39',19,NULL,NULL,'S'),(80,'Wishing you a Happy Birthday','2014-07-05 10:07:02',8,NULL,NULL,'B'),(81,'test','2014-07-21 17:05:21',10,NULL,NULL,'S'),(82,'test','2014-07-21 17:05:30',10,NULL,NULL,'S'),(83,'test2','2014-07-21 17:05:38',10,NULL,NULL,'S'),(84,'t','2014-07-21 17:10:27',10,NULL,NULL,'S'),(85,'d','2014-07-21 17:12:05',10,NULL,NULL,'S'),(86,'sss','2014-07-21 17:12:12',10,NULL,NULL,'S'),(87,'asdf','2014-07-21 17:13:10',10,NULL,NULL,'S'),(88,'sd','2014-07-21 17:13:46',10,NULL,NULL,'S'),(89,'test','2014-07-21 17:14:36',10,NULL,NULL,'S'),(90,'test','2014-07-21 17:14:38',10,NULL,NULL,'S'),(91,'test','2014-07-21 17:19:39',10,NULL,NULL,'S'),(92,'test','2014-07-21 17:19:41',10,NULL,NULL,'S'),(93,'test','2014-07-21 17:19:42',10,NULL,NULL,'S'),(94,'xcvzxc','2014-07-21 17:21:52',10,NULL,NULL,'S'),(95,'sdfgsfg','2014-07-21 17:21:54',10,NULL,NULL,'S');
/*!40000 ALTER TABLE `app_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_share_user`
--

DROP TABLE IF EXISTS `app_share_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_share_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `app_share_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_app_share_app_users1` (`app_users_id`),
  KEY `fk_app_share_user_app_share1` (`app_share_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_share_user`
--

LOCK TABLES `app_share_user` WRITE;
/*!40000 ALTER TABLE `app_share_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_share_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_state`
--

DROP TABLE IF EXISTS `app_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_state` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A - Active\nI - Inactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_state`
--

LOCK TABLES `app_state` WRITE;
/*!40000 ALTER TABLE `app_state` DISABLE KEYS */;
INSERT INTO `app_state` VALUES (5,'Chhattisgarh','A'),(4,'Bihar','A'),(3,'Assam','A'),(2,'Arunachal Pradesh','A'),(1,'Andhra Pradesh','A'),(6,'Goa','A'),(7,'Gujarat','A'),(8,'Haryana','A'),(9,'Himachal Pradesh','A'),(10,'Jammu and Kashmir','A'),(11,'Jharkhand','A'),(12,'Karnataka','A'),(13,'Kerala','A'),(14,'Madhya Pradesh','A'),(15,'Maharashtra','A'),(16,'Manipur','A'),(17,'Meghalaya','A'),(18,'Mizoram','A'),(19,'Nagaland','A'),(20,'Orissa','A'),(21,'Punjab','A'),(22,'Rajasthan','A'),(23,'Sikkim','A'),(24,'Tamil Nadu','A'),(25,'Tripura','A'),(26,'Uttar Pradesh','A'),(27,'Uttarakhand','A'),(28,'West Bengal','A'),(29,'Andaman and Nicobar Islands','A'),(30,'Chandigarh','A'),(31,'Dadra and Nagar Haveli','I'),(32,'Daman and Diu','I'),(33,'Lakshadweep','I'),(34,'Pondicherry','A'),(35,'New Delhi','A');
/*!40000 ALTER TABLE `app_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_todo`
--

DROP TABLE IF EXISTS `app_todo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_todo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 - Active\n0 - Closed',
  `flag` tinyint(4) DEFAULT '0',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `fk_app_todo_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_todo`
--

LOCK TABLES `app_todo` WRITE;
/*!40000 ALTER TABLE `app_todo` DISABLE KEYS */;
INSERT INTO `app_todo` VALUES (1,'test',1,0,'2014-02-26 11:36:40',NULL,10,'N'),(2,'testtt',1,0,'2014-02-26 11:36:50',NULL,10,'N'),(3,'ee',1,0,'2014-02-26 11:36:53',NULL,10,'N'),(4,'test',1,0,'2014-02-26 11:36:55',NULL,10,'N'),(5,'test',1,0,'2014-02-26 11:36:57',NULL,10,'N'),(6,'ttt',1,0,'2014-02-26 11:37:00',NULL,10,'N'),(7,'tt',1,0,'2014-02-26 11:37:01',NULL,10,'N'),(8,'tt',1,0,'2014-02-26 11:37:03',NULL,10,'N'),(9,'tt',1,0,'2014-02-26 11:37:05',NULL,10,'N'),(10,'tt',1,0,'2014-02-26 11:37:07',NULL,10,'N'),(11,'tt',1,0,'2014-02-26 11:37:08',NULL,10,'N'),(12,'tt',1,0,'2014-02-26 11:37:10',NULL,10,'N'),(13,'sdafasdf',1,0,'2014-02-26 11:37:13',NULL,10,'N'),(14,'asdfasdf',1,0,'2014-02-26 11:37:15',NULL,10,'N'),(15,'asdfasdf',1,0,'2014-02-26 11:37:17',NULL,10,'N'),(16,'asdfasdf',1,0,'2014-02-26 11:37:18',NULL,10,'N'),(17,'adfasdf',1,0,'2014-02-26 11:37:20',NULL,10,'N'),(18,'asdfasdf',1,0,'2014-02-26 11:37:22',NULL,10,'N'),(19,'asdfasdf',1,0,'2014-02-26 11:37:24',NULL,10,'N'),(20,'asdfasdf',1,0,'2014-02-26 11:37:25',NULL,10,'N'),(21,'asdfasdf',1,0,'2014-02-26 11:37:27',NULL,10,'N'),(22,'asdfasdf',1,0,'2014-02-26 11:37:34',NULL,10,'N'),(23,'asdfasdfsadf',1,0,'2014-02-26 11:37:36',NULL,10,'N'),(24,'asdfasdfasdf',1,0,'2014-02-26 11:37:41',NULL,10,'N'),(25,'dfasdfasdfasdf',1,0,'2014-02-26 11:37:43',NULL,10,'N'),(26,'adad',1,0,'2014-02-26 11:38:59',NULL,10,'N'),(27,'asdf',1,0,'2014-02-26 11:39:04',NULL,10,'N'),(28,'sadf',1,0,'2014-02-26 11:39:12',NULL,10,'N'),(29,'sdfasdf',1,0,'2014-02-26 11:39:22',NULL,10,'N'),(30,'asdfasdfasdf',1,0,'2014-02-26 11:39:49',NULL,10,'N'),(31,'asdfasdfasdf',1,0,'2014-02-26 11:39:51',NULL,10,'N'),(32,'asdfasdf',1,0,'2014-02-26 11:39:53',NULL,10,'N'),(33,'asdfasdf',1,0,'2014-02-26 11:39:55',NULL,10,'N'),(34,'asdfasdf',1,0,'2014-02-26 11:39:58',NULL,10,'N'),(35,'asdfasdf',1,0,'2014-02-26 11:40:00',NULL,10,'N'),(36,'asdfasdf',1,0,'2014-02-26 11:40:02',NULL,10,'N'),(37,'asdfasdfsadfasdfasdfasdfasdfasdf',1,0,'2014-02-26 11:40:40',NULL,10,'N'),(38,'sdfasd',1,0,'2014-02-26 11:40:42',NULL,10,'N'),(39,'asdfasdfasd',1,0,'2014-02-26 11:40:44',NULL,10,'N'),(40,'sadfasdfasdf',1,0,'2014-02-26 11:40:47',NULL,10,'N'),(41,'sdfasdfasdfasdf',1,0,'2014-02-26 11:40:54',NULL,10,'N'),(42,'sadfasdfasdf',1,0,'2014-02-26 11:40:56',NULL,10,'N'),(43,'asdfasdf',1,0,'2014-02-26 11:40:58',NULL,10,'N'),(44,'asdfasdf',1,0,'2014-02-26 11:41:01',NULL,10,'N'),(45,'sadfasdfasdf',1,0,'2014-02-26 11:41:04',NULL,10,'N'),(46,'asdfasdfasdf',1,0,'2014-02-26 11:41:06',NULL,10,'N'),(47,'asdfasdfasdf',1,0,'2014-02-26 11:41:08',NULL,10,'N'),(48,'asdfasdf',1,0,'2014-02-26 11:41:10',NULL,10,'N'),(49,'asdfasdf',1,0,'2014-02-26 11:41:11',NULL,10,'N'),(50,'sadfasdf',1,0,'2014-02-26 11:41:13',NULL,10,'N'),(51,'teswt',1,0,'2014-02-26 11:41:49',NULL,10,'N'),(52,'sadfasdf',1,0,'2014-02-26 11:41:51',NULL,10,'N'),(53,'asdfasdf',1,0,'2014-02-26 11:42:01',NULL,10,'N'),(54,'asdfasdf',1,0,'2014-02-26 11:42:03',NULL,10,'N'),(55,'asdfasdf',1,0,'2014-02-26 11:42:07',NULL,10,'N'),(56,'asdfasdf',1,0,'2014-02-26 11:42:15',NULL,10,'N'),(57,'asdfasdf',1,0,'2014-02-26 11:42:17',NULL,10,'N'),(58,'sadfasdf',1,0,'2014-02-26 11:42:24',NULL,10,'N'),(59,'asdfasdfasdf',1,0,'2014-02-26 11:42:50',NULL,10,'N'),(60,'sdfasdf',1,0,'2014-02-26 11:42:52',NULL,10,'N'),(61,'asdfasdf',1,0,'2014-02-26 11:42:54',NULL,10,'N'),(62,'asdfasdfasdf',1,0,'2014-02-26 11:42:57',NULL,10,'N'),(63,'sadfasdf',1,0,'2014-02-26 11:42:59',NULL,10,'N'),(64,'asdfasdf',1,0,'2014-02-26 11:43:01',NULL,10,'N'),(65,'asdfasdf',1,0,'2014-02-26 11:43:04',NULL,10,'N'),(66,'asdfasdfasdf',1,0,'2014-02-26 11:43:07',NULL,10,'N'),(67,'sadfasdf',1,0,'2014-02-26 11:43:14',NULL,10,'N'),(68,'asdfasdfasdf',1,0,'2014-02-26 11:45:05',NULL,10,'N'),(69,'asdfasdf',1,0,'2014-02-26 11:47:15',NULL,10,'N'),(70,'test',1,0,'2014-02-26 11:47:19',NULL,10,'N'),(71,'sdf',1,0,'2014-02-26 11:47:21',NULL,10,'N'),(72,'asdf',1,0,'2014-02-26 11:47:24',NULL,10,'N'),(73,'asdf',1,0,'2014-02-26 11:47:27',NULL,10,'N'),(74,'asdf',1,0,'2014-02-26 11:47:33',NULL,10,'N'),(75,'asdfasdf',1,0,'2014-02-26 11:47:43',NULL,10,'N'),(76,'asdfasdf',1,0,'2014-02-26 11:48:06',NULL,10,'N'),(77,'asdfasdf',1,0,'2014-02-26 11:48:27',NULL,10,'N'),(78,'asdfasdf',1,0,'2014-02-26 11:48:38',NULL,10,'N'),(79,'test',1,0,'2014-02-26 11:50:06',NULL,10,'N'),(80,'test',1,0,'2014-02-26 11:50:18',NULL,10,'N'),(81,'sadf',1,0,'2014-02-26 11:51:50',NULL,10,'N'),(82,'sdf',1,0,'2014-02-26 11:51:52',NULL,10,'N'),(83,'asdfasdf',1,0,'2014-02-26 11:51:57',NULL,10,'N'),(84,'sadf',1,0,'2014-02-26 11:53:31',NULL,10,'N'),(85,'sadf',1,0,'2014-02-26 11:53:35',NULL,10,'N'),(86,'adsasdfasdf',1,0,'2014-02-26 11:53:47',NULL,10,'N'),(87,'asdf',1,0,'2014-02-26 11:55:46',NULL,10,'N'),(88,'asdf',1,0,'2014-02-26 11:55:48',NULL,10,'N'),(89,'asdf',1,0,'2014-02-26 11:55:58',NULL,10,'N'),(90,'asdfsafd',1,0,'2014-02-26 11:55:59',NULL,10,'N'),(91,'asdf',1,0,'2014-02-26 11:56:01',NULL,10,'N'),(92,'asdf',1,0,'2014-02-26 11:56:02',NULL,10,'N'),(93,'asdfasdf',1,0,'2014-02-26 11:56:16',NULL,10,'N'),(94,'asdf',1,0,'2014-02-26 11:56:17',NULL,10,'N'),(95,'asdf',1,0,'2014-02-26 11:56:19',NULL,10,'N'),(96,'asdf',1,0,'2014-02-26 11:56:21',NULL,10,'N'),(97,'asdf',1,0,'2014-02-26 11:56:22',NULL,10,'N'),(98,'asdf',1,0,'2014-02-26 11:56:24',NULL,10,'N'),(99,'asdf',1,0,'2014-02-26 11:56:25',NULL,10,'N'),(100,'asdf',1,0,'2014-02-26 11:56:26',NULL,10,'N'),(101,'asdf',0,0,'2014-02-26 11:56:28','2014-04-08 12:47:02',10,'N'),(102,'asdfasdf',0,0,'2014-02-26 11:57:56','2014-04-08 12:47:03',10,'N'),(103,'sadf',0,0,'2014-02-26 11:57:58','2014-04-08 12:47:04',10,'N'),(104,'asdf',0,0,'2014-02-26 11:57:59','2014-04-08 12:47:05',10,'N'),(105,'sdf',0,0,'2014-02-26 11:58:01','2014-04-08 12:47:04',10,'N'),(106,'asdf',1,0,'2014-02-26 11:58:02',NULL,10,'N'),(107,'asdf',1,0,'2014-02-26 11:58:04',NULL,10,'N'),(108,'asdf',1,0,'2014-02-26 11:58:05',NULL,10,'N'),(109,'sdf',1,0,'2014-02-26 11:58:07',NULL,10,'N'),(110,'asdf',1,0,'2014-02-26 11:58:08',NULL,10,'N'),(111,'asdfsdf',1,0,'2014-02-26 11:58:34',NULL,10,'N'),(112,'sadf',1,0,'2014-02-26 11:58:59',NULL,10,'N'),(113,'asdf',1,0,'2014-02-26 11:59:03',NULL,10,'N'),(114,'asdf',1,0,'2014-02-26 11:59:06',NULL,10,'N'),(115,'asdf',1,0,'2014-02-26 11:59:26',NULL,10,'N'),(116,'ff',1,0,'2014-02-26 11:59:28','2014-07-05 10:38:50',10,'Y'),(117,'sdf',1,0,'2014-02-26 11:59:31','2014-02-26 20:27:34',10,'Y'),(118,'fff',1,0,'2014-02-26 11:59:34','2014-02-26 20:27:33',10,'Y'),(119,'ravi',1,0,'2014-02-26 11:59:37','2014-02-26 20:27:32',10,'Y'),(120,'chandran',1,0,'2014-02-26 11:59:40','2014-02-26 20:27:31',10,'Y'),(121,'chandran',1,0,'2014-02-26 11:59:41','2014-02-26 20:27:31',10,'Y'),(122,'chanran',1,0,'2014-02-26 11:59:44','2014-02-26 20:27:30',10,'Y'),(123,'chanran',1,0,'2014-02-26 11:59:44','2014-02-26 20:27:28',10,'Y'),(124,'ravi',1,0,'2014-02-26 12:00:03','2014-02-26 20:27:27',10,'Y'),(125,'asdf',1,0,'2014-02-26 12:00:33','2014-02-26 20:27:26',10,'Y'),(126,'asdf',1,0,'2014-02-26 12:02:07','2014-07-05 10:38:49',10,'Y'),(127,'sadf',1,1,'2014-02-26 12:02:09','2014-07-05 10:37:33',10,'Y'),(128,'asdfasdf',1,0,'2014-02-26 12:02:49','2014-07-05 10:38:48',10,'Y'),(129,'ravi',1,1,'2014-02-26 12:02:58','2014-07-05 10:37:31',10,'Y'),(130,'test',0,0,'2014-02-26 12:15:54','2014-07-05 10:37:29',10,'Y'),(131,'asdfasdf',0,0,'2014-02-26 12:26:32','2014-07-05 10:37:28',10,'Y'),(132,'sadfasdf',0,0,'2014-02-26 12:26:34','2014-07-05 10:37:27',10,'Y'),(133,'asdf',0,0,'2014-02-26 13:19:58','2014-07-05 10:37:26',10,'Y'),(134,'sdfasdf',0,0,'2014-02-26 13:20:17','2014-07-05 10:37:24',10,'Y'),(135,'asdfasdf',0,0,'2014-02-26 13:20:19','2014-07-05 10:37:23',10,'Y'),(136,'test',1,0,'2014-02-26 13:20:21','2014-07-05 10:38:47',10,'Y'),(137,'test',1,0,'2014-02-26 13:21:00','2014-07-05 10:38:46',10,'Y'),(138,'test',0,0,'2014-02-27 10:22:26','2014-04-11 17:35:19',17,'Y'),(139,'test',1,0,'2014-02-27 10:22:29','2014-02-27 20:18:42',17,'Y'),(140,'test444',0,0,'2014-03-24 12:47:55','2014-04-09 13:33:48',11,'Y'),(141,'test',1,0,'2014-03-25 18:23:05','2014-04-07 18:15:19',11,'Y'),(143,'test',0,0,'2014-04-06 12:04:49','2014-04-11 19:53:00',17,'Y'),(142,'hi',1,0,'2014-04-06 12:04:46','2014-04-11 19:54:17',17,'Y'),(144,'test',0,0,'2014-04-06 12:04:56','2014-04-07 15:47:30',17,'Y'),(145,'test',0,0,'2014-04-06 12:05:02','2014-04-07 15:47:31',17,'Y'),(146,'test333555',1,1,'2014-04-07 11:57:50','2014-04-11 19:54:31',17,'N'),(147,'d',0,0,'2014-04-07 16:55:11','2014-04-17 20:04:37',7,'N'),(148,'test',0,0,'2014-04-09 14:49:06','2014-04-10 10:35:43',19,'N'),(149,'my first todo item',1,1,'2014-04-10 20:13:45','2014-04-11 10:14:18',11,'Y'),(150,'project meeting with client',0,0,'2014-04-10 20:13:54','2014-04-15 20:43:47',11,'N'),(151,'pls complete it',0,0,'2014-04-10 20:14:00','2014-04-15 20:43:47',11,'N'),(152,'test',0,0,'2014-04-11 10:14:08','2014-04-15 20:43:46',11,'N'),(153,'test',1,0,'2014-04-11 10:14:09',NULL,11,'N'),(154,'test',0,0,'2014-04-11 10:14:10','2014-04-15 20:43:37',11,'N'),(155,'test',0,0,'2014-04-11 10:14:12','2014-04-15 20:43:36',11,'N'),(156,'test',0,0,'2014-04-11 10:14:14','2014-04-15 20:43:36',11,'N'),(157,'mark attendance daily with out fail',1,0,'2014-04-15 16:18:08','2014-04-15 20:25:56',40,'N'),(158,'test',1,0,'2014-05-01 16:44:23',NULL,11,'N'),(159,'test',1,0,'2014-05-01 16:44:24',NULL,11,'N'),(160,'test',0,0,'2014-06-24 10:32:34','2014-06-24 10:36:15',19,'N'),(161,'tt',1,0,'2014-07-21 17:30:08',NULL,5,'N'),(162,'asdf',1,0,'2014-07-23 20:08:38',NULL,10,'N');
/*!40000 ALTER TABLE `app_todo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_users`
--

DROP TABLE IF EXISTS `app_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_no` varchar(45) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `official_contact_no` varchar(15) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `doc` date DEFAULT NULL,
  `pan` varchar(45) DEFAULT NULL,
  `pran_no` varchar(45) DEFAULT NULL,
  `pf_no` varchar(45) DEFAULT NULL,
  `esi_no` varchar(45) DEFAULT NULL,
  `gender` set('M','F') DEFAULT NULL COMMENT 'M - Male\nF - Female',
  `photo` varchar(45) DEFAULT NULL,
  `status` enum('1','0','2') NOT NULL COMMENT '1- Active\n0 - Inactive\n2 - Waiting',
  `last_login` datetime DEFAULT NULL,
  `marital_status` set('1','2') DEFAULT NULL COMMENT '1 - Single\n2 -  Married',
  `blood_group` varchar(15) DEFAULT NULL,
  `permanent_addr` varchar(200) DEFAULT NULL,
  `communication_addr` varchar(200) DEFAULT NULL,
  `wedding_date` date DEFAULT NULL,
  `landline` varchar(15) DEFAULT NULL,
  `personal_email` varchar(80) DEFAULT NULL,
  `emergency_contact_person` varchar(150) DEFAULT NULL,
  `emergency_contact_no` varchar(45) DEFAULT NULL,
  `emergency_relation` varchar(45) DEFAULT NULL,
  `probation` set('Y','C') DEFAULT NULL COMMENT 'Y - Yes',
  `insurance_no` varchar(25) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `photo_status` set('W','A','R') DEFAULT NULL COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `event_theme` varchar(25) DEFAULT NULL,
  `create_notify` datetime DEFAULT NULL,
  `hr_department_id` int(10) unsigned NOT NULL,
  `hr_designation_id` int(10) unsigned NOT NULL,
  `hr_company_id` int(10) unsigned NOT NULL,
  `hr_grade_id` int(10) unsigned NOT NULL,
  `hr_branch_id` int(10) unsigned NOT NULL,
  `hr_business_unit_id` tinyint(3) unsigned NOT NULL,
  `hr_blood_group_id` tinyint(3) unsigned NOT NULL,
  `app_roles_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `fk_app_users_hr_department1` (`hr_department_id`),
  KEY `fk_app_users_hr_designation1` (`hr_designation_id`),
  KEY `fk_app_users_hr_company1` (`hr_company_id`),
  KEY `fk_app_users_hr_grade1` (`hr_grade_id`),
  KEY `fk_hr_branch_id` (`hr_branch_id`),
  KEY `fk_app_users_fin_roles1` (`app_roles_id`),
  KEY `fk_hr_business_unit` (`hr_business_unit_id`),
  KEY `fk_blood_group_id` (`hr_blood_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_users`
--

LOCK TABLES `app_users` WRITE;
/*!40000 ALTER TABLE `app_users` DISABLE KEYS */;
INSERT INTO `app_users` VALUES (1,'CEOTS - 169','amit@ceotalentsearch.com','Amit','Dey','','','1986-06-12','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:12:51','2014-04-01 19:22:39','',NULL,NULL,5,14,1,1,4,3,0,2,6,17,'N'),(2,'CEOTS - 176','ankeet@ceotalentsearch.com','Ankeet','Mukesh Bhatt','','','1988-04-14','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:29:14','2014-03-28 12:02:01','',NULL,NULL,5,14,1,1,4,1,0,2,6,17,'N'),(3,'CEOTS - 127','ashwani@ceotalentsearch.com','Ashwani','Jaiswal','','','1980-01-09','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:30:09','2014-03-28 12:06:51','',NULL,NULL,7,14,1,1,5,2,0,2,6,17,'N'),(4,'CEOTS - 128','atanu@ceotalentsearch.com','Atanu','Gupta','','','1971-01-06','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:31:11','2014-03-28 12:06:43','',NULL,NULL,8,9,1,1,1,3,0,2,6,17,'N'),(5,'CEOTS - 197','testing10@bigspire.com','Bhargavi','M','','','1989-04-26','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1','2014-07-26 12:30:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:34:00','2014-03-28 12:06:35','','smoothness',NULL,3,14,1,1,1,2,0,2,6,17,'N'),(6,'CEOTS - 177','chauhan@ceotalentsearch.com','Gaurangkumar','N Chauhan','','','1989-10-26','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:34:48','2014-03-28 12:06:21','',NULL,NULL,5,13,1,1,4,2,0,2,6,17,'N'),(7,'','testing3@bigspire.com','Gaurav','Uday Khatri','','','1985-08-29','2013-06-23',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1','2014-07-31 14:51:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:35:38','2014-03-28 12:06:05','',NULL,NULL,5,4,1,1,4,2,0,9,6,17,'N'),(8,'','gowrinadh@ceotalentsearch.com','Gowrinadh ','K','','','1985-07-05','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:36:33','2014-03-28 12:05:53','',NULL,NULL,9,10,1,1,3,3,0,2,6,17,'N'),(9,'CEOTS - 062','kamesh@ceotalentsearch.com','Kamesh','K','','','1979-01-03','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:37:28','2014-03-28 12:05:44','',NULL,NULL,1,11,1,1,1,3,0,2,6,17,'N'),(10,'CEOTS - 122','testing2@bigspire.com','Karthikeyan','S','','','1978-11-18','2012-06-22',NULL,NULL,NULL,NULL,NULL,'M','','1','2014-08-03 20:06:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:44:09','2014-03-28 12:05:27','A','smoothness',NULL,1,6,1,1,1,1,0,9,6,17,'N'),(11,'CEOTS - 166','testing6@bigspire.com','Kaviya','Priya J S','','','1988-01-21','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F','','1','2014-07-31 17:14:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:45:27','2014-02-25 16:43:11','W',NULL,NULL,4,12,1,1,1,1,0,10,6,17,'N'),(12,'CEOTS - 179','lakshman@ceotalentsearch.com','Lakshman','N','','','1987-02-05','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:46:49','2014-03-28 12:05:09','',NULL,NULL,1,1,1,1,1,3,0,2,6,17,'N'),(13,'CEOTS - 109','mathews@ceotalentsearch.com','Mathews','J','','','1988-01-07','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:47:27','2014-03-28 12:05:01','',NULL,NULL,9,13,1,1,3,1,0,2,6,17,'N'),(14,'CEOTS - 194','mazhar@ceotalentsearch.com','Mazhar','Kagdi','','','1981-07-19','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:48:23','2014-03-28 12:04:54','',NULL,NULL,8,9,1,1,1,3,0,2,6,17,'N'),(15,'CEOTS - 159','testing@bigspire.com','Mohammed','Imran','','','1983-08-31','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1','2014-08-03 20:06:58',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:49:08','2014-03-28 12:04:45','','',NULL,6,13,1,1,1,1,0,9,6,17,'N'),(16,'','ravi@bigspire.com','Narendiran','K. V','','','1986-03-20','1986-03-20',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1','2014-08-02 10:34:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:49:49','2014-03-28 12:04:37','',NULL,NULL,6,14,1,1,1,3,0,2,6,17,'N'),(17,'CEOTS - 115','testing5@bigspire.com','Padmanabhan','N','','','1978-12-28','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M','','1','2014-07-31 17:41:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:50:36','2014-03-28 12:04:30','A',NULL,NULL,4,2,1,1,1,1,0,1,6,17,'N'),(18,'CEOTS - 160','mary@ceotalentsearch.com','Paulina','K','','','1984-08-24','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:51:26','2014-03-28 12:04:22','',NULL,NULL,2,14,1,1,2,1,0,2,6,17,'N'),(19,'CEOTS - 174','testing4@bigspire.com','Philip','Joshua Assey','232323232323','767676767','1988-05-20','2010-05-20','2014-05-20','AMFMFMFM','24343434','65654545454','222222223232323','M','','1','2014-08-03 10:59:39','2','A +ve','tuty address','chennai','2011-05-20','234 432323','philip@gmail.com','ravi','049493933333','father','C','','2014-02-22 10:52:06','2014-05-16 16:52:10','A','',NULL,14,3,1,1,1,2,5,16,6,19,'N'),(20,'CEOTS - 108','praveena.e@ceotalentsearch.com','Praveena','E','','','1988-08-30','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:52:52','2014-03-28 12:04:07','',NULL,NULL,3,13,1,1,1,1,0,2,6,17,'N'),(21,'CEOTS - 137','testing9@bigspire.com','Prema','Latha K','','','1986-08-22','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1','2014-06-24 15:52:26',NULL,NULL,NULL,NULL,'1992-04-30',NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:53:31','2014-03-28 12:03:59','',NULL,NULL,2,14,1,1,2,3,0,2,6,17,'N'),(22,'CEOTS - 002','raji@ceotalentsearch.com','Rajalakshmi','S','','','1980-10-05','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:54:14','2014-03-28 12:03:51','',NULL,NULL,3,5,1,1,1,2,0,2,6,17,'N'),(23,'CEOTS - 098','rajnish@ceotalentsearch.com','Rajnish','Rajnish','','','1978-06-09','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:54:57','2014-03-28 12:03:42','',NULL,NULL,5,14,1,1,4,1,0,2,6,17,'N'),(24,'CEOTS - 148','hr@ceotalentsearch.com','Ramesh','Prakash','','','1979-10-27','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:55:38','2014-03-28 12:03:34','',NULL,NULL,8,2,1,1,1,1,0,2,6,17,'N'),(25,'CEOTS - 085','testing7@bigspire.com','Ranjeet','A Rajpurohit','','','1987-04-25','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1','2014-07-31 17:14:49',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',NULL,'2014-02-22 10:56:16','2014-03-28 12:03:24','',NULL,NULL,2,15,1,1,2,3,0,9,6,17,'N'),(26,'','saikiran@ceotalentsearch.com','Saikiran','Marisetti','','','1989-08-10','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:57:01','2014-03-28 12:03:15','',NULL,NULL,8,8,1,1,1,3,0,2,6,17,'N'),(27,'CEOTS - 008','testing8@bigspire.com','Sanjeev','Pal','','','1978-07-11','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1','2014-07-31 17:33:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:57:49','2014-03-28 12:03:08','',NULL,NULL,5,14,1,1,4,2,0,2,6,17,'N'),(28,'','saroj@ceotalentsearch.com','Saroj','Singh','','','1982-11-11','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:58:24','2014-03-28 12:02:57','',NULL,NULL,2,14,1,1,2,2,0,2,6,17,'N'),(29,'CEOTS - 031','silvia@ceotalentsearch.com','Silvia','Santha Kumari','','','1986-04-09','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 10:58:58','2014-03-28 12:02:45','',NULL,NULL,2,10,1,1,2,1,0,2,6,17,'N'),(30,'CEOTS - 097','bigspire@gmail.com','Sivaprakasam','P','','','1981-06-20','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1','2014-02-28 18:14:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 11:09:15','2014-03-28 12:02:37','',NULL,NULL,6,14,1,1,1,2,0,2,6,17,'N'),(31,'CEOTS - 106','testing12@bigspire.com','Suganya','S','','','1988-09-27','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 11:09:49','2014-03-28 12:02:30','',NULL,NULL,3,14,1,1,1,1,0,2,6,17,'N'),(32,'','sumeet@ceotalentsearch.com','Sumeet','Kumar','','','1991-09-03','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 11:10:28','2014-03-28 12:02:22','',NULL,NULL,5,1,1,1,4,2,0,2,6,17,'N'),(33,'CEOTS - 195','murugan@ceotalentsearch.com','Thiru','Murugan','','','1979-02-02','0000-00-00',NULL,NULL,NULL,NULL,NULL,'M',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 11:11:00','2014-03-28 12:02:15','',NULL,NULL,1,7,1,1,1,1,0,2,6,17,'N'),(34,'CEOTS - 184','testing11@bigspire.com','Vaishnavi ','M','','','1988-12-22','0000-00-00',NULL,NULL,NULL,NULL,NULL,'F',NULL,'1','2014-06-02 06:42:52',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 11:11:34','2014-03-28 12:02:08','',NULL,NULL,3,14,1,1,1,1,0,2,6,17,'N'),(35,'TEST222','ravi3@bigspire.com','Ravichandran','J','9999999999','9003033020','1983-11-13','2014-04-14','2014-05-13','','','','','M','','1','2014-02-22 13:34:24','1','A1 +ve','Tuticorin','Tuty','0000-00-00','','ankeetbm@gmail.com','','','','C','','2014-02-22 11:11:34','2014-06-30 12:35:08','',NULL,'2014-03-02 13:11:49',3,14,1,1,1,3,1,1,6,19,'N'),(54,'434343','testing14@bigspire.com','testing','test','4645454434','88787878','1992-04-30','2012-04-30',NULL,'','','','','M','','1','2014-06-25 10:01:49','1','a1 +ve','tuty','chennai','1992-04-30','','testing10@gmail.com','','','father','Y','43434323232323','2014-04-29 17:07:28','2014-05-15 19:43:18','A','cupertino',NULL,4,2,1,0,4,1,0,2,19,17,'N'),(56,'553','ravi3@bigspire.com','ravi','chad','232323','23232323','2014-05-14','2014-05-12','2014-05-20','',NULL,'','','M',NULL,'1',NULL,'1',NULL,'test','tuty',NULL,'','ravi@gmail.com','','','','Y','','2014-05-17 12:32:14',NULL,NULL,NULL,'2014-06-28 10:33:42',6,3,1,0,4,1,1,2,19,NULL,'N');
/*!40000 ALTER TABLE `app_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_adv_pay`
--

DROP TABLE IF EXISTS `fin_adv_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_adv_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float unsigned NOT NULL,
  `pay_mode` enum('CA','CK','OT') NOT NULL COMMENT 'CA - Cash\nCK - Cheque\nOT - Online Transfer',
  `paid_date` date DEFAULT NULL,
  `pay_refno` varchar(10) DEFAULT NULL,
  `remarks` text,
  `reconcile` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `fin_advance_id` int(10) unsigned NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_pay_fin_advance1` (`fin_advance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_adv_pay`
--

LOCK TABLES `fin_adv_pay` WRITE;
/*!40000 ALTER TABLE `fin_adv_pay` DISABLE KEYS */;
INSERT INTO `fin_adv_pay` VALUES (1,200,'CK','2014-05-22','test','test',1,'2014-05-22 19:08:29',11,NULL,1,NULL),(2,200,'CA','2014-05-22','','',1,'2014-05-22 19:08:47',11,NULL,1,NULL),(3,400,'OT','2014-05-23','','',1,'2014-05-23 10:56:30',11,NULL,3,NULL),(4,200,'CA','2014-05-22','5343434','test',1,'2014-05-23 11:38:55',11,NULL,5,NULL),(5,20000,'OT','2014-05-23','922932323','',1,'2014-05-23 15:55:16',11,NULL,6,NULL),(6,10000,'CA','2014-05-22','','',1,'2014-05-23 16:05:41',11,NULL,7,NULL);
/*!40000 ALTER TABLE `fin_adv_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_adv_status`
--

DROP TABLE IF EXISTS `fin_adv_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_adv_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `fin_advance_id` int(10) unsigned NOT NULL,
  `status` enum('W','A','R') NOT NULL COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `remarks` varchar(200) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1` (`app_users_id`),
  KEY `fk_fin_req_status_fin_advance1` (`fin_advance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_adv_status`
--

LOCK TABLES `fin_adv_status` WRITE;
/*!40000 ALTER TABLE `fin_adv_status` DISABLE KEYS */;
INSERT INTO `fin_adv_status` VALUES (1,10,1,'A','done','2014-05-22 19:04:57','2014-05-22 19:07:04',10),(2,10,2,'R','no','2014-05-22 19:05:33','2014-05-22 19:06:41',10),(3,10,3,'A','ok','2014-05-23 10:34:48','2014-05-23 10:54:47',10),(4,10,5,'A','ok, approving','2014-05-23 11:36:25','2014-05-23 11:37:33',10),(5,10,6,'A','pls approve only 10k','2014-05-23 15:27:46','2014-05-23 15:30:42',10),(6,10,7,'A','ok approved 10k','2014-05-23 15:57:27','2014-05-23 16:02:35',10),(7,10,8,'A','ok','2014-06-28 10:35:01','2014-06-28 10:36:47',10),(8,10,9,'W',NULL,'2014-07-29 19:29:54',NULL,NULL);
/*!40000 ALTER TABLE `fin_adv_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_adv_users`
--

DROP TABLE IF EXISTS `fin_adv_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_adv_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fin_advance_id` int(10) unsigned NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_fin_advance1` (`fin_advance_id`),
  KEY `fk_fin_adv_users_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_adv_users`
--

LOCK TABLES `fin_adv_users` WRITE;
/*!40000 ALTER TABLE `fin_adv_users` DISABLE KEYS */;
INSERT INTO `fin_adv_users` VALUES (1,1,10),(2,2,10),(3,3,10),(4,5,10),(5,6,10),(6,7,10),(7,8,10),(8,9,10);
/*!40000 ALTER TABLE `fin_adv_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_advance`
--

DROP TABLE IF EXISTS `fin_advance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_advance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purpose` varchar(60) NOT NULL,
  `req_date` date NOT NULL,
  `amount` float NOT NULL,
  `description` text NOT NULL,
  `tsk_company_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL COMMENT 'N - Not Deleted\nY - Deleted',
  `is_approve` enum('Y','N','R') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1` (`app_users_id`),
  KEY `tsk_company_id` (`tsk_company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_advance`
--

LOCK TABLES `fin_advance` WRITE;
/*!40000 ALTER TABLE `fin_advance` DISABLE KEYS */;
INSERT INTO `fin_advance` VALUES (1,'project meeting','2014-05-22',500,'test',2,'2014-05-22 19:04:57',NULL,19,'N','Y'),(2,'watch movie','2014-05-22',100,'test',NULL,'2014-05-22 19:05:33',NULL,19,'N','R'),(3,'going to project work','2014-05-24',600,'test ',2,'2014-05-23 10:34:48',NULL,7,'N','Y'),(4,'going to movie','2014-05-29',100,'test',NULL,'2014-05-23 11:35:13',NULL,54,'N','N'),(5,'Going for lunch with client','2014-05-23',200,'test',2,'2014-05-23 11:36:25',NULL,21,'N','Y'),(6,'mass recruitment process','2014-05-24',20000,'for process going',2,'2014-05-23 15:27:46',NULL,21,'N','Y'),(7,'Mass Recruitment 2','2014-05-23',10000,'test desc',1,'2014-05-23 15:57:27',NULL,21,'N','Y'),(8,'going to home','2014-06-30',5000,'going to home for the festival',2,'2014-06-28 10:35:01',NULL,17,'N','Y'),(9,'test','2014-07-29',5055,'test',NULL,'2014-07-29 19:29:54',NULL,19,'N','N');
/*!40000 ALTER TABLE `fin_advance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_exp_category`
--

DROP TABLE IF EXISTS `fin_exp_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_exp_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_exp_category`
--

LOCK TABLES `fin_exp_category` WRITE;
/*!40000 ALTER TABLE `fin_exp_category` DISABLE KEYS */;
INSERT INTO `fin_exp_category` VALUES (1,'Travel','A','2014-02-10 00:00:00','2014-03-02 13:01:46',1,17,'N'),(2,'Food','A','2014-02-10 00:00:00',NULL,1,NULL,'N'),(3,'Ticket','A','2014-02-08 13:29:46','2014-02-08 13:34:57',6,6,'Y'),(6,'12345','A','2014-02-08 13:35:16','2014-02-08 13:35:20',6,NULL,'Y'),(7,'dress','A','2014-02-20 20:12:49','2014-02-20 20:12:51',8,NULL,'Y');
/*!40000 ALTER TABLE `fin_exp_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_exp_pay`
--

DROP TABLE IF EXISTS `fin_exp_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_exp_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float unsigned DEFAULT NULL,
  `tot_advance` float DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `pay_mode` set('CA','CK','OT','ADJ') DEFAULT NULL COMMENT 'CA - Cash',
  `pay_refno` varchar(10) DEFAULT NULL,
  `amt_received` float DEFAULT NULL,
  `balance_hand` float DEFAULT NULL,
  `remarks` text,
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `fin_expenses_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_exp_pay_fin_expenses1` (`fin_expenses_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_exp_pay`
--

LOCK TABLES `fin_exp_pay` WRITE;
/*!40000 ALTER TABLE `fin_exp_pay` DISABLE KEYS */;
INSERT INTO `fin_exp_pay` VALUES (1,300,400,'2014-05-22','CA','',NULL,NULL,'','2014-05-22 19:34:36',11,1),(2,200,0,'2014-05-22','CA','',NULL,NULL,'','2014-05-22 19:44:25',11,2),(3,800,0,'2014-05-23','CA','',NULL,NULL,'','2014-05-23 11:04:29',11,6),(4,0,400,'2014-05-23','ADJ','',NULL,100,'','2014-05-23 11:05:43',11,5),(5,300,0,'2014-05-22','OT','656',NULL,100,'test remarks','2014-05-23 11:06:29',11,4),(6,500,0,'2014-05-21','OT','',NULL,NULL,'','2014-05-23 11:30:50',11,7),(7,0,200,'2014-05-23','ADJ','',NULL,NULL,'','2014-05-23 12:32:23',11,8),(8,0,30000,'2014-05-23','ADJ','',NULL,29554,'','2014-05-23 16:24:48',17,10),(9,0,0,'2014-05-23','ADJ','',NULL,29054,'','2014-05-23 16:29:31',17,9),(10,0,0,'2014-05-23','CK','',25000,4054,'','2014-05-23 16:55:04',11,12),(11,1046,0,'2014-05-21','ADJ','',NULL,4054,'','2014-05-23 16:59:20',11,13),(12,946,0,'2014-05-23','CA','54343434',NULL,0,'ok','2014-05-23 17:16:22',11,15);
/*!40000 ALTER TABLE `fin_exp_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_exp_status`
--

DROP TABLE IF EXISTS `fin_exp_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_exp_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('W','A','R') NOT NULL COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `created_date` datetime NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `fin_expenses_id` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1` (`app_users_id`),
  KEY `fk_fin_exp_status_fin_expenses1` (`fin_expenses_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_exp_status`
--

LOCK TABLES `fin_exp_status` WRITE;
/*!40000 ALTER TABLE `fin_exp_status` DISABLE KEYS */;
INSERT INTO `fin_exp_status` VALUES (1,'A','2014-05-22 19:07:44',10,1,'2014-05-22 19:08:03',10),(2,'A','2014-05-22 19:40:03',10,2,'2014-05-22 19:40:31',10),(3,'A','2014-05-23 11:01:58',10,6,'2014-05-23 11:03:04',10),(4,'A','2014-05-23 11:02:19',10,5,'2014-05-23 11:03:23',10),(5,'A','2014-05-23 11:02:33',10,4,'2014-05-23 11:03:15',10),(6,'A','2014-05-23 11:29:13',10,7,'2014-05-23 11:29:53',10),(7,'A','2014-05-23 12:27:21',10,8,'2014-05-23 12:28:27',10),(8,'A','2014-05-23 16:10:44',10,9,'2014-05-23 16:19:09',10),(9,'A','2014-05-23 16:16:29',10,10,'2014-05-23 16:19:00',10),(10,'A','2014-05-23 16:32:13',10,11,'2014-05-23 16:32:54',10),(11,'A','2014-05-23 16:49:39',10,12,'2014-05-23 16:50:32',10),(12,'A','2014-05-23 16:57:51',10,13,'2014-05-23 16:58:32',10),(13,'A','2014-05-23 17:02:00',10,14,'2014-05-23 17:02:20',10),(14,'A','2014-05-23 17:05:36',10,15,'2014-05-23 17:05:56',10),(15,'A','2014-06-29 13:03:25',10,18,'2014-07-24 10:03:14',10);
/*!40000 ALTER TABLE `fin_exp_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_exp_temp_list`
--

DROP TABLE IF EXISTS `fin_exp_temp_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_exp_temp_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_exp` date NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `amount` float NOT NULL,
  `billable` enum('1','0') DEFAULT '0',
  `bill_avail` enum('1','0') DEFAULT '0',
  `bill_refno` varchar(10) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `fin_expenses_id` int(10) unsigned NOT NULL,
  `fin_exp_category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_expense_list_fin_expenses1` (`fin_expenses_id`),
  KEY `fk_fin_expense_list_fin_exp_category1` (`fin_exp_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=538 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_exp_temp_list`
--

LOCK TABLES `fin_exp_temp_list` WRITE;
/*!40000 ALTER TABLE `fin_exp_temp_list` DISABLE KEYS */;
INSERT INTO `fin_exp_temp_list` VALUES (11,'2014-05-15','test',333,NULL,NULL,'test','2014-07-29 20:33:01',3,2),(10,'2014-07-28','23',22,NULL,NULL,'','2014-07-29 20:33:01',3,2),(23,'2014-07-23','asdfasdf',34,'1','1','er3343434','2014-07-29 20:34:37',21,2),(12,'2014-07-28','2323',23,NULL,NULL,'','2014-07-29 20:33:01',3,2),(22,'2014-07-28','2323',66,'1','1','77777','2014-07-29 20:34:37',21,2),(24,'2014-07-22','d',34,NULL,NULL,'','2014-07-29 20:34:37',21,2),(25,'2014-07-01','d',3433,NULL,NULL,'','2014-07-29 20:34:37',21,2),(38,'2014-07-01','test',2,NULL,NULL,'','2014-07-31 12:56:16',24,2),(32,'2014-07-01','ererer',33,'1','1','3434','2014-07-29 20:36:47',22,2),(31,'2014-07-29','3434',3434,'1','1','34343443','2014-07-29 20:36:47',22,2),(30,'2014-07-28','343',333,'1','1','343434','2014-07-29 20:36:47',22,1),(37,'2014-07-28','test',1,NULL,NULL,'','2014-07-31 12:56:16',24,2),(36,'2014-07-29','test',3,NULL,NULL,'','2014-07-31 12:56:16',24,2),(525,'2014-08-02','f',3,NULL,NULL,'','2014-08-02 10:50:15',16,1),(523,'2014-06-19','1',333,NULL,NULL,'','2014-08-02 10:50:15',16,2),(524,'2014-06-19','test',333,NULL,NULL,'','2014-08-02 10:50:15',16,2),(522,'2014-07-01','dfdf',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(521,'2014-07-01','23',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(520,'2014-07-01','dfdfdf',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(519,'2014-07-01','3',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(518,'2014-07-01','3',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(517,'2014-07-01','4',2,NULL,NULL,'','2014-08-02 10:50:15',16,1),(516,'2014-07-01','2',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(515,'2014-07-01','dfd',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(514,'2014-07-01','dfdf',5,NULL,NULL,'','2014-08-02 10:50:15',16,2),(513,'2014-07-02','34',1,NULL,NULL,'','2014-08-02 10:50:15',16,1),(512,'2014-07-02','34',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(511,'2014-07-04','34',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(510,'2014-07-08','2',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(509,'2014-07-08','2',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(508,'2014-07-08','3',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(507,'2014-07-09','7',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(506,'2014-07-15','6',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(505,'2014-07-15','34',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(504,'2014-07-15','7',1,NULL,NULL,'','2014-08-02 10:50:15',16,1),(503,'2014-07-15','23',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(502,'2014-07-16','3',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(501,'2014-07-16','23',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(500,'2014-07-16','323',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(499,'2014-07-21','4',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(498,'2014-07-21','5',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(497,'2014-07-21','3434',3,'1','1','','2014-08-02 10:50:15',16,1),(496,'2014-07-22','3',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(495,'2014-07-23','6',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(494,'2014-07-24','34',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(493,'2014-07-28','2',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(492,'2014-07-28','34',34,NULL,NULL,'','2014-08-02 10:50:15',16,2),(491,'2014-07-28','4d',2,NULL,NULL,'','2014-08-02 10:50:15',16,1),(490,'2014-07-28','34',33,NULL,NULL,'','2014-08-02 10:50:15',16,2),(489,'2014-07-28','3',1,NULL,NULL,'','2014-08-02 10:50:15',16,1),(488,'2014-07-28','34',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(487,'2014-07-28','2',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(486,'2014-07-28','45',4,NULL,NULL,'4545','2014-08-02 10:50:15',16,2),(485,'2014-07-28','3',34,NULL,NULL,'','2014-08-02 10:50:15',16,2),(484,'2014-07-28','3',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(483,'2014-07-28','2',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(482,'2014-07-28','234234',4,'1','1','343434','2014-08-02 10:50:15',16,1),(481,'2014-07-28','3',25000,NULL,NULL,'','2014-08-02 10:50:15',16,2),(480,'2014-07-29','3',1,NULL,NULL,'','2014-08-02 10:50:15',16,2),(479,'2014-07-29','fdf',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(478,'2014-07-29','fdf',2,NULL,NULL,'','2014-08-02 10:50:15',16,2),(477,'2014-07-29','2323',144,NULL,NULL,'','2014-08-02 10:50:15',16,2),(476,'2014-07-29','dfd',2,NULL,NULL,'','2014-08-02 10:50:15',16,1),(475,'2014-07-29','3',18,NULL,NULL,'','2014-08-02 10:50:15',16,2),(474,'2014-07-29','fdf',33,NULL,NULL,'','2014-08-02 10:50:15',16,1),(473,'2014-07-29','2323',23,NULL,NULL,'','2014-08-02 10:50:15',16,2),(472,'2014-07-31','f',6,NULL,NULL,'','2014-08-02 10:50:15',16,2),(471,'2014-08-01','545',4,NULL,NULL,'','2014-08-02 10:50:15',16,1),(470,'2014-08-01','test',44,NULL,NULL,'','2014-08-02 10:50:15',16,2),(469,'2014-08-01','45',434,NULL,NULL,'','2014-08-02 10:50:15',16,2),(468,'2014-08-01','d',8,NULL,NULL,'','2014-08-02 10:50:15',16,2),(467,'2014-08-01','dfdfdf',4,NULL,NULL,'','2014-08-02 10:50:15',16,1),(466,'2014-08-01','s',7,NULL,NULL,'','2014-08-02 10:50:15',16,2),(465,'2014-08-01','4545',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(464,'2014-08-02','45',5,NULL,NULL,'','2014-08-02 10:50:15',16,2),(463,'2014-08-02','454',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(462,'2014-08-02','45',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(461,'2014-08-02','4545',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(460,'2014-08-02','88888',8,NULL,NULL,'','2014-08-02 10:50:15',16,2),(459,'2014-08-02','3',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(458,'2014-08-02','4343434',34,'1','1','','2014-08-02 10:50:15',16,1),(457,'2014-08-02','334',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(456,'2014-08-02','3',4,NULL,NULL,'','2014-08-02 10:50:15',16,1),(526,'2014-08-02','f',3,NULL,NULL,'','2014-08-02 10:50:15',16,1),(527,'2014-08-02','f',3,NULL,NULL,'','2014-08-02 10:50:15',16,1),(528,'2014-08-02','d',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(529,'2014-08-02','f',2,NULL,NULL,'','2014-08-02 10:50:15',16,1),(530,'2014-08-02','d',5,NULL,NULL,'','2014-08-02 10:50:15',16,1),(531,'2014-08-02','34',4,NULL,NULL,'','2014-08-02 10:50:15',16,2),(532,'2014-08-01','33433',22,NULL,NULL,'','2014-08-02 10:50:15',16,1),(533,'2014-08-01','3',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(534,'2014-08-02','3',3232,NULL,NULL,'','2014-08-02 10:50:15',16,2),(535,'2014-08-02','3',3,NULL,NULL,'','2014-08-02 10:50:15',16,2),(536,'2014-08-01','3',2,NULL,NULL,'','2014-08-02 10:50:15',16,1),(537,'2014-08-01','2',2,NULL,NULL,'','2014-08-02 10:50:15',16,2);
/*!40000 ALTER TABLE `fin_exp_temp_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_exp_users`
--

DROP TABLE IF EXISTS `fin_exp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_exp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `fin_expenses_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_app_users1` (`app_users_id`),
  KEY `fk_fin_exp_users_fin_expenses1` (`fin_expenses_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_exp_users`
--

LOCK TABLES `fin_exp_users` WRITE;
/*!40000 ALTER TABLE `fin_exp_users` DISABLE KEYS */;
INSERT INTO `fin_exp_users` VALUES (1,10,1),(2,10,2),(3,10,6),(4,10,5),(5,10,4),(6,10,7),(7,10,8),(8,10,9),(9,10,10),(10,10,11),(11,10,12),(12,10,13),(13,10,14),(14,10,15),(15,10,18);
/*!40000 ALTER TABLE `fin_exp_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_expense_limit`
--

DROP TABLE IF EXISTS `fin_expense_limit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_expense_limit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `fin_exp_category_id` int(10) unsigned NOT NULL,
  `hr_grade_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  KEY `fk_fin_expense_limit_fin_exp_category1` (`fin_exp_category_id`),
  KEY `fk_fin_expense_limit_hr_grade1` (`hr_grade_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_expense_limit`
--

LOCK TABLES `fin_expense_limit` WRITE;
/*!40000 ALTER TABLE `fin_expense_limit` DISABLE KEYS */;
INSERT INTO `fin_expense_limit` VALUES (1,2000,1,1,'2014-02-10 00:00:00',1,'2014-02-08 10:07:55',NULL,'Y','A'),(2,0,2,1,'2014-02-10 00:00:00',1,'2014-02-08 10:07:58',NULL,'Y','A'),(3,10000,2,2,'2014-02-07 19:53:03',6,'2014-02-22 11:24:33',6,'Y','A'),(4,9000,1,2,'2014-02-07 19:58:53',6,'2014-02-20 20:12:39',6,'Y','A');
/*!40000 ALTER TABLE `fin_expense_limit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_expense_list`
--

DROP TABLE IF EXISTS `fin_expense_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_expense_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_exp` date NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `amount` float NOT NULL,
  `billable` enum('1','0') DEFAULT '0',
  `bill_avail` enum('1','0') DEFAULT '0',
  `bill_refno` varchar(10) DEFAULT NULL,
  `status` enum('W','A','R') NOT NULL COMMENT 'W - Awaiting\nA - Approved\nR - Rejected',
  `del_status` set('1','0') NOT NULL DEFAULT '0',
  `fin_expenses_id` int(10) unsigned NOT NULL,
  `fin_exp_category_id` int(10) unsigned NOT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_expense_list_fin_expenses1` (`fin_expenses_id`),
  KEY `fk_fin_expense_list_fin_exp_category1` (`fin_exp_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1572 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_expense_list`
--

LOCK TABLES `fin_expense_list` WRITE;
/*!40000 ALTER TABLE `fin_expense_list` DISABLE KEYS */;
INSERT INTO `fin_expense_list` VALUES (1,'2014-05-15','test',700,'1','1','5343434','W','0',1,2,NULL,NULL),(2,'2014-05-08','auto fare',200,'1','1','34343434','W','0',2,2,NULL,NULL),(1006,'2014-07-28','2323',23,'1','1','34343434','W','0',3,2,NULL,NULL),(5,'2014-05-07','test',400,'1','','5343434','W','0',4,1,NULL,NULL),(6,'2014-05-08','test desc',300,'1','1','543434','W','0',5,2,NULL,NULL),(7,'2014-05-15','test ',200,'1','1','3232323','W','0',6,2,NULL,NULL),(8,'2014-05-16','test3',300,'1','1','53434','W','0',6,1,NULL,NULL),(9,'2014-05-22','test4',300,'1','1','6543434','W','0',6,2,NULL,NULL),(10,'2014-05-22','test55434',100,'1','','6454545','R','0',6,2,'bill not available',11),(11,'2014-05-07','test',333,'1','1','53434','W','0',7,2,NULL,NULL),(12,'2014-05-20','test33',23,'1','1','2342323','W','0',7,1,NULL,NULL),(13,'2014-05-22','test432',56,'','1','te34','W','0',7,1,NULL,NULL),(14,'2014-05-17','test323',88,'','','test','W','0',7,1,NULL,NULL),(15,'2014-05-07','test',200,'1','1','test555','W','0',8,2,NULL,NULL),(32,'2014-05-15','test',6,'','','','W','0',9,2,NULL,NULL),(31,'2014-05-14','test3',2,'','','434','W','0',9,1,NULL,NULL),(30,'2014-05-08','teee',11,'','','54545','W','0',9,2,NULL,NULL),(29,'2014-05-08','test55434',5,'','','43','W','0',9,1,NULL,NULL),(28,'2014-05-07','test ',1,'','','3434','W','0',9,2,NULL,NULL),(27,'2014-05-06','test',8,'','','','W','0',9,1,NULL,NULL),(26,'2014-05-02','test',3,'','','','W','0',9,2,NULL,NULL),(25,'2014-05-01','test',333,'','','','W','0',9,2,NULL,NULL),(33,'2014-05-16','test4',4,'','','43','W','0',9,2,NULL,NULL),(34,'2014-05-09','tes',65,'','','','W','0',9,1,NULL,NULL),(35,'2014-05-10','test',61,'','','','W','0',9,2,NULL,NULL),(36,'2014-05-03','test',1,'','','','W','0',9,2,NULL,NULL),(58,'2014-05-15','test33',23,'','','','W','0',10,2,NULL,NULL),(57,'2014-05-14','test',3,'','','','W','0',10,2,NULL,NULL),(56,'2014-05-13','t',3004,'','','','R','0',10,2,'bill not avail.',17),(55,'2014-05-10','test',45,'','','','W','0',10,2,NULL,NULL),(54,'2014-05-09','test',45,'','','','W','0',10,1,NULL,NULL),(53,'2014-05-03','test',4,'','','','W','0',10,2,NULL,NULL),(52,'2014-05-02','ttt',5,'','','','W','0',10,2,NULL,NULL),(51,'2014-05-01','test',45,'','','','W','0',10,2,NULL,NULL),(50,'2014-05-01','3434',45,'','','','W','0',10,2,NULL,NULL),(49,'2014-05-01','test ',100,'','','','W','0',10,1,NULL,NULL),(48,'2014-04-29','test',3,'','','','W','0',10,1,NULL,NULL),(59,'2014-05-02','test',128,'1','','4343434','W','0',10,2,NULL,NULL),(60,'2014-05-07','test',330,'1','1','5343434','W','0',11,2,NULL,NULL),(61,'2014-05-07','test',300,'1','1','tesr','W','0',12,1,NULL,NULL),(62,'2014-05-01','tt',1000,'','','','W','0',13,2,NULL,NULL),(63,'2014-05-01','erter',2300,'','','434343434','W','0',13,2,NULL,NULL),(64,'2014-05-16','rere',200,'','','343','W','0',13,2,NULL,NULL),(65,'2014-05-09','trerere',1600,'','','4343434','W','0',13,2,NULL,NULL),(66,'2014-05-23','test ex',444,'1','1','343434','W','0',14,2,NULL,NULL),(67,'2014-05-01','test',5000,'1','1','343434','W','0',15,2,NULL,NULL),(70,'2014-06-11','test',244,'1','1','232323','W','0',17,2,NULL,NULL),(71,'2014-06-11','Going to book the tickets for the travel',1288,'1','1','53434','W','0',18,2,NULL,NULL),(72,'2014-06-12','had lunch with my team',455,'1','','453434','W','0',18,1,NULL,NULL),(73,'2014-06-13','Purchase a laptop for the new project',434,'1','','2323','W','0',18,2,NULL,NULL),(74,'2014-06-14','Reach hospital for the new recruitmenet3',555,'','1','54545','W','0',18,1,NULL,NULL),(75,'2014-06-18','Went to engg. college for the new rec. process',323,'','1','232323','W','0',18,2,NULL,NULL),(76,'2014-06-03','poster printings',42,'1','1','564545','R','0',18,1,'bill not clear',17),(77,'2014-06-12','wall printing in the street',3232,'1','','576767','W','0',18,2,NULL,NULL),(78,'2014-06-02','Going to marina for watching movies',444,'','1','5565656','W','0',18,1,NULL,NULL),(1559,'2014-08-02','334',4,'','','','W','0',16,2,NULL,NULL),(1558,'2014-08-02','3',3,'','','','W','0',16,2,NULL,NULL),(1557,'2014-08-02','3',3232,'','','','W','0',16,2,NULL,NULL),(82,'2014-07-09','test',333,'1','1','34343','W','0',20,1,NULL,NULL),(83,'2014-07-21','tetr4e4',23,'1','1','3232','W','0',20,2,NULL,NULL),(84,'2014-07-29','rer',34,'1','','3434','W','0',20,2,NULL,NULL),(85,'2014-07-29','ere',43,'1','','34','W','0',20,2,NULL,NULL),(86,'2014-07-17','rerer',434,'','','343434','W','0',20,1,NULL,NULL),(1556,'2014-08-02','4343434',34,'1','1','','W','0',16,1,NULL,NULL),(1555,'2014-08-02','3',3,'','','','W','0',16,2,NULL,NULL),(1554,'2014-08-02','34',4,'','','','W','0',16,2,NULL,NULL),(1553,'2014-08-02','d',5,'','','','W','0',16,1,NULL,NULL),(1552,'2014-08-01','545',4,'','','','W','0',16,1,NULL,NULL),(1551,'2014-08-01','test',44,'','','','W','0',16,2,NULL,NULL),(1550,'2014-08-01','45',434,'','','','W','0',16,2,NULL,NULL),(1549,'2014-08-01','d',8,'','','','W','0',16,2,NULL,NULL),(1548,'2014-08-01','dfdfdf',4,'','','','W','0',16,1,NULL,NULL),(1547,'2014-08-01','4545',4,'','','','W','0',16,2,NULL,NULL),(1546,'2014-08-01','s',7,'','','','W','0',16,2,NULL,NULL),(1545,'2014-08-01','2',2,'','','','W','0',16,2,NULL,NULL),(1544,'2014-08-01','3',2,'','','','W','0',16,1,NULL,NULL),(1543,'2014-08-01','3',3,'','','','W','0',16,2,NULL,NULL),(1542,'2014-08-01','33433',22,'','','','W','0',16,1,NULL,NULL),(1541,'2014-07-31','f',6,'','','','W','0',16,2,NULL,NULL),(1540,'2014-07-29','fdf',33,'','','','W','0',16,1,NULL,NULL),(1539,'2014-07-29','2323',23,'','','','W','0',16,2,NULL,NULL),(1041,'2014-07-28','yyy',8,'1','1','787878','W','0',24,1,NULL,NULL),(1040,'2014-07-29','test',3,'','','','W','0',24,2,NULL,NULL),(1537,'2014-07-29','3',1,'','','','W','0',16,2,NULL,NULL),(1538,'2014-07-29','2323',144,'','','','W','0',16,2,NULL,NULL),(1536,'2014-07-29','fdf',2,'','','','W','0',16,2,NULL,NULL),(1535,'2014-07-29','dfd',2,'','','','W','0',16,1,NULL,NULL),(1534,'2014-07-29','fdf',4,'','','','W','0',16,2,NULL,NULL),(1533,'2014-07-29','3',18,'','','','W','0',16,2,NULL,NULL),(1532,'2014-07-28','3',1,'','','','W','0',16,1,NULL,NULL),(1531,'2014-07-28','34',33,'','','','W','0',16,2,NULL,NULL),(1530,'2014-07-28','34',1,'','','','W','0',16,2,NULL,NULL),(1529,'2014-07-28','34',34,'','','','W','0',16,2,NULL,NULL),(1528,'2014-07-28','2',2,'','','','W','0',16,2,NULL,NULL),(1527,'2014-07-28','3',34,'','','','W','0',16,2,NULL,NULL),(1526,'2014-07-28','4d',2,'','','','W','0',16,1,NULL,NULL),(1525,'2014-07-28','2',1,'','','','W','0',16,2,NULL,NULL),(1524,'2014-07-28','234234',4,'1','1','343434','W','0',16,1,NULL,NULL),(1523,'2014-07-28','3',25000,'','','','W','0',16,2,NULL,NULL),(1522,'2014-07-28','3',2,'','','','W','0',16,2,NULL,NULL),(1521,'2014-07-28','2',2,'','','','W','0',16,2,NULL,NULL),(1520,'2014-07-28','45',4,'','','4545','W','0',16,2,NULL,NULL),(1519,'2014-07-24','34',1,'','','','W','0',16,2,NULL,NULL),(894,'2014-07-29','erer\'ererer',1,'1','1','3\'43\'4','W','0',19,1,NULL,NULL),(1039,'2014-07-28','test',1,'','','','W','0',24,2,NULL,NULL),(1031,'2014-07-01','test',333,'1','1','343434','W','0',23,1,NULL,NULL),(1038,'2014-07-01','test',2,'','','','W','0',24,2,NULL,NULL),(1020,'2014-07-28','2323',66,'1','1','77777','W','0',21,2,NULL,NULL),(1030,'2014-07-29','3434',3434,'1','1','34343443','W','0',22,2,NULL,NULL),(1019,'2014-07-23','asdfasdf',34,'1','1','er3343434','W','0',21,2,NULL,NULL),(1005,'2014-07-28','23',22,'','','','W','0',3,2,NULL,NULL),(1018,'2014-07-22','d',34,'','','','W','0',21,2,NULL,NULL),(1017,'2014-07-01','d',3433,'','','','W','0',21,2,NULL,NULL),(1004,'2014-05-15','test',333,'','','test','W','0',3,2,NULL,NULL),(893,'2014-07-29','gyjhj\'yuyuyu',2,'1','1','677','W','0',19,2,NULL,NULL),(892,'2014-07-01','test2',44,'','','323','W','0',19,1,NULL,NULL),(891,'2014-06-30','test',45,'','','t4342','W','0',19,2,NULL,NULL),(890,'2014-06-18','test3',54,'','','434343434','W','0',19,2,NULL,NULL),(1518,'2014-07-23','6',1,'','','','W','0',16,2,NULL,NULL),(1517,'2014-07-22','3',1,'','','','W','0',16,2,NULL,NULL),(1516,'2014-07-21','4',1,'','','','W','0',16,2,NULL,NULL),(1515,'2014-07-21','3434',3,'1','1','','W','0',16,1,NULL,NULL),(1028,'2014-07-01','ererer',33,'1','1','3434','W','0',22,2,NULL,NULL),(1029,'2014-07-28','343',333,'1','1','343434','W','0',22,1,NULL,NULL),(1514,'2014-07-21','5',1,'','','','W','0',16,2,NULL,NULL),(1513,'2014-07-16','323',2,'','','','W','0',16,2,NULL,NULL),(1512,'2014-07-16','23',2,'','','','W','0',16,2,NULL,NULL),(1511,'2014-07-16','3',1,'','','','W','0',16,2,NULL,NULL),(1510,'2014-07-15','34',2,'','','','W','0',16,2,NULL,NULL),(1509,'2014-07-15','6',1,'','','','W','0',16,2,NULL,NULL),(1508,'2014-07-15','23',3,'','','','W','0',16,2,NULL,NULL),(1507,'2014-07-15','7',1,'','','','W','0',16,1,NULL,NULL),(1506,'2014-07-09','7',3,'','','','W','0',16,2,NULL,NULL),(1505,'2014-07-08','3',1,'','','','W','0',16,2,NULL,NULL),(1504,'2014-07-08','2',1,'','','','W','0',16,2,NULL,NULL),(1503,'2014-07-08','2',1,'','','','W','0',16,2,NULL,NULL),(1502,'2014-07-04','34',1,'','','','W','0',16,2,NULL,NULL),(1501,'2014-07-02','34',1,'','','','W','0',16,2,NULL,NULL),(1500,'2014-07-02','34',1,'','','','W','0',16,1,NULL,NULL),(1499,'2014-07-01','dfdf',2,'','','','W','0',16,2,NULL,NULL),(1498,'2014-07-01','23',2,'','','','W','0',16,2,NULL,NULL),(1497,'2014-07-01','dfdfdf',2,'','','','W','0',16,2,NULL,NULL),(1496,'2014-07-01','3',2,'','','','W','0',16,2,NULL,NULL),(1495,'2014-07-01','3',3,'','','','W','0',16,2,NULL,NULL),(1494,'2014-07-01','4',2,'','','','W','0',16,1,NULL,NULL),(1493,'2014-07-01','dfd',4,'','','','W','0',16,2,NULL,NULL),(1492,'2014-07-01','dfdf',5,'','','','W','0',16,2,NULL,NULL),(1491,'2014-07-01','2',2,'','','','W','0',16,2,NULL,NULL),(1490,'2014-06-19','1',333,'','','','W','0',16,2,NULL,NULL),(1489,'2014-06-19','test',333,'','','','W','0',16,2,NULL,NULL),(1560,'2014-08-02','f',2,'','','','W','0',16,1,NULL,NULL),(1561,'2014-08-02','d',3,'','','','W','0',16,2,NULL,NULL),(1562,'2014-08-02','88888',8,'','','','W','0',16,2,NULL,NULL),(1563,'2014-08-02','f',3,'','','','W','0',16,1,NULL,NULL),(1564,'2014-08-02','f',3,'','','','W','0',16,1,NULL,NULL),(1565,'2014-08-02','4545',4,'','','','W','0',16,2,NULL,NULL),(1566,'2014-08-02','45',4,'','','','W','0',16,2,NULL,NULL),(1567,'2014-08-02','454',4,'','','','W','0',16,2,NULL,NULL),(1568,'2014-08-02','45',5,'','','','W','0',16,2,NULL,NULL),(1569,'2014-08-02','3',4,'','','','W','0',16,1,NULL,NULL),(1570,'2014-08-02','f',3,'','','','W','0',16,1,NULL,NULL),(1571,'2014-08-01','test',100000,'','','','W','0',16,2,NULL,NULL);
/*!40000 ALTER TABLE `fin_expense_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_expenses`
--

DROP TABLE IF EXISTS `fin_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_no` varchar(10) NOT NULL,
  `amount` float DEFAULT NULL,
  `is_draft` set('Y','N') DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `reminder_bill` datetime DEFAULT NULL,
  `tsk_company_id` int(10) unsigned NOT NULL,
  `tsk_projects_id` int(10) unsigned NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `approve_by` int(11) DEFAULT NULL COMMENT 'finance team id',
  `approve_date` datetime DEFAULT NULL,
  `approve_status` enum('W','A','R') NOT NULL DEFAULT 'W',
  `is_approve` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N- Not approved by all\nY - Approved by all',
  PRIMARY KEY (`id`),
  KEY `fk_fin_expenses_app_users1` (`app_users_id`),
  KEY `fk_fin_expenses_tsk_company1` (`tsk_company_id`),
  KEY `fk_fin_expenses_tsk_projects1` (`tsk_projects_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_expenses`
--

LOCK TABLES `fin_expenses` WRITE;
/*!40000 ALTER TABLE `fin_expenses` DISABLE KEYS */;
INSERT INTO `fin_expenses` VALUES (1,'101',700,'N','2014-05-22 19:06:14',NULL,19,NULL,2,3,'N',11,'2014-05-22 19:07:40','A','Y'),(2,'102',200,'N','2014-05-22 19:39:17',NULL,19,NULL,2,3,'N',11,'2014-05-22 19:40:00','A','Y'),(3,'103',378,'Y','2014-05-22 19:51:56','2014-07-29 20:33:01',11,NULL,2,3,'N',NULL,NULL,'W','N'),(4,'104',400,'N','2014-05-23 10:58:27',NULL,7,NULL,2,3,'N',11,'2014-05-23 11:02:29','A','Y'),(5,'105',300,'N','2014-05-23 10:59:06',NULL,7,NULL,1,1,'N',11,'2014-05-23 11:02:15','A','Y'),(6,'106',800,'N','2014-05-23 11:00:34',NULL,25,NULL,2,3,'N',11,'2014-05-23 11:01:51','A','Y'),(7,'107',500,'N','2014-05-23 11:28:21',NULL,21,NULL,1,1,'N',17,'2014-05-23 11:29:09','A','Y'),(8,'108',200,'N','2014-05-23 12:26:04',NULL,21,NULL,2,3,'N',11,'2014-05-23 12:27:17','A','Y'),(9,'109',500,'N','2014-05-23 16:08:37','2014-05-23 16:09:03',21,NULL,1,1,'N',11,'2014-05-23 16:10:40','A','Y'),(10,'110',446,'N','2014-05-23 16:14:56','2014-05-23 16:15:16',21,NULL,2,3,'N',17,'2014-05-23 16:16:21','A','Y'),(11,'111',330,'N','2014-05-23 16:31:45',NULL,21,NULL,1,1,'N',11,'2014-05-23 16:32:09','A','N'),(12,'112',300,'N','2014-05-23 16:48:55',NULL,21,NULL,2,3,'N',11,'2014-05-23 16:49:35','A','Y'),(13,'113',5100,'N','2014-05-23 16:56:59',NULL,21,NULL,2,3,'N',11,'2014-05-23 16:57:47','A','Y'),(14,'114',444,'N','2014-05-23 17:01:15',NULL,21,NULL,2,3,'N',17,'2014-05-23 17:01:56','A','Y'),(15,'115',5000,'N','2014-05-23 17:04:47',NULL,21,NULL,2,3,'N',11,'2014-05-23 17:05:32','A','Y'),(16,'116',129934,'Y','2014-06-19 17:52:00','2014-08-02 10:50:15',19,NULL,2,3,'N',NULL,NULL,'W','N'),(17,'117',244,'N','2014-06-28 20:06:57',NULL,10,NULL,2,3,'N',17,'2014-06-28 20:13:51','A','N'),(18,'118',6731,'N','2014-06-29 12:32:21',NULL,19,NULL,1,1,'N',17,'2014-06-29 13:03:15','A','Y'),(19,'119',146,'Y','2014-07-04 10:12:48','2014-07-29 19:21:25',19,NULL,1,1,'N',NULL,NULL,'W','N'),(20,'120',867,'Y','2014-07-29 14:27:00',NULL,15,NULL,2,3,'N',NULL,NULL,'W','N'),(21,'121',3567,'Y','2014-07-29 20:23:22','2014-07-29 20:34:37',11,NULL,2,3,'N',NULL,NULL,'W','N'),(22,'122',3800,'Y','2014-07-29 20:36:24','2014-07-29 20:36:47',11,NULL,1,1,'N',NULL,NULL,'W','N'),(23,'123',333,'N','2014-07-31 12:50:42',NULL,17,NULL,2,3,'N',NULL,NULL,'W','N'),(24,'124',14,'Y','2014-07-31 12:55:41','2014-07-31 12:56:16',17,NULL,2,3,'N',NULL,NULL,'W','N');
/*!40000 ALTER TABLE `fin_expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_attendance`
--

DROP TABLE IF EXISTS `hr_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_attendance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `in_time` datetime NOT NULL,
  `out_time` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `status` enum('W','A','R') NOT NULL DEFAULT 'W',
  `approve_date` datetime DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `late_reason` text,
  `is_permission` set('1','0') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_hr_attendance_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_attendance`
--

LOCK TABLES `hr_attendance` WRITE;
/*!40000 ALTER TABLE `hr_attendance` DISABLE KEYS */;
INSERT INTO `hr_attendance` VALUES (1,'2014-03-24 13:55:14','2014-03-24 13:55:28',NULL,11,'A','2014-07-31 17:32:29',17,NULL,'0'),(2,'2014-03-25 09:16:02','2014-03-25 09:16:06',NULL,11,'A','2014-07-31 17:31:55',17,NULL,'0'),(3,'2014-03-26 12:26:18','2014-03-26 12:26:18',NULL,19,'A','2014-08-02 09:50:43',10,'i am late','0'),(4,'2014-03-26 17:16:18','2014-03-26 17:18:50',NULL,17,'R','2014-04-30 17:48:40',10,NULL,'0'),(5,'2014-03-27 10:20:34','2014-03-27 13:26:56',NULL,17,'A','2014-04-30 17:48:41',10,NULL,'0'),(6,'2014-03-27 16:19:26','2014-03-27 16:19:28',NULL,11,'A','2014-07-31 17:32:32',17,NULL,'0'),(7,'2014-03-27 16:38:56','2014-03-27 16:41:17',NULL,10,'A','2014-05-20 12:17:36',19,NULL,'0'),(8,'2014-03-27 17:46:27','2014-03-27 19:41:31',NULL,19,'R','2014-04-30 17:48:39',10,NULL,'0'),(9,'2014-03-28 10:14:18','2014-03-28 10:14:29',NULL,17,'A','2014-04-30 17:48:38',10,NULL,'0'),(10,'2014-03-28 19:37:02','2014-03-28 19:37:14',NULL,10,'A','2014-05-20 12:17:47',19,NULL,'0'),(11,'2014-03-28 20:08:44','2014-03-28 20:09:39',NULL,7,'A','2014-04-30 17:48:37',10,NULL,'0'),(12,'2014-03-29 09:32:29','2014-03-29 16:55:16',NULL,17,'A','2014-04-30 17:48:37',10,NULL,'0'),(13,'2014-03-29 13:36:07','2014-03-29 15:28:37',NULL,10,'A','2014-05-20 12:17:36',19,NULL,'0'),(14,'2014-03-29 17:49:16',NULL,NULL,11,'W',NULL,NULL,NULL,'0'),(15,'2014-03-30 11:18:26','2014-03-30 12:47:15',NULL,17,'R','2014-04-30 17:48:36',10,NULL,'0'),(16,'2014-03-30 11:35:37','2014-03-30 11:44:50',NULL,10,'A','2014-05-20 12:17:38',19,NULL,'0'),(17,'2014-03-31 13:10:08','2014-03-31 13:10:50',NULL,17,'A','2014-04-30 17:48:35',10,NULL,'0'),(18,'2014-03-31 19:49:04',NULL,NULL,10,'R','2014-05-20 12:17:35',19,NULL,'0'),(19,'2014-04-01 09:47:47',NULL,NULL,17,'A','2014-04-30 17:48:35',10,NULL,'0'),(20,'2014-04-02 17:36:19',NULL,NULL,17,'R','2014-04-30 17:48:34',10,NULL,'0'),(21,'2014-04-03 09:14:57','2014-04-03 17:32:13',NULL,17,'R','2014-04-30 17:48:34',10,NULL,'0'),(22,'2014-04-04 09:23:08',NULL,NULL,17,'R','2014-04-30 17:48:33',10,NULL,'0'),(23,'2014-04-04 13:39:03','2014-04-04 18:06:38',NULL,19,'R','2014-04-30 17:48:32',10,NULL,'0'),(24,'2014-04-05 09:19:34',NULL,NULL,17,'R','2014-04-30 17:48:32',10,NULL,'0'),(25,'2014-04-05 18:33:19',NULL,NULL,19,'A','2014-04-30 17:48:31',10,NULL,'0'),(26,'2014-04-06 11:22:20','2014-04-06 12:05:15',NULL,17,'A','2014-04-30 17:48:31',10,NULL,'0'),(27,'2014-04-07 09:28:07',NULL,NULL,17,'A','2014-04-30 17:48:30',10,NULL,'0'),(28,'2014-04-07 09:29:54',NULL,NULL,19,'A','2014-04-30 17:48:29',10,NULL,'0'),(29,'2014-04-07 16:10:05','2014-04-07 20:14:58',NULL,11,'A','2014-07-31 17:31:56',17,NULL,'0'),(30,'2014-04-07 16:11:03',NULL,NULL,7,'A','2014-04-30 17:48:29',10,NULL,'0'),(31,'2014-04-08 09:15:02',NULL,NULL,17,'A','2014-04-30 17:48:28',10,NULL,'0'),(32,'2014-04-08 09:30:21',NULL,NULL,11,'W',NULL,NULL,NULL,'0'),(33,'2014-04-08 11:29:44',NULL,NULL,7,'A','2014-04-30 17:48:28',10,NULL,'0'),(34,'2014-04-08 12:49:08',NULL,NULL,10,'R','2014-05-20 12:17:34',19,NULL,'0'),(35,'2014-04-08 13:23:34',NULL,NULL,19,'A','2014-04-30 17:48:27',10,NULL,'0'),(36,'2014-04-09 11:20:14',NULL,NULL,10,'R','2014-05-03 13:45:40',19,NULL,'0'),(37,'2014-04-09 12:46:49',NULL,NULL,19,'A','2014-04-30 17:48:26',10,NULL,'0'),(38,'2014-04-09 13:31:11',NULL,NULL,11,'W',NULL,NULL,NULL,'0'),(39,'2014-04-09 21:30:19','2014-04-09 21:30:21',NULL,17,'A','2014-04-30 17:48:26',10,NULL,'0'),(40,'2014-04-10 09:21:33',NULL,NULL,19,'A','2014-04-30 17:48:25',10,NULL,'0'),(41,'2014-04-10 20:00:28','2014-04-10 20:10:47',NULL,11,'A','2014-07-31 17:32:33',17,NULL,'0'),(42,'2014-04-11 09:45:59',NULL,NULL,19,'A','2014-04-30 17:48:24',10,NULL,'0'),(43,'2014-04-11 09:49:06',NULL,NULL,11,'W',NULL,NULL,NULL,'0'),(44,'2014-04-11 11:13:41',NULL,NULL,7,'A','2014-04-30 17:48:24',10,NULL,'0'),(45,'2014-04-11 12:11:43','2014-04-11 14:02:47',NULL,10,'R','2014-05-03 13:47:32',19,NULL,'0'),(46,'2014-04-11 17:17:04',NULL,NULL,17,'A','2014-04-30 17:48:23',10,NULL,'0'),(69,'2014-04-12 11:53:23','2014-04-12 11:53:32',NULL,10,'A','2014-05-03 13:47:28',19,NULL,'0'),(70,'2014-04-12 12:23:40',NULL,NULL,19,'R','2014-04-30 17:48:23',10,NULL,'0'),(71,'2014-04-12 12:24:13',NULL,NULL,17,'R','2014-04-30 17:48:22',10,NULL,'0'),(72,'2014-04-13 14:15:09','2014-04-13 18:11:27',NULL,19,'R','2014-04-30 17:48:22',10,NULL,'0'),(73,'2014-04-14 10:21:40','2014-04-14 14:56:12',NULL,19,'R','2014-04-30 17:48:21',10,NULL,'0'),(74,'2014-04-14 15:06:12',NULL,NULL,17,'R','2014-04-30 17:48:21',10,NULL,'0'),(75,'2014-04-15 09:14:29','2018-00-00 00:00:00','2014-04-19 10:00:37',10,'A','2014-05-03 13:47:08',19,NULL,'0'),(76,'2014-04-15 15:38:07','2014-04-15 18:26:54',NULL,40,'W',NULL,NULL,NULL,'0'),(77,'2014-04-15 20:44:09','2014-04-15 20:44:14',NULL,11,'A','2014-05-02 17:41:39',17,NULL,'0'),(78,'2014-04-16 10:16:33','2014-04-16 18:49:26',NULL,19,'R','2014-04-30 17:48:20',10,NULL,'0'),(79,'2014-04-17 09:10:03','0000-00-00 00:00:00','2014-04-19 09:51:04',10,'A','2014-05-03 13:45:47',19,NULL,'0'),(80,'2014-04-17 09:12:05',NULL,NULL,11,'R','2014-05-02 17:41:38',17,NULL,'0'),(81,'2014-04-17 09:25:40','2014-04-17 18:00:00','2014-04-19 10:08:06',19,'R','2014-04-30 17:48:19',10,NULL,'0'),(82,'2014-04-17 12:05:08','2014-04-17 13:09:02',NULL,40,'W',NULL,NULL,NULL,'0'),(83,'2014-04-17 18:41:07','2014-04-17 18:57:51',NULL,7,'R','2014-04-30 17:48:19',10,NULL,'0'),(84,'2014-04-18 09:55:21',NULL,NULL,19,'R','2014-04-30 17:48:18',10,NULL,'0'),(85,'2014-04-18 12:53:54',NULL,NULL,7,'R','2014-04-30 17:48:17',10,NULL,'0'),(86,'2014-04-18 13:32:27',NULL,NULL,11,'R','2014-05-02 17:41:36',17,NULL,'0'),(87,'2014-04-18 17:19:57','2014-04-18 19:44:51',NULL,10,'R','2014-05-03 13:45:52',19,NULL,'0'),(88,'2014-04-18 18:21:16',NULL,NULL,17,'R','2014-04-30 17:48:17',10,NULL,'0'),(89,'2014-04-19 09:43:28',NULL,NULL,19,'R','2014-04-30 17:48:16',10,NULL,'0'),(90,'2014-04-19 09:45:02',NULL,NULL,10,'A','2014-05-03 13:45:50',19,NULL,'0'),(128,'2014-04-29 12:56:22',NULL,NULL,10,'A','2014-05-03 13:45:44',19,'i went to client meeting...','0'),(126,'2014-04-29 12:16:57',NULL,NULL,17,'A','2014-04-30 17:48:13',10,NULL,'0'),(125,'2014-04-29 09:33:02',NULL,NULL,19,'R','2014-04-30 17:48:14',10,NULL,'0'),(124,'2014-04-28 20:12:25','2014-04-28 20:14:08',NULL,17,'R','2014-04-30 17:48:14',10,NULL,'0'),(99,'2014-04-15 09:00:00','2014-04-15 19:00:00','2014-04-19 10:06:31',19,'R','2014-04-30 17:48:20',10,NULL,'0'),(100,'2014-04-21 16:22:48',NULL,NULL,17,'R','2014-04-30 17:48:15',10,NULL,'0'),(129,'2014-04-30 11:38:25',NULL,NULL,19,'A','2014-04-30 17:48:12',10,'went to home','0'),(130,'2014-04-30 15:59:28',NULL,NULL,54,'W',NULL,NULL,'sorry, late','0'),(131,'2014-05-01 12:38:41',NULL,NULL,19,'R','2014-05-14 20:14:35',10,'ok','0'),(132,'2014-05-01 16:45:10',NULL,NULL,11,'A','2014-05-02 17:41:34',17,'ppp','0'),(133,'2014-05-02 17:41:43',NULL,NULL,17,'A','2014-05-14 20:14:33',10,'fff','0'),(134,'2014-04-14 00:00:00','2014-04-14 23:00:00','2014-05-02 20:38:07',10,'R','2014-05-03 13:47:12',19,NULL,'0'),(135,'2014-05-03 10:58:09',NULL,NULL,17,'R','2014-05-14 20:14:32',10,'Began the work at client site Gamesa at 9am itself','0'),(136,'2014-05-03 09:58:09',NULL,NULL,9,'A','2014-05-14 20:14:34',10,NULL,'0'),(137,'2014-05-03 11:17:27','2014-05-03 17:49:01',NULL,19,'A','2014-05-14 20:14:37',10,'','0'),(138,'2014-05-12 20:27:14',NULL,NULL,10,'A','2014-05-20 12:17:32',19,'kkk','0'),(139,'2014-05-13 18:32:27',NULL,NULL,19,'A','2014-05-14 20:14:22',10,'problem in office wiring','0'),(140,'2014-05-13 18:33:36',NULL,NULL,54,'W',NULL,NULL,'i went to my native place','0'),(141,'2014-05-14 11:46:52',NULL,NULL,19,'R','2014-05-14 20:14:26',10,'ok','0'),(142,'2014-05-14 20:15:01',NULL,NULL,10,'R','2014-05-20 12:17:33',19,'.','0'),(143,'2014-05-16 10:51:13',NULL,NULL,19,'W',NULL,NULL,'t','0'),(144,'2014-05-08 00:00:00','2014-05-08 00:00:00','2014-05-16 12:51:36',10,'A','2014-05-20 12:13:57',19,NULL,'0'),(145,'2014-05-12 00:00:00','2014-05-12 00:00:00','2014-05-16 12:53:34',10,'R','2014-05-20 12:17:34',19,NULL,'0'),(146,'2014-05-06 00:00:00',NULL,NULL,21,'W',NULL,NULL,NULL,'0'),(147,'2014-06-02 06:43:01',NULL,NULL,34,'W',NULL,NULL,'','0'),(148,'2014-06-02 06:48:11',NULL,NULL,19,'W',NULL,NULL,'','0'),(149,'2014-06-03 10:56:53',NULL,NULL,19,'W',NULL,NULL,'ok','0'),(150,'2014-06-04 12:16:42',NULL,NULL,54,'W',NULL,NULL,'test','0'),(151,'2014-06-14 19:05:34','2014-06-14 19:09:23',NULL,19,'R','2014-06-20 19:55:32',10,'','0'),(152,'2014-06-19 19:05:34','2014-06-19 00:00:00','2014-07-11 20:51:33',19,'A','2014-06-20 19:55:38',10,NULL,'0'),(161,'2014-06-20 18:09:24','2014-06-20 18:09:24',NULL,10,'R','2014-06-24 10:47:06',17,NULL,'0'),(154,'0000-00-00 00:00:00','2014-06-10 00:00:00','2014-06-20 18:05:24',0,'W',NULL,NULL,NULL,'0'),(155,'0000-00-00 00:00:00','2014-06-12 00:00:00','2014-06-20 18:56:26',0,'W',NULL,NULL,NULL,'0'),(156,'0000-00-00 00:00:00','2014-06-12 00:00:00','2014-06-20 19:22:10',0,'W',NULL,NULL,NULL,'0'),(157,'0000-00-00 00:00:00','2014-06-18 00:00:00','2014-06-20 19:27:16',0,'W',NULL,NULL,NULL,'0'),(158,'2014-06-18 00:00:00',NULL,'2014-06-20 19:27:32',0,'W',NULL,NULL,NULL,'0'),(159,'2014-06-20 19:47:05','2014-06-20 19:47:08',NULL,19,'A','2014-07-05 10:31:11',10,'','0'),(160,'2014-06-21 18:09:24','2014-06-21 00:00:00',NULL,10,'A','2014-07-03 09:53:32',19,'test','0'),(162,'2014-06-17 16:38:56','2014-06-17 16:38:56',NULL,10,'A',NULL,NULL,NULL,'0'),(163,'2014-06-23 16:38:56','2014-06-23 16:38:56',NULL,11,'A','2014-07-31 17:32:26',17,NULL,'0'),(164,'2014-06-17 16:38:56','2014-06-17 16:38:56',NULL,7,'A','2014-07-31 11:56:23',10,NULL,'0'),(165,'2014-06-18 16:38:56','2014-06-18 16:38:56',NULL,7,'R','2014-07-12 13:13:26',10,NULL,'0'),(166,'2014-06-20 16:38:56','2014-06-20 16:38:56',NULL,7,'R','2014-07-05 10:31:09',10,NULL,'0'),(170,'2014-06-25 15:37:45',NULL,NULL,5,'W',NULL,NULL,'','0'),(179,'2014-06-25 17:10:45','2014-06-25 17:10:59',NULL,10,'A','2014-07-05 10:29:53',19,'sporry i am latee','0'),(178,'2014-06-25 17:09:42','2014-06-25 17:09:55',NULL,19,'A','2014-07-02 18:58:46',10,'sorry late','0'),(180,'2014-06-28 09:57:22',NULL,NULL,19,'W',NULL,NULL,'test','0'),(181,'2014-07-03 09:49:28',NULL,NULL,19,'W',NULL,NULL,'test','0'),(182,'2014-07-05 10:30:13',NULL,NULL,19,'W',NULL,NULL,'tesy','0'),(183,'2014-07-05 10:31:31',NULL,NULL,10,'W',NULL,NULL,'0','0'),(184,'2014-07-11 20:36:52','2014-07-11 20:37:28',NULL,19,'A','2014-07-12 12:17:26',10,'test','0'),(185,'2014-06-09 00:00:00','2014-06-09 00:00:00','2014-07-11 20:48:24',19,'A','2014-07-31 11:56:22',10,NULL,'0'),(186,'0000-00-00 00:00:00','2014-06-11 00:00:00','2014-07-11 20:49:29',0,'W',NULL,NULL,NULL,'0'),(187,'2014-06-06 00:00:00','2014-06-06 00:00:00','2014-07-11 21:05:52',17,'R','2014-07-31 11:56:25',10,NULL,'0'),(188,'0000-00-00 00:00:00','2014-06-16 00:00:00','2014-07-11 21:06:24',0,'W',NULL,NULL,NULL,'0'),(189,'2014-06-11 09:00:00','2014-06-11 12:15:00','2014-07-11 21:10:44',11,'A','2014-07-31 17:32:25',17,NULL,'0'),(190,'2014-06-18 09:00:00','2014-06-18 23:15:00','2014-07-11 21:12:33',11,'A','2014-07-31 17:32:35',17,NULL,'0'),(191,'2014-07-10 23:15:00',NULL,NULL,17,'W',NULL,NULL,NULL,'0'),(201,'2014-07-17 11:10:17',NULL,NULL,5,'W',NULL,NULL,'test','0'),(200,'2014-07-15 20:14:45','2014-07-15 20:15:14',NULL,5,'W',NULL,NULL,'tet','0'),(202,'2014-07-18 20:14:45','2014-07-18 20:14:45',NULL,19,'A','2014-07-31 11:56:20',10,NULL,'0'),(203,'2014-07-19 20:19:20',NULL,NULL,19,'W',NULL,NULL,'test','0'),(204,'2014-07-20 12:58:16','2014-07-20 20:57:18',NULL,10,'W',NULL,NULL,'te','0'),(205,'2014-07-20 20:07:53','2014-07-20 20:15:26',NULL,5,'W',NULL,NULL,'for testing','0'),(206,'2014-07-21 10:09:50','2014-07-21 17:25:35',NULL,10,'W',NULL,NULL,'test','0'),(207,'2014-07-21 11:06:02',NULL,NULL,11,'W',NULL,NULL,'sorry','0'),(208,'2014-07-21 11:20:33','2014-07-21 17:29:59',NULL,5,'W',NULL,NULL,'ok','0'),(209,'2014-07-22 14:24:26',NULL,NULL,19,'W',NULL,NULL,'l','0'),(210,'2014-07-22 16:40:41',NULL,NULL,7,'W',NULL,NULL,'y','0'),(211,'2014-07-22 17:17:29',NULL,NULL,5,'W',NULL,NULL,'j','0'),(212,'2014-07-22 17:20:02',NULL,NULL,17,'W',NULL,NULL,'ok','0'),(213,'2014-07-22 18:39:07',NULL,NULL,16,'W',NULL,NULL,'f','0'),(214,'2014-07-23 10:51:17',NULL,NULL,16,'W',NULL,NULL,'i am late sir.','0'),(215,'2014-07-06 10:51:17',NULL,NULL,19,'W',NULL,NULL,NULL,'0'),(216,'2014-07-20 13:34:31',NULL,NULL,19,'W',NULL,NULL,'test','0'),(217,'2014-07-13 10:51:17',NULL,NULL,19,'W',NULL,NULL,NULL,'0'),(218,'2014-07-24 13:51:21','2014-07-24 14:15:33',NULL,11,'A','2014-07-31 17:32:27',17,'test','0'),(219,'2014-07-24 21:19:02','2014-07-24 21:19:04',NULL,10,'W',NULL,NULL,'h','0'),(220,'2014-07-25 09:26:27',NULL,NULL,19,'W',NULL,NULL,NULL,'0'),(221,'2014-07-25 10:59:25',NULL,NULL,15,'W',NULL,NULL,'ok','0'),(222,'2014-07-25 19:35:44','2014-07-25 19:35:46',NULL,10,'W',NULL,NULL,'ok','0'),(223,'2014-07-26 09:59:23',NULL,NULL,10,'W',NULL,NULL,'f','0'),(224,'2014-07-26 12:21:11',NULL,NULL,19,'W',NULL,NULL,'test','0'),(225,'2014-07-15 12:21:11','2014-07-15 12:21:11',NULL,10,'A',NULL,NULL,NULL,'0'),(226,'2014-07-20 12:21:11','2014-07-20 12:21:11',NULL,10,'A',NULL,NULL,NULL,'0'),(227,'2014-06-29 12:21:11','2014-06-29 12:21:11',NULL,10,'W',NULL,NULL,NULL,'0'),(228,'2014-07-26 19:32:52',NULL,NULL,7,'W',NULL,NULL,'t','0'),(229,'2014-07-26 20:12:14',NULL,NULL,11,'W',NULL,NULL,'d','0'),(230,'2014-07-27 10:33:42',NULL,NULL,10,'W',NULL,NULL,'h','0'),(231,'2014-07-27 16:46:09',NULL,NULL,19,'W',NULL,NULL,'ij','0'),(232,'2014-07-27 16:49:04',NULL,NULL,15,'W',NULL,NULL,'ij','0'),(233,'2014-07-28 16:53:02',NULL,NULL,19,'W',NULL,NULL,'g','0'),(234,'2014-07-24 00:00:00','2014-07-24 00:00:00','2014-07-29 15:15:40',19,'A','2014-07-31 11:56:19',10,NULL,'0'),(235,'2014-07-23 08:00:00','2014-07-23 16:30:00','2014-07-29 15:20:35',19,'A','2014-07-31 11:56:18',10,NULL,'0'),(236,'2014-07-26 08:00:00','2014-07-26 08:00:00',NULL,19,'A',NULL,NULL,NULL,'0'),(237,'2014-07-29 18:19:06',NULL,NULL,19,'W',NULL,NULL,'d','0'),(238,'2014-07-31 09:28:14',NULL,NULL,10,'W',NULL,NULL,NULL,'0'),(239,'2014-07-31 09:28:23',NULL,NULL,15,'W',NULL,NULL,NULL,'0'),(240,'2014-07-31 11:54:53',NULL,NULL,11,'W',NULL,NULL,'test','0'),(251,'2014-07-30 17:44:35','2014-07-30 17:44:35',NULL,17,'W',NULL,NULL,'sorry sir not able to come','1'),(252,'2014-08-02 09:50:32',NULL,NULL,10,'W',NULL,NULL,'test','0'),(253,'2014-08-02 09:52:08',NULL,NULL,19,'W',NULL,NULL,'ok','0'),(254,'2014-08-03 12:03:44',NULL,NULL,19,'W',NULL,NULL,'g','0');
/*!40000 ALTER TABLE `hr_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_attendance_change`
--

DROP TABLE IF EXISTS `hr_attendance_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_attendance_change` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `att_date` date NOT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `att_type` set('I','O','B') NOT NULL COMMENT 'I - In time\nO - Out time\nB - Both time',
  `reason` text NOT NULL,
  `created_date` datetime NOT NULL,
  `is_approve` enum('N','Y','R') NOT NULL DEFAULT 'N',
  `read_status` enum('1','0') NOT NULL DEFAULT '0',
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_attendance_change`
--

LOCK TABLES `hr_attendance_change` WRITE;
/*!40000 ALTER TABLE `hr_attendance_change` DISABLE KEYS */;
INSERT INTO `hr_attendance_change` VALUES (1,'2014-06-05','00:00:00',NULL,'I','test','2014-06-20 15:54:12','N','0',17),(2,'2014-06-05',NULL,'00:00:00','O','test','2014-06-20 15:54:59','N','0',17),(3,'2014-06-06','00:00:00','00:00:00','B','test','2014-06-20 15:55:47','Y','0',17),(4,'2014-06-16',NULL,'00:00:00','O','test','2014-06-20 15:59:39','Y','0',17),(5,'2014-06-13','00:00:00','00:00:00','B','test','2014-06-20 16:18:55','N','0',17),(6,'2014-06-17','00:00:00','00:00:00','B','test','2014-06-20 16:22:55','N','0',17),(7,'2013-12-02','00:00:00','00:00:00','B','test','2014-06-20 16:29:06','N','0',17),(8,'2013-10-15','00:00:00','00:00:00','B','test','2014-06-20 16:30:11','N','0',17),(10,'2014-06-19',NULL,'00:00:00','O','test','2014-06-20 16:44:58','Y','0',19),(11,'2014-06-12','00:00:00',NULL,'I','test','2014-06-20 16:54:02','N','0',19),(12,'2014-06-13','00:00:00',NULL,'I','test','2014-06-20 16:57:59','N','0',19),(13,'2014-06-13','00:00:00','00:00:00','B','test','2014-06-20 17:06:39','N','0',19),(14,'2014-06-10','00:00:00',NULL,'I','test','2014-06-20 17:07:08','N','0',19),(15,'2014-06-10',NULL,'00:00:00','O','test','2014-06-20 17:17:40','Y','0',19),(16,'2014-06-12','09:30:00',NULL,'I','','2014-06-20 17:17:40','N','0',10),(17,'2014-06-13','09:30:00',NULL,'I','','2014-06-20 17:17:40','N','0',10),(18,'2014-06-14','09:30:00',NULL,'I','','2014-06-20 17:17:40','N','0',10),(29,'2014-06-17','00:00:00','00:00:00','B','test','2014-06-20 19:09:08','N','0',19),(28,'2014-06-11',NULL,'00:00:00','O','test','2014-06-20 19:05:56','Y','0',19),(27,'2014-06-13',NULL,'00:00:00','O','test','2014-06-20 18:56:58','N','0',10),(26,'2014-06-12',NULL,'00:00:00','O','test','2014-06-20 18:55:57','Y','0',10),(25,'2014-06-12',NULL,'00:00:00','O','test','2014-06-20 18:53:35','R','0',10),(24,'2014-06-05','00:00:00','00:00:00','B','test','2014-06-20 18:01:34','Y','0',10),(30,'2014-06-09','00:00:00','00:00:00','B','test','2014-06-20 19:17:15','Y','0',19),(31,'2014-06-12',NULL,'00:00:00','O','test','2014-06-20 19:20:28','Y','0',19),(32,'2014-06-18','00:00:00',NULL,'I','test','2014-06-20 19:25:45','Y','0',19),(33,'2014-06-18',NULL,'00:00:00','O','test','2014-06-20 19:26:22','Y','0',19),(34,'2014-06-11','00:00:00',NULL,'I','test','2014-06-20 19:32:55','N','0',10),(35,'2014-06-11',NULL,'00:00:00','O','test','2014-06-20 19:33:31','N','0',10),(36,'2014-06-11',NULL,'12:15:00','O','test','2014-07-11 21:09:29','Y','0',11),(37,'2014-06-18','09:00:00','23:15:00','B','test','2014-07-11 21:11:46','Y','0',11),(38,'2014-07-10',NULL,'18:30:00','O','test','2014-07-12 11:12:26','N','0',17),(39,'2014-07-17','00:00:00','00:00:00','B','t','2014-07-22 18:16:56','N','0',7),(40,'2014-07-15','00:00:00','00:00:00','B','test','2014-07-22 18:39:37','N','0',16),(41,'2014-07-18','00:00:00','00:00:00','B','test','2014-07-22 18:40:00','N','0',16),(42,'2014-07-21','00:00:00','00:00:00','B','test','2014-07-22 18:40:21','N','0',16),(43,'2014-06-23','00:00:00','00:00:00','B','test','2014-07-22 18:57:08','N','0',16),(44,'2014-07-18','00:00:00','00:00:00','B','t','2014-07-22 19:00:18','N','0',7),(45,'2014-07-24','00:00:00','00:00:00','B','test','2014-07-29 15:14:43','Y','0',19),(46,'2014-07-23','08:00:00','16:30:00','B','df','2014-07-29 15:19:58','Y','0',19);
/*!40000 ALTER TABLE `hr_attendance_change` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_attendance_reminder`
--

DROP TABLE IF EXISTS `hr_attendance_reminder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_attendance_reminder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `reminder_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_app_users1_idx` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_attendance_reminder`
--

LOCK TABLES `hr_attendance_reminder` WRITE;
/*!40000 ALTER TABLE `hr_attendance_reminder` DISABLE KEYS */;
INSERT INTO `hr_attendance_reminder` VALUES (1,10,'0000-00-00'),(2,19,'0000-00-00'),(3,35,'0000-00-00'),(4,54,'0000-00-00'),(5,56,'0000-00-00'),(6,10,'0000-00-00'),(7,19,'0000-00-00'),(8,35,'0000-00-00'),(9,54,'0000-00-00'),(10,56,'0000-00-00'),(11,7,'0000-00-00'),(12,10,'0000-00-00'),(13,19,'0000-00-00'),(14,35,'0000-00-00'),(15,54,'0000-00-00'),(16,56,'0000-00-00'),(17,7,'0000-00-00'),(18,10,'0000-00-00'),(19,19,'0000-00-00'),(20,35,'0000-00-00'),(21,54,'0000-00-00'),(22,56,'0000-00-00'),(23,54,'0000-00-00'),(24,7,'2014-06-24'),(25,10,'2014-06-24'),(26,19,'2014-06-24'),(27,35,'2014-06-24'),(28,54,'2014-06-24'),(29,56,'2014-06-24'),(30,7,'2014-07-01'),(31,10,'2014-07-01'),(32,19,'2014-07-01'),(33,35,'2014-07-01'),(34,54,'2014-07-01'),(35,56,'2014-07-01'),(36,35,'2014-07-03'),(37,56,'2014-07-03'),(38,7,'2014-07-21'),(39,7,'2014-07-21'),(40,10,'2014-07-21'),(41,19,'2014-07-21'),(42,10,'2014-07-21'),(43,35,'2014-07-21'),(44,19,'2014-07-21'),(45,54,'2014-07-21'),(46,35,'2014-07-21'),(47,56,'2014-07-21'),(48,54,'2014-07-21'),(49,56,'2014-07-21'),(50,7,'2014-07-22'),(51,10,'2014-07-22'),(52,19,'2014-07-22'),(53,35,'2014-07-22'),(54,54,'2014-07-22'),(55,56,'2014-07-22'),(56,7,'2014-07-22'),(57,10,'2014-07-22'),(58,19,'2014-07-22'),(59,35,'2014-07-22'),(60,54,'2014-07-22'),(61,56,'2014-07-22'),(62,7,'2014-07-22'),(63,10,'2014-07-22'),(64,19,'2014-07-22'),(65,35,'2014-07-22'),(66,54,'2014-07-22'),(67,56,'2014-07-22'),(68,35,'2014-07-22'),(69,56,'2014-07-22'),(70,35,'2014-07-22'),(71,56,'2014-07-22'),(72,35,'2014-07-22'),(73,56,'2014-07-22'),(74,16,'2014-07-22'),(75,16,'2014-07-22'),(76,7,'2014-07-22'),(77,10,'2014-07-22'),(78,16,'2014-07-22'),(79,19,'2014-07-22'),(80,35,'2014-07-22'),(81,54,'2014-07-22'),(82,56,'2014-07-22');
/*!40000 ALTER TABLE `hr_attendance_reminder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_attendance_status`
--

DROP TABLE IF EXISTS `hr_attendance_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_attendance_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('W','A','R') NOT NULL DEFAULT 'W' COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `remarks` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_attendance_change_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1` (`app_users_id`),
  KEY `fk_hr_attendance_status_hr_attendance_change1` (`hr_attendance_change_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_attendance_status`
--

LOCK TABLES `hr_attendance_status` WRITE;
/*!40000 ALTER TABLE `hr_attendance_status` DISABLE KEYS */;
INSERT INTO `hr_attendance_status` VALUES (1,'W',NULL,'2014-06-20 15:54:12',NULL,NULL,10,1),(2,'W',NULL,'2014-06-20 15:54:59',NULL,NULL,10,2),(3,'A',NULL,'2014-06-20 15:55:47','2014-07-11 21:05:44',10,10,3),(4,'A',NULL,'2014-06-20 15:59:39','2014-07-11 21:06:19',10,10,4),(5,'W',NULL,'2014-06-20 16:18:55',NULL,NULL,10,5),(6,'W',NULL,'2014-06-20 16:22:55',NULL,NULL,10,6),(7,'W',NULL,'2014-06-20 16:29:06',NULL,NULL,10,7),(8,'W',NULL,'2014-06-20 16:30:11',NULL,NULL,10,8),(10,'A',NULL,'2014-06-20 16:44:58','2014-07-11 20:51:29',10,10,10),(11,'W',NULL,'2014-06-20 16:54:02',NULL,NULL,10,11),(12,'W',NULL,'2014-06-20 16:57:59',NULL,NULL,10,12),(13,'W',NULL,'2014-06-20 17:06:39',NULL,NULL,10,13),(14,'W',NULL,'2014-06-20 17:07:08',NULL,NULL,10,14),(15,'A',NULL,'2014-06-20 17:17:40','2014-06-20 18:05:19',10,10,15),(16,'W',NULL,'2014-06-20 17:28:11',NULL,NULL,19,19),(17,'W',NULL,'2014-06-20 17:28:27',NULL,NULL,19,20),(18,'W',NULL,'2014-06-20 17:34:55',NULL,NULL,19,21),(21,'A',NULL,'2014-06-20 18:01:34','2014-06-20 18:02:51',19,19,24),(22,'R','s','2014-06-20 18:53:36','2014-06-20 18:54:41',19,19,25),(23,'A',NULL,'2014-06-20 18:55:57','2014-06-20 18:56:22',19,19,26),(24,'W',NULL,'2014-06-20 18:56:58',NULL,NULL,19,27),(25,'A',NULL,'2014-06-20 19:05:56','2014-07-11 20:49:25',10,10,28),(26,'W',NULL,'2014-06-20 19:09:08',NULL,NULL,10,29),(27,'A',NULL,'2014-06-20 19:17:15','2014-07-11 20:48:18',10,10,30),(28,'A',NULL,'2014-06-20 19:20:28','2014-06-20 19:22:06',10,10,31),(29,'A',NULL,'2014-06-20 19:25:45','2014-06-20 19:27:27',10,10,32),(30,'A',NULL,'2014-06-20 19:26:22','2014-06-20 19:27:12',10,10,33),(31,'W',NULL,'2014-06-20 19:32:55',NULL,NULL,19,34),(32,'W',NULL,'2014-06-20 19:33:31',NULL,NULL,19,35),(33,'A',NULL,'2014-07-11 21:09:29','2014-07-11 21:10:40',17,17,36),(34,'A',NULL,'2014-07-11 21:11:46','2014-07-11 21:12:29',17,17,37),(35,'W',NULL,'2014-07-12 11:12:26',NULL,NULL,10,38),(36,'W',NULL,'2014-07-22 18:16:56',NULL,NULL,10,39),(37,'W',NULL,'2014-07-22 18:39:37',NULL,NULL,15,40),(38,'W',NULL,'2014-07-22 18:40:00',NULL,NULL,15,41),(39,'W',NULL,'2014-07-22 18:40:21',NULL,NULL,15,42),(40,'W',NULL,'2014-07-22 18:57:08',NULL,NULL,15,43),(41,'W',NULL,'2014-07-22 19:00:18',NULL,NULL,10,44),(42,'A',NULL,'2014-07-29 15:14:43','2014-07-29 15:15:34',10,10,45),(43,'A',NULL,'2014-07-29 15:19:58','2014-07-29 15:20:30',10,10,46);
/*!40000 ALTER TABLE `hr_attendance_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_attendance_users`
--

DROP TABLE IF EXISTS `hr_attendance_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_attendance_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_attendance_change_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_app_users1` (`app_users_id`),
  KEY `fk_hr_attendance_users_hr_attendance_change1` (`hr_attendance_change_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_attendance_users`
--

LOCK TABLES `hr_attendance_users` WRITE;
/*!40000 ALTER TABLE `hr_attendance_users` DISABLE KEYS */;
INSERT INTO `hr_attendance_users` VALUES (1,10,1),(2,10,2),(3,10,3),(4,10,4),(5,10,5),(6,10,6),(7,10,7),(8,10,8),(10,10,10),(11,10,11),(12,10,12),(13,10,13),(14,10,14),(15,10,15),(16,19,19),(17,19,20),(18,19,21),(22,19,25),(21,19,24),(23,19,26),(24,19,27),(25,10,28),(26,10,29),(27,10,30),(28,10,31),(29,10,32),(30,10,33),(31,19,34),(32,19,35),(33,17,36),(34,17,37),(35,10,38),(36,10,39),(37,15,40),(38,15,41),(39,15,42),(40,15,43),(41,10,44),(42,10,45),(43,10,46);
/*!40000 ALTER TABLE `hr_attendance_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_bank`
--

DROP TABLE IF EXISTS `hr_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank` varchar(100) NOT NULL,
  `ifsc` varchar(15) DEFAULT NULL,
  `branch` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_bank`
--

LOCK TABLES `hr_bank` WRITE;
/*!40000 ALTER TABLE `hr_bank` DISABLE KEYS */;
INSERT INTO `hr_bank` VALUES (1,'HDFC','HDFC9393444','Nungambakkam',1,'2014-04-01 11:31:03',17,'2014-04-01 11:33:18',17,'N'),(2,'HDFC','HDFC0000232','Kodambakkam',1,'2014-04-01 11:33:43',17,'2014-04-01 11:46:26',17,'N'),(3,'test','34343434','test',0,'2014-04-01 11:35:08',17,'2014-04-01 11:35:19',17,'Y'),(4,'HDFC Bank','','',1,'2014-05-17 10:07:29',19,'2014-05-17 10:07:34',19,'N');
/*!40000 ALTER TABLE `hr_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_bank_account`
--

DROP TABLE IF EXISTS `hr_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_bank_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(100) NOT NULL,
  `acc_no` varchar(45) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_bank_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_bank_account_app_users1` (`app_users_id`),
  KEY `fk_hr_bank_account_hr_bank1` (`hr_bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_bank_account`
--

LOCK TABLES `hr_bank_account` WRITE;
/*!40000 ALTER TABLE `hr_bank_account` DISABLE KEYS */;
INSERT INTO `hr_bank_account` VALUES (1,'test','2222','2014-04-01 13:43:35',17,'2014-04-01 13:47:29',17,36,2),(2,'ravichandran','0393343434','2014-04-01 13:46:03',17,NULL,NULL,35,1),(3,'test','test','2014-04-21 11:06:34',19,'2014-05-16 13:07:34',19,1,1),(8,'test','333','2014-05-17 10:13:51',19,NULL,NULL,3,1),(7,'test','333','2014-05-17 10:13:05',19,'2014-05-17 10:13:40',19,2,1),(9,'ttt','333','2014-05-17 10:17:52',19,NULL,NULL,4,1),(10,'ttt','test','2014-05-17 10:20:01',19,NULL,NULL,5,1);
/*!40000 ALTER TABLE `hr_bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_blood_group`
--

DROP TABLE IF EXISTS `hr_blood_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_blood_group` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(45) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_blood_group`
--

LOCK TABLES `hr_blood_group` WRITE;
/*!40000 ALTER TABLE `hr_blood_group` DISABLE KEYS */;
INSERT INTO `hr_blood_group` VALUES (1,'A Positive','2014-05-15 00:00:00',1),(2,'A1 Positive','2014-05-15 00:00:00',1),(3,'A1B Positive','2014-05-15 00:00:00',1),(4,'A2B Positive','2014-05-15 00:00:00',1),(5,'B Negative','2014-05-15 00:00:00',1),(6,'B Positive','2014-05-15 00:00:00',1),(7,'O Positive','2014-05-15 00:00:00',1);
/*!40000 ALTER TABLE `hr_blood_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_branch`
--

DROP TABLE IF EXISTS `hr_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(45) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `location` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_branch`
--

LOCK TABLES `hr_branch` WRITE;
/*!40000 ALTER TABLE `hr_branch` DISABLE KEYS */;
INSERT INTO `hr_branch` VALUES (1,'Chennai','',NULL,'',1,'N','2014-04-20 00:00:00','2014-05-03 11:43:01'),(2,'Bangalore','',NULL,'',1,'N','2014-04-20 00:00:00',NULL),(3,'Hyderabad','',NULL,'',1,'N','2014-04-20 00:00:00','2014-05-03 11:42:51'),(4,'Ahmedabad','',NULL,'',1,'N','2014-04-20 00:00:00',NULL),(5,'Rudrapur','',NULL,'',1,'N','2014-04-20 00:00:00',NULL),(6,'Chennai3','',NULL,'',0,'Y','2014-05-03 11:39:24','2014-05-03 11:42:30'),(7,'bangalore2','',NULL,'',1,'Y','2014-05-03 11:40:54','2014-05-03 11:42:27');
/*!40000 ALTER TABLE `hr_branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_business_unit`
--

DROP TABLE IF EXISTS `hr_business_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_business_unit` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit` varchar(45) NOT NULL,
  `business_desc` varchar(200) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_business_unit`
--

LOCK TABLES `hr_business_unit` WRITE;
/*!40000 ALTER TABLE `hr_business_unit` DISABLE KEYS */;
INSERT INTO `hr_business_unit` VALUES (1,'Front Line Rec',NULL,'2014-05-17 12:29:50',1,NULL,'N',19,NULL),(2,'Information Tech',NULL,'0000-00-00 00:00:00',1,NULL,'N',0,NULL),(3,'Animation Dept',NULL,'0000-00-00 00:00:00',1,NULL,'N',0,NULL);
/*!40000 ALTER TABLE `hr_business_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_change_request`
--

DROP TABLE IF EXISTS `hr_change_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_change_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('PE','PR','ED','CT','OT') NOT NULL COMMENT 'PE - Personal\nPR - Professional\nED - Educational\nOT - Others\nCT - Contact',
  `desc` text NOT NULL,
  `created_date` datetime NOT NULL,
  `status` enum('W','C') NOT NULL DEFAULT 'W' COMMENT 'W - Waiting\nC - Completed',
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_change_request_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_change_request`
--

LOCK TABLES `hr_change_request` WRITE;
/*!40000 ALTER TABLE `hr_change_request` DISABLE KEYS */;
INSERT INTO `hr_change_request` VALUES (1,'','dd','2014-03-25 17:06:39','C','N',NULL,19,11,''),(2,'PR','fff','2014-03-25 17:07:23','W','N',NULL,NULL,11,NULL),(3,'PE','test','2014-03-25 17:09:56','W','N',NULL,NULL,11,NULL),(4,'ED','test','2014-03-25 17:15:39','W','N',NULL,NULL,11,NULL),(5,'ED','test','2014-04-13 18:38:26','W','N',NULL,NULL,19,NULL),(6,'PE','test','2014-04-17 11:36:37','W','N',NULL,NULL,40,NULL),(7,'PE','test','2014-04-17 11:36:48','W','N',NULL,NULL,40,NULL),(8,'PE','test','2014-04-17 11:37:04','W','N',NULL,NULL,40,NULL),(9,'PE','dd','2014-04-17 11:37:27','C','N',NULL,19,40,'ok'),(10,'OT','my emergency contact no. is wrong.','2014-04-17 11:46:49','C','N',NULL,19,40,'updated now.'),(11,'ED','my university is mugal','2014-04-17 11:52:43','W','N',NULL,NULL,40,NULL),(12,'ED','test','2014-04-17 11:55:15','W','N',NULL,NULL,40,NULL),(13,'PR','i have no reporting users.','2014-04-17 11:55:49','C','N',NULL,19,40,'test'),(14,'PR','i have no superiors.','2014-04-17 11:56:56','C','N',NULL,19,40,''),(15,'PR','My profile is not upated!','2014-04-17 11:59:02','C','N',NULL,19,19,''),(16,'OT','pls update my correct ESI no.','2014-04-17 12:03:48','W','N',NULL,NULL,40,NULL),(17,'CT','Please update my contact detail\'s.','2014-04-19 12:06:41','C','N',NULL,19,19,'done'),(18,'PE','test','2014-04-30 19:03:43','W','N',NULL,NULL,10,NULL),(19,'PR','test','2014-05-01 16:45:29','W','N',NULL,NULL,11,NULL),(20,'PE','doj missing','2014-05-20 12:11:15','C','N','2014-05-20 12:12:11',19,10,'check it'),(21,'PR','business unit missing','2014-05-20 12:11:34','C','N','2014-05-20 12:11:56',19,10,'ok'),(22,'PE','test','2014-07-04 15:58:30','W','N',NULL,NULL,19,NULL);
/*!40000 ALTER TABLE `hr_change_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_company`
--

DROP TABLE IF EXISTS `hr_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) NOT NULL,
  `logo` varchar(45) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(45) NOT NULL,
  `pincode` int(11) NOT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `landline` varchar(15) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `pan` varchar(45) DEFAULT NULL,
  `tan` varchar(45) DEFAULT NULL,
  `service_reg_no` varchar(45) DEFAULT NULL,
  `company_reg_no` varchar(45) DEFAULT NULL,
  `bank_name` varchar(45) NOT NULL,
  `account_name` varchar(60) NOT NULL,
  `account_no` varchar(45) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `ifsc_code` varchar(45) NOT NULL,
  `swift_code` varchar(45) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `app_state_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_company_app_state1` (`app_state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_company`
--

LOCK TABLES `hr_company` WRITE;
/*!40000 ALTER TABLE `hr_company` DISABLE KEYS */;
INSERT INTO `hr_company` VALUES (1,'CEO Talent Search Pvt. Ltd.','1_cakephp_logo_250_trans.png','Old No.4, New No.15, 1st & 2nd Floor,\r\n3rd Cr','Chennai',600030,'9023492034','04449004900','234234234','','','','','HDFC','CEO Talent Search Pvt. Ltd.','0000000000','Chennai Branch','','','2014-02-04 00:00:00','2014-05-03 13:25:54',1,19,'http://www.ceotalentsearch.com/',1);
/*!40000 ALTER TABLE `hr_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_course`
--

DROP TABLE IF EXISTS `hr_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_name` varchar(150) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A - Active\nI - Inactive',
  `created_date` datetime NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL,
  `program_details_id` tinyint(3) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_details_program_details1` (`program_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_course`
--

LOCK TABLES `hr_course` WRITE;
/*!40000 ALTER TABLE `hr_course` DISABLE KEYS */;
INSERT INTO `hr_course` VALUES (1,'Data Preparation Assistant','A','2012-11-30 06:05:09','N',1,NULL),(2,'Moulder ','A','2012-11-30 06:05:09','N',1,NULL),(3,'Hand Compositor','A','2012-11-30 06:05:09','N',1,NULL),(4,'Forger & Heat Treater (Blacksmith)','A','2012-11-30 06:05:09','N',1,NULL),(5,'Cutting & Tailoring','A','2012-11-30 06:05:09','N',1,NULL),(6,'Diesel Mechanic','A','2012-11-30 06:05:09','N',1,NULL),(7,'Sheet Metal Works','A','2012-11-30 06:05:09','N',1,NULL),(8,'Welder','A','2012-11-30 06:05:09','N',1,NULL),(9,'Carpenter','A','2012-11-30 06:05:09','N',1,NULL),(10,'Book Binding','A','2012-11-30 06:05:09','N',1,NULL),(11,'Plumber','A','2012-11-30 06:05:09','N',1,NULL),(12,'Wireman','A','2012-11-30 06:05:09','N',1,NULL),(13,'Console Operator cum Programme Assistant','A','2012-11-30 06:05:09','N',1,NULL),(14,'Letter Press Machine Operator','A','2012-11-30 06:05:09','N',1,NULL),(15,'Winder','A','2012-11-30 06:05:09','N',1,NULL),(16,'Mason','A','2012-11-30 06:05:09','N',1,NULL),(17,'Stenography (English)','A','2012-11-30 06:05:09','N',1,NULL),(18,'Plastic Processing Operator','A','2012-11-30 06:05:09','N',1,NULL),(19,'Draughtsman Civil','A','2012-11-30 06:05:09','N',1,NULL),(20,'Draughtsman Mechanical','A','2012-11-30 06:05:09','N',1,NULL),(21,'Fiber Reinforced Plastic Course','A','2012-11-30 06:05:09','N',1,NULL),(22,'Radio & T.V.Mechanism','A','2012-11-30 06:05:09','N',1,NULL),(23,'Turner','A','2012-11-30 06:05:09','N',1,NULL),(24,'Fitter','A','2012-11-30 06:05:09','N',1,NULL),(25,'Motor-vehicle Mechanic','A','2012-11-30 06:05:09','N',1,NULL),(26,'Electronics Mechanic','A','2012-11-30 06:05:09','N',1,NULL),(27,'Machinist (Grinder)','A','2012-11-30 06:05:09','N',1,NULL),(28,'Electrician','A','2012-11-30 06:05:09','N',1,NULL),(29,'Refrigerator & Air Condition Mechanic','A','2012-11-30 06:05:09','N',1,NULL),(30,'Bachelor of Arts (B.A)','A','2012-11-30 06:05:09','N',3,NULL),(31,'Bachelor of Architecture (B.Arch.)','A','2012-11-30 06:05:09','N',3,NULL),(32,'Bachelor of Computer Applications (B.C.A.)','A','2012-11-30 06:05:09','N',3,NULL),(33,'Bachelor of Business Administration (B.B.A.)','A','2012-11-30 06:05:09','N',3,NULL),(34,'Bachelor of Bank Management (B.B.M.)','A','2012-11-30 06:05:09','N',3,NULL),(35,'Bachelor of Commerce (B.Com.)','A','2012-11-30 06:05:09','N',3,NULL),(36,'Bachelor of Education (B.Ed.)','A','2012-11-30 06:05:09','N',3,NULL),(37,'Bachelor of Dental Surgery (B.D.S.)','A','2012-11-30 06:05:09','N',3,NULL),(38,'Bachelor of Hotel Management & Catering Technology (HMCT) ','A','2012-11-30 06:05:09','N',3,NULL),(39,'Bachelor of Pharmacy (B.Pharma.)','A','2012-11-30 06:05:09','N',3,NULL),(40,'Bachelor of Science (B.Sc.)','A','2012-11-30 06:05:09','N',3,NULL),(41,'B.Tech/B.E.','A','2012-11-30 06:05:09','N',3,NULL),(42,'Bachelor of Law (L.L.B.)','A','2012-11-30 06:05:09','N',3,NULL),(43,'MBBS','A','2012-11-30 06:05:09','N',3,NULL),(44,'Bachelor of Veterinary Sciences and Animal Husbandry (B.VSc. & A.H)','A','2012-11-30 06:05:09','N',3,NULL),(45,'Diploma','A','2012-11-30 06:05:09','N',2,NULL),(46,'Fashion/Designing','A','2012-11-30 06:05:09','N',2,NULL),(47,'PR/Advertising','A','2012-11-30 06:05:09','N',2,NULL),(48,'Tourism','A','2012-11-30 06:05:09','N',2,NULL),(49,'Vocational-Training','A','2012-11-30 06:05:09','N',2,NULL),(51,'Integrated PG Course','A','2012-11-30 06:05:09','N',4,NULL),(52,'Master of Law (L.L.M.)','A','2012-11-30 06:05:09','N',4,NULL),(53,'Master of Arts (M.A.)','A','2012-11-30 06:05:09','N',4,NULL),(54,'Master of Architecture (M.Arch.)','A','2012-11-30 06:05:09','N',4,NULL),(55,'Master of Commerce (M.Com.)','A','2012-11-30 06:05:09','N',4,NULL),(56,'Master of Education (M.Ed.)','A','2012-11-30 06:05:09','N',4,NULL),(57,'Master of Pharmacy (M.Pharma.)','A','2012-11-30 06:05:09','N',4,NULL),(58,'Master of Philosophy (M.Phil.)','A','2012-11-30 06:05:09','N',4,NULL),(59,'Master of Science (M.Sc.)','A','2012-11-30 06:05:09','N',4,NULL),(60,'Master of Technology (M.Tech.)','A','2012-11-30 06:05:09','N',4,NULL),(61,'Master of Business Administration (MBA)','A','2012-11-30 06:05:09','N',4,NULL),(62,'Master of Computer Applications (M.C.A.)','A','2012-11-30 06:05:09','N',4,NULL),(63,'Medical (M.S. / M.D.)','A','2012-11-30 06:05:09','N',4,NULL),(64,'Master of Veterinary Sciences and Animal Husbandry (M.VSc. & A.H)','A','2012-11-30 06:05:09','N',4,NULL),(65,'PG Diploma','A','2012-11-30 06:05:09','N',4,NULL),(66,'PR/Advertising','A','2012-11-30 06:05:09','N',4,NULL),(67,'Tourism','A','2012-11-30 06:05:09','N',4,NULL),(69,'Doctor of Philosophy (Ph.D.)','A','2012-11-30 06:05:09','N',5,NULL),(182,'Executive Master of Business Administration (EMBA)','A','2013-01-18 17:37:12','N',4,NULL),(181,'Master of management Studies (MMS)','A','2013-01-18 17:37:12','N',4,NULL),(180,'Master of Science in Taxation (MST)','A','2013-01-18 17:37:12','N',4,NULL),(179,'Master of Science in Finance (MSF)','A','2013-01-18 17:37:12','N',4,NULL),(178,'Master of Health Administration (MHA) ','A','2013-01-18 17:37:12','N',4,NULL),(177,'Master of Science in management (MSM)','A','2013-01-18 17:37:12','N',4,NULL),(176,'Master of Information Systems Management (MISM)','A','2013-01-18 17:37:12','N',4,NULL),(175,'Master of Market Research (MMR)','A','2013-01-18 17:37:12','N',4,NULL),(174,'Master of Accountancy (M.Acc)','A','2013-01-18 17:37:12','N',4,NULL),(173,'Bachelor of occupational Therapy (BOT) ','A','2013-01-18 17:37:12','N',3,NULL),(172,'Bachelor of Physical Therapy (BPT) ','A','2013-01-18 17:37:12','N',3,NULL),(171,'Bachelor of Homeopathic Medicine & Surgery ','A','2013-01-18 17:37:12','N',3,NULL),(170,'Bachelor of Unani Medicine & Surgery (BUMS) ','A','2013-01-18 17:37:12','N',3,NULL),(169,'Bachelor of Ayurvedic Medicine & Surgery (BAMS)','A','2013-01-18 17:37:12','N',3,NULL),(168,'B.F Tech (Design)','A','2013-01-18 17:37:12','N',3,NULL),(167,'Bachelor of Business Science (B.Bus.Sc)','A','2013-01-18 17:37:12','N',3,NULL),(166,'Bachelor of Management and Organizational Studies (B.MOS) ','A','2013-01-18 17:37:12','N',3,NULL),(165,'Bachelor of Accountancy (B.Acc)','A','2013-01-18 17:37:12','N',3,NULL),(164,'Bachelor of Business (B.Bus)','A','2013-01-18 17:37:12','N',3,NULL),(249,'BSC(.Net Framework)','A','2013-07-17 15:09:36','N',3,NULL),(162,'Zoology','A','2013-01-18 17:37:12','N',7,NULL),(161,'Statistics','A','2013-01-18 17:37:12','N',7,NULL),(160,'Siddha','A','2013-01-18 17:37:12','N',7,NULL),(159,'Political Science','A','2013-01-18 17:37:12','N',7,NULL),(158,'Physics','A','2013-01-18 17:37:12','N',7,NULL),(157,'Nutrition & Diet tics','A','2013-01-18 17:37:12','N',7,NULL),(156,'Nursing','A','2013-01-18 17:37:12','N',7,NULL),(155,'Micro-Biology','A','2013-01-18 17:37:12','N',7,NULL),(154,'Mathematics','A','2013-01-18 17:37:12','N',7,NULL),(153,'Indian Cilture','A','2013-01-18 17:37:12','N',7,NULL),(152,'Home science','A','2013-01-18 17:37:12','N',7,NULL),(151,'History','A','2013-01-18 17:37:12','N',7,NULL),(150,'Geography','A','2013-01-18 17:37:12','N',7,NULL),(149,'Economics','A','2013-01-18 17:37:12','N',7,NULL),(148,'Computer Science','A','2013-01-18 17:37:12','N',7,NULL),(147,'Communicative English','A','2013-01-18 17:37:12','N',7,NULL),(146,'Commerce','A','2013-01-18 17:37:12','N',7,NULL),(145,'Chemistry','A','2013-01-18 17:37:12','N',7,NULL),(144,'Business Mathematics','A','2013-01-18 17:37:12','N',7,NULL),(143,'Botany','A','2013-01-18 17:37:12','N',7,NULL),(142,'Biology','A','2013-01-18 17:37:12','N',7,NULL),(141,'Bio-Chemistry','A','2013-01-18 17:37:12','N',7,NULL),(140,'Advanced Language','A','2013-01-18 17:37:12','N',7,NULL),(139,'Accountancy','A','2013-01-18 17:37:12','N',7,NULL),(183,'Post Graduate Diploma in Management (PGDM)','A','2013-01-18 17:37:12','N',4,NULL),(184,'Post Graduate Diploma in Business Management (PGDBM)','A','2013-01-18 17:37:12','N',4,NULL),(185,'Post Graduate Program in Business Management (PGP)','A','2013-01-18 17:37:12','N',4,NULL),(190,'Doctor of Business Administration (DBA)','A','2013-01-18 17:37:12','N',5,NULL),(186,'Post Graduate Program in Management for Senior Executives (PGPMAX)','A','2013-01-18 17:37:12','N',4,NULL),(187,'Management Program for family Business (MFAB)','A','2013-01-18 17:37:12','N',4,NULL),(188,'Fellow Program in Management (FPM)','A','2013-01-18 17:37:12','N',4,NULL),(189,'Young Leader\'s Program (YLP)','A','2013-01-18 17:37:12','N',4,NULL),(238,'Institute of Cost and Work Accountancy (ICWA) ','A','2013-01-18 17:37:12','N',3,NULL),(237,'Chartered Accountancy (CA) ','A','2013-01-18 17:37:12','N',3,NULL),(235,'Master of Homeopathic Medicine & Surgery','A','2012-11-30 06:05:09','N',4,NULL),(234,'Applied Arts & Crafts','A','2013-01-18 17:37:12','N',3,NULL),(233,'Post Graduate Diploma Programme in Design ','A','2013-01-18 17:37:12','N',4,NULL),(232,'Graduate diploma in design ','A','2013-01-18 17:37:12','N',3,NULL),(231,'Master of Dental Surgery (M.D.S.)','A','2013-01-18 17:37:12','N',4,NULL),(230,'Master of occupational Therapy (MOT) ','A','2013-01-18 17:37:12','N',4,NULL),(229,'Master of Physical Therapy (MPT) ','A','2013-01-18 17:37:12','N',4,NULL),(228,'Post Graduate Program in Management (PGP)','A','2013-01-18 17:37:12','N',4,NULL),(227,'MBM','A','2013-01-18 17:37:12','N',4,NULL),(226,'Executiver Post Graduate Diploma in Management (Exec-PGDM)','A','2013-01-18 17:37:12','N',4,NULL),(225,'Post Graduate Certificate in Management (PGCM)','A','2013-01-18 17:37:12','N',4,NULL),(224,'Post Graduate Diploma in Cement Technology ','A','2013-01-18 17:37:12','N',4,NULL),(223,'Me.F Tech','A','2013-01-18 17:37:12','N',4,NULL),(193,'Doctor of Professional Studies (DPS)','A','2013-01-18 17:37:12','N',5,NULL),(192,'Doctor of Commerce (DM/D.Com)','A','2013-01-18 17:37:12','N',5,NULL),(222,'B.F Tech (Apparel Production)','A','2013-01-18 17:37:12','N',3,NULL),(191,'Doctor of Health Administration (DHA)','A','2013-01-18 17:37:12','N',5,NULL),(239,'Company Secretary (CS)','A','2013-01-18 17:37:12','N',3,NULL),(244,'Interior Design (ID)','A','2013-01-18 17:37:12','N',3,NULL),(245,'Building Construction Technology (BCT)','A','2013-01-18 17:37:12','N',3,NULL),(246,'Planning (PL)','A','2013-01-18 17:37:12','N',3,NULL),(250,'Nurcing','A','2013-07-17 15:31:37','N',5,NULL),(254,'Bachelor of Computer','A','2013-08-06 12:26:25','N',3,NULL),(256,'Master of Science','A','2013-09-24 00:00:00','N',4,NULL);
/*!40000 ALTER TABLE `hr_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_department`
--

DROP TABLE IF EXISTS `hr_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(45) NOT NULL,
  `dept_desc` varchar(200) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status` set('1','0') NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_department`
--

LOCK TABLES `hr_department` WRITE;
/*!40000 ALTER TABLE `hr_department` DISABLE KEYS */;
INSERT INTO `hr_department` VALUES (1,'CORPORATE TEAM','','2014-02-22 09:59:10','1',NULL,'N',6,NULL),(2,'ES BANGALORE','','2014-02-22 09:59:22','1',NULL,'N',6,NULL),(3,'ES CHENNAI','','2014-02-22 09:59:42','1',NULL,'N',6,NULL),(9,'ES HYDERABAD','','2014-02-22 09:59:51','1',NULL,'N',6,NULL),(5,'FLR AHMEDABAD','','2014-02-22 10:00:06','1',NULL,'N',6,NULL),(6,'FLR CHENNAI','','2014-02-22 10:00:15','1',NULL,'N',6,NULL),(7,'FLR RUDRAPUR','','2014-02-22 10:00:35','1',NULL,'N',6,NULL),(8,'STAFFING TEAM','','2014-02-22 10:01:07','1','2014-03-02 12:56:57','N',6,17),(4,'CORPORTE TEAM -  FINANCE','','2014-02-22 13:18:26','1','2014-03-02 12:58:01','N',35,17),(14,'CORPORTE TEAM -  HR','','2014-03-26 19:15:16','1',NULL,'N',17,NULL);
/*!40000 ALTER TABLE `hr_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_designation`
--

DROP TABLE IF EXISTS `hr_designation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_designation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desig_name` varchar(45) NOT NULL,
  `desig_desc` varchar(200) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status` set('1','0') NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_designation`
--

LOCK TABLES `hr_designation` WRITE;
/*!40000 ALTER TABLE `hr_designation` DISABLE KEYS */;
INSERT INTO `hr_designation` VALUES (1,'Admin Executive','','2014-02-22 10:04:25','1',NULL,'N',6,NULL),(2,'Assitant Manager','','2014-02-22 10:04:37','1',NULL,'N',6,NULL),(3,'Assistant Manager - HR','','2014-02-22 10:04:50','1',NULL,'N',6,NULL),(4,'Branch Head','','2014-02-22 10:05:03','1',NULL,'N',6,NULL),(5,'Business Head - Executive Search','','2014-02-22 10:05:19','1',NULL,'N',6,NULL),(6,'Director','','2014-02-22 10:05:39','1',NULL,'N',6,NULL),(7,'Driver','','2014-02-22 10:05:47','1',NULL,'N',6,NULL),(8,'Key Account Lead','','2014-02-22 10:05:59','1',NULL,'N',6,NULL),(9,'Key Account Manager','','2014-02-22 10:06:10','1',NULL,'N',6,NULL),(10,'Senior Recruiter','','2014-02-22 10:06:22','1',NULL,'N',6,NULL),(11,'Senior System Administrator','','2014-02-22 10:06:37','1',NULL,'N',6,NULL),(12,'Sr. Account & Finance Executive','','2014-02-22 10:06:50','1',NULL,'N',6,NULL),(13,'Team Leader','','2014-02-22 10:07:13','1',NULL,'N',6,NULL),(14,'Team Member','','2014-02-22 10:07:21','1',NULL,'N',6,NULL),(15,'Vertical Lead - Executive Search','test','2014-02-22 10:07:34','1','2014-03-02 12:59:39','N',6,17);
/*!40000 ALTER TABLE `hr_designation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_emp_education`
--

DROP TABLE IF EXISTS `hr_emp_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_emp_education` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inst_name` varchar(100) DEFAULT NULL,
  `percent_marks` varchar(10) DEFAULT NULL,
  `year_passing` year(4) DEFAULT NULL,
  `university` varchar(45) DEFAULT NULL,
  `course_type` set('F','P','C') DEFAULT NULL COMMENT 'F - Fulltime\nP - Parttime\nC - Correspondance',
  `program_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 - 10\n2 - 12\n3 - Diploma\n4 - UG\n5 - PG\n6 - PhD\n',
  `board` set('S','C','I','M','A') DEFAULT NULL COMMENT 'S - State board\nC - CBSC\nI - ICSE\nM - Matric\nA - Anglo',
  `hr_course_id` smallint(5) unsigned DEFAULT NULL,
  `hr_specialization_id` smallint(5) unsigned DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_emp_education_hr_course1` (`hr_course_id`),
  KEY `fk_hr_emp_education_hr_specialization1` (`hr_specialization_id`),
  KEY `fk_hr_emp_education_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_emp_education`
--

LOCK TABLES `hr_emp_education` WRITE;
/*!40000 ALTER TABLE `hr_emp_education` DISABLE KEYS */;
INSERT INTO `hr_emp_education` VALUES (1,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:47:39',19,45),(2,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:48:16',19,46),(3,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:48:16',19,46),(4,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:48:41',19,47),(5,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:48:41',19,47),(6,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:49:16',19,48),(7,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:49:16',19,48),(8,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:49:50',19,49),(9,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:49:50',19,49),(10,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:50:05',19,50),(11,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:50:05',19,50),(12,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:50:51',19,51),(13,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:50:51',19,51),(14,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'2014-04-16 12:51:31',19,52),(15,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'2014-04-16 12:51:31',19,52),(33,'Govt. College Tirunelveli','66',2012,'barathiyar university','C',4,'',168,291,'0000-00-00 00:00:00',0,53),(31,'Holy cross ','66',2008,NULL,NULL,2,'I',NULL,NULL,'0000-00-00 00:00:00',0,53),(32,'Park College','88.6',2010,'anna univ','C',3,'',45,102,'0000-00-00 00:00:00',0,53),(30,'kamaraj matriculation school','77',2014,NULL,NULL,1,'S',NULL,NULL,'0000-00-00 00:00:00',0,53),(34,'kamak','99',2011,NULL,NULL,1,'S',NULL,NULL,'2014-04-17 10:36:44',19,40),(35,'TCE','67',2012,'barathi','F',4,'',222,297,'2014-04-17 10:36:44',19,40),(67,'TCE','E',2011,'Anna university','F',4,'',168,296,'2014-05-16 13:17:45',19,19),(66,'Vel Tech Diploma Institute','77.45',2004,'Anna','F',3,'',45,100,'2014-05-16 13:17:45',19,19),(65,'Karapettai Nadar Hr Sec. School','89.3',2013,NULL,NULL,2,'C',NULL,NULL,'2014-05-16 13:17:45',19,19),(64,'Kamaraj Matric School','87',2002,NULL,NULL,1,'S',NULL,NULL,'2014-05-16 13:17:45',19,19),(62,'Good Will Engineering','75',2011,'Vel','F',4,'',32,24,'2014-05-15 17:16:07',17,17),(61,'Suraj School','88',2003,NULL,NULL,1,'S',NULL,NULL,'2014-05-15 17:16:07',17,17),(63,'Anna College','66',2014,'annamalai','P',5,'',225,NULL,'2014-05-15 17:16:07',17,17),(68,'Hindustan','66',2014,'Hindustan University','C',5,'',65,258,'2014-05-16 13:17:45',19,19),(99,'5555','66',1999,'test','F',5,'',181,NULL,'2014-06-30 12:43:21',19,35),(98,'444','44',2000,'test','F',4,'',36,35,'2014-06-30 12:43:21',19,35),(85,'','',0000,'','',3,'',45,102,'2014-05-17 12:24:09',19,1),(97,'3333','55',2012,'test','P',3,'',45,103,'2014-06-30 12:43:21',19,35),(96,'2222','45',1998,NULL,NULL,2,'I',NULL,NULL,'2014-06-30 12:43:21',19,35),(95,'111','34',2011,NULL,NULL,1,'I',NULL,NULL,'2014-06-30 12:43:21',19,35);
/*!40000 ALTER TABLE `hr_emp_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_emp_experience`
--

DROP TABLE IF EXISTS `hr_emp_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_emp_experience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(45) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `total_exp` float unsigned NOT NULL,
  `doj` date NOT NULL,
  `dor` date NOT NULL COMMENT 'F - Fulltime\nP - Parttime\nC - Correspondance',
  `address` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_emp_education_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_emp_experience`
--

LOCK TABLES `hr_emp_experience` WRITE;
/*!40000 ALTER TABLE `hr_emp_experience` DISABLE KEYS */;
INSERT INTO `hr_emp_experience` VALUES (1,'bigspire','software developer',0.9,'2014-01-01','2014-04-16','chennai\r\nchennai','2014-04-16 12:50:51',19,51),(2,'bigspire','software developer',0.9,'2014-01-01','2014-04-16','chennai\r\nchennai','2014-04-16 12:51:31',19,52),(5,'bigspire software','software developer',0.9,'2014-01-01','2014-04-16','chennai\r\nchennai','2014-04-16 17:18:43',19,53),(6,'infosys','tester',14,'2002-02-05','2014-04-09','bangalore office','2014-04-16 17:18:43',19,53);
/*!40000 ALTER TABLE `hr_emp_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_emp_family`
--

DROP TABLE IF EXISTS `hr_emp_family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_emp_family` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `relative_name` varchar(45) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `relationship` enum('F','M','G','B','S','SP') NOT NULL COMMENT 'F - Father\nM - Mother\nG - Guardian\nB - Brother\nS - Sister\nSP = Spouse',
  `dob` date DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_emp_education_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_emp_family`
--

LOCK TABLES `hr_emp_family` WRITE;
/*!40000 ALTER TABLE `hr_emp_family` DISABLE KEYS */;
INSERT INTO `hr_emp_family` VALUES (1,'sundar','test','G','1979-05-13','2014-04-16 12:51:31',19,52),(8,'sundar1','','F','1979-05-13','2014-04-16 17:33:58',19,53),(9,'maya','viluppuram','M','1964-06-18','2014-04-16 17:33:58',19,53),(10,'test','','F','0000-00-00','2014-05-16 13:20:47',19,19),(18,'test','','F','2014-05-13','2014-05-17 12:12:56',19,1),(19,'tee','','M','0000-00-00','2014-05-17 12:12:56',19,1),(20,'est','','F','0000-00-00','2014-05-17 12:32:14',19,56);
/*!40000 ALTER TABLE `hr_emp_family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_files`
--

DROP TABLE IF EXISTS `hr_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_files`
--

LOCK TABLES `hr_files` WRITE;
/*!40000 ALTER TABLE `hr_files` DISABLE KEYS */;
INSERT INTO `hr_files` VALUES (1,'test file','1_cakephp_logo_250_trans.png','2014-05-03 17:23:10',19,'2014-05-03 18:00:53',19,'N'),(2,'ceo test','2_ceo-talent-search (1).png','2014-05-03 17:24:58',19,'2014-05-03 18:00:01',19,'Y'),(3,'my test file','3_attract-ventures-logo.jpg','2014-05-03 18:02:15',19,'2014-05-03 18:02:25',19,'N');
/*!40000 ALTER TABLE `hr_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_form`
--

DROP TABLE IF EXISTS `hr_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form` varchar(100) NOT NULL,
  `attachment` varchar(45) NOT NULL,
  `desc` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_form`
--

LOCK TABLES `hr_form` WRITE;
/*!40000 ALTER TABLE `hr_form` DISABLE KEYS */;
INSERT INTO `hr_form` VALUES (1,'test','','',1,'2014-03-31 10:47:52',17,'2014-03-31 11:04:30',NULL,'Y'),(2,'test','','test desc',1,'2014-03-31 11:01:41',17,'2014-03-31 11:04:49',NULL,'Y'),(3,'test','','test desc',1,'2014-03-31 11:02:13',17,'2014-03-31 11:04:42',NULL,'Y'),(4,'test','','test desc',1,'2014-03-31 11:02:53',17,'2014-03-31 11:04:40',NULL,'Y'),(5,'test','','test desc',1,'2014-03-31 11:03:06',17,'2014-03-31 11:04:35',NULL,'Y'),(6,'test','1','test desc',1,'2014-03-31 11:03:21',17,'2014-03-31 11:04:33',NULL,'Y'),(7,'Exit Interview Format','1','Exit Interview Format for CEOTS',1,'2014-03-31 11:05:29',17,'2014-03-31 11:09:09',NULL,'Y'),(8,'Exit Interview Format','8_Form 19 - PF Withdrawal.pdf','Exit Interview Format for CEOTS',1,'2014-03-31 11:09:33',17,'2014-03-31 11:59:22',17,'Y'),(9,'test','','',1,'2014-03-31 11:40:06',17,'2014-03-31 11:59:25',NULL,'Y'),(10,'test','10_function.strtotime.php','test',1,'2014-03-31 11:53:38',17,'2014-03-31 11:59:28',17,'Y'),(11,'Exit Interview Format','11_No due certificate_CEOTS.zip','Exit Interview Format for CEOTS',1,'2014-03-31 12:00:42',17,'2014-03-31 12:19:36',17,'N'),(12,'Form 13 - PF Transfer','12_Form 13 - PF Transfer.pdf','Form 13 - PF Transfer',1,'2014-03-31 12:43:07',17,NULL,NULL,'N'),(13,'Exit Interview Format for CEOTS','13_Exit Interview Format for CEOTS.doc','Exit Interview Format for CEOTS',1,'2014-03-31 12:43:24',17,NULL,NULL,'N'),(14,'No due certificate_CEOTS','14_No due certificate_CEOTS.xls','No due certificate_CEOTS',1,'2014-03-31 12:43:38',17,NULL,NULL,'N');
/*!40000 ALTER TABLE `hr_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_gallery`
--

DROP TABLE IF EXISTS `hr_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` text,
  `folder` varchar(45) NOT NULL,
  `is_approve` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_gallery_app_users1` (`app_users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_gallery`
--

LOCK TABLES `hr_gallery` WRITE;
/*!40000 ALTER TABLE `hr_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_gallery_items`
--

DROP TABLE IF EXISTS `hr_gallery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_gallery_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('P','V') NOT NULL DEFAULT 'P' COMMENT 'P - Photo\nV - Video',
  `file` varchar(45) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `hr_gallery_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_gallery_items_hr_gallery1` (`hr_gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_gallery_items`
--

LOCK TABLES `hr_gallery_items` WRITE;
/*!40000 ALTER TABLE `hr_gallery_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_gallery_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_gallery_status`
--

DROP TABLE IF EXISTS `hr_gallery_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_gallery_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('W','A','R') NOT NULL DEFAULT 'W' COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `remarks` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_gallery_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1` (`app_users_id`),
  KEY `fk_hr_gallery_status_hr_gallery1` (`hr_gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_gallery_status`
--

LOCK TABLES `hr_gallery_status` WRITE;
/*!40000 ALTER TABLE `hr_gallery_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_gallery_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_gallery_users`
--

DROP TABLE IF EXISTS `hr_gallery_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_gallery_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_gallery_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_app_users1` (`app_users_id`),
  KEY `fk_hr_gallery_users_hr_gallery1` (`hr_gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_gallery_users`
--

LOCK TABLES `hr_gallery_users` WRITE;
/*!40000 ALTER TABLE `hr_gallery_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_gallery_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_grade`
--

DROP TABLE IF EXISTS `hr_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(45) NOT NULL,
  `grade_desc` varchar(200) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status` set('1','0') NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_grade`
--

LOCK TABLES `hr_grade` WRITE;
/*!40000 ALTER TABLE `hr_grade` DISABLE KEYS */;
INSERT INTO `hr_grade` VALUES (1,'test','','2014-02-22 10:11:53','1',NULL,'N',6,NULL);
/*!40000 ALTER TABLE `hr_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_holiday`
--

DROP TABLE IF EXISTS `hr_holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_holiday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `desc` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  `hr_branch_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_holiday_hr_branch1` (`hr_branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_holiday`
--

LOCK TABLES `hr_holiday` WRITE;
/*!40000 ALTER TABLE `hr_holiday` DISABLE KEYS */;
INSERT INTO `hr_holiday` VALUES (1,'Pongal','2014-01-14',NULL,1,'0000-00-00 00:00:00',0,'2014-04-03 17:10:13',NULL,'Y',1),(2,'Christmas','2014-12-25',NULL,1,'0000-00-00 00:00:00',0,'2014-04-03 17:10:16',NULL,'Y',1),(3,'Pongal','2013-01-13',NULL,1,'0000-00-00 00:00:00',0,'2014-04-03 17:10:31',NULL,'Y',1),(4,'','0000-00-00',NULL,1,'2014-04-03 16:40:43',17,'2014-04-03 16:40:48',NULL,'Y',0),(5,'Pongal','2014-04-08','pongal holidays',1,'2014-04-03 16:56:44',17,NULL,NULL,'N',4),(6,'Pongal','2014-04-15','',1,'2014-04-03 16:57:02',17,NULL,NULL,'N',4),(7,'Diwali','2014-11-28','diwali festival',1,'2014-04-03 16:58:23',17,'2014-04-03 17:14:00',17,'N',4),(8,'Diwali','2014-04-01','diwali festival',1,'2014-04-03 16:58:23',17,NULL,NULL,'N',2),(9,'Diwali','2014-04-01','diwali festival',1,'2014-04-03 16:58:23',17,'2014-05-20 18:45:26',19,'N',1),(10,'Diwali','2014-04-01','diwali festival',1,'2014-04-03 16:58:23',17,NULL,NULL,'N',3),(11,'Diwali','2014-11-27','diwali festival',1,'2014-04-03 16:58:23',17,'2014-04-03 17:10:00',17,'N',5),(12,'ramzan','2014-04-05','ramzan',1,'2014-04-03 16:58:23',0,NULL,NULL,'N',2),(13,'tamil new year','2014-04-14','tamil new year',1,'2014-04-03 16:58:23',0,NULL,NULL,'N',2),(14,'Gandhi birthday','2014-07-15','',1,'2014-07-26 16:45:17',19,NULL,NULL,'N',4),(15,'Gandhi birthday','2014-07-15','',1,'2014-07-26 16:45:17',19,NULL,NULL,'N',2),(16,'Gandhi birthday','2014-07-15','',1,'2014-07-26 16:45:17',19,NULL,NULL,'N',1),(17,'Gandhi birthday','2014-07-15','',1,'2014-07-26 16:45:17',19,NULL,NULL,'N',3),(18,'Gandhi birthday','2014-07-15','',1,'2014-07-26 16:45:17',19,NULL,NULL,'N',5),(19,'Tagore birthday','2014-07-01','',1,'2014-07-26 16:45:36',19,NULL,NULL,'N',4),(20,'Tagore birthday','2014-07-01','',1,'2014-07-26 16:45:36',19,NULL,NULL,'N',2),(21,'Tagore birthday','2014-07-01','',1,'2014-07-26 16:45:36',19,NULL,NULL,'N',1),(22,'Tagore birthday','2014-07-01','',1,'2014-07-26 16:45:36',19,NULL,NULL,'N',3),(23,'Tagore birthday','2014-07-01','',1,'2014-07-26 16:45:36',19,NULL,NULL,'N',5);
/*!40000 ALTER TABLE `hr_holiday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave`
--

DROP TABLE IF EXISTS `hr_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `no_days` float NOT NULL,
  `session` enum('M','A') DEFAULT NULL COMMENT 'M - Morning\nA - Afternoon',
  `reason` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL COMMENT 'N - Not Deleted\nY - Deleted',
  `is_approve` enum('N','Y','R') NOT NULL DEFAULT 'N',
  `read_status` enum('1','0') NOT NULL DEFAULT '0',
  `hr_leave_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1` (`app_users_id`),
  KEY `fk_hr_leave_hr_leave_type1` (`hr_leave_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave`
--

LOCK TABLES `hr_leave` WRITE;
/*!40000 ALTER TABLE `hr_leave` DISABLE KEYS */;
INSERT INTO `hr_leave` VALUES (1,'2014-09-05','2014-09-14',7,NULL,'test for pl encash','2014-07-26 11:31:27',NULL,10,'N','N','0',2),(2,'2014-09-02','2014-09-18',14,NULL,'test for pl balance','2014-07-26 12:36:30',NULL,25,'N','N','0',2),(3,'2015-09-02','2015-09-03',1,NULL,'test','2014-07-26 12:36:30',NULL,25,'N','N','0',2),(4,'2014-08-08','2014-08-09',1,NULL,'test for leave balance','2014-07-26 13:48:57',NULL,19,'N','N','0',1),(5,'2014-08-15','2014-08-18',3,NULL,'test for leave count','2014-07-26 13:49:42',NULL,19,'N','N','0',2),(6,'2014-07-09','2014-07-10',2,NULL,'test','2014-07-31 17:10:34',NULL,15,'N','N','0',1),(7,'2014-07-22','2014-07-22',1,NULL,'test','2014-07-31 17:11:42',NULL,15,'N','N','0',3);
/*!40000 ALTER TABLE `hr_leave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave_balance`
--

DROP TABLE IF EXISTS `hr_leave_balance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave_balance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `pl_bal` float unsigned NOT NULL,
  `nbl_bal` float unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1_idx` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave_balance`
--

LOCK TABLES `hr_leave_balance` WRITE;
/*!40000 ALTER TABLE `hr_leave_balance` DISABLE KEYS */;
INSERT INTO `hr_leave_balance` VALUES (1,2014,3,15,'2014-06-02 17:58:49',19,NULL,NULL,'N',1),(2,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',1),(3,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',1),(4,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',1),(5,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',1),(6,2014,15,10,'2014-06-02 17:58:49',19,NULL,NULL,'N',2),(7,2013,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',2),(8,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',2),(9,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',2),(10,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',2),(11,2014,15,12,'2014-06-02 17:58:49',19,NULL,NULL,'N',3),(12,2013,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',3),(13,2012,7,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',3),(14,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',3),(15,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',3),(16,2014,15,15,'2014-06-02 17:58:49',19,NULL,NULL,'N',4),(17,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',4),(18,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',4),(19,2011,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',4),(20,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',4),(21,2014,11,7.5,'2014-06-02 17:58:49',19,NULL,NULL,'N',5),(22,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',5),(23,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',5),(24,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',5),(25,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',5),(26,2014,15,6,'2014-06-02 17:58:49',19,NULL,NULL,'N',6),(27,2013,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',6),(28,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',6),(29,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',6),(30,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',6),(31,2014,15,13,'2014-06-02 17:58:49',19,NULL,NULL,'N',9),(32,2013,11,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',9),(33,2012,11,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',9),(34,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',9),(35,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',9),(36,2014,15,12,'2014-06-02 17:58:49',19,NULL,NULL,'N',10),(37,2013,5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',10),(38,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',10),(39,2011,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',10),(40,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',10),(41,2014,15,4,'2014-06-02 17:58:49',19,NULL,NULL,'N',11),(42,2013,1.5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',11),(43,2012,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',11),(44,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',11),(45,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',11),(46,2014,15,11.5,'2014-06-02 17:58:49',19,NULL,NULL,'N',12),(47,2013,1,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',12),(48,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',12),(49,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',12),(50,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',12),(51,2014,8,13,'2014-06-02 17:58:49',19,NULL,NULL,'N',13),(52,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',13),(53,2012,5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',13),(54,2011,10,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',13),(55,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',13),(56,2014,14,15,'2014-06-02 17:58:49',19,NULL,NULL,'N',14),(57,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',14),(58,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',14),(59,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',14),(60,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',14),(61,2014,11,13.5,'2014-06-02 17:58:49',19,NULL,NULL,'N',15),(62,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',15),(63,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',15),(64,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',15),(65,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',15),(66,2014,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',17),(67,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',17),(68,2012,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',17),(69,2011,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',17),(70,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',17),(71,2014,12,6,'2014-06-02 17:58:49',19,NULL,NULL,'N',18),(72,2013,13,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',18),(73,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',18),(74,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',18),(75,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',18),(76,2014,15,8.5,'2014-06-02 17:58:49',19,NULL,NULL,'N',19),(77,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',19),(78,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',19),(79,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',19),(80,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',19),(81,2014,15,6,'2014-06-02 17:58:49',19,NULL,NULL,'N',20),(82,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',20),(83,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',20),(84,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',20),(85,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',20),(86,2014,10,12,'2014-06-02 17:58:49',19,NULL,NULL,'N',21),(87,2013,6.5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',21),(88,2012,7,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',21),(89,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',21),(90,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',21),(91,2014,15,11,'2014-06-02 17:58:49',19,NULL,NULL,'N',22),(92,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',22),(93,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',22),(94,2011,4,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',22),(95,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',22),(96,2014,7,9,'2014-06-02 17:58:49',19,NULL,NULL,'N',23),(97,2013,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',23),(98,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',23),(99,2011,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',23),(100,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',23),(101,2014,10,10,'2014-06-02 17:58:49',19,NULL,NULL,'N',24),(102,2013,5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',24),(103,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',24),(104,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',24),(105,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',24),(106,2014,15,14,'2014-06-02 17:58:49',19,NULL,NULL,'N',25),(107,2013,10,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',25),(108,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',25),(109,2011,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',25),(110,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',25),(111,2014,14,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',27),(112,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',27),(113,2012,7,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',27),(114,2011,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',27),(115,2010,24,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',27),(116,2014,15,13,'2014-06-02 17:58:49',19,NULL,NULL,'N',29),(117,2013,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',29),(118,2012,7.5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',29),(119,2011,7.5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',29),(120,2010,24,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',29),(121,2014,15,12,'2014-06-02 17:58:49',19,NULL,NULL,'N',30),(122,2013,8,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',30),(123,2012,12,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',30),(124,2011,10,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',30),(125,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',30),(126,2014,15,13.5,'2014-06-02 17:58:49',19,NULL,NULL,'N',31),(127,2013,9,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',31),(128,2012,10,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',31),(129,2011,5.5,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',31),(130,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',31),(131,2014,1.5,6,'2014-06-02 17:58:49',19,NULL,NULL,'N',33),(132,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',33),(133,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',33),(134,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',33),(135,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',33),(136,2014,15,12,'2014-06-02 17:58:49',19,NULL,NULL,'N',34),(137,2013,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',34),(138,2012,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',34),(139,2011,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',34),(140,2010,0,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',34),(141,2014,15,0,'2014-07-23 00:00:00',1,NULL,NULL,'N',16),(142,2015,15,0,'2015-06-02 17:58:49',19,NULL,NULL,'N',10),(143,2015,15,0,'2014-06-02 17:58:49',19,NULL,NULL,'N',25);
/*!40000 ALTER TABLE `hr_leave_balance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave_compoff`
--

DROP TABLE IF EXISTS `hr_leave_compoff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave_compoff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comp_off` date NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_approve` enum('N','Y','R') NOT NULL DEFAULT 'N',
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_leave_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1_idx` (`app_users_id`),
  KEY `fk_hr_leave_compoff_hr_leave1_idx` (`hr_leave_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave_compoff`
--

LOCK TABLES `hr_leave_compoff` WRITE;
/*!40000 ALTER TABLE `hr_leave_compoff` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_leave_compoff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave_encash`
--

DROP TABLE IF EXISTS `hr_leave_encash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave_encash` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `encashable` float unsigned NOT NULL,
  `encashed` float DEFAULT NULL,
  `encash_on` date DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1_idx` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave_encash`
--

LOCK TABLES `hr_leave_encash` WRITE;
/*!40000 ALTER TABLE `hr_leave_encash` DISABLE KEYS */;
INSERT INTO `hr_leave_encash` VALUES (1,2014,29,NULL,NULL,'2014-07-26 19:46:03',10,NULL,NULL),(2,2014,34,NULL,NULL,'2014-07-31 17:14:50',25,NULL,NULL),(3,2014,27,NULL,NULL,'2014-07-31 17:33:57',27,NULL,NULL);
/*!40000 ALTER TABLE `hr_leave_encash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave_status`
--

DROP TABLE IF EXISTS `hr_leave_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `status` enum('W','A','R') NOT NULL DEFAULT 'W' COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `remarks` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `hr_leave_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1` (`app_users_id`),
  KEY `fk_hr_leave_status_hr_leave1` (`hr_leave_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave_status`
--

LOCK TABLES `hr_leave_status` WRITE;
/*!40000 ALTER TABLE `hr_leave_status` DISABLE KEYS */;
INSERT INTO `hr_leave_status` VALUES (1,19,'W',NULL,'2014-07-26 11:31:27',NULL,NULL,1),(2,10,'W',NULL,'2014-07-26 12:36:30',NULL,NULL,2),(3,10,'W',NULL,'2014-07-26 13:48:57',NULL,NULL,4),(4,10,'W',NULL,'2014-07-26 13:49:42',NULL,NULL,5),(5,10,'W',NULL,'2014-07-31 17:10:34',NULL,NULL,6),(6,10,'W',NULL,'2014-07-31 17:11:42',NULL,NULL,7);
/*!40000 ALTER TABLE `hr_leave_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave_type`
--

DROP TABLE IF EXISTS `hr_leave_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(5) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `max_limit` enum('1','0') NOT NULL COMMENT ' max. limit available or not',
  `no_days_prob` tinyint(4) DEFAULT NULL,
  `no_days` tinyint(4) DEFAULT NULL,
  `priority` tinyint(4) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `modified_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave_type`
--

LOCK TABLES `hr_leave_type` WRITE;
/*!40000 ALTER TABLE `hr_leave_type` DISABLE KEYS */;
INSERT INTO `hr_leave_type` VALUES (1,'(NBL)','Need Based Leave','1',3,15,1,'1','2014-03-26 00:00:00',0,NULL,'N',NULL),(2,'(PL)','Privilege Leave','1',0,15,2,'1','2014-03-26 00:00:00',0,NULL,'N',NULL),(3,'(LOP)','Loss of Pay','0',NULL,NULL,4,'1','2014-03-26 00:00:00',0,NULL,'N',NULL),(4,'(ML)','Maternity Leave','1',NULL,90,5,'1','2014-03-26 00:00:00',0,NULL,'N',NULL),(5,'(PTL)','Paternity Leave','1',NULL,3,6,'1','2014-03-26 00:00:00',0,NULL,'N',NULL),(6,'(OD)','On Duty','0',NULL,NULL,3,'1','2014-03-26 00:00:00',0,NULL,'N',NULL),(7,'(CO)','Comp. Off','0',NULL,NULL,7,'1','2014-03-26 00:00:00',0,NULL,'N',NULL);
/*!40000 ALTER TABLE `hr_leave_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_leave_users`
--

DROP TABLE IF EXISTS `hr_leave_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_leave_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_leave_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_app_users1` (`app_users_id`),
  KEY `fk_hr_leave_users_hr_leave1` (`hr_leave_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_leave_users`
--

LOCK TABLES `hr_leave_users` WRITE;
/*!40000 ALTER TABLE `hr_leave_users` DISABLE KEYS */;
INSERT INTO `hr_leave_users` VALUES (1,19,1),(2,10,2),(3,10,4),(4,10,5),(5,10,6),(6,10,7);
/*!40000 ALTER TABLE `hr_leave_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_news`
--

DROP TABLE IF EXISTS `hr_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `desc` text NOT NULL,
  `attachment` varchar(45) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_news`
--

LOCK TABLES `hr_news` WRITE;
/*!40000 ALTER TABLE `hr_news` DISABLE KEYS */;
INSERT INTO `hr_news` VALUES (1,'Musharraf indicted for high treason',1,'<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">For the first time, a former chief of army staff and President of Pakistan was indicted by a special court for high treason on Monday for imposing emergency and subverting the Constitution.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">General (retd) Pervez Musharraf pleaded not guilty to all of the charges.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">Justice Faisal Arab who heads the special court asked Justice Tahira Safdar to read out each of the five charges to Musharraf who appeared even before the court time at 9.30 am in a wall of security. The court had issued non bailable arrest warrants to be executed if he failed to appear today of his own volition. There was speculation that the former military dictator would not appear since he was admitted to the ICU last night in the Armed Forces Institute of Cardiology (AFIC) where he has been since January 2. His entire team of lawyers led by Sharifuddin Pirzada boycotted the proceedings and a new lawyer Dr Faroogh Naseem, also a senator from the Muttahida Qaumi Movement (MQM) told the court he would represent Musharraf from now on. All he knew about the case was what had appeared in the media, he said as he was engaged last night and needed time to go through a bunch of documents.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">He said Musharraf&#39;s mother was ill in Sharjah and sought permission for his client to leave the country to visit her. He also submitted a confidential medical report on Musharraf&#39;s condition and sought permission for him to travel abroad to seek the medical treatment of his choice.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">Justice Arab said the law was clear and under Article 6 of the Constitution the charges have to be read out to the accused. Under Article 6 of the Constitution, &quot;Any person who abrogates or subverts or suspends or holds in abeyance, or attempts or conspires to abrogate or subvert or suspend or hold in abeyance, the Constitution by use of force or show of force or by any other unconstitutional means shall be guilty of high treason.&quot; The Parliament shall by law provide for the punishment of persons found guilty of high treason. The former military dictator was charged with issuing an unconstitutional and unlawful order on November, 3, 2007 at Rawalpindi as Chief of the Army Staff, called the &quot;Proclamation of Emergency Order, 2007&quot; which held the Constitution in abeyance. He subverted the Constitution and committed the offence of high treason punishable under section 2 of the High Treason (Punishment) Act, 1973. Musharraf has also been charged with issuing the Provisional Constitution Order No.1 of 2007 which empowered the President to amend the Constitution from time to time, apart from suspending Fundamental Rights enshrined in Articles 9, 10, 15, 16, 17, 19 and 25 of the Constitution. On the same day he issued an Oath of Office (Judges) Order, 2007 whereby an oath was introduced in the Schedule which required a judge to abide by the provisions of the Proclamation of Emergency dated November 3, 2007 and the Provisional Constitutional Order of the same date. This order resulted in the removal of numerous judges of the superior courts including the Chief Justice of Pakistan. Musharraf is also being charged for amending the Constitution and some of its provisions and subverting it.</p>\r\n','1_20TH_MUSHARRAF_1434389f.jpg','2014-04-15 00:00:00',17,'2014-03-31 16:36:32',17,'N'),(2,'Sri Lankan Tamil organisations regret Indiaâ€™s abstention',1,'<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">Several organisations of Sri Lankan Tamils living outside the country have expressed disappointment over India&rsquo;s abstention at the U.N. Human Rights Council, where a U.S.-backed resolution was adopted on March 27.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">&ldquo;India&rsquo;s history of moral leadership and courage, coupled with its unique cultural and intellectual affinity with Eelam Tamils, makes its abstention and vote against the operative paragraph establishing an investigation deeply disappointing,&rdquo; said a joint statement put out on Sunday by the British Tamils Forum, the Federation of Tamil Sangams of North America, the Ilankai Tamil Sangam, the People for Equality and Relief in Lanka (PEARL), the Solidarity Group for Peace and Justice in Sri Lanka, the Transnational Government of Tamil Eelam, the United States Tamil Political Action Council and the World Tamil Organisation.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">Welcoming the establishment of an international investigative mechanism to establish the facts and circumstances pertaining to &ldquo;serious violations and abuses of human rights and related crimes&rdquo; committed in Sri Lanka, they said they would have liked to see the resolution better reflect the survivors&rsquo; and victims&rsquo; narratives seeking justice, reparations and closure for the killing of &ldquo;over 70,000 Tamils in just a few months in 2009 and determining the fate of 146,679 Tamils who remain unaccounted.&rdquo;</p>\r\n',NULL,'2014-03-31 16:38:11',17,'2014-03-31 16:40:11',17,'N'),(3,'test',1,'<p>test</p>\r\n',NULL,'2014-03-31 16:39:48',17,'2014-03-31 16:39:51',NULL,'Y'),(4,'Eight killed in raid on Taliban hideout in Afghanistan',1,'<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">At least eight people were killed when security forces raided a militant hideout in Afghanistan on Sunday, an official said.</p>\r\n\r\n<p class=\"body\" style=\"outline: 0px; margin-top: 0px; margin-bottom: 20px; color: rgb(59, 58, 57); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 14px; line-height: 18px;\">&ldquo;Units of security forces raided Taliban hideout in Soch area of Jerm district of North-eastern Badakhshan province in the wee hours of Sunday and the operation continued for three hours during which six militants, including commander Mullah Sayed Shah, were killed,&rdquo;&nbsp;<i style=\"outline: 0px;\">Xinhua</i>&nbsp;quoted Noor Aqa Nadiri, Jerm district governor, as saying.</p>\r\n','4_12_Form 13 - PF Transfer.pdf','2014-03-31 17:39:26',17,NULL,NULL,'N'),(5,'test',1,'<p>Our Bank has launched the Internet Banking Product &ldquo;TMB - eConnect&rdquo; on 19.11.2008 as an additional&nbsp;<br />\r\ndelivery channel to improve the Customer Service and reduce the transaction cost. Till 24.08.2010, 14913&nbsp;<br />\r\ncustomers have enrolled to avail this service. The list of top 10 branches in terms of number of registration&nbsp;<br />\r\nis given below:&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;Mumbai Branches?&nbsp;<br />\r\nBased on the representations from our branches and customers, our Bank is expanding the scope of&nbsp;<br />\r\ninternet banking services to Cash Credit Account holders under TMB eConnect &ndash; Retail Module and they&nbsp;<br />\r\nhave been classified as &ldquo;RETAIL HIGH VALUE&rdquo;.&nbsp;<br />\r\n&nbsp;<br />\r\nEligibility Criteria&nbsp;<br />\r\nThe branches should upload the TMB eConnect registration only for the Cash Credit Account&nbsp;<br />\r\nholders who are having atleast two years of satisfactory operations.&nbsp;<br />\r\n&nbsp;<br />\r\nAll types of facilities, like funds transfer, Payment Gateway Service etc., offered to other types of customers&nbsp;<br />\r\nwill also be provided to the Cash Credit Account holders. The Cash Credit Accounts where there is joint&nbsp;<br />\r\noperation are not eligible for availing this facility.&nbsp;<br />\r\n&nbsp;<br />\r\nAbout the applications to be obtained&nbsp;<br />\r\nThere is no change needed in existing terms and conditions as well as application forms. However, we&nbsp;<br />\r\nhave fine tuned the agreement forms to be obtained from HUF/Partnership/Companies etc and the same&nbsp;<br />\r\nwill be available in our Help site for easy downloading at the branches.&nbsp;<br />\r\n&nbsp;<br />\r\nTransaction Limits&nbsp;<br />\r\nTransaction limits [Self as well as Third Party] Cumulative limits for funds transfer&nbsp;<br />\r\n&nbsp;<br />\r\n&nbsp;Retail High Value&nbsp;<br />\r\nMaximum Limit (per day)&nbsp;<br />\r\nfor transactions between&nbsp;<br />\r\nour branches&nbsp;<br />\r\n` 3,00,000/-&nbsp;<br />\r\nNo Charges for funds transfer between&nbsp;<br />\r\nour branches&nbsp;<br />\r\nWe hope the expansion of the scope of TMB eConnect will boost the number of enrollments in the internet&nbsp;<br />\r\nbanking. The branches are advised to display banners/posters in the Banking Hall, ATM etc about our TMB&nbsp;<br />\r\neConnect Service/Bill Payment service to popularize the TMB eConnect facility. Even High Credit worthy&nbsp;<br />\r\nCustomers shall be intimated through a letter about the new facility.&nbsp;<br />\r\nBranch Heads are advised to bring</p>\r\n','5_econnect.pdf','2014-07-11 09:51:38',19,'2014-07-11 09:59:03',19,'N'),(6,'3. Fuelling Change',1,'<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\"><strong style=\"box-sizing: border-box;\">ies</strong></p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\">Citizens can self-attest IDs, address proofs &amp; other documents. No need for long queues at dingy notary public offices. States advised to follow the same rule.</p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\"><strong style=\"box-sizing: border-box;\">2. Rooting for Retired</strong></p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\">PF contributions go up big because salary cut-off raised from Rs 6,500 to Rs 15,000. Plus NPS contribution made tax-free.</p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\"><strong style=\"box-sizing: border-box;\">3. Fuelling Change</strong></p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\">UPA made premium petrol, diesel much pricier than ordinary fuel. Price difference now down to just Rs 2/L. Good for city air.</p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\"><strong style=\"box-sizing: border-box;\">4. Truly Tatkal</strong></p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\">Those last-minute rail bookings now far easier. Railways online system can now handle 7,200 bookings per minute, a 300% jump in speed.</p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\"><strong style=\"box-sizing: border-box;\">5. Smarter Help</strong></p>\r\n\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(57, 57, 57); font-family: \'Open Sans\'; line-height: 19.5px;\">PM Relief Fund disbursals no longer based on lottery. Seriously ill poor and children to get top priority. Plus, SMS from PM when your request is granted.</p>\r\n',NULL,'2014-07-23 13:25:01',19,'2014-07-23 13:35:09',19,'N');
/*!40000 ALTER TABLE `hr_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_office_timing`
--

DROP TABLE IF EXISTS `hr_office_timing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_office_timing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `grace_time` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hr_office_timing_app_users1_idx` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_office_timing`
--

LOCK TABLES `hr_office_timing` WRITE;
/*!40000 ALTER TABLE `hr_office_timing` DISABLE KEYS */;
INSERT INTO `hr_office_timing` VALUES (1,'09:30:00','18:30:00',15,'2014-05-17 10:20:32','2014-06-21 18:07:12',19,19,2),(2,'10:00:00','18:30:00',5,'0000-00-00 00:00:00',NULL,0,NULL,5),(3,'10:00:00','18:30:00',30,'2014-07-31 13:57:43','2014-07-31 14:18:05',17,17,17),(4,'09:30:00','18:30:00',15,'2014-07-31 17:16:42',NULL,19,NULL,25);
/*!40000 ALTER TABLE `hr_office_timing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_org_updates`
--

DROP TABLE IF EXISTS `hr_org_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_org_updates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `priority` tinyint(4) NOT NULL,
  `desc` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_org_updates`
--

LOCK TABLES `hr_org_updates` WRITE;
/*!40000 ALTER TABLE `hr_org_updates` DISABLE KEYS */;
INSERT INTO `hr_org_updates` VALUES (1,'CEO Family',1,0,'<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\"><strong><em>Built with the foundation of values CEO in every act of its employees and in transactions demonstrates very high ethical standards.</em></strong></p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">Learning Environment has been one of the hallmarks of CEO &ndash; employees have the option and flexibility to move into different business verticals: consulting, recruitment and training. CEO believes in employing those with native intelligence, willing to learn / go the extra-mile, challenge the status quo / innovate, and create the future while attending to the present.</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">One can smell and see the positivity in the culture of CEO right from day-1 &ndash; be it the peer interview, talent-job match, employee induction, buddy-mentoring, empowerment, learning visits, celebration, get-togethers, technical and leadership training to share the ones that binds each employee into CEO family.</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">At CEO we believe each employee is a brand &ndash; they being the face of the organization in their interface with clients and partners demonstrate the values of CEO. Come join CEO and experience the world of difference.</p>\r\n','2014-03-31 18:32:12',17,'2014-03-31 19:02:51',17,'N'),(2,'About Us',1,0,'<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">Began as HR Consulting firm in 1999, CEO (CEO Consulting) has had a humble start with its unique approach to Building High Performance Organizations using the platform of &ldquo;Self Directed Work Teams&rdquo; (SDWT), one of the most sought-after models in Corporate India today. Within a short span of time the turnkey change management interventions took CEO to PAN India and South East Asian markets.</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">CEO has always believed that with the economic indices showing positive trend in most developing countries, investment in nurturing talent is inevitable &ndash; more so in countries like India where there is a huge shortage on ready market talent. With this strong belief in nurturing talent, CEO ventured into the space of training people and helping organizations to find right talent (CEO Talent Search) in the year 2002.</p>\r\n','2014-03-31 18:32:59',17,'2014-03-31 19:02:29',17,'N'),(3,'VISION',1,0,'<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\"><em><strong>CEO is perhaps the only organization in India that has a perfect combination of Consulting, Recruitment, Training and Technology making it a one-stop solution provider for all HR services.</strong></em></p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">Specifically in recruitment, CEO Talent Search operates in the entire spectrum of recruitment support, viz. Executive Search, Mass / Frontline Recruitment, Temp Staffing and Recruitment Process Outsourcing.</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">&nbsp;</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\"><img alt=\"\" src=\"http://localhost/php/ceo_apps/uploads/files/2_ceo-talent-search (1).png\" style=\"width: 123px; height: 64px;\" /></p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">CEO Talent Search is equipped with professionals who bring in domain expertise and rich experience in the field of recruitment. At the moment CEO has presence in more than 15 states; reaching the farther and very remotest locations in the country to find talent and create employability.</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">CEO Talent Search uses technology-driven tools to anchor some of the important aspects of the recruitment business such as communication, accounting and administration. The indigenous softwares are designed to cater to / fulfill the needs of wide ranging customers. Some of the most proven tools such as Hire Craft are adopted to bring efficiency in its Executive Search operation. CEO Talent Search is the first-ever to introduce a job portal for frontline, fresher as early as in 2007.</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px 0px 10px; line-height: 22px; text-align: justify; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif;\">With 100+ full-time employees spread across the major 7 cities in the country; teams designed to maintain close interface with clients, candidates, network partners; equipped with dedicated research team for assessment tool development &ndash; CEO Talent Search brings you the best delivery model which most progressive organizations would look for.</p>\r\n','2014-03-31 19:03:55',17,'2014-05-03 17:57:40',19,'N');
/*!40000 ALTER TABLE `hr_org_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_permission`
--

DROP TABLE IF EXISTS `hr_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `per_date` date NOT NULL,
  `per_from` time NOT NULL,
  `per_to` time NOT NULL,
  `no_hrs` time NOT NULL,
  `reason` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL COMMENT 'N - Not Deleted\nY - Deleted',
  `is_approve` enum('N','Y','R') NOT NULL DEFAULT 'N',
  `read_status` enum('1','0') NOT NULL DEFAULT '0',
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_advance_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_permission`
--

LOCK TABLES `hr_permission` WRITE;
/*!40000 ALTER TABLE `hr_permission` DISABLE KEYS */;
INSERT INTO `hr_permission` VALUES (1,'2014-04-09','12:00:00','01:00:00','01:00:00','Going for lunch earlier','2014-03-29 15:48:43',NULL,'N','N','0',10),(2,'2014-03-18','12:00:00','12:45:00','00:45:00','need to go to home','2014-03-29 15:54:58',NULL,'N','N','0',10),(3,'2014-03-20','16:00:00','16:30:00','00:30:00','Going to home','2014-03-29 15:58:30',NULL,'N','N','0',10),(4,'2014-03-28','12:30:00','13:00:00','00:30:00','going for lunch','2014-03-29 16:56:48',NULL,'N','N','0',17),(5,'2014-03-28','12:30:00','13:00:00','00:30:00','going for lunch','2014-03-29 16:56:59',NULL,'N','Y','0',17),(6,'2014-03-28','12:30:00','13:00:00','00:30:00','going for lunch','2014-03-29 16:58:56',NULL,'N','N','0',17),(7,'2014-03-28','12:30:00','13:00:00','00:30:00','going for lunch','2014-03-29 17:03:28',NULL,'N','N','0',17),(8,'2014-03-20','14:00:00','15:00:00','01:00:00','test','2014-03-29 17:19:18',NULL,'N','Y','0',17),(9,'2014-03-28','11:00:00','11:30:00','00:30:00','for testing','2014-03-29 17:30:33',NULL,'N','Y','0',17),(10,'2014-03-29','11:30:00','12:00:00','00:30:00','test','2014-03-29 17:46:10',NULL,'N','N','0',17),(11,'2014-03-12','12:30:00','13:00:00','00:30:00','going home','2014-03-29 17:49:50',NULL,'N','Y','0',11),(12,'2014-03-06','12:30:00','13:00:00','00:30:00','going home','2014-03-29 17:50:10',NULL,'N','Y','0',11),(13,'2014-03-13','12:30:00','13:00:00','00:30:00','going home','2014-03-29 17:51:20',NULL,'N','Y','0',11),(14,'2014-04-01','11:45:00','12:45:00','01:00:00','going to home','2014-03-29 18:00:25',NULL,'N','Y','0',11),(15,'2014-04-10','15:00:00','16:00:00','01:00:00','home','2014-03-29 18:02:33',NULL,'N','Y','0',11),(16,'2014-03-15','12:00:00','12:30:00','00:30:00','going','2014-03-29 18:06:23',NULL,'N','Y','0',11),(17,'2014-04-16','11:00:00','12:00:00','01:00:00','going to home','2014-04-01 10:28:05',NULL,'N','Y','0',17),(18,'2014-04-15','12:00:00','14:00:00','02:00:00','Going lunch to home','2014-04-08 13:10:01',NULL,'N','Y','0',17),(19,'2014-04-10','10:45:00','12:45:00','02:00:00','test','2014-04-11 13:35:31',NULL,'N','N','0',10),(20,'2014-04-24','23:00:00','13:00:00','02:00:00','Going to lunch with client.','2014-04-18 18:05:01',NULL,'N','Y','0',19),(21,'2014-04-26','12:00:00','13:00:00','01:00:00','Lunch break','2014-04-18 18:07:51',NULL,'N','','0',19),(22,'2014-04-25','16:00:00','17:00:00','01:00:00','client meeting','2014-04-18 18:10:47',NULL,'N','R','0',19),(24,'2014-05-06','12:00:00','13:45:00','01:45:00','test','2014-05-04 21:22:06',NULL,'N','N','0',10),(25,'2014-05-14','12:00:00','13:00:00','01:00:00','test','2014-05-13 17:50:47',NULL,'N','N','0',17),(26,'2014-05-15','12:00:00','13:00:00','01:00:00','test','2014-05-13 17:54:26',NULL,'N','N','0',19),(27,'2014-05-13','00:00:00','00:45:00','00:45:00','test','2014-05-20 18:21:35',NULL,'N','R','0',21),(28,'2014-06-10','12:00:00','14:00:00','02:00:00','test','2014-06-02 15:18:20',NULL,'N','N','0',11),(29,'2014-06-18','12:30:00','12:45:00','00:15:00','test','2014-06-02 18:53:55',NULL,'N','Y','0',19),(30,'2014-06-26','12:00:00','13:45:00','01:45:00','test','2014-06-02 18:59:17',NULL,'N','N','0',19),(31,'2014-06-17','16:00:00','16:15:00','00:15:00','15 mins. late','2014-06-02 20:35:24',NULL,'N','N','0',54),(32,'2014-06-26','12:00:00','13:30:00','01:30:00','test','2014-06-25 12:14:10',NULL,'N','N','0',10),(33,'2014-06-28','12:00:00','12:30:00','00:30:00','test','2014-06-25 12:14:43',NULL,'N','N','0',23),(34,'2014-07-18','12:00:00','12:15:00','00:15:00','test','2014-06-25 12:54:45',NULL,'N','N','0',10),(35,'2014-06-28','12:00:00','12:15:00','00:15:00','test','2014-06-25 12:59:29',NULL,'N','N','0',10),(36,'2014-06-25','00:15:00','00:30:00','00:15:00','test','2014-06-25 15:25:24',NULL,'N','Y','0',5),(37,'2014-07-17','00:30:00','01:30:00','01:00:00','test','2014-06-25 15:25:58',NULL,'N','N','0',3),(38,'2014-06-26','00:00:00','00:15:00','00:15:00','test','2014-06-25 18:48:30',NULL,'N','R','0',10),(39,'2014-07-17','00:15:00','00:30:00','00:15:00','test','2014-06-25 18:51:37',NULL,'N','N','0',10),(40,'2014-06-30','00:00:00','00:15:00','00:15:00','test','2014-06-25 18:52:16',NULL,'N','N','0',10),(41,'2014-06-27','00:00:00','00:30:00','00:30:00','test','2014-06-25 19:24:32',NULL,'N','Y','0',5),(42,'2014-06-28','00:30:00','01:45:00','01:15:00','test','2014-06-25 19:25:25',NULL,'N','R','0',5),(43,'2014-06-29','00:15:00','01:15:00','01:00:00','test','2014-06-25 19:28:32',NULL,'N','N','0',5),(44,'2014-06-02','00:00:00','00:15:00','00:15:00','test','2014-06-26 15:53:35',NULL,'N','N','0',5),(45,'2014-08-14','00:00:00','00:15:00','00:15:00','test4','2014-06-26 16:04:16',NULL,'N','N','0',5),(46,'2014-05-14','14:00:00','15:00:00','01:00:00','yy','2014-06-26 17:07:37',NULL,'N','N','0',5),(47,'2014-05-21','12:00:00','00:30:00','00:30:00','t','2014-06-26 17:09:30',NULL,'N','N','0',5),(48,'2014-07-31','10:00:00','10:15:00','00:15:00','test','2014-07-31 13:49:55',NULL,'N','N','0',17),(49,'2014-07-31','09:30:00','10:00:00','00:30:00','test for in time late attendance','2014-07-31 17:17:05',NULL,'N','N','0',25);
/*!40000 ALTER TABLE `hr_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_permission_status`
--

DROP TABLE IF EXISTS `hr_permission_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_permission_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('W','A','R') NOT NULL DEFAULT 'W' COMMENT 'W - Waiting\nA - Approved\nR - Rejected',
  `remarks` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1` (`app_users_id`),
  KEY `fk_hr_permission_status_hr_permission1` (`hr_permission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_permission_status`
--

LOCK TABLES `hr_permission_status` WRITE;
/*!40000 ALTER TABLE `hr_permission_status` DISABLE KEYS */;
INSERT INTO `hr_permission_status` VALUES (1,'W',NULL,'2014-03-29 16:56:48',NULL,NULL,10,4),(2,'R','sorry sir','2014-03-29 16:56:59','2014-04-11 13:24:39',10,10,5),(3,'W',NULL,'2014-03-29 16:58:56',NULL,NULL,10,6),(4,'W',NULL,'2014-03-29 17:03:28',NULL,NULL,10,7),(5,'R','sorry','2014-03-29 17:19:18','2014-04-11 13:23:19',10,10,8),(6,'R','sorry','2014-03-29 17:30:33','2014-04-11 13:21:04',10,10,9),(7,'A',NULL,'2014-03-29 17:46:10','2014-04-11 13:20:33',10,10,10),(8,'A',NULL,'2014-03-29 17:49:50','2014-03-29 19:56:32',17,17,11),(9,'A',NULL,'2014-03-29 17:50:10','2014-04-26 11:43:40',17,17,12),(10,'A',NULL,'2014-03-29 17:51:20','2014-03-29 19:53:35',17,17,13),(11,'A',NULL,'2014-03-29 18:00:25','2014-03-29 19:49:49',17,17,14),(12,'A',NULL,'2014-03-29 18:02:33','2014-03-29 19:44:58',17,17,15),(13,'A',NULL,'2014-03-29 18:06:23','2014-03-29 19:44:23',17,17,16),(14,'A',NULL,'2014-04-01 10:28:05','2014-04-11 13:11:54',10,10,17),(15,'A',NULL,'2014-04-08 13:10:01','2014-04-11 13:05:24',10,10,18),(16,'R','sorry','2014-04-18 18:05:01','2014-04-18 18:05:30',10,10,20),(17,'R','no','2014-04-18 18:07:51','2014-04-18 18:09:28',10,10,21),(18,'R','sorry','2014-04-18 18:10:47','2014-04-18 18:11:08',10,10,22),(19,'W',NULL,'2014-05-04 21:15:11',NULL,NULL,19,23),(20,'W',NULL,'2014-05-04 21:22:06',NULL,NULL,19,24),(21,'W',NULL,'2014-05-13 17:50:47',NULL,NULL,10,25),(22,'W',NULL,'2014-05-13 17:54:26',NULL,NULL,10,26),(23,'R','no','2014-05-20 18:21:35','2014-07-24 10:06:44',10,10,27),(24,'W',NULL,'2014-06-02 15:18:20',NULL,NULL,17,28),(25,'A',NULL,'2014-06-02 18:53:55','2014-07-24 10:08:17',10,10,29),(26,'W',NULL,'2014-06-02 18:59:17',NULL,NULL,10,30),(27,'W',NULL,'2014-06-25 12:14:10',NULL,NULL,19,32),(28,'W',NULL,'2014-06-25 12:14:43',NULL,NULL,19,33),(29,'W',NULL,'2014-06-25 12:54:45',NULL,NULL,19,34),(30,'W',NULL,'2014-06-25 12:59:29',NULL,NULL,19,35),(31,'A',NULL,'2014-06-25 15:25:24','2014-06-25 19:27:24',25,25,36),(32,'W',NULL,'2014-06-25 15:25:58',NULL,NULL,25,37),(33,'W',NULL,'2014-06-25 18:48:30',NULL,NULL,19,38),(34,'W',NULL,'2014-06-25 18:51:37',NULL,NULL,19,39),(35,'W',NULL,'2014-06-25 18:52:16',NULL,NULL,19,40),(36,'A',NULL,'2014-06-25 19:24:32','2014-06-25 19:26:59',25,25,41),(37,'R','re','2014-06-25 19:25:25','2014-06-25 19:26:45',25,25,42),(38,'W',NULL,'2014-06-25 19:28:32',NULL,NULL,25,43),(39,'W',NULL,'2014-06-26 15:53:35',NULL,NULL,25,44),(40,'W',NULL,'2014-06-26 16:04:16',NULL,NULL,25,45),(41,'W',NULL,'2014-06-26 17:07:37',NULL,NULL,25,46),(42,'W',NULL,'2014-06-26 17:09:30',NULL,NULL,25,47),(43,'W',NULL,'2014-07-31 13:49:55',NULL,NULL,10,48),(44,'W',NULL,'2014-07-31 17:17:05',NULL,NULL,10,49);
/*!40000 ALTER TABLE `hr_permission_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_permission_users`
--

DROP TABLE IF EXISTS `hr_permission_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_permission_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `hr_permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_adv_users_app_users1` (`app_users_id`),
  KEY `fk_hr_permission_users_hr_permission1` (`hr_permission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_permission_users`
--

LOCK TABLES `hr_permission_users` WRITE;
/*!40000 ALTER TABLE `hr_permission_users` DISABLE KEYS */;
INSERT INTO `hr_permission_users` VALUES (1,10,4),(2,10,5),(3,10,6),(4,10,7),(5,10,8),(6,10,9),(7,10,10),(8,17,11),(9,17,12),(10,17,13),(11,17,14),(12,17,15),(13,17,16),(14,10,17),(15,10,18),(16,10,20),(17,10,21),(18,10,22),(19,19,23),(20,19,24),(21,10,25),(22,10,26),(23,10,27),(24,17,28),(25,10,29),(26,10,30),(27,19,32),(28,19,33),(29,19,34),(30,19,35),(31,25,36),(32,25,37),(33,19,38),(34,19,39),(35,19,40),(36,25,41),(37,25,42),(38,25,43),(39,25,44),(40,25,45),(41,25,46),(42,25,47),(43,10,48),(44,10,49);
/*!40000 ALTER TABLE `hr_permission_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_salary`
--

DROP TABLE IF EXISTS `hr_salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_salary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `month` date NOT NULL,
  `attendance` tinyint(3) unsigned NOT NULL,
  `basic` float unsigned NOT NULL,
  `hra` float unsigned NOT NULL,
  `conveyance` float unsigned DEFAULT NULL,
  `food_allowance` float unsigned DEFAULT NULL,
  `edu_allowance` float unsigned DEFAULT NULL,
  `spl_allowance` float unsigned DEFAULT NULL,
  `pf` float unsigned DEFAULT NULL,
  `esi` float unsigned DEFAULT NULL,
  `loans` float unsigned DEFAULT NULL,
  `pdf_file` varchar(100) DEFAULT NULL,
  `pdf_created` datetime DEFAULT NULL,
  `prof_tax` float unsigned DEFAULT NULL,
  `food_coupon_sal` float unsigned DEFAULT NULL,
  `fuel_reimburse` float unsigned DEFAULT NULL,
  `phone_reimburse` float unsigned DEFAULT NULL,
  `food_coupon_issued` float unsigned DEFAULT NULL,
  `income_tds` float unsigned DEFAULT NULL,
  `other_deduct` float unsigned DEFAULT NULL,
  `tot_earn` float unsigned NOT NULL,
  `tot_deduct` float unsigned NOT NULL,
  `net_amount` float unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `fk_hr_salary_app_users1` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_salary`
--

LOCK TABLES `hr_salary` WRITE;
/*!40000 ALTER TABLE `hr_salary` DISABLE KEYS */;
INSERT INTO `hr_salary` VALUES (1,'2014-03-01',0,4180,2090,800,600,200,2580,501.6,182.87,1000,'1398776516_Lakshman_payslip.pdf','2014-04-29 18:32:36',127,NULL,NULL,NULL,NULL,NULL,NULL,10450,1811.47,8638.53,'2014-04-02 20:06:04',NULL,17,12,'N'),(2,'2014-03-01',0,8488,4244,800,600,200,6888,1018.56,NULL,NULL,'1398516770_Gowrinadh_payslip.pdf','2014-04-26 18:23:27',183,NULL,NULL,NULL,NULL,NULL,315.05,21220,1516.61,19703.4,'2014-04-02 20:06:04',NULL,17,8,'N'),(3,'2014-02-01',0,4180,2090,800,600,200,2580,501.6,182.87,1000,'1396520893_Lakshman_payslip.pdf','2014-04-03 15:58:14',127,45,674,NULL,45,NULL,56,11169,1912.47,9256.53,'2014-04-03 15:30:50',NULL,17,12,'N'),(4,'2014-02-01',0,8488,4244,800,600,200,6888,1018.56,NULL,NULL,'1396498029_Gowrinadh_payslip.pdf','2014-04-03 09:37:10',183,NULL,NULL,NULL,NULL,NULL,315.05,21220,1516.61,19703.4,'2014-04-03 09:32:00',NULL,17,8,'N'),(5,'2014-04-01',28,4180,2090,800,600,200,2580,501.6,182.87,1000,'1403364071_Lakshman_payslip.pdf','2014-06-21 20:51:51',127,45,674,NULL,45,NULL,56,11169,1912.47,9256.53,'2014-04-03 18:32:07',NULL,17,12,'N'),(6,'2014-04-01',0,8488,4244,800,600,200,6888,1018.56,NULL,NULL,'1396531655_Gowrinadh_payslip.pdf','2014-04-03 18:57:36',183,NULL,NULL,NULL,NULL,NULL,315.05,21220,1516.61,19703.4,'2014-04-03 13:03:31',NULL,17,8,'N'),(14,'2014-04-01',28,8488,4244,800,600,200,6888,1018.56,NULL,NULL,'1396531702_Padmanabhan_payslip.pdf','2014-04-03 18:58:24',183,NULL,NULL,NULL,NULL,NULL,315.05,21220,1516.61,19703.4,'2014-04-03 18:32:07',NULL,17,17,'N'),(13,'2014-02-01',0,8488,4244,800,600,200,6888,1018.56,NULL,NULL,'1396521944_Padmanabhan_payslip.pdf','2014-04-03 16:15:44',183,NULL,NULL,NULL,NULL,NULL,315.05,21220,1516.61,19703.4,'2014-04-03 15:30:50',NULL,17,17,'N'),(15,'2014-03-01',31,1212,4244,800,600,200,6888,1018.56,NULL,NULL,'1403363925_Amit_payslip.pdf','2014-06-21 20:49:24',183,NULL,NULL,NULL,NULL,NULL,315.05,13944,1516.61,12427.4,'2014-04-29 19:46:50',NULL,19,1,'N'),(16,'2014-03-01',31,4180,2090,800,600,200,2580,501.6,182.87,1000,'1403363999_Ankeet_payslip.pdf','2014-06-21 20:50:38',127,NULL,NULL,NULL,NULL,NULL,NULL,10450,1811.47,8638.53,'2014-04-29 19:46:50',NULL,19,2,'N'),(17,'0000-00-00',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1404221800__payslip.pdf','2014-07-01 19:07:23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'0000-00-00 00:00:00',NULL,0,0,'N'),(18,'2014-06-01',31,4180,2090,800,600,200,2580,501.6,182.87,1000,NULL,NULL,127,NULL,NULL,NULL,NULL,NULL,NULL,10450,1811.47,8638.53,'2014-07-27 11:13:57',NULL,19,12,'N'),(19,'2014-06-01',31,14343,4244,800,600,200,6888,1018.56,NULL,NULL,'1406439895_Kamesh_payslip.pdf','2014-07-27 11:15:30',183,NULL,NULL,NULL,NULL,NULL,315.05,27075,1516.61,25558.4,'2014-07-27 11:13:57',NULL,19,9,'N');
/*!40000 ALTER TABLE `hr_salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_specialization`
--

DROP TABLE IF EXISTS `hr_specialization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_specialization` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `specialization` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'A - Active\nI - Inactive',
  `course_details_id` tinyint(3) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_specialization_course_details1` (`course_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=441 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_specialization`
--

LOCK TABLES `hr_specialization` WRITE;
/*!40000 ALTER TABLE `hr_specialization` DISABLE KEYS */;
INSERT INTO `hr_specialization` VALUES (1,'Arts & Humanities','A',30,'2013-07-20 10:32:22',NULL),(2,'Arabic','A',30,'2013-07-20 10:32:22',NULL),(3,'Communication','A',30,'2013-07-20 10:32:22',NULL),(4,'Economics','A',30,'2013-07-20 10:32:22',NULL),(5,'English','A',30,'2013-07-20 10:32:22',NULL),(6,'Film','A',30,'2013-07-20 10:32:22',NULL),(7,'Fine Arts','A',30,'2013-07-20 10:32:22',NULL),(8,'Hindi','A',30,'2013-07-20 10:32:22',NULL),(9,'History','A',30,'2013-07-20 10:32:22',NULL),(10,'Journalism','A',30,'2013-07-20 10:32:22',NULL),(11,'Maths','A',30,'2013-07-20 10:32:22',NULL),(12,'Pass Course','A',30,'2013-07-20 10:32:22',NULL),(13,'Political Science','A',30,'2013-07-20 10:32:22',NULL),(14,'PR / Advertising','A',30,'2013-07-20 10:32:22',NULL),(15,'Psychology','A',30,'2013-07-20 10:32:22',NULL),(16,'Sanskrit','A',30,'2013-07-20 10:32:22',NULL),(17,'Sociology','A',30,'2013-07-20 10:32:22',NULL),(18,'Statistics','A',30,'2013-07-20 10:32:22',NULL),(19,'Tamil','A',30,'2013-07-20 10:32:22',NULL),(20,'Vocational Course','A',30,'2013-07-20 10:32:22',NULL),(21,'Other','A',30,'2013-07-20 10:32:22',NULL),(22,'Architecture','A',31,'2013-07-20 10:32:22',NULL),(23,'Other','A',31,'2013-07-20 10:32:22',NULL),(24,'Computer Application','A',32,'2013-07-20 10:32:22',NULL),(25,'Other','A',32,'2013-07-20 10:32:22',NULL),(26,'Business Administration','A',33,'2013-07-20 10:32:22',NULL),(27,'Others','A',33,'2013-07-20 10:32:22',NULL),(28,'Bank Management','A',34,'2013-07-20 10:32:22',NULL),(29,'Others','A',34,'2013-07-20 10:32:22',NULL),(30,'Commerce','A',35,'2013-07-20 10:32:22',NULL),(31,'Corporate Sec Secretaryship','A',35,'2013-07-20 10:32:22',NULL),(32,'Bank Management','A',35,'2013-07-20 10:32:22',NULL),(33,'Information System Management','A',35,'2013-07-20 10:32:22',NULL),(34,'Others','A',35,'2013-07-20 10:32:22',NULL),(35,'Education','A',36,'2013-07-20 10:32:22',NULL),(36,'Other','A',36,'2013-07-20 10:32:22',NULL),(37,'Dentistry','A',37,'2013-07-20 10:32:22',NULL),(38,'Others','A',37,'2013-07-20 10:32:22',NULL),(39,'Hotel Management','A',38,'2013-07-20 10:32:22',NULL),(40,'Others','A',38,'2013-07-20 10:32:22',NULL),(41,'Pharmacy','A',39,'2013-07-20 10:32:22',NULL),(42,'Others','A',39,'2013-07-20 10:32:22',NULL),(43,'Advanced Zoology & Biotechnology','A',40,'2013-07-20 10:32:22',NULL),(44,'Agriculture','A',40,'2013-07-20 10:32:22',NULL),(45,'Anthropology','A',40,'2013-07-20 10:32:22',NULL),(46,'Bio-Chemistry','A',40,'2013-07-20 10:32:22',NULL),(47,'Biology','A',40,'2013-07-20 10:32:22',NULL),(48,'Botany','A',40,'2013-07-20 10:32:22',NULL),(49,'Chemistry','A',40,'2013-07-20 10:32:22',NULL),(50,'Computer Science','A',40,'2013-07-20 10:32:22',NULL),(51,'Dairy Technology','A',40,'2013-07-20 10:32:22',NULL),(52,'Electronics','A',40,'2013-07-20 10:32:22',NULL),(53,'Environmental science','A',40,'2013-07-20 10:32:22',NULL),(54,'Food Technology','A',40,'2013-07-20 10:32:22',NULL),(55,'Geology','A',40,'2013-07-20 10:32:22',NULL),(56,'Home science','A',40,'2013-07-20 10:32:22',NULL),(57,'Maths','A',40,'2013-07-20 10:32:22',NULL),(58,'Microbiology','A',40,'2013-07-20 10:32:22',NULL),(59,'Nursing','A',40,'2013-07-20 10:32:22',NULL),(60,'Physics','A',40,'2013-07-20 10:32:22',NULL),(61,'Plant Biology & Plant Biotechnology','A',40,'2013-07-20 10:32:22',NULL),(62,'Statistics','A',40,'2013-07-20 10:32:22',NULL),(63,'Visual Communication','A',40,'2013-07-20 10:32:22',NULL),(64,'Zoology','A',40,'2013-07-20 10:32:22',NULL),(65,'General','A',40,'2013-07-20 10:32:22',NULL),(66,'Other','A',40,'2013-07-20 10:32:22',NULL),(67,'Agriculture','A',41,'2013-07-20 10:32:22',NULL),(68,'Automobile','A',41,'2013-07-20 10:32:22',NULL),(69,'Aviation','A',41,'2013-07-20 10:32:22',NULL),(70,'Bio-Chemistry / Bio-Technology','A',41,'2013-07-20 10:32:22',NULL),(71,'Biomedical','A',41,'2013-07-20 10:32:22',NULL),(72,'Ceramics','A',41,'2013-07-20 10:32:22',NULL),(73,'Chemical','A',41,'2013-07-20 10:32:22',NULL),(74,'Civil','A',41,'2013-07-20 10:32:22',NULL),(75,'Computers','A',41,'2013-07-20 10:32:22',NULL),(76,'Electrical','A',41,'2013-07-20 10:32:22',NULL),(77,'Electronics / Telecomunication','A',41,'2013-07-20 10:32:22',NULL),(78,'Energy','A',41,'2013-07-20 10:32:22',NULL),(79,'Environmental','A',41,'2013-07-20 10:32:22',NULL),(80,'Instrumentation','A',41,'2013-07-20 10:32:22',NULL),(81,'Marine','A',41,'2013-07-20 10:32:22',NULL),(82,'Mechanical','A',41,'2013-07-20 10:32:22',NULL),(83,'Metallurgy','A',41,'2013-07-20 10:32:22',NULL),(84,'Mineral','A',41,'2013-07-20 10:32:22',NULL),(85,'Mining','A',41,'2013-07-20 10:32:22',NULL),(86,'Nuclear','A',41,'2013-07-20 10:32:22',NULL),(87,'Paint / Oil','A',41,'2013-07-20 10:32:22',NULL),(88,'Petroleum','A',41,'2013-07-20 10:32:22',NULL),(89,'Plastics','A',41,'2013-07-20 10:32:22',NULL),(90,'Production / Industrial','A',41,'2013-07-20 10:32:22',NULL),(91,'Textile','A',41,'2013-07-20 10:32:22',NULL),(92,'Other','A',41,'2013-07-20 10:32:22',NULL),(93,'Law','A',42,'2013-07-20 10:32:22',NULL),(94,'Others','A',42,'2013-07-20 10:32:22',NULL),(95,'Medicine','A',43,'2013-07-20 10:32:22',NULL),(96,'Others','A',43,'2013-07-20 10:32:22',NULL),(97,'Veterinary Science','A',44,'2013-07-20 10:32:22',NULL),(98,'Others','A',44,'2013-07-20 10:32:22',NULL),(99,'Architecture','A',45,'2013-07-20 10:32:22',NULL),(100,'Chemical','A',45,'2013-07-20 10:32:22',NULL),(101,'Civil','A',45,'2013-07-20 10:32:22',NULL),(102,'Computers','A',45,'2013-07-20 10:32:22',NULL),(103,'Electrical','A',45,'2013-07-20 10:32:22',NULL),(104,'Electronics / Telecomunication','A',45,'2013-07-20 10:32:22',NULL),(105,'Engineering','A',45,'2013-07-20 10:32:22',NULL),(106,'Export / Import','A',45,'2013-07-20 10:32:22',NULL),(107,'Fashion Designing / Other Designing','A',45,'2013-07-20 10:32:22',NULL),(108,'Graphic / Web Designing','A',45,'2013-07-20 10:32:22',NULL),(109,'Hotel Management','A',45,'2013-07-20 10:32:22',NULL),(110,'Insurance','A',45,'2013-07-20 10:32:22',NULL),(111,'Management','A',45,'2013-07-20 10:32:22',NULL),(112,'Mechanical','A',45,'2013-07-20 10:32:22',NULL),(113,'Tourism','A',45,'2013-07-20 10:32:22',NULL),(114,'Visual Arts','A',45,'2013-07-20 10:32:22',NULL),(115,'Vocational Course','A',45,'2013-07-20 10:32:22',NULL),(116,'Other','A',45,'2013-07-20 10:32:22',NULL),(117,'Journalism / Mass Communication','A',51,'2013-07-20 10:32:22',NULL),(118,'Management','A',51,'2013-07-20 10:32:22',NULL),(119,'PR / Advertising','A',51,'2013-07-20 10:32:22',NULL),(120,'Tourism','A',51,'2013-07-20 10:32:22',NULL),(121,'Others','A',51,'2013-07-20 10:32:22',NULL),(122,'Law','A',52,'2013-07-20 10:32:22',NULL),(123,'Others','A',52,'2013-07-20 10:32:22',NULL),(124,'Anthropology','A',53,'2013-07-20 10:32:22',NULL),(125,'Arabic','A',53,'2013-07-20 10:32:22',NULL),(126,'Arts & Humanities','A',53,'2013-07-20 10:32:22',NULL),(127,'Business Economics','A',53,'2013-07-20 10:32:22',NULL),(128,'Communication','A',53,'2013-07-20 10:32:22',NULL),(129,'Economics','A',53,'2013-07-20 10:32:22',NULL),(130,'English','A',53,'2013-07-20 10:32:22',NULL),(131,'Film','A',53,'2013-07-20 10:32:22',NULL),(132,'H.R.M','A',53,'2013-07-20 10:32:22',NULL),(133,'Fine arts','A',53,'2013-07-20 10:32:22',NULL),(134,'Hindi','A',53,'2013-07-20 10:32:22',NULL),(135,'History','A',53,'2013-07-20 10:32:22',NULL),(136,'Journalism','A',53,'2013-07-20 10:32:22',NULL),(137,'Maths','A',53,'2013-07-20 10:32:22',NULL),(138,'Media Arts','A',53,'2013-07-20 10:32:22',NULL),(139,'Political Science','A',53,'2013-07-20 10:32:22',NULL),(140,'PR / Advertising','A',53,'2013-07-20 10:32:22',NULL),(141,'Philosophy','A',53,'2013-07-20 10:32:22',NULL),(142,'Psychology','A',53,'2013-07-20 10:32:22',NULL),(143,'Sanskrit','A',53,'2013-07-20 10:32:22',NULL),(144,'Sociology','A',53,'2013-07-20 10:32:22',NULL),(145,'Social Works','A',53,'2013-07-20 10:32:22',NULL),(146,'Statistics','A',53,'2013-07-20 10:32:22',NULL),(147,'Tamil','A',53,'2013-07-20 10:32:22',NULL),(148,'Others','A',53,'2013-07-20 10:32:22',NULL),(149,'Architecture','A',54,'2013-07-20 10:32:22',NULL),(150,'Other','A',54,'2013-07-20 10:32:22',NULL),(151,'Commerce','A',55,'2013-07-20 10:32:22',NULL),(152,'Other','A',55,'2013-07-20 10:32:22',NULL),(153,'Education','A',56,'2013-07-20 10:32:22',NULL),(154,'Other','A',56,'2013-07-20 10:32:22',NULL),(155,'Pharmacy','A',57,'2013-07-20 10:32:22',NULL),(156,'Other','A',57,'2013-07-20 10:32:22',NULL),(157,'Arabic','A',58,'2013-07-20 10:32:22',NULL),(158,'Chemistry','A',58,'2013-07-20 10:32:22',NULL),(159,'Commerce','A',58,'2013-07-20 10:32:22',NULL),(160,'Economics','A',58,'2013-07-20 10:32:22',NULL),(161,'English','A',58,'2013-07-20 10:32:22',NULL),(162,'History','A',58,'2013-07-20 10:32:22',NULL),(163,'Maths','A',58,'2013-07-20 10:32:22',NULL),(164,'Plant Biology & Biotechnology','A',58,'2013-07-20 10:32:22',NULL),(165,'Social work','A',58,'2013-07-20 10:32:22',NULL),(166,'Statistics','A',58,'2013-07-20 10:32:22',NULL),(167,'Tamil','A',58,'2013-07-20 10:32:22',NULL),(168,'Zoology','A',58,'2013-07-20 10:32:22',NULL),(169,'Other','A',58,'2013-07-20 10:32:22',NULL),(170,'Advanced Zoology & Biotechnology','A',59,'2013-07-20 10:32:22',NULL),(171,'Agriculture','A',59,'2013-07-20 10:32:22',NULL),(172,'Anthropology','A',59,'2013-07-20 10:32:22',NULL),(173,'Bio-Chemistry','A',59,'2013-07-20 10:32:22',NULL),(174,'Biology','A',59,'2013-07-20 10:32:22',NULL),(175,'Biotechnology','A',59,'2013-07-20 10:32:22',NULL),(176,'Botany','A',59,'2013-07-20 10:32:22',NULL),(177,'Chemistry','A',59,'2013-07-20 10:32:22',NULL),(178,'Computer Science','A',59,'2013-07-20 10:32:22',NULL),(179,'Dairy Technology','A',59,'2013-07-20 10:32:22',NULL),(180,'Electronics','A',59,'2013-07-20 10:32:22',NULL),(181,'Environmental science','A',59,'2013-07-20 10:32:22',NULL),(182,'Food Technology','A',59,'2013-07-20 10:32:22',NULL),(183,'Geology','A',59,'2013-07-20 10:32:22',NULL),(184,'Home science','A',59,'2013-07-20 10:32:22',NULL),(185,'Information technology','A',59,'2013-07-20 10:32:22',NULL),(186,'Maths','A',59,'2013-07-20 10:32:22',NULL),(187,'Medical Lab Technology','A',59,'2013-07-20 10:32:22',NULL),(188,'Microbiology','A',59,'2013-07-20 10:32:22',NULL),(189,'Nursing','A',59,'2013-07-20 10:32:22',NULL),(190,'Physics','A',59,'2013-07-20 10:32:22',NULL),(191,'Plant Biology & Plant Biotechnology','A',59,'2013-07-20 10:32:22',NULL),(192,'Statistics','A',59,'2013-07-20 10:32:22',NULL),(193,'Visual Communication','A',59,'2013-07-20 10:32:22',NULL),(194,'Zoology','A',59,'2013-07-20 10:32:22',NULL),(195,'General','A',59,'2013-07-20 10:32:22',NULL),(196,'Other','A',59,'2013-07-20 10:32:22',NULL),(197,'Agriculture','A',60,'2013-07-20 10:32:22',NULL),(198,'Automobile','A',60,'2013-07-20 10:32:22',NULL),(199,'Aviation','A',60,'2013-07-20 10:32:22',NULL),(200,'Bio-Chemistry / Bio-Technology','A',60,'2013-07-20 10:32:22',NULL),(201,'Biomedical','A',60,'2013-07-20 10:32:22',NULL),(202,'Ceramics','A',60,'2013-07-20 10:32:22',NULL),(203,'Chemical','A',60,'2013-07-20 10:32:22',NULL),(204,'Civil','A',60,'2013-07-20 10:32:22',NULL),(205,'Computers','A',60,'2013-07-20 10:32:22',NULL),(206,'Electrical','A',60,'2013-07-20 10:32:22',NULL),(207,'Electronics / Telecomunication','A',60,'2013-07-20 10:32:22',NULL),(208,'Energy','A',60,'2013-07-20 10:32:22',NULL),(209,'Environmental','A',60,'2013-07-20 10:32:22',NULL),(210,'Instrumentation','A',60,'2013-07-20 10:32:22',NULL),(211,'Marine','A',60,'2013-07-20 10:32:22',NULL),(212,'Mechanical','A',60,'2013-07-20 10:32:22',NULL),(213,'Metallurgy','A',60,'2013-07-20 10:32:22',NULL),(214,'Mineral','A',60,'2013-07-20 10:32:22',NULL),(215,'Mining','A',60,'2013-07-20 10:32:22',NULL),(216,'Nuclear','A',60,'2013-07-20 10:32:22',NULL),(217,'Paint / Oil','A',60,'2013-07-20 10:32:22',NULL),(218,'Petroleum','A',60,'2013-07-20 10:32:22',NULL),(219,'Plastics','A',60,'2013-07-20 10:32:22',NULL),(220,'Production / Industrial','A',60,'2013-07-20 10:32:22',NULL),(221,'Textile','A',60,'2013-07-20 10:32:22',NULL),(222,'Other','A',60,'2013-07-20 10:32:22',NULL),(223,'Advertising / Mass Communication','A',61,'2013-07-20 10:32:22',NULL),(224,'Finance','A',61,'2013-07-20 10:32:22',NULL),(225,'HR / Industrial Relations','A',61,'2013-07-20 10:32:22',NULL),(226,'Information Technology','A',61,'2013-07-20 10:32:22',NULL),(227,'International Business','A',61,'2013-07-20 10:32:22',NULL),(228,'Marketing','A',61,'2013-07-20 10:32:22',NULL),(229,'Systems','A',61,'2013-07-20 10:32:22',NULL),(230,'Other Management','A',61,'2013-07-20 10:32:22',NULL),(231,'Computer Application','A',62,'2013-07-20 10:32:22',NULL),(232,'Other','A',62,'2013-07-20 10:32:22',NULL),(233,'Cardiology','A',63,'2013-07-20 10:32:22',NULL),(234,'Dermatology','A',63,'2013-07-20 10:32:22',NULL),(235,'ENT','A',63,'2013-07-20 10:32:22',NULL),(236,'General Practitioner','A',63,'2013-07-20 10:32:22',NULL),(237,'Gynecology','A',63,'2013-07-20 10:32:22',NULL),(238,'Hepatology','A',63,'2013-07-20 10:32:22',NULL),(239,'Immunology','A',63,'2013-07-20 10:32:22',NULL),(240,'Microbiology','A',63,'2013-07-20 10:32:22',NULL),(241,'Neonatal','A',63,'2013-07-20 10:32:22','2013-08-06 11:33:01'),(242,'Nephrology','A',63,'2013-07-20 10:32:22',NULL),(243,'Eurology','A',63,'2013-07-20 10:32:22',NULL),(244,'Obstetrics','A',63,'2013-07-20 10:32:22',NULL),(245,'Oncology','A',63,'2013-07-20 10:32:22',NULL),(246,'Ophthalmology','A',63,'2013-07-20 10:32:22',NULL),(247,'Orthopedic','A',63,'2013-07-20 10:32:22',NULL),(248,'Pathology','A',63,'2013-07-20 10:32:22',NULL),(249,'Pediatrics','A',63,'2013-07-20 10:32:22',NULL),(250,'Psychiatry','A',63,'2013-07-20 10:32:22',NULL),(251,'Psychology','A',63,'2013-07-20 10:32:22',NULL),(252,'Radiology','A',63,'2013-07-20 10:32:22',NULL),(253,'Rheumatology','A',63,'2013-07-20 10:32:22',NULL),(254,'Others','A',63,'2013-07-20 10:32:22',NULL),(255,'Veterinary Science','A',64,'2013-07-20 10:32:22',NULL),(256,'Others','A',64,'2013-07-20 10:32:22',NULL),(257,'Chemical','A',65,'2013-07-20 10:32:22',NULL),(258,'Civil','A',65,'2013-07-20 10:32:22',NULL),(259,'Computers','A',65,'2013-07-20 10:32:22',NULL),(260,'Electrical','A',65,'2013-07-20 10:32:22',NULL),(261,'Electronics','A',65,'2013-07-20 10:32:22',NULL),(262,'Mechanical','A',65,'2013-07-20 10:32:22',NULL),(263,'Others','A',65,'2013-07-20 10:32:22',NULL),(264,'Arabic','A',69,'2013-07-20 10:32:22',NULL),(265,'Biotechnology','A',69,'2013-07-20 10:32:22',NULL),(266,'Chemistry','A',69,'2013-07-20 10:32:22',NULL),(267,'Commerce','A',69,'2013-07-20 10:32:22',NULL),(268,'Computer Science','A',69,'2013-07-20 10:32:22',NULL),(269,'Economics','A',69,'2013-07-20 10:32:22',NULL),(270,'English','A',69,'2013-07-20 10:32:22',NULL),(271,'Entomology','A',69,'2013-07-20 10:32:22',NULL),(272,'History','A',69,'2013-07-20 10:32:22',NULL),(273,'Statistics','A',69,'2013-07-20 10:32:22',NULL),(274,'Social Work','A',69,'2013-07-20 10:32:22',NULL),(275,'Tamil','A',69,'2013-07-20 10:32:22',NULL),(276,'Zoology','A',69,'2013-07-20 10:32:22',NULL),(277,'Other','A',69,'2013-07-20 10:32:22',NULL),(298,'Chartered Accountancy','A',35,'2013-07-20 10:32:22',NULL),(297,'Apparel Production','A',222,'2013-07-20 10:32:22',NULL),(296,'Fashion Communication','A',168,'2013-07-20 10:32:22',NULL),(295,'Knitwear Design','A',168,'2013-07-20 10:32:22',NULL),(294,'Textile Design','A',168,'2013-07-20 10:32:22',NULL),(293,'Accessory Design','A',168,'2013-07-20 10:32:22',NULL),(292,'Leather Design','A',168,'2013-07-20 10:32:22',NULL),(291,'Fashion Design','A',168,'2013-07-20 10:32:22',NULL),(290,'Transportation','A',41,'2013-07-20 10:32:22',NULL),(289,'Sugar Technology','A',41,'2013-07-20 10:32:22',NULL),(288,'Pulp & Paper Technology ','A',41,'2013-07-20 10:32:22',NULL),(287,'Printing Technology','A',41,'2013-07-20 10:32:22',NULL),(286,'Polymer Science and Rubber Technology','A',41,'2013-07-20 10:32:22',NULL),(285,'Materials Science & Technology','A',41,'2013-07-20 10:32:22',NULL),(284,'Leather Technology ','A',41,'2013-07-20 10:32:22',NULL),(283,'Information Technology ','A',41,'2013-07-20 10:32:22',NULL),(282,'Industrial Engineering and Management ','A',41,'2013-07-20 10:32:22',NULL),(281,'Food Technology','A',41,'2013-07-20 10:32:22',NULL),(280,'Automation and Robotics ','A',41,'2013-07-20 10:32:22',NULL),(279,'Applied Electronics & instrumentation ','A',41,'2013-07-20 10:32:22',NULL),(278,'Aeronautic','A',41,'2013-07-20 10:32:22',NULL),(299,'Institute of Cost and Work Accountancy','A',35,'2013-07-20 10:32:22',NULL),(401,'Design Space','A',223,'2013-07-20 10:32:22',NULL),(400,'Apparel Production','A',223,'2013-07-20 10:32:22',NULL),(399,'Management','A',223,'2013-07-20 10:32:22',NULL),(427,'Fashion & Apparel Design ','A',234,'2013-07-20 10:32:22',NULL),(426,'Fine & Applied Arts','A',234,'2013-07-20 10:32:22',NULL),(414,'Transportation','A',60,'2013-07-20 10:32:22',NULL),(413,'Sugar Technology','A',60,'2013-07-20 10:32:22',NULL),(412,'Pulp & Paper Technology ','A',60,'2013-07-20 10:32:22',NULL),(411,'Printing Technology','A',60,'2013-07-20 10:32:22',NULL),(410,'Polymer Science and Rubber Technology','A',60,'2013-07-20 10:32:22',NULL),(409,'Materials Science & Technology','A',60,'2013-07-20 10:32:22',NULL),(408,'Leather Technology ','A',60,'2013-07-20 10:32:22',NULL),(407,'Information Technology ','A',60,'2013-07-20 10:32:22',NULL),(406,'Industrial Engineering and Management ','A',60,'2013-07-20 10:32:22',NULL),(405,'Food Technology','A',60,'2013-07-20 10:32:22',NULL),(404,'Automation and Robotics ','A',60,'2013-07-20 10:32:22',NULL),(403,'Applied Electronics & instrumentation ','A',60,'2013-07-20 10:32:22',NULL),(425,'Applied Arts','A',234,'2013-07-20 10:32:22',NULL),(424,'Fine Arts','A',234,'2013-07-20 10:32:22',NULL),(423,'Applied Arts & Product Design','A',234,'2013-07-20 10:32:22',NULL),(402,'Aeronautic','A',60,'2013-07-20 10:32:22',NULL),(430,'Zoolog\'y','A',250,'2013-07-20 10:32:22',NULL),(434,'Science','A',40,'2013-07-20 10:32:22',NULL),(435,'Social Science','A',30,'2013-09-24 00:00:00',NULL),(436,'Physics','A',30,'2013-09-24 00:00:00',NULL),(437,'Chemistry','A',30,'2013-09-24 00:00:00',NULL),(438,'Chemistry','A',177,'2013-09-25 00:00:00',NULL),(439,'Physics','A',177,'2013-09-25 00:00:00',NULL),(440,'Computer','A',177,'2013-09-25 00:00:00',NULL);
/*!40000 ALTER TABLE `hr_specialization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) NOT NULL,
  `value` varchar(300) NOT NULL,
  `answer` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_options`
--

LOCK TABLES `poll_options` WRITE;
/*!40000 ALTER TABLE `poll_options` DISABLE KEYS */;
INSERT INTO `poll_options` VALUES (48,2,'Sachin',NULL),(49,2,'Ganguly',NULL),(50,2,'Kumble',1),(51,2,'Agarkar',NULL),(52,1,'DMK',NULL),(53,1,'ADMK',NULL),(54,1,'BJP',NULL),(55,1,'Aam Admi',1),(56,1,'None',NULL),(69,8,'Yes',NULL),(70,8,'No',NULL),(71,8,'Sometime',NULL),(72,8,'I hate this',NULL);
/*!40000 ALTER TABLE `poll_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_questions`
--

DROP TABLE IF EXISTS `poll_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques` text NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_questions`
--

LOCK TABLES `poll_questions` WRITE;
/*!40000 ALTER TABLE `poll_questions` DISABLE KEYS */;
INSERT INTO `poll_questions` VALUES (1,'Which party would you like to vote for this Lok Sabha Election 2014?','2014-04-15 07:42:18','2014-04-18 12:15:08',1,'N'),(2,'favourite cricketer?','2014-04-16 07:42:18','2014-04-18 12:15:02',1,'N'),(3,'Who invented mobile ? ','0000-00-00 00:00:00','2014-04-18 11:15:01',1,'Y'),(4,'Who invented mobile ? ','0000-00-00 00:00:00','2014-04-18 11:14:59',1,'Y'),(5,'Who invented mobile ? ','0000-00-00 00:00:00','2014-04-18 11:14:56',1,'Y'),(6,'Who invented mobile ? ','0000-00-00 00:00:00','2014-04-18 11:14:53',1,'Y'),(7,'pongal is hindu festival?','2014-04-18 10:47:23','2014-04-18 12:14:57',0,'Y'),(8,'Do you really watch IPL Cricket?','2014-04-21 12:08:54','2014-04-21 12:12:35',1,'N');
/*!40000 ALTER TABLE `poll_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_votes`
--

DROP TABLE IF EXISTS `poll_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `voted_on` datetime NOT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_votes`
--

LOCK TABLES `poll_votes` WRITE;
/*!40000 ALTER TABLE `poll_votes` DISABLE KEYS */;
INSERT INTO `poll_votes` VALUES (1,52,'2014-04-18 13:32:19','127.0.0.1',11),(2,54,'2014-04-18 19:44:07','127.0.0.1',10),(3,49,'2014-04-18 19:44:15','127.0.0.1',10),(4,51,'2014-05-01 16:45:17','127.0.0.1',11),(5,55,'2014-05-20 19:04:34','127.0.0.1',19),(6,51,'2014-06-24 10:30:17','127.0.0.1',19),(7,56,'2014-07-15 20:14:25','127.0.0.1',5),(8,56,'2014-07-23 10:17:39','127.0.0.1',15),(9,71,'2014-07-24 11:44:50','127.0.0.1',10),(10,51,'2014-07-29 10:12:31','127.0.0.1',15);
/*!40000 ALTER TABLE `poll_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_assign`
--

DROP TABLE IF EXISTS `tsk_assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_assign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `type` enum('D','P') NOT NULL COMMENT 'D - Daily Task, P - Project Task',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `attachment` varchar(200) DEFAULT NULL,
  `read_status` enum('U','R') NOT NULL DEFAULT 'R' COMMENT 'R- Read',
  `read_type` enum('N','R','M') DEFAULT NULL,
  `status` enum('W','P','L','C','E') NOT NULL DEFAULT 'W' COMMENT 'E - Executed, P - Postponed, L - Partial done, W - Pending, C - Cancelled',
  `remark` varchar(200) DEFAULT NULL,
  `copy_id` int(11) DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `tsk_projects_id` int(10) unsigned DEFAULT NULL,
  `tsk_company_id` int(11) DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL COMMENT 'created by',
  `tsk_plan_types_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_assign_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_assign_tsk_projects1_idx` (`tsk_projects_id`),
  KEY `fk_tsk_pln_type` (`tsk_plan_types_id`),
  KEY `fk_tsk_company` (`tsk_company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_assign`
--

LOCK TABLES `tsk_assign` WRITE;
/*!40000 ALTER TABLE `tsk_assign` DISABLE KEYS */;
INSERT INTO `tsk_assign` VALUES (1,'test','test desc','D','2014-07-31 09:00:00','2014-07-31 10:00:00',NULL,'R',NULL,'C','teste',NULL,'N','2014-07-31 20:39:23','2014-08-02 10:56:39',NULL,NULL,10,15),(2,'test2','test 2','D','2014-07-31 11:00:00','2014-07-31 11:00:00',NULL,'R',NULL,'C','test',NULL,'N','2014-07-31 20:39:51','2014-08-02 10:55:46',NULL,NULL,10,13),(3,'test project','project desv','P','2014-07-31 00:00:00','2014-07-31 00:00:00',NULL,'R',NULL,'W',NULL,NULL,'N','2014-07-31 20:40:39',NULL,3,2,10,5),(4,'test','test desc','D','2014-08-13 10:30:00','2014-08-13 09:30:00',NULL,'R','M','E','',NULL,'N','2014-07-31 21:13:54','2014-08-02 20:01:01',NULL,NULL,10,19),(5,'test444555','test desc','D','2014-08-15 10:00:00','2014-08-15 13:00:00',NULL,'R','R','P','test',NULL,'N','2014-07-31 21:14:08','2014-08-01 20:33:35',NULL,NULL,10,19),(6,'test2','test desc','D','2014-08-14 10:00:00','2014-08-14 10:00:00',NULL,'R',NULL,'W',NULL,NULL,'N','0000-00-00 00:00:00','2014-08-01 17:39:56',NULL,NULL,0,19),(7,'test4444','test desc','D','2014-08-14 10:00:00','2014-08-14 10:00:00',NULL,'R',NULL,'W',NULL,NULL,'N','0000-00-00 00:00:00','2014-08-01 17:40:06',NULL,NULL,0,19),(8,'test444555','test desc','D','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'R',NULL,'W','',NULL,'N','2014-08-01 20:08:45',NULL,NULL,NULL,10,19),(9,'test','test desc','D','2014-08-26 09:30:00','2014-08-26 10:00:00',NULL,'R',NULL,'W','test',NULL,'N','2014-08-01 20:14:23','2014-08-01 20:16:56',NULL,NULL,10,19),(10,'test','test desc','D','2014-08-27 09:30:00','2014-08-27 10:00:00',NULL,'R',NULL,'C','test',9,'N','2014-08-01 20:16:56','2014-08-01 20:18:13',NULL,NULL,10,19),(11,'test444555','test desc','D','2014-08-16 10:00:00','2014-08-16 19:00:00',NULL,'R',NULL,'W','',5,'N','2014-08-01 20:19:41',NULL,NULL,NULL,10,19),(12,'test444555','test desc','D','2014-08-18 10:00:00','2014-08-18 18:30:00',NULL,'R',NULL,'W','',5,'N','2014-08-01 20:23:33',NULL,NULL,NULL,10,19),(13,'test444555','test desc','D','2014-08-25 10:30:00','2014-08-25 10:30:00',NULL,'R',NULL,'W','',5,'N','2014-08-01 20:26:34',NULL,NULL,NULL,10,19),(14,'test444555','test desc','D','2014-08-24 10:30:00','2014-08-24 22:30:00',NULL,'R',NULL,'W','',5,'N','2014-08-01 20:33:35',NULL,NULL,NULL,10,19),(15,'mass rec.','pls plan for the chennai recruit.','D','2014-08-02 10:00:00','2014-08-02 14:00:00',NULL,'R','M','L','',NULL,'N','2014-08-02 11:03:32','2014-08-02 12:39:46',NULL,NULL,10,1),(16,'amway drive','100 members recruit','P','2014-08-03 00:00:00','2014-08-04 00:00:00',NULL,'R',NULL,'W',NULL,NULL,'N','2014-08-02 11:05:21',NULL,3,2,10,11),(18,'mass rec.','pls plan for the chennai recruit.','D','2014-08-11 09:30:00','2014-08-11 14:30:00',NULL,'R',NULL,'W','',15,'N','2014-08-02 11:56:03',NULL,NULL,NULL,10,1),(19,'mass rec.','pls plan for the chennai recruit.','D','2014-08-04 09:30:00','2014-08-04 10:00:00',NULL,'R',NULL,'W','',15,'N','2014-08-02 12:00:01',NULL,NULL,NULL,10,1),(20,'mass rec.','pls plan for the chennai recruit.','D','2014-08-12 09:30:00','2014-08-12 13:30:00',NULL,'R',NULL,'W','',15,'N','2014-08-02 12:02:25',NULL,NULL,NULL,10,1),(21,'mass rec.','pls plan for the chennai recruit.','D','2014-08-04 10:00:00','2014-08-04 11:00:00',NULL,'R','N','W','',15,'N','2014-08-02 12:38:01',NULL,NULL,NULL,10,1),(22,'mass rec.','pls plan for the chennai recruit.','D','2014-08-20 09:30:00','2014-08-20 13:30:00',NULL,'R','M','E','',15,'N','2014-08-02 12:39:46','2014-08-02 13:24:17',NULL,NULL,10,1),(23,'mumbai rec.','rec. 100 dev. for mubmai squad','P','2014-08-11 00:00:00','2014-08-11 00:00:00',NULL,'R','M','L','',NULL,'N','2014-08-02 12:53:00','2014-08-02 13:03:08',3,2,10,9),(24,'mumbai rec.','rec. 100 dev. for mubmai squad','P','2014-08-12 00:00:00','2014-08-12 00:00:00',NULL,'R','N','W','',23,'N','2014-08-02 13:03:08',NULL,3,2,10,9),(25,'test','test ','D','2014-08-15 10:00:00','2014-08-15 11:30:00',NULL,'R','M','E','',NULL,'N','2014-08-02 13:07:26','2014-08-02 13:07:48',NULL,NULL,10,9),(26,'test2','test','D','2014-08-28 10:00:00','2014-08-28 11:00:00',NULL,'R','M','E','',NULL,'N','2014-08-02 13:11:00','2014-08-02 13:21:28',NULL,NULL,10,8),(27,'this is my first assign task','assign tsk desc come here.','P','2014-08-20 00:00:00','2014-08-20 00:00:00',NULL,'R',NULL,'W',NULL,NULL,'N','2014-08-02 20:48:37',NULL,3,2,10,6),(28,'test for remarks','remarks testing','D','2014-08-04 10:00:00','2014-08-04 20:30:00',NULL,'U','M','E','',NULL,'N','2014-08-03 20:06:47','2014-08-03 20:07:18',NULL,NULL,10,15);
/*!40000 ALTER TABLE `tsk_assign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_assign_read`
--

DROP TABLE IF EXISTS `tsk_assign_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_assign_read` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('R','U') NOT NULL DEFAULT 'U' COMMENT 'R - Read',
  `action_type` enum('N','M','R') NOT NULL DEFAULT 'N' COMMENT 'N - new, M - modify, R - reply',
  `created_date` datetime NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `tsk_assign_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_assign_read_tsk_assign1_idx` (`tsk_assign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_assign_read`
--

LOCK TABLES `tsk_assign_read` WRITE;
/*!40000 ALTER TABLE `tsk_assign_read` DISABLE KEYS */;
INSERT INTO `tsk_assign_read` VALUES (1,'U','M','2014-07-31 20:39:23',15,'2014-08-02 10:56:39',1),(2,'U','M','2014-07-31 20:39:23',19,'2014-08-02 10:56:39',1),(3,'U','M','2014-07-31 20:39:51',15,'2014-08-02 10:55:46',2),(4,'U','M','2014-07-31 20:39:51',19,'2014-08-02 10:55:46',2),(5,'U','N','2014-07-31 20:40:39',15,NULL,3),(6,'U','N','2014-07-31 20:40:39',19,NULL,3),(20,'R','M','2014-08-02 19:47:13',15,'2014-08-02 19:57:59',4),(9,'R','M','2014-08-01 18:07:55',19,'2014-08-01 20:33:46',5),(10,'U','M','2014-08-01 20:26:34',19,'2014-08-01 20:26:34',13),(11,'R','M','2014-08-01 20:33:35',19,'2014-08-01 20:33:52',14),(12,'R','M','2014-08-02 11:03:32',15,'2014-08-02 11:25:38',15),(13,'R','R','2014-08-02 11:05:22',15,'2014-08-02 12:55:51',16),(14,'R','N','2014-08-02 12:39:46',15,'2014-08-02 12:40:00',22),(15,'R','N','2014-08-02 12:53:00',15,'2014-08-02 13:02:40',23),(16,'U','M','2014-08-02 12:53:00',19,'2014-08-02 13:03:08',23),(17,'U','N','2014-08-02 13:03:08',19,NULL,24),(18,'R','N','2014-08-02 13:07:26',15,'2014-08-02 13:07:33',25),(19,'R','N','2014-08-02 13:11:00',15,'2014-08-02 13:11:15',26),(21,'U','N','2014-08-02 20:48:37',15,NULL,27),(22,'R','N','2014-08-03 20:06:47',15,'2014-08-03 20:07:09',28);
/*!40000 ALTER TABLE `tsk_assign_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_assign_reply`
--

DROP TABLE IF EXISTS `tsk_assign_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_assign_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` varchar(200) NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `tsk_assign_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_plan_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_assign_reply_tsk_assign1_idx` (`tsk_assign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_assign_reply`
--

LOCK TABLES `tsk_assign_reply` WRITE;
/*!40000 ALTER TABLE `tsk_assign_reply` DISABLE KEYS */;
INSERT INTO `tsk_assign_reply` VALUES (1,'hi sir','N','2014-08-01 16:19:03',NULL,15,4),(2,'i am ok with the changes...','N','2014-08-01 16:19:12',NULL,15,4),(3,'pls complete the task','N','2014-08-01 16:45:00',NULL,10,5),(4,'ok sir','N','2014-08-01 16:49:24',NULL,10,5),(5,'sorry','N','2014-08-01 16:49:41',NULL,10,5),(6,'ff','N','2014-08-01 16:52:09',NULL,10,5),(7,'dd','N','2014-08-01 16:52:40',NULL,10,5),(8,'thanks','N','2014-08-01 16:56:06',NULL,10,5),(9,'ok','N','2014-08-01 16:56:30',NULL,15,5),(10,'thanks','N','2014-08-01 16:56:42',NULL,15,5),(11,'ok sir','N','2014-08-02 10:59:06',NULL,15,4),(12,'ok','N','2014-08-02 11:08:00',NULL,10,16),(13,'tt','N','2014-08-02 11:10:38',NULL,10,4);
/*!40000 ALTER TABLE `tsk_assign_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_assign_users`
--

DROP TABLE IF EXISTS `tsk_assign_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_assign_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `tsk_assign_id` int(10) unsigned NOT NULL,
  `is_cc` set('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_tsk_plan_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_assign_users_tsk_assign1_idx` (`tsk_assign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_assign_users`
--

LOCK TABLES `tsk_assign_users` WRITE;
/*!40000 ALTER TABLE `tsk_assign_users` DISABLE KEYS */;
INSERT INTO `tsk_assign_users` VALUES (1,15,1,'0'),(2,19,1,'1'),(3,15,2,'0'),(4,19,2,'1'),(5,15,3,'0'),(6,19,3,'1'),(21,15,4,'0'),(10,19,5,'0'),(11,19,14,'0'),(12,15,15,'0'),(13,15,16,'0'),(14,15,22,'0'),(15,15,23,'0'),(16,19,23,'1'),(17,15,24,'0'),(18,19,24,'1'),(19,15,25,'0'),(20,15,26,'0'),(22,15,27,'0'),(23,15,28,'0');
/*!40000 ALTER TABLE `tsk_assign_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_company`
--

DROP TABLE IF EXISTS `tsk_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `zip` int(10) unsigned NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `type` enum('C','V','S','CO','G','I') NOT NULL COMMENT 'C - Client\nV - Vendor\nS - Supplier\nCO - Consultant\nG - Government\nI - Internal',
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `app_state_id` tinyint(3) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_company_app_state1` (`app_state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_company`
--

LOCK TABLES `tsk_company` WRITE;
/*!40000 ALTER TABLE `tsk_company` DISABLE KEYS */;
INSERT INTO `tsk_company` VALUES (1,'BigSpire Software Pvt. Ltd.','contact@bigspire.com','04612346209','113/4/1, Polepettai Main Road','Tuticorin',628002,'http://bigspire.com','V','software development company','A','N',24,'2014-02-22 12:50:07','2014-03-02 12:27:04',35,17),(2,'Amway Products','est@gmail.com','34343','test','test',23232323,'','C','test','A','N',1,'2014-05-03 19:59:31','2014-07-05 15:33:15',17,17),(3,'Daimler India','daimler@gmail.com','9767676767','chennai','test',5454545,'','C','chennai client','A','N',9,'2014-07-05 15:34:35','2014-07-05 16:08:50',17,17);
/*!40000 ALTER TABLE `tsk_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_company_contact`
--

DROP TABLE IF EXISTS `tsk_company_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_company_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name1` varchar(45) NOT NULL,
  `last_name1` varchar(45) NOT NULL,
  `designation1` varchar(45) NOT NULL,
  `landline1` varchar(15) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `email1` varchar(45) NOT NULL,
  `first_name2` varchar(45) DEFAULT NULL,
  `last_name2` varchar(45) DEFAULT NULL,
  `designation2` varchar(45) DEFAULT NULL,
  `landline2` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `email2` varchar(45) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `tsk_projects_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'N - Not Deleted\nY - Deleted',
  PRIMARY KEY (`id`),
  KEY `fk_tsk_company_contact_tsk_projects1` (`tsk_projects_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_company_contact`
--

LOCK TABLES `tsk_company_contact` WRITE;
/*!40000 ALTER TABLE `tsk_company_contact` DISABLE KEYS */;
INSERT INTO `tsk_company_contact` VALUES (1,'Ravichandran','J','Project Manager','04612346209','9003033020','ravi@bigspire.com',NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 13:02:21','2014-03-02 12:43:30',1,35,17,'N'),(2,'sdf','sadf','asdf','asdf','sad','asdf@sadf.com',NULL,NULL,NULL,NULL,NULL,NULL,'2014-02-22 13:13:46','2014-02-22 13:13:51',1,35,NULL,'Y');
/*!40000 ALTER TABLE `tsk_company_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_event_types`
--

DROP TABLE IF EXISTS `tsk_event_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_event_types`
--

LOCK TABLES `tsk_event_types` WRITE;
/*!40000 ALTER TABLE `tsk_event_types` DISABLE KEYS */;
INSERT INTO `tsk_event_types` VALUES (1,'Meetings','Blue','0000-00-00 00:00:00','2014-06-09 18:58:53',1,'N',0,19),(2,'Travel','Red','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(4,'Project Work','Pink','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(5,'Personal','Purple','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(6,'Vendor Meeting','Orange','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(7,'Employee','Green','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(8,'Bank','Gray','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(9,'Computers','Black','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(10,'Accounts','Brown','0000-00-00 00:00:00',NULL,1,'N',0,NULL),(11,'test','Grey','2014-06-09 18:57:19','2014-06-09 18:58:32',0,'Y',19,19);
/*!40000 ALTER TABLE `tsk_event_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_events`
--

DROP TABLE IF EXISTS `tsk_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Scheduled',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `is_deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `fk_app_user` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_events`
--

LOCK TABLES `tsk_events` WRITE;
/*!40000 ALTER TABLE `tsk_events` DISABLE KEYS */;
INSERT INTO `tsk_events` VALUES (5,2,'test','test','2014-07-18 18:45:00','2014-07-18 19:45:00',0,'In Progress',1,'2014-06-09','2014-07-03',19,'N'),(6,9,'new event','new event dec','2014-07-17 14:30:00','2014-07-17 15:00:00',0,'Confirmed',1,'2014-06-09','2014-07-03',19,'N'),(7,10,'mypdca meeting','meeting of mypdca','2014-07-12 20:00:00','2014-07-12 21:00:00',0,'Completed',1,'2014-06-09','2014-07-03',19,'N'),(8,2,'client meeting','meeting with client','2014-06-29 16:00:00','2014-06-29 16:30:00',0,'Rescheduled',1,'2014-06-09','2014-07-03',19,'N'),(9,5,'Book ticket','need to book tickets','2014-08-01 21:00:00','1970-01-01 05:30:00',0,'Rescheduled',1,'2014-06-09','2014-07-03',19,'N'),(10,7,'purchase computers','computer purchase','2014-07-19 10:45:00','2014-07-19 11:00:00',0,'Scheduled',1,'2014-06-09','2014-07-03',19,'N'),(11,7,'testing','test','2014-07-08 18:30:00','2014-07-08 18:45:00',0,'Rescheduled',1,'2014-06-09','2014-07-03',19,'Y'),(12,6,'test','test','2014-07-03 11:15:00','2014-07-03 11:30:00',0,'Confirmed',1,'2014-06-10','2014-07-03',19,'N'),(13,8,'test','test','2014-07-21 21:00:00','1970-01-01 05:30:00',0,'In Progress',1,'2014-06-10','2014-07-03',19,'N'),(14,9,'Project Meeting','Meeting with jobfactory','2014-06-13 16:30:00','2014-06-13 18:00:00',0,'In Progress',1,'2014-06-12','2014-06-12',54,'N'),(15,1,'Going to Chennai','','2014-06-21 16:30:00','2014-06-21 17:15:00',0,'Confirmed',1,'2014-06-12','2014-06-12',54,'N'),(16,1,'test','','2014-06-13 19:15:00','2014-06-13 21:15:00',0,'Confirmed',1,'2014-06-12','2014-06-12',54,'N'),(17,4,'purchase a laptop','','2014-06-19 17:15:00','1970-01-01 05:30:00',0,'Scheduled',1,'2014-06-12','2014-06-12',54,'N'),(18,8,'t','','2014-07-23 15:49:00','1970-01-01 05:30:00',0,'Scheduled',1,'2014-06-30','2014-07-03',19,'N'),(19,10,'going to home','home journey','2014-08-08 18:30:00','2014-08-08 19:00:00',0,'Scheduled',1,'2014-08-01','2014-08-01',10,'N');
/*!40000 ALTER TABLE `tsk_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_file_details`
--

DROP TABLE IF EXISTS `tsk_file_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_file_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attachment` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `tsk_files_id` int(10) unsigned NOT NULL,
  `rand_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_file_details_tsk_files1_idx` (`tsk_files_id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_file_details`
--

LOCK TABLES `tsk_file_details` WRITE;
/*!40000 ALTER TABLE `tsk_file_details` DISABLE KEYS */;
INSERT INTO `tsk_file_details` VALUES (1,'38922_Exit Interview Format for CEOTS.doc',1,'2014-06-11 18:05:09',1,81348),(2,'77060_Form 10c - PF Withdrawal.pdf',1,'2014-06-11 18:05:09',1,81348),(3,'70019_Form 11 - PF Opt Out.pdf',1,'2014-06-11 18:05:09',1,81348),(4,'19803_Form 13 - PF Transfer.pdf',1,'2014-06-11 18:05:10',1,81348),(5,'19623_Form 19 - PF Withdrawal.pdf',1,'2014-06-11 18:05:10',1,81348),(6,'4685_No due certificate_CEOTS.xls',1,'2014-06-11 18:05:10',1,81348),(7,'87341_No due certificate_CEOTS.zip',1,'2014-06-11 18:05:10',1,81348),(8,'32160_No due certificate_CEOTS.zip',1,'2014-06-11 18:14:35',2,89127),(9,'81564_Form 13 - PF Transfer.pdf',1,'2014-06-11 18:16:39',3,78241),(10,'25183_TNEB Online Payment.pdf',1,'2014-06-12 10:17:30',4,47989),(11,'35632_blob',1,'2014-06-12 11:54:12',5,69577),(12,'27848_blob',1,'2014-06-12 11:54:12',5,69577),(13,'27716_blob',1,'2014-06-12 11:54:12',5,69577),(14,'93100_blob',1,'2014-06-12 11:54:12',5,69577),(64,'86_Form_19_-_PF_Withdrawal.pdf',1,'2014-06-13 17:37:31',7,7940),(63,'79342_Form_13_-_PF_Transfer.pdf',1,'2014-06-13 17:37:31',7,7940),(20,'26251_blob',1,'2014-06-12 12:06:55',0,13720),(21,'83432_blob',1,'2014-06-12 12:06:55',0,13720),(22,'2076_blob',1,'2014-06-12 12:06:55',0,13720),(60,'3858_Exit_Interview_Format_for_CEOTS.doc',1,'2014-06-13 17:37:31',7,7940),(61,'83133_Form_10c_-_PF_Withdrawal.pdf',1,'2014-06-13 17:37:31',7,7940),(27,'94522_blob',0,'2014-06-12 12:13:11',7,76654),(28,'57770_blob',0,'2014-06-12 12:13:11',7,76654),(62,'97601_Form_11_-_PF_Opt_Out.pdf',1,'2014-06-13 17:37:31',7,7940),(30,'99023_blob',1,'2014-06-12 12:13:11',7,76654),(31,'21091_careerad2.jpg',1,'2014-06-12 12:13:25',7,76654),(32,'75622_careerad2.jpg',1,'2014-06-12 12:16:12',8,31228),(33,'1691_careerad4.jpg',1,'2014-06-12 12:16:24',0,11782),(34,'81332_careerad.jpg',1,'2014-06-12 12:16:28',0,11782),(46,'82519_Exit_Interview_Format_for_CEOTS.doc',1,'2014-06-13 17:28:50',0,56860),(36,'17939_careerad2.jpg',1,'2014-06-12 12:18:38',8,48218),(37,'5945_careerad2.jpg',1,'2014-06-12 16:54:02',9,37091),(38,'14975_careerad.jpg',1,'2014-06-12 16:55:01',9,37091),(48,'32123_Form_11_-_PF_Opt_Out.pdf',1,'2014-06-13 17:28:50',0,56860),(49,'67184_Form_13_-_PF_Transfer.pdf',1,'2014-06-13 17:28:50',0,56860),(50,'99841_Form_19_-_PF_Withdrawal.pdf',1,'2014-06-13 17:28:50',0,56860),(51,'51627_No_due_certificate_CEOTS.xls',1,'2014-06-13 17:28:50',0,56860),(52,'44659_No_due_certificate_CEOTS.zip',1,'2014-06-13 17:28:51',0,56860),(53,'70334_Exit_Interview_Format_for_CEOTS.doc',1,'2014-06-13 17:29:15',8,22952),(47,'82303_Form_10c_-_PF_Withdrawal.pdf',1,'2014-06-13 17:28:50',0,56860),(54,'30628_Form_10c_-_PF_Withdrawal.pdf',1,'2014-06-13 17:29:15',8,22952),(55,'44815_Form_11_-_PF_Opt_Out.pdf',1,'2014-06-13 17:29:15',8,22952),(56,'89703_Form_13_-_PF_Transfer.pdf',1,'2014-06-13 17:29:15',8,22952),(57,'12217_Form_19_-_PF_Withdrawal.pdf',1,'2014-06-13 17:29:15',8,22952),(58,'2051_No_due_certificate_CEOTS.xls',1,'2014-06-13 17:29:16',8,22952),(59,'11209_No_due_certificate_CEOTS.zip',1,'2014-06-13 17:29:16',8,22952),(65,'53238_No_due_certificate_CEOTS.xls',1,'2014-06-13 17:37:32',7,7940),(66,'95294_No_due_certificate_CEOTS.zip',1,'2014-06-13 17:37:32',7,7940),(67,'85772_JF_Translation_Doc_Final_(1).doc',1,'2014-07-18 13:44:15',0,85059),(68,'17780_CALENDER_2014.pdf',1,'2014-07-21 11:36:46',0,43869),(69,'20926_Expense_Report_-_118.xlsx',1,'2014-08-02 21:24:07',10,56168),(70,'63980_Expense_Report_-_101_(1).xlsx',1,'2014-08-02 21:24:08',10,56168),(71,'66192_Expense_Report_-_101.xlsx',1,'2014-08-02 21:24:08',10,56168),(72,'87045_Leave_Approver_(2).xlsx',1,'2014-08-02 21:24:08',10,56168),(73,'45923_Expense_Report_-_117_(18).xlsx',1,'2014-08-02 21:24:09',10,56168),(74,'30765_Expense_Report_-_117_(17).xlsx',1,'2014-08-02 21:24:09',10,56168),(75,'1972_Expense_Report_-_117_(16).xlsx',1,'2014-08-02 21:24:09',10,56168),(76,'18186_Expense_Report_-_117_(15).xlsx',1,'2014-08-02 21:24:09',10,56168);
/*!40000 ALTER TABLE `tsk_file_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_file_read`
--

DROP TABLE IF EXISTS `tsk_file_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_file_read` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('R','U') NOT NULL DEFAULT 'U' COMMENT 'R - Read',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `tsk_files_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_file_read_tsk_files1_idx` (`tsk_files_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_file_read`
--

LOCK TABLES `tsk_file_read` WRITE;
/*!40000 ALTER TABLE `tsk_file_read` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsk_file_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_files`
--

DROP TABLE IF EXISTS `tsk_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_plan_app_users1_idx` (`app_users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_files`
--

LOCK TABLES `tsk_files` WRITE;
/*!40000 ALTER TABLE `tsk_files` DISABLE KEYS */;
INSERT INTO `tsk_files` VALUES (1,'test','test',1,'Y','2014-06-11 18:05:12','2014-06-12 13:19:44',19),(2,'test3','test',1,'Y','2014-06-11 18:14:42','2014-06-12 13:19:49',19),(3,'testing task','testing desc',1,'Y','2014-06-11 18:16:40','2014-06-12 13:19:54',54),(4,'project file','this is file related to project of the first recruitment of the indian',1,'Y','2014-06-12 10:17:32','2014-06-12 13:20:02',19),(5,'testing task','test',0,'Y','2014-06-12 11:54:16','2014-06-13 17:33:18',19),(6,'big file','big file desc',1,'N','2014-06-12 11:58:17','2014-06-13 17:34:03',19),(7,'test3','test',1,'N','2014-06-12 12:13:50','2014-06-13 17:37:44',19),(8,'new file','new file options',1,'N','2014-06-12 12:16:14','2014-06-13 17:29:17',19),(9,'by testing 10','test is the file used in the demo process of ceo',1,'N','2014-06-12 16:55:02','2014-06-12 17:40:30',54),(10,'testing task','test',1,'N','2014-08-02 21:24:30',NULL,10);
/*!40000 ALTER TABLE `tsk_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_files_users`
--

DROP TABLE IF EXISTS `tsk_files_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_files_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_users_id` int(10) unsigned NOT NULL,
  `tsk_files_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_plan_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_files_users_tsk_files1_idx` (`tsk_files_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_files_users`
--

LOCK TABLES `tsk_files_users` WRITE;
/*!40000 ALTER TABLE `tsk_files_users` DISABLE KEYS */;
INSERT INTO `tsk_files_users` VALUES (1,1,2),(2,4,2),(3,10,2),(4,30,2),(5,19,3),(6,3,4),(35,7,5),(81,15,6),(67,30,9),(86,3,10),(85,56,7),(84,7,7),(66,29,9),(80,11,8),(79,9,8),(68,34,9),(65,28,9),(64,56,9),(63,24,9),(62,23,9),(61,19,9),(60,13,9),(59,11,9),(58,10,9),(78,7,8),(77,2,8);
/*!40000 ALTER TABLE `tsk_files_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_plan`
--

DROP TABLE IF EXISTS `tsk_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `expected_outcome` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `type` enum('P','D') NOT NULL COMMENT 'P - Project Plan',
  `status` enum('P','E','M','L','W','C') NOT NULL DEFAULT 'W' COMMENT '''W'' => ''Pending'', ''E'' => ''Executed'',  ''L'' => ''Partially Done'', ''P'' => ''Postponed'', ''M'' => ''Modified'', ''C'' => ''Cancelled''',
  `remark` varchar(200) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `read_status` enum('U','R') NOT NULL DEFAULT 'R',
  `read_type` enum('R') DEFAULT NULL COMMENT ' R - Replied',
  `read_modified` datetime DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `copy_task_id` int(11) DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `tsk_company_id` int(10) unsigned DEFAULT NULL,
  `tsk_projects_id` int(10) unsigned DEFAULT NULL,
  `tsk_plan_types_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_plan_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_plan_tsk_company1_idx` (`tsk_company_id`),
  KEY `fk_tsk_plan_tsk_projects1_idx` (`tsk_projects_id`),
  KEY `fk_tsk_plan_tsk_plan_types2_idx` (`tsk_plan_types_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_plan`
--

LOCK TABLES `tsk_plan` WRITE;
/*!40000 ALTER TABLE `tsk_plan` DISABLE KEYS */;
INSERT INTO `tsk_plan` VALUES (1,'Project review','project review meeting with client','ok fine','2014-07-26 09:30:00','2014-07-26 14:30:00','D','P','test',NULL,NULL,'R','R',NULL,'N','2014-07-25 13:28:07','2014-07-28 19:56:47',NULL,15,NULL,NULL,5),(2,'online mass rec. ','mass rec. with the client','today complete','2014-07-27 11:30:00','2014-07-27 15:30:00','D','L','test',NULL,NULL,'R','R',NULL,'N','2014-07-25 13:30:09','2014-08-03 19:52:38',NULL,15,NULL,NULL,16),(3,'offline mass rec.','finish in time','thanks','2014-07-27 09:30:00','2014-07-27 17:00:00','D','W','test',NULL,NULL,'R','R',NULL,'N','2014-07-25 13:30:09','2014-07-28 20:11:08',NULL,15,NULL,NULL,10),(4,'This is my forth task','forth task to be done','complete in time','2014-07-21 09:30:00','2014-07-21 15:30:00','D','E','ok',NULL,NULL,'R','R',NULL,'N','2014-07-25 13:33:52','2014-08-03 19:39:36',NULL,15,NULL,NULL,5),(5,'india job','jobs to be don','test','2014-06-01 09:30:00','2014-06-01 16:00:00','D','W','test',NULL,NULL,'R','R',NULL,'N','2014-07-25 13:38:05','2014-07-28 20:10:43',NULL,15,NULL,NULL,5),(6,'my seventh job','job title to be added','test','2014-07-29 11:00:00','2014-07-29 13:30:00','D','E','test',NULL,NULL,'R','R',NULL,'N','2014-07-27 17:17:31','2014-08-03 19:52:26',NULL,15,NULL,NULL,11),(7,'test ','test','test','2014-07-31 09:30:00','2014-07-31 17:00:00','D','E','test',NULL,NULL,'R','R',NULL,'N','2014-07-25 13:47:12','2014-08-03 19:40:38',NULL,15,NULL,NULL,18),(8,'testing task for unread icon','testing task to be performed for the unread icon','test outcome','2014-07-29 09:30:00','2014-07-29 14:00:00','D','E','done',NULL,NULL,'R','R',NULL,'N','2014-07-25 15:56:24','2014-08-02 19:37:41',NULL,15,NULL,NULL,10),(9,'Mass recruitment to be conducted','Chennai world trade centre mass rec. will be held on the following dates as discussed.','making arrangements.','2014-07-30 09:30:00','2014-07-30 14:00:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-25 17:47:54','2014-08-03 19:47:23',NULL,15,NULL,NULL,15),(10,'Mass recruitment in chennai region','100 candidates to be recruited in the Daimler company located in chennai branch','40 candidates to be selected','2014-07-29 00:00:00','2014-07-30 00:00:00','P','E','done sie',NULL,NULL,'R',NULL,NULL,'N','2014-07-25 18:38:56','2014-08-03 20:13:20',NULL,15,1,1,12),(16,'testing task for unread icon','testing task to be performed for the unread icon','test outcome','0000-00-00 00:00:00','0000-00-00 00:00:00','D','W','',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 19:28:06',NULL,8,15,NULL,NULL,10),(17,'test ','test','test','0000-00-00 00:00:00','0000-00-00 00:00:00','D','W','',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 19:49:16',NULL,7,15,NULL,NULL,18),(18,'This is my forth task','forth task to be done','complete in time','0000-00-00 00:00:00','0000-00-00 00:00:00','D','W','',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 19:52:14',NULL,4,15,NULL,NULL,5),(19,'Project review','project review meeting with client','ok fine','2014-08-02 10:30:00','2014-08-02 14:00:00','D','P','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 19:56:47','2014-07-28 19:57:36',1,15,NULL,NULL,5),(20,'Project review','project review meeting with client','ok fine','2014-08-03 09:30:00','2014-08-03 10:00:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 19:57:36','2014-07-28 19:58:09',19,15,NULL,NULL,5),(21,'Project review','project review meeting with client','ok fine','2014-08-14 10:00:00','2014-08-14 14:30:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 19:58:09','2014-07-28 20:00:38',20,15,NULL,NULL,5),(22,'Project review','project review meeting with client','ok fine','2014-08-19 09:30:00','2014-08-19 10:00:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:00:38','2014-07-28 20:16:46',21,15,NULL,NULL,5),(23,'online mass rec. ','mass rec. with the client','today complete','2014-07-31 09:30:00','2014-07-31 11:00:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:05:56','2014-07-28 20:31:34',2,15,NULL,NULL,16),(24,'my seventh job','job title to be added','test','2014-07-30 10:30:00','2014-07-30 10:30:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:10:24','2014-07-28 20:19:27',6,15,NULL,NULL,11),(25,'india job','jobs to be don','test','2014-07-31 10:00:00','2014-07-31 14:00:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:10:43','2014-07-28 20:32:17',5,15,NULL,NULL,5),(26,'Project review','project review meeting with client','ok fine','2014-08-21 10:00:00','2014-08-21 12:30:00','D','L','test task',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:16:46','2014-07-28 20:25:42',22,15,NULL,NULL,5),(27,'Project review','project review meeting with client','ok fine','2014-08-25 10:30:00','2014-08-25 14:30:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:25:42','2014-07-28 20:33:43',26,15,NULL,NULL,5),(28,'Project review','project review meeting with client','ok fine','2014-08-26 10:30:00','2014-08-26 11:00:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:33:44','2014-07-28 20:46:01',27,15,NULL,NULL,5),(29,'Project review','project review meeting with client','ok fine','2014-08-27 10:00:00','2014-08-27 10:30:00','D','E','f',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:34:51','2014-07-28 21:28:54',28,15,NULL,NULL,5),(30,'Project review','project review meeting with client','ok fine','2014-08-28 09:30:00','2014-08-28 13:30:00','D','E','g',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:38:10','2014-07-28 21:28:06',29,15,NULL,NULL,5),(31,'Project review','project review meeting with client','ok fine','2014-08-29 10:00:00','2014-08-29 13:00:00','D','E','f',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:42:34','2014-07-28 21:29:30',30,15,NULL,NULL,5),(32,'Project review','project review meeting with client','ok fine','2014-08-30 10:30:00','2014-08-30 10:30:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:43:17','2014-07-28 21:24:32',31,15,NULL,NULL,5),(33,'Project review','project review meeting with client','ok fine','2014-08-31 10:30:00','2014-08-31 17:30:00','D','E','h',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 20:44:08','2014-07-28 21:40:38',32,15,NULL,NULL,5),(34,'Project review','project review meeting with client','ok fine','2014-08-31 09:30:00','2014-08-31 10:30:00','D','E','f',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 21:24:32','2014-07-28 21:35:36',32,15,NULL,NULL,5),(35,'Project review','project review meeting with client','ok fine','2014-08-31 10:30:00','2014-08-31 15:00:00','D','E','g',NULL,NULL,'R',NULL,NULL,'N','2014-07-28 21:25:58','2014-07-28 21:40:47',31,15,NULL,NULL,5),(36,'going for a tea break','good time','thansk a lot','2014-08-03 09:30:00','2014-08-03 15:00:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 16:34:04','2014-08-02 17:56:20',NULL,15,NULL,NULL,5),(37,'lunch break with the client','fine lunch','thanks ','2014-08-03 15:00:00','2014-08-03 16:00:00','D','E','done',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 16:34:04','2014-08-02 17:48:29',NULL,15,NULL,NULL,12),(38,'going to home','home making technique to be studied','good job','2014-08-05 09:30:00','2014-08-05 18:30:00','D','C','sorry cncelld',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 16:43:21','2014-08-02 17:37:08',NULL,15,NULL,NULL,5),(39,'swimming test','conduct swimming','thanks for that','2014-08-05 15:30:00','2014-08-05 18:00:00','D','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 16:44:35','2014-08-02 17:40:18',NULL,15,NULL,NULL,19),(40,'test','test','test','2014-08-08 09:30:00','2014-08-08 20:30:00','D','E','done',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 16:50:07','2014-08-02 17:13:51',NULL,15,NULL,NULL,3),(41,'swimming test','conduct swimming','thanks for that','2014-08-06 09:30:00','2014-08-06 15:00:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 17:40:18','2014-08-02 19:38:35',NULL,15,NULL,NULL,19),(42,'test','test','test','2014-08-03 09:00:00','2014-08-03 14:30:00','D','E','donre',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 17:41:27','2014-08-02 17:43:50',NULL,15,NULL,NULL,10),(43,'going for a tea break','good time','thansk a lot','2014-08-04 09:30:00','2014-08-04 15:30:00','D','P','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 17:56:20','2014-08-02 18:06:24',NULL,15,NULL,NULL,5),(44,'going for a tea break','good time','thansk a lot','2014-08-07 10:00:00','2014-08-07 22:00:00','D','E','ok',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:06:24','2014-08-02 20:43:27',NULL,15,NULL,NULL,5),(45,'this is my first project title','this is my first project description','thanks for this','2014-08-04 00:00:00','2014-08-04 00:00:00','P','L','sorry',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:07:01','2014-08-02 18:07:33',NULL,15,1,1,15),(46,'this is my first project title','this is my first project description','thanks for this','2014-08-11 00:00:00','2014-08-11 00:00:00','P','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:07:33','2014-08-02 18:26:29',NULL,15,1,1,15),(47,'test','test','test','2014-08-13 00:00:00','2014-08-13 00:00:00','P','P','sorry, i cant able to do',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:11:47','2014-08-02 18:12:34',NULL,15,1,1,5),(48,'test','test','test','2014-08-14 00:00:00','2014-08-14 00:00:00','P','P','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:12:34','2014-08-02 18:13:35',NULL,15,1,1,5),(49,'test','test','test','2014-08-15 00:00:00','2014-08-15 00:00:00','P','P','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:13:35','2014-08-02 18:13:52',NULL,15,1,1,5),(50,'test','test','test','2014-08-16 00:00:00','2014-08-16 00:00:00','P','P','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:13:52','2014-08-02 18:17:25',NULL,15,1,1,5),(51,'test','test','test','2014-08-17 00:00:00','2014-08-17 00:00:00','P','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:17:25','2014-08-02 18:18:06',NULL,15,1,1,5),(52,'test','test','test','2014-08-18 00:00:00','2014-08-18 00:00:00','P','P','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:18:06','2014-08-02 18:21:08',NULL,15,1,1,5),(53,'test','test','test','2014-08-19 00:00:00','2014-08-19 00:00:00','P','L','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:21:08','2014-08-02 18:21:57',NULL,15,1,1,5),(54,'test','test','test','2014-08-20 00:00:00','2014-08-20 00:00:00','P','E','de',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 18:21:57','2014-08-02 18:23:42',NULL,15,1,1,5),(55,'this is my today daily task title','this is the desc. of the daily task','this is exp. outcoem\'\'of the daily task','2014-08-27 09:30:00','2014-08-27 17:00:00','D','C','uh',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 19:24:08','2014-08-02 19:56:43',NULL,15,NULL,NULL,17),(56,'this is my first task title and desc','this is my first title desc','success desc','2014-08-03 09:00:00','2014-08-03 11:00:00','D','E','test',NULL,NULL,'R',NULL,NULL,'N','2014-08-02 20:32:24','2014-08-02 20:42:25',NULL,15,NULL,NULL,16),(57,'project review with team','finish project review meeting with client','no issue','2014-08-04 09:30:00','2014-08-04 22:00:00','D','C','cancelled due to client busy',NULL,NULL,'R',NULL,NULL,'N','2014-08-03 11:02:11','2014-08-03 11:04:07',NULL,19,NULL,NULL,11),(58,'going for client meeting','client meeting','good job','2014-08-04 10:00:00','2014-08-04 20:00:00','D','E','ij',NULL,NULL,'R',NULL,NULL,'N','2014-08-03 11:03:36','2014-08-03 13:38:08',NULL,19,NULL,NULL,3),(59,'test','test','test task','2014-08-04 09:30:00','2014-08-04 22:00:00','D','W','',NULL,NULL,'R',NULL,NULL,'N','2014-08-03 18:32:25',NULL,NULL,15,NULL,NULL,5),(60,'online mass rec. ','mass rec. with the client','today complete','2014-08-04 09:00:00','2014-08-04 22:00:00','D','E','god is great',NULL,NULL,'R',NULL,NULL,'N','2014-08-03 19:52:38','2014-08-03 20:14:15',2,15,NULL,NULL,16);
/*!40000 ALTER TABLE `tsk_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_plan_read`
--

DROP TABLE IF EXISTS `tsk_plan_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_plan_read` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('R','U') NOT NULL DEFAULT 'U' COMMENT 'R - Read',
  `action_type` enum('N','M','R') NOT NULL COMMENT 'N - New',
  `created_date` datetime NOT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `tsk_plan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_req_status_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_plan_read_tsk_plan1_idx` (`tsk_plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_plan_read`
--

LOCK TABLES `tsk_plan_read` WRITE;
/*!40000 ALTER TABLE `tsk_plan_read` DISABLE KEYS */;
INSERT INTO `tsk_plan_read` VALUES (1,'R','M','2014-07-25 13:28:07',10,'2014-07-30 15:42:21',1),(2,'U','M','2014-07-25 13:30:09',10,'2014-08-03 19:52:38',2),(3,'R','M','2014-07-25 13:30:09',10,'2014-07-30 15:42:27',3),(4,'U','M','2014-07-25 13:33:52',10,'2014-08-03 19:39:36',4),(5,'U','M','2014-07-25 13:38:05',10,'2014-07-28 20:10:43',5),(6,'U','M','2014-07-25 13:40:25',10,'2014-08-03 19:52:26',6),(7,'U','M','2014-07-25 13:47:12',10,'2014-08-03 19:40:38',7),(8,'U','M','2014-07-25 15:56:24',10,'2014-08-02 19:37:41',8),(9,'U','M','2014-07-25 17:47:54',10,'2014-08-03 19:47:23',9),(10,'U','M','2014-07-25 18:38:56',10,'2014-08-03 20:13:20',10),(11,'R','M','2014-08-02 16:34:04',10,'2014-08-02 19:13:28',36),(12,'R','M','2014-08-02 16:34:04',10,'2014-08-02 19:13:28',37),(13,'R','M','2014-08-02 16:43:21',10,'2014-08-02 19:13:30',38),(14,'R','M','2014-08-02 16:44:35',10,'2014-08-02 19:13:30',39),(15,'R','M','2014-08-02 16:50:07',10,'2014-08-02 19:13:31',40),(16,'R','M','2014-08-02 17:41:27',10,'2014-08-02 19:13:28',42),(17,'U','M','2014-08-02 18:07:01',10,'2014-08-02 18:07:33',45),(18,'U','M','2014-08-02 18:11:47',10,'2014-08-02 18:12:34',47),(19,'R','M','2014-08-02 19:24:08',10,'2014-08-02 20:02:07',55),(20,'U','M','2014-08-02 20:32:24',10,'2014-08-02 20:42:25',56),(21,'U','M','2014-08-03 11:02:11',10,'2014-08-03 11:04:07',57),(22,'U','M','2014-08-03 11:03:36',10,'2014-08-03 13:38:08',58),(23,'U','N','2014-08-03 18:32:25',10,NULL,59);
/*!40000 ALTER TABLE `tsk_plan_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_plan_reply`
--

DROP TABLE IF EXISTS `tsk_plan_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_plan_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` varchar(200) NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `app_users_id` int(10) unsigned NOT NULL,
  `tsk_plan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_plan_app_users1_idx` (`app_users_id`),
  KEY `fk_tsk_plan_reply_tsk_plan1_idx` (`tsk_plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_plan_reply`
--

LOCK TABLES `tsk_plan_reply` WRITE;
/*!40000 ALTER TABLE `tsk_plan_reply` DISABLE KEYS */;
INSERT INTO `tsk_plan_reply` VALUES (1,'ok fine','N','2014-07-25 16:33:31',NULL,10,8),(2,'pls complete the task soon','N','2014-07-25 17:01:09',NULL,15,4),(3,'sir you need to complete','N','2014-07-25 17:02:28',NULL,10,4),(4,'ok fine sir','N','2014-07-25 17:10:59',NULL,10,4),(5,'how is','N','2014-07-25 17:11:03',NULL,10,4),(6,'ok fine','N','2014-07-25 17:11:07',NULL,10,4),(7,'ok fine','N','2014-07-25 17:12:13',NULL,10,4),(8,'ok fine','N','2014-07-25 17:12:47',NULL,10,4),(9,'i am good','N','2014-07-25 17:12:50',NULL,10,4),(10,'i see','N','2014-07-25 17:12:53',NULL,10,4),(11,'ok','N','2014-07-25 17:12:55',NULL,10,4),(12,'ok','N','2014-07-25 17:12:57',NULL,10,4),(13,'ok','N','2014-07-25 17:12:58',NULL,10,4),(14,'fine','N','2014-07-25 17:13:00',NULL,10,4),(15,'thanks sir','N','2014-07-25 17:54:11',NULL,10,5),(16,'fine sir','N','2014-07-25 17:55:33',NULL,10,5),(17,'ok','N','2014-07-25 17:56:12',NULL,10,5),(18,'good sir','N','2014-07-25 17:56:29',NULL,10,5),(19,'ok','N','2014-07-25 18:25:25',NULL,15,5),(20,'ok','N','2014-07-25 19:30:21',NULL,10,1),(21,'thanks you sir','N','2014-07-25 19:30:42',NULL,15,1),(22,'ok sir','N','2014-07-28 20:25:50',NULL,15,26),(23,'fine','N','2014-07-28 20:25:52',NULL,15,26),(24,'test','N','2014-08-01 16:56:56',NULL,15,27),(25,'t','N','2014-08-01 16:56:59',NULL,15,27),(26,'t','N','2014-08-01 16:57:00',NULL,15,27),(27,'tt','N','2014-08-01 16:57:00',NULL,15,27),(28,'t','N','2014-08-01 16:57:00',NULL,15,27),(29,'t','N','2014-08-01 16:57:01',NULL,15,27),(30,'t','N','2014-08-01 16:57:01',NULL,15,27),(31,'tt','N','2014-08-01 16:57:02',NULL,15,27),(32,'t','N','2014-08-01 16:57:02',NULL,15,27),(33,'t','N','2014-08-01 16:57:11',NULL,15,27),(34,'test','N','2014-08-01 17:00:30',NULL,15,27),(35,'222','N','2014-08-01 17:00:33',NULL,15,27),(36,'good job','N','2014-08-02 18:26:46',NULL,15,46),(37,'test','N','2014-08-03 11:14:08',NULL,19,58),(38,'ok','N','2014-08-03 19:55:44',NULL,15,10);
/*!40000 ALTER TABLE `tsk_plan_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_plan_types`
--

DROP TABLE IF EXISTS `tsk_plan_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_plan_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_plan_types`
--

LOCK TABLES `tsk_plan_types` WRITE;
/*!40000 ALTER TABLE `tsk_plan_types` DISABLE KEYS */;
INSERT INTO `tsk_plan_types` VALUES (1,'Planning Discussion',1,'N','2014-06-06 00:00:00','2014-06-08 15:47:30'),(2,'Review Discussion',1,'N','2014-06-06 00:00:00',NULL),(3,'Client Meeting',1,'N','2014-06-06 00:00:00',NULL),(4,'Vendor Meeting',1,'N','2014-06-06 00:00:00',NULL),(5,'Candidate Meeting',1,'N','2014-06-06 00:00:00',NULL),(6,'Interview',1,'N','2014-06-06 00:00:00',NULL),(7,'Sourcing Profiles',1,'N','2014-06-06 00:00:00',NULL),(8,'MIS Preparation',1,'N','2014-06-06 00:00:00',NULL),(9,'Mapping Work',1,'N','2014-06-06 00:00:00',NULL),(10,'Campaigning Work',1,'N','2014-06-06 00:00:00',NULL),(11,'Drive Preparation',1,'N','2014-06-06 00:00:00',NULL),(12,'Recruitment Drive',1,'N','2014-06-06 00:00:00',NULL),(13,'Data Entry',1,'N','2014-06-06 00:00:00',NULL),(14,'Follow-up',1,'N','2014-06-06 00:00:00','2014-06-08 15:47:19'),(15,'Coordination',1,'N','2014-06-06 00:00:00',NULL),(16,'Development Work',1,'N','2014-06-06 00:00:00',NULL),(17,'Training / Workshop',1,'N','2014-06-06 00:00:00',NULL),(18,'Conference / Forum',1,'N','2014-06-06 00:00:00',NULL),(19,'Accounting',1,'N','2014-06-06 00:00:00',NULL),(20,'Documentation',1,'N','2014-06-06 00:00:00',NULL),(21,'Associate Meeting',1,'N','2014-06-06 00:00:00',NULL),(22,'External Agency Meeting',1,'N','2014-06-06 00:00:00',NULL),(23,'Proposal Making',1,'N','2014-06-06 00:00:00',NULL),(24,'Travel',1,'N','2014-06-06 00:00:00',NULL),(25,'test333',0,'Y','2014-06-08 15:47:37','2014-06-08 15:49:51'),(26,'test',1,'Y','2014-06-08 15:47:45','2014-06-08 15:49:45'),(27,'test66',1,'Y','2014-06-08 15:49:00','2014-06-08 15:49:40'),(28,'follow-up3',1,'Y','2014-06-08 15:51:30','2014-06-08 15:51:34');
/*!40000 ALTER TABLE `tsk_plan_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsk_projects`
--

DROP TABLE IF EXISTS `tsk_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsk_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `proj_short_code` char(6) NOT NULL,
  `start_date` date NOT NULL,
  `target_finish` date DEFAULT NULL,
  `priority` set('H','M','L') NOT NULL COMMENT 'H - High\nM - Medium\nL - Low',
  `status` enum('PR','IP','IPG','OH','CO','AR') NOT NULL COMMENT 'PR - Proposed\nIP - In planning\nIPG - In progress\nOH - On hold\nCO - Complete\nAR - Archieved',
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `project_leader` int(10) unsigned NOT NULL,
  `po_number` varchar(45) DEFAULT NULL,
  `purchase_order` varchar(45) DEFAULT NULL,
  `payment_terms` text,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `tsk_company_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tsk_projects_app_users1` (`project_leader`),
  KEY `fk_tsk_projects_tsk_company1` (`tsk_company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsk_projects`
--

LOCK TABLES `tsk_projects` WRITE;
/*!40000 ALTER TABLE `tsk_projects` DISABLE KEYS */;
INSERT INTO `tsk_projects` VALUES (1,'Jobs Factory','JOBFAC','2013-01-01','2014-05-30','','PR','2014-02-22 12:52:59','2014-07-05 15:35:08',15,'',NULL,'',35,17,'N',1),(2,'test','111','2014-01-27','2014-02-22','','PR','2014-02-22 13:00:25','2014-02-22 13:00:30',1,'234234',NULL,'',35,NULL,'Y',1),(3,'Recruitment Drive','soap','2014-05-12',NULL,'','IP','2014-05-03 19:59:51','2014-07-05 16:08:40',3,'',NULL,'',17,17,'N',2);
/*!40000 ALTER TABLE `tsk_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ceo_apps'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-03 20:48:33
