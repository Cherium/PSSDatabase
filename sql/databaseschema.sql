CREATE DATABASE  IF NOT EXISTS `pss` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pss`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: pss
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artist` (
  `E_name` varchar(255) NOT NULL,
  `F_name` varchar(255) NOT NULL,
  `L_name` varchar(255) DEFAULT NULL,
  `UCID` int DEFAULT NULL,
  PRIMARY KEY (`E_name`),
  CONSTRAINT `artist_fk` FOREIGN KEY (`E_name`) REFERENCES `performance` (`E_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist`
--

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `Date` date NOT NULL,
  `UCID` int NOT NULL,
  PRIMARY KEY (`Date`,`UCID`),
  KEY `Attendance_ucid_fk_idx` (`UCID`),
  CONSTRAINT `Attendance_date_fk` FOREIGN KEY (`Date`) REFERENCES `meeting` (`Date`),
  CONSTRAINT `Attendance_ucid_fk` FOREIGN KEY (`UCID`) REFERENCES `executive` (`EUCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `UCID` int NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`UCID`,`Date`),
  KEY `Author_date_pk_idx` (`Date`),
  CONSTRAINT `Author_date_pk` FOREIGN KEY (`Date`) REFERENCES `monthly_email` (`Date`),
  CONSTRAINT `Author_pk` FOREIGN KEY (`UCID`) REFERENCES `executive` (`EUCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budget` (
  `Name` varchar(255) NOT NULL,
  `Transaction_no` int NOT NULL,
  `Food` int DEFAULT NULL,
  `Rent` int DEFAULT NULL,
  `Decoration` int DEFAULT NULL,
  `Peformer` int DEFAULT NULL,
  `Other` int DEFAULT NULL,
  PRIMARY KEY (`Name`,`Transaction_no`),
  KEY `Budget_no_fk_idx` (`Transaction_no`),
  CONSTRAINT `Budget_event_fk` FOREIGN KEY (`Name`) REFERENCES `event` (`Name`),
  CONSTRAINT `Budget_no_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `outgoing` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget`
--

LOCK TABLES `budget` WRITE;
/*!40000 ALTER TABLE `budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contribution`
--

DROP TABLE IF EXISTS `contribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contribution` (
  `Name` varchar(255) NOT NULL,
  `Transaction_no` int DEFAULT NULL,
  PRIMARY KEY (`Name`),
  KEY `Contribution_no_fk_idx` (`Transaction_no`),
  CONSTRAINT `Contribution_fk` FOREIGN KEY (`Name`) REFERENCES `organization` (`Name`),
  CONSTRAINT `Contribution_no_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `outgoing` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contribution`
--

LOCK TABLES `contribution` WRITE;
/*!40000 ALTER TABLE `contribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `contribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cover`
--

DROP TABLE IF EXISTS `cover`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cover` (
  `Name` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Name`,`Date`),
  KEY `Cover_date_fk_idx` (`Date`),
  CONSTRAINT `Cover_date_fk` FOREIGN KEY (`Date`) REFERENCES `monthly_email` (`Date`),
  CONSTRAINT `Cover_event_fk` FOREIGN KEY (`Name`) REFERENCES `event` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cover`
--

LOCK TABLES `cover` WRITE;
/*!40000 ALTER TABLE `cover` DISABLE KEYS */;
/*!40000 ALTER TABLE `cover` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `Name` varchar(255) NOT NULL,
  `H_UCID` int DEFAULT NULL,
  PRIMARY KEY (`Name`),
  UNIQUE KEY `Name_UNIQUE` (`Name`),
  KEY `H_UCID_idx` (`H_UCID`),
  CONSTRAINT `Head_fk` FOREIGN KEY (`H_UCID`) REFERENCES `executive` (`EUCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donate`
--

DROP TABLE IF EXISTS `donate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `donate` (
  `UCID` int NOT NULL,
  `Transaction_no` int NOT NULL,
  PRIMARY KEY (`UCID`),
  KEY `donate_no_fk_idx` (`Transaction_no`),
  CONSTRAINT `donate_id_fk` FOREIGN KEY (`UCID`) REFERENCES `member` (`UCID`),
  CONSTRAINT `donate_no_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `fundraiser` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donate`
--

LOCK TABLES `donate` WRITE;
/*!40000 ALTER TABLE `donate` DISABLE KEYS */;
/*!40000 ALTER TABLE `donate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_host`
--

DROP TABLE IF EXISTS `e_host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `e_host` (
  `Name` varchar(255) NOT NULL,
  `UCID` int NOT NULL,
  PRIMARY KEY (`Name`,`UCID`),
  KEY `E_ucid_fk_idx` (`UCID`),
  CONSTRAINT `E_event_fk` FOREIGN KEY (`Name`) REFERENCES `event` (`Name`),
  CONSTRAINT `E_ucid_fk` FOREIGN KEY (`UCID`) REFERENCES `executive` (`EUCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_host`
--

LOCK TABLES `e_host` WRITE;
/*!40000 ALTER TABLE `e_host` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `Name` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `FundraiserName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Name`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES ('Bake Sale','2020-03-15','Science B','Club Expenses'),('Biryani Meet & Greet','2020-02-10','Science Theatres',NULL),('Clubs Expo','2020-01-01','MacHall',NULL),('Clubs Week','2020-01-20','MacHall',NULL),('Clubs Week Winter','2020-09-15','MacHall',NULL),('Gala','2020-03-20','MacEwan',NULL),('Mehndi Night','2020-03-01','The Empty Space',NULL),('Netflix and Chai','2020-02-21','The Empty Space',NULL),('Netflix and Chai','2020-11-15','The Empty Space',NULL),('Paint Night ','2020-10-10','MacEwan',NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `executive`
--

DROP TABLE IF EXISTS `executive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `executive` (
  `EUCID` int NOT NULL,
  `Date_elected` date NOT NULL,
  `Dname` varchar(255) NOT NULL,
  PRIMARY KEY (`EUCID`),
  KEY `Department_fk_idx` (`Dname`),
  CONSTRAINT `Department_fk` FOREIGN KEY (`Dname`) REFERENCES `department` (`Name`),
  CONSTRAINT `UCID_fk` FOREIGN KEY (`EUCID`) REFERENCES `member` (`UCID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `executive`
--

LOCK TABLES `executive` WRITE;
/*!40000 ALTER TABLE `executive` DISABLE KEYS */;
/*!40000 ALTER TABLE `executive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financial_transaction`
--

DROP TABLE IF EXISTS `financial_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `financial_transaction` (
  `Transaction_no` int NOT NULL,
  `Date` date DEFAULT NULL,
  `Amount` int DEFAULT NULL,
  PRIMARY KEY (`Transaction_no`),
  UNIQUE KEY `Transaction_no_UNIQUE` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financial_transaction`
--

LOCK TABLES `financial_transaction` WRITE;
/*!40000 ALTER TABLE `financial_transaction` DISABLE KEYS */;
INSERT INTO `financial_transaction` VALUES (1,'2020-01-01',5),(2,'2020-01-01',5),(3,'2020-01-01',5),(4,'2020-01-01',5),(5,'2020-01-01',5),(6,'2020-01-01',5),(7,'2020-01-01',5),(8,'2020-01-01',5),(9,'2020-01-01',5),(10,'2020-01-01',5),(11,'2020-01-01',5),(12,'2020-01-01',5),(13,'2020-01-01',5),(14,'2020-01-01',5);
/*!40000 ALTER TABLE `financial_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `food` (
  `E_name` varchar(255) NOT NULL,
  `Food` varchar(255) NOT NULL,
  PRIMARY KEY (`E_name`,`Food`),
  CONSTRAINT `Food_fk` FOREIGN KEY (`E_name`) REFERENCES `event` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser`
--

DROP TABLE IF EXISTS `fundraiser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fundraiser` (
  `Transaction_no` int NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Transaction_no`,`Name`),
  CONSTRAINT `Fundraiser_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `incoming` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser`
--

LOCK TABLES `fundraiser` WRITE;
/*!40000 ALTER TABLE `fundraiser` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraiser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incoming`
--

DROP TABLE IF EXISTS `incoming`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incoming` (
  `Transaction_no` int NOT NULL,
  `Package_type` varchar(255) NOT NULL,
  PRIMARY KEY (`Transaction_no`),
  UNIQUE KEY `Transaction_no_UNIQUE` (`Transaction_no`),
  CONSTRAINT `Incoming_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `financial_transaction` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incoming`
--

LOCK TABLES `incoming` WRITE;
/*!40000 ALTER TABLE `incoming` DISABLE KEYS */;
INSERT INTO `incoming` VALUES (1,'Membership payment'),(2,'Membership payment'),(3,'Membership payment'),(4,'Membership payment'),(5,'Membership payment'),(6,'Membership payment'),(7,'Membership payment'),(8,'Membership payment'),(9,'Membership payment'),(10,'Membership payment'),(11,'Membership payment'),(12,'Membership payment'),(13,'Membership payment'),(14,'Membership payment');
/*!40000 ALTER TABLE `incoming` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joined_in`
--

DROP TABLE IF EXISTS `joined_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `joined_in` (
  `UCID` int NOT NULL,
  `E_name` varchar(255) DEFAULT NULL,
  `E_date` date DEFAULT NULL,
  PRIMARY KEY (`UCID`),
  KEY `Joined_e_fk_idx` (`E_name`,`E_date`),
  CONSTRAINT `Joined_e_fk` FOREIGN KEY (`E_name`, `E_date`) REFERENCES `event` (`Name`, `Date`),
  CONSTRAINT `Joined_fk` FOREIGN KEY (`UCID`) REFERENCES `member` (`UCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joined_in`
--

LOCK TABLES `joined_in` WRITE;
/*!40000 ALTER TABLE `joined_in` DISABLE KEYS */;
INSERT INTO `joined_in` VALUES (61987960,'Clubs Expo','2020-01-01'),(63412936,'Clubs Expo','2020-01-01'),(64679158,'Clubs Expo','2020-01-01'),(68571087,'Clubs Expo','2020-01-01'),(72192507,'Clubs Expo','2020-01-01'),(72526792,'Clubs Expo','2020-01-01'),(76063860,'Clubs Expo','2020-01-01'),(76890700,'Clubs Expo','2020-01-01'),(78246420,'Clubs Expo','2020-01-01'),(79223657,'Clubs Expo','2020-01-01'),(80729750,'Clubs Expo','2020-01-01'),(80730445,'Clubs Expo','2020-01-01'),(83329907,'Clubs Expo','2020-01-01'),(83501473,'Clubs Expo','2020-01-01'),(85159812,'Clubs Expo','2020-01-01'),(87971251,'Clubs Expo','2020-01-01'),(88112078,'Clubs Expo','2020-01-01'),(94559927,'Clubs Expo','2020-01-01'),(96979951,'Clubs Expo','2020-01-01'),(99180334,'Clubs Expo','2020-01-01'),(99663904,'Clubs Expo','2020-01-01');
/*!40000 ALTER TABLE `joined_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meeting` (
  `Date` date NOT NULL,
  `Summary` longtext NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Date`),
  KEY `Department_fk_idx` (`Name`),
  CONSTRAINT `Meeting_fk` FOREIGN KEY (`Name`) REFERENCES `department` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting`
--

LOCK TABLES `meeting` WRITE;
/*!40000 ALTER TABLE `meeting` DISABLE KEYS */;
/*!40000 ALTER TABLE `meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `UCID` int NOT NULL,
  `Internation_status` tinyint NOT NULL DEFAULT '0',
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Year_of_study` varchar(1) NOT NULL,
  `Program` varchar(255) DEFAULT NULL,
  `Subscription_status` tinyint DEFAULT '1',
  `Transaction_no` int DEFAULT NULL,
  PRIMARY KEY (`UCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (61987960,1,'Angel','Deslauriers','pjacklam@att.net','3','Civil Engineering',1,10),(63412936,1,'Norberto','Hubbell','jaffe@att.net','3','Science',1,1),(64679158,0,'Millard','Wigton','kempsonc@yahoo.ca','1','Compsci and Econ',1,8),(68571087,0,'Kendall','Paradis','marin@icloud.com','1','Arts',1,9),(72192507,1,'Gordon','Lesane','seano@hotmail.com','1','Arts',1,6),(72526792,0,'Lawrence','Markell','ribet@yahoo.ca','1','Arts',1,7),(76063860,0,'Man','Rothenberg','cderoove@mac.com','2','mechanical engineering',1,13),(76890700,0,'Ruben','Vanburen','scitext@verizon.net','1','Science',1,NULL),(78246420,0,'Jacob','Blakeslee','meinkej@aol.com','1','Kinesiology ',1,NULL),(79223657,1,'Gene','Pech','mcsporran@msn.com','1','Arts',1,11),(80729750,1,'Bryan','Hobson','crandall@comcast.net','1','Science',1,NULL),(80730445,1,'Harry','Bulluck','cvrcek@yahoo.com','1','Arts',0,NULL),(83329907,1,'Willis','Verges','afeldspar@icloud.com','1','Science',0,NULL),(83501473,0,'Mohammad','Ganey','lukka@icloud.com','1','Computer Science',0,2),(85159812,0,'Hal','Vine','jbuchana@sbcglobal.net','1',NULL,1,NULL),(87971251,0,'Hosea','Onan','goresky@live.com','1','Kinesiology ',1,NULL),(88112078,0,'Elmo','Gualtieri','quantaman@verizon.net','4','Business',1,4),(94559927,0,'Lanny','Hockensmith','kildjean@icloud.com','3','Arts',1,3),(96979951,0,'Frances','Iglesia','jbarta@gmail.com','2','Engineering',1,12),(99180334,0,'Linwood','Mancia','uqmcolyv@outlook.com','1','Kinesiology ',1,5),(99663904,0,'Preston','Gunter','jorgb@hotmail.com','1','Faculty Of Arts',1,14);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_payment`
--

DROP TABLE IF EXISTS `membership_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membership_payment` (
  `Transaction_no` int NOT NULL,
  `Payment_status` tinyint NOT NULL,
  PRIMARY KEY (`Transaction_no`),
  UNIQUE KEY `Transaction_no_UNIQUE` (`Transaction_no`),
  CONSTRAINT `Mem_payment_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `incoming` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_payment`
--

LOCK TABLES `membership_payment` WRITE;
/*!40000 ALTER TABLE `membership_payment` DISABLE KEYS */;
INSERT INTO `membership_payment` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1);
/*!40000 ALTER TABLE `membership_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_email`
--

DROP TABLE IF EXISTS `monthly_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monthly_email` (
  `Date` date NOT NULL,
  PRIMARY KEY (`Date`),
  UNIQUE KEY `Date_UNIQUE` (`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_email`
--

LOCK TABLES `monthly_email` WRITE;
/*!40000 ALTER TABLE `monthly_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `monthly_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notify`
--

DROP TABLE IF EXISTS `notify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notify` (
  `UCID` int NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`UCID`,`Date`),
  KEY `Notify_email_fk_idx` (`Date`),
  CONSTRAINT `Notify_email_fk` FOREIGN KEY (`Date`) REFERENCES `monthly_email` (`Date`),
  CONSTRAINT `Notify_member_fk` FOREIGN KEY (`UCID`) REFERENCES `member` (`UCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notify`
--

LOCK TABLES `notify` WRITE;
/*!40000 ALTER TABLE `notify` DISABLE KEYS */;
/*!40000 ALTER TABLE `notify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization` (
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outgoing`
--

DROP TABLE IF EXISTS `outgoing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outgoing` (
  `Transaction_no` int NOT NULL,
  `Type_of_transfer` varchar(255) NOT NULL,
  PRIMARY KEY (`Transaction_no`),
  UNIQUE KEY `Transaction_no_UNIQUE` (`Transaction_no`),
  CONSTRAINT `Outgoing_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `financial_transaction` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outgoing`
--

LOCK TABLES `outgoing` WRITE;
/*!40000 ALTER TABLE `outgoing` DISABLE KEYS */;
/*!40000 ALTER TABLE `outgoing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performance`
--

DROP TABLE IF EXISTS `performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `performance` (
  `E_name` varchar(255) NOT NULL,
  `E_date` varchar(255) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`E_name`,`E_date`),
  CONSTRAINT `Peformance_fk` FOREIGN KEY (`E_name`) REFERENCES `event` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performance`
--

LOCK TABLES `performance` WRITE;
/*!40000 ALTER TABLE `performance` DISABLE KEYS */;
/*!40000 ALTER TABLE `performance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `president`
--

DROP TABLE IF EXISTS `president`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `president` (
  `UCID` int NOT NULL,
  `Date_elected` date NOT NULL,
  PRIMARY KEY (`UCID`,`Date_elected`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `president`
--

LOCK TABLES `president` WRITE;
/*!40000 ALTER TABLE `president` DISABLE KEYS */;
/*!40000 ALTER TABLE `president` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reimbursement`
--

DROP TABLE IF EXISTS `reimbursement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reimbursement` (
  `UCID` int NOT NULL,
  `Transaction_no` int NOT NULL,
  PRIMARY KEY (`UCID`,`Transaction_no`),
  KEY `Reimburse_no_fk_idx` (`Transaction_no`),
  CONSTRAINT `Reimburse_no_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `outgoing` (`Transaction_no`),
  CONSTRAINT `Reimburse_ucid_fk` FOREIGN KEY (`UCID`) REFERENCES `executive` (`EUCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reimbursement`
--

LOCK TABLES `reimbursement` WRITE;
/*!40000 ALTER TABLE `reimbursement` DISABLE KEYS */;
/*!40000 ALTER TABLE `reimbursement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsorship`
--

DROP TABLE IF EXISTS `sponsorship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sponsorship` (
  `Transaction_no` int NOT NULL,
  `Package_type` varchar(255) NOT NULL,
  `Sponsor_name` varchar(255) NOT NULL,
  `Sponsor_package` varchar(255) NOT NULL,
  UNIQUE KEY `Transaction_no_UNIQUE` (`Transaction_no`),
  CONSTRAINT `sponsorship_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `incoming` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsorship`
--

LOCK TABLES `sponsorship` WRITE;
/*!40000 ALTER TABLE `sponsorship` DISABLE KEYS */;
/*!40000 ALTER TABLE `sponsorship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topic` (
  `Date` date NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Date`),
  CONSTRAINT `Topic_fk` FOREIGN KEY (`Date`) REFERENCES `meeting` (`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-02 21:24:02
