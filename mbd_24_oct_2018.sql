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
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_options` tinyint(4) NOT NULL DEFAULT '0',
  `label1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ee_scrunity_question_master`
--

LOCK TABLES `architect_layout_ee_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_ee_scrunity_question_master` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_em_scrunity_question_master`
--

LOCK TABLES `architect_layout_em_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_em_scrunity_question_master` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_lm_scrunity_question_master`
--

LOCK TABLES `architect_layout_lm_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_lm_scrunity_question_master` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architect_layout_ree_scrunity_question_master`
--

LOCK TABLES `architect_layout_ree_scrunity_question_master` WRITE;
/*!40000 ALTER TABLE `architect_layout_ree_scrunity_question_master` DISABLE KEYS */;
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
  KEY `arrear_calculation_society_id_foreign` (`society_id`),
  CONSTRAINT `arrear_calculation_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`),
  CONSTRAINT `arrear_calculation_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `master_tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrear_calculation`
--

LOCK TABLES `arrear_calculation` WRITE;
/*!40000 ALTER TABLE `arrear_calculation` DISABLE KEYS */;
INSERT INTO `arrear_calculation` VALUES (1,2,1,'1','2018','2017','1','4.80','80','2017','1','48.00','1','152.80',NULL,'2018-10-23 06:20:11','2018-10-23 06:20:11'),(2,4,1,'1','2018','2017','1','4.80','80','2017','1','48.00','1','152.80',NULL,'2018-10-23 09:52:01','2018-10-23 09:52:01'),(3,3,1,'1','2018','2017','7','2.40','80','2017','10','12.00','0','114.40',NULL,'2018-10-23 09:53:04','2018-10-23 09:53:04'),(4,3,1,'1','2018','2017','1','4.80','80','2017','10','12.00','1','116.80',NULL,'2018-10-23 09:56:16','2018-10-23 09:56:16');
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
  `year` year(4) DEFAULT NULL,
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
  CONSTRAINT `arrears_charges_rates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`),
  CONSTRAINT `arrears_charges_rates_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrears_charges_rates`
--

LOCK TABLES `arrears_charges_rates` WRITE;
/*!40000 ALTER TABLE `arrears_charges_rates` DISABLE KEYS */;
INSERT INTO `arrears_charges_rates` VALUES (1,1,1,2018,'EWS',20.00,100.00,5.00,2.00,NULL,NULL,NULL),(2,2,3,2018,'EWS',20.00,100.00,5.00,2.00,NULL,NULL,NULL),(4,1,2,2018,'EWS',20.00,100.00,5.00,2.00,NULL,NULL,NULL);
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
INSERT INTO `board_user` VALUES (1,1,8,'2018-10-13 02:42:19','2018-10-13 02:42:19'),(2,1,9,'2018-10-13 02:42:19','2018-10-13 02:42:19'),(3,1,10,'2018-10-13 02:42:19','2018-10-13 02:42:19'),(4,1,11,'2018-10-13 02:42:19','2018-10-13 02:42:19');
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
INSERT INTO `boards` VALUES (1,'Mumbai Board',1,'2018-10-13 02:41:55','2018-10-13 02:41:55');
/*!40000 ALTER TABLE `boards` ENABLE KEYS */;
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
INSERT INTO `departments` VALUES (1,'Department 1',1,'2018-10-13 02:41:55','2018-10-13 02:41:55'),(2,'Joint CO',1,'2018-10-13 02:42:19','2018-10-13 02:42:19'),(3,'Co',1,'2018-10-13 02:42:19','2018-10-13 02:42:19');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
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
INSERT INTO `hearing_application_type` VALUES (1,'Application or claim','2018-10-13 02:41:55','2018-10-13 02:41:55'),(2,'Appeal','2018-10-13 02:41:55','2018-10-13 02:41:55'),(3,'Redressal','2018-10-13 02:41:55','2018-10-13 02:41:55');
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
INSERT INTO `hearing_status` VALUES (1,'Pending','2018-10-13 02:41:55','2018-10-13 02:41:55'),(2,'Scheduled Meeting','2018-10-13 02:41:55','2018-10-13 02:41:55'),(3,'Case Under Judgement','2018-10-13 02:41:55','2018-10-13 02:41:55'),(4,'Forwarded','2018-10-13 02:41:55','2018-10-13 02:41:55'),(5,'Notice Send','2018-10-13 02:41:55','2018-10-13 02:41:55'),(6,'Case Closed','2018-10-13 02:41:55','2018-10-13 02:41:55');
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
INSERT INTO `land_source` VALUES (1,'Acquired land',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(2,'Government Land',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(3,'Purchased Land',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(4,'Other land',1,'2018-10-13 02:41:56','2018-10-13 02:41:56');
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
INSERT INTO `language_master` VALUES (1,'English','2018-10-13 02:41:57','2018-10-13 02:41:57'),(2,'marathi','2018-10-13 02:41:57','2018-10-13 02:41:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layout_user`
--

LOCK TABLES `layout_user` WRITE;
/*!40000 ALTER TABLE `layout_user` DISABLE KEYS */;
INSERT INTO `layout_user` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,12),(8,1,13),(9,1,14),(10,1,15),(11,1,16),(12,1,17),(13,1,20),(14,1,22),(16,2,22),(17,2,23),(18,1,23),(19,1,24),(20,2,24);
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
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cts_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chairman` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_on_service_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surplus_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surplus_charges_last_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_land_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lm_society_detail_other_land_id_foreign` (`other_land_id`),
  CONSTRAINT `lm_society_detail_other_land_id_foreign` FOREIGN KEY (`other_land_id`) REFERENCES `other_land` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lm_society_detail`
--

LOCK TABLES `lm_society_detail` WRITE;
/*!40000 ALTER TABLE `lm_society_detail` DISABLE KEYS */;
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
  `7_12_extract` tinyint(1) DEFAULT NULL COMMENT '1=upload and 0= not upload',
  `7_12_mhada_name` tinyint(1) DEFAULT NULL,
  `property_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `building_no` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_buildings_society_id_foreign` (`society_id`),
  CONSTRAINT `master_buildings_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_buildings`
--

LOCK TABLES `master_buildings` WRITE;
/*!40000 ALTER TABLE `master_buildings` DISABLE KEYS */;
INSERT INTO `master_buildings` VALUES (1,1,'145','Building one 1','Building one 1',NULL,NULL),(2,1,'290','Building one 2','Building one 2',NULL,NULL),(3,2,'435','Building one 1','Building one 1',NULL,NULL),(4,2,'580','Building one 2','Building one 2',NULL,NULL),(5,3,'725','Building one 1','Building one 1',NULL,NULL),(6,3,'870','Building one 2','Building one 2',NULL,NULL),(7,4,'1015','Building one 1','Building one 1',NULL,NULL),(8,4,'1160','Building one 2','Building one 2',NULL,NULL),(9,5,'1305','Building one 1','Building one 1',NULL,NULL),(10,5,'1450','Building one 2','Building one 2',NULL,NULL),(11,6,'1595','Building one 1','Building one 1',NULL,NULL),(12,6,'1740','Building one 2','Building one 2',NULL,NULL),(13,7,'1885','Building one 1','Building one 1',NULL,NULL),(14,7,'2030','Building one 2','Building one 2',NULL,NULL),(15,8,'2175','Building one 1','Building one 1',NULL,NULL),(16,8,'2320','Building one 2','Building one 2',NULL,NULL),(17,9,'2465','Building one 1','Building one 1',NULL,NULL),(18,9,'2610','Building one 2','Building one 2',NULL,NULL),(19,10,'2755','Building one 1','Building one 1',NULL,NULL),(20,10,'2900','Building one 2','Building one 2',NULL,NULL),(21,11,'3045','Building one 1','Building one 1',NULL,NULL),(22,11,'3190','Building one 2','Building one 2',NULL,NULL),(23,12,'3335','Building one 1','Building one 1',NULL,NULL),(24,12,'3480','Building one 2','Building one 2',NULL,NULL),(25,13,'3625','Building one 1','Building one 1',NULL,NULL),(26,13,'3770','Building one 2','Building one 2',NULL,NULL),(27,14,'3915','Building one 1','Building one 1',NULL,NULL),(28,14,'4060','Building one 2','Building one 2',NULL,NULL),(29,15,'4205','Building one 1','Building one 1',NULL,NULL),(30,15,'4350','Building one 2','Building one 2',NULL,NULL),(31,16,'4495','Building one 1','Building one 1',NULL,NULL),(32,16,'4640','Building one 2','Building one 2',NULL,NULL),(33,1,'45246','TESTPRODUCT','TESTPRODUCT','2018-10-15 10:03:11','2018-10-15 10:03:11'),(34,1,'564696','pendre uasd ayhsdgj','pendre uasd ayhsdgj','2018-10-15 10:06:52','2018-10-15 10:06:52'),(35,1,'100','pendre uasd ayhsdgj rrrr','pendre uasd ayhsdgj rrrr','2018-10-15 10:06:52','2018-10-15 10:21:54'),(36,4,'as54','Reesfsdjgs fjksdfhsjkgh','Reesfsdjgs fjksdfhsjkgh','2018-10-15 10:25:03','2018-10-15 10:25:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_colonies`
--

LOCK TABLES `master_colonies` WRITE;
/*!40000 ALTER TABLE `master_colonies` DISABLE KEYS */;
INSERT INTO `master_colonies` VALUES (1,1,'Colony 1 ward 1 Layout 1','Colony 1 ward 1 Layout 1',NULL,NULL),(2,1,'Colony 2 ward 1 Layout 1','Colony 2 ward 1 Layout 1',NULL,NULL),(3,1,'Colony 3 ward 1 Layout 1','Colony 3 ward 1 Layout 1',NULL,NULL),(4,1,'Colony 4 ward 1 Layout 1','Colony 4 ward 1 Layout 1',NULL,NULL),(5,2,'Colony 1 ward 2 Layout 1','Colony 1 ward 2 Layout 1',NULL,NULL),(6,2,'Colony 2 ward 2 Layout 1','Colony 2 ward 2 Layout 1',NULL,NULL),(7,2,'Colony 3 ward 2 Layout 1','Colony 3 ward 2 Layout 1',NULL,NULL),(8,2,'Colony 4 ward 2 Layout 1','Colony 4 ward 2 Layout 1',NULL,NULL),(9,3,'Colony 1 ward 3 Layout 1','Colony 1 ward 3 Layout 1',NULL,NULL),(10,3,'Colony 2 ward 3 Layout 1','Colony 2 ward 3 Layout 1',NULL,NULL),(11,3,'Colony 3 ward 3 Layout 1','Colony 3 ward 3 Layout 1',NULL,NULL),(12,3,'Colony 4 ward 3 Layout 1','Colony 4 ward 3 Layout 1',NULL,NULL),(13,4,'Colony 1 ward 1 Layout 2','Colony 1 ward 1 Layout 2',NULL,NULL),(14,4,'Colony 2 ward 1 Layout 2','Colony 2 ward 1 Layout 2',NULL,NULL),(15,4,'Colony 3 ward 1 Layout 2','Colony 3 ward 1 Layout 2',NULL,NULL),(16,4,'Colony 4 ward 1 Layout 2','Colony 4 ward 1 Layout 2',NULL,NULL),(17,5,'Colony 1 ward 2 Layout 2','Colony 1 ward 2 Layout 2',NULL,NULL),(18,5,'Colony 2 ward 2 Layout 2','Colony 2 ward 2 Layout 2',NULL,NULL),(19,5,'Colony 3 ward 2 Layout 2','Colony 3 ward 2 Layout 2',NULL,NULL),(20,5,'Colony 4 ward 2 Layout 2','Colony 4 ward 2 Layout 2',NULL,NULL),(21,6,'Colony 1 ward 3 Layout 2','Colony 1 ward 3 Layout 2',NULL,NULL),(22,6,'Colony 2 ward 3 Layout 2','Colony 2 ward 3 Layout 2',NULL,NULL),(23,6,'Colony 3 ward 3 Layout 2','Colony 3 ward 3 Layout 2',NULL,NULL),(24,6,'Colony 4 ward 3 Layout 2','Colony 4 ward 3 Layout 2',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_layout`
--

LOCK TABLES `master_layout` WRITE;
/*!40000 ALTER TABLE `master_layout` DISABLE KEYS */;
INSERT INTO `master_layout` VALUES (1,'Samata Nagar, Kandivali(E)','Borivali','Mumbai',NULL,NULL),(2,'Demo Nagar, Kandivali(E)','Borivali','Mumbai',NULL,NULL),(3,'Dummy Nagar, Kandivali(E)','Borivali','Mumbai',NULL,NULL);
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
INSERT INTO `master_month` VALUES (1,'January','2018-10-13 02:41:57','2018-10-13 02:41:57'),(2,'February','2018-10-13 02:41:57','2018-10-13 02:41:57'),(3,'March','2018-10-13 02:41:57','2018-10-13 02:41:57'),(4,'April','2018-10-13 02:41:57','2018-10-13 02:41:57'),(5,'May','2018-10-13 02:41:57','2018-10-13 02:41:57'),(6,'June','2018-10-13 02:41:57','2018-10-13 02:41:57'),(7,'July','2018-10-13 02:41:57','2018-10-13 02:41:57'),(8,'August','2018-10-13 02:41:57','2018-10-13 02:41:57'),(9,'September','2018-10-13 02:41:57','2018-10-13 02:41:57'),(10,'October','2018-10-13 02:41:57','2018-10-13 02:41:57'),(11,'November','2018-10-13 02:41:57','2018-10-13 02:41:57'),(12,'December','2018-10-13 02:41:57','2018-10-13 02:41:57');
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
INSERT INTO `master_rti_status` VALUES (1,'Send RTI Officer','2018-10-13 02:41:56','2018-10-13 02:41:56'),(2,'In Process/Waiting for Meeting Schedule Time','2018-10-13 02:41:56','2018-10-13 02:41:56'),(3,'Meeting is Scheduled','2018-10-13 02:41:57','2018-10-13 02:41:57'),(4,'Closed','2018-10-13 02:41:57','2018-10-13 02:41:57');
/*!40000 ALTER TABLE `master_rti_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_societies`
--

DROP TABLE IF EXISTS `master_societies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_societies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `colony_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `society_bill_level` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_societies_colony_id_foreign` (`colony_id`),
  CONSTRAINT `master_societies_colony_id_foreign` FOREIGN KEY (`colony_id`) REFERENCES `master_colonies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_societies`
--

LOCK TABLES `master_societies` WRITE;
/*!40000 ALTER TABLE `master_societies` DISABLE KEYS */;
INSERT INTO `master_societies` VALUES (1,7,'society 1','society 1','1',NULL,'2018-10-22 05:38:15'),(2,1,'society 2','society 2','2',NULL,'2018-10-15 04:57:20'),(3,8,'society 1','society 1','2',NULL,'2018-10-15 09:07:31'),(4,2,'society 2','society 2',NULL,NULL,NULL),(5,3,'society 1','society 1',NULL,NULL,NULL),(6,3,'society 2','society 2','1',NULL,'2018-10-15 05:01:06'),(7,4,'society 1','society 1',NULL,NULL,NULL),(8,4,'society 2','society 2',NULL,NULL,NULL),(9,5,'society 1','society 1',NULL,NULL,NULL),(10,5,'society 2','society 2',NULL,NULL,NULL),(11,6,'society 1','society 1',NULL,NULL,NULL),(12,6,'society 2','society 2',NULL,NULL,NULL),(13,7,'society 1','society 1',NULL,NULL,NULL),(14,7,'society 2','society 2',NULL,NULL,NULL),(15,8,'society 1','society 1',NULL,NULL,NULL),(16,8,'society 2','society 2',NULL,NULL,NULL);
/*!40000 ALTER TABLE `master_societies` ENABLE KEYS */;
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
INSERT INTO `master_society_bill_level` VALUES (1,'Society Level Billing','Society Level Billing','2018-10-14 18:30:00','2018-10-14 18:30:00'),(2,'Tenant Level Billing','Tenant Level Billing','2018-10-14 18:30:00','2018-10-14 18:30:00');
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
INSERT INTO `master_tenant_type` VALUES (1,'EWS','EWS',NULL,NULL),(2,'LIG','LIG',NULL,NULL),(3,'MIG','MIG',NULL,NULL),(4,'HIG','HIG',NULL,NULL);
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
  `flat_no` varchar(195) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salutation` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carpet_area` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_type` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_tenants_building_id_foreign` (`building_id`),
  CONSTRAINT `master_tenants_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_tenants`
--

LOCK TABLES `master_tenants` WRITE;
/*!40000 ALTER TABLE `master_tenants` DISABLE KEYS */;
INSERT INTO `master_tenants` VALUES (2,1,'103','Mr.','adas sdfsdfsf','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL),(3,2,'103','Mr.','rgs dfsgdfg dfg','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL),(4,2,'103','Mr.','adas sdfsdfsf','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL),(5,3,'103','Mr.','rgs dfsgdfg dfg','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL),(6,3,'103','Mr.','adas sdfsdfsf','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL),(7,4,'103','Mr.','rgs dfsgdfg dfg','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL),(8,4,'103','Mr.','adas sdfsdfsf','test','Test',NULL,NULL,'Residential','590 Sq meter','EWS',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_wards`
--

LOCK TABLES `master_wards` WRITE;
/*!40000 ALTER TABLE `master_wards` DISABLE KEYS */;
INSERT INTO `master_wards` VALUES (1,1,'Ward 1 Layout 1','Ward 1 layout 1','2018-10-12 18:30:00','2018-10-12 18:30:00'),(2,1,'Ward 2 Layout 1','Ward 2 layout 1','2018-10-12 18:30:00','2018-10-12 18:30:00'),(3,1,'Ward 3 Layout 1','Ward 3 layout 1','2018-10-12 18:30:00','2018-10-12 18:30:00'),(4,2,'Ward 1 Layout 2','Ward 1 layout 2','2018-10-12 18:30:00','2018-10-12 18:30:00'),(5,2,'Ward 2 Layout 2','Ward 2 layout 2','2018-10-12 18:30:00','2018-10-12 18:30:00'),(6,2,'Ward 3 Layout 2','Ward 3 layout 2','2018-10-12 18:30:00','2018-10-12 18:30:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_08_20_142459_create_board_table',1),(4,'2018_08_20_142849_create_departments_table',1),(5,'2018_08_20_144538_create_faqs_table',1),(6,'2018_08_20_150324_create_board_departments_table',1),(7,'2018_08_21_055217_alter_faqs_rename_deptname_to_question',1),(8,'2018_08_22_090450_create_frontend_users_table',1),(9,'2018_08_22_133448_create_table_resolution_types',1),(10,'2018_08_22_133449_create_table_resolutions',1),(11,'2018_08_22_135352_create_rti_form_table',1),(12,'2018_08_23_070343_create_table_deleted_resolutions',1),(13,'2018_08_24_121710_alter_rti_form_table_add_unique_field',1),(14,'2018_08_26_161705_alter_rti_fom_table_make_poerty_file_nullable',1),(15,'2018_08_27_115459_create_hearing_application_type',1),(16,'2018_08_27_121033_create_hearing_status',1),(17,'2018_08_27_121805_create_hearing_table',1),(18,'2018_08_29_063730_create_schedule_hearing_table',1),(19,'2018_08_30_063609_create_pre_post_schedule_table',1),(20,'2018_08_30_064205_create_rti_schedule_meeting_table',1),(21,'2018_08_30_120317_add_user_id_to_rti_form_table',1),(22,'2018_08_30_132915_create_master_rti_status',1),(23,'2018_08_30_134316_add_status_rti_form_table',1),(24,'2018_08_30_140429_create_upload_case_judgement_table',1),(25,'2018_08_31_043327_add_send_info_fields_rti_form_table',1),(26,'2018_08_31_052231_add_user_id_rti_form_table',1),(27,'2018_08_31_061605_add_rti_remark_forward_application_rti_form_table',1),(28,'2018_08_31_064811_add_board_id_to_hearing_table',1),(29,'2018_08_31_065843_alter_rti_schedule_meetings_application_no_table',1),(30,'2018_08_31_092607_create_deleted_hearing_table',1),(31,'2018_08_31_095842_create_forward_case_table',1),(32,'2018_08_31_100703_create_rti_status_table',1),(33,'2018_08_31_104117_alter_status_rti_form_table',1),(34,'2018_08_31_111937_alter_status_col_rti_form_table',1),(35,'2018_08_31_123310_final_drop_rti_status_id_rti_form_table',1),(36,'2018_08_31_123356_add_rti_status_id_rti_form_table',1),(37,'2018_08_31_123756_create_send_notice_to_appellant_table',1),(38,'2018_08_31_133408_drop_rti_send_info_fields_rti_form_table',1),(39,'2018_08_31_135124_create_rti_send_info_table',1),(40,'2018_08_31_140033_add_rti_send_info_id_rti_form_table',1),(41,'2018_09_01_041314_create_rti_forward_application_table',1),(42,'2018_09_01_042046_drop_remarks_rti_form_table',1),(43,'2018_09_01_042235_add_rti_forward_application_id_rti_form_table',1),(44,'2018_09_01_044544_add_filename_column_to_forward_case',1),(45,'2018_09_01_055059_create_land_source_table',1),(46,'2018_09_01_061007_create_other_land_table',1),(47,'2018_09_01_075702_create_village_detail_table',1),(48,'2018_09_01_075818_create_society_detail_table',1),(49,'2018_09_01_075828_create_lease_detail_table',1),(50,'2018_09_01_094805_add_mobile_no_users_table',1),(51,'2018_09_01_095427_create_architect_application_table',1),(52,'2018_09_01_095701_add_address_users_table',1),(53,'2018_09_01_113159_create_architect_application_marks_table',1),(54,'2018_09_01_120744_create_architect_application_status_logs_table',1),(55,'2018_09_03_043009_create_master_month_table',1),(56,'2018_09_03_073312_add_status_to_lease_detail',1),(57,'2018_09_03_174609_alter_architect_applicaton_marks_add_document_name_field',1),(58,'2018_09_04_192313_alter_architect_application_marks_add_final_certi_flag',1),(59,'2018_09_06_050425_roles_setup_table',1),(60,'2018_09_06_091427_create_deleted_village_details',1),(61,'2018_09_07_024149_create_society_offer_letters_table',1),(62,'2018_09_07_074325_create_master_email_templates_table',1),(63,'2018_09_10_041214_create_language_master_table',1),(64,'2018_09_10_043011_create_ol_application_master_table',1),(65,'2018_09_10_043619_create_ol_societies_table',1),(66,'2018_09_10_044938_create_ol_society_documents_master_table',1),(67,'2018_09_10_045245_create_ol_society_document_status_table',1),(68,'2018_09_10_052202_add_role_id_to_users_table',1),(69,'2018_09_10_052554_create_role_master_table',1),(70,'2018_09_10_052743_create_module_master_table',1),(71,'2018_09_10_052949_create_role_module_mapping_table',1),(72,'2018_09_10_053206_create_ol_status_master_table',1),(73,'2018_09_10_053839_create_ol_applications_table',1),(74,'2018_09_10_055255_create_ol_application_status_log_table',1),(75,'2018_09_10_060811_create_ol_site_visit_documents_table',1),(76,'2018_09_10_061125_create_ol_dcr_rate_master_table',1),(77,'2018_09_10_061308_create_ol_application_calculation_sheet_details_table',1),(78,'2018_09_10_063022_create_ol_application_checklist_scrunity_details_table',1),(79,'2018_09_10_064615_create_ol_consent_verification_question_master_table',1),(80,'2018_09_10_064857_create_ol_consent_verification_details_table',1),(81,'2018_09_10_065527_create_ol_demarcation_question_master_table',1),(82,'2018_09_10_065606_create_ol_tit_bit_question_master_table',1),(83,'2018_09_10_065631_create_ol_rg_relocation_question_master_table',1),(84,'2018_09_10_065718_create_ol_demarcation_details_table',1),(85,'2018_09_10_065915_create_ol_tit_bit_details_table',1),(86,'2018_09_10_065942_create_ol_rg_relocation_details_table',1),(87,'2018_09_10_092741_add_user_role_id_to_hearing',1),(88,'2018_09_10_124448_delete_model_to_application_master_table',1),(89,'2018_09_10_130111_add_model_to_application_master_table',1),(90,'2018_09_11_090411_add_architect_details_ol_societies_table',1),(91,'2018_09_11_092221_add_society_username_ol_societies_table',1),(92,'2018_09_11_092610_add_society_registration_no_ol_societies_table',1),(93,'2018_09_11_093207_add_society_contact_no_ol_societies_table',1),(94,'2018_09_11_093411_add_redirect_column_to_roles',1),(95,'2018_09_12_041803_create_ol_request_form_details',1),(96,'2018_09_12_042502_add_request_form_id_to_ol_applications',1),(97,'2018_09_14_063814_create_layout_table',1),(98,'2018_09_14_081206_alter_ol_applications_table',1),(99,'2018_09_14_091518_add_parent_id_to_roles_table',1),(100,'2018_09_14_093901_create_layout_user_table',1),(101,'2018_09_15_105445_create_scoiety_uploaded_documents_comment_table',1),(102,'2018_09_15_115320_alter_ol_society_document_status',1),(103,'2018_09_16_103034_add_layout_id_to_application',1),(104,'2018_09_16_110636_add_role_id_to_application_status',1),(105,'2018_09_17_041443_add_user_id_column_to_ol_applications_table',1),(106,'2018_09_17_072325_add_society_flag_application_log_table',1),(107,'2018_09_18_143034_remove_constraints_from_rti_form',1),(108,'2018_09_19_082008_create_frontend_rti_users_table',1),(109,'2018_09_19_082902_rename_frontend_rti_users_table',1),(110,'2018_09_19_091506_add_role_id_to_ol_societies_table',1),(111,'2018_09_19_182735_rename_role_id_to_user_id_ol_societies_table',1),(112,'2018_09_20_131606_create_hearing_status_log_table',1),(113,'2018_09_21_063743_alter_data_type_of_office_date_in_hearing',1),(114,'2018_09_21_143421_create_ol_cap_notes',1),(115,'2018_09_22_075255_drop_foreign_key_hearing',1),(116,'2018_09_22_080049_make_board_id_hearing_nullable',1),(117,'2018_09_22_094744_drop_foreign_key_schedule_hearing',1),(118,'2018_09_22_130949_create_board_user_table',1),(119,'2018_09_24_111140_create_ol_ee_note_table',1),(120,'2018_09_26_045107_add_remaining_resident_area_to_calculation_sheet_details',1),(121,'2018_09_26_055657_add_layout_approval_fee_to_calculation_sheet_details',1),(122,'2018_09_26_114630_create_ol_ree_note',1),(123,'2018_09_27_062221_create_village_societies_table',1),(124,'2018_09_27_110700_add_child_id_to_roles_table',1),(125,'2018_09_27_120506_add_area_of_total_plot_to_calculation_sheet',1),(126,'2018_09_27_124955_add_scrutiny_fee_to_calculation_sheet',1),(127,'2018_09_27_133720_add_drafted_offer_letter_to_ol_application',1),(128,'2018_09_27_142621_alter_ol_societies_table',1),(129,'2018_09_28_073124_create_ol_sharing_calculation_sheet_details',1),(130,'2018_09_28_073956_remove_village_id_from_lm_society_detail',1),(131,'2018_09_28_142431_add_status_offer_letter_to_ol_application',1),(132,'2018_10_01_101452_add_total_additional_claims_to_sharing_sheet',1),(133,'2018_10_01_144346_add_text_offer_letter_to_ol_application',1),(134,'2018_10_03_130750_add_certificate_path_to_architect_application',1),(135,'2018_10_04_060551_create_architect_certificate__table',1),(136,'2018_10_04_072722_add_drafted_certificate_to_architect_application',1),(137,'2018_10_04_082403_add_final_signed_certificate_status_to_architect_application',1),(138,'2018_10_04_082652_rename_status_to_final_signed_certificate_status_in_arcitect_application',1),(139,'2018_10_04_121722_modify_architect_application_status_logs_table',1),(140,'2018_10_04_122408_remove_previous_status_from_architect_application_status_logs_table',1),(141,'2018_10_05_053146_change_total_no_of_buildings_to_calculation',1),(142,'2018_10_05_094218_modify_application_status_column_in_atchitect_application_table',1),(143,'2018_10_05_124159_update_consent_verification_details',1),(144,'2018_10_09_103014_create_architect_layouts_table',1),(145,'2018_10_09_104713_create_architect_layout_details_table',1),(146,'2018_10_09_111503_create_architect_layout_detail_cts_plan_details',1),(147,'2018_10_09_111842_create_architect_layout_detail_pr_card_details',1),(148,'2018_10_09_112247_create_architect_layout_detail_ee_reports',1),(149,'2018_10_09_112458_create_architect_layout_detail_em_reports',1),(150,'2018_10_09_112511_create_architect_layout_detail_ree_reports',1),(151,'2018_10_09_113424_create_architect_layout_detail_land_reports',1),(152,'2018_10_09_113842_create_architect_layout_detail_court_matters_or_disputes_on_land',1),(153,'2018_10_09_124636_create_architect_layout_detail_land_scutiny_reports',1),(154,'2018_10_09_124700_create_architect_layout_detail_ee_scutiny_reports',1),(155,'2018_10_09_124718_create_architect_layout_detail_em_scutiny_reports',1),(156,'2018_10_09_124734_create_architect_layout_detail_ree_scutiny_reports',1),(157,'2018_10_09_140927_create_architect_layout__l_m__scrutinty_question_master_table',1),(158,'2018_10_09_142122_create_architect_layout__e_e__scrutinty_question_master_table',1),(159,'2018_10_09_142429_create_architect_layout__e_m__scrutinty_question_master_table',1),(160,'2018_10_09_142504_create_architect_layout__r_e_e__scrutinty_question_master_table',1),(161,'2018_10_09_142626_create_architect_layout__r_e_e__scrutinty_question_details_table',1),(162,'2018_10_09_143442_create_architect_layout__e_m__scrutinty_question_details_table',1),(163,'2018_10_09_143656_create_architect_layout__e_e__scrutinty_question_details_table',1),(164,'2018_10_09_143842_create_architect_layout__l_m__scrutinty_question_details_table',1),(165,'2018_10_09_145629_create_architect_layout_status_logs_table',1),(166,'2018_10_10_054559_rename_tables_name_of_layout_architect_scrunity_report',1),(167,'2018_10_10_085351_add_keyword_to_resolutions',1),(168,'2018_10_10_140618_add_delete_log_to_roles_table',1),(169,'2018_10_11_092851_create_deleted_role_details',1),(170,'2018_10_12_104049_add_calculated_dcr_val_to_calcuation_sheet',1),(171,'2018_10_13_065651_create_master_wards_table',1),(172,'2018_10_13_065816_create_master_colonies_table',1),(173,'2018_10_13_065836_create_master_societies_table',1),(174,'2018_10_13_070041_create_master_buildings_table',1),(175,'2018_10_13_070216_create_master_tenants_table',1),(176,'2018_10_15_091247_create_master_society_bill_level_table',2),(177,'2018_10_15_091323_create_master_tenant_type_table',2),(178,'2018_10_16_101234_create_table_arrears_charges_rate',3),(179,'2018_10_16_104948_create_table_service_charges_rate',3),(182,'2018_10_17_134728_create_arrear_calculation_table',4);
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
INSERT INTO `ol_application_master` VALUES (1,0,'Self Redevelopment','2018-10-13 02:41:57','2018-10-13 02:41:57','null'),(2,1,'New - Offer Letter','2018-10-13 02:41:58','2018-10-13 02:41:58','Premium'),(3,1,'Revalidation Of Offer Letter','2018-10-13 02:41:58','2018-10-13 02:41:58','Premium'),(4,1,'Application for NOC','2018-10-13 02:41:58','2018-10-13 02:41:58','Premium'),(5,1,'Consent for OC','2018-10-13 02:41:58','2018-10-13 02:41:58','Premium'),(6,1,'New - Offer Letter','2018-10-13 02:41:58','2018-10-13 02:41:58','Sharing'),(7,1,'Revalidation Of Offer Letter','2018-10-13 02:41:58','2018-10-13 02:41:58','Sharing'),(8,1,'Application for NOC - IOD','2018-10-13 02:41:58','2018-10-13 02:41:58','Sharing'),(9,1,'Tripartite Agreement','2018-10-13 02:41:58','2018-10-13 02:41:58','Sharing'),(10,1,'Application for CC','2018-10-13 02:41:58','2018-10-13 02:41:58','Sharing'),(11,1,'Consent for OC','2018-10-13 02:41:58','2018-10-13 02:41:58','Sharing'),(12,0,'Redevelopment Through Developer','2018-10-13 02:41:58','2018-10-13 02:41:58','null'),(13,12,'New - Offer Letter','2018-10-13 02:41:59','2018-10-13 02:41:59','Premium'),(14,12,'Revalidation Of Offer Letter','2018-10-13 02:41:59','2018-10-13 02:41:59','Premium'),(15,12,'Application for NOC','2018-10-13 02:41:59','2018-10-13 02:41:59','Premium'),(16,12,'Consent for OC','2018-10-13 02:41:59','2018-10-13 02:41:59','Premium'),(17,12,'New - Offer Letter','2018-10-13 02:41:59','2018-10-13 02:41:59','Sharing'),(18,12,'Revalidation Of Offer Letter','2018-10-13 02:41:59','2018-10-13 02:41:59','Sharing'),(19,12,'Application for NOC - IOD','2018-10-13 02:41:59','2018-10-13 02:41:59','Sharing'),(20,12,'Tripartite Agreement','2018-10-13 02:41:59','2018-10-13 02:41:59','Sharing'),(21,12,'Application for CC','2018-10-13 02:41:59','2018-10-13 02:41:59','Sharing'),(22,12,'Consent for OC','2018-10-13 02:41:59','2018-10-13 02:41:59','Sharing');
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
INSERT INTO `ol_dcr_rate_master` VALUES (1,'0 to 2','EWS / LIG',40,'2018-10-13 02:41:59','2018-10-13 02:41:59'),(2,'0 to 2','MIG',60,'2018-10-13 02:41:59','2018-10-13 02:41:59'),(3,'0 to 2','HIG',80,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(4,'2 to 4','EWS / LIG',45,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(5,'2 to 4','MIG',65,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(6,'2 to 4','HIG',85,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(7,'4 to 6','EWS / LIG',50,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(8,'4 to 6','MIG',70,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(9,'4 to 6','HIG',90,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(10,'above 6','EWS / LIG',55,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(11,'above 6','MIG',75,'2018-10-13 02:42:00','2018-10-13 02:42:00'),(12,'above 6','HIG',95,'2018-10-13 02:42:00','2018-10-13 02:42:00');
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
  `area_of_total_plot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ol_society_documents_master`
--

LOCK TABLES `ol_society_documents_master` WRITE;
/*!40000 ALTER TABLE `ol_society_documents_master` DISABLE KEYS */;
INSERT INTO `ol_society_documents_master` VALUES (1,2,2,'संस्थेचा अर्ज','2018-10-13 02:42:00','2018-10-13 02:42:00'),(2,2,2,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-13 02:42:01','2018-10-13 02:42:01'),(3,2,2,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(4,2,2,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(5,2,2,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(6,2,2,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(7,2,2,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-13 02:42:01','2018-10-13 02:42:01'),(8,2,2,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(9,2,2,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-13 02:42:01','2018-10-13 02:42:01'),(10,2,2,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(11,2,2,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-13 02:42:01','2018-10-13 02:42:01'),(12,2,2,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-13 02:42:01','2018-10-13 02:42:01'),(13,2,2,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-13 02:42:01','2018-10-13 02:42:01'),(14,2,2,'नगरभुमापन नकाशे','2018-10-13 02:42:01','2018-10-13 02:42:01'),(15,2,2,'मिळकत पत्रिका (PR कार्ड )','2018-10-13 02:42:02','2018-10-13 02:42:02'),(16,2,2,'अस्तीत्वातील इमारतीचे फोटो','2018-10-13 02:42:02','2018-10-13 02:42:02'),(17,2,2,'प्रस्तावीत इमारतीचा नकाशा','2018-10-13 02:42:02','2018-10-13 02:42:02'),(18,2,2,'डी.पी.रिमार्क','2018-10-13 02:42:02','2018-10-13 02:42:02'),(19,2,6,'संस्थेचा अर्ज','2018-10-13 02:42:02','2018-10-13 02:42:02'),(20,2,6,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-13 02:42:02','2018-10-13 02:42:02'),(21,2,6,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(22,2,6,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(23,2,6,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(24,2,6,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(25,2,6,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-13 02:42:02','2018-10-13 02:42:02'),(26,2,6,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(27,2,6,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-13 02:42:02','2018-10-13 02:42:02'),(28,2,6,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(29,2,6,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-13 02:42:02','2018-10-13 02:42:02'),(30,2,6,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-13 02:42:02','2018-10-13 02:42:02'),(31,2,6,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-13 02:42:03','2018-10-13 02:42:03'),(32,2,6,'नगरभुमापन नकाशे','2018-10-13 02:42:03','2018-10-13 02:42:03'),(33,2,6,'मिळकत पत्रिका (PR कार्ड )','2018-10-13 02:42:03','2018-10-13 02:42:03'),(34,2,6,'अस्तीत्वातील इमारतीचे फोटो','2018-10-13 02:42:03','2018-10-13 02:42:03'),(35,2,6,'प्रस्तावीत इमारतीचा नकाशा','2018-10-13 02:42:03','2018-10-13 02:42:03'),(36,2,6,'डी.पी.रिमार्क','2018-10-13 02:42:03','2018-10-13 02:42:03'),(37,2,13,'संस्थेचा अर्ज','2018-10-13 02:42:03','2018-10-13 02:42:03'),(38,2,13,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-13 02:42:03','2018-10-13 02:42:03'),(39,2,13,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(40,2,13,'संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(41,2,13,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(42,2,13,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(43,2,13,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(44,2,13,'विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(45,2,13,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-13 02:42:03','2018-10-13 02:42:03'),(46,2,13,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-13 02:42:03','2018-10-13 02:42:03'),(47,2,13,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-13 02:42:03','2018-10-13 02:42:03'),(48,2,13,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(49,2,13,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-13 02:42:04','2018-10-13 02:42:04'),(50,2,13,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(51,2,13,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-13 02:42:04','2018-10-13 02:42:04'),(52,2,13,'नगरभुमापन नकाशे','2018-10-13 02:42:04','2018-10-13 02:42:04'),(53,2,13,'मिळकत पत्रिका (PR कार्ड )','2018-10-13 02:42:04','2018-10-13 02:42:04'),(54,2,13,'अस्तीत्वातील इमारतीचे फोटो','2018-10-13 02:42:04','2018-10-13 02:42:04'),(55,2,13,'प्रस्तावीत इमारतीचा नकाशा','2018-10-13 02:42:04','2018-10-13 02:42:04'),(56,2,13,'डी.पी.रिमार्क','2018-10-13 02:42:04','2018-10-13 02:42:04'),(57,2,13,'उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र','2018-10-13 02:42:04','2018-10-13 02:42:04'),(58,2,17,'संस्थेचा अर्ज','2018-10-13 02:42:04','2018-10-13 02:42:04'),(59,2,17,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-13 02:42:04','2018-10-13 02:42:04'),(60,2,17,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(61,2,17,'संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(62,2,17,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(63,2,17,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(64,2,17,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(65,2,17,'विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत','2018-10-13 02:42:04','2018-10-13 02:42:04'),(66,2,17,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-13 02:42:05','2018-10-13 02:42:05'),(67,2,17,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-13 02:42:05','2018-10-13 02:42:05'),(68,2,17,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-13 02:42:05','2018-10-13 02:42:05'),(69,2,17,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-13 02:42:05','2018-10-13 02:42:05'),(70,2,17,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-13 02:42:05','2018-10-13 02:42:05'),(71,2,17,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-13 02:42:05','2018-10-13 02:42:05'),(72,2,17,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-13 02:42:05','2018-10-13 02:42:05'),(73,2,17,'नगरभुमापन नकाशे','2018-10-13 02:42:05','2018-10-13 02:42:05'),(74,2,17,'मिळकत पत्रिका (PR कार्ड )','2018-10-13 02:42:05','2018-10-13 02:42:05'),(75,2,17,'अस्तीत्वातील इमारतीचे फोटो','2018-10-13 02:42:05','2018-10-13 02:42:05'),(76,2,17,'प्रस्तावीत इमारतीचा नकाशा','2018-10-13 02:42:05','2018-10-13 02:42:05'),(77,2,17,'डी.पी.रिमार्क','2018-10-13 02:42:05','2018-10-13 02:42:05'),(78,2,17,'उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र','2018-10-13 02:42:05','2018-10-13 02:42:05');
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
INSERT INTO `other_land` VALUES (1,'SRA',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(2,'Amenity plot',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(3,'Plot handed over BMC or others',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(4,'Vacant plots',1,'2018-10-13 02:41:56','2018-10-13 02:41:56'),(5,'Office building',1,'2018-10-13 02:41:56','2018-10-13 02:41:56');
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
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,3),(36,3),(37,3),(38,3),(39,3),(40,3),(41,3),(42,3),(43,3),(44,3),(45,3),(46,3),(47,3),(48,4),(49,4),(50,4),(51,4),(52,4),(53,4),(54,4),(55,4),(56,4),(57,4),(58,4),(59,4),(60,4),(61,5),(62,5),(63,5),(64,5),(65,5),(66,5),(67,5),(68,6),(69,6),(70,6),(71,6),(72,6),(73,6),(74,6),(75,7),(76,7),(77,7),(78,7),(79,7),(80,7),(81,7),(82,8),(83,8),(84,8),(85,8),(86,8),(87,8),(88,8),(89,8),(90,8),(91,8),(92,8),(93,8),(94,8),(95,8),(96,8),(97,8),(98,8),(99,8),(100,8),(101,8),(102,8),(103,8),(130,9),(131,9),(132,9),(133,9),(134,9),(135,9),(104,10),(105,10),(106,10),(107,10),(108,10),(109,10),(110,10),(111,10),(112,10),(113,10),(114,10),(115,10),(116,10),(117,10),(118,10),(119,10),(120,10),(121,10),(122,10),(123,10),(124,10),(125,10),(126,10),(127,10),(128,10),(129,10),(130,11),(131,11),(132,11),(133,11),(134,11),(135,11),(104,12),(105,12),(106,12),(107,12),(108,12),(109,12),(110,12),(111,12),(112,12),(113,12),(114,12),(115,12),(116,12),(117,12),(118,12),(119,12),(120,12),(121,12),(122,12),(123,12),(124,12),(125,12),(126,12),(127,12),(128,12),(129,12),(136,13),(137,13),(138,13),(139,13),(140,13),(141,13),(142,13),(143,13),(144,13),(145,13),(146,13),(147,13),(148,13),(149,14),(150,14),(151,14),(152,14),(153,14),(154,14),(155,14),(156,14),(157,14),(158,14),(159,14),(160,14),(161,14),(162,15),(163,15),(164,15),(165,15),(166,15),(167,15),(168,15),(169,15),(170,15),(171,15),(172,15),(173,15),(174,15),(175,16),(176,16),(177,16),(178,16),(179,16),(180,16),(181,16),(182,16),(183,16),(184,16),(185,16),(186,16),(187,16),(188,17),(189,17),(190,17),(191,17),(192,17),(193,17),(194,17),(195,17),(196,18),(197,18),(198,18),(199,18),(200,18),(201,18),(202,18),(203,19),(204,19),(205,19),(206,19),(207,19),(208,19),(209,19),(210,19),(211,20),(212,20),(213,20),(214,20),(215,20),(216,20),(217,20),(218,20),(219,20),(220,20),(221,20),(222,20),(223,20),(224,20),(225,20),(226,20),(227,21),(228,21),(229,21),(230,21),(231,21),(232,21),(233,21),(234,22),(235,22),(236,22),(237,22),(238,22),(239,22),(240,22),(241,22),(242,23),(245,23),(246,23),(247,23),(248,23),(249,23),(250,23),(251,23),(252,23),(253,23),(254,23),(255,23),(256,23),(257,23),(258,23),(259,23),(260,23),(261,23),(266,23),(267,23),(268,23),(269,23),(270,23),(271,23),(272,23),(273,23),(274,23),(243,24),(262,24),(263,24),(264,24),(265,24),(275,24),(244,25),(251,25),(268,25),(269,25),(271,25),(273,25),(274,25),(276,25),(277,25),(278,25),(279,25);
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
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'society_offer_letter.index','index','index',NULL,NULL),(2,'society_offer_letter.store','society_offer_letter_registration','store society registration details for offer letter',NULL,NULL),(3,'society_offer_letter.create','display_society_offer_letter_registration','displays society registration form for offer letter',NULL,NULL),(4,'society_offer_letter_forgot_password','society_forgot_password','society forgot password functionality',NULL,NULL),(5,'society_offer_letter_dashboard','society_offer_letter_application_listing','society offer letter application listing',NULL,NULL),(6,'offer_letter_application_self','offer_letter_application_self','displays offer letter application form for self redevelopment',NULL,NULL),(7,'save_offer_letter_application_self','save_offer_letter_application_self','saves offer letter application form for self redevelopment',NULL,NULL),(8,'offer_letter_application_dev','offer_letter_application_dev','displays offer letter application form for redevelopment through developer',NULL,NULL),(9,'save_offer_letter_application_dev','save_offer_letter_application_dev','saves offer letter application form for redevelopment through developer',NULL,NULL),(10,'documents_upload','documents_upload','displays document names listings & upload documents form',NULL,NULL),(11,'uploaded_documents','uploaded_documents','displays download and upload option for submitted offer letter application form',NULL,NULL),(12,'delete_uploaded_documents','delete_uploaded_documents','deletes documents for submitted offer letter application form',NULL,NULL),(13,'add_documents_comment','add_documents_comment','add comments for uploaded documents for submitted offer letter application form',NULL,NULL),(14,'society_offer_letter_download','society_offer_letter_download','displays submitted society offer letter application',NULL,NULL),(15,'upload_society_offer_letter','upload_society_offer_letter','upload submitted society offer letter application after signature',NULL,NULL),(16,'society_detail.UserAuthentication','society_detail.UserAuthentication','authenticates society offer letter users',NULL,NULL),(17,'documents_uploaded','documents_uploaded','view uploaded society documents',NULL,NULL),(18,'add_documents_comment','add_documents_comment','add documents comment',NULL,NULL),(19,'add_uploaded_documents_remark','add_uploaded_documents_remark','add uploaded documents remark',NULL,NULL),(20,'society_offer_letter_application_download','society_offer_letter_application_download','downloads society offer letter application',NULL,NULL),(21,'upload_society_offer_letter_application','upload_society_offer_letter_application','uploads society offer letter application',NULL,NULL),(22,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(23,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(24,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(25,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(26,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(27,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(28,'document-submitted','Document submitted','Document submitted',NULL,NULL),(29,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(30,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(31,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(32,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(33,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(34,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(35,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(36,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(37,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(38,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(39,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(40,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(41,'document-submitted','Document submitted','Document submitted',NULL,NULL),(42,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(43,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(44,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(45,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(46,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(47,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(48,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(49,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(50,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(51,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(52,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(53,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(54,'document-submitted','Document submitted','Document submitted',NULL,NULL),(55,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(56,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(57,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(58,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(59,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(60,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(61,'dyce.index','index','index',NULL,NULL),(62,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(63,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(64,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(65,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(66,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(67,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(68,'dyce.index','index','index',NULL,NULL),(69,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(70,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(71,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(72,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(73,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(74,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(75,'dyce.index','index','index',NULL,NULL),(76,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(77,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(78,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(79,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(80,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(81,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(82,'village_detail.index','List village','Listing of village',NULL,NULL),(83,'village_detail.create','Create a village','Creating a new village',NULL,NULL),(84,'village_detail.edit','Edit a village','Edit a village',NULL,NULL),(85,'village_detail.show','Show a village data','Show a village data',NULL,NULL),(86,'village_detail.update','Update a village','Updating data of a particular village',NULL,NULL),(87,'village_detail.destroy','Delete a village','Delete a particular village',NULL,NULL),(88,'loadDeleteVillageUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(89,'village_detail.store','Store a village a data','Creating a new village',NULL,NULL),(90,'society_detail.index','Society list','List all societies coming under particular village',NULL,NULL),(91,'society_detail.create','Society Create','Create society for a particular village',NULL,NULL),(92,'society_detail.store','Society Store','Store society data for a particular village',NULL,NULL),(93,'society_detail.edit','Society Edit','Edit society data for a particular village',NULL,NULL),(94,'society_detail.update','Society Update','Update society data for a particular village',NULL,NULL),(95,'society_detail.show','Show society data','Show society data',NULL,NULL),(96,'lease_detail.index','List Lease','List lease for a particular society',NULL,NULL),(97,'lease_detail.create','Create Lease','Create lease for a particular society',NULL,NULL),(98,'lease_detail.store','Store Lease','Store lease for a particular society',NULL,NULL),(99,'renew-lease.renew','Renew Lease','Renew lease for a particular society',NULL,NULL),(100,'renew-lease.update-lease','Updated Renew Lease data','Updated Renew Lease data',NULL,NULL),(101,'edit-lease.edit','Shows edit page for Edit Lease data','Shows edit page for Edit Lease data',NULL,NULL),(102,'update-lease.update','Updated Latest Lease data','Updated Latest Lease data',NULL,NULL),(103,'view-lease.view','Views Latest Lease data','Views Latest Lease data',NULL,NULL),(104,'hearing.index','List Hearing','Listing of Hearing',NULL,NULL),(105,'hearing.create','Create a hearing','Creating a new hearing',NULL,NULL),(106,'hearing.edit','Edit a hearing','Edit a hearing',NULL,NULL),(107,'hearing.update','Update a hearing','Updating data of a particular hearing',NULL,NULL),(108,'hearing.destroy','Delete a hearing','Delete a particular hearing',NULL,NULL),(109,'loadDeleteReasonOfHearingUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(110,'hearing.store','Store a hearing a data','Creating a new hearing',NULL,NULL),(111,'schedule_hearing.add','Schedule Add','Add Schedule',NULL,NULL),(112,'hearing.show','Show Hearing','Display a particular hearing',NULL,NULL),(113,'schedule_hearing.store','Schedule Hearing Store','Store Schedule Hearing data',NULL,NULL),(114,'fix_schedule.add','Add Pre/Post Schedule data','Add Pre/Post Schedule data',NULL,NULL),(115,'fix_schedule.store','Store Pre/Post Schedule data','Store Pre/Post Schedule data',NULL,NULL),(116,'fix_schedule.edit','Edit Pre/Post Schedule data','Edit Pre/Post Schedule data',NULL,NULL),(117,'fix_schedule.update','Update Pre/Post Schedule data','Update Pre/Post Schedule data',NULL,NULL),(118,'upload_case_judgement.add','Upload Case Judgement data','Upload Case Judgement Pre/Post Schedule data',NULL,NULL),(119,'upload_case_judgement.store','Store Upload Case Judgement data','Store Upload Case Judgement data',NULL,NULL),(120,'upload_case_judgement.edit','Edit Upload Case Judgement data','Edit Upload Case Judgement data',NULL,NULL),(121,'upload_case_judgement.update','Update Upload Case Judgement data','Update Upload Case Judgement data',NULL,NULL),(122,'forward_case.create','Forward Case data','Forward Case Pre/Post Schedule data',NULL,NULL),(123,'forward_case.store','Store Forward Case data','Store Forward Case data',NULL,NULL),(124,'forward_case.edit','Edit Forward Case data','Edit Forward Case data',NULL,NULL),(125,'forward_case.update','Update Forward Case data','Update Forward Case data',NULL,NULL),(126,'send_notice_to_appellant.create','Send Notice data','Send Notice data',NULL,NULL),(127,'send_notice_to_appellant.store','Store Send Notice data','Store Send Notice data',NULL,NULL),(128,'send_notice_to_appellant.edit','Edit Send Notice data','Edit Send Notice data',NULL,NULL),(129,'send_notice_to_appellant.update','Update Send Notice data','Update Send Notice data',NULL,NULL),(130,'hearing.index','List Hearing','Listing of Hearing',NULL,NULL),(131,'hearing.show','Show Hearing','Display a particular hearing',NULL,NULL),(132,'forward_case.create','Forward Case data','Forward Case Pre/Post Schedule data',NULL,NULL),(133,'forward_case.store','Store Forward Case data','Store Forward Case data',NULL,NULL),(134,'forward_case.edit','Edit Forward Case data','Edit Forward Case data',NULL,NULL),(135,'forward_case.update','Update Forward Case data','Update Forward Case data',NULL,NULL),(136,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(137,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(138,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(139,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(140,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(141,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(142,'ree.forward_application','forward application','forward application',NULL,NULL),(143,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(144,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(145,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(146,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(147,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(148,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(149,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(150,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(151,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(152,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(153,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(154,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(155,'ree.forward_application','forward application','forward application',NULL,NULL),(156,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(157,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(158,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(159,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(160,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(161,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(162,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(163,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(164,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(165,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(166,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(167,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(168,'ree.forward_application','forward application','forward application',NULL,NULL),(169,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(170,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(171,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(172,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(173,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(174,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(175,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(176,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(177,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(178,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(179,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(180,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(181,'ree.forward_application','forward application','forward application',NULL,NULL),(182,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(183,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(184,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(185,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(186,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(187,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(188,'cap.index','index','index',NULL,NULL),(189,'cap.EE_scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(190,'cap.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(191,'cap.dyce_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(192,'cap.forward_application','forward_application','forward_application',NULL,NULL),(193,'cap.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(194,'cap.cap_notes','cap notes','cap notes',NULL,NULL),(195,'cap.upload_cap_note','upload cap notes','upload cap notes',NULL,NULL),(196,'co.index','index','index',NULL,NULL),(197,'co.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(198,'co.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(199,'co.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(200,'co.forward_application','forward_application','forward_application',NULL,NULL),(201,'co.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(202,'co.download_cap_note','download_cap_note','download_cap_note',NULL,NULL),(203,'resolution.index','List Resolution','Listing of Resolutions',NULL,NULL),(204,'resolution.create','Create a resolution','Creating a new resolution',NULL,NULL),(205,'resolution.edit','Edit a resolution','Edit a resolution',NULL,NULL),(206,'resolution.update','Update a resolution','Updating data of a particular resolution',NULL,NULL),(207,'resolution.destroy','Delete a resolution','Delete a particular resolution',NULL,NULL),(208,'loadDeleteReasonOfResolutionUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(209,'resolution.store','Store a resolution a data','Creating a new resolution',NULL,NULL),(210,'frontend_resolution_list','Frontend resolution list','Frontend resolution list',NULL,NULL),(211,'rti_form','Show front end form','Show front end form',NULL,NULL),(212,'rti_form_success','Save RTI form data','Save RTI form data',NULL,NULL),(213,'rti_form_success_close','Save RTI form data','Save RTI form data',NULL,NULL),(214,'rti_form_search','RTI Form success','RTI Form success',NULL,NULL),(215,'rti_applicants','List of RTI Applicants','List of RTI Applicants',NULL,NULL),(216,'schedule_meeting','Schedule meeting','Schedule meeting',NULL,NULL),(217,'rti_schedule_meeting','Save Schedule meeting data','Save Schedule meeting data',NULL,NULL),(218,'view_applicant','View Applicant','View Applicant',NULL,NULL),(219,'update_status','Get Update Status form','Get Update Status form',NULL,NULL),(220,'rti_update_status','Save update status data','Save update status data',NULL,NULL),(221,'rti_send_info','Get RTI info form','Get RTI info form',NULL,NULL),(222,'rti_sent_info_data','Save RTI info data','Save RTI info data',NULL,NULL),(223,'rti_forwarded_application','Get Forward application form','Get Forward application form',NULL,NULL),(224,'rti_forwarded_application_data','Save Forward application form','Save Forward application form',NULL,NULL),(225,'rti_frontend_application','RTI Frontend Application','RTI Frontend Application',NULL,NULL),(226,'rti_frontend_application_status','RTI Frontend Application status','RTI Frontend Application status',NULL,NULL),(227,'vp.index','index','index',NULL,NULL),(228,'vp.EE_scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(229,'vp.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(230,'vp.dyce_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(231,'vp.forward_application','forward_application','forward_application',NULL,NULL),(232,'vp.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(233,'vp.cap_notes','cap notes','cap notes',NULL,NULL),(234,'roles.index','List Roles','Listing Roles',NULL,NULL),(235,'roles.create','Create Role','Creating role',NULL,NULL),(236,'roles.show','Create Role','Creating role',NULL,NULL),(237,'roles.store','Store Role','Storing Role',NULL,NULL),(238,'roles.edit','Edit Role','EDiting Role',NULL,NULL),(239,'roles.update','Update Role','updating Role',NULL,NULL),(240,'roles.destroy','Delete Role ','Deleting Role',NULL,NULL),(241,'loadDeleteRoleUsingAjax','Delete Roles Ajax','Deleting Roles using Ajax',NULL,NULL),(242,'em.index','List EM Application','Listing EM Application',NULL,NULL),(243,'em_clerk.index','List EE Application','Listing EE Application',NULL,NULL),(244,'rc.index','List EE Application','Listing EE Application',NULL,NULL),(245,'get_societies','get_societies','get_societies',NULL,NULL),(246,'get_buildings','get_buildings','get_buildings',NULL,NULL),(247,'get_tenants','get_tenants','get_tenants',NULL,NULL),(248,'soc_bill_level','soc_bill_level','soc_bill_level',NULL,NULL),(249,'update_soc_bill_level','update_soc_bill_level','update_soc_bill_level','2018-10-14 18:30:00','2018-10-14 18:30:00'),(250,'soc_ward_colony','soc_ward_colony','soc_ward_colony',NULL,NULL),(251,'get_colonies','get_colonies','get_colonies',NULL,NULL),(252,'update_soc_ward_colony','update_soc_ward_colony','update_soc_ward_colony',NULL,NULL),(253,'add_building','add_building','add_building',NULL,NULL),(254,'create_building','create_building','create_building',NULL,NULL),(255,'edit_building','edit_building','edit_building',NULL,NULL),(256,'update_building','update_building','update_building',NULL,NULL),(257,'add_tenant','add_tenant','add_tenant',NULL,NULL),(258,'edit_tenant','edit_tenant','edit_tenant',NULL,NULL),(259,'create_tenant','create_tenant','create_tenant',NULL,NULL),(260,'update_tenant','update_tenant','update_tenant',NULL,NULL),(261,'delete_tenant','delete_tenant','delete_tenant',NULL,NULL),(262,'em_society_list','em_society_list','em_society_list',NULL,NULL),(263,'em_building_list','em_building_list','em_building_list',NULL,NULL),(264,'tenant_payment_list','tenant_payment_list','tenant_payment_list',NULL,NULL),(265,'tenant_arrear_calculation','tenant_arrear_calculation','tenant_arrear_calculation',NULL,NULL),(266,'generate_soc_bill','generate_soc_bill','generate_soc_bill',NULL,NULL),(267,'generate_tenant_bill','generate_tenant_bill','generate_tenant_bill',NULL,NULL),(268,'get_wards','get_wards','get_wards',NULL,NULL),(269,'get_society_select','get_society_select','get_society_select',NULL,NULL),(270,'get_building_ajax','get_building_ajax','get_building_ajax',NULL,NULL),(271,'get_building_select','get_building_select','get_building_select',NULL,NULL),(272,'get_tenant_ajax','get_tenant_ajax','get_tenant_ajax',NULL,NULL),(273,'arrears_calculations','arrears_calculations','arrears_calculations',NULL,NULL),(274,'billing_calculations','billing_calculations','billing_calculations',NULL,NULL),(275,'create_arrear_calculation','create_arrear_calculation','create_arrear_calculation',NULL,NULL),(276,'bill_collection_society','bill_collection_society','bill_collection_society',NULL,NULL),(277,'bill_collection_tenant','bill_collection_tenant','bill_collection_tenant',NULL,NULL),(278,'get_tenant_bill_collection','get_tenant_bill_collection','get_tenant_bill_collection',NULL,NULL),(279,'get_building_bill_collection','get_building_bill_collection','get_building_bill_collection',NULL,NULL);
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
INSERT INTO `resolution_types` VALUES (1,'MHADA Resolutions','2018-10-13 02:41:54','2018-10-13 02:41:54',NULL),(2,'M.B.R & Resolutions','2018-10-13 02:41:54','2018-10-13 02:41:54',NULL),(3,'Government Resolutions','2018-10-13 02:41:54','2018-10-13 02:41:54',NULL);
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
INSERT INTO `role_user` VALUES (1,2,'2018-10-13 08:12:08',NULL),(2,3,'2018-10-13 08:12:09',NULL),(3,4,'2018-10-13 08:12:10',NULL),(4,5,'2018-10-13 08:12:11',NULL),(5,6,'2018-10-13 08:12:12',NULL),(6,7,'2018-10-13 08:12:13',NULL),(7,8,'2018-10-13 08:12:14',NULL),(8,9,'2018-10-13 08:12:16',NULL),(9,10,'2018-10-13 08:12:16',NULL),(10,11,'2018-10-13 08:12:16',NULL),(11,12,'2018-10-13 08:12:16',NULL),(12,13,'2018-10-13 08:12:19',NULL),(13,14,'2018-10-13 08:12:20',NULL),(14,15,'2018-10-13 08:12:21',NULL),(15,16,'2018-10-13 08:12:22',NULL),(16,17,'2018-10-13 08:12:24',NULL),(17,18,'2018-10-13 08:12:24',NULL),(18,19,'2018-10-13 08:12:26',NULL),(19,20,'2018-10-13 08:12:26',NULL),(20,21,'2018-10-13 08:12:28',NULL),(21,22,'2018-10-13 08:12:29',NULL),(22,23,'2018-10-13 08:12:29',NULL),(23,24,'2018-10-13 08:12:29',NULL),(24,25,'2018-10-13 08:12:29',NULL);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'society','/society_offer_letter_dashboard',NULL,NULL,'Society Offer Letter','Login as Society',NULL,NULL,NULL),(2,'ee_engineer','/ee',NULL,'[1,3]','EE Engineer','EE Engineer',NULL,'2018-10-13 02:42:28',NULL),(3,'ee_dy_engineer','/ee',2,'[4]','EE Deputy Engineer','EE Deputy Engineer',NULL,'2018-10-13 02:42:28',NULL),(4,'ee_junior_engineer','/ee',3,NULL,'EE Junior Engineer','EE Junior Engineer',NULL,NULL,NULL),(5,'dyce_engineer','/dyce',NULL,'[2,6]','DYCE_Engineer','Login as DYCE Engineer',NULL,'2018-10-13 02:42:28',NULL),(6,'dyce_deputy_engineer','/dyce',5,'[7]','DYCE_deputy_Engineer','Login as DYCE deputy Engineer',NULL,'2018-10-13 02:42:28',NULL),(7,'dyce_junior_engineer','/dyce',6,NULL,'DYCE_junior_Engineer','Login as DYCE junior Engineer',NULL,NULL,NULL),(8,'LM','/village_detail',NULL,NULL,'land_manager','Login as Land Manger',NULL,NULL,NULL),(9,'Joint CO','/hearing',NULL,NULL,'joint_co','Login as Joint CO',NULL,NULL,NULL),(10,'Joint Co PA','/hearing',9,NULL,'joint_co_pa','Login as Joint CO PA',NULL,NULL,NULL),(11,'Co','/hearing',NULL,NULL,'co','Login as CO',NULL,NULL,NULL),(12,'Co PA','/hearing',11,NULL,'joint_co_pa','Login as Joint CO PA',NULL,NULL,NULL),(13,'ree_engineer','/ree_applications',NULL,'[2,5,14]','Residential Executive Engineer','Login as Residential Executive Engineer',NULL,'2018-10-13 02:42:28',NULL),(14,'REE Assistant Engineer','/ree_applications',13,'[15]','REE Assistant Engineer','Login as REE Assistant Engineer',NULL,'2018-10-13 02:42:28',NULL),(15,'REE deputy Engineer','/ree_applications',14,'[16]','REE Deputy Engineer','Login as REE Deputy Engineer',NULL,'2018-10-13 02:42:28',NULL),(16,'REE Junior Engineer','/ree_applications',15,NULL,'REE Junior Engineer','Login as REE Junior Engineer',NULL,NULL,NULL),(17,'cap_engineer','/cap',NULL,NULL,'CAP_Engineer','Login as CAP Engineer',NULL,NULL,NULL),(18,'co_engineer','/co',NULL,'[2,5,13]','Co_Engineer','Login as CO Engineer',NULL,'2018-10-13 02:42:28',NULL),(19,'RM','/resolution',NULL,NULL,'resolution_manager','Login as Resolution Manger',NULL,NULL,NULL),(20,'RTI','/rti_applicants',NULL,NULL,'rti_manager','Login as RTI Manager',NULL,NULL,NULL),(21,'vp_engineer','/vp',NULL,NULL,'VP_Engineer','Login as VP Engineer',NULL,NULL,NULL),(22,'superadmin','/crudadmin/roles',NULL,NULL,'Super Admin','Super Admin',NULL,NULL,NULL),(23,'em_manager','/em',NULL,'','EM Manager','EM Manager',NULL,'2018-10-13 02:42:28',NULL),(24,'em_clerk','/em_clerk',NULL,'','EM Clerk','EM Clerk',NULL,'2018-10-13 02:42:28',NULL),(25,'rc_collector','/rc',NULL,'','RC Collector','RC Collector',NULL,'2018-10-13 02:42:28',NULL);
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
  `year` year(4) DEFAULT NULL,
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
  CONSTRAINT `service_charges_rates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`),
  CONSTRAINT `service_charges_rates_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nitin Gadkari','user1@gmail.com','$2y$10$m4frCmtjKSa6XI0Bvh9Ff.mHozoHRt31wlI/CuahsBMBz3/14f5DS',2,'Test',NULL,NULL,NULL,'jnU9DyKPt6W1eqEUujSYYvEsEHt3dTNT2PFO6VT3eJUy46P38ztynyYBHMLb',NULL,NULL,'7412589635','Mumbai'),(2,'Amit Kadam','user2@gmail.com','$2y$10$vfAqJSfWwTl5Yhm.paoy1erng9POdJooHyLhxDtA44yCSznBZx/Xm',3,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(3,'Suryakant Teli','user3@gmail.com','$2y$10$RzxQXkQCjlgo0lzE2cJQdeIp/Y72WojZcB5KtBl4I99jO1Zxi/h5e',4,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(4,'Bhavana.Salunkhe','bhavnasalunkhe@neosofttech.com','$2y$10$rb2Bn9BZ/OldnD28vQbf4ePFucz.Vg2hHvfZasIvuO5NqHe8thOSK',5,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(5,'dyce_deputy','dyce1@gmail.com','$2y$10$c/c8cr4j84XNAvlub5/Pq.t3wPn6TaG9bQUBiFT.2jHZCCS1YIGMW',6,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(6,'dyce_JR','dyce2@gmail.com','$2y$10$/MUPswPA2sFr7piS0rHN7uXL/djr7DZDkRiJwKuBrPrR/IynoAgAO',7,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(7,'martin.philipose','martin.philipose@wwindia.com','$2y$10$OvClBBRkxqPPEH6zTP9v3.0hRcaLYO8DVxOg3ScbP1UsngHLti1cm',8,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(8,'Joint CO','jointco@gmail.com','$2y$10$m2CfEEHsJWA1CHJI.qh0jO6SkzYAFdB5ZgTx3SCI90bk1s/XI6lcG',9,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(9,'Joint CO PA','jointcopa@gmail.com','$2y$10$6wrRgisumpwv/1nTpHUjcOAPEOdtr3iMDozKZkSid85vapuh7sj3a',10,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(10,'CO','hearingco@gmail.com','$2y$10$4BGvmfrR3li1XcZ5uUvYjerMfGIOU6dQjDu/XdcLXHNVT6gk1MNGq',11,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(11,'CO PA','copa@gmail.com','$2y$10$P2/1kTqq5xOdPuKdhXddfuVfdxmgCyJ98GxWM.3Y9M2ea1a7CLahy',12,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(12,'Neelam','neelam1.tambe@wwindia.com','$2y$10$t.mw2RztdXXAMNYRdyivjehw/NxiUttrDydVqLJ6lP3DrpPdrTEqS',13,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(13,'REE1','ree1@gmail.com','$2y$10$nbHMFCPcLxrViC8bz64x4.6iMtfJ.hnDo4EbldMi5rc6bVQokeypi',14,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(14,'REE2','ree2@gmail.com','$2y$10$B59Pm6CdFWi5X/qRv2WFe.QeuxCqpDFJ4IVgTq/5KksSfbnw7GOBC',15,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(15,'REE3','ree3@gmail.com','$2y$10$XQbG.NoBERehhwPL42Trt.AR6Ko0FDTtLM3.LlLrksHtGysbxyKcq',16,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(16,'cap user','cap@gmail.com','$2y$10$md90qchjOP0ikPWfGeKmNO498XErmmZ5cSQGx9RVnG1qiVW0uOUOC',17,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(17,'CO','co@gmail.com','$2y$10$NQ3TbaY7tGbIb3aoNTogu.qWnKE4pdWGkDW7aPU3EPmDg9QR1Eliy',18,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(18,'Resolution Manager','resolution@gmail.com','$2y$10$tJR4biWy/542xfIsEKmOQeRgSeHqLutGa6sj0IdT4gQVmjxaTvv46',19,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(19,'RTI Manager','rti@gmail.com','$2y$10$W6k0hFPVbCnN1.I9UAAf4OoGySqJ3yd9ElZklAqXAOGdLAHI/lNlu',20,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(20,'VP user','vp@gmail.com','$2y$10$QIbPulma0TXdECPhDuEeWOWG40cPT5O4eBaJCW8WiFoI1AowWDE5q',21,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(21,'Super Admin','superadmin@gmail.com','$2y$10$IUOz6RjSL3yE21kcu22/pu1di.aGpzTBbseU0jhhhMwV7dneo7Sp.',22,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(22,'EM Manager','em@gmail.com','$2y$10$m4frCmtjKSa6XI0Bvh9Ff.mHozoHRt31wlI/CuahsBMBz3/14f5DS',23,'Test',NULL,NULL,NULL,'4C78ge1eZyWc0Fe9p1vLNUT1RwjR5n6X2dE0DYGbtwYKojwJgSTmrbjxCYAM',NULL,NULL,'7412589635','Mumbai'),(23,'EM Clerk','em_clerk@gmail.com','$2y$10$m4frCmtjKSa6XI0Bvh9Ff.mHozoHRt31wlI/CuahsBMBz3/14f5DS',24,'Test',NULL,NULL,NULL,'NmWWQJ0FVG80oolsW8YHiC62AueHL0Q5jEKENVqro6qVaM49rSAM6SjSeu3k',NULL,NULL,'7412589635','Mumbai'),(24,'RC Collector','rc@gmail.com','$2y$10$m4frCmtjKSa6XI0Bvh9Ff.mHozoHRt31wlI/CuahsBMBz3/14f5DS',25,'Test',NULL,NULL,NULL,'NGnQFJAGlw7D6y3aB83fkyX6GlbFhsEvOKHWHs5m3BQruAHFHqyqAsIjE1wE',NULL,NULL,'7412589635','Mumbai');
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

-- Dump completed on 2018-10-24 16:27:02
