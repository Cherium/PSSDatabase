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
  `FName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Name`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
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
  PRIMARY KEY (`UCID`),
  CONSTRAINT `Joined_fk` FOREIGN KEY (`UCID`) REFERENCES `member` (`UCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joined_in`
--

LOCK TABLES `joined_in` WRITE;
/*!40000 ALTER TABLE `joined_in` DISABLE KEYS */;
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
  `Year_of_study` int NOT NULL,
  `Program` varchar(255) NOT NULL,
  `Subscription_status` tinyint NOT NULL DEFAULT '0',
  `Transaction_no` int NOT NULL,
  PRIMARY KEY (`UCID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
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
  CONSTRAINT `Mem_payment_fk` FOREIGN KEY (`Transaction_no`) REFERENCES `incoming` (`Transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_payment`
--

LOCK TABLES `membership_payment` WRITE;
/*!40000 ALTER TABLE `membership_payment` DISABLE KEYS */;
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

-- Dump completed on 2020-11-29 17:36:10
