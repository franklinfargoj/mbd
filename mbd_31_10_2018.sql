-- MySQL dump 10.13  Distrib 5.5.60, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mbd
-- ------------------------------------------------------
-- Server version	5.5.60-0ubuntu0.14.04.1

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
-- Table structure for table `architect_application`
--

DROP TABLE IF EXISTS `architect_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_application` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `candidate_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidate_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidate_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `certificate_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drafted_certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_signed_certificate_status` tinyint(4) NOT NULL DEFAULT '0',
  `application_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_application`
--

LOCK TABLES `architect_application` WRITE;
/*!40000 ALTER TABLE `architect_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_application_marks`
--

DROP TABLE IF EXISTS `architect_application_marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_application_marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_application_id` int(10) unsigned NOT NULL,
  `document_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_path` text COLLATE utf8mb4_unicode_ci,
  `marks` decimal(5,2) DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `final_certificate` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_application_marks`
--

LOCK TABLES `architect_application_marks` WRITE;
/*!40000 ALTER TABLE `architect_application_marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_application_marks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_application_status_logs`
--

DROP TABLE IF EXISTS `architect_application_status_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_application_status_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_application_id` int(10) unsigned NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_role_id` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_application_status_logs`
--

LOCK TABLES `architect_application_status_logs` WRITE;
/*!40000 ALTER TABLE `architect_application_status_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_application_status_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_certificates`
--

DROP TABLE IF EXISTS `architect_certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_application_id` int(11) NOT NULL,
  `certificate_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_certificates`
--

LOCK TABLES `architect_certificates` WRITE;
/*!40000 ALTER TABLE `architect_certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_court_matters_or_disputes_on_land`
--

DROP TABLE IF EXISTS `architect_layout_detail_court_matters_or_disputes_on_land`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_court_matters_or_disputes_on_land` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `document_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_court_matters_or_disputes_on_land`
--

LOCK TABLES `architect_layout_detail_court_matters_or_disputes_on_land` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_court_matters_or_disputes_on_land` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_court_matters_or_disputes_on_land` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_cts_plan_details`
--

DROP TABLE IF EXISTS `architect_layout_detail_cts_plan_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_cts_plan_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `cts_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_cts_plan_details`
--

LOCK TABLES `architect_layout_detail_cts_plan_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_cts_plan_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_cts_plan_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_ee_reports`
--

DROP TABLE IF EXISTS `architect_layout_detail_ee_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_ee_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `name_of_documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_ee_reports`
--

LOCK TABLES `architect_layout_detail_ee_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_ee_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_ee_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_em_reports`
--

DROP TABLE IF EXISTS `architect_layout_detail_em_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_em_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `name_of_documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_em_reports`
--

LOCK TABLES `architect_layout_detail_em_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_em_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_em_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_land_reports`
--

DROP TABLE IF EXISTS `architect_layout_detail_land_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_land_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `name_of_documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_land_reports`
--

LOCK TABLES `architect_layout_detail_land_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_land_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_land_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_pr_card_details`
--

DROP TABLE IF EXISTS `architect_layout_detail_pr_card_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_pr_card_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `architect_layout_detail_cts_plan_detail_id` int(11) NOT NULL,
  `upload_pr_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_pr_card_details`
--

LOCK TABLES `architect_layout_detail_pr_card_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_pr_card_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_pr_card_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_detail_ree_reports`
--

DROP TABLE IF EXISTS `architect_layout_detail_ree_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_detail_ree_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_detail_id` int(11) NOT NULL,
  `name_of_documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_detail_ree_reports`
--

LOCK TABLES `architect_layout_detail_ree_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_detail_ree_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_detail_ree_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_details`
--

DROP TABLE IF EXISTS `architect_layout_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_id` int(11) NOT NULL,
  `latest_layout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_approved_layout` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_submitted_layout_for_approval` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cts_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dp_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dp_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dp_comment` text COLLATE utf8mb4_unicode_ci,
  `crz_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crz_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crz_comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_details`
--

LOCK TABLES `architect_layout_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_ee_scrunity_question_details`
--

DROP TABLE IF EXISTS `architect_layout_ee_scrunity_question_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_ee_scrunity_question_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `architect_layout_ee_scrunity_question_master_id` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `label1` tinyint(4) NOT NULL DEFAULT '0',
  `label2` tinyint(4) NOT NULL DEFAULT '0',
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ee_scrunity_question_details`
--

LOCK TABLES `architect_layout_ee_scrunity_question_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_ee_scrunity_question_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_ee_scrunity_question_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_ee_scrunity_question_master`
--

DROP TABLE IF EXISTS `architect_layout_ee_scrunity_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_ee_scrunity_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_options` tinyint(4) NOT NULL DEFAULT '0',
  `label1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ee_scrunity_question_master`
--

LOCK TABLES `architect_layout_ee_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_ee_scrunity_question_master` DISABLE KEYS */;
INSERT INTO `architect_layout_ee_scrunity_question_master` VALUES (1,1,'Plot boundary & area of plot as per site measurement',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46'),(2,1,'Plan showing the extension  carried out if any by the exsiting occupants and the area under the extension.',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46'),(3,1,'Report regarding unauthorized work carried out if any and whether your department has regularized the same, if yes, copies of correspondence should be submitted along with.',1,'Yes','No','2018-10-30 03:31:46','2018-10-30 03:31:46'),(4,1,'Change of user if any documentary evidence regarding NOC granted if any for the change of user.',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46'),(5,1,'Requested to submit details report regarding current of existing water supply/sewage network with ref. to the proposal by applicant.',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46'),(6,1,'Report regarding accessibility of all the plots & also requested to inform whether the roads, D. P. reservations, Amenities, Open spaces, R.G. are handed over to MCGM or not & if yes submit receipts of this office',1,'Yes','No','2018-10-30 03:31:46','2018-10-30 03:31:46'),(7,1,'Any other additional information relating to the development on the above referred plots & transits tenements status, any proposal of redevelopment of transit camp, latest position of the said scheme.',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46'),(8,1,'Request to demarcate the plots which are allotted under section 16/Tender with name of society.',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46'),(9,1,'Details of vacant land / pockets within CTS booundary',0,'','','2018-10-30 03:31:46','2018-10-30 03:31:46');
/*!40000 ALTER TABLE `architect_layout_ee_scrunity_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_ee_scrutiny_reports`
--

DROP TABLE IF EXISTS `architect_layout_ee_scrutiny_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_ee_scrutiny_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `name_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ee_scrutiny_reports`
--

LOCK TABLES `architect_layout_ee_scrutiny_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_ee_scrutiny_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_ee_scrutiny_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_em_scrunity_question_details`
--

DROP TABLE IF EXISTS `architect_layout_em_scrunity_question_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_em_scrunity_question_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `architect_layout_em_scrunity_question_master_id` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `label1` tinyint(4) NOT NULL DEFAULT '0',
  `label2` tinyint(4) NOT NULL DEFAULT '0',
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_em_scrunity_question_details`
--

LOCK TABLES `architect_layout_em_scrunity_question_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_em_scrunity_question_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_em_scrunity_question_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_em_scrunity_question_master`
--

DROP TABLE IF EXISTS `architect_layout_em_scrunity_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_em_scrunity_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_options` tinyint(4) NOT NULL DEFAULT '0',
  `label1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_em_scrunity_question_master`
--

LOCK TABLES `architect_layout_em_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_em_scrunity_question_master` DISABLE KEYS */;
INSERT INTO `architect_layout_em_scrunity_question_master` VALUES (1,1,'List of Societies',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46'),(2,1,'Lease deed & Convayance deed',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46'),(3,1,'Excel sheet with details; category of tenants, carpet area mensioned in sale deed, no of bldgs., Total no of t/s ',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46');
/*!40000 ALTER TABLE `architect_layout_em_scrunity_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_em_scrutiny_reports`
--

DROP TABLE IF EXISTS `architect_layout_em_scrutiny_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_em_scrutiny_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `name_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_em_scrutiny_reports`
--

LOCK TABLES `architect_layout_em_scrutiny_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_em_scrutiny_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_em_scrutiny_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_land_scrutiny_reports`
--

DROP TABLE IF EXISTS `architect_layout_land_scrutiny_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_land_scrutiny_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `name_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_land_scrutiny_reports`
--

LOCK TABLES `architect_layout_land_scrutiny_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_land_scrutiny_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_land_scrutiny_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_lm_scrunity_question_details`
--

DROP TABLE IF EXISTS `architect_layout_lm_scrunity_question_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_lm_scrunity_question_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `architect_layout_lm_scrunity_question_master_id` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `label1` tinyint(4) NOT NULL DEFAULT '0',
  `label2` tinyint(4) NOT NULL DEFAULT '0',
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_lm_scrunity_question_details`
--

LOCK TABLES `architect_layout_lm_scrunity_question_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_lm_scrunity_question_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_lm_scrunity_question_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_lm_scrunity_question_master`
--

DROP TABLE IF EXISTS `architect_layout_lm_scrunity_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_lm_scrunity_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_options` tinyint(4) NOT NULL DEFAULT '0',
  `label1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_lm_scrunity_question_master`
--

LOCK TABLES `architect_layout_lm_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_lm_scrunity_question_master` DISABLE KEYS */;
INSERT INTO `architect_layout_lm_scrunity_question_master` VALUES (1,1,'Submit report of availability of property cards of all CTS no of Colony, Area as per Property Card',1,'Available','Not Available','2018-10-30 03:31:46','2018-10-30 03:31:46'),(2,1,'Plot boundary shown as per CTS',1,'Yes','No','2018-10-30 03:31:46','2018-10-30 03:31:46'),(3,1,'Whether all property cards are in name of MHADA. if Property cards in name of different owner then whether any proposal for change of name in MHADA',1,'Yes','No','2018-10-30 03:31:46','2018-10-30 03:31:46'),(4,1,'Whether Plot boundary of colony is correct as per possession plan / CTS plan.',1,'Yes','No','2018-10-30 03:31:46','2018-10-30 03:31:46');
/*!40000 ALTER TABLE `architect_layout_lm_scrunity_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_ree_scrunity_question_details`
--

DROP TABLE IF EXISTS `architect_layout_ree_scrunity_question_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_ree_scrunity_question_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `architect_layout_ree_scrunity_question_master_id` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `label1` tinyint(4) NOT NULL DEFAULT '0',
  `label2` tinyint(4) NOT NULL DEFAULT '0',
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ree_scrunity_question_details`
--

LOCK TABLES `architect_layout_ree_scrunity_question_details` WRITE;
/*!40000 ALTER TABLE `architect_layout_ree_scrunity_question_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_ree_scrunity_question_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_ree_scrunity_question_master`
--

DROP TABLE IF EXISTS `architect_layout_ree_scrunity_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_ree_scrunity_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_options` tinyint(4) NOT NULL DEFAULT '0',
  `label1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ree_scrunity_question_master`
--

LOCK TABLES `architect_layout_ree_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_ree_scrunity_question_master` DISABLE KEYS */;
INSERT INTO `architect_layout_ree_scrunity_question_master` VALUES (1,1,'List of Offer letters issued to the societies',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46'),(2,1,'List of NOC letters issued to the societies',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46'),(3,1,'List of R.G. Open Spaces allotted to various Societies',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46'),(4,1,'Recovery if any from the society regarding additional FSI, R.G. etc.',0,NULL,NULL,'2018-10-30 03:31:46','2018-10-30 03:31:46');
/*!40000 ALTER TABLE `architect_layout_ree_scrunity_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_ree_scrutiny_reports`
--

DROP TABLE IF EXISTS `architect_layout_ree_scrutiny_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_ree_scrutiny_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `architect_layout_id` int(11) NOT NULL,
  `name_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ree_scrutiny_reports`
--

LOCK TABLES `architect_layout_ree_scrutiny_reports` WRITE;
/*!40000 ALTER TABLE `architect_layout_ree_scrutiny_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_ree_scrutiny_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layout_status_logs`
--

DROP TABLE IF EXISTS `architect_layout_status_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layout_status_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `architect_layout_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_role_id` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `open` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_status_logs`
--

LOCK TABLES `architect_layout_status_logs` WRITE;
/*!40000 ALTER TABLE `architect_layout_status_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layout_status_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architect_layouts`
--

DROP TABLE IF EXISTS `architect_layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architect_layouts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layout_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `upload_layout_in_pdf_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_layout_in_excel_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_architect_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layouts`
--

LOCK TABLES `architect_layouts` WRITE;
/*!40000 ALTER TABLE `architect_layouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `architect_layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arrear_calculation`
--

DROP TABLE IF EXISTS `arrear_calculation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arrear_calculation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` int(10) unsigned NOT NULL,
  `building_id` int(10) unsigned NOT NULL,
  `society_id` int(10) unsigned NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oir_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oir_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_intrest_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difference_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ida_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ida_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difference_intrest_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `arrear_calculation_tenant_id_foreign` (`tenant_id`),
  KEY `arrear_calculation_building_id_foreign` (`building_id`),
  KEY `arrear_calculation_society_id_foreign` (`society_id`),
  CONSTRAINT `arrear_calculation_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`),
  CONSTRAINT `arrear_calculation_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `master_tenants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrear_calculation`
--

LOCK TABLES `arrear_calculation` WRITE;
/*!40000 ALTER TABLE `arrear_calculation` DISABLE KEYS */;
/*!40000 ALTER TABLE `arrear_calculation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arrears_charges_rates`
--

DROP TABLE IF EXISTS `arrears_charges_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arrears_charges_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(10) unsigned NOT NULL,
  `building_id` int(10) unsigned NOT NULL,
  `year` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_rate` decimal(10,2) DEFAULT NULL,
  `revise_rate` decimal(10,2) DEFAULT NULL,
  `interest_on_old_rate` decimal(10,2) DEFAULT NULL,
  `interest_on_differance` decimal(10,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `arrears_charges_rates_society_id_foreign` (`society_id`),
  KEY `arrears_charges_rates_building_id_foreign` (`building_id`),
  CONSTRAINT `arrears_charges_rates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrears_charges_rates`
--

LOCK TABLES `arrears_charges_rates` WRITE;
/*!40000 ALTER TABLE `arrears_charges_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `arrears_charges_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `board_departments`
--

DROP TABLE IF EXISTS `board_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `board_departments_board_id_foreign` (`board_id`),
  KEY `board_departments_department_id_foreign` (`department_id`),
  CONSTRAINT `board_departments_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `board_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_departments`
--

LOCK TABLES `board_departments` WRITE;
/*!40000 ALTER TABLE `board_departments` DISABLE KEYS */;
INSERT INTO `board_departments` VALUES (1,1,1),(2,1,2),(3,1,3);
/*!40000 ALTER TABLE `board_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `board_user`
--

DROP TABLE IF EXISTS `board_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_user`
--

LOCK TABLES `board_user` WRITE;
/*!40000 ALTER TABLE `board_user` DISABLE KEYS */;
INSERT INTO `board_user` VALUES (1,1,11,'2018-10-30 03:31:34','2018-10-30 03:31:34'),(2,1,12,'2018-10-30 03:31:34','2018-10-30 03:31:34'),(3,1,13,'2018-10-30 03:31:34','2018-10-30 03:31:34'),(4,1,14,'2018-10-30 03:31:34','2018-10-30 03:31:34');
/*!40000 ALTER TABLE `board_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boards`
--

DROP TABLE IF EXISTS `boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boards`
--

LOCK TABLES `boards` WRITE;
/*!40000 ALTER TABLE `boards` DISABLE KEYS */;
INSERT INTO `boards` VALUES (1,'Mumbai Board',1,'2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conveyance_sale_price_calculation`
--

DROP TABLE IF EXISTS `conveyance_sale_price_calculation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conveyance_sale_price_calculation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `common_service_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pump_house` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenement_plinth_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenement_carpet_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_plinth_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_carpet_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `construction_cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land_premiun_infrastructure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_sale_price_tenement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `building_no` int(11) DEFAULT NULL,
  `chawl_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consisting` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_of` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ts_under` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admeasure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CTS_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situated_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `north_dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `south_dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `west_dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `east_dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demarcation_map` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ee_covering_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conveyance_sale_price_calculation`
--

LOCK TABLES `conveyance_sale_price_calculation` WRITE;
/*!40000 ALTER TABLE `conveyance_sale_price_calculation` DISABLE KEYS */;
/*!40000 ALTER TABLE `conveyance_sale_price_calculation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleted_hearing`
--

DROP TABLE IF EXISTS `deleted_hearing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleted_hearing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hearing_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appellant_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `final_judgement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_reason` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleted_hearing`
--

LOCK TABLES `deleted_hearing` WRITE;
/*!40000 ALTER TABLE `deleted_hearing` DISABLE KEYS */;
/*!40000 ALTER TABLE `deleted_hearing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleted_resolutions`
--

DROP TABLE IF EXISTS `deleted_resolutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleted_resolutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resolution_id` int(10) unsigned DEFAULT NULL,
  `resolution_type_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_for_delete` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted_resolutions_resolution_id_foreign` (`resolution_id`),
  KEY `deleted_resolutions_resolution_type_id_foreign` (`resolution_type_id`),
  CONSTRAINT `deleted_resolutions_resolution_id_foreign` FOREIGN KEY (`resolution_id`) REFERENCES `resolutions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deleted_resolutions_resolution_type_id_foreign` FOREIGN KEY (`resolution_type_id`) REFERENCES `resolution_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleted_resolutions`
--

LOCK TABLES `deleted_resolutions` WRITE;
/*!40000 ALTER TABLE `deleted_resolutions` DISABLE KEYS */;
/*!40000 ALTER TABLE `deleted_resolutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleted_role_details`
--

DROP TABLE IF EXISTS `deleted_role_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleted_role_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_details_id` int(10) unsigned NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleted_role_details`
--

LOCK TABLES `deleted_role_details` WRITE;
/*!40000 ALTER TABLE `deleted_role_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `deleted_role_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleted_village_details`
--

DROP TABLE IF EXISTS `deleted_village_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleted_village_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `village_details_id` int(10) unsigned NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted_village_details_village_details_id_foreign` (`village_details_id`),
  CONSTRAINT `deleted_village_details_village_details_id_foreign` FOREIGN KEY (`village_details_id`) REFERENCES `lm_village_detail` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleted_village_details`
--

LOCK TABLES `deleted_village_details` WRITE;
/*!40000 ALTER TABLE `deleted_village_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `deleted_village_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Department 1',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'Joint CO',1,'2018-10-30 03:31:34','2018-10-30 03:31:34'),(3,'Co',1,'2018-10-30 03:31:34','2018-10-30 03:31:34');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_application_enclosures`
--

DROP TABLE IF EXISTS `eoa_application_enclosures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_application_enclosures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eoa_application_id` int(11) NOT NULL,
  `enclosure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_application_enclosures`
--

LOCK TABLES `eoa_application_enclosures` WRITE;
/*!40000 ALTER TABLE `eoa_application_enclosures` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_application_enclosures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_application_fee_payment_details`
--

DROP TABLE IF EXISTS `eoa_application_fee_payment_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_application_fee_payment_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eoa_application_id` int(11) NOT NULL,
  `receipt_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_order_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_application_fee_payment_details`
--

LOCK TABLES `eoa_application_fee_payment_details` WRITE;
/*!40000 ALTER TABLE `eoa_application_fee_payment_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_application_fee_payment_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_application_imp_project_work_handled_details`
--

DROP TABLE IF EXISTS `eoa_application_imp_project_work_handled_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_application_imp_project_work_handled_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eoa_application_imp_project_detail_id` int(11) NOT NULL,
  `no_of_dwelling` int(11) DEFAULT NULL,
  `land_area_in_sq_mt` int(11) DEFAULT NULL,
  `built_up_area_in_sq_mt` int(11) NOT NULL,
  `value_of_work_in_rs` int(11) NOT NULL,
  `year_of_completion_start` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_application_imp_project_work_handled_details`
--

LOCK TABLES `eoa_application_imp_project_work_handled_details` WRITE;
/*!40000 ALTER TABLE `eoa_application_imp_project_work_handled_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_application_imp_project_work_handled_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_application_imp_senior_professional_details`
--

DROP TABLE IF EXISTS `eoa_application_imp_senior_professional_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_application_imp_senior_professional_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eoa_application_id` int(11) NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualifications` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_qualification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `len_of_service_with_firm_in_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `len_of_service_with_firm_in_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_application_imp_senior_professional_details`
--

LOCK TABLES `eoa_application_imp_senior_professional_details` WRITE;
/*!40000 ALTER TABLE `eoa_application_imp_senior_professional_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_application_imp_senior_professional_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_application_important_project_details`
--

DROP TABLE IF EXISTS `eoa_application_important_project_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_application_important_project_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eoa_application_id` int(11) NOT NULL,
  `name_of_client` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_of_client` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_application_important_project_details`
--

LOCK TABLES `eoa_application_important_project_details` WRITE;
/*!40000 ALTER TABLE `eoa_application_important_project_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_application_important_project_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_application_project_sheet_details`
--

DROP TABLE IF EXISTS `eoa_application_project_sheet_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_application_project_sheet_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eoa_application_id` int(11) NOT NULL,
  `name_of_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_client` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `built_up_area_in_sq_m` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land_area_in_sq_m` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_value_of_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed_value_of_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_start` date DEFAULT NULL,
  `date_of_completion` date DEFAULT NULL,
  `whether_service_terminated_by_client` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salient_features_of_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_for_delay_if_any` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_completed` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_application_project_sheet_details`
--

LOCK TABLES `eoa_application_project_sheet_details` WRITE;
/*!40000 ALTER TABLE `eoa_application_project_sheet_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_application_project_sheet_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eoa_applications`
--

DROP TABLE IF EXISTS `eoa_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoa_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_of_panel` int(11) DEFAULT NULL,
  `name_of_applicant` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `res` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_of_establishment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_office_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_architects` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_engineers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_supporting_tech` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_supporting_nontech` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_cad_facility` tinyint(4) NOT NULL DEFAULT '0',
  `cad_facility_no_of_operators` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cad_facility_no_of_computers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cad_facility_no_of_printers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cad_facility_no_of_plotters` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_with_council_of_architecture_principle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_with_council_of_architecture_associate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_with_council_of_architecture_partner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_with_council_of_architecture_total_registered_persons` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_prizes_etc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_information` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_info_and_its_enclosures_verify` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoa_applications`
--

LOCK TABLES `eoa_applications` WRITE;
/*!40000 ALTER TABLE `eoa_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoa_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forward_case`
--

DROP TABLE IF EXISTS `forward_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forward_case` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `hearing_id` int(10) unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forward_case_board_id_foreign` (`board_id`),
  KEY `forward_case_department_id_foreign` (`department_id`),
  KEY `forward_case_hearing_id_foreign` (`hearing_id`),
  CONSTRAINT `forward_case_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forward_case_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forward_case_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forward_case`
--

LOCK TABLES `forward_case` WRITE;
/*!40000 ALTER TABLE `forward_case` DISABLE KEYS */;
/*!40000 ALTER TABLE `forward_case` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frontend_users`
--

DROP TABLE IF EXISTS `frontend_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frontend_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frontend_users`
--

LOCK TABLES `frontend_users` WRITE;
/*!40000 ALTER TABLE `frontend_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `frontend_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hearing`
--

DROP TABLE IF EXISTS `hearing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hearing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `preceding_officer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `application_type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `applicant_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_address` longtext COLLATE utf8mb4_unicode_ci,
  `respondent_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respondent_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respondent_address` longtext COLLATE utf8mb4_unicode_ci,
  `case_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_date` date DEFAULT NULL,
  `office_tehsil` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_remark` longtext COLLATE utf8mb4_unicode_ci,
  `department_id` int(11) DEFAULT NULL,
  `board_id` int(11) DEFAULT NULL,
  `hearing_status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hearing_application_type_id_foreign` (`application_type_id`),
  KEY `hearing_department_id_foreign` (`department_id`),
  KEY `hearing_hearing_status_id_foreign` (`hearing_status_id`),
  KEY `hearing_board_id_foreign` (`board_id`),
  KEY `hearing_user_id_foreign` (`user_id`),
  KEY `hearing_role_id_foreign` (`role_id`),
  CONSTRAINT `hearing_application_type_id_foreign` FOREIGN KEY (`application_type_id`) REFERENCES `hearing_application_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hearing_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hearing_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hearing`
--

LOCK TABLES `hearing` WRITE;
/*!40000 ALTER TABLE `hearing` DISABLE KEYS */;
/*!40000 ALTER TABLE `hearing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hearing_application_type`
--

DROP TABLE IF EXISTS `hearing_application_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hearing_application_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hearing_application_type`
--

LOCK TABLES `hearing_application_type` WRITE;
/*!40000 ALTER TABLE `hearing_application_type` DISABLE KEYS */;
INSERT INTO `hearing_application_type` VALUES (1,'Application or claim','2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'Appeal','2018-10-30 03:31:17','2018-10-30 03:31:17'),(3,'Redressal','2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `hearing_application_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hearing_schedule`
--

DROP TABLE IF EXISTS `hearing_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hearing_schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `preceding_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hearing_id` int(10) unsigned NOT NULL,
  `preceding_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preceding_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `case_template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_status` int(10) unsigned NOT NULL,
  `update_supporting_documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hearing_schedule_hearing_id_foreign` (`hearing_id`),
  KEY `hearing_schedule_update_status_foreign` (`update_status`),
  CONSTRAINT `hearing_schedule_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hearing_schedule`
--

LOCK TABLES `hearing_schedule` WRITE;
/*!40000 ALTER TABLE `hearing_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `hearing_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hearing_status`
--

DROP TABLE IF EXISTS `hearing_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hearing_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hearing_status`
--

LOCK TABLES `hearing_status` WRITE;
/*!40000 ALTER TABLE `hearing_status` DISABLE KEYS */;
INSERT INTO `hearing_status` VALUES (1,'Pending','2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'Scheduled Meeting','2018-10-30 03:31:17','2018-10-30 03:31:17'),(3,'Case Under Judgement','2018-10-30 03:31:17','2018-10-30 03:31:17'),(4,'Forwarded','2018-10-30 03:31:17','2018-10-30 03:31:17'),(5,'Notice Send','2018-10-30 03:31:17','2018-10-30 03:31:17'),(6,'Case Closed','2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `hearing_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hearing_status_log`
--

DROP TABLE IF EXISTS `hearing_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hearing_status_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hearing_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `hearing_status_id` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_role_id` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hearing_status_log`
--

LOCK TABLES `hearing_status_log` WRITE;
/*!40000 ALTER TABLE `hearing_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `hearing_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_source`
--

DROP TABLE IF EXISTS `land_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land_source` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_source`
--

LOCK TABLES `land_source` WRITE;
/*!40000 ALTER TABLE `land_source` DISABLE KEYS */;
INSERT INTO `land_source` VALUES (1,'Acquired land',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'Government Land',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(3,'Purchased Land',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(4,'Other land',1,'2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `land_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language_master`
--

DROP TABLE IF EXISTS `language_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_master`
--

LOCK TABLES `language_master` WRITE;
/*!40000 ALTER TABLE `language_master` DISABLE KEYS */;
INSERT INTO `language_master` VALUES (1,'English','2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'marathi','2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `language_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `layout_user`
--

DROP TABLE IF EXISTS `layout_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `layout_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layout_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `layout_user_layout_id_foreign` (`layout_id`),
  KEY `layout_user_user_id_foreign` (`user_id`),
  CONSTRAINT `layout_user_layout_id_foreign` FOREIGN KEY (`layout_id`) REFERENCES `master_layout` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `layout_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layout_user`
--

LOCK TABLES `layout_user` WRITE;
/*!40000 ALTER TABLE `layout_user` DISABLE KEYS */;
INSERT INTO `layout_user` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,15),(11,1,16),(12,1,17),(13,1,18),(14,1,19),(15,1,20),(16,1,23);
/*!40000 ALTER TABLE `layout_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lm_lease_detail`
--

DROP TABLE IF EXISTS `lm_lease_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lm_lease_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lease_rule_16_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_basis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_start_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_rent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_rent_start_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest_per_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_renewal_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_renewed_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent_per_renewed_lease` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest_per_renewed_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month_rent_per_renewed_lease` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_status` tinyint(1) NOT NULL,
  `society_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lm_lease_detail_society_id_foreign` (`society_id`),
  CONSTRAINT `lm_lease_detail_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `lm_society_detail` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lm_lease_detail`
--

LOCK TABLES `lm_lease_detail` WRITE;
/*!40000 ALTER TABLE `lm_lease_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `lm_lease_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lm_society_detail`
--

DROP TABLE IF EXISTS `lm_society_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lm_society_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_reg_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cts_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chairman` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chairman_mob_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretary_mob_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_email_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_on_service_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surplus_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surplus_charges_last_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_land_id` int(11) NOT NULL,
  `society_conveyed` tinyint(4) DEFAULT NULL,
  `date_of_conveyance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_conveyance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `colony_id` int(11) DEFAULT NULL,
  `society_bill_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lm_society_detail`
--

LOCK TABLES `lm_society_detail` WRITE;
/*!40000 ALTER TABLE `lm_society_detail` DISABLE KEYS */;
INSERT INTO `lm_society_detail` VALUES (1,'A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1,1,'1',NULL,NULL,NULL),(2,'B',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1,1,'1',NULL,NULL,NULL),(3,'B',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1,1,'1',NULL,NULL,NULL);
/*!40000 ALTER TABLE `lm_society_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lm_village_detail`
--

DROP TABLE IF EXISTS `lm_village_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lm_village_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(10) unsigned NOT NULL,
  `sr_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land_source_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `land_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `possession_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `other_remark` longtext COLLATE utf8mb4_unicode_ci,
  `7_12_extract` tinyint(1) DEFAULT NULL COMMENT '1=upload and 0= not upload',
  `7_12_mhada_name` tinyint(1) DEFAULT NULL,
  `property_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_card_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_card_mhada_name` tinyint(1) DEFAULT NULL,
  `land_cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extract_file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extract_file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lm_village_detail_board_id_foreign` (`board_id`),
  KEY `lm_village_detail_land_source_id_foreign` (`land_source_id`),
  KEY `lm_village_detail_user_id_foreign` (`user_id`),
  KEY `lm_village_detail_role_id_foreign` (`role_id`),
  CONSTRAINT `lm_village_detail_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lm_village_detail_land_source_id_foreign` FOREIGN KEY (`land_source_id`) REFERENCES `land_source` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lm_village_detail_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lm_village_detail_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lm_village_detail`
--

LOCK TABLES `lm_village_detail` WRITE;
/*!40000 ALTER TABLE `lm_village_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `lm_village_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_buildings`
--

DROP TABLE IF EXISTS `master_buildings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_buildings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(10) unsigned NOT NULL,
  `building_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_buildings_society_id_foreign` (`society_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_buildings`
--

LOCK TABLES `master_buildings` WRITE;
/*!40000 ALTER TABLE `master_buildings` DISABLE KEYS */;
INSERT INTO `master_buildings` VALUES (1,25,'22813','Prof. Favian Pagac III','Maureen Kuphal','2018-10-30 03:31:48','2018-10-30 03:31:48'),(2,4,'6282','Miss Josiane Kiehn','Tessie Hammes','2018-10-30 03:31:48','2018-10-30 03:31:48'),(3,8,'30366','Sylvester Abbott','Ms. Rachelle Mueller IV','2018-10-30 03:31:48','2018-10-30 03:31:48'),(4,27,'34165','Dr. Jordan Koss','Arvilla Keeling','2018-10-30 03:31:48','2018-10-30 03:31:48'),(5,28,'30627','Anne Ernser DVM','Cristobal Gottlieb','2018-10-30 03:31:48','2018-10-30 03:31:48'),(6,21,'29869','Jacynthe Lueilwitz','Prof. Elbert Schowalter','2018-10-30 03:31:48','2018-10-30 03:31:48'),(7,4,'1888','Angelo Leffler','Billy Rice','2018-10-30 03:31:48','2018-10-30 03:31:48'),(8,18,'5585','Virginie VonRueden','Edna Dibbert','2018-10-30 03:31:48','2018-10-30 03:31:48'),(9,1,'34310','Jany Skiles DVM','Kiley Wehner','2018-10-30 03:31:48','2018-10-30 03:31:48'),(10,28,'9209','Mrs. Vita Halvorson','Oliver Ortiz','2018-10-30 03:31:48','2018-10-30 03:31:48'),(11,29,'33924','Golden Kertzmann DDS','Deven Lebsack','2018-10-30 03:31:48','2018-10-30 03:31:48'),(12,26,'24925','Greg Schumm PhD','Estel Nitzsche','2018-10-30 03:31:48','2018-10-30 03:31:48'),(13,11,'10741','Myah Purdy','Valerie Heathcote DVM','2018-10-30 03:31:48','2018-10-30 03:31:48'),(14,12,'1482','Prof. Alvina Kub','Magnolia O\'Hara','2018-10-30 03:31:48','2018-10-30 03:31:48'),(15,10,'29152','Eusebio Hills','Carmen Weimann','2018-10-30 03:31:48','2018-10-30 03:31:48'),(16,13,'7505','Crystal Von','Blaze Kessler PhD','2018-10-30 03:31:48','2018-10-30 03:31:48'),(17,27,'3724','Mr. Ladarius Crooks','Akeem Jacobson','2018-10-30 03:31:48','2018-10-30 03:31:48'),(18,5,'11814','Cordia Goyette','Arvel Stehr','2018-10-30 03:31:48','2018-10-30 03:31:48'),(19,29,'30103','Heidi Schultz','Amos Walsh','2018-10-30 03:31:49','2018-10-30 03:31:49'),(20,22,'20441','Micah Nicolas PhD','Rey Donnelly','2018-10-30 03:31:49','2018-10-30 03:31:49'),(21,7,'18166','Felicity Simonis','Jayda Douglas','2018-10-30 03:31:49','2018-10-30 03:31:49'),(22,22,'9704','Jerod Murray','Gunnar Torphy Jr.','2018-10-30 03:31:49','2018-10-30 03:31:49'),(23,30,'18317','Deon Langosh PhD','Prof. Bonita Nikolaus','2018-10-30 03:31:49','2018-10-30 03:31:49'),(24,28,'17583','Mr. Arden Larkin II','America Zieme','2018-10-30 03:31:49','2018-10-30 03:31:49'),(25,10,'29610','Adele Kemmer','Meda Emard','2018-10-30 03:31:49','2018-10-30 03:31:49'),(26,2,'22510','Prof. Eliseo Mueller','Dr. Alexandra Witting MD','2018-10-30 03:31:49','2018-10-30 03:31:49'),(27,7,'11839','Courtney Fritsch','Ambrose Luettgen IV','2018-10-30 03:31:49','2018-10-30 03:31:49'),(28,29,'11944','Prof. Hillard Kautzer','Dr. Jeremie Simonis','2018-10-30 03:31:49','2018-10-30 03:31:49'),(29,2,'26223','Cruz Wiegand','Jillian Wiegand II','2018-10-30 03:31:49','2018-10-30 03:31:49'),(30,7,'29964','Kellie Lindgren','Bud Shields','2018-10-30 03:31:49','2018-10-30 03:31:49'),(31,21,'15095','Mrs. Lia Baumbach','Mrs. Anna Steuber','2018-10-30 03:31:49','2018-10-30 03:31:49'),(32,12,'16776','Danial Bogan','Garland Kuvalis DVM','2018-10-30 03:31:49','2018-10-30 03:31:49'),(33,4,'28488','Woodrow Hessel','Alexandre Mosciski','2018-10-30 03:31:49','2018-10-30 03:31:49'),(34,26,'4917','Jadon D\'Amore','Walton Greenholt','2018-10-30 03:31:49','2018-10-30 03:31:49'),(35,4,'19521','Chelsie Stark','Dr. Brant Wiegand DVM','2018-10-30 03:31:49','2018-10-30 03:31:49'),(36,4,'10955','Weston Harvey','Mrs. Zita Bins IV','2018-10-30 03:31:49','2018-10-30 03:31:49'),(37,15,'14672','Miss Alexandrine Hill IV','Prof. Luz Wisoky','2018-10-30 03:31:49','2018-10-30 03:31:49'),(38,2,'6240','Dr. Marcel Hyatt','Elenora Considine','2018-10-30 03:31:49','2018-10-30 03:31:49'),(39,29,'27291','Beau Anderson','Whitney Lynch','2018-10-30 03:31:49','2018-10-30 03:31:49'),(40,1,'11628','Dr. Bonita Harber','Pierce Larkin','2018-10-30 03:31:49','2018-10-30 03:31:49'),(41,7,'21659','Salma Buckridge','Mr. Giles Cremin','2018-10-30 03:31:49','2018-10-30 03:31:49'),(42,24,'6689','Prof. Jay Miller IV','Reva Sporer','2018-10-30 03:31:49','2018-10-30 03:31:49'),(43,5,'18629','Adriel Kulas','Doris Murphy','2018-10-30 03:31:49','2018-10-30 03:31:49'),(44,15,'23954','Dr. Jayce O\'Reilly DVM','Samson Kuhic V','2018-10-30 03:31:49','2018-10-30 03:31:49'),(45,12,'15469','Cleo Sanford','Logan Fritsch','2018-10-30 03:31:49','2018-10-30 03:31:49'),(46,17,'29678','Nathan Steuber','Mohamed McDermott','2018-10-30 03:31:49','2018-10-30 03:31:49'),(47,1,'15835','Lysanne Kihn','Donavon Franecki','2018-10-30 03:31:49','2018-10-30 03:31:49'),(48,14,'20741','Alvina Paucek','Burley Casper','2018-10-30 03:31:49','2018-10-30 03:31:49'),(49,14,'15833','Damaris Sipes','Ettie Williamson','2018-10-30 03:31:49','2018-10-30 03:31:49'),(50,19,'7498','Rocio Bechtelar','Mrs. Hollie Hessel','2018-10-30 03:31:49','2018-10-30 03:31:49'),(51,13,'5555','Cielo Goodwin III','Alize Wilkinson','2018-10-30 03:31:49','2018-10-30 03:31:49'),(52,3,'23320','Ms. Itzel Olson Sr.','Bianka Franecki','2018-10-30 03:31:49','2018-10-30 03:31:49'),(53,30,'31131','Amiya Medhurst','Ansley Blick','2018-10-30 03:31:49','2018-10-30 03:31:49'),(54,22,'21796','Prof. Casper Goldner','Yasmine Mosciski','2018-10-30 03:31:50','2018-10-30 03:31:50'),(55,2,'7780','Prof. Rosa Weimann','Ena Wilkinson','2018-10-30 03:31:50','2018-10-30 03:31:50'),(56,11,'32258','Maya Baumbach DDS','Doris Schamberger DVM','2018-10-30 03:31:50','2018-10-30 03:31:50'),(57,21,'7135','Mrs. Barbara Hand','Dorian Legros','2018-10-30 03:31:50','2018-10-30 03:31:50'),(58,1,'11742','Gilbert Murphy I','Ms. Adell Jacobs','2018-10-30 03:31:50','2018-10-30 03:31:50'),(59,26,'9039','Christine Turner','Toby Rowe II','2018-10-30 03:31:50','2018-10-30 03:31:50'),(60,25,'1323','Santiago Cruickshank','Prof. Schuyler Ullrich','2018-10-30 03:31:50','2018-10-30 03:31:50'),(61,8,'8258','Simeon Beahan','Dr. Daren Hagenes','2018-10-30 03:31:50','2018-10-30 03:31:50'),(62,2,'21982','Prof. Stuart Bogan DDS','Brent Stracke','2018-10-30 03:31:50','2018-10-30 03:31:50'),(63,20,'14903','Jerrold Schuster','Erik Zulauf','2018-10-30 03:31:50','2018-10-30 03:31:50'),(64,14,'20308','Ashlee Kuhlman','King Zemlak DDS','2018-10-30 03:31:50','2018-10-30 03:31:50'),(65,30,'27785','Shemar Grant V','Michaela Kiehn','2018-10-30 03:31:50','2018-10-30 03:31:50'),(66,14,'9655','Antonio Dickinson','Marcelina Greenholt','2018-10-30 03:31:50','2018-10-30 03:31:50'),(67,17,'20569','Boyd Anderson DVM','Alexzander Sporer Sr.','2018-10-30 03:31:50','2018-10-30 03:31:50'),(68,13,'12235','Prof. Gerhard Borer','Federico Stroman','2018-10-30 03:31:50','2018-10-30 03:31:50'),(69,16,'18349','Prof. Murphy Nienow III','Prof. Florence Tromp','2018-10-30 03:31:50','2018-10-30 03:31:50'),(70,13,'25407','Prof. Shanel Haley Jr.','Clinton Carter','2018-10-30 03:31:50','2018-10-30 03:31:50'),(71,2,'10076','Dr. Salvador Spinka','Eliezer Swift Jr.','2018-10-30 03:31:50','2018-10-30 03:31:50'),(72,14,'2235','Prof. Carmelo Goldner PhD','Vicky Stiedemann','2018-10-30 03:31:50','2018-10-30 03:31:50'),(73,5,'7591','Dr. Margaret Hackett MD','Trinity Barton MD','2018-10-30 03:31:50','2018-10-30 03:31:50'),(74,30,'33634','Prof. Lindsey Kohler DDS','Brenden Murray','2018-10-30 03:31:50','2018-10-30 03:31:50'),(75,28,'15649','Marcelino Morar','Roscoe Goodwin','2018-10-30 03:31:50','2018-10-30 03:31:50'),(76,27,'15986','Dr. Cathrine Hettinger MD','Letitia Glover','2018-10-30 03:31:50','2018-10-30 03:31:50'),(77,7,'8974','Marjory Lemke','Miss Cali Prosacco','2018-10-30 03:31:50','2018-10-30 03:31:50'),(78,17,'2861','Olga Stanton','Therese Mann DVM','2018-10-30 03:31:50','2018-10-30 03:31:50'),(79,28,'2595','Dr. Reinhold Okuneva IV','Earnest Wunsch','2018-10-30 03:31:50','2018-10-30 03:31:50'),(80,1,'20053','Abagail Cummings','Miles Mayert','2018-10-30 03:31:50','2018-10-30 03:31:50'),(81,9,'3620','Miss Jennifer Kertzmann','Percival Predovic','2018-10-30 03:31:50','2018-10-30 03:31:50'),(82,4,'22833','Eriberto Windler','Raquel Blanda DVM','2018-10-30 03:31:50','2018-10-30 03:31:50'),(83,4,'31861','Luella Wilderman','Allene Gutkowski','2018-10-30 03:31:50','2018-10-30 03:31:50'),(84,2,'7601','Annamae Shanahan','Prof. Carter Grimes','2018-10-30 03:31:50','2018-10-30 03:31:50'),(85,29,'12427','Demetris Morissette','Fletcher Streich','2018-10-30 03:31:50','2018-10-30 03:31:50'),(86,23,'5726','Antwan Braun','Zena Gislason','2018-10-30 03:31:50','2018-10-30 03:31:50'),(87,2,'26209','Nora Schroeder','Neoma O\'Kon','2018-10-30 03:31:50','2018-10-30 03:31:50'),(88,12,'24597','Robin Adams','Danny Hoeger','2018-10-30 03:31:50','2018-10-30 03:31:50'),(89,4,'13477','Jamal Jast II','Aubrey Runte','2018-10-30 03:31:50','2018-10-30 03:31:50'),(90,12,'11125','Savanah Kautzer','Litzy Marvin','2018-10-30 03:31:50','2018-10-30 03:31:50');
/*!40000 ALTER TABLE `master_buildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_colonies`
--

DROP TABLE IF EXISTS `master_colonies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_colonies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ward_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_colonies_ward_id_foreign` (`ward_id`),
  CONSTRAINT `master_colonies_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `master_wards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_colonies`
--

LOCK TABLES `master_colonies` WRITE;
/*!40000 ALTER TABLE `master_colonies` DISABLE KEYS */;
INSERT INTO `master_colonies` VALUES (1,1,'Prof. Al Tillman','Elna Kunde','2018-10-30 03:31:47','2018-10-30 03:31:47'),(2,5,'Mr. Lloyd Kutch','Prof. Daniella Emmerich','2018-10-30 03:31:47','2018-10-30 03:31:47'),(3,7,'Dr. Angel Fritsch II','Mrs. Stacey Spinka','2018-10-30 03:31:47','2018-10-30 03:31:47'),(4,4,'Jeffry Hills V','Kathryne Rohan','2018-10-30 03:31:47','2018-10-30 03:31:47'),(5,4,'Drake Stanton DDS','Myrtle Predovic','2018-10-30 03:31:47','2018-10-30 03:31:47'),(6,8,'Quinten Dietrich III','Prof. Cierra Kovacek','2018-10-30 03:31:47','2018-10-30 03:31:47'),(7,4,'Shaniya Russel Jr.','Armando Wintheiser','2018-10-30 03:31:47','2018-10-30 03:31:47'),(8,10,'Nolan Reichert MD','Prof. Asa Leffler','2018-10-30 03:31:47','2018-10-30 03:31:47'),(9,7,'Loraine Smith','Una Tromp','2018-10-30 03:31:47','2018-10-30 03:31:47'),(10,7,'Mrs. Ruby Kozey','Lon Kuvalis','2018-10-30 03:31:47','2018-10-30 03:31:47'),(11,8,'Waino Smith','Mr. Amari Waters II','2018-10-30 03:31:47','2018-10-30 03:31:47'),(12,7,'Dr. Tyrique O\'Keefe IV','Johnpaul Spinka','2018-10-30 03:31:47','2018-10-30 03:31:47'),(13,4,'Amos Kilback','Madilyn Crist II','2018-10-30 03:31:47','2018-10-30 03:31:47'),(14,8,'Kirsten Schultz','Dr. Torrance Luettgen','2018-10-30 03:31:47','2018-10-30 03:31:47'),(15,2,'Elenora Schuster','Rosalee Feeney','2018-10-30 03:31:47','2018-10-30 03:31:47'),(16,9,'Ms. Orie Howell IV','Lonie Runolfsdottir','2018-10-30 03:31:47','2018-10-30 03:31:47'),(17,7,'Dr. Deven Wisozk DVM','Prof. Ivy Ziemann','2018-10-30 03:31:47','2018-10-30 03:31:47'),(18,5,'Angelita Waelchi','Rosetta Hand DDS','2018-10-30 03:31:47','2018-10-30 03:31:47'),(19,1,'Nils Stamm','Prof. Loy King MD','2018-10-30 03:31:47','2018-10-30 03:31:47'),(20,1,'Amy Von','Prof. Ismael Price IV','2018-10-30 03:31:47','2018-10-30 03:31:47'),(21,3,'Geo Williamson','Prof. Derrick Cartwright','2018-10-30 03:31:47','2018-10-30 03:31:47'),(22,7,'Gerardo Mann','Lucie Howell','2018-10-30 03:31:47','2018-10-30 03:31:47'),(23,1,'Candace Buckridge','Jeanette Brekke','2018-10-30 03:31:47','2018-10-30 03:31:47'),(24,7,'Forrest Thiel','Leola Bednar','2018-10-30 03:31:47','2018-10-30 03:31:47'),(25,4,'Mrs. Helen Armstrong III','Lesly Walker Sr.','2018-10-30 03:31:47','2018-10-30 03:31:47'),(26,4,'Stefan Predovic MD','Jennie Franecki','2018-10-30 03:31:47','2018-10-30 03:31:47'),(27,4,'Jeramy Ankunding','Prof. Jayda Thompson IV','2018-10-30 03:31:48','2018-10-30 03:31:48'),(28,5,'Coty Ruecker','Prof. Dianna Cormier II','2018-10-30 03:31:48','2018-10-30 03:31:48'),(29,3,'Griffin Brown V','Noe Wiegand','2018-10-30 03:31:48','2018-10-30 03:31:48'),(30,2,'Ludwig Bednar','Rosamond Witting Jr.','2018-10-30 03:31:48','2018-10-30 03:31:48');
/*!40000 ALTER TABLE `master_colonies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_email_templates`
--

DROP TABLE IF EXISTS `master_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_email_templates`
--

LOCK TABLES `master_email_templates` WRITE;
/*!40000 ALTER TABLE `master_email_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_layout`
--

DROP TABLE IF EXISTS `master_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_layout` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layout_name` longtext COLLATE utf8mb4_unicode_ci,
  `division` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_layout`
--

LOCK TABLES `master_layout` WRITE;
/*!40000 ALTER TABLE `master_layout` DISABLE KEYS */;
INSERT INTO `master_layout` VALUES (1,'Samata Nagar, Kandivali(E)','Borivali','Mumbai',NULL,NULL);
/*!40000 ALTER TABLE `master_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_month`
--

DROP TABLE IF EXISTS `master_month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_month` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `month_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_month`
--

LOCK TABLES `master_month` WRITE;
/*!40000 ALTER TABLE `master_month` DISABLE KEYS */;
INSERT INTO `master_month` VALUES (1,'January','2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'February','2018-10-30 03:31:17','2018-10-30 03:31:17'),(3,'March','2018-10-30 03:31:17','2018-10-30 03:31:17'),(4,'April','2018-10-30 03:31:17','2018-10-30 03:31:17'),(5,'May','2018-10-30 03:31:17','2018-10-30 03:31:17'),(6,'June','2018-10-30 03:31:17','2018-10-30 03:31:17'),(7,'July','2018-10-30 03:31:17','2018-10-30 03:31:17'),(8,'August','2018-10-30 03:31:17','2018-10-30 03:31:17'),(9,'September','2018-10-30 03:31:17','2018-10-30 03:31:17'),(10,'October','2018-10-30 03:31:17','2018-10-30 03:31:17'),(11,'November','2018-10-30 03:31:17','2018-10-30 03:31:17'),(12,'December','2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `master_month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_rti_status`
--

DROP TABLE IF EXISTS `master_rti_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_rti_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_rti_status`
--

LOCK TABLES `master_rti_status` WRITE;
/*!40000 ALTER TABLE `master_rti_status` DISABLE KEYS */;
INSERT INTO `master_rti_status` VALUES (1,'Send RTI Officer','2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'In Process/Waiting for Meeting Schedule Time','2018-10-30 03:31:17','2018-10-30 03:31:17'),(3,'Meeting is Scheduled','2018-10-30 03:31:17','2018-10-30 03:31:17'),(4,'Closed','2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `master_rti_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_society_bill_level`
--

DROP TABLE IF EXISTS `master_society_bill_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_society_bill_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_society_bill_level`
--

LOCK TABLES `master_society_bill_level` WRITE;
/*!40000 ALTER TABLE `master_society_bill_level` DISABLE KEYS */;
INSERT INTO `master_society_bill_level` VALUES (1,'Society Level Billing','Society Level Billing',NULL,NULL),(2,'Tenant Level Billing','Tenant Level Billing',NULL,NULL);
/*!40000 ALTER TABLE `master_society_bill_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_tenant_type`
--

DROP TABLE IF EXISTS `master_tenant_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_tenant_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_tenant_type`
--

LOCK TABLES `master_tenant_type` WRITE;
/*!40000 ALTER TABLE `master_tenant_type` DISABLE KEYS */;
INSERT INTO `master_tenant_type` VALUES (1,'LIG','LIG',NULL,NULL),(2,'EWS','EWS',NULL,NULL),(3,'MIG','MIG',NULL,NULL),(4,'HIG','HIG',NULL,NULL);
/*!40000 ALTER TABLE `master_tenant_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_tenants`
--

DROP TABLE IF EXISTS `master_tenants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_tenants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `building_id` int(10) unsigned NOT NULL,
  `flat_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salutation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carpet_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_tenants_building_id_foreign` (`building_id`),
  CONSTRAINT `master_tenants_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_tenants`
--

LOCK TABLES `master_tenants` WRITE;
/*!40000 ALTER TABLE `master_tenants` DISABLE KEYS */;
INSERT INTO `master_tenants` VALUES (1,89,'3471','Shri','Maritza','Adrianna','Lindsay','287.681.4988','ikonopelski@swaniawski.com','Residential','788','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(2,85,'6859','Shri','Stella','Pansy','Elza','(417) 444-9050 x45687','sigmund.buckridge@gmail.com','Residential','712','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(3,78,'5235','Shri','Willa','Roderick','Margot','734.639.0042 x3898','hadley04@yahoo.com','Residential','395','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(4,56,'5071','Shri','Corbin','Louie','Lucy','1-438-620-6945 x4467','ashleigh.corkery@gmail.com','Residential','939','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(5,45,'8402','Shri','Orville','Ila','Darrin','+17485926620','lraynor@thompson.com','Residential','389','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(6,43,'6242','Shri','Nels','Mack','Olga','398.327.4201 x690','dereck.beier@flatley.com','Residential','871','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(7,67,'5799','Shri','Kayden','Myrna','Stan','489-604-5488','jframi@mante.com','Residential','346','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(8,41,'3001','Shri','Jo','Aileen','Mathilde','1-858-808-1856 x58826','russel.abbey@hotmail.com','Residential','643','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(9,53,'9520','Shri','Zita','Georgianna','Daren','+1 (223) 648-3589','yasmeen64@gmail.com','Residential','340','2','2018-10-30 03:31:51','2018-10-30 03:31:51'),(10,60,'9389','Shri','Arnold','Kaitlyn','Jewell','1-292-646-9028 x809','orenner@gerlach.biz','Residential','943','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(11,12,'5469','Shri','Suzanne','Kyleigh','Dahlia','(498) 577-0181 x71672','stanton.talon@reinger.com','Residential','888','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(12,18,'9138','Shri','Melvin','Carmine','Hilario','(617) 797-5353 x3198','darren.parisian@yahoo.com','Residential','513','2','2018-10-30 03:31:51','2018-10-30 03:31:51'),(13,89,'4783','Shri','Alessandra','Roel','Anjali','(549) 255-9725 x3498','katharina.cormier@okuneva.com','Residential','465','3','2018-10-30 03:31:51','2018-10-30 03:31:51'),(14,6,'7636','Shri','Dora','Timothy','Geo','+1.552.966.5277','treutel.garnett@gmail.com','Residential','960','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(15,73,'449','Shri','Lorena','Alia','Camden','(991) 931-1868','tfritsch@yahoo.com','Residential','727','3','2018-10-30 03:31:51','2018-10-30 03:31:51'),(16,33,'5234','Shri','Laverna','Kayleigh','Mariane','862.745.4555','williamson.reid@wisozk.com','Residential','629','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(17,56,'3937','Shri','Leonora','Arne','Albertha','957.747.7910 x23403','zlangosh@gmail.com','Residential','672','3','2018-10-30 03:31:51','2018-10-30 03:31:51'),(18,53,'886','Shri','Benny','Zaria','Millie','1-471-668-9909','sigrid37@ortiz.com','Residential','715','2','2018-10-30 03:31:51','2018-10-30 03:31:51'),(19,81,'382','Shri','Hank','Elna','Keshaun','1-278-836-1808','eichmann.giovani@pfeffer.org','Residential','892','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(20,38,'6078','Shri','Thora','Abraham','Veronica','+1-441-620-1183','pouros.cheyanne@yahoo.com','Residential','372','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(21,3,'2679','Shri','Percy','Lenore','Gertrude','806.255.8433','ressie86@gmail.com','Residential','877','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(22,8,'1481','Shri','Mckayla','Mark','Tressie','1-674-562-6518 x130','zpadberg@ziemann.com','Residential','838','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(23,44,'5306','Shri','Kristoffer','Elouise','Hattie','1-609-499-1393 x17960','shaniya.harvey@yahoo.com','Residential','378','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(24,71,'6328','Shri','Orion','Jarred','Scot','(759) 319-1173','krystel.rau@gmail.com','Residential','789','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(25,25,'5347','Shri','Christa','Virginia','Leonie','+1.407.229.1138','yabbott@schiller.com','Residential','723','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(26,76,'2063','Shri','Ashleigh','Shaun','Javonte','(409) 650-4149 x5155','weber.emilio@yahoo.com','Residential','442','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(27,41,'5127','Shri','Modesto','Maybelle','Gino','+1-717-777-1450','lesly.crona@gmail.com','Residential','442','1','2018-10-30 03:31:51','2018-10-30 03:31:51'),(28,8,'210','Shri','Jany','Rhea','Danika','+1 (667) 626-8109','ward.ethel@harber.biz','Residential','407','3','2018-10-30 03:31:51','2018-10-30 03:31:51'),(29,68,'6747','Shri','Zion','Roman','Damaris','1-231-214-0324 x915','dpagac@gmail.com','Residential','357','4','2018-10-30 03:31:51','2018-10-30 03:31:51'),(30,66,'7561','Shri','Cindy','Ken','Willy','(469) 396-9024 x77671','rosalinda28@schamberger.com','Residential','985','2','2018-10-30 03:31:51','2018-10-30 03:31:51'),(31,47,'8284','Shri','Walton','Georgianna','Asha','827.568.9630 x31968','reta.herman@yahoo.com','Residential','650','2','2018-10-30 03:31:51','2018-10-30 03:31:51'),(32,51,'3615','Shri','Amina','Amaya','Amira','(348) 475-4683 x04662','pherzog@hotmail.com','Residential','906','2','2018-10-30 03:31:51','2018-10-30 03:31:51'),(33,63,'306','Shri','Pink','Jennifer','Cleo','(915) 933-6287 x399','wwilderman@hermann.net','Residential','408','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(34,14,'8236','Shri','Ahmed','Unique','Daphne','+1.946.799.0210','prosacco.cielo@kuhic.com','Residential','434','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(35,80,'9333','Shri','Vince','Rex','Vincenza','802-371-2861 x9460','sheldon.fisher@botsford.com','Residential','595','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(36,73,'6626','Shri','Deondre','Liliana','Arthur','747-981-3926 x767','ishanahan@abbott.com','Residential','873','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(37,1,'9374','Shri','Sincere','Vernie','Adriel','1-795-917-6234 x91989','omclaughlin@little.info','Residential','513','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(38,52,'6548','Shri','Seamus','Marcel','Ephraim','380.328.0775 x6892','doyle.arnulfo@hotmail.com','Residential','928','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(39,71,'8082','Shri','Zackery','Alexandrine','Helga','1-498-532-1430','jbins@dickinson.org','Residential','355','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(40,84,'4539','Shri','Josefina','Roderick','Keagan','+1-260-607-7563','michelle31@gmail.com','Residential','864','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(41,39,'3408','Shri','Beverly','Nathen','Eddie','+1-494-505-8138','turcotte.chandler@gmail.com','Residential','319','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(42,81,'3621','Shri','Bernie','Ari','Melany','+1.290.802.7781','dangelo92@jacobi.biz','Residential','967','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(43,12,'562','Shri','Tamia','Melyssa','Casimer','+1-840-503-4647','tressa29@bergnaum.net','Residential','443','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(44,22,'5914','Shri','Dallas','Glennie','Antoinette','440-576-5622','xpacocha@yahoo.com','Residential','666','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(45,38,'1582','Shri','Lea','Brody','Boris','+1.302.471.7484','mabel.cassin@hotmail.com','Residential','461','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(46,33,'4723','Shri','Albin','Eileen','Trace','1-671-418-6291 x5377','hbatz@mohr.com','Residential','345','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(47,30,'1386','Shri','River','Clay','Roscoe','+1-303-491-8441','rolson@yahoo.com','Residential','847','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(48,76,'6256','Shri','Jena','Jimmie','Brendan','(971) 953-5139','jamaal.dach@pacocha.biz','Residential','556','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(49,78,'6365','Shri','Elenora','Cindy','Samantha','(314) 927-2815','zconnelly@medhurst.com','Residential','735','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(50,77,'8127','Shri','Berenice','Mossie','Chet','947.223.0756','blick.jazlyn@hotmail.com','Residential','796','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(51,72,'6756','Shri','Bettye','Paris','Ashlynn','+1.218.937.9760','labadie.justen@yahoo.com','Residential','514','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(52,50,'6978','Shri','Preston','Brant','Earnestine','942.625.5158 x4948','danyka60@gmail.com','Residential','611','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(53,54,'9575','Shri','Renee','Glennie','Gilberto','(216) 724-8282 x8834','teagan41@yahoo.com','Residential','891','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(54,60,'3829','Shri','Cleve','Dorothy','Sofia','+15689036946','gschmidt@hotmail.com','Residential','800','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(55,11,'5002','Shri','Lourdes','Sammie','Graham','932-700-1231','kerluke.brayan@hotmail.com','Residential','865','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(56,83,'1065','Shri','Stevie','Maybell','Kaycee','825.446.6467 x3142','nickolas.gutmann@leffler.com','Residential','786','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(57,8,'2804','Shri','Lorine','Clovis','Niko','204-533-8299 x011','jennings.feil@will.com','Residential','409','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(58,44,'1259','Shri','Katrine','Mortimer','Narciso','(881) 821-7093','ruecker.lindsay@gmail.com','Residential','886','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(59,47,'3275','Shri','Mallory','Clare','Michaela','213-348-0264 x5453','stephen70@gmail.com','Residential','762','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(60,8,'7413','Shri','Providenci','Lauriane','Keshaun','814.599.7788','shanel.hodkiewicz@gmail.com','Residential','403','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(61,33,'6105','Shri','Horace','Mark','Bud','1-282-518-4497','schneider.mose@hotmail.com','Residential','951','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(62,85,'1224','Shri','Jason','Mina','Summer','537.429.2937 x0147','hansen.elmer@gmail.com','Residential','364','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(63,75,'3261','Shri','Jaren','Dandre','Gunner','+1-969-420-5151','shanny75@gmail.com','Residential','568','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(64,8,'5778','Shri','Letha','Isabelle','Cora','(761) 269-2741 x463','mbernhard@yahoo.com','Residential','743','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(65,88,'6195','Shri','Dina','Ricky','Kamryn','1-567-596-9892','streich.cory@graham.biz','Residential','832','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(66,23,'6084','Shri','Adan','Gilbert','Polly','450-646-9079 x5423','justina35@gmail.com','Residential','924','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(67,83,'6769','Shri','Maya','Audreanne','Zita','279.415.6237 x633','streich.else@spencer.net','Residential','797','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(68,67,'2585','Shri','Laurianne','Buster','Darrel','1-835-740-4418','elliott84@yahoo.com','Residential','811','3','2018-10-30 03:31:52','2018-10-30 03:31:52'),(69,38,'5312','Shri','Pauline','Hermina','Ila','1-784-333-5058 x659','cleora25@yahoo.com','Residential','760','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(70,3,'8428','Shri','Dexter','Maurine','Miles','1-379-668-5763 x4970','destini26@boyle.org','Residential','408','2','2018-10-30 03:31:52','2018-10-30 03:31:52'),(71,72,'7141','Shri','Linda','Linnie','Aidan','754-552-3277','shayne.donnelly@hotmail.com','Residential','484','1','2018-10-30 03:31:52','2018-10-30 03:31:52'),(72,54,'4268','Shri','Alyce','Carmella','Providenci','262-429-6445','loma45@vonrueden.info','Residential','378','4','2018-10-30 03:31:52','2018-10-30 03:31:52'),(73,88,'6515','Shri','Brendan','Rae','Lexi','771-517-7126','wbernier@hotmail.com','Residential','922','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(74,85,'8259','Shri','Vivian','Zoila','Devan','(386) 892-0835 x8587','johanna78@gmail.com','Residential','573','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(75,70,'7904','Shri','Jazmyn','Gilbert','Bria','967.327.0324','jwillms@murphy.com','Residential','826','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(76,88,'7824','Shri','Jerry','Jasper','Shanelle','561-945-6619','pstiedemann@price.biz','Residential','422','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(77,2,'163','Shri','Clotilde','Marjorie','Leda','653.991.4670 x65725','twyman@jacobson.com','Residential','330','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(78,65,'3076','Shri','Ashley','Cornell','Constantin','+1 (626) 390-7952','georgette.treutel@yahoo.com','Residential','586','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(79,67,'9464','Shri','Claudine','Adrain','Naomie','(253) 329-1299','luisa.monahan@roberts.com','Residential','337','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(80,18,'3613','Shri','Gina','Durward','Jaiden','356.309.0576 x9676','luciano.hudson@hotmail.com','Residential','380','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(81,30,'1366','Shri','Ari','Alaina','Dandre','781.274.3232 x9343','jacobs.alycia@hotmail.com','Residential','336','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(82,26,'8981','Shri','Hettie','Audreanne','Alfredo','280.684.9076 x351','sheila08@muller.biz','Residential','517','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(83,67,'4432','Shri','Mozell','Lon','Myrna','503.760.6436','howe.dereck@gmail.com','Residential','462','3','2018-10-30 03:31:53','2018-10-30 03:31:53'),(84,59,'7748','Shri','Philip','Paige','Jana','+13407186912','addison77@hand.com','Residential','895','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(85,38,'3821','Shri','Madisyn','Liliane','Armando','+1-795-961-3481','jacey.mills@yahoo.com','Residential','410','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(86,65,'4555','Shri','Elena','Kaylee','Carmel','915.324.3238 x7336','brandon.rosenbaum@hotmail.com','Residential','667','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(87,84,'5099','Shri','Layla','Gene','Mireille','(367) 758-0173','rory.lebsack@yahoo.com','Residential','679','3','2018-10-30 03:31:53','2018-10-30 03:31:53'),(88,18,'8620','Shri','Elwyn','Marlin','Karen','1-361-809-9407 x57251','ekoss@runte.info','Residential','945','4','2018-10-30 03:31:53','2018-10-30 03:31:53'),(89,18,'9506','Shri','Deshaun','Pattie','Judah','1-241-289-2718 x588','jarrett.hoppe@daniel.com','Residential','484','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(90,82,'8334','Shri','Nicolas','Okey','Keon','348.738.3650 x585','deckow.felicita@hotmail.com','Residential','722','4','2018-10-30 03:31:53','2018-10-30 03:31:53'),(91,13,'3124','Shri','Juana','Kasey','Daija','+1 (224) 458-0196','annetta.johnson@gmail.com','Residential','465','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(92,57,'8348','Shri','Taurean','Beulah','Layne','1-537-645-3455 x204','nolan.johnathon@gmail.com','Residential','413','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(93,56,'4375','Shri','Nona','Tyshawn','Margaret','+1 (362) 625-9003','imetz@yahoo.com','Residential','802','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(94,62,'6843','Shri','Cassidy','Cassandre','Suzanne','1-247-767-9965','emmerich.eloy@hotmail.com','Residential','820','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(95,77,'5092','Shri','General','Florine','Ellie','+1-859-626-1014','consuelo02@schoen.biz','Residential','954','2','2018-10-30 03:31:53','2018-10-30 03:31:53'),(96,32,'2557','Shri','Candelario','Teresa','Alberto','843.581.0991 x97506','beer.caleigh@hotmail.com','Residential','745','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(97,8,'7467','Shri','Peter','Ariane','Julian','630.277.4923','cleo.jenkins@littel.info','Residential','439','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(98,89,'9438','Shri','Orion','Stacy','Frederique','246.925.9076 x2145','orrin32@gmail.com','Residential','375','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(99,65,'4426','Shri','Boris','Enrique','Michaela','321.461.4633','sonia44@yahoo.com','Residential','704','1','2018-10-30 03:31:53','2018-10-30 03:31:53'),(100,10,'7906','Shri','Janae','Adolfo','Leatha','1-254-499-0683 x8296','arnaldo18@russel.com','Residential','622','3','2018-10-30 03:31:53','2018-10-30 03:31:53');
/*!40000 ALTER TABLE `master_tenants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_wards`
--

DROP TABLE IF EXISTS `master_wards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_wards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layout_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_wards_layout_id_foreign` (`layout_id`),
  CONSTRAINT `master_wards_layout_id_foreign` FOREIGN KEY (`layout_id`) REFERENCES `master_layout` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_wards`
--

LOCK TABLES `master_wards` WRITE;
/*!40000 ALTER TABLE `master_wards` DISABLE KEYS */;
INSERT INTO `master_wards` VALUES (1,1,'Mrs. Kara Gorczany','Wyman Sauer','2018-10-30 03:31:47','2018-10-30 03:31:47'),(2,1,'Kylee Mraz','Lenora Emard','2018-10-30 03:31:47','2018-10-30 03:31:47'),(3,1,'Prof. Garrison Heathcote','Lindsey McDermott','2018-10-30 03:31:47','2018-10-30 03:31:47'),(4,1,'Quinn Kilback','Jamil Kling','2018-10-30 03:31:47','2018-10-30 03:31:47'),(5,1,'Lela Tremblay','Mr. D\'angelo Langosh II','2018-10-30 03:31:47','2018-10-30 03:31:47'),(6,1,'Ms. Veronica Luettgen Sr.','Gussie Schoen','2018-10-30 03:31:47','2018-10-30 03:31:47'),(7,1,'Lisandro Torphy','Prof. Modesta Erdman','2018-10-30 03:31:47','2018-10-30 03:31:47'),(8,1,'Joany Walker','Mr. Kurt Deckow','2018-10-30 03:31:47','2018-10-30 03:31:47'),(9,1,'Prince Reichel','Mrs. Michele McLaughlin Jr.','2018-10-30 03:31:47','2018-10-30 03:31:47'),(10,1,'Jimmie Schimmel','Karlie Collier PhD','2018-10-30 03:31:47','2018-10-30 03:31:47');
/*!40000 ALTER TABLE `master_wards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_08_20_142459_create_board_table',1),(4,'2018_08_20_142849_create_departments_table',1),(5,'2018_08_20_144538_create_faqs_table',1),(6,'2018_08_20_150324_create_board_departments_table',1),(7,'2018_08_21_055217_alter_faqs_rename_deptname_to_question',1),(8,'2018_08_22_090450_create_frontend_users_table',1),(9,'2018_08_22_133448_create_table_resolution_types',1),(10,'2018_08_22_133449_create_table_resolutions',1),(11,'2018_08_22_135352_create_rti_form_table',1),(12,'2018_08_23_070343_create_table_deleted_resolutions',1),(13,'2018_08_24_121710_alter_rti_form_table_add_unique_field',1),(14,'2018_08_26_161705_alter_rti_fom_table_make_poerty_file_nullable',1),(15,'2018_08_27_115459_create_hearing_application_type',1),(16,'2018_08_27_121033_create_hearing_status',1),(17,'2018_08_27_121805_create_hearing_table',1),(18,'2018_08_29_063730_create_schedule_hearing_table',1),(19,'2018_08_30_063609_create_pre_post_schedule_table',1),(20,'2018_08_30_064205_create_rti_schedule_meeting_table',1),(21,'2018_08_30_120317_add_user_id_to_rti_form_table',1),(22,'2018_08_30_132915_create_master_rti_status',1),(23,'2018_08_30_134316_add_status_rti_form_table',1),(24,'2018_08_30_140429_create_upload_case_judgement_table',1),(25,'2018_08_31_043327_add_send_info_fields_rti_form_table',1),(26,'2018_08_31_052231_add_user_id_rti_form_table',1),(27,'2018_08_31_061605_add_rti_remark_forward_application_rti_form_table',1),(28,'2018_08_31_064811_add_board_id_to_hearing_table',1),(29,'2018_08_31_065843_alter_rti_schedule_meetings_application_no_table',1),(30,'2018_08_31_092607_create_deleted_hearing_table',1),(31,'2018_08_31_095842_create_forward_case_table',1),(32,'2018_08_31_100703_create_rti_status_table',1),(33,'2018_08_31_104117_alter_status_rti_form_table',1),(34,'2018_08_31_111937_alter_status_col_rti_form_table',1),(35,'2018_08_31_123310_final_drop_rti_status_id_rti_form_table',1),(36,'2018_08_31_123356_add_rti_status_id_rti_form_table',1),(37,'2018_08_31_123756_create_send_notice_to_appellant_table',1),(38,'2018_08_31_133408_drop_rti_send_info_fields_rti_form_table',1),(39,'2018_08_31_135124_create_rti_send_info_table',1),(40,'2018_08_31_140033_add_rti_send_info_id_rti_form_table',1),(41,'2018_09_01_041314_create_rti_forward_application_table',1),(42,'2018_09_01_042046_drop_remarks_rti_form_table',1),(43,'2018_09_01_042235_add_rti_forward_application_id_rti_form_table',1),(44,'2018_09_01_044544_add_filename_column_to_forward_case',1),(45,'2018_09_01_055059_create_land_source_table',1),(46,'2018_09_01_061007_create_other_land_table',1),(47,'2018_09_01_075702_create_village_detail_table',1),(48,'2018_09_01_075818_create_society_detail_table',1),(49,'2018_09_01_075828_create_lease_detail_table',1),(50,'2018_09_01_094805_add_mobile_no_users_table',1),(51,'2018_09_01_095427_create_architect_application_table',1),(52,'2018_09_01_095701_add_address_users_table',1),(53,'2018_09_01_113159_create_architect_application_marks_table',1),(54,'2018_09_01_120744_create_architect_application_status_logs_table',1),(55,'2018_09_03_043009_create_master_month_table',1),(56,'2018_09_03_073312_add_status_to_lease_detail',1),(57,'2018_09_03_174609_alter_architect_applicaton_marks_add_document_name_field',1),(58,'2018_09_04_192313_alter_architect_application_marks_add_final_certi_flag',1),(59,'2018_09_06_050425_roles_setup_table',1),(60,'2018_09_06_091427_create_deleted_village_details',1),(61,'2018_09_07_024149_create_society_offer_letters_table',1),(62,'2018_09_07_074325_create_master_email_templates_table',1),(63,'2018_09_10_041214_create_language_master_table',1),(64,'2018_09_10_043011_create_ol_application_master_table',1),(65,'2018_09_10_043619_create_ol_societies_table',1),(66,'2018_09_10_044938_create_ol_society_documents_master_table',1),(67,'2018_09_10_045245_create_ol_society_document_status_table',1),(68,'2018_09_10_052202_add_role_id_to_users_table',1),(69,'2018_09_10_052554_create_role_master_table',1),(70,'2018_09_10_052743_create_module_master_table',1),(71,'2018_09_10_052949_create_role_module_mapping_table',1),(72,'2018_09_10_053206_create_ol_status_master_table',1),(73,'2018_09_10_053839_create_ol_applications_table',1),(74,'2018_09_10_055255_create_ol_application_status_log_table',1),(75,'2018_09_10_060811_create_ol_site_visit_documents_table',1),(76,'2018_09_10_061125_create_ol_dcr_rate_master_table',1),(77,'2018_09_10_061308_create_ol_application_calculation_sheet_details_table',1),(78,'2018_09_10_063022_create_ol_application_checklist_scrunity_details_table',1),(79,'2018_09_10_064615_create_ol_consent_verification_question_master_table',1),(80,'2018_09_10_064857_create_ol_consent_verification_details_table',1),(81,'2018_09_10_065527_create_ol_demarcation_question_master_table',1),(82,'2018_09_10_065606_create_ol_tit_bit_question_master_table',1),(83,'2018_09_10_065631_create_ol_rg_relocation_question_master_table',1),(84,'2018_09_10_065718_create_ol_demarcation_details_table',1),(85,'2018_09_10_065915_create_ol_tit_bit_details_table',1),(86,'2018_09_10_065942_create_ol_rg_relocation_details_table',1),(87,'2018_09_10_092741_add_user_role_id_to_hearing',1),(88,'2018_09_10_124448_delete_model_to_application_master_table',1),(89,'2018_09_10_130111_add_model_to_application_master_table',1),(90,'2018_09_11_090411_add_architect_details_ol_societies_table',1),(91,'2018_09_11_092221_add_society_username_ol_societies_table',1),(92,'2018_09_11_092610_add_society_registration_no_ol_societies_table',1),(93,'2018_09_11_093207_add_society_contact_no_ol_societies_table',1),(94,'2018_09_11_093411_add_redirect_column_to_roles',1),(95,'2018_09_12_041803_create_ol_request_form_details',1),(96,'2018_09_12_042502_add_request_form_id_to_ol_applications',1),(97,'2018_09_14_063814_create_layout_table',1),(98,'2018_09_14_081206_alter_ol_applications_table',1),(99,'2018_09_14_091518_add_parent_id_to_roles_table',1),(100,'2018_09_14_093901_create_layout_user_table',1),(101,'2018_09_15_105445_create_scoiety_uploaded_documents_comment_table',1),(102,'2018_09_15_115320_alter_ol_society_document_status',1),(103,'2018_09_16_103034_add_layout_id_to_application',1),(104,'2018_09_16_110636_add_role_id_to_application_status',1),(105,'2018_09_17_041443_add_user_id_column_to_ol_applications_table',1),(106,'2018_09_17_072325_add_society_flag_application_log_table',1),(107,'2018_09_18_143034_remove_constraints_from_rti_form',1),(108,'2018_09_19_082008_create_frontend_rti_users_table',1),(109,'2018_09_19_082902_rename_frontend_rti_users_table',1),(110,'2018_09_19_091506_add_role_id_to_ol_societies_table',1),(111,'2018_09_19_182735_rename_role_id_to_user_id_ol_societies_table',1),(112,'2018_09_20_131606_create_hearing_status_log_table',1),(113,'2018_09_21_063743_alter_data_type_of_office_date_in_hearing',1),(114,'2018_09_21_143421_create_ol_cap_notes',1),(115,'2018_09_22_075255_drop_foreign_key_hearing',1),(116,'2018_09_22_080049_make_board_id_hearing_nullable',1),(117,'2018_09_22_094744_drop_foreign_key_schedule_hearing',1),(118,'2018_09_22_130949_create_board_user_table',1),(119,'2018_09_24_111140_create_ol_ee_note_table',1),(120,'2018_09_26_045107_add_remaining_resident_area_to_calculation_sheet_details',1),(121,'2018_09_26_055657_add_layout_approval_fee_to_calculation_sheet_details',1),(122,'2018_09_26_114630_create_ol_ree_note',1),(123,'2018_09_27_062221_create_village_societies_table',1),(124,'2018_09_27_110700_add_child_id_to_roles_table',1),(125,'2018_09_27_120506_add_area_of_total_plot_to_calculation_sheet',1),(126,'2018_09_27_124955_add_scrutiny_fee_to_calculation_sheet',1),(127,'2018_09_27_133720_add_drafted_offer_letter_to_ol_application',1),(128,'2018_09_27_142621_alter_ol_societies_table',1),(129,'2018_09_28_073124_create_ol_sharing_calculation_sheet_details',1),(130,'2018_09_28_073956_remove_village_id_from_lm_society_detail',1),(131,'2018_09_28_142431_add_status_offer_letter_to_ol_application',1),(132,'2018_10_01_101452_add_total_additional_claims_to_sharing_sheet',1),(133,'2018_10_01_144346_add_text_offer_letter_to_ol_application',1),(134,'2018_10_03_130750_add_certificate_path_to_architect_application',1),(135,'2018_10_04_060551_create_architect_certificate__table',1),(136,'2018_10_04_072722_add_drafted_certificate_to_architect_application',1),(137,'2018_10_04_082403_add_final_signed_certificate_status_to_architect_application',1),(138,'2018_10_04_082652_rename_status_to_final_signed_certificate_status_in_arcitect_application',1),(139,'2018_10_04_121722_modify_architect_application_status_logs_table',1),(140,'2018_10_04_122408_remove_previous_status_from_architect_application_status_logs_table',1),(141,'2018_10_05_053146_change_total_no_of_buildings_to_calculation',1),(142,'2018_10_05_094218_modify_application_status_column_in_atchitect_application_table',1),(143,'2018_10_05_124159_update_consent_verification_details',1),(144,'2018_10_09_103014_create_architect_layouts_table',1),(145,'2018_10_09_104713_create_architect_layout_details_table',1),(146,'2018_10_09_111503_create_architect_layout_detail_cts_plan_details',1),(147,'2018_10_09_111842_create_architect_layout_detail_pr_card_details',1),(148,'2018_10_09_112247_create_architect_layout_detail_ee_reports',1),(149,'2018_10_09_112458_create_architect_layout_detail_em_reports',1),(150,'2018_10_09_112511_create_architect_layout_detail_ree_reports',1),(151,'2018_10_09_113424_create_architect_layout_detail_land_reports',1),(152,'2018_10_09_113842_create_architect_layout_detail_court_matters_or_disputes_on_land',1),(153,'2018_10_09_124636_create_architect_layout_detail_land_scutiny_reports',1),(154,'2018_10_09_124700_create_architect_layout_detail_ee_scutiny_reports',1),(155,'2018_10_09_124718_create_architect_layout_detail_em_scutiny_reports',1),(156,'2018_10_09_124734_create_architect_layout_detail_ree_scutiny_reports',1),(157,'2018_10_09_140927_create_architect_layout__l_m__scrutinty_question_master_table',1),(158,'2018_10_09_142122_create_architect_layout__e_e__scrutinty_question_master_table',1),(159,'2018_10_09_142429_create_architect_layout__e_m__scrutinty_question_master_table',1),(160,'2018_10_09_142504_create_architect_layout__r_e_e__scrutinty_question_master_table',1),(161,'2018_10_09_142626_create_architect_layout__r_e_e__scrutinty_question_details_table',1),(162,'2018_10_09_143442_create_architect_layout__e_m__scrutinty_question_details_table',1),(163,'2018_10_09_143656_create_architect_layout__e_e__scrutinty_question_details_table',1),(164,'2018_10_09_143842_create_architect_layout__l_m__scrutinty_question_details_table',1),(165,'2018_10_09_145629_create_architect_layout_status_logs_table',1),(166,'2018_10_10_054559_rename_tables_name_of_layout_architect_scrunity_report',1),(167,'2018_10_10_085351_add_keyword_to_resolutions',1),(168,'2018_10_10_140618_add_delete_log_to_roles_table',1),(169,'2018_10_11_092851_create_deleted_role_details',1),(170,'2018_10_12_104049_add_calculated_dcr_val_to_calcuation_sheet',1),(171,'2018_10_13_065651_create_master_wards_table',1),(172,'2018_10_13_065816_create_master_colonies_table',1),(173,'2018_10_13_065836_create_master_societies_table',1),(174,'2018_10_13_070041_create_master_buildings_table',1),(175,'2018_10_13_070216_create_master_tenants_table',1),(176,'2018_10_15_074742_create_sc_application',1),(177,'2018_10_15_084516_create_society_bank_details',1),(178,'2018_10_15_084932_create_conveyance_sale_price_calculation',1),(179,'2018_10_15_091247_create_master_society_bill_level_table',1),(180,'2018_10_15_091323_create_master_tenant_type_table',1),(181,'2018_10_15_102842_create_conveyance_checklist_scrutiny',1),(182,'2018_10_15_105858_drop_table_sc_appliaction',1),(183,'2018_10_15_111418_create_society_conveyance_document_master',1),(184,'2018_10_15_111808_create_society_conveyance_document_status',1),(185,'2018_10_15_112156_create_society_application_document_type_master',1),(186,'2018_10_15_112449_create_sc_agreements_comment',1),(187,'2018_10_15_113045_create_society_agreement_type_master',1),(188,'2018_10_15_113421_create_sc_application_log',1),(189,'2018_10_15_114207_create_sc_application_agreements',1),(190,'2018_10_15_115647_create_sc_application_form_request',1),(191,'2018_10_15_124203_create_sc_application_table',1),(192,'2018_10_16_065706_add_application_no_to_sc_application',1),(193,'2018_10_16_091539_add_flat_delivery_method_to_conveyance_checklist_scrutiny',1),(194,'2018_10_16_101234_create_table_arrears_charges_rate',1),(195,'2018_10_16_104948_create_table_service_charges_rate',1),(196,'2018_10_16_122415_rename_columns_in_conveyance_sale_price_calculation_table',1),(197,'2018_10_16_132846_alter_conveyance_checklist_scrutiny',1),(198,'2018_10_17_110136_add_user_id_sc_application_agreements',1),(199,'2018_10_17_134728_create_arrear_calculation_table',1),(200,'2018_10_17_142249_alter_field_nullable_sc_application_log',1),(201,'2018_10_18_121706_alter_table_architect_layout_ee_scrunity_question_master_change_title_to_texttype',1),(202,'2018_10_19_093009_add_layout_column_in_architect_layouts_table',1),(203,'2018_10_19_102805_renewal_application_form_request',1),(204,'2018_10_19_103449_add_area_as_per_lease_agreement_to_sharing',1),(205,'2018_10_19_122258_add_feilds_conveyance_sale_price_calculation',1),(206,'2018_10_22_071115_create_employment_of_architect_applications_table',1),(207,'2018_10_22_071346_create_employment_of_architect_application_fee_payment_details_table',1),(208,'2018_10_22_072411_create_employment_of_architect_application_enclosures_table',1),(209,'2018_10_22_092751_create_employment_of_architect_application_important_project_details_table',1),(210,'2018_10_22_094039_create_employment_of_architect_application_imp_project_work_handled_details_table',1),(211,'2018_10_22_101458_create_eoa_application_imp_senior_professional_details_table',1),(212,'2018_10_22_103555_create_eoa_application_project_sheet_work_in_hand_details_table',1),(213,'2018_10_24_064717_alter_table_arrears_charges_rate',1),(214,'2018_10_24_110145_add_open_to_architect_layout_status_logs_table',1),(215,'2018_10_24_144726_add_is_optional_society_document_master',1),(216,'2018_10_25_125937_add_property_card_area_column_to_lm-village_details_table',1),(217,'2018_10_26_045750_add_conveyance_parent_id_to_role',1),(218,'2018_10_26_063158_add_columns_to_lm_society_detail',1),(219,'2018_10_26_124039_add_columns_to_ol_societies',1),(220,'2018_10_26_124042_create_sc_checklist_master',1),(221,'2018_10_26_135555_alter_sc_application_form_request',1),(222,'2018_10_26_142900_drop_lm_society_detail',1),(223,'2018_10_26_142923_create_lm_society_detail_table',1),(224,'2018_10_26_151908_alter_table_master_tenants_change_column_full_name_to_first_name',1),(225,'2018_10_26_152239_alter_table_master_tenants_change_column_full_name_to_master_tenants',1),(226,'2018_10_26_152421_alter_table_master_tenants_change_column_full_name_to_updated_master_tenants',1),(227,'2018_10_27_105616_add_receipt_date_to_eoa_application_fee_payment_details',1),(228,'2018_10_27_105855_create_sc_checklist_scrutiny_status',1),(229,'2018_10_27_113954_add_user_id_to_eoa_applications',1),(230,'2018_10_28_083102_add_is_date_to_sc_checklist_master',1),(231,'2018_10_29_080220_remove__society_id_index_from_master_building',1),(232,'2018_10_29_080236_remove__society_id_index_from_arrear_calculation',1),(233,'2018_10_29_080301_remove__society_id_index_from_arrear_calculation_rate',1),(234,'2018_10_29_080402_remove__society_id_index_from_service_charges_rates',1),(235,'2018_10_29_080458_remove__master__society_table',1),(236,'2018_10_29_150211_create__trans__payment__table',1),(237,'2018_10_29_152822_create__trans__bill__generate__table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_master`
--

DROP TABLE IF EXISTS `module_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_master`
--

LOCK TABLES `module_master` WRITE;
/*!40000 ALTER TABLE `module_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `module_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_application_calculation_sheet_details`
--

DROP TABLE IF EXISTS `ol_application_calculation_sheet_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_application_calculation_sheet_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_no_of_buildings` int(11) DEFAULT NULL,
  `area_as_per_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_tit_bit_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_rg_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_ntbnib_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_total_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_as_per_introduction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_​​subsistence_to_calculate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissible_carpet_area_coordinates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissible_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sqm_area_per_slot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_house` int(11) DEFAULT NULL,
  `permissible_proratata_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_sq_km_proyerta_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proratata_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_in_reserved_seats_for_vp_pio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_permissible_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `existing_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirekner_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirekner_construction_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirekner_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dcr_rate_in_percentage` int(11) DEFAULT NULL,
  `calculated_dcr_rate_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infrastructure_fee_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_residential_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_of_remaining_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_of_remaining_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off_site_infrastructure_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_to_be_paid_to_municipal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offsite_infrastructure_charge_to_mhada` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scrutiny_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offsite_infrastructure_charges_to_municipal_corporation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout_approval_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debraj_removal_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_usage_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_in_rs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offsite_notification_charge_as_per_notification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_area_of_resident_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_area_of_resident_area_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_area_of_resident_area_balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_of_first_installment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_of_remaining_installment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_to_be_paid_to_board` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_application_calculation_sheet_details`
--

LOCK TABLES `ol_application_calculation_sheet_details` WRITE;
/*!40000 ALTER TABLE `ol_application_calculation_sheet_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_application_calculation_sheet_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_application_checklist_scrunity_details`
--

DROP TABLE IF EXISTS `ol_application_checklist_scrunity_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_application_checklist_scrunity_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_type` enum('CONSENT VERIFICATION','DEMARCATION','TIT BIT','RG RELOCATION') COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_of_notice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigation_officer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_investigation` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_application_checklist_scrunity_details`
--

LOCK TABLES `ol_application_checklist_scrunity_details` WRITE;
/*!40000 ALTER TABLE `ol_application_checklist_scrunity_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_application_checklist_scrunity_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_application_master`
--

DROP TABLE IF EXISTS `ol_application_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_application_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `model` enum('Premium','Sharing','null') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_application_master`
--

LOCK TABLES `ol_application_master` WRITE;
/*!40000 ALTER TABLE `ol_application_master` DISABLE KEYS */;
INSERT INTO `ol_application_master` VALUES (1,0,'Self Redevelopment','2018-10-30 03:31:17','2018-10-30 03:31:17','null'),(2,1,'New - Offer Letter','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(3,1,'Revalidation Of Offer Letter','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(4,1,'Application for NOC','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(5,1,'Consent for OC','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(6,1,'New - Offer Letter','2018-10-30 03:31:17','2018-10-30 03:31:17','Sharing'),(7,1,'Revalidation Of Offer Letter','2018-10-30 03:31:17','2018-10-30 03:31:17','Sharing'),(8,1,'Application for NOC - IOD','2018-10-30 03:31:17','2018-10-30 03:31:17','Sharing'),(9,1,'Tripartite Agreement','2018-10-30 03:31:17','2018-10-30 03:31:17','Sharing'),(10,1,'Application for CC','2018-10-30 03:31:17','2018-10-30 03:31:17','Sharing'),(11,1,'Consent for OC','2018-10-30 03:31:17','2018-10-30 03:31:17','Sharing'),(12,0,'Redevelopment Through Developer','2018-10-30 03:31:17','2018-10-30 03:31:17','null'),(13,12,'New - Offer Letter','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(14,12,'Revalidation Of Offer Letter','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(15,12,'Application for NOC','2018-10-30 03:31:17','2018-10-30 03:31:17','Premium'),(16,12,'Consent for OC','2018-10-30 03:31:18','2018-10-30 03:31:18','Premium'),(17,12,'New - Offer Letter','2018-10-30 03:31:18','2018-10-30 03:31:18','Sharing'),(18,12,'Revalidation Of Offer Letter','2018-10-30 03:31:18','2018-10-30 03:31:18','Sharing'),(19,12,'Application for NOC - IOD','2018-10-30 03:31:18','2018-10-30 03:31:18','Sharing'),(20,12,'Tripartite Agreement','2018-10-30 03:31:18','2018-10-30 03:31:18','Sharing'),(21,12,'Application for CC','2018-10-30 03:31:18','2018-10-30 03:31:18','Sharing'),(22,12,'Consent for OC','2018-10-30 03:31:18','2018-10-30 03:31:18','Sharing');
/*!40000 ALTER TABLE `ol_application_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_application_status_log`
--

DROP TABLE IF EXISTS `ol_application_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_application_status_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `society_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1= Is Society & 0 = Not Society',
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_role_id` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_application_status_log`
--

LOCK TABLES `ol_application_status_log` WRITE;
/*!40000 ALTER TABLE `ol_application_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_application_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_applications`
--

DROP TABLE IF EXISTS `ol_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `society_id` int(11) NOT NULL,
  `layout_id` int(10) unsigned NOT NULL,
  `request_form_id` int(11) NOT NULL,
  `status_offer_letter` int(11) DEFAULT '0',
  `application_master_id` int(11) NOT NULL,
  `application_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_at` datetime NOT NULL,
  `current_status_id` int(11) NOT NULL,
  `name_of_architect` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `architect_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `architect_telephone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `architect_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_site_visit` date DEFAULT NULL,
  `site_visit_officers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demarkation_verification_comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_encrochment` tinyint(4) NOT NULL,
  `encrochment_verification_comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_letter_document_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approve_offer_letter` tinyint(4) NOT NULL,
  `drafted_offer_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_offer_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ol_applications_layout_id_foreign` (`layout_id`),
  KEY `ol_applications_user_id_foreign` (`user_id`),
  CONSTRAINT `ol_applications_layout_id_foreign` FOREIGN KEY (`layout_id`) REFERENCES `master_layout` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ol_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_applications`
--

LOCK TABLES `ol_applications` WRITE;
/*!40000 ALTER TABLE `ol_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_cap_notes`
--

DROP TABLE IF EXISTS `ol_cap_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_cap_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_cap_notes`
--

LOCK TABLES `ol_cap_notes` WRITE;
/*!40000 ALTER TABLE `ol_cap_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_cap_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_consent_verification_details`
--

DROP TABLE IF EXISTS `ol_consent_verification_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_consent_verification_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_consent_verification_details`
--

LOCK TABLES `ol_consent_verification_details` WRITE;
/*!40000 ALTER TABLE `ol_consent_verification_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_consent_verification_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_consent_verification_question_master`
--

DROP TABLE IF EXISTS `ol_consent_verification_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_consent_verification_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_consent_verification_question_master`
--

LOCK TABLES `ol_consent_verification_question_master` WRITE;
/*!40000 ALTER TABLE `ol_consent_verification_question_master` DISABLE KEYS */;
INSERT INTO `ol_consent_verification_question_master` VALUES (1,2,'७० % सभासदांनी पुनर्विकासास सहमती दर्शविली आहे काय ?',NULL,NULL),(2,2,'या सभासदांनी पुनर्विकासास सहमती दर्शविली आहे ते त्या सोसायटीचे अधिकृत मान्यता प्राप्त सदस्य आहेत काय ?',NULL,NULL),(3,2,'नसल्यास एकूण मान्यता प्राप्त ७० % सभासदांची पुनर्विकासास सहमती आहे काय ?',NULL,NULL),(4,2,'सर्व मान्यता प्राप्त सभासदांनी ओळखपत्र, भागधारक प्रमाणपत्र इत्यादी कागदपत्रे सादर केलेले आहेत काय ?',NULL,NULL),(5,2,'संस्थेने वास्तुशास्त्रज्ञ नेमणूकीबाबत ठराव केला आहे काय ?',NULL,NULL),(6,2,'संस्थेने विकासक नेमणूकीबाबत ठराव केला आहे काय ?',NULL,NULL);
/*!40000 ALTER TABLE `ol_consent_verification_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_dcr_rate_master`
--

DROP TABLE IF EXISTS `ol_dcr_rate_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_dcr_rate_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lr_val` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lc_val` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage_val` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_dcr_rate_master`
--

LOCK TABLES `ol_dcr_rate_master` WRITE;
/*!40000 ALTER TABLE `ol_dcr_rate_master` DISABLE KEYS */;
INSERT INTO `ol_dcr_rate_master` VALUES (1,'0 to 2','EWS / LIG',40,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(2,'0 to 2','MIG',60,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(3,'0 to 2','HIG',80,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(4,'2 to 4','EWS / LIG',45,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(5,'2 to 4','MIG',65,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(6,'2 to 4','HIG',85,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(7,'4 to 6','EWS / LIG',50,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(8,'4 to 6','MIG',70,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(9,'4 to 6','HIG',90,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(10,'above 6','EWS / LIG',55,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(11,'above 6','MIG',75,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(12,'above 6','HIG',95,'2018-10-30 03:31:18','2018-10-30 03:31:18');
/*!40000 ALTER TABLE `ol_dcr_rate_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_demarcation_details`
--

DROP TABLE IF EXISTS `ol_demarcation_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_demarcation_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_demarcation_details`
--

LOCK TABLES `ol_demarcation_details` WRITE;
/*!40000 ALTER TABLE `ol_demarcation_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_demarcation_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_demarcation_question_master`
--

DROP TABLE IF EXISTS `ol_demarcation_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_demarcation_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_demarcation_question_master`
--

LOCK TABLES `ol_demarcation_question_master` WRITE;
/*!40000 ALTER TABLE `ol_demarcation_question_master` DISABLE KEYS */;
INSERT INTO `ol_demarcation_question_master` VALUES (1,2,'संस्थेच्या ताब्यातील भूखंड अतिक्रमणाने बाधित आहे काय ?',NULL,NULL),(2,2,'सदर भूखंड मंजूर विकास आराखड्यानुसार आरक्षणाने बाधित आहे काय ? असल्यास आरक्षणाचे स्वरूप नमुद करावेत.',NULL,NULL),(3,2,'असल्यास अतिक्रमणाने बाधित क्षेत्रफळ किती आहे ? तसचे बाधित जागेवरील बांधकामाचा तपशिल तसेच वापर याबाबत शेरा द्यावा.',NULL,NULL),(4,2,'संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?',NULL,NULL),(5,2,'संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?',NULL,NULL),(6,2,'संस्थेच्या भाडेपट्यानुसार असलेल्या भूखंडाव्यतीरिक्त लगत भूखंड/जागा शिल्लक राहत आहे काय ?',NULL,NULL),(7,2,'असल्यास अशी जागा स्वतंत्रपणे विकास करता येण्यासारखी आहे काय ?',NULL,NULL),(8,2,'नसल्यास सदर जागा फुटकळ भूखंडाच्या  परिभाषेनुसार असल्यास त्याचे क्षेत्रफळ व मोजमापे नमुद करावीत.',NULL,NULL),(9,2,'सदर फुटकळ भूखंडालगतच्या इतर संस्थांची नावे नमुद करावीत.',NULL,NULL),(10,2,'संस्थेच्या अस्तित्वातील इमारतीच्या मजल्यांची संख्या किती आहे ?',NULL,NULL),(11,2,'संस्थेमध्ये एकूण निवासी व अनिवासी गाळ्यांची संख्या नमुद करावी',NULL,NULL),(12,2,'सदर इमारतीस संलग्न असलेल्या रोडची रूंदी नमुद करण्यात यावी.',NULL,NULL);
/*!40000 ALTER TABLE `ol_demarcation_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_ee_note`
--

DROP TABLE IF EXISTS `ol_ee_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_ee_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `document_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_ee_note`
--

LOCK TABLES `ol_ee_note` WRITE;
/*!40000 ALTER TABLE `ol_ee_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_ee_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_ree_note`
--

DROP TABLE IF EXISTS `ol_ree_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_ree_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `document_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_ree_note`
--

LOCK TABLES `ol_ree_note` WRITE;
/*!40000 ALTER TABLE `ol_ree_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_ree_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_request_form_details`
--

DROP TABLE IF EXISTS `ol_request_form_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_request_form_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `date_of_meeting` date NOT NULL,
  `resolution_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `architect_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_request_form_details`
--

LOCK TABLES `ol_request_form_details` WRITE;
/*!40000 ALTER TABLE `ol_request_form_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_request_form_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_rg_relocation_details`
--

DROP TABLE IF EXISTS `ol_rg_relocation_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_rg_relocation_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_rg_relocation_details`
--

LOCK TABLES `ol_rg_relocation_details` WRITE;
/*!40000 ALTER TABLE `ol_rg_relocation_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_rg_relocation_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_rg_relocation_question_master`
--

DROP TABLE IF EXISTS `ol_rg_relocation_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_rg_relocation_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_rg_relocation_question_master`
--

LOCK TABLES `ol_rg_relocation_question_master` WRITE;
/*!40000 ALTER TABLE `ol_rg_relocation_question_master` DISABLE KEYS */;
INSERT INTO `ol_rg_relocation_question_master` VALUES (1,2,'सिमांकन नकाशानुसार संस्थेच्या भूखंडाचे एकूण क्षेत्रफळ किती आहे ?',NULL,NULL),(2,2,'अभिन्यासानुसार सदर करमणूकीचे मैदान Sंheme R।G। आहे कि D।P। R।G। आहे याबाबत नमुद करावे.',NULL,NULL),(3,2,'करमणूकीच्या मैदानाच्या प्रस्तावित स्थलांतरणाबाबत लगतच्या संस्थांची संमती घेतलेली आहे काय ?',NULL,NULL),(4,2,'प्रस्तावित स्थलांतरणामुळे सदर करमणूकीचे मैदान अभिन्यासातील सर्व गाळेधारकांकरीता खुले राहील याची खातरजमा केली आहे काय ?',NULL,NULL),(5,2,'एकूण करमणूकीच्या मैदानाच्या क्षेत्रफळापैकी सर्वच भूखंडाचे /भागशः भूखंडाचे स्थलांतरण प्रस्तावित  आहे किंवा कसे याबाबत नमुद करावे.',NULL,NULL);
/*!40000 ALTER TABLE `ol_rg_relocation_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_sharing_calculation_sheet_details`
--

DROP TABLE IF EXISTS `ol_sharing_calculation_sheet_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_sharing_calculation_sheet_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `area_of_tit_bit_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_as_per_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_total_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abhinyas_area_as_per_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abhinyas_area_of_tit_bit_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abhinyas_area_of_total_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_​​subsistence_to_calculate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissible_carpet_area_coordinates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissible_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sqm_area_per_slot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_house` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissible_proratata_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_permissible_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissible_mattress_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revised_permissible_mattress_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revised_increased_area_for_residential_use` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rehabilitation_mattress_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dcr_a_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_sq_km_proyerta_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_additional_claims` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rehabilitation_mattress_area_with_dcr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rehabilitation_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rc_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_rc_division_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dcr_b_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mattress_area_for_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dcr_c_society_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dcr_c_mhada_val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_share` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mhada_share` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mhada_share_with_fungib` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `existing_construction_area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off_site_infrastructure_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_to_be_paid_to_municipal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offsite_infrastructure_charge_to_mhada` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scrutiny_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debraj_removal_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout_approval_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_usage_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_in_rs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_to_b_paid_to_municipal_corporation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_sharing_calculation_sheet_details`
--

LOCK TABLES `ol_sharing_calculation_sheet_details` WRITE;
/*!40000 ALTER TABLE `ol_sharing_calculation_sheet_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_sharing_calculation_sheet_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_site_visit_documents`
--

DROP TABLE IF EXISTS `ol_site_visit_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_site_visit_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_site_visit_documents`
--

LOCK TABLES `ol_site_visit_documents` WRITE;
/*!40000 ALTER TABLE `ol_site_visit_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_site_visit_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_societies`
--

DROP TABLE IF EXISTS `ol_societies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_societies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `colony_id` int(11) DEFAULT NULL,
  `society_bill_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_architect` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `architect_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `architect_telephone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `architect_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `optional_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ol_societies_user_id_foreign` (`user_id`),
  CONSTRAINT `ol_societies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_societies`
--

LOCK TABLES `ol_societies` WRITE;
/*!40000 ALTER TABLE `ol_societies` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_societies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_society_document_comment`
--

DROP TABLE IF EXISTS `ol_society_document_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_society_document_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `society_documents_comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_society_document_comment`
--

LOCK TABLES `ol_society_document_comment` WRITE;
/*!40000 ALTER TABLE `ol_society_document_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_society_document_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_society_document_status`
--

DROP TABLE IF EXISTS `ol_society_document_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_society_document_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `society_document_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EE_document_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_by_EE` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_comment_by_EE` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_society_document_status`
--

LOCK TABLES `ol_society_document_status` WRITE;
/*!40000 ALTER TABLE `ol_society_document_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_society_document_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_society_documents_master`
--

DROP TABLE IF EXISTS `ol_society_documents_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_society_documents_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `application_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_optional` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_society_documents_master`
--

LOCK TABLES `ol_society_documents_master` WRITE;
/*!40000 ALTER TABLE `ol_society_documents_master` DISABLE KEYS */;
INSERT INTO `ol_society_documents_master` VALUES (1,2,2,'संस्थेचा अर्ज',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(2,2,2,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(3,2,2,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(4,2,2,'संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(5,2,2,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(6,2,2,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(7,2,2,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(8,2,2,'विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत',1,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(9,2,2,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(10,2,2,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(11,2,2,'भाडेपट्टा करारनामा (लीज डिड)',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(12,2,2,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(13,2,2,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा',1,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(14,2,2,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(15,2,2,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र',1,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(16,2,2,'नगरभुमापन नकाशे',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(17,2,2,'मिळकत पत्रिका (PR कार्ड )',0,'2018-10-30 03:31:18','2018-10-30 03:31:18'),(18,2,2,'अस्तीत्वातील इमारतीचे फोटो',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(19,2,2,'प्रस्तावीत इमारतीचा नकाशा',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(20,2,2,'डी.पी.रिमार्क',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(21,2,2,'उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(22,2,6,'संस्थेचा अर्ज',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(23,2,6,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(24,2,6,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(25,2,6,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(26,2,6,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(27,2,6,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(28,2,6,'५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(29,2,6,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(30,2,6,'भाडेपट्टा करारनामा (लीज डिड)',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(31,2,6,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(32,2,6,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(33,2,6,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(34,2,6,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(35,2,6,'नगरभुमापन नकाशे',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(36,2,6,'मिळकत पत्रिका (PR कार्ड )',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(37,2,6,'अस्तीत्वातील इमारतीचे फोटो',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(38,2,6,'प्रस्तावीत इमारतीचा नकाशा',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(39,2,6,'डी.पी.रिमार्क',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(40,2,13,'संस्थेचा अर्ज',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(41,2,13,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(42,2,13,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(43,2,13,'संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(44,2,13,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(45,2,13,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(46,2,13,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(47,2,13,'विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(48,2,13,'५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(49,2,13,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(50,2,13,'भाडेपट्टा करारनामा (लीज डिड)',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(51,2,13,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(52,2,13,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(53,2,13,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(54,2,13,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र',1,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(55,2,13,'नगरभुमापन नकाशे',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(56,2,13,'मिळकत पत्रिका (PR कार्ड )',0,'2018-10-30 03:31:19','2018-10-30 03:31:19'),(57,2,13,'अस्तीत्वातील इमारतीचे फोटो',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(58,2,13,'प्रस्तावीत इमारतीचा नकाशा',1,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(59,2,13,'डी.पी.रिमार्क',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(60,2,13,'उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(61,2,17,'संस्थेचा अर्ज',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(62,2,17,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(63,2,17,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(64,2,17,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(65,2,17,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(66,2,17,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(67,2,17,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(68,2,17,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(69,2,17,'भाडेपट्टा करारनामा (लीज डिड)',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(70,2,17,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(71,2,17,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा',1,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(72,2,17,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(73,2,17,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र',1,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(74,2,17,'नगरभुमापन नकाशे',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(75,2,17,'मिळकत पत्रिका (PR कार्ड )',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(76,2,17,'अस्तीत्वातील इमारतीचे फोटो',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(77,2,17,'प्रस्तावीत इमारतीचा नकाशा',1,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(78,2,17,'डी.पी.रिमार्क',0,'2018-10-30 03:31:20','2018-10-30 03:31:20'),(79,2,3,'संस्थेचा अर्ज परिशिष्ट अ प्रमाणे',0,NULL,NULL),(80,1,3,'Old Offer Letter',0,NULL,NULL),(81,1,3,'Society Resolution',0,NULL,NULL),(82,1,3,'Other',0,NULL,NULL),(83,2,7,'संस्थेचा अर्ज परिशिष्ट अ प्रमाणे',0,NULL,NULL),(84,1,7,'Old Offer Letter',0,NULL,NULL),(85,1,7,'Society Resolution',0,NULL,NULL),(86,1,7,'Other',0,NULL,NULL),(87,2,14,'संस्थेचा अर्ज परिशिष्ट अ प्रमाणे',0,NULL,NULL),(88,1,14,'Old Offer Letter',0,NULL,NULL),(89,1,14,'Society Resolution',0,NULL,NULL),(90,1,14,'Other',0,NULL,NULL),(91,2,18,'संस्थेचा अर्ज परिशिष्ट अ प्रमाणे',0,NULL,NULL),(92,1,18,'Old Offer Letter',0,NULL,NULL),(93,1,18,'Society Resolution',0,NULL,NULL),(94,1,18,'Other',0,NULL,NULL);
/*!40000 ALTER TABLE `ol_society_documents_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_status_master`
--

DROP TABLE IF EXISTS `ol_status_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_status_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_status_master`
--

LOCK TABLES `ol_status_master` WRITE;
/*!40000 ALTER TABLE `ol_status_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_status_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_tit_bit_details`
--

DROP TABLE IF EXISTS `ol_tit_bit_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_tit_bit_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_tit_bit_details`
--

LOCK TABLES `ol_tit_bit_details` WRITE;
/*!40000 ALTER TABLE `ol_tit_bit_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ol_tit_bit_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ol_tit_bit_question_master`
--

DROP TABLE IF EXISTS `ol_tit_bit_question_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ol_tit_bit_question_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_tit_bit_question_master`
--

LOCK TABLES `ol_tit_bit_question_master` WRITE;
/*!40000 ALTER TABLE `ol_tit_bit_question_master` DISABLE KEYS */;
INSERT INTO `ol_tit_bit_question_master` VALUES (1,2,'संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?',NULL,NULL),(2,2,'संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?',NULL,NULL),(3,2,'सिमांकन नकाशानुसार फुटकळ भूखंड असल्यास ठराव क्र। ५९९८ मधील मुद्दा क्र। १० मध्ये नमुद केलेल्या कुठल्या प्रकारामध्ये सदर  भूखंड मोडतो.',NULL,NULL),(4,2,'फुटकळ भूखंडाचे एकूण क्षेत्रफळ किती ?',NULL,NULL),(5,2,'सदर फुटकळ भूखंडा पैकी काही भागालगत इतर संस्थांची सिमा असल्यास त्यानुसार समान विभागणी करून त्यानुसार सिमांकन नकाशात नमुद केले आहेत काय ?',NULL,NULL),(6,2,'सिमांकन नकाशा, अभिन्यास व  भाडेपट्टा करारनाम्यानुसार संस्थेच्या एकूण क्षेत्रफळात तफावत असल्यास त्याचा तपशिल नमुद करावा.',NULL,NULL),(7,2,'संस्थेलगत म्हाडाचा मोकळा भूखंड असल्यास  त्यासोबत फुटकळ भूखंडाचे एकत्रिकरण करणे शक्य आहे काय ?',NULL,NULL),(8,2,'फुटकळ भूखंड क्षेत्रफळाचे एकूण भूखंड क्षेत्रफळाच्या प्रमाणात टक्केवारी किती आहे ?',NULL,NULL);
/*!40000 ALTER TABLE `ol_tit_bit_question_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `other_land`
--

DROP TABLE IF EXISTS `other_land`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `other_land` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `land_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other_land`
--

LOCK TABLES `other_land` WRITE;
/*!40000 ALTER TABLE `other_land` DISABLE KEYS */;
INSERT INTO `other_land` VALUES (1,'SRA',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(2,'Amenity plot',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(3,'Plot handed over BMC or others',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(4,'Vacant plots',1,'2018-10-30 03:31:17','2018-10-30 03:31:17'),(5,'Office building',1,'2018-10-30 03:31:17','2018-10-30 03:31:17');
/*!40000 ALTER TABLE `other_land` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(67,2),(68,2),(69,2),(70,2),(71,2),(72,2),(73,2),(74,2),(75,2),(76,2),(77,2),(78,2),(79,2),(80,2),(81,2),(82,2),(83,2),(35,3),(36,3),(37,3),(38,3),(39,3),(40,3),(41,3),(42,3),(43,3),(44,3),(45,3),(46,3),(47,3),(48,3),(49,3),(50,3),(51,3),(52,3),(53,3),(54,3),(55,3),(56,3),(57,3),(58,3),(59,3),(60,3),(61,3),(62,3),(63,3),(64,3),(65,3),(66,3),(67,3),(68,3),(69,3),(70,3),(71,3),(72,3),(73,3),(74,3),(75,3),(76,3),(77,3),(78,3),(79,3),(80,3),(81,3),(82,3),(83,3),(35,4),(36,4),(37,4),(38,4),(39,4),(40,4),(41,4),(42,4),(43,4),(44,4),(45,4),(46,4),(47,4),(48,4),(49,4),(50,4),(51,4),(52,4),(53,4),(54,4),(55,4),(56,4),(57,4),(58,4),(59,4),(60,4),(61,4),(62,4),(63,4),(64,4),(65,4),(66,4),(67,4),(68,4),(69,4),(70,4),(71,4),(72,4),(73,4),(74,4),(75,4),(76,4),(77,4),(78,4),(79,4),(80,4),(81,4),(82,4),(83,4),(84,5),(85,5),(86,5),(87,5),(88,5),(89,5),(90,5),(91,5),(92,5),(93,5),(94,5),(95,5),(96,5),(97,5),(98,5),(99,5),(100,5),(101,5),(102,5),(103,5),(104,5),(105,5),(106,5),(107,5),(108,5),(109,5),(110,5),(111,5),(112,6),(113,6),(114,6),(115,6),(116,6),(117,6),(118,7),(119,7),(120,7),(121,7),(122,7),(123,7),(124,7),(125,7),(126,7),(127,7),(128,7),(129,7),(130,7),(131,7),(132,7),(320,7),(321,7),(133,8),(134,8),(135,8),(136,8),(137,8),(138,8),(139,8),(140,8),(133,9),(134,9),(135,9),(136,9),(137,9),(138,9),(139,9),(140,9),(133,10),(134,10),(135,10),(136,10),(137,10),(138,10),(139,10),(140,10),(49,11),(50,11),(51,11),(52,11),(53,11),(54,11),(55,11),(56,11),(57,11),(58,11),(59,11),(60,11),(141,11),(142,11),(143,11),(144,11),(145,11),(146,11),(147,11),(148,11),(149,11),(150,11),(151,11),(152,11),(153,11),(154,11),(155,11),(156,11),(157,11),(158,11),(159,11),(160,11),(161,11),(162,11),(163,11),(164,11),(165,11),(193,12),(194,12),(195,12),(196,12),(197,12),(198,12),(199,12),(166,13),(167,13),(168,13),(169,13),(170,13),(171,13),(172,13),(173,13),(174,13),(175,13),(176,13),(177,13),(178,13),(179,13),(180,13),(181,13),(182,13),(183,13),(184,13),(185,13),(186,13),(187,13),(188,13),(189,13),(190,13),(191,13),(192,13),(193,14),(194,14),(195,14),(196,14),(197,14),(198,14),(199,14),(166,15),(167,15),(168,15),(169,15),(170,15),(171,15),(172,15),(173,15),(174,15),(175,15),(176,15),(177,15),(178,15),(179,15),(180,15),(181,15),(182,15),(183,15),(184,15),(185,15),(186,15),(187,15),(188,15),(189,15),(190,15),(191,15),(192,15),(49,16),(50,16),(51,16),(52,16),(53,16),(54,16),(55,16),(56,16),(57,16),(58,16),(59,16),(60,16),(200,16),(201,16),(202,16),(203,16),(204,16),(205,16),(206,16),(207,16),(208,16),(209,16),(210,16),(211,16),(212,16),(213,16),(214,16),(215,16),(216,16),(217,16),(49,17),(50,17),(51,17),(52,17),(53,17),(54,17),(55,17),(56,17),(57,17),(58,17),(59,17),(60,17),(200,17),(201,17),(202,17),(203,17),(204,17),(205,17),(206,17),(207,17),(208,17),(209,17),(210,17),(211,17),(212,17),(213,17),(214,17),(215,17),(216,17),(217,17),(49,18),(50,18),(51,18),(52,18),(53,18),(54,18),(55,18),(56,18),(57,18),(58,18),(59,18),(60,18),(200,18),(201,18),(202,18),(203,18),(204,18),(205,18),(206,18),(207,18),(208,18),(209,18),(210,18),(211,18),(212,18),(213,18),(214,18),(215,18),(216,18),(217,18),(49,19),(50,19),(51,19),(52,19),(53,19),(54,19),(55,19),(56,19),(57,19),(58,19),(59,19),(60,19),(200,19),(201,19),(202,19),(203,19),(204,19),(205,19),(206,19),(207,19),(208,19),(209,19),(210,19),(211,19),(212,19),(213,19),(214,19),(215,19),(216,19),(217,19),(49,20),(50,20),(51,20),(52,20),(53,20),(54,20),(55,20),(56,20),(57,20),(216,20),(217,20),(218,20),(219,20),(220,20),(221,20),(222,20),(223,20),(224,20),(225,20),(49,21),(50,21),(51,21),(52,21),(53,21),(54,21),(55,21),(56,21),(57,21),(216,21),(217,21),(226,21),(227,21),(228,21),(229,21),(230,21),(231,21),(232,21),(233,22),(234,22),(235,22),(236,22),(237,22),(238,22),(239,22),(240,22),(241,23),(242,23),(243,23),(244,23),(245,23),(246,23),(247,23),(248,23),(249,23),(250,23),(251,23),(252,23),(253,23),(254,23),(255,23),(256,23),(49,24),(50,24),(51,24),(52,24),(53,24),(54,24),(55,24),(56,24),(57,24),(216,24),(217,24),(257,24),(258,24),(259,24),(260,24),(261,24),(262,24),(263,24),(264,25),(265,25),(266,25),(267,25),(268,25),(269,25),(270,25),(271,25),(49,26),(50,26),(51,26),(52,26),(53,26),(54,26),(55,26),(56,26),(57,26),(58,26),(59,26),(60,26),(216,26),(217,26),(272,26),(273,26),(274,26),(275,26),(276,26),(277,26),(278,26),(279,26),(280,26),(281,26),(282,26),(283,26),(284,26),(285,26),(286,26),(287,26),(49,27),(50,27),(51,27),(52,27),(53,27),(54,27),(55,27),(56,27),(57,27),(58,27),(59,27),(60,27),(216,27),(217,27),(272,27),(273,27),(274,27),(275,27),(276,27),(277,27),(278,27),(279,27),(280,27),(281,27),(282,27),(283,27),(284,27),(285,27),(286,27),(287,27),(49,28),(50,28),(51,28),(52,28),(53,28),(54,28),(55,28),(56,28),(57,28),(58,28),(59,28),(60,28),(216,28),(217,28),(272,28),(273,28),(274,28),(275,28),(276,28),(277,28),(278,28),(279,28),(280,28),(281,28),(282,28),(283,28),(284,28),(285,28),(286,28),(287,28),(288,28),(289,28),(290,28),(291,28),(292,28),(293,28),(294,28),(295,28),(296,28),(297,28),(298,28),(299,28),(300,28),(301,28),(302,28),(303,28),(304,28),(305,28),(306,28),(307,28),(308,28),(309,28),(310,28),(311,28),(312,28),(313,28),(314,28),(315,28),(272,29),(274,29),(275,29),(276,29),(279,29),(286,29),(316,29),(49,30),(50,30),(51,30),(52,30),(53,30),(54,30),(55,30),(56,30),(57,30),(58,30),(59,30),(60,30),(63,30),(64,30),(317,30),(318,30),(319,30);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'society_offer_letter.index','index','index',NULL,NULL),(2,'society_offer_letter.store','society_offer_letter_registration','store society registration details for offer letter',NULL,NULL),(3,'society_offer_letter.create','display_society_offer_letter_registration','displays society registration form for offer letter',NULL,NULL),(4,'society_offer_letter_forgot_password','society_forgot_password','society forgot password functionality',NULL,NULL),(5,'society_offer_letter_dashboard','society_offer_letter_application_listing','society offer letter application listing',NULL,NULL),(6,'offer_letter_application_self','offer_letter_application_self','displays offer letter application form for self redevelopment',NULL,NULL),(7,'save_offer_letter_application_self','save_offer_letter_application_self','saves offer letter application form for self redevelopment',NULL,NULL),(8,'offer_letter_application_dev','offer_letter_application_dev','displays offer letter application form for redevelopment through developer',NULL,NULL),(9,'save_offer_letter_application_dev','save_offer_letter_application_dev','saves offer letter application form for redevelopment through developer',NULL,NULL),(10,'documents_upload','documents_upload','displays document names listings & upload documents form',NULL,NULL),(11,'uploaded_documents','uploaded_documents','displays download and upload option for submitted offer letter application form',NULL,NULL),(12,'delete_uploaded_documents','delete_uploaded_documents','deletes documents for submitted offer letter application form',NULL,NULL),(13,'add_documents_comment','add_documents_comment','add comments for uploaded documents for submitted offer letter application form',NULL,NULL),(14,'society_offer_letter_download','society_offer_letter_download','displays submitted society offer letter application',NULL,NULL),(15,'upload_society_offer_letter','upload_society_offer_letter','upload submitted society offer letter application after signature',NULL,NULL),(16,'society_detail.UserAuthentication','society_detail.UserAuthentication','authenticates society offer letter users',NULL,NULL),(17,'documents_uploaded','documents_uploaded','view uploaded society documents',NULL,NULL),(18,'add_documents_comment','add_documents_comment','add documents comment',NULL,NULL),(19,'add_uploaded_documents_remark','add_uploaded_documents_remark','add uploaded documents remark',NULL,NULL),(20,'society_offer_letter_application_download','society_offer_letter_application_download','downloads society offer letter application',NULL,NULL),(21,'upload_society_offer_letter_application','upload_society_offer_letter_application','uploads society offer letter application',NULL,NULL),(22,'society_conveyance.index','Society conveyance application listing','Society conveyance application listing',NULL,NULL),(23,'society_conveyance.store','Stores society conveyance application data','Stores society conveyance application data',NULL,NULL),(24,'society_conveyance.create','Shows society conveyance application form','Shows society conveyance application form',NULL,NULL),(25,'society_conveyance.show','Shows society conveyance application form','Shows society conveyance application form',NULL,NULL),(26,'society_conveyance.destroy','Deletes society conveyance application','Deletes society conveyance application',NULL,NULL),(27,'society_conveyance.update','Updates society conveyance application form data','Updates society conveyance application form data',NULL,NULL),(28,'society_conveyance.edit','Shows edit form for society conveyance application','Shows edit form for society conveyance application',NULL,NULL),(29,'show_form_self','Shows self redevelopment form','Shows self redevelopment form',NULL,NULL),(30,'show_form_dev','Shows redevelopment through developer form','Shows redevelopment through developer form',NULL,NULL),(31,'society_offer_letter_preview','Shows preview for society offer letter application form','Shows preview for society offer letter application form',NULL,NULL),(32,'society_offer_letter_edit','Shows edit form for society offer letter application','Shows edit form for society offer letter application',NULL,NULL),(33,'society_offer_letter_update','Updates society offer letter application form','Updates society offer letter application form',NULL,NULL),(34,'sc_download','Downloads template in excel format','Downloads template in excel format',NULL,NULL),(35,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(36,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(37,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(38,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(39,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(40,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(41,'document-submitted','Document submitted','Document submitted',NULL,NULL),(42,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(43,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(44,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(45,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(46,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(47,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(48,'test3','EE test 3','EE test3',NULL,NULL),(49,'architect_layout.index','List layouts','Listing of architect layouts',NULL,NULL),(50,'architect_layouts_layout_details.index','architect_layouts_layout_details.index','architect_layouts_layout_details.index',NULL,NULL),(51,'architect_layout_details.view','architect_layout_details.view','architect_layout_details.view',NULL,NULL),(52,'architect_layout_detail_view_cts_plan','architect_layout_detail_view_cts_plan','architect_layout_detail_view_cts_plan',NULL,NULL),(53,'architect_layout_detail_view_prc_detail','architect_layout_detail_view_prc_detail','architect_layout_detail_view_prc_detail',NULL,NULL),(54,'architect_detail_dp_crz_remark_view','architect_detail_dp_crz_remark_view','architect_detail_dp_crz_remark_view',NULL,NULL),(55,'view_court_case_or_dispute_on_land','view_court_case_or_dispute_on_land','view_court_case_or_dispute_on_land',NULL,NULL),(56,'forward_architect_layout','forward_architect_layout','forward_architect_layout',NULL,NULL),(57,'post_forward_architect_layout','post_forward_architect_layout','post_forward_architect_layout',NULL,NULL),(58,'architect_layout_get_scrtiny','architect_layout_get_scrtiny','architect_layout_get_scrtiny',NULL,NULL),(59,'architect_layout_add_scrutiny_report','architect_layout_add_scrutiny_report','architect_layout_add_scrutiny_report',NULL,NULL),(60,'architect_layout_post_scrutiny_report','architect_layout_post_scrutiny_report','architect_layout_post_scrutiny_report',NULL,NULL),(61,'upload_ee_checklist_and_remark_report','upload_ee_checklist_and_remark_report','upload_ee_checklist_and_remark_report',NULL,NULL),(62,'post_ee_checklist_and_remark_report','post_ee_checklist_and_remark_report','post_ee_checklist_and_remark_report',NULL,NULL),(63,'conveyance.index','conveyance','conveyance',NULL,NULL),(64,'conveyance.view_application','view application','view application',NULL,NULL),(65,'ee.sale_price_calculation','ee sale price calculation','ee sale price calculation',NULL,NULL),(66,'ee.save_calculation_data','save calculation data','save calculation data',NULL,NULL),(67,'arrears_charges.create','Arrears charges create','Arrears charges create',NULL,NULL),(68,'arrears_charges.store','Arrears charges store','Arrears charges store',NULL,NULL),(69,'arrears_charges.edit','Arrears charges edit','Arrears charges edit',NULL,NULL),(70,'arrears_charges.update','Arrears charges update','Arrears charges update',NULL,NULL),(71,'arrears_charges','Arrears charges list','Arrears charges list',NULL,NULL),(72,'service_charges.create','Service charges create','Service charges create',NULL,NULL),(73,'service_charges.store','Service charges store','Service charges store',NULL,NULL),(74,'service_charges.edit','Service charges edit','Service charges edit',NULL,NULL),(75,'service_charges.update','Service charges update','Service charges update',NULL,NULL),(76,'service_charges','Service charges list','Service charges list',NULL,NULL),(77,'society.billing_level','Society billing level','Society billing level',NULL,NULL),(78,'society.society_details','Society details','Society details',NULL,NULL),(79,'ee.upload_ee_note','Upload EE Note','Upload EE Note',NULL,NULL),(80,'ee.save_demarcation_plan','save demarcation plan','save demarcation plan',NULL,NULL),(81,'ee.save_covering_letter','save covering letter','save covering letter',NULL,NULL),(82,'ee.forward_application_sc','forward application sc','forward application sc',NULL,NULL),(83,'ee.send_forward_application','send forward application','send forward application',NULL,NULL),(84,'em.index','List EM Application','Listing EM Application',NULL,NULL),(85,'get_societies','List Societies','Listing Societies',NULL,NULL),(86,'get_buildings','List Buildings','Listing Buildings',NULL,NULL),(87,'get_tenants','List Tenants','Listing Tenants',NULL,NULL),(88,'soc_bill_level','Society bill level','Society bill level',NULL,NULL),(89,'update_soc_bill_level','Update Society Bill Level','Update Society Bill Level',NULL,NULL),(90,'soc_ward_colony','Society Ward Colony','Society Ward Colony',NULL,NULL),(91,'update_soc_ward_colony','Update Society Ward Colony','Update Society Ward Colony',NULL,NULL),(92,'get_wards','Get Wards','Get Wards',NULL,NULL),(93,'get_colonies','Get Colonies','Get Colonies',NULL,NULL),(94,'get_society_select','Selected Society','Selected Society',NULL,NULL),(95,'get_building_ajax','Ajax building','Ajax building',NULL,NULL),(96,'get_building_select','Selected Building','Selected Building',NULL,NULL),(97,'get_tenant_ajax','Ajax Tenant','Ajax Tenant',NULL,NULL),(98,'add_building','Add Building','Add Building',NULL,NULL),(99,'edit_building','Edir Building Data','Edir Building Data',NULL,NULL),(100,'create_building','Create Building','Create Building',NULL,NULL),(101,'update_building','Update Building','Update Building',NULL,NULL),(102,'add_tenant','Add Tenant','Add Tenant',NULL,NULL),(103,'edit_tenant','Edit Tenant','Edit Tenant',NULL,NULL),(104,'add_tenant','Add Tenant','Add Tenant',NULL,NULL),(105,'create_tenant','Create Tenant','Create Tenant',NULL,NULL),(106,'update_tenant','Update Tenant','Update Tenant',NULL,NULL),(107,'delete_tenant','Delete Tenant','Delete Tenant',NULL,NULL),(108,'generate_soc_bill','Generate Society Bill','Generate Society Bill',NULL,NULL),(109,'generate_tenant_bill','Generate Tenant Bill','Generate Tenant Bill',NULL,NULL),(110,'arrears_calculations','Arrears Calculations','Arrears Calculationst',NULL,NULL),(111,'billing_calculations','Biiling Calculations','Biiling Calculations',NULL,NULL),(112,'em_clerk.index','List EM  ClerkApplication','Listing EM Clerk Application',NULL,NULL),(113,'em_society_list','List EM  Society','Listing EM Society',NULL,NULL),(114,'em_building_list','List EM  Building','Listing EM Building',NULL,NULL),(115,'tenant_payment_list','List Tenant Payment','Listing Tenant Payment',NULL,NULL),(116,'tenant_arrear_calculation','Tenant Arrear Calculation','Tenant Arrear Calculation',NULL,NULL),(117,'create_arrear_calculation','Create Arrear Calculation','Create Arrear Calculation',NULL,NULL),(118,'rc.index','List Collected Rents','Listing Collected Rents',NULL,NULL),(119,'bill_collection_society','Bill Collection Society','Bill Collection Society',NULL,NULL),(120,'bill_collection_tenant','Bill Collection Tenant','Bill Collection Tenant',NULL,NULL),(121,'get_wards','Get Wards Select Data','Get Wards Select Data',NULL,NULL),(122,'get_colonies','Get Colonies Select Data','Get Colonies Select Data',NULL,NULL),(123,'get_society_select','Get Societies Select Data','Get Societies Select Data',NULL,NULL),(124,'get_building_select','Selected Building','Selected Building',NULL,NULL),(125,'arrears_calculations','Arrears Calculations','Arrears Calculations',NULL,NULL),(126,'billing_calculations','Billing Calculations','Billing Calculations',NULL,NULL),(127,'get_building_bill_collection','Get Buildings Bill Collection List Data','Get Buildings Bill Collection List Data',NULL,NULL),(128,'get_tenant_bill_collection','Get Tenant Bill Collection List Data','Get Tenant Bill Collection List Data',NULL,NULL),(129,'get_building_bill_collection','Building Bill Collection','Building Bill Collection',NULL,NULL),(130,'get_tenant_bill_collection','Tenant Bill Collection','Tenant Bill Collection',NULL,NULL),(131,'generate_receipt_society','Generate Receipt Society','Generate Receipt Society',NULL,NULL),(132,'generate_receipt_tenant','Generate Receipt Tenant','Generate Receipt Tenant',NULL,NULL),(133,'dyce.index','index','index',NULL,NULL),(134,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(135,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(136,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(137,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(138,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(139,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(140,'dyce.test','dyce test','dyce test',NULL,NULL),(141,'village_detail.index','List village','Listing of village',NULL,NULL),(142,'village_detail.create','Create a village','Creating a new village',NULL,NULL),(143,'village_detail.edit','Edit a village','Edit a village',NULL,NULL),(144,'village_detail.show','Show a village data','Show a village data',NULL,NULL),(145,'village_detail.update','Update a village','Updating data of a particular village',NULL,NULL),(146,'village_detail.destroy','Delete a village','Delete a particular village',NULL,NULL),(147,'loadDeleteVillageUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(148,'village_detail.store','Store a village a data','Creating a new village',NULL,NULL),(149,'society_detail.index','Society list','List all societies coming under particular village',NULL,NULL),(150,'society_detail.create','Society Create','Create society for a particular village',NULL,NULL),(151,'society_detail.store','Society Store','Store society data for a particular village',NULL,NULL),(152,'society_detail.edit','Society Edit','Edit society data for a particular village',NULL,NULL),(153,'society_detail.update','Society Update','Update society data for a particular village',NULL,NULL),(154,'society_detail.show','Show society data','Show society data',NULL,NULL),(155,'lease_detail.index','List Lease','List lease for a particular society',NULL,NULL),(156,'lease_detail.create','Create Lease','Create lease for a particular society',NULL,NULL),(157,'lease_detail.store','Store Lease','Store lease for a particular society',NULL,NULL),(158,'renew-lease.renew','Renew Lease','Renew lease for a particular society',NULL,NULL),(159,'renew-lease.update-lease','Updated Renew Lease data','Updated Renew Lease data',NULL,NULL),(160,'edit-lease.edit','Shows edit page for Edit Lease data','Shows edit page for Edit Lease data',NULL,NULL),(161,'update-lease.update','Updated Latest Lease data','Updated Latest Lease data',NULL,NULL),(162,'view-lease.view','Views Latest Lease data','Views Latest Lease data',NULL,NULL),(163,'upload_lm_checklist_and_remark_report','upload_lm_checklist_and_remark_report','upload_lm_checklist_and_remark_report',NULL,NULL),(164,'post_lm_checklist_and_remark_report','post_lm_checklist_and_remark_report','post_lm_checklist_and_remark_report',NULL,NULL),(165,'society_detail.show_end_date_lease','Shows society data with 3 days before end date for lease','Shows society data with 3 days before end date for lease',NULL,NULL),(166,'hearing.index','List Hearing','Listing of Hearing',NULL,NULL),(167,'hearing.create','Create a hearing','Creating a new hearing',NULL,NULL),(168,'hearing.edit','Edit a hearing','Edit a hearing',NULL,NULL),(169,'hearing.update','Update a hearing','Updating data of a particular hearing',NULL,NULL),(170,'hearing.destroy','Delete a hearing','Delete a particular hearing',NULL,NULL),(171,'loadDeleteReasonOfHearingUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(172,'hearing.store','Store a hearing a data','Creating a new hearing',NULL,NULL),(173,'schedule_hearing.add','Schedule Add','Add Schedule',NULL,NULL),(174,'hearing.show','Show Hearing','Display a particular hearing',NULL,NULL),(175,'schedule_hearing.store','Schedule Hearing Store','Store Schedule Hearing data',NULL,NULL),(176,'fix_schedule.add','Add Pre/Post Schedule data','Add Pre/Post Schedule data',NULL,NULL),(177,'fix_schedule.store','Store Pre/Post Schedule data','Store Pre/Post Schedule data',NULL,NULL),(178,'fix_schedule.edit','Edit Pre/Post Schedule data','Edit Pre/Post Schedule data',NULL,NULL),(179,'fix_schedule.update','Update Pre/Post Schedule data','Update Pre/Post Schedule data',NULL,NULL),(180,'upload_case_judgement.add','Upload Case Judgement data','Upload Case Judgement Pre/Post Schedule data',NULL,NULL),(181,'upload_case_judgement.store','Store Upload Case Judgement data','Store Upload Case Judgement data',NULL,NULL),(182,'upload_case_judgement.edit','Edit Upload Case Judgement data','Edit Upload Case Judgement data',NULL,NULL),(183,'upload_case_judgement.update','Update Upload Case Judgement data','Update Upload Case Judgement data',NULL,NULL),(184,'forward_case.create','Forward Case data','Forward Case Pre/Post Schedule data',NULL,NULL),(185,'forward_case.store','Store Forward Case data','Store Forward Case data',NULL,NULL),(186,'forward_case.edit','Edit Forward Case data','Edit Forward Case data',NULL,NULL),(187,'forward_case.update','Update Forward Case data','Update Forward Case data',NULL,NULL),(188,'send_notice_to_appellant.create','Send Notice data','Send Notice data',NULL,NULL),(189,'send_notice_to_appellant.store','Store Send Notice data','Store Send Notice data',NULL,NULL),(190,'send_notice_to_appellant.edit','Edit Send Notice data','Edit Send Notice data',NULL,NULL),(191,'send_notice_to_appellant.update','Update Send Notice data','Update Send Notice data',NULL,NULL),(192,'schedule_hearing.show','Shows scheduled hearing data','Shows scheduled hearing data',NULL,NULL),(193,'hearing.index','List Hearing','Listing of Hearing',NULL,NULL),(194,'hearing.show','Show Hearing','Display a particular hearing',NULL,NULL),(195,'forward_case.create','Forward Case data','Forward Case Pre/Post Schedule data',NULL,NULL),(196,'forward_case.store','Store Forward Case data','Store Forward Case data',NULL,NULL),(197,'forward_case.edit','Edit Forward Case data','Edit Forward Case data',NULL,NULL),(198,'forward_case.update','Update Forward Case data','Update Forward Case data',NULL,NULL),(199,'forward_case.show','Shows Forwarded Case data','Shows Forwarded Case data',NULL,NULL),(200,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(201,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(202,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(203,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(204,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(205,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(206,'ree.forward_application','forward application','forward application',NULL,NULL),(207,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(208,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(209,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(210,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(211,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(212,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(213,'Ree test','Ree test','Ree test',NULL,NULL),(214,'upload_ree_checklist_and_remark_report','upload_ree_checklist_and_remark_report','upload_ree_checklist_and_remark_report',NULL,NULL),(215,'post_ree_checklist_and_remark_report','post_ree_checklist_and_remark_report','post_ree_checklist_and_remark_report',NULL,NULL),(216,'architect_Layout_scrutiny_of_ee_em_lm_ree','architect_Layout_scrutiny_of_ee_em_lm_ree','architect_Layout_scrutiny_of_ee_em_lm_ree',NULL,NULL),(217,'architect_layout_prepare_layout_excel','architect_layout_prepare_layout_excel','architect_layout_prepare_layout_excel',NULL,NULL),(218,'cap.index','index','index',NULL,NULL),(219,'cap.EE_scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(220,'cap.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(221,'cap.dyce_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(222,'cap.forward_application','forward_application','forward_application',NULL,NULL),(223,'cap.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(224,'cap.cap_notes','cap notes','cap notes',NULL,NULL),(225,'cap.upload_cap_note','upload cap notes','upload cap notes',NULL,NULL),(226,'co.index','index','index',NULL,NULL),(227,'co.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(228,'co.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(229,'co.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(230,'co.forward_application','forward_application','forward_application',NULL,NULL),(231,'co.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(232,'co.download_cap_note','download_cap_note','download_cap_note',NULL,NULL),(233,'resolution.index','List Resolution','Listing of Resolutions',NULL,NULL),(234,'resolution.create','Create a resolution','Creating a new resolution',NULL,NULL),(235,'resolution.edit','Edit a resolution','Edit a resolution',NULL,NULL),(236,'resolution.update','Update a resolution','Updating data of a particular resolution',NULL,NULL),(237,'resolution.destroy','Delete a resolution','Delete a particular resolution',NULL,NULL),(238,'loadDeleteReasonOfResolutionUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(239,'resolution.store','Store a resolution a data','Creating a new resolution',NULL,NULL),(240,'frontend_resolution_list','Frontend resolution list','Frontend resolution list',NULL,NULL),(241,'rti_form','Show front end form','Show front end form',NULL,NULL),(242,'rti_form_success','Save RTI form data','Save RTI form data',NULL,NULL),(243,'rti_form_success_close','Save RTI form data','Save RTI form data',NULL,NULL),(244,'rti_form_search','RTI Form success','RTI Form success',NULL,NULL),(245,'rti_applicants','List of RTI Applicants','List of RTI Applicants',NULL,NULL),(246,'schedule_meeting','Schedule meeting','Schedule meeting',NULL,NULL),(247,'rti_schedule_meeting','Save Schedule meeting data','Save Schedule meeting data',NULL,NULL),(248,'view_applicant','View Applicant','View Applicant',NULL,NULL),(249,'update_status','Get Update Status form','Get Update Status form',NULL,NULL),(250,'rti_update_status','Save update status data','Save update status data',NULL,NULL),(251,'rti_send_info','Get RTI info form','Get RTI info form',NULL,NULL),(252,'rti_sent_info_data','Save RTI info data','Save RTI info data',NULL,NULL),(253,'rti_forwarded_application','Get Forward application form','Get Forward application form',NULL,NULL),(254,'rti_forwarded_application_data','Save Forward application form','Save Forward application form',NULL,NULL),(255,'rti_frontend_application','RTI Frontend Application','RTI Frontend Application',NULL,NULL),(256,'rti_frontend_application_status','RTI Frontend Application status','RTI Frontend Application status',NULL,NULL),(257,'vp.index','index','index',NULL,NULL),(258,'vp.EE_scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(259,'vp.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(260,'vp.dyce_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(261,'vp.forward_application','forward_application','forward_application',NULL,NULL),(262,'vp.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(263,'vp.cap_notes','cap notes','cap notes',NULL,NULL),(264,'roles.index','List Roles','Listing Roles',NULL,NULL),(265,'roles.create','Create Role','Creating role',NULL,NULL),(266,'roles.show','Create Role','Creating role',NULL,NULL),(267,'roles.store','Store Role','Storing Role',NULL,NULL),(268,'roles.edit','Edit Role','EDiting Role',NULL,NULL),(269,'roles.update','Update Role','updating Role',NULL,NULL),(270,'roles.destroy','Delete Role ','Deleting Role',NULL,NULL),(271,'loadDeleteRoleUsingAjax','Delete Roles Ajax','Deleting Roles using Ajax',NULL,NULL),(272,'architect_application','List architect Application','Listing EE Application',NULL,NULL),(273,'view_architect_application','View Architect','View Architect Application by id',NULL,NULL),(274,'evaluate_architect_application','evaluate_architect_application','evaluate_architect_application',NULL,NULL),(275,'shortlisted_architect_application','shortlisted_architect_application','shortlisted_architect_application',NULL,NULL),(276,'final_architect_application','final_architect_application','final_architect_application',NULL,NULL),(277,'save_evaluate_marks','save_evaluate_marks','save_evaluate_marks',NULL,NULL),(278,'generate_certificate','generate_certificate','generate_certificate',NULL,NULL),(279,'architect.forward_application','forward_application','forward_application',NULL,NULL),(280,'finalCertificateGenerate','finalCertificateGenerate','finalCertificateGenerate',NULL,NULL),(281,'tempCertificateGenerate','tempCertificateGenerate','tempCertificateGenerate',NULL,NULL),(282,'postfinalCertificateGenerate','postfinalCertificateGenerate','postfinalCertificateGenerate',NULL,NULL),(283,'architect.edit_certificate','architect.edit_certificate','architect.edit_certificate',NULL,NULL),(284,'architect.update_certificate','architect.update_certificate','architect.update_certificate',NULL,NULL),(285,'architect.post_final_signed_certificate','architect.post_final_signed_certificate','architect.post_final_signed_certificate',NULL,NULL),(286,'architect.post_forward_application','post_forward_application.architect','post_forward_application.architect',NULL,NULL),(287,'shortlist_architect_application','shortlist_architect_application','shortlist_architect_application',NULL,NULL),(288,'architect_layout_detail.add','architect_layout_detail.add','architect_layout_detail.add',NULL,NULL),(289,'architect_layout.add','architect_layout.add','architect_layout.add',NULL,NULL),(290,'uploadLatestLayoutAjax','uploadLatestLayoutAjax','uploadLatestLayoutAjax',NULL,NULL),(291,'architect_layout.store','architect_layout.store','architect_layout.store',NULL,NULL),(292,'architect_layout_detail.edit','architect_layout_detail.edit','architect_layout_detail.edit',NULL,NULL),(293,'architect_layout_detail_court_case_or_dispute_on_land.index','architect_layout_detail_court_case_or_dispute_on_land.index','architect_layout_detail_court_case_or_dispute_on_land.index',NULL,NULL),(294,'architect_layout_detail_court_case_or_dispute_on_land.create','architect_layout_detail_court_case_or_dispute_on_land.create','architect_layout_detail_court_case_or_dispute_on_land.create',NULL,NULL),(295,'architect_layout_detail_court_case_or_dispute_on_land.store','architect_layout_detail_court_case_or_dispute_on_land.store','architect_layout_detail_court_case_or_dispute_on_land.store',NULL,NULL),(296,'architect_layout_detail_court_case_or_dispute_on_land.edit','architect_layout_detail_court_case_or_dispute_on_land.edit','architect_layout_detail_court_case_or_dispute_on_land.edit',NULL,NULL),(297,'architect_layout_detail_court_case_or_dispute_on_land.view','architect_layout_detail_court_case_or_dispute_on_land.view','architect_layout_detail_court_case_or_dispute_on_land.view',NULL,NULL),(298,'architect_layout_detail_court_case_or_dispute_on_land.update','architect_layout_detail_court_case_or_dispute_on_land.update','architect_layout_detail_court_case_or_dispute_on_land.update',NULL,NULL),(299,'architect_layout_detail_court_case_or_dispute_on_land.destroy','architect_layout_detail_court_case_or_dispute_on_land.destroy','architect_layout_detail_court_case_or_dispute_on_land.destroy',NULL,NULL),(300,'architect_layout_detail_post_land_report','architect_layout_detail_post_land_report','architect_layout_detail_post_land_report',NULL,NULL),(301,'architect_layout_detail_delete_ree_report','architect_layout_detail_delete_ree_report','architect_layout_detail_delete_ree_report',NULL,NULL),(302,'architect_layout_detail_post_ree_report','architect_layout_detail_post_ree_report','architect_layout_detail_post_ree_report',NULL,NULL),(303,'architect_layout_detail_delete_em_report','architect_layout_detail_delete_em_report','architect_layout_detail_delete_em_report',NULL,NULL),(304,'architect_layout_detail_post_em_report','architect_layout_detail_post_em_report','architect_layout_detail_post_em_report',NULL,NULL),(305,'architect_layout_detail_delete_ee_report','architect_layout_detail_delete_ee_report','architect_layout_detail_delete_ee_report',NULL,NULL),(306,'architect_layout_detail_post_ee_report','architect_layout_detail_post_ee_report','architect_layout_detail_post_ee_report',NULL,NULL),(307,'post_architect_detail_dp_crz_remark_add','post_architect_detail_dp_crz_remark_add','post_architect_detail_dp_crz_remark_add',NULL,NULL),(308,'add_architect_detail_dp_crz_remark_add','add_architect_detail_dp_crz_remark_add','add_architect_detail_dp_crz_remark_add',NULL,NULL),(309,'delete_prc_detail','delete_prc_detail','delete_prc_detail',NULL,NULL),(310,'post_prc_detail','post_prc_detail','post_prc_detail',NULL,NULL),(311,'architect_layout_detail_prc_detail','architect_layout_detail_prc_detail','architect_layout_detail_prc_detail',NULL,NULL),(312,'delete_cts_detail','delete_cts_detail','delete_cts_detail',NULL,NULL),(313,'post_cts_detail','post_cts_detail','post_cts_detail',NULL,NULL),(314,'architect_layout_detail_cts_plan','architect_layout_detail_cts_plan','architect_layout_detail_cts_plan',NULL,NULL),(315,'uploadLayoutandExcelAjax','uploadLayoutandExcelAjax','uploadLayoutandExcelAjax',NULL,NULL),(316,'finalise_architect_application','finalise_architect_application','finalise_architect_application',NULL,NULL),(317,'upload_em_checklist_and_remark_report','upload_em_checklist_and_remark_report','upload_em_checklist_and_remark_report',NULL,NULL),(318,'post_em_checklist_and_remark_report','post_em_checklist_and_remark_report','post_em_checklist_and_remark_report',NULL,NULL),(319,'em.scrutiny_remark','em scrutiny remark','em scrutiny remark',NULL,NULL),(320,'payment_receipt_tenant','payment_receipt_tenant','payment_receipt_tenant',NULL,NULL),(321,'payment_receipt_society','payment_receipt_society','payment_receipt_society',NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_post_schedule`
--

DROP TABLE IF EXISTS `pre_post_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pre_post_schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hearing_id` int(10) unsigned NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `pre_post_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Prepone and 0=Postpone',
  `hearing_schedule_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_post_schedule_hearing_id_foreign` (`hearing_id`),
  KEY `pre_post_schedule_hearing_schedule_id_foreign` (`hearing_schedule_id`),
  CONSTRAINT `pre_post_schedule_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pre_post_schedule_hearing_schedule_id_foreign` FOREIGN KEY (`hearing_schedule_id`) REFERENCES `hearing_schedule` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_post_schedule`
--

LOCK TABLES `pre_post_schedule` WRITE;
/*!40000 ALTER TABLE `pre_post_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_post_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renewal_application_form_request`
--

DROP TABLE IF EXISTS `renewal_application_form_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renewal_application_form_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `society_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheme_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_flat_issue_date` datetime DEFAULT NULL,
  `residential_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_residential_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_registration_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_registration_date` datetime DEFAULT NULL,
  `property_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_bill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_agricultural_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_lease_agreement_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renewal_application_form_request`
--

LOCK TABLES `renewal_application_form_request` WRITE;
/*!40000 ALTER TABLE `renewal_application_form_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `renewal_application_form_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporting`
--

DROP TABLE IF EXISTS `reporting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporting` (
  `role_id` int(10) unsigned NOT NULL,
  `reporting_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`reporting_id`),
  KEY `reporting_reporting_id_foreign` (`reporting_id`),
  CONSTRAINT `reporting_reporting_id_foreign` FOREIGN KEY (`reporting_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reporting_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporting`
--

LOCK TABLES `reporting` WRITE;
/*!40000 ALTER TABLE `reporting` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resolution_types`
--

DROP TABLE IF EXISTS `resolution_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resolution_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resolution_types`
--

LOCK TABLES `resolution_types` WRITE;
/*!40000 ALTER TABLE `resolution_types` DISABLE KEYS */;
INSERT INTO `resolution_types` VALUES (1,'MHADA Resolutions','2018-10-30 03:31:17','2018-10-30 03:31:17',NULL),(2,'M.B.R & Resolutions','2018-10-30 03:31:17','2018-10-30 03:31:17',NULL),(3,'Government Resolutions','2018-10-30 03:31:17','2018-10-30 03:31:17',NULL);
/*!40000 ALTER TABLE `resolution_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resolutions`
--

DROP TABLE IF EXISTS `resolutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resolutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(10) unsigned DEFAULT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  `resolution_type_id` int(10) unsigned DEFAULT NULL,
  `resolution_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `revision_log_message` text COLLATE utf8mb4_unicode_ci,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resolutions_board_id_foreign` (`board_id`),
  KEY `resolutions_department_id_foreign` (`department_id`),
  KEY `resolutions_resolution_type_id_foreign` (`resolution_type_id`),
  CONSTRAINT `resolutions_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resolutions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resolutions_resolution_type_id_foreign` FOREIGN KEY (`resolution_type_id`) REFERENCES `resolution_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resolutions`
--

LOCK TABLES `resolutions` WRITE;
/*!40000 ALTER TABLE `resolutions` DISABLE KEYS */;
/*!40000 ALTER TABLE `resolutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_master`
--

DROP TABLE IF EXISTS `role_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_master`
--

LOCK TABLES `role_master` WRITE;
/*!40000 ALTER TABLE `role_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_module_mapping`
--

DROP TABLE IF EXISTS `role_module_mapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_module_mapping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_module_mapping`
--

LOCK TABLES `role_module_mapping` WRITE;
/*!40000 ALTER TABLE `role_module_mapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_module_mapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,2,'2018-10-30 09:01:22',NULL),(2,3,'2018-10-30 09:01:22',NULL),(3,4,'2018-10-30 09:01:22',NULL),(4,5,'2018-10-30 09:01:28',NULL),(4,30,'2018-10-30 09:01:46',NULL),(5,6,'2018-10-30 09:01:29',NULL),(6,7,'2018-10-30 09:01:29',NULL),(7,8,'2018-10-30 09:01:30',NULL),(8,9,'2018-10-30 09:01:30',NULL),(9,10,'2018-10-30 09:01:30',NULL),(10,11,'2018-10-30 09:01:31',NULL),(11,12,'2018-10-30 09:01:32',NULL),(12,13,'2018-10-30 09:01:32',NULL),(13,14,'2018-10-30 09:01:33',NULL),(14,15,'2018-10-30 09:01:33',NULL),(15,16,'2018-10-30 09:01:34',NULL),(16,17,'2018-10-30 09:01:34',NULL),(17,18,'2018-10-30 09:01:35',NULL),(18,19,'2018-10-30 09:01:35',NULL),(19,20,'2018-10-30 09:01:39',NULL),(20,21,'2018-10-30 09:01:40',NULL),(21,22,'2018-10-30 09:01:40',NULL),(22,23,'2018-10-30 09:01:40',NULL),(23,24,'2018-10-30 09:01:41',NULL),(24,25,'2018-10-30 09:01:42',NULL),(25,26,'2018-10-30 09:01:42',NULL),(26,27,'2018-10-30 09:01:43',NULL),(27,28,'2018-10-30 09:01:43',NULL),(28,29,'2018-10-30 09:01:46',NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `child_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `conveyance_child_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conveyance_parent_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'society','/society_offer_letter_dashboard',NULL,NULL,'Society Offer Letter','Login as Society',NULL,NULL,NULL,NULL,NULL),(2,'ee_engineer','/ee',NULL,'[1,3]','EE Engineer','EE Engineer',NULL,'2018-10-30 03:31:41',NULL,NULL,NULL),(3,'ee_dy_engineer','/ee',2,'[4]','EE Deputy Engineer','EE Deputy Engineer',NULL,'2018-10-30 03:31:41',NULL,NULL,NULL),(4,'ee_junior_engineer','/ee',3,NULL,'EE Junior Engineer','EE Junior Engineer',NULL,NULL,NULL,NULL,NULL),(5,'em_manager','/em',NULL,NULL,'EM Manager','EM Manager',NULL,NULL,NULL,NULL,NULL),(6,'em_clerk','/em_clerk',5,NULL,'EE Deputy Engineer','EE Deputy Engineer',NULL,NULL,NULL,NULL,NULL),(7,'rc_collector','/rc',NULL,NULL,'RC Collector','RC Collector',NULL,NULL,NULL,NULL,NULL),(8,'dyce_engineer','/dyce',NULL,'[2,9]','DYCE_Engineer','Login as DYCE Engineer',NULL,'2018-10-30 03:31:41',NULL,NULL,NULL),(9,'dyce_deputy_engineer','/dyce',8,'[10]','DYCE_deputy_Engineer','Login as DYCE deputy Engineer',NULL,'2018-10-30 03:31:41',NULL,NULL,NULL),(10,'dyce_junior_engineer','/dyce',9,NULL,'DYCE_junior_Engineer','Login as DYCE junior Engineer',NULL,NULL,NULL,NULL,NULL),(11,'LM','/village_detail',NULL,NULL,'land_manager','Login as Land Manger',NULL,NULL,NULL,NULL,NULL),(12,'Joint CO','/hearing',NULL,NULL,'joint_co','Login as Joint CO',NULL,NULL,NULL,NULL,NULL),(13,'Joint Co PA','/hearing',12,NULL,'joint_co_pa','Login as Joint CO PA',NULL,NULL,NULL,NULL,NULL),(14,'Co','/hearing',NULL,NULL,'co','Login as CO',NULL,NULL,NULL,NULL,NULL),(15,'Co PA','/hearing',14,NULL,'joint_co_pa','Login as Joint CO PA',NULL,NULL,NULL,NULL,NULL),(16,'ree_engineer','/ree_applications',NULL,'[2,8,17]','Residential Executive Engineer','Login as Residential Executive Engineer',NULL,'2018-10-30 03:31:42',NULL,NULL,NULL),(17,'REE Assistant Engineer','/ree_applications',16,'[18]','REE Assistant Engineer','Login as REE Assistant Engineer',NULL,'2018-10-30 03:31:42',NULL,NULL,NULL),(18,'REE deputy Engineer','/ree_applications',17,'[19]','REE Deputy Engineer','Login as REE Deputy Engineer',NULL,'2018-10-30 03:31:42',NULL,NULL,NULL),(19,'REE Junior Engineer','/ree_applications',18,NULL,'REE Junior Engineer','Login as REE Junior Engineer',NULL,NULL,NULL,NULL,NULL),(20,'cap_engineer','/cap',NULL,NULL,'CAP_Engineer','Login as CAP Engineer',NULL,NULL,NULL,NULL,NULL),(21,'co_engineer','/co',NULL,'[2,8,16]','Co_Engineer','Login as CO Engineer',NULL,'2018-10-30 03:31:42',NULL,NULL,NULL),(22,'RM','/resolution',NULL,NULL,'resolution_manager','Login as Resolution Manger',NULL,NULL,NULL,NULL,NULL),(23,'RTI','/rti_applicants',NULL,NULL,'rti_manager','Login as RTI Manager',NULL,NULL,NULL,NULL,NULL),(24,'vp_engineer','/vp',NULL,NULL,'VP_Engineer','Login as VP Engineer',NULL,NULL,NULL,NULL,NULL),(25,'superadmin','/crudadmin/roles',NULL,NULL,'Super Admin','Super Admin',NULL,NULL,NULL,NULL,NULL),(26,'architect','/architect_application',NULL,NULL,'Head Architect','Main Architect',NULL,NULL,NULL,NULL,NULL),(27,'senior_architect','/architect_application',26,NULL,'Senior Architect','Senior Architect',NULL,NULL,NULL,NULL,NULL),(28,'junior_architect','/architect_application',27,NULL,'Junior Architect','Junior Architect',NULL,NULL,NULL,NULL,NULL),(29,'selection_commitee','/architect_application',NULL,NULL,'Selection Commitee','Selection Commitee',NULL,NULL,NULL,NULL,NULL),(30,'EM','/conveyance',NULL,NULL,'estate_manager','Login as Estae Manger',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rti_form`
--

DROP TABLE IF EXISTS `rti_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rti_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` int(11) NOT NULL,
  `frontend_user_id` int(11) NOT NULL,
  `applicant_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_period_from` date NOT NULL,
  `info_period_to` date NOT NULL,
  `info_descr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_post_or_person` tinyint(1) NOT NULL,
  `info_post_type` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = not applicable, 1 = Ordinary,2 = Registered, 3 = Speed',
  `applicant_below_poverty_line` tinyint(1) NOT NULL COMMENT '0 = no, 1 = yes',
  `poverty_line_proof` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `rti_schedule_meeting_id` int(10) unsigned NOT NULL,
  `rti_status_id` int(10) unsigned NOT NULL,
  `rti_send_info_id` int(10) unsigned NOT NULL,
  `rti_forward_application_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rti_form_status_foreign` (`status`),
  KEY `rti_form_rti_schedule_meeting_id_foreign` (`rti_schedule_meeting_id`),
  KEY `rti_form_rti_status_id_foreign` (`rti_status_id`),
  KEY `rti_form_rti_send_info_id_foreign` (`rti_send_info_id`),
  KEY `rti_form_rti_forward_application_id_foreign` (`rti_forward_application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rti_form`
--

LOCK TABLES `rti_form` WRITE;
/*!40000 ALTER TABLE `rti_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `rti_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rti_forward_application`
--

DROP TABLE IF EXISTS `rti_forward_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rti_forward_application` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(10) unsigned NOT NULL,
  `board_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rti_forward_application_application_id_foreign` (`application_id`),
  KEY `rti_forward_application_board_id_foreign` (`board_id`),
  KEY `rti_forward_application_department_id_foreign` (`department_id`),
  CONSTRAINT `rti_forward_application_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `rti_form` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_forward_application_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_forward_application_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rti_forward_application`
--

LOCK TABLES `rti_forward_application` WRITE;
/*!40000 ALTER TABLE `rti_forward_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `rti_forward_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rti_frontend_users`
--

DROP TABLE IF EXISTS `rti_frontend_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rti_frontend_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rti_frontend_users`
--

LOCK TABLES `rti_frontend_users` WRITE;
/*!40000 ALTER TABLE `rti_frontend_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `rti_frontend_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rti_schedule_meetings`
--

DROP TABLE IF EXISTS `rti_schedule_meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rti_schedule_meetings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_scheduled_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_venue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rti_schedule_meetings`
--

LOCK TABLES `rti_schedule_meetings` WRITE;
/*!40000 ALTER TABLE `rti_schedule_meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `rti_schedule_meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rti_send_info`
--

DROP TABLE IF EXISTS `rti_send_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rti_send_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(10) unsigned NOT NULL,
  `rti_status_id` int(10) unsigned NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rti_send_info_application_id_foreign` (`application_id`),
  KEY `rti_send_info_rti_status_id_foreign` (`rti_status_id`),
  CONSTRAINT `rti_send_info_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `rti_form` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_send_info_rti_status_id_foreign` FOREIGN KEY (`rti_status_id`) REFERENCES `rti_status` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rti_send_info`
--

LOCK TABLES `rti_send_info` WRITE;
/*!40000 ALTER TABLE `rti_send_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `rti_send_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rti_status`
--

DROP TABLE IF EXISTS `rti_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rti_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL,
  `application_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rti_status_status_id_foreign` (`status_id`),
  KEY `rti_status_application_id_foreign` (`application_id`),
  CONSTRAINT `rti_status_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `rti_form` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_status_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_rti_status` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rti_status`
--

LOCK TABLES `rti_status` WRITE;
/*!40000 ALTER TABLE `rti_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `rti_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_agreement_comments`
--

DROP TABLE IF EXISTS `sc_agreement_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_agreement_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `agreement_type_id` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_agreement_comments`
--

LOCK TABLES `sc_agreement_comments` WRITE;
/*!40000 ALTER TABLE `sc_agreement_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_agreement_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_application`
--

DROP TABLE IF EXISTS `sc_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_application` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_id` int(11) NOT NULL,
  `form_request_id` int(11) DEFAULT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `draft_conveyance_application` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stamp_conveyance_application` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `undertaking` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_sub_register_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_registeration_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_registeration_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_sub_register_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_registeration_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lease_registeration_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_charge_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_allotement_available` tinyint(4) DEFAULT NULL,
  `is_society_resolution` tinyint(4) DEFAULT NULL,
  `no_due_certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `em_covering_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonafide_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `riders` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noc_conveyance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_application`
--

LOCK TABLES `sc_application` WRITE;
/*!40000 ALTER TABLE `sc_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_application_agreements`
--

DROP TABLE IF EXISTS `sc_application_agreements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_application_agreements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `draft_sale_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `draft_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_sale_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stamp_sale_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stamp_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_sale_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_sale_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_lease_agreement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_application_agreements`
--

LOCK TABLES `sc_application_agreements` WRITE;
/*!40000 ALTER TABLE `sc_application_agreements` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_application_agreements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_application_form_request`
--

DROP TABLE IF EXISTS `sc_application_form_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_application_form_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(11) DEFAULT NULL,
  `society_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheme_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_flat_issue_date` datetime DEFAULT NULL,
  `residential_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_residential_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_registration_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_registration_date` datetime DEFAULT NULL,
  `property_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_bill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_agricultural_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `template_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_application_form_request`
--

LOCK TABLES `sc_application_form_request` WRITE;
/*!40000 ALTER TABLE `sc_application_form_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_application_form_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_application_log`
--

DROP TABLE IF EXISTS `sc_application_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_application_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `society_flag` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_role_id` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_application_log`
--

LOCK TABLES `sc_application_log` WRITE;
/*!40000 ALTER TABLE `sc_application_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_application_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_checklist_master`
--

DROP TABLE IF EXISTS `sc_checklist_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_checklist_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_date` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_checklist_master`
--

LOCK TABLES `sc_checklist_master` WRITE;
/*!40000 ALTER TABLE `sc_checklist_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_checklist_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sc_checklist_scrutiny_status`
--

DROP TABLE IF EXISTS `sc_checklist_scrutiny_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sc_checklist_scrutiny_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sc_checklist_scrutiny_status`
--

LOCK TABLES `sc_checklist_scrutiny_status` WRITE;
/*!40000 ALTER TABLE `sc_checklist_scrutiny_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `sc_checklist_scrutiny_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `send_notice_to_appellant`
--

DROP TABLE IF EXISTS `send_notice_to_appellant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `send_notice_to_appellant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hearing_id` int(10) unsigned NOT NULL,
  `upload_notice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_notice_filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `send_notice_to_appellant_hearing_id_foreign` (`hearing_id`),
  CONSTRAINT `send_notice_to_appellant_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `send_notice_to_appellant`
--

LOCK TABLES `send_notice_to_appellant` WRITE;
/*!40000 ALTER TABLE `send_notice_to_appellant` DISABLE KEYS */;
/*!40000 ALTER TABLE `send_notice_to_appellant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_charges_rates`
--

DROP TABLE IF EXISTS `service_charges_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_charges_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(10) unsigned NOT NULL,
  `building_id` int(10) unsigned NOT NULL,
  `year` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_charges` decimal(10,2) DEFAULT NULL,
  `electric_city_charge` decimal(10,2) DEFAULT NULL,
  `pump_man_and_repair_charges` decimal(10,2) DEFAULT NULL,
  `external_expender_charge` decimal(10,2) DEFAULT NULL,
  `administrative_charge` decimal(10,2) DEFAULT NULL,
  `lease_rent` decimal(10,2) DEFAULT NULL,
  `na_assessment` decimal(10,2) DEFAULT NULL,
  `other` decimal(10,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_charges_rates_society_id_foreign` (`society_id`),
  KEY `service_charges_rates_building_id_foreign` (`building_id`),
  CONSTRAINT `service_charges_rates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_charges_rates`
--

LOCK TABLES `service_charges_rates` WRITE;
/*!40000 ALTER TABLE `service_charges_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_charges_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `society_agrement_type_master`
--

DROP TABLE IF EXISTS `society_agrement_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `society_agrement_type_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agreement_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `society_agrement_type_master`
--

LOCK TABLES `society_agrement_type_master` WRITE;
/*!40000 ALTER TABLE `society_agrement_type_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `society_agrement_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `society_application_document_type`
--

DROP TABLE IF EXISTS `society_application_document_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `society_application_document_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `society_application_document_type`
--

LOCK TABLES `society_application_document_type` WRITE;
/*!40000 ALTER TABLE `society_application_document_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `society_application_document_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `society_bank_details`
--

DROP TABLE IF EXISTS `society_bank_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `society_bank_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `society_bank_details`
--

LOCK TABLES `society_bank_details` WRITE;
/*!40000 ALTER TABLE `society_bank_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `society_bank_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `society_conveyance_document_master`
--

DROP TABLE IF EXISTS `society_conveyance_document_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `society_conveyance_document_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_type_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `society_conveyance_document_master`
--

LOCK TABLES `society_conveyance_document_master` WRITE;
/*!40000 ALTER TABLE `society_conveyance_document_master` DISABLE KEYS */;
INSERT INTO `society_conveyance_document_master` VALUES (1,'अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे)',1,2,NULL,NULL),(2,'संस्था नोंदणी प्रमाणपत्राची प्रत',1,2,NULL,NULL),(3,'कार्यकारणी यादी',1,2,NULL,NULL),(4,'पावती',1,2,NULL,NULL);
/*!40000 ALTER TABLE `society_conveyance_document_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `society_conveyance_document_status`
--

DROP TABLE IF EXISTS `society_conveyance_document_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `society_conveyance_document_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `conveyance_document_id` int(11) DEFAULT NULL,
  `document_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `society_conveyance_document_status`
--

LOCK TABLES `society_conveyance_document_status` WRITE;
/*!40000 ALTER TABLE `society_conveyance_document_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `society_conveyance_document_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `society_offer_letters`
--

DROP TABLE IF EXISTS `society_offer_letters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `society_offer_letters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `society_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_building_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_registration_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_architect_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_architect_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_architect_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_architect_telephone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `society_offer_letters`
--

LOCK TABLES `society_offer_letters` WRITE;
/*!40000 ALTER TABLE `society_offer_letters` DISABLE KEYS */;
/*!40000 ALTER TABLE `society_offer_letters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_bill_generate`
--

DROP TABLE IF EXISTS `trans_bill_generate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_bill_generate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_bill` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrear_bill` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bill` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_bill_generate`
--

LOCK TABLES `trans_bill_generate` WRITE;
/*!40000 ALTER TABLE `trans_bill_generate` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_bill_generate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_payment`
--

DROP TABLE IF EXISTS `trans_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_of_payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_payment`
--

LOCK TABLES `trans_payment` WRITE;
/*!40000 ALTER TABLE `trans_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_case_judgement`
--

DROP TABLE IF EXISTS `upload_case_judgement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_case_judgement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hearing_id` int(10) unsigned NOT NULL,
  `upload_judgement_case` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judgement_case_filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_case_judgement_hearing_id_foreign` (`hearing_id`),
  CONSTRAINT `upload_case_judgement_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_case_judgement`
--

LOCK TABLES `upload_case_judgement` WRITE;
/*!40000 ALTER TABLE `upload_case_judgement` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_case_judgement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `uploaded_note_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_start_date` date DEFAULT NULL,
  `service_end_date` date DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nitin Gadkari','user1@gmail.com','$2y$10$WLYgBJ1aFeNV9zxbF2dQqO5ggzBb7bi37tSDdDfjRWij3DN5QdDpi',2,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(2,'Amit Kadam','user2@gmail.com','$2y$10$bxhnLJRSjKi6thc4/EGxh.jaD7W/.CcMexyS72JJhuDQ703IRP55C',3,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(3,'Suryakant Teli','user3@gmail.com','$2y$10$FCkKrbkGIJXPolFQ4KMRkOR4oIYO3xTQtCd6MlV51ePh6BMtir.HK',4,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(4,'EM Manager','em@gmail.com','$2y$10$WNI6ig116LO6qTTqJU7Dduvm0cIIO.AFXx2Huo63Yi.TsFM3GYwkW',5,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(5,'Amit Kadam','em_clerk@gmail.com','$2y$10$0fcO6k0vNAFcmgG2qAmuZOvu2q3miSRr8vb6CY9BbrJ3JPVj2Zzoq',6,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(6,'Amit Kadam','rc@gmail.com','$2y$10$cTQnl8LDkNKJb47t/.dGDObw6dJck/brHf0WhRJzoeLC6c9JIBO7e',7,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(7,'Bhavana.Salunkhe','bhavnasalunkhe@neosofttech.com','$2y$10$kU7j94uAU4CiAxuqaGz4yOO3fpgobpVRlQIwSeQJWdzXLJOJAqnT6',8,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(8,'dyce_deputy','dyce1@gmail.com','$2y$10$GZ2llF7UN12N3ntUqy6CMOo6hoBQBa.Yo/uxUmZJaM5PHMzDxs2si',9,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(9,'dyce_JR','dyce2@gmail.com','$2y$10$70.VAG3IQVI7zRsdTveNautOKlVPpS6e6t9r07DDBykw7DSrKs2JW',10,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(10,'martin.philipose','martin.philipose@wwindia.com','$2y$10$ZONwqabAJoqOETibjVXq0eboQP3EVfIJbesqlpYKCE7IxbK2ksqaK',11,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(11,'Joint CO','jointco@gmail.com','$2y$10$am/n1D/Bd2Tktt5whoTRmuBYWOaCAg.k5didtId5ocqVIqoGPa05.',12,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(12,'Joint CO PA','jointcopa@gmail.com','$2y$10$SiEFS40ttohLlfecONX7k./Fj6ndE4xwpmG.ePOKLOW1S4z/tNUQ.',13,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(13,'CO','hearingco@gmail.com','$2y$10$yyzTqWdSQP5ho9sordHsJut4aWBYUHQWgAZI9yHR4Ks4xji7.9vV6',14,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(14,'CO PA','copa@gmail.com','$2y$10$vgVEOoBcQkLI24GkMDi9YuZ7V8VJKjaOvmWNZ0cz.scqo8zLgjrWi',15,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(15,'Neelam','neelam1.tambe@wwindia.com','$2y$10$EJofmgtwzZ.LxIvwClKYuO.9rLzFZU/mOVQMV5HpNsdMFT41eEyVC',16,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(16,'REE1','ree1@gmail.com','$2y$10$2LbG4iC3LrzNPvr87Y9fAObpMaXvU56a0KoM1PLAHTFTVBFq0esOe',17,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(17,'REE2','ree2@gmail.com','$2y$10$vTEOUD1gQHt1E86vHvz/EuqIrfWqxUALeVeJO5Wc82C/GMqMiBfKu',18,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(18,'REE3','ree3@gmail.com','$2y$10$WGjtHgcwTFo7.5Nky9qffeCAda1W1X0Kr.vF8yvYYTXwwcWM5gk6S',19,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(19,'cap user','cap@gmail.com','$2y$10$GOhHedbSJv1Iv7n9iWT.h.Q8W2zBFpaSNM3zflxbpPAig5uZ2reNG',20,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(20,'CO','co@gmail.com','$2y$10$NloNU7EWnYYXI0J1CkbB5exbMQK6AvwzOtU6Axg5zsYGml7Yo0QSC',21,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(21,'Resolution Manager','resolution@gmail.com','$2y$10$5eIY6NOeAjDuZVmDV3YOq.zwwUVQo8ONdm8d451HX1TV0actg1rUO',22,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(22,'RTI Manager','rti@gmail.com','$2y$10$VGNc4vYUpmIraS8/0NAS8.fdB3MaAXEh63WScypD1C5h7qI06jmD6',23,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(23,'VP user','vp@gmail.com','$2y$10$nHpTpf/YoKtf74TeGCD81uknZNrzHqeKFzyFfwhI2KxOVg317Vgty',24,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(24,'Super Admin','superadmin@gmail.com','$2y$10$JOzJmt8/mzE3.2Jff4QnquGGKcOQu7XSE0q21n1slSYeIYgkrmlDW',25,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(25,'Sudesh Jadhav','sudesh@gmail.com','$2y$10$Ycpm.giq7Su61G89CRJ.aONTJGZEdIYWHdDEgabFCFN1t9GLlp0gS',26,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'8585868585','Mumbai'),(26,'Senior Architect','senior_architect@gmail.com','$2y$10$v.aocmQu2/xPFbYzW8kGyuw7VX4ZwqMuo0LAAoRHa0J1AUXmnUHYi',27,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'8787878785','Mumbai'),(27,'Junior Architect','junior_architect@gmail.com','$2y$10$6vogPAyXRC8zqSzK9B7C3OwKweqkxa/vFD.gaY/d3yyWTa6Pw7e1K',28,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9696565856','Mumbai'),(28,'Amar Prajapati','amar.prajapati@gmail.com','$2y$10$b53MElQjqQFnEu.fV/3UQew9AjV/r2q4V5dtxupo7gtkPp.c706/6',29,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'8585652545','Mumbai');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `village_societies`
--

DROP TABLE IF EXISTS `village_societies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `village_societies` (
  `village_id` int(10) unsigned NOT NULL,
  `society_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`village_id`,`society_id`),
  KEY `village_societies_society_id_foreign` (`society_id`),
  CONSTRAINT `village_societies_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `lm_society_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `village_societies_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `lm_village_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village_societies`
--

LOCK TABLES `village_societies` WRITE;
/*!40000 ALTER TABLE `village_societies` DISABLE KEYS */;
/*!40000 ALTER TABLE `village_societies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-31 12:49:39
