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
  CONSTRAINT `arrear_calculation_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`),
  CONSTRAINT `arrear_calculation_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`),
  CONSTRAINT `arrear_calculation_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `master_tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrear_calculation`
--

LOCK TABLES `arrear_calculation` WRITE;
/*!40000 ALTER TABLE `arrear_calculation` DISABLE KEYS */;
INSERT INTO `arrear_calculation` VALUES (1,91,40,24,'1','2018','2017','4','3.60','80','2017','4','36.00','0','139.60',NULL,'2018-10-25 03:00:14','2018-10-25 03:00:14'),(2,50,18,57,'1','2018','2017','3','10.00','80','2017','3','16.00','0','126.00',NULL,'2018-10-25 03:17:47','2018-10-25 03:17:47'),(3,49,18,57,'1','2018','2017','1','12.00','80','2017','1','19.20','0','131.20',NULL,'2018-10-25 03:18:24','2018-10-25 03:18:24'),(4,31,71,57,'1','2018','2017','2','6.60','68','2017','1','16.32','0','102.92',NULL,'2018-10-25 03:19:14','2018-10-25 03:19:14');
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
  CONSTRAINT `arrears_charges_rates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`),
  CONSTRAINT `arrears_charges_rates_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrears_charges_rates`
--

LOCK TABLES `arrears_charges_rates` WRITE;
/*!40000 ALTER TABLE `arrears_charges_rates` DISABLE KEYS */;
INSERT INTO `arrears_charges_rates` VALUES (1,29,23,'2018-19','LIG',120.00,200.00,2.00,5.00,NULL,'2018-10-25 02:26:03','2018-10-25 02:26:03'),(2,24,40,'2018-19','EWS',20.00,100.00,5.00,2.00,NULL,'2018-10-25 02:38:14','2018-10-25 02:38:14'),(3,57,71,'2018-19','EWS',12.00,80.00,2.00,5.00,NULL,'2018-10-25 03:11:18','2018-10-25 03:11:18'),(4,57,18,'2018-19','EWS',20.00,100.00,2.00,5.00,NULL,'2018-10-25 03:12:13','2018-10-25 03:12:13');
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
  CONSTRAINT `board_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `board_departments_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE
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
INSERT INTO `board_user` VALUES (1,1,11,'2018-10-25 01:59:38','2018-10-25 01:59:38'),(2,1,12,'2018-10-25 01:59:38','2018-10-25 01:59:38'),(3,1,13,'2018-10-25 01:59:38','2018-10-25 01:59:38'),(4,1,14,'2018-10-25 01:59:38','2018-10-25 01:59:38');
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
INSERT INTO `boards` VALUES (1,'Mumbai Board',1,'2018-10-25 01:59:24','2018-10-25 01:59:24');
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
  CONSTRAINT `deleted_resolutions_resolution_type_id_foreign` FOREIGN KEY (`resolution_type_id`) REFERENCES `resolution_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deleted_resolutions_resolution_id_foreign` FOREIGN KEY (`resolution_id`) REFERENCES `resolutions` (`id`) ON DELETE CASCADE
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
INSERT INTO `departments` VALUES (1,'Department 1',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'Joint CO',1,'2018-10-25 01:59:38','2018-10-25 01:59:38'),(3,'Co',1,'2018-10-25 01:59:38','2018-10-25 01:59:38');
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
  CONSTRAINT `forward_case_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forward_case_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forward_case_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
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
INSERT INTO `hearing_application_type` VALUES (1,'Application or claim','2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'Appeal','2018-10-25 01:59:24','2018-10-25 01:59:24'),(3,'Redressal','2018-10-25 01:59:24','2018-10-25 01:59:24');
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
INSERT INTO `hearing_status` VALUES (1,'Pending','2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'Scheduled Meeting','2018-10-25 01:59:24','2018-10-25 01:59:24'),(3,'Case Under Judgement','2018-10-25 01:59:24','2018-10-25 01:59:24'),(4,'Forwarded','2018-10-25 01:59:24','2018-10-25 01:59:24'),(5,'Notice Send','2018-10-25 01:59:24','2018-10-25 01:59:24'),(6,'Case Closed','2018-10-25 01:59:24','2018-10-25 01:59:24');
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
INSERT INTO `land_source` VALUES (1,'Acquired land',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'Government Land',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(3,'Purchased Land',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(4,'Other land',1,'2018-10-25 01:59:24','2018-10-25 01:59:24');
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
INSERT INTO `language_master` VALUES (1,'English','2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'marathi','2018-10-25 01:59:24','2018-10-25 01:59:24');
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
  CONSTRAINT `layout_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `layout_user_layout_id_foreign` FOREIGN KEY (`layout_id`) REFERENCES `master_layout` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  CONSTRAINT `lm_village_detail_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lm_village_detail_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lm_village_detail_land_source_id_foreign` FOREIGN KEY (`land_source_id`) REFERENCES `land_source` (`id`) ON DELETE CASCADE,
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
  KEY `master_buildings_society_id_foreign` (`society_id`),
  CONSTRAINT `master_buildings_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_buildings`
--

LOCK TABLES `master_buildings` WRITE;
/*!40000 ALTER TABLE `master_buildings` DISABLE KEYS */;
INSERT INTO `master_buildings` VALUES (1,37,'15152','Ms. Leda Jerde','Mr. Evan Pacocha','2018-10-25 01:59:49','2018-10-25 01:59:49'),(2,9,'5654','Carole Bradtke','Robbie Runolfsdottir','2018-10-25 01:59:49','2018-10-25 01:59:49'),(3,19,'6174','Garnet Collins','Noelia Stracke','2018-10-25 01:59:49','2018-10-25 01:59:49'),(4,10,'21376','Sigrid Robel','Liliana Wisozk','2018-10-25 01:59:49','2018-10-25 01:59:49'),(5,58,'3970','Maximus Swaniawski V','Mr. Seth Beahan','2018-10-25 01:59:49','2018-10-25 01:59:49'),(6,51,'13429','Myrtice Muller','Dr. Cornell Pouros','2018-10-25 01:59:49','2018-10-25 01:59:49'),(7,21,'8044','Neha Doyle Sr.','Desiree Bogan','2018-10-25 01:59:49','2018-10-25 01:59:49'),(8,7,'3725','Zack Leuschke','Ellie Koepp','2018-10-25 01:59:49','2018-10-25 01:59:49'),(9,5,'16638','Leonel Wuckert','Lorenzo Schoen','2018-10-25 01:59:49','2018-10-25 01:59:49'),(10,24,'19524','Zola Cronin','Camylle Hyatt','2018-10-25 01:59:49','2018-10-25 01:59:49'),(11,45,'21664','Berniece Rempel V','Prof. Annabel Eichmann','2018-10-25 01:59:49','2018-10-25 01:59:49'),(12,50,'1562','Alisha Jacobs','Mr. Mitchell Heidenreich','2018-10-25 01:59:49','2018-10-25 01:59:49'),(13,54,'5272','Avis Kreiger','Chesley Kirlin','2018-10-25 01:59:49','2018-10-25 01:59:49'),(14,41,'3888','Braxton Kris','Khalil Harvey','2018-10-25 01:59:50','2018-10-25 01:59:50'),(15,56,'27764','Emelie Kirlin DDS','Leonie Pfeffer','2018-10-25 01:59:50','2018-10-25 01:59:50'),(16,40,'28542','Mr. Julien Simonis','Waino Labadie','2018-10-25 01:59:50','2018-10-25 01:59:50'),(17,39,'4571','Edd Bogisich','Evalyn O\'Conner V','2018-10-25 01:59:50','2018-10-25 01:59:50'),(18,57,'7209','Katharina Stehr','Tiana Ferry','2018-10-25 01:59:50','2018-10-25 01:59:50'),(19,20,'10811','Everardo Larson','Mr. Skye Goyette','2018-10-25 01:59:50','2018-10-25 01:59:50'),(20,58,'20088','Arno Schiller','Mr. Bell Cartwright Sr.','2018-10-25 01:59:50','2018-10-25 01:59:50'),(21,19,'31017','Maureen Bruen','Prof. Natalie Toy Jr.','2018-10-25 01:59:50','2018-10-25 01:59:50'),(22,29,'12064','Dr. Murl Friesen DVM','Briana Eichmann','2018-10-25 01:59:50','2018-10-25 01:59:50'),(23,29,'662','Pasquale Upton','Willy Armstrong','2018-10-25 01:59:50','2018-10-25 01:59:50'),(24,6,'2649','Morris Cole','Julie Conroy','2018-10-25 01:59:50','2018-10-25 01:59:50'),(25,58,'3935','Myra O\'Keefe IV','Lyla Carter','2018-10-25 01:59:50','2018-10-25 01:59:50'),(26,59,'14778','Antwon Sporer DVM','Kiara Koss','2018-10-25 01:59:50','2018-10-25 01:59:50'),(27,11,'18725','Nicholaus Gislason','Prof. Tianna McGlynn DDS','2018-10-25 01:59:50','2018-10-25 01:59:50'),(28,12,'19883','Kimberly Dach','Mrs. Larissa Von DDS','2018-10-25 01:59:50','2018-10-25 01:59:50'),(29,40,'18166','Sonya Bergstrom','Shakira Christiansen','2018-10-25 01:59:50','2018-10-25 01:59:50'),(30,39,'3974','Gonzalo Kuphal Sr.','Hadley Auer I','2018-10-25 01:59:50','2018-10-25 01:59:50'),(31,49,'7958','Georgette Wolff','Allene Schamberger','2018-10-25 01:59:50','2018-10-25 01:59:50'),(32,22,'33225','Prof. Alanis Franecki','Miss Alvina Glover','2018-10-25 01:59:50','2018-10-25 01:59:50'),(33,45,'12727','Florida Grimes II','Dr. Russel Heller PhD','2018-10-25 01:59:50','2018-10-25 01:59:50'),(34,54,'8384','Bettie Wisozk','Jalyn Bayer','2018-10-25 01:59:50','2018-10-25 01:59:50'),(35,50,'34515','Ken Jenkins V','Lavon Bogisich Sr.','2018-10-25 01:59:50','2018-10-25 01:59:50'),(36,31,'14773','Dr. Kimberly Jacobs','Cathrine Kautzer II','2018-10-25 01:59:50','2018-10-25 01:59:50'),(37,47,'21519','Lulu Spinka','Israel Little','2018-10-25 01:59:50','2018-10-25 01:59:50'),(38,46,'30151','Dr. Emmie Langworth DVM','Sophie O\'Keefe','2018-10-25 01:59:50','2018-10-25 01:59:50'),(39,21,'20463','Clark Runte','Aiyana Rohan','2018-10-25 01:59:50','2018-10-25 01:59:50'),(40,24,'11609','Autumn Hickle','Maritza Ernser','2018-10-25 01:59:50','2018-10-25 01:59:50'),(41,6,'8192','Ola Daniel','Alexa Heaney','2018-10-25 01:59:50','2018-10-25 01:59:50'),(42,5,'7544','Creola Marks','Angelica Waters','2018-10-25 01:59:50','2018-10-25 01:59:50'),(43,35,'2970','Minnie Russel','Justen Ruecker I','2018-10-25 01:59:50','2018-10-25 01:59:50'),(44,10,'30204','Esta Strosin','Mason Harber IV','2018-10-25 01:59:50','2018-10-25 01:59:50'),(45,33,'16473','Francesco Hoppe','Donald Predovic II','2018-10-25 01:59:50','2018-10-25 01:59:50'),(46,40,'19649','Ms. Roxane Conn V','Flavie Lowe','2018-10-25 01:59:50','2018-10-25 01:59:50'),(47,16,'1915','Clark Schulist','Jody Christiansen I','2018-10-25 01:59:50','2018-10-25 01:59:50'),(48,53,'32135','Mrs. Etha Maggio','Marley Gutkowski','2018-10-25 01:59:50','2018-10-25 01:59:50'),(49,20,'1094','Lulu Lesch','Erik Gusikowski','2018-10-25 01:59:50','2018-10-25 01:59:50'),(50,1,'27622','Lillian Pfeffer','Lesly Satterfield','2018-10-25 01:59:50','2018-10-25 01:59:50'),(51,3,'31969','Sonia Brakus V','Prof. Dax Kautzer','2018-10-25 01:59:50','2018-10-25 01:59:50'),(52,43,'15135','Isadore Weimann DVM','Miss Ivory Schulist','2018-10-25 01:59:50','2018-10-25 01:59:50'),(53,21,'9017','Angie Raynor','Ressie Pagac','2018-10-25 01:59:50','2018-10-25 01:59:50'),(54,18,'34488','Moshe Auer','Prof. Don Bartell MD','2018-10-25 01:59:50','2018-10-25 01:59:50'),(55,27,'6689','Miss Althea Cartwright','Eldred Fadel','2018-10-25 01:59:51','2018-10-25 01:59:51'),(56,4,'24962','Lawson Stroman','Ms. May Schuppe IV','2018-10-25 01:59:51','2018-10-25 01:59:51'),(57,6,'9132','Liza Labadie','Mr. Saige Harvey','2018-10-25 01:59:51','2018-10-25 01:59:51'),(58,51,'24595','Lessie Ward I','Mariano Spencer','2018-10-25 01:59:51','2018-10-25 01:59:51'),(59,13,'13074','Ms. Aleen Johnston','Prof. Meghan Larson','2018-10-25 01:59:51','2018-10-25 01:59:51'),(60,21,'21330','Mathew Runolfsdottir','Prof. Jayme Brekke','2018-10-25 01:59:51','2018-10-25 01:59:51'),(61,60,'12000','Raina Schmeler DDS','Jadon Adams','2018-10-25 01:59:51','2018-10-25 01:59:51'),(62,10,'2221','Dalton Goodwin','Graciela Dicki','2018-10-25 01:59:51','2018-10-25 01:59:51'),(63,59,'30879','Carter Okuneva','Prof. Hortense Hintz','2018-10-25 01:59:51','2018-10-25 01:59:51'),(64,23,'1709','Mrs. Dolores Harvey PhD','Reanna Rutherford PhD','2018-10-25 01:59:51','2018-10-25 01:59:51'),(65,6,'13833','Graham Bayer','Kayli Pfeffer','2018-10-25 01:59:51','2018-10-25 01:59:51'),(66,18,'17136','Oral Wehner Jr.','Helena Gibson','2018-10-25 01:59:51','2018-10-25 01:59:51'),(67,54,'13104','Alexzander Kuphal','Prof. Major Marvin DVM','2018-10-25 01:59:51','2018-10-25 01:59:51'),(68,6,'23950','Princess Romaguera','Samanta Crist','2018-10-25 01:59:51','2018-10-25 01:59:51'),(69,2,'15678','Jovanny Shanahan Sr.','Ruby Gleichner','2018-10-25 01:59:51','2018-10-25 01:59:51'),(70,20,'18857','Bobbie Gusikowski','Prof. Marvin Kohler','2018-10-25 01:59:51','2018-10-25 01:59:51'),(71,57,'31605','Betty Ebert','Jaleel Prohaska','2018-10-25 01:59:51','2018-10-25 01:59:51'),(72,37,'9239','Dr. Gaston Collins','Orland D\'Amore','2018-10-25 01:59:51','2018-10-25 01:59:51'),(73,26,'29684','Antonio Little','Ms. Dawn Anderson III','2018-10-25 01:59:51','2018-10-25 01:59:51'),(74,32,'19060','Mr. Hardy Ankunding','Yesenia Murazik IV','2018-10-25 01:59:51','2018-10-25 01:59:51'),(75,18,'1128','Rhiannon Lind','Mrs. Name Lebsack V','2018-10-25 01:59:51','2018-10-25 01:59:51'),(76,54,'29347','Milan Skiles DVM','Dolores Adams','2018-10-25 01:59:51','2018-10-25 01:59:51'),(77,17,'20271','Mason Towne','Esta Dooley','2018-10-25 01:59:51','2018-10-25 01:59:51'),(78,1,'23226','Dr. Kristina Hoppe','Dr. Bart Ortiz V','2018-10-25 01:59:51','2018-10-25 01:59:51'),(79,14,'9737','Allison Moen','Donnie Haag','2018-10-25 01:59:51','2018-10-25 01:59:51'),(80,43,'24667','Mr. Murray Wehner III','Vida Schimmel','2018-10-25 01:59:51','2018-10-25 01:59:51'),(81,3,'12455','Rolando Doyle','Ms. Leanne Powlowski','2018-10-25 01:59:51','2018-10-25 01:59:51'),(82,46,'19693','Retta Kulas','Kirsten Zieme','2018-10-25 01:59:51','2018-10-25 01:59:51'),(83,3,'21311','Adella Block MD','Eve Armstrong','2018-10-25 01:59:51','2018-10-25 01:59:51'),(84,2,'5885','Danyka Satterfield','Elwin Dickinson','2018-10-25 01:59:51','2018-10-25 01:59:51'),(85,51,'21880','Marjorie Hirthe V','Frederique Haley I','2018-10-25 01:59:51','2018-10-25 01:59:51'),(86,8,'24574','Maud Collins','Liza Moore','2018-10-25 01:59:51','2018-10-25 01:59:51'),(87,1,'28259','Johnpaul Goodwin','Dr. Ron Casper Sr.','2018-10-25 01:59:51','2018-10-25 01:59:51'),(88,39,'13521','Jaron Funk PhD','Shea Kub III','2018-10-25 01:59:51','2018-10-25 01:59:51'),(89,59,'14315','Maida Shanahan','Mrs. Naomi Wehner IV','2018-10-25 01:59:51','2018-10-25 01:59:51'),(90,6,'28755','Kenny Treutel','Dr. Daren Bode','2018-10-25 01:59:52','2018-10-25 01:59:52'),(91,1,'878787','Hiranandani','Hiranandani','2018-10-25 02:21:28','2018-10-25 02:21:28');
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
INSERT INTO `master_colonies` VALUES (1,8,'Janie Morar III','Destin Rice I','2018-10-25 01:59:47','2018-10-25 01:59:47'),(2,7,'Irving Blick Jr.','Prof. Kylie Barrows','2018-10-25 01:59:47','2018-10-25 01:59:47'),(3,10,'Hellen Spencer','Noel Fisher','2018-10-25 01:59:47','2018-10-25 01:59:47'),(4,1,'Edwin Kautzer','Izaiah VonRueden','2018-10-25 01:59:47','2018-10-25 01:59:47'),(5,1,'May Torp I','Leonie Keeling','2018-10-25 01:59:47','2018-10-25 01:59:47'),(6,10,'Laney Dach','Elaina Morissette','2018-10-25 01:59:47','2018-10-25 01:59:47'),(7,8,'Alisha Swaniawski','Prof. Caesar Davis','2018-10-25 01:59:47','2018-10-25 01:59:47'),(8,8,'Myra Toy','Sid Schiller','2018-10-25 01:59:47','2018-10-25 01:59:47'),(9,1,'Madaline Little','Jayde Will','2018-10-25 01:59:47','2018-10-25 01:59:47'),(10,3,'Dr. Kian Hessel I','Gage Hagenes','2018-10-25 01:59:47','2018-10-25 01:59:47'),(11,4,'Wilton Waters','Nina Graham','2018-10-25 01:59:47','2018-10-25 01:59:47'),(12,4,'Margarett Wisozk V','Jalyn Schamberger','2018-10-25 01:59:47','2018-10-25 01:59:47'),(13,4,'Alverta Kilback','Tomasa Gislason DDS','2018-10-25 01:59:47','2018-10-25 01:59:47'),(14,2,'Lulu Frami','Prof. Elaina Nitzsche','2018-10-25 01:59:47','2018-10-25 01:59:47'),(15,9,'Quentin Robel','Lawrence Labadie','2018-10-25 01:59:47','2018-10-25 01:59:47'),(16,8,'Lempi Baumbach','Betty Reynolds','2018-10-25 01:59:47','2018-10-25 01:59:47'),(17,7,'Kassandra Gorczany','Gillian Dickinson','2018-10-25 01:59:47','2018-10-25 01:59:47'),(18,3,'Miss Litzy Hermiston V','Hermann Bernier','2018-10-25 01:59:47','2018-10-25 01:59:47'),(19,7,'Sheridan Blanda','Lucienne O\'Kon','2018-10-25 01:59:47','2018-10-25 01:59:47'),(20,10,'Sanford Spinka','Lempi Schulist','2018-10-25 01:59:47','2018-10-25 01:59:47'),(21,10,'Dr. Derick Willms','Lawrence Olson','2018-10-25 01:59:47','2018-10-25 01:59:47'),(22,2,'Prof. Dominique O\'Connell','Darwin Greenholt','2018-10-25 01:59:47','2018-10-25 01:59:47'),(23,3,'Ms. Geraldine Borer','Cicero Mraz','2018-10-25 01:59:47','2018-10-25 01:59:47'),(24,5,'Travis Reichel PhD','Isai Moen V','2018-10-25 01:59:47','2018-10-25 01:59:47'),(25,4,'Dr. Elizabeth Berge DDS','Dr. Casey Windler','2018-10-25 01:59:47','2018-10-25 01:59:47'),(26,5,'Crawford Halvorson','Morton Von','2018-10-25 01:59:47','2018-10-25 01:59:47'),(27,2,'Carson Dach','Prof. Brandi Bosco DDS','2018-10-25 01:59:47','2018-10-25 01:59:47'),(28,8,'Devon Lebsack','Gudrun Klocko','2018-10-25 01:59:47','2018-10-25 01:59:47'),(29,9,'Mrs. Marilie Hane','Roderick Heathcote','2018-10-25 01:59:47','2018-10-25 01:59:47'),(30,3,'Ms. Itzel Harber I','Humberto Eichmann','2018-10-25 01:59:48','2018-10-25 01:59:48');
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
INSERT INTO `master_month` VALUES (1,'January','2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'February','2018-10-25 01:59:24','2018-10-25 01:59:24'),(3,'March','2018-10-25 01:59:24','2018-10-25 01:59:24'),(4,'April','2018-10-25 01:59:24','2018-10-25 01:59:24'),(5,'May','2018-10-25 01:59:24','2018-10-25 01:59:24'),(6,'June','2018-10-25 01:59:24','2018-10-25 01:59:24'),(7,'July','2018-10-25 01:59:24','2018-10-25 01:59:24'),(8,'August','2018-10-25 01:59:24','2018-10-25 01:59:24'),(9,'September','2018-10-25 01:59:24','2018-10-25 01:59:24'),(10,'October','2018-10-25 01:59:24','2018-10-25 01:59:24'),(11,'November','2018-10-25 01:59:24','2018-10-25 01:59:24'),(12,'December','2018-10-25 01:59:24','2018-10-25 01:59:24');
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
INSERT INTO `master_rti_status` VALUES (1,'Send RTI Officer','2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'In Process/Waiting for Meeting Schedule Time','2018-10-25 01:59:24','2018-10-25 01:59:24'),(3,'Meeting is Scheduled','2018-10-25 01:59:24','2018-10-25 01:59:24'),(4,'Closed','2018-10-25 01:59:24','2018-10-25 01:59:24');
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
  `society_bill_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `master_societies_colony_id_foreign` (`colony_id`),
  CONSTRAINT `master_societies_colony_id_foreign` FOREIGN KEY (`colony_id`) REFERENCES `master_colonies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_societies`
--

LOCK TABLES `master_societies` WRITE;
/*!40000 ALTER TABLE `master_societies` DISABLE KEYS */;
INSERT INTO `master_societies` VALUES (1,27,'Raoul Zemlak DVM','Prof. Sibyl Altenwerth Jr.',NULL,'2018-10-25 01:59:48','2018-10-25 02:20:19'),(2,7,'Mr. Humberto Reilly II','Leatha Kuhlman Sr.',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(3,24,'Mrs. Jazmyn Becker III','Prof. Jordi Luettgen',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(4,8,'Monserrate Doyle','Mr. Troy Johnston IV',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(5,11,'Dr. Gwendolyn Farrell Sr.','Arianna Hermiston',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(6,27,'Elaina Kihn','Sydney Goldner',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(7,5,'Anabelle Osinski','Dr. Margaret Hackett',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(8,3,'Gilda O\'Kon I','Ms. Alena Glover III',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(9,6,'Delores Raynor IV','Dr. Judd Larson',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(10,27,'Eldred Feeney','Trinity Mosciski',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(11,3,'Mertie Effertz','Philip Howe',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(12,7,'Milford Heathcote','Raven Koelpin',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(13,25,'Jordan Marvin','Chadd Dibbert PhD',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(14,9,'Jordyn Brakus','Miss Raquel Swaniawski III',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(15,7,'Darren Batz Sr.','Prof. Melvina Goldner II',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(16,22,'Wilton Reinger','Max Williamson',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(17,3,'Prof. Gonzalo Reichel','Jan Doyle',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(18,15,'Verona Corwin','Bernadine Bayer',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(19,17,'Kasey O\'Reilly','Aurelie Luettgen',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(20,29,'Helmer Mayer','Dr. Gunnar Lehner',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(21,8,'Tanya Crist I','Janis Treutel',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(22,1,'Samir Williamson','Angela Windler',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(23,1,'Myah Glover','Dr. Antonia Russel III',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(24,9,'Joesph Schiller','Ms. Lura Tremblay PhD',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(25,28,'Dr. Tom Grimes III','Briana Jaskolski',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(26,22,'Caitlyn Howell','Hertha Bechtelar II',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(27,27,'Amiya McClure PhD','Gudrun Johnston',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(28,17,'Kayley White','Conner Ledner',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(29,7,'Adeline Green','Jewel Howell',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(30,16,'Juana Emard','Kraig Shanahan',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(31,10,'Prof. Joaquin Schimmel','Prof. Aglae Wintheiser I',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(32,23,'Mr. Rene Marquardt','Grace Gutkowski',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(33,5,'Tre McKenzie','Ms. Sylvia Monahan',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(34,19,'Tierra Stoltenberg','Mr. Myrl Leannon Sr.',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(35,18,'Emely Abbott DDS','Benjamin Lindgren',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(36,16,'Prof. Doug Padberg','Dr. Linnea Stehr',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(37,13,'Emiliano Blick','Tia McLaughlin',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(38,11,'Prof. Timmothy Wolf','Dr. Kendra Klein',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(39,20,'Annalise Block','Miss Jacynthe Nolan',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(40,27,'Eulalia King III','Dr. Lyric Huel Sr.',NULL,'2018-10-25 01:59:48','2018-10-25 01:59:48'),(41,13,'Haylie Kautzer','Hayden Marquardt',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(42,5,'Beulah Barrows','Ulises Bruen',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(43,28,'Boyd Ledner','Damaris Friesen',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(44,20,'Dominique Hermann','Hershel Jast',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(45,17,'Mr. Geo Jenkins II','Alvis Kassulke',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(46,30,'Dr. Jean Conn III','Bennie Mraz',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(47,1,'Tressa Greenholt I','Bernard Emard',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(48,29,'Tyson Mitchell','Monserrate Kub',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(49,19,'Bailey Muller','Mrs. Ashlee Torp',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(50,7,'Miss Beaulah Runolfsson I','Prof. Marshall Schaefer',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(51,7,'Deondre Jones','Kari Greenfelder',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(52,30,'Carmella Anderson','Courtney Gibson',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(53,13,'Dr. Trudie Wiegand','Abel Berge MD',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(54,8,'Cierra Runte','Ryleigh Little',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(55,24,'Adelia Jast','Alexandria Mosciski',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(56,8,'Karianne Doyle','Carmel Schimmel',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(57,4,'Jolie Adams','Billy Yost',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(58,2,'Jane Cruickshank','Dr. Mathew Corkery',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(59,22,'Alysson Daugherty','Cornell Bergstrom',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49'),(60,7,'Dakota Kreiger','Dr. Douglas Douglas',NULL,'2018-10-25 01:59:49','2018-10-25 01:59:49');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_society_bill_level`
--

LOCK TABLES `master_society_bill_level` WRITE;
/*!40000 ALTER TABLE `master_society_bill_level` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_tenants`
--

LOCK TABLES `master_tenants` WRITE;
/*!40000 ALTER TABLE `master_tenants` DISABLE KEYS */;
INSERT INTO `master_tenants` VALUES (1,49,'3536','Shri','Jakayla','Prudence','Alexzander','648.260.1300 x542','jacklyn47@mcclure.com','Residential','988','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(2,8,'5747','Shri','Ayden','Murray','Lorine','740.315.8553','zane.turcotte@yahoo.com','Residential','813','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(3,75,'9412','Shri','Joanny','Chaim','Telly','(482) 638-7096','goconner@veum.com','Residential','679','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(4,53,'6054','Shri','Neil','Chloe','Derrick','+1 (804) 417-8019','kohler.heber@bogisich.com','Residential','633','3','2018-10-25 01:59:52','2018-10-25 01:59:52'),(5,3,'7059','Shri','Jerrod','Laurine','Jaeden','+1-357-673-6831','dana.barrows@dietrich.info','Residential','657','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(6,45,'6976','Shri','Zita','Phyllis','Raymundo','901-378-9588','dicki.eleonore@bode.org','Residential','317','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(7,66,'5326','Shri','Juanita','Haskell','Leila','(456) 636-4033','tvandervort@sipes.com','Residential','901','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(8,23,'6174','Shri','Gust','Helga','Jazmin','540.941.8446 x910','roxanne26@nicolas.com','Residential','420','3','2018-10-25 01:59:52','2018-10-25 01:59:52'),(9,57,'3240','Shri','Sage','Erick','Macy','552.831.9880 x3971','destiney27@gmail.com','Residential','453','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(10,87,'3389','Shri','Alayna','Amari','Maud','1-595-330-5033 x25245','emohr@barrows.net','Residential','509','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(11,88,'1448','Shri','Alessia','Jeffrey','Fermin','+1 (879) 804-6145','paul79@will.com','Residential','914','3','2018-10-25 01:59:52','2018-10-25 01:59:52'),(12,55,'5079','Shri','Jazlyn','Helen','Peter','(260) 898-4754 x14871','mabel.aufderhar@sawayn.net','Residential','416','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(13,41,'5041','Shri','Gail','Jeanne','Federico','+1-906-288-7008','harold40@hotmail.com','Residential','955','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(14,6,'7909','Shri','Shemar','Carey','Keely','+1-479-613-4173','bogan.candace@yahoo.com','Residential','996','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(15,5,'3883','Shri','Toni','Nicolas','Leonard','304.994.2166 x06049','wilfrid.jacobi@hilpert.info','Residential','575','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(16,13,'1497','Shri','Ansley','Litzy','Perry','463-618-9021 x1721','perry.kuhn@gmail.com','Residential','674','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(17,88,'7538','Shri','Trisha','Earnest','Buster','(986) 446-4020','eveline33@yahoo.com','Residential','941','3','2018-10-25 01:59:52','2018-10-25 01:59:52'),(18,57,'5703','Shri','Hilma','Nia','Lyla','786.965.0747 x85731','ikoss@gmail.com','Residential','697','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(19,86,'2025','Shri','Vaughn','Vladimir','Arielle','1-983-853-3516 x679','gutkowski.bradley@cormier.net','Residential','571','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(20,83,'1854','Shri','Orie','Addison','Burnice','576-583-8905 x2158','gmosciski@hotmail.com','Residential','670','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(21,36,'8853','Shri','Geo','Adeline','Columbus','930-238-0754 x68921','lsatterfield@goyette.net','Residential','655','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(22,9,'8738','Shri','Hollis','Stephan','Humberto','790.290.8885 x37013','skunze@gaylord.net','Residential','535','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(23,81,'5297','Shri','Corine','Candido','Andy','405-712-8974 x518','jace.kiehn@okuneva.info','Residential','770','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(24,79,'7739','Shri','Abby','Eli','Bethany','(512) 346-3029 x83029','seamus85@smitham.net','Residential','405','2','2018-10-25 01:59:52','2018-10-25 01:59:52'),(25,30,'7934','Shri','Abbigail','Dameon','Joany','272-379-4272','metz.chaz@jacobi.biz','Residential','683','1','2018-10-25 01:59:52','2018-10-25 01:59:52'),(26,27,'3959','Shri','Hilton','Ubaldo','Gillian','407-296-2554 x2157','skylar73@hotmail.com','Residential','754','3','2018-10-25 01:59:52','2018-10-25 01:59:52'),(27,26,'3534','Shri','Kavon','Amely','Therese','1-850-267-0802 x73923','funk.zachariah@koch.org','Residential','652','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(28,6,'1341','Shri','Daisy','Daron','Violette','+1 (471) 987-9894','lindsay17@wisozk.biz','Residential','879','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(29,34,'833','Shri','Baron','Arnoldo','Chadd','(987) 418-2237 x066','kaia58@yahoo.com','Residential','542','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(30,36,'6502','Shri','Kelli','Gracie','Cali','896-361-1717','virgie17@auer.info','Residential','601','4','2018-10-25 01:59:52','2018-10-25 01:59:52'),(31,71,'3057','Shri','Camila','Montana','Halie','751-462-8769','rhiannon47@kub.info','Residential','431','3','2018-10-25 01:59:53','2018-10-25 01:59:53'),(32,13,'1692','Shri','Oda','Yasmin','Arnold','1-274-528-2964 x3513','schuppe.halle@hotmail.com','Residential','892','3','2018-10-25 01:59:53','2018-10-25 01:59:53'),(33,16,'2641','Shri','Meaghan','Garrett','Alan','1-562-706-0311 x5028','simeon92@botsford.biz','Residential','450','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(34,46,'4469','Shri','Dayton','Wendell','Misty','231.302.6962 x8210','mhyatt@mayert.com','Residential','912','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(35,88,'8921','Shri','Kaela','Deja','Jerrod','(273) 627-3768 x325','pierre.kub@yahoo.com','Residential','755','3','2018-10-25 01:59:53','2018-10-25 01:59:53'),(36,23,'8429','Shri','Stacy','Orlo','Troy','648.516.4091','cleta70@shields.com','Residential','655','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(37,29,'6349','Shri','Noemi','Cleora','Destin','+15208735457','rosalia67@hill.info','Residential','825','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(38,30,'8791','Shri','Elvis','Monty','Shakira','835.279.3256 x277','bpaucek@hotmail.com','Residential','318','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(39,76,'7342','Shri','Wava','Isidro','Demetrius','948-263-0889 x1328','damion01@hotmail.com','Residential','439','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(40,82,'2212','Shri','Omer','Nia','Gregg','743.838.3398','hlesch@wolf.info','Residential','607','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(41,90,'7026','Shri','Gwendolyn','Ethelyn','Deion','1-668-233-6154','murphy.rosalinda@jerde.net','Residential','700','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(42,58,'569','Shri','Abdiel','Josue','Shanie','909-433-3455 x17407','kling.velda@yahoo.com','Residential','971','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(43,23,'7116','Shri','Carlee','Valentina','Martin','608.851.0266','bcummerata@hotmail.com','Residential','407','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(44,74,'6610','Shri','Trudie','Katelin','Jarvis','672.696.4392 x390','cecile04@hotmail.com','Residential','859','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(45,80,'1649','Shri','Billy','Derick','Aiden','+1.560.365.4199','leopoldo.kemmer@nitzsche.com','Residential','431','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(46,49,'8896','Shri','Ernest','Arjun','Jaylen','259.791.3415 x636','rosalee.olson@klocko.info','Residential','550','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(47,5,'5580','Shri','Delpha','Jordan','Pierre','736.690.8098 x4317','bobbie.hansen@yahoo.com','Residential','930','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(48,57,'1902','Shri','Carol','Lorine','Kaitlyn','+1 (824) 781-2383','melany31@hotmail.com','Residential','833','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(49,18,'9632','Shri','Leopoldo','Haleigh','Winston','+17966794330','nolan.giovanna@yahoo.com','Residential','820','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(50,18,'8127','Shri','Hans','Alessandro','Skylar','853-474-9141 x03606','block.clay@gmail.com','Residential','359','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(51,59,'7030','Shri','Leola','Reina','Pedro','934-431-0314','sibyl.bins@gmail.com','Residential','907','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(52,56,'4788','Shri','Gilberto','Tyrique','Alysa','843.281.3230 x6644','lrempel@hotmail.com','Residential','655','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(53,74,'2938','Shri','Elisa','Mallie','Wade','+1-443-518-8644','arnulfo77@franecki.com','Residential','387','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(54,38,'8046','Shri','Brody','Alyce','Rosalind','1-617-220-9579','elyssa27@labadie.com','Residential','367','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(55,77,'806','Shri','Julianne','Jazmin','Jamie','503.848.0048 x05605','karina.jaskolski@gmail.com','Residential','374','3','2018-10-25 01:59:53','2018-10-25 01:59:53'),(56,24,'5277','Shri','Jace','Jocelyn','Alexis','1-437-227-1726 x094','abagail58@kertzmann.biz','Residential','618','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(57,19,'3324','Shri','Allie','Petra','Phoebe','440-956-2089','khalil25@gmail.com','Residential','422','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(58,34,'3240','Shri','Grant','Lesly','Winnifred','+13377088370','toy.ariane@yahoo.com','Residential','635','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(59,58,'8786','Shri','Lionel','Brennon','Coby','+13179844947','antonette93@senger.com','Residential','854','4','2018-10-25 01:59:53','2018-10-25 01:59:53'),(60,52,'1309','Shri','Verdie','Jaiden','Michele','1-426-478-2661 x8980','pasquale.bradtke@yahoo.com','Residential','959','3','2018-10-25 01:59:53','2018-10-25 01:59:53'),(61,58,'3210','Shri','Hassie','Willard','Garrett','571-793-1386','donald.rogahn@koch.net','Residential','435','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(62,49,'5808','Shri','Melany','Zola','Thea','419-843-7788 x24301','raphaelle.bradtke@gmail.com','Residential','787','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(63,33,'5060','Shri','Javon','Maye','Pedro','998-971-4048 x81368','clifford.kuvalis@wehner.com','Residential','920','1','2018-10-25 01:59:53','2018-10-25 01:59:53'),(64,73,'2244','Shri','Moises','Antonietta','Lindsay','645.785.6761','wkertzmann@dickinson.com','Residential','487','2','2018-10-25 01:59:53','2018-10-25 01:59:53'),(65,26,'535','Shri','Ofelia','Fritz','Hilton','+1-617-876-3921','maci54@douglas.info','Residential','695','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(66,68,'2308','Shri','Imogene','Carolina','Enrique','(787) 210-1591','nwitting@adams.com','Residential','876','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(67,8,'7131','Shri','Maximillian','Malinda','Bertha','(883) 786-3569 x5928','bnicolas@hotmail.com','Residential','676','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(68,75,'7529','Shri','Brittany','Liana','Ismael','885-916-8577 x1418','hollie53@gleichner.org','Residential','533','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(69,9,'7723','Shri','Justen','Garth','Celestino','1-592-274-3757','gerhard68@yahoo.com','Residential','518','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(70,24,'5648','Shri','Juana','Barton','Zachery','631-265-0279 x856','ericka.howe@jacobs.com','Residential','651','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(71,69,'7679','Shri','Jarred','Nichole','Mason','456.556.9380','aurelia.roberts@yahoo.com','Residential','688','4','2018-10-25 01:59:54','2018-10-25 01:59:54'),(72,88,'817','Shri','Candelario','Kody','Sebastian','902-324-6093 x544','kelsie55@yahoo.com','Residential','478','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(73,61,'1720','Shri','Arden','Savannah','Cristopher','+1 (880) 794-1670','mante.nicolette@gmail.com','Residential','788','4','2018-10-25 01:59:54','2018-10-25 01:59:54'),(74,7,'4970','Shri','Theron','August','Chauncey','732-895-1205','bulah06@hotmail.com','Residential','865','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(75,64,'9877','Shri','Estrella','Rogers','Adrian','1-889-402-9301','jordy.anderson@dibbert.net','Residential','401','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(76,48,'5693','Shri','Verda','Trinity','Gerardo','1-439-417-9212 x57717','blick.kavon@gmail.com','Residential','527','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(77,62,'5032','Shri','Queen','Josephine','Jalyn','742-213-1263 x0274','carroll.mitchell@yahoo.com','Residential','316','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(78,40,'6259','Shri','Gavin','Daren','Selina','+15456609736','joanny56@eichmann.com','Residential','736','4','2018-10-25 01:59:54','2018-10-25 01:59:54'),(79,31,'3796','Shri','Abagail','Lamar','Dagmar','+1.747.788.6942','durward79@ernser.com','Residential','499','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(80,12,'2184','Shri','Blake','Joana','Lavon','1-335-303-8252','mkrajcik@gmail.com','Residential','937','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(81,7,'359','Shri','Santina','Heber','Sunny','310.920.3033 x292','antone.wisozk@murray.net','Residential','915','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(82,57,'8707','Shri','Dandre','Fleta','Salvatore','(391) 425-2011 x44915','mireille99@breitenberg.com','Residential','858','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(83,84,'2286','Shri','Destini','Nathanial','Isobel','+1-335-277-1182','lakin.leonie@yahoo.com','Residential','768','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(84,68,'4054','Shri','Salma','Jeffrey','Deshaun','264-436-6804','nmitchell@gmail.com','Residential','914','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(85,86,'5413','Shri','Arvid','Laurianne','Antonina','679.987.7211 x36775','breanna70@dibbert.com','Residential','593','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(86,56,'7130','Shri','Jamison','Elvera','Willis','+1-967-864-1730','trace.pfeffer@haag.info','Residential','620','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(87,42,'6763','Shri','Lorine','Cooper','Fletcher','864-627-3345 x502','dnicolas@gmail.com','Residential','518','4','2018-10-25 01:59:54','2018-10-25 01:59:54'),(88,33,'7913','Shri','Alberto','Kyleigh','Erica','(886) 680-4501','boyer.jeanne@hotmail.com','Residential','643','4','2018-10-25 01:59:54','2018-10-25 01:59:54'),(89,38,'7811','Shri','Velda','Estel','Juana','(752) 493-6433','danyka.schmitt@beahan.info','Residential','786','3','2018-10-25 01:59:54','2018-10-25 01:59:54'),(90,50,'9881','Shri','Delphine','Cara','Braulio','+1-684-432-3952','kari.harris@schmidt.org','Residential','362','4','2018-10-25 01:59:54','2018-10-25 01:59:54'),(91,40,'3604','Shri','Carissa','Kenya','Fabian','1-476-877-6612 x72258','qrogahn@hotmail.com','Residential','391','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(92,75,'8645','Shri','Reanna','Theron','Berniece','676-849-4661 x7552','connelly.magnus@hotmail.com','Residential','859','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(93,23,'6506','Shri','Cruz','Arch','Watson','859-613-0497 x298','haley18@fahey.info','Residential','855','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(94,59,'7877','Shri','Lorenz','Delphine','Shaylee','521-214-1767 x276','princess.bruen@gmail.com','Residential','598','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(95,49,'489','Shri','Jovan','Lexie','Kenna','+1 (317) 786-2185','justina34@hotmail.com','Residential','561','2','2018-10-25 01:59:54','2018-10-25 01:59:54'),(96,39,'3171','Shri','Hilbert','Regan','Telly','846-554-1455 x58069','iblock@yahoo.com','Residential','962','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(97,21,'435','Shri','Idell','Fleta','Adelbert','(691) 310-4008 x14794','nya.quigley@weimann.biz','Residential','799','1','2018-10-25 01:59:54','2018-10-25 01:59:54'),(98,5,'8556','Shri','Janie','Ardith','Ashtyn','1-749-480-2906','kyler.marks@conroy.com','Residential','751','1','2018-10-25 01:59:55','2018-10-25 01:59:55'),(99,60,'262','Shri','Arvilla','Bulah','Sasha','1-551-516-2100','koss.bulah@blick.com','Residential','787','2','2018-10-25 01:59:55','2018-10-25 01:59:55'),(100,51,'6343','Shri','Deborah','Norma','Mia','271.544.5558','konopelski.america@mertz.com','Residential','777','1','2018-10-25 01:59:55','2018-10-25 01:59:55'),(101,50,'787','Smt','sdfsdf','sdfsdf','sdf','879789','dgg@jhdfg.com','Residential','1200','3','2018-10-25 02:02:12','2018-10-25 02:05:03'),(103,91,'5454','Smt','sfdsdf','sdfsdf','ertert','87878787`','Wsdfs@sfs.dfg','Commercial','7878','2','2018-10-25 02:22:06','2018-10-25 02:22:06');
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
INSERT INTO `master_wards` VALUES (1,1,'Samantha Larkin','Tyreek Harvey','2018-10-25 01:59:46','2018-10-25 01:59:46'),(2,1,'Keegan Bogan','Prof. Jakob Walker I','2018-10-25 01:59:46','2018-10-25 01:59:46'),(3,1,'Betsy Kilback','Kirsten Keebler','2018-10-25 01:59:46','2018-10-25 01:59:46'),(4,1,'Aaron Cronin','Ulises Hintz','2018-10-25 01:59:46','2018-10-25 01:59:46'),(5,1,'Johnathon Crist','Miss Abagail Schinner III','2018-10-25 01:59:47','2018-10-25 01:59:47'),(6,1,'Xzavier Vandervort III','Bettye Smitham','2018-10-25 01:59:47','2018-10-25 01:59:47'),(7,1,'Ms. Roxanne Kuphal','Lisa Russel','2018-10-25 01:59:47','2018-10-25 01:59:47'),(8,1,'Alba Leuschke','Maverick Schmidt','2018-10-25 01:59:47','2018-10-25 01:59:47'),(9,1,'Marina Moore','Cullen Ryan','2018-10-25 01:59:47','2018-10-25 01:59:47'),(10,1,'Nicholas Kovacek','Mrs. Maybelle Block','2018-10-25 01:59:47','2018-10-25 01:59:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_08_20_142459_create_board_table',1),(4,'2018_08_20_142849_create_departments_table',1),(5,'2018_08_20_144538_create_faqs_table',1),(6,'2018_08_20_150324_create_board_departments_table',1),(7,'2018_08_21_055217_alter_faqs_rename_deptname_to_question',1),(8,'2018_08_22_090450_create_frontend_users_table',1),(9,'2018_08_22_133448_create_table_resolution_types',1),(10,'2018_08_22_133449_create_table_resolutions',1),(11,'2018_08_22_135352_create_rti_form_table',1),(12,'2018_08_23_070343_create_table_deleted_resolutions',1),(13,'2018_08_24_121710_alter_rti_form_table_add_unique_field',1),(14,'2018_08_26_161705_alter_rti_fom_table_make_poerty_file_nullable',1),(15,'2018_08_27_115459_create_hearing_application_type',1),(16,'2018_08_27_121033_create_hearing_status',1),(17,'2018_08_27_121805_create_hearing_table',1),(18,'2018_08_29_063730_create_schedule_hearing_table',1),(19,'2018_08_30_063609_create_pre_post_schedule_table',1),(20,'2018_08_30_064205_create_rti_schedule_meeting_table',1),(21,'2018_08_30_120317_add_user_id_to_rti_form_table',1),(22,'2018_08_30_132915_create_master_rti_status',1),(23,'2018_08_30_134316_add_status_rti_form_table',1),(24,'2018_08_30_140429_create_upload_case_judgement_table',1),(25,'2018_08_31_043327_add_send_info_fields_rti_form_table',1),(26,'2018_08_31_052231_add_user_id_rti_form_table',1),(27,'2018_08_31_061605_add_rti_remark_forward_application_rti_form_table',1),(28,'2018_08_31_064811_add_board_id_to_hearing_table',1),(29,'2018_08_31_065843_alter_rti_schedule_meetings_application_no_table',1),(30,'2018_08_31_092607_create_deleted_hearing_table',1),(31,'2018_08_31_095842_create_forward_case_table',1),(32,'2018_08_31_100703_create_rti_status_table',1),(33,'2018_08_31_104117_alter_status_rti_form_table',1),(34,'2018_08_31_111937_alter_status_col_rti_form_table',1),(35,'2018_08_31_123310_final_drop_rti_status_id_rti_form_table',1),(36,'2018_08_31_123356_add_rti_status_id_rti_form_table',1),(37,'2018_08_31_123756_create_send_notice_to_appellant_table',1),(38,'2018_08_31_133408_drop_rti_send_info_fields_rti_form_table',1),(39,'2018_08_31_135124_create_rti_send_info_table',1),(40,'2018_08_31_140033_add_rti_send_info_id_rti_form_table',1),(41,'2018_09_01_041314_create_rti_forward_application_table',1),(42,'2018_09_01_042046_drop_remarks_rti_form_table',1),(43,'2018_09_01_042235_add_rti_forward_application_id_rti_form_table',1),(44,'2018_09_01_044544_add_filename_column_to_forward_case',1),(45,'2018_09_01_055059_create_land_source_table',1),(46,'2018_09_01_061007_create_other_land_table',1),(47,'2018_09_01_075702_create_village_detail_table',1),(48,'2018_09_01_075818_create_society_detail_table',1),(49,'2018_09_01_075828_create_lease_detail_table',1),(50,'2018_09_01_094805_add_mobile_no_users_table',1),(51,'2018_09_01_095427_create_architect_application_table',1),(52,'2018_09_01_095701_add_address_users_table',1),(53,'2018_09_01_113159_create_architect_application_marks_table',1),(54,'2018_09_01_120744_create_architect_application_status_logs_table',1),(55,'2018_09_03_043009_create_master_month_table',1),(56,'2018_09_03_073312_add_status_to_lease_detail',1),(57,'2018_09_03_174609_alter_architect_applicaton_marks_add_document_name_field',1),(58,'2018_09_04_192313_alter_architect_application_marks_add_final_certi_flag',1),(59,'2018_09_06_050425_roles_setup_table',1),(60,'2018_09_06_091427_create_deleted_village_details',1),(61,'2018_09_07_024149_create_society_offer_letters_table',1),(62,'2018_09_07_074325_create_master_email_templates_table',1),(63,'2018_09_10_041214_create_language_master_table',1),(64,'2018_09_10_043011_create_ol_application_master_table',1),(65,'2018_09_10_043619_create_ol_societies_table',1),(66,'2018_09_10_044938_create_ol_society_documents_master_table',1),(67,'2018_09_10_045245_create_ol_society_document_status_table',1),(68,'2018_09_10_052202_add_role_id_to_users_table',1),(69,'2018_09_10_052554_create_role_master_table',1),(70,'2018_09_10_052743_create_module_master_table',1),(71,'2018_09_10_052949_create_role_module_mapping_table',1),(72,'2018_09_10_053206_create_ol_status_master_table',1),(73,'2018_09_10_053839_create_ol_applications_table',1),(74,'2018_09_10_055255_create_ol_application_status_log_table',1),(75,'2018_09_10_060811_create_ol_site_visit_documents_table',1),(76,'2018_09_10_061125_create_ol_dcr_rate_master_table',1),(77,'2018_09_10_061308_create_ol_application_calculation_sheet_details_table',1),(78,'2018_09_10_063022_create_ol_application_checklist_scrunity_details_table',1),(79,'2018_09_10_064615_create_ol_consent_verification_question_master_table',1),(80,'2018_09_10_064857_create_ol_consent_verification_details_table',1),(81,'2018_09_10_065527_create_ol_demarcation_question_master_table',1),(82,'2018_09_10_065606_create_ol_tit_bit_question_master_table',1),(83,'2018_09_10_065631_create_ol_rg_relocation_question_master_table',1),(84,'2018_09_10_065718_create_ol_demarcation_details_table',1),(85,'2018_09_10_065915_create_ol_tit_bit_details_table',1),(86,'2018_09_10_065942_create_ol_rg_relocation_details_table',1),(87,'2018_09_10_092741_add_user_role_id_to_hearing',1),(88,'2018_09_10_124448_delete_model_to_application_master_table',1),(89,'2018_09_10_130111_add_model_to_application_master_table',1),(90,'2018_09_11_090411_add_architect_details_ol_societies_table',1),(91,'2018_09_11_092221_add_society_username_ol_societies_table',1),(92,'2018_09_11_092610_add_society_registration_no_ol_societies_table',1),(93,'2018_09_11_093207_add_society_contact_no_ol_societies_table',1),(94,'2018_09_11_093411_add_redirect_column_to_roles',1),(95,'2018_09_12_041803_create_ol_request_form_details',1),(96,'2018_09_12_042502_add_request_form_id_to_ol_applications',1),(97,'2018_09_14_063814_create_layout_table',1),(98,'2018_09_14_081206_alter_ol_applications_table',1),(99,'2018_09_14_091518_add_parent_id_to_roles_table',1),(100,'2018_09_14_093901_create_layout_user_table',1),(101,'2018_09_15_105445_create_scoiety_uploaded_documents_comment_table',1),(102,'2018_09_15_115320_alter_ol_society_document_status',1),(103,'2018_09_16_103034_add_layout_id_to_application',1),(104,'2018_09_16_110636_add_role_id_to_application_status',1),(105,'2018_09_17_041443_add_user_id_column_to_ol_applications_table',1),(106,'2018_09_17_072325_add_society_flag_application_log_table',1),(107,'2018_09_18_143034_remove_constraints_from_rti_form',1),(108,'2018_09_19_082008_create_frontend_rti_users_table',1),(109,'2018_09_19_082902_rename_frontend_rti_users_table',1),(110,'2018_09_19_091506_add_role_id_to_ol_societies_table',1),(111,'2018_09_19_182735_rename_role_id_to_user_id_ol_societies_table',1),(112,'2018_09_20_131606_create_hearing_status_log_table',1),(113,'2018_09_21_063743_alter_data_type_of_office_date_in_hearing',1),(114,'2018_09_21_143421_create_ol_cap_notes',1),(115,'2018_09_22_075255_drop_foreign_key_hearing',1),(116,'2018_09_22_080049_make_board_id_hearing_nullable',1),(117,'2018_09_22_094744_drop_foreign_key_schedule_hearing',1),(118,'2018_09_22_130949_create_board_user_table',1),(119,'2018_09_24_111140_create_ol_ee_note_table',1),(120,'2018_09_26_045107_add_remaining_resident_area_to_calculation_sheet_details',1),(121,'2018_09_26_055657_add_layout_approval_fee_to_calculation_sheet_details',1),(122,'2018_09_26_114630_create_ol_ree_note',1),(123,'2018_09_27_062221_create_village_societies_table',1),(124,'2018_09_27_110700_add_child_id_to_roles_table',1),(125,'2018_09_27_120506_add_area_of_total_plot_to_calculation_sheet',1),(126,'2018_09_27_124955_add_scrutiny_fee_to_calculation_sheet',1),(127,'2018_09_27_133720_add_drafted_offer_letter_to_ol_application',1),(128,'2018_09_27_142621_alter_ol_societies_table',1),(129,'2018_09_28_073124_create_ol_sharing_calculation_sheet_details',1),(130,'2018_09_28_073956_remove_village_id_from_lm_society_detail',1),(131,'2018_09_28_142431_add_status_offer_letter_to_ol_application',1),(132,'2018_10_01_101452_add_total_additional_claims_to_sharing_sheet',1),(133,'2018_10_01_144346_add_text_offer_letter_to_ol_application',1),(134,'2018_10_03_130750_add_certificate_path_to_architect_application',1),(135,'2018_10_04_060551_create_architect_certificate__table',1),(136,'2018_10_04_072722_add_drafted_certificate_to_architect_application',1),(137,'2018_10_04_082403_add_final_signed_certificate_status_to_architect_application',1),(138,'2018_10_04_082652_rename_status_to_final_signed_certificate_status_in_arcitect_application',1),(139,'2018_10_04_121722_modify_architect_application_status_logs_table',1),(140,'2018_10_04_122408_remove_previous_status_from_architect_application_status_logs_table',1),(141,'2018_10_05_053146_change_total_no_of_buildings_to_calculation',1),(142,'2018_10_05_094218_modify_application_status_column_in_atchitect_application_table',1),(143,'2018_10_05_124159_update_consent_verification_details',1),(144,'2018_10_09_103014_create_architect_layouts_table',1),(145,'2018_10_09_104713_create_architect_layout_details_table',1),(146,'2018_10_09_111503_create_architect_layout_detail_cts_plan_details',1),(147,'2018_10_09_111842_create_architect_layout_detail_pr_card_details',1),(148,'2018_10_09_112247_create_architect_layout_detail_ee_reports',1),(149,'2018_10_09_112458_create_architect_layout_detail_em_reports',1),(150,'2018_10_09_112511_create_architect_layout_detail_ree_reports',1),(151,'2018_10_09_113424_create_architect_layout_detail_land_reports',1),(152,'2018_10_09_113842_create_architect_layout_detail_court_matters_or_disputes_on_land',1),(153,'2018_10_09_124636_create_architect_layout_detail_land_scutiny_reports',1),(154,'2018_10_09_124700_create_architect_layout_detail_ee_scutiny_reports',1),(155,'2018_10_09_124718_create_architect_layout_detail_em_scutiny_reports',1),(156,'2018_10_09_124734_create_architect_layout_detail_ree_scutiny_reports',1),(157,'2018_10_09_140927_create_architect_layout__l_m__scrutinty_question_master_table',1),(158,'2018_10_09_142122_create_architect_layout__e_e__scrutinty_question_master_table',1),(159,'2018_10_09_142429_create_architect_layout__e_m__scrutinty_question_master_table',1),(160,'2018_10_09_142504_create_architect_layout__r_e_e__scrutinty_question_master_table',1),(161,'2018_10_09_142626_create_architect_layout__r_e_e__scrutinty_question_details_table',1),(162,'2018_10_09_143442_create_architect_layout__e_m__scrutinty_question_details_table',1),(163,'2018_10_09_143656_create_architect_layout__e_e__scrutinty_question_details_table',1),(164,'2018_10_09_143842_create_architect_layout__l_m__scrutinty_question_details_table',1),(165,'2018_10_09_145629_create_architect_layout_status_logs_table',1),(166,'2018_10_10_054559_rename_tables_name_of_layout_architect_scrunity_report',1),(167,'2018_10_10_085351_add_keyword_to_resolutions',1),(168,'2018_10_10_140618_add_delete_log_to_roles_table',1),(169,'2018_10_11_092851_create_deleted_role_details',1),(170,'2018_10_12_104049_add_calculated_dcr_val_to_calcuation_sheet',1),(171,'2018_10_13_065651_create_master_wards_table',1),(172,'2018_10_13_065816_create_master_colonies_table',1),(173,'2018_10_13_065836_create_master_societies_table',1),(174,'2018_10_13_070041_create_master_buildings_table',1),(175,'2018_10_13_070216_create_master_tenants_table',1),(176,'2018_10_15_091247_create_master_society_bill_level_table',1),(177,'2018_10_15_091323_create_master_tenant_type_table',1),(178,'2018_10_16_101234_create_table_arrears_charges_rate',1),(179,'2018_10_16_104948_create_table_service_charges_rate',1),(180,'2018_10_17_134728_create_arrear_calculation_table',1),(181,'2018_10_24_064717_alter_table_arrears_charges_rate',1);
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
INSERT INTO `ol_application_master` VALUES (1,0,'Self Redevelopment','2018-10-25 01:59:24','2018-10-25 01:59:24','null'),(2,1,'New - Offer Letter','2018-10-25 01:59:24','2018-10-25 01:59:24','Premium'),(3,1,'Revalidation Of Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(4,1,'Application for NOC','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(5,1,'Consent for OC','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(6,1,'New - Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(7,1,'Revalidation Of Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(8,1,'Application for NOC - IOD','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(9,1,'Tripartite Agreement','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(10,1,'Application for CC','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(11,1,'Consent for OC','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(12,0,'Redevelopment Through Developer','2018-10-25 01:59:25','2018-10-25 01:59:25','null'),(13,12,'New - Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(14,12,'Revalidation Of Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(15,12,'Application for NOC','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(16,12,'Consent for OC','2018-10-25 01:59:25','2018-10-25 01:59:25','Premium'),(17,12,'New - Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(18,12,'Revalidation Of Offer Letter','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(19,12,'Application for NOC - IOD','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(20,12,'Tripartite Agreement','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(21,12,'Application for CC','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing'),(22,12,'Consent for OC','2018-10-25 01:59:25','2018-10-25 01:59:25','Sharing');
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
INSERT INTO `ol_dcr_rate_master` VALUES (1,'0 to 2','EWS / LIG',40,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(2,'0 to 2','MIG',60,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(3,'0 to 2','HIG',80,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(4,'2 to 4','EWS / LIG',45,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(5,'2 to 4','MIG',65,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(6,'2 to 4','HIG',85,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(7,'4 to 6','EWS / LIG',50,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(8,'4 to 6','MIG',70,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(9,'4 to 6','HIG',90,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(10,'above 6','EWS / LIG',55,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(11,'above 6','MIG',75,'2018-10-25 01:59:25','2018-10-25 01:59:25'),(12,'above 6','HIG',95,'2018-10-25 01:59:25','2018-10-25 01:59:25');
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
INSERT INTO `ol_society_documents_master` VALUES (1,2,2,'संस्थेचा अर्ज','2018-10-25 01:59:25','2018-10-25 01:59:25'),(2,2,2,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-25 01:59:25','2018-10-25 01:59:25'),(3,2,2,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(4,2,2,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(5,2,2,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(6,2,2,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(7,2,2,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-25 01:59:26','2018-10-25 01:59:26'),(8,2,2,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(9,2,2,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-25 01:59:26','2018-10-25 01:59:26'),(10,2,2,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(11,2,2,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-25 01:59:26','2018-10-25 01:59:26'),(12,2,2,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(13,2,2,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-25 01:59:26','2018-10-25 01:59:26'),(14,2,2,'नगरभुमापन नकाशे','2018-10-25 01:59:26','2018-10-25 01:59:26'),(15,2,2,'मिळकत पत्रिका (PR कार्ड )','2018-10-25 01:59:26','2018-10-25 01:59:26'),(16,2,2,'अस्तीत्वातील इमारतीचे फोटो','2018-10-25 01:59:26','2018-10-25 01:59:26'),(17,2,2,'प्रस्तावीत इमारतीचा नकाशा','2018-10-25 01:59:26','2018-10-25 01:59:26'),(18,2,2,'डी.पी.रिमार्क','2018-10-25 01:59:26','2018-10-25 01:59:26'),(19,2,6,'संस्थेचा अर्ज','2018-10-25 01:59:26','2018-10-25 01:59:26'),(20,2,6,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-25 01:59:26','2018-10-25 01:59:26'),(21,2,6,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(22,2,6,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(23,2,6,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(24,2,6,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(25,2,6,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-25 01:59:26','2018-10-25 01:59:26'),(26,2,6,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(27,2,6,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-25 01:59:26','2018-10-25 01:59:26'),(28,2,6,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(29,2,6,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-25 01:59:26','2018-10-25 01:59:26'),(30,2,6,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-25 01:59:26','2018-10-25 01:59:26'),(31,2,6,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-25 01:59:26','2018-10-25 01:59:26'),(32,2,6,'नगरभुमापन नकाशे','2018-10-25 01:59:26','2018-10-25 01:59:26'),(33,2,6,'मिळकत पत्रिका (PR कार्ड )','2018-10-25 01:59:26','2018-10-25 01:59:26'),(34,2,6,'अस्तीत्वातील इमारतीचे फोटो','2018-10-25 01:59:26','2018-10-25 01:59:26'),(35,2,6,'प्रस्तावीत इमारतीचा नकाशा','2018-10-25 01:59:27','2018-10-25 01:59:27'),(36,2,6,'डी.पी.रिमार्क','2018-10-25 01:59:27','2018-10-25 01:59:27'),(37,2,13,'संस्थेचा अर्ज','2018-10-25 01:59:27','2018-10-25 01:59:27'),(38,2,13,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-25 01:59:27','2018-10-25 01:59:27'),(39,2,13,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(40,2,13,'संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(41,2,13,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(42,2,13,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(43,2,13,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(44,2,13,'विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(45,2,13,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-25 01:59:27','2018-10-25 01:59:27'),(46,2,13,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(47,2,13,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-25 01:59:27','2018-10-25 01:59:27'),(48,2,13,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(49,2,13,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-25 01:59:27','2018-10-25 01:59:27'),(50,2,13,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(51,2,13,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-25 01:59:27','2018-10-25 01:59:27'),(52,2,13,'नगरभुमापन नकाशे','2018-10-25 01:59:27','2018-10-25 01:59:27'),(53,2,13,'मिळकत पत्रिका (PR कार्ड )','2018-10-25 01:59:27','2018-10-25 01:59:27'),(54,2,13,'अस्तीत्वातील इमारतीचे फोटो','2018-10-25 01:59:27','2018-10-25 01:59:27'),(55,2,13,'प्रस्तावीत इमारतीचा नकाशा','2018-10-25 01:59:27','2018-10-25 01:59:27'),(56,2,13,'डी.पी.रिमार्क','2018-10-25 01:59:27','2018-10-25 01:59:27'),(57,2,13,'उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र','2018-10-25 01:59:27','2018-10-25 01:59:27'),(58,2,17,'संस्थेचा अर्ज','2018-10-25 01:59:27','2018-10-25 01:59:27'),(59,2,17,'सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव','2018-10-25 01:59:27','2018-10-25 01:59:27'),(60,2,17,'सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(61,2,17,'संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(62,2,17,'सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(63,2,17,'वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(64,2,17,'वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(65,2,17,'विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(66,2,17,'७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र','2018-10-25 01:59:27','2018-10-25 01:59:27'),(67,2,17,'अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(68,2,17,'भाडेपट्टा करारनामा (लीज डिड)','2018-10-25 01:59:27','2018-10-25 01:59:27'),(69,2,17,'अभिहस्तांतरण नकाशा ची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(70,2,17,'कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा','2018-10-25 01:59:27','2018-10-25 01:59:27'),(71,2,17,'संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत','2018-10-25 01:59:27','2018-10-25 01:59:27'),(72,2,17,'मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र','2018-10-25 01:59:28','2018-10-25 01:59:28'),(73,2,17,'नगरभुमापन नकाशे','2018-10-25 01:59:28','2018-10-25 01:59:28'),(74,2,17,'मिळकत पत्रिका (PR कार्ड )','2018-10-25 01:59:28','2018-10-25 01:59:28'),(75,2,17,'अस्तीत्वातील इमारतीचे फोटो','2018-10-25 01:59:28','2018-10-25 01:59:28'),(76,2,17,'प्रस्तावीत इमारतीचा नकाशा','2018-10-25 01:59:28','2018-10-25 01:59:28'),(77,2,17,'डी.पी.रिमार्क','2018-10-25 01:59:28','2018-10-25 01:59:28'),(78,2,17,'उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र','2018-10-25 01:59:28','2018-10-25 01:59:28');
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
INSERT INTO `other_land` VALUES (1,'SRA',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(2,'Amenity plot',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(3,'Plot handed over BMC or others',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(4,'Vacant plots',1,'2018-10-25 01:59:24','2018-10-25 01:59:24'),(5,'Office building',1,'2018-10-25 01:59:24','2018-10-25 01:59:24');
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
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,3),(49,3),(50,3),(51,3),(52,3),(53,3),(54,3),(55,3),(56,3),(57,3),(58,3),(59,3),(60,3),(61,3),(62,3),(63,3),(64,3),(65,3),(66,3),(67,3),(68,3),(69,3),(70,3),(71,3),(72,3),(73,3),(74,4),(75,4),(76,4),(77,4),(78,4),(79,4),(80,4),(81,4),(82,4),(83,4),(84,4),(85,4),(86,4),(87,4),(88,4),(89,4),(90,4),(91,4),(92,4),(93,4),(94,4),(95,4),(96,4),(97,4),(98,4),(99,4),(100,5),(101,5),(102,5),(103,5),(104,5),(105,5),(106,5),(107,5),(108,5),(109,5),(110,5),(111,5),(112,5),(113,5),(114,5),(115,5),(116,5),(117,5),(118,5),(119,5),(120,5),(121,5),(122,5),(123,5),(124,5),(125,5),(126,5),(127,5),(128,6),(129,6),(130,6),(131,6),(132,6),(133,6),(134,7),(135,7),(136,7),(137,7),(138,7),(139,7),(140,7),(141,7),(142,7),(143,7),(144,8),(145,8),(146,8),(147,8),(148,8),(149,8),(150,8),(151,9),(152,9),(153,9),(154,9),(155,9),(156,9),(157,9),(158,10),(159,10),(160,10),(161,10),(162,10),(163,10),(164,10),(165,11),(166,11),(167,11),(168,11),(169,11),(170,11),(171,11),(172,11),(173,11),(174,11),(175,11),(176,11),(177,11),(178,11),(179,11),(180,11),(181,11),(182,11),(183,11),(184,11),(185,11),(186,11),(214,12),(215,12),(216,12),(217,12),(218,12),(219,12),(220,12),(187,13),(188,13),(189,13),(190,13),(191,13),(192,13),(193,13),(194,13),(195,13),(196,13),(197,13),(198,13),(199,13),(200,13),(201,13),(202,13),(203,13),(204,13),(205,13),(206,13),(207,13),(208,13),(209,13),(210,13),(211,13),(212,13),(213,13),(214,14),(215,14),(216,14),(217,14),(218,14),(219,14),(220,14),(187,15),(188,15),(189,15),(190,15),(191,15),(192,15),(193,15),(194,15),(195,15),(196,15),(197,15),(198,15),(199,15),(200,15),(201,15),(202,15),(203,15),(204,15),(205,15),(206,15),(207,15),(208,15),(209,15),(210,15),(211,15),(212,15),(213,15),(221,16),(222,16),(223,16),(224,16),(225,16),(226,16),(227,16),(228,16),(229,16),(230,16),(231,16),(232,16),(233,16),(234,17),(235,17),(236,17),(237,17),(238,17),(239,17),(240,17),(241,17),(242,17),(243,17),(244,17),(245,17),(246,17),(247,18),(248,18),(249,18),(250,18),(251,18),(252,18),(253,18),(254,18),(255,18),(256,18),(257,18),(258,18),(259,18),(260,19),(261,19),(262,19),(263,19),(264,19),(265,19),(266,19),(267,19),(268,19),(269,19),(270,19),(271,19),(272,19),(273,20),(274,20),(275,20),(276,20),(277,20),(278,20),(279,20),(280,20),(281,21),(282,21),(283,21),(284,21),(285,21),(286,21),(287,21),(288,22),(289,22),(290,22),(291,22),(292,22),(293,22),(294,22),(295,22),(296,23),(297,23),(298,23),(299,23),(300,23),(301,23),(302,23),(303,23),(304,23),(305,23),(306,23),(307,23),(308,23),(309,23),(310,23),(311,23),(312,24),(313,24),(314,24),(315,24),(316,24),(317,24),(318,24),(319,25),(320,25),(321,25),(322,25),(323,25),(324,25),(325,25),(326,25),(327,26),(328,26),(329,26),(330,26),(331,26),(332,26),(333,26),(334,26),(335,26),(336,26),(337,26),(338,26),(339,26),(340,26),(341,26),(342,26),(327,27),(328,27),(329,27),(330,27),(331,27),(332,27),(333,27),(334,27),(335,27),(336,27),(337,27),(338,27),(339,27),(340,27),(341,27),(342,27),(327,28),(328,28),(329,28),(330,28),(331,28),(332,28),(333,28),(334,28),(335,28),(336,28),(337,28),(338,28),(339,28),(340,28),(341,28),(342,28),(327,29),(329,29),(330,29),(331,29),(334,29),(341,29),(343,29);
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
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'society_offer_letter.index','index','index',NULL,NULL),(2,'society_offer_letter.store','society_offer_letter_registration','store society registration details for offer letter',NULL,NULL),(3,'society_offer_letter.create','display_society_offer_letter_registration','displays society registration form for offer letter',NULL,NULL),(4,'society_offer_letter_forgot_password','society_forgot_password','society forgot password functionality',NULL,NULL),(5,'society_offer_letter_dashboard','society_offer_letter_application_listing','society offer letter application listing',NULL,NULL),(6,'offer_letter_application_self','offer_letter_application_self','displays offer letter application form for self redevelopment',NULL,NULL),(7,'save_offer_letter_application_self','save_offer_letter_application_self','saves offer letter application form for self redevelopment',NULL,NULL),(8,'offer_letter_application_dev','offer_letter_application_dev','displays offer letter application form for redevelopment through developer',NULL,NULL),(9,'save_offer_letter_application_dev','save_offer_letter_application_dev','saves offer letter application form for redevelopment through developer',NULL,NULL),(10,'documents_upload','documents_upload','displays document names listings & upload documents form',NULL,NULL),(11,'uploaded_documents','uploaded_documents','displays download and upload option for submitted offer letter application form',NULL,NULL),(12,'delete_uploaded_documents','delete_uploaded_documents','deletes documents for submitted offer letter application form',NULL,NULL),(13,'add_documents_comment','add_documents_comment','add comments for uploaded documents for submitted offer letter application form',NULL,NULL),(14,'society_offer_letter_download','society_offer_letter_download','displays submitted society offer letter application',NULL,NULL),(15,'upload_society_offer_letter','upload_society_offer_letter','upload submitted society offer letter application after signature',NULL,NULL),(16,'society_detail.UserAuthentication','society_detail.UserAuthentication','authenticates society offer letter users',NULL,NULL),(17,'documents_uploaded','documents_uploaded','view uploaded society documents',NULL,NULL),(18,'add_documents_comment','add_documents_comment','add documents comment',NULL,NULL),(19,'add_uploaded_documents_remark','add_uploaded_documents_remark','add uploaded documents remark',NULL,NULL),(20,'society_offer_letter_application_download','society_offer_letter_application_download','downloads society offer letter application',NULL,NULL),(21,'upload_society_offer_letter_application','upload_society_offer_letter_application','uploads society offer letter application',NULL,NULL),(22,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(23,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(24,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(25,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(26,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(27,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(28,'document-submitted','Document submitted','Document submitted',NULL,NULL),(29,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(30,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(31,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(32,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(33,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(34,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(35,'arrears_charges.create','Arrears charges create','Arrears charges create',NULL,NULL),(36,'arrears_charges.store','Arrears charges store','Arrears charges store',NULL,NULL),(37,'arrears_charges.edit','Arrears charges edit','Arrears charges edit',NULL,NULL),(38,'arrears_charges.update','Arrears charges update','Arrears charges update',NULL,NULL),(39,'arrears_charges','Arrears charges list','Arrears charges list',NULL,NULL),(40,'service_charges.create','Service charges create','Service charges create',NULL,NULL),(41,'service_charges.store','Service charges store','Service charges store',NULL,NULL),(42,'service_charges.edit','Service charges edit','Service charges edit',NULL,NULL),(43,'service_charges.update','Service charges update','Service charges update',NULL,NULL),(44,'service_charges','Service charges list','Service charges list',NULL,NULL),(45,'society.billing_level','Society billing level','Society billing level',NULL,NULL),(46,'society.society_details','Society details','Society details',NULL,NULL),(47,'ee.upload_ee_note','Upload EE Note','Upload EE Note',NULL,NULL),(48,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(49,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(50,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(51,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(52,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(53,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(54,'document-submitted','Document submitted','Document submitted',NULL,NULL),(55,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(56,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(57,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(58,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(59,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(60,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(61,'arrears_charges.create','Arrears charges create','Arrears charges create',NULL,NULL),(62,'arrears_charges.store','Arrears charges store','Arrears charges store',NULL,NULL),(63,'arrears_charges.edit','Arrears charges edit','Arrears charges edit',NULL,NULL),(64,'arrears_charges.update','Arrears charges update','Arrears charges update',NULL,NULL),(65,'arrears_charges','Arrears charges list','Arrears charges list',NULL,NULL),(66,'service_charges.create','Service charges create','Service charges create',NULL,NULL),(67,'service_charges.store','Service charges store','Service charges store',NULL,NULL),(68,'service_charges.edit','Service charges edit','Service charges edit',NULL,NULL),(69,'service_charges.update','Service charges update','Service charges update',NULL,NULL),(70,'service_charges','Service charges list','Service charges list',NULL,NULL),(71,'society.billing_level','Society billing level','Society billing level',NULL,NULL),(72,'society.society_details','Society details','Society details',NULL,NULL),(73,'ee.upload_ee_note','Upload EE Note','Upload EE Note',NULL,NULL),(74,'ee.index','List EE Application','Listing EE Application',NULL,NULL),(75,'scrutiny-remark','Scrutiny Remark','Scrutiny Remark by EE',NULL,NULL),(76,'ee-scrutiny-document','Scrutiny document','Scrutiny document',NULL,NULL),(77,'get-ee-scrutiny-data','Scrutiny Remark data fetch','Scrutiny Remark data fetch',NULL,NULL),(78,'edit-ee-scrutiny-document','Scrutiny document edit','Scrutiny document edit',NULL,NULL),(79,'ee-document-scrutiny-delete','Scrutiny document delete','Scrutiny document delete',NULL,NULL),(80,'document-submitted','Document submitted','Document submitted',NULL,NULL),(81,'get-forward-application','Forward Application form','Forward Application form',NULL,NULL),(82,'forward-application','Forward Application form data store','Forward Application form data store',NULL,NULL),(83,'consent-verfication','Consent verification data store','Consent verification data store',NULL,NULL),(84,'ee-demarcation','EE Demarcation data store','EE Demarcation data store',NULL,NULL),(85,'ee-tit-bit','EE TIT BIT data store','EE TIT BIT data store',NULL,NULL),(86,'ee-rg-relocation','EE RG Relocation data store','EE RG Relocation data store',NULL,NULL),(87,'arrears_charges.create','Arrears charges create','Arrears charges create',NULL,NULL),(88,'arrears_charges.store','Arrears charges store','Arrears charges store',NULL,NULL),(89,'arrears_charges.edit','Arrears charges edit','Arrears charges edit',NULL,NULL),(90,'arrears_charges.update','Arrears charges update','Arrears charges update',NULL,NULL),(91,'arrears_charges','Arrears charges list','Arrears charges list',NULL,NULL),(92,'service_charges.create','Service charges create','Service charges create',NULL,NULL),(93,'service_charges.store','Service charges store','Service charges store',NULL,NULL),(94,'service_charges.edit','Service charges edit','Service charges edit',NULL,NULL),(95,'service_charges.update','Service charges update','Service charges update',NULL,NULL),(96,'service_charges','Service charges list','Service charges list',NULL,NULL),(97,'society.billing_level','Society billing level','Society billing level',NULL,NULL),(98,'society.society_details','Society details','Society details',NULL,NULL),(99,'ee.upload_ee_note','Upload EE Note','Upload EE Note',NULL,NULL),(100,'em.index','List EM Application','Listing EM Application',NULL,NULL),(101,'get_societies','List Societies','Listing Societies',NULL,NULL),(102,'get_buildings','List Buildings','Listing Buildings',NULL,NULL),(103,'get_tenants','List Tenants','Listing Tenants',NULL,NULL),(104,'soc_bill_level','Society bill level','Society bill level',NULL,NULL),(105,'update_soc_bill_level','Update Society Bill Level','Update Society Bill Level',NULL,NULL),(106,'soc_ward_colony','Society Ward Colony','Society Ward Colony',NULL,NULL),(107,'update_soc_ward_colony','Update Society Ward Colony','Update Society Ward Colony',NULL,NULL),(108,'get_wards','Get Wards','Get Wards',NULL,NULL),(109,'get_colonies','Get Colonies','Get Colonies',NULL,NULL),(110,'get_society_select','Selected Society','Selected Society',NULL,NULL),(111,'get_building_ajax','Ajax building','Ajax building',NULL,NULL),(112,'get_building_select','Selected Building','Selected Building',NULL,NULL),(113,'get_tenant_ajax','Ajax Tenant','Ajax Tenant',NULL,NULL),(114,'add_building','Add Building','Add Building',NULL,NULL),(115,'edit_building','Edir Building Data','Edir Building Data',NULL,NULL),(116,'create_building','Create Building','Create Building',NULL,NULL),(117,'update_building','Update Building','Update Building',NULL,NULL),(118,'add_tenant','Add Tenant','Add Tenant',NULL,NULL),(119,'edit_tenant','Edit Tenant','Edit Tenant',NULL,NULL),(120,'add_tenant','Add Tenant','Add Tenant',NULL,NULL),(121,'create_tenant','Create Tenant','Create Tenant',NULL,NULL),(122,'update_tenant','Update Tenant','Update Tenant',NULL,NULL),(123,'delete_tenant','Delete Tenant','Delete Tenant',NULL,NULL),(124,'generate_soc_bill','Generate Society Bill','Generate Society Bill',NULL,NULL),(125,'generate_tenant_bill','Generate Tenant Bill','Generate Tenant Bill',NULL,NULL),(126,'arrears_calculations','Arrears Calculations','Arrears Calculationst',NULL,NULL),(127,'billing_calculations','Biiling Calculations','Biiling Calculations',NULL,NULL),(128,'em_clerk.index','List EM  ClerkApplication','Listing EM Clerk Application',NULL,NULL),(129,'em_society_list','List EM  Society','Listing EM Society',NULL,NULL),(130,'em_building_list','List EM  Building','Listing EM Building',NULL,NULL),(131,'tenant_payment_list','List Tenant Payment','Listing Tenant Payment',NULL,NULL),(132,'tenant_arrear_calculation','Tenant Arrear Calculation','Tenant Arrear Calculation',NULL,NULL),(133,'create_arrear_calculation','Create Arrear Calculation','Create Arrear Calculation',NULL,NULL),(134,'rc.index','List Collected Rents','Listing Collected Rents',NULL,NULL),(135,'bill_collection_society','Bill Collection Society','Bill Collection Society',NULL,NULL),(136,'bill_collection_tenant','Bill Collection Tenant','Bill Collection Tenant',NULL,NULL),(137,'get_wards','Get Wards Select Data','Get Wards Select Data',NULL,NULL),(138,'get_colonies','Get Colonies Select Data','Get Colonies Select Data',NULL,NULL),(139,'get_society_select','Get Societies Select Data','Get Societies Select Data',NULL,NULL),(140,'get_building_bill_collection','Get Buildings Bill Collection List Data','Get Buildings Bill Collection List Data',NULL,NULL),(141,'get_tenant_bill_collection','Get Tenant Bill Collection List Data','Get Tenant Bill Collection List Data',NULL,NULL),(142,'get_building_bill_collection','Building Bill Collection','Building Bill Collection',NULL,NULL),(143,'get_tenant_bill_collection','Tenant Bill Collection','Tenant Bill Collection',NULL,NULL),(144,'dyce.index','index','index',NULL,NULL),(145,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(146,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(147,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(148,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(149,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(150,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(151,'dyce.index','index','index',NULL,NULL),(152,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(153,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(154,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(155,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(156,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(157,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(158,'dyce.index','index','index',NULL,NULL),(159,'dyce.store','store dyce uploaded files','store dyce uploaded files',NULL,NULL),(160,'dyce.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(161,'dyce.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(162,'dyce.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(163,'dyce.forward_application','forward_application','forward_application',NULL,NULL),(164,'dyce.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(165,'village_detail.index','List village','Listing of village',NULL,NULL),(166,'village_detail.create','Create a village','Creating a new village',NULL,NULL),(167,'village_detail.edit','Edit a village','Edit a village',NULL,NULL),(168,'village_detail.show','Show a village data','Show a village data',NULL,NULL),(169,'village_detail.update','Update a village','Updating data of a particular village',NULL,NULL),(170,'village_detail.destroy','Delete a village','Delete a particular village',NULL,NULL),(171,'loadDeleteVillageUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(172,'village_detail.store','Store a village a data','Creating a new village',NULL,NULL),(173,'society_detail.index','Society list','List all societies coming under particular village',NULL,NULL),(174,'society_detail.create','Society Create','Create society for a particular village',NULL,NULL),(175,'society_detail.store','Society Store','Store society data for a particular village',NULL,NULL),(176,'society_detail.edit','Society Edit','Edit society data for a particular village',NULL,NULL),(177,'society_detail.update','Society Update','Update society data for a particular village',NULL,NULL),(178,'society_detail.show','Show society data','Show society data',NULL,NULL),(179,'lease_detail.index','List Lease','List lease for a particular society',NULL,NULL),(180,'lease_detail.create','Create Lease','Create lease for a particular society',NULL,NULL),(181,'lease_detail.store','Store Lease','Store lease for a particular society',NULL,NULL),(182,'renew-lease.renew','Renew Lease','Renew lease for a particular society',NULL,NULL),(183,'renew-lease.update-lease','Updated Renew Lease data','Updated Renew Lease data',NULL,NULL),(184,'edit-lease.edit','Shows edit page for Edit Lease data','Shows edit page for Edit Lease data',NULL,NULL),(185,'update-lease.update','Updated Latest Lease data','Updated Latest Lease data',NULL,NULL),(186,'view-lease.view','Views Latest Lease data','Views Latest Lease data',NULL,NULL),(187,'hearing.index','List Hearing','Listing of Hearing',NULL,NULL),(188,'hearing.create','Create a hearing','Creating a new hearing',NULL,NULL),(189,'hearing.edit','Edit a hearing','Edit a hearing',NULL,NULL),(190,'hearing.update','Update a hearing','Updating data of a particular hearing',NULL,NULL),(191,'hearing.destroy','Delete a hearing','Delete a particular hearing',NULL,NULL),(192,'loadDeleteReasonOfHearingUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(193,'hearing.store','Store a hearing a data','Creating a new hearing',NULL,NULL),(194,'schedule_hearing.add','Schedule Add','Add Schedule',NULL,NULL),(195,'hearing.show','Show Hearing','Display a particular hearing',NULL,NULL),(196,'schedule_hearing.store','Schedule Hearing Store','Store Schedule Hearing data',NULL,NULL),(197,'fix_schedule.add','Add Pre/Post Schedule data','Add Pre/Post Schedule data',NULL,NULL),(198,'fix_schedule.store','Store Pre/Post Schedule data','Store Pre/Post Schedule data',NULL,NULL),(199,'fix_schedule.edit','Edit Pre/Post Schedule data','Edit Pre/Post Schedule data',NULL,NULL),(200,'fix_schedule.update','Update Pre/Post Schedule data','Update Pre/Post Schedule data',NULL,NULL),(201,'upload_case_judgement.add','Upload Case Judgement data','Upload Case Judgement Pre/Post Schedule data',NULL,NULL),(202,'upload_case_judgement.store','Store Upload Case Judgement data','Store Upload Case Judgement data',NULL,NULL),(203,'upload_case_judgement.edit','Edit Upload Case Judgement data','Edit Upload Case Judgement data',NULL,NULL),(204,'upload_case_judgement.update','Update Upload Case Judgement data','Update Upload Case Judgement data',NULL,NULL),(205,'forward_case.create','Forward Case data','Forward Case Pre/Post Schedule data',NULL,NULL),(206,'forward_case.store','Store Forward Case data','Store Forward Case data',NULL,NULL),(207,'forward_case.edit','Edit Forward Case data','Edit Forward Case data',NULL,NULL),(208,'forward_case.update','Update Forward Case data','Update Forward Case data',NULL,NULL),(209,'send_notice_to_appellant.create','Send Notice data','Send Notice data',NULL,NULL),(210,'send_notice_to_appellant.store','Store Send Notice data','Store Send Notice data',NULL,NULL),(211,'send_notice_to_appellant.edit','Edit Send Notice data','Edit Send Notice data',NULL,NULL),(212,'send_notice_to_appellant.update','Update Send Notice data','Update Send Notice data',NULL,NULL),(213,'schedule_hearing.show','Shows scheduled hearing data','Shows scheduled hearing data',NULL,NULL),(214,'hearing.index','List Hearing','Listing of Hearing',NULL,NULL),(215,'hearing.show','Show Hearing','Display a particular hearing',NULL,NULL),(216,'forward_case.create','Forward Case data','Forward Case Pre/Post Schedule data',NULL,NULL),(217,'forward_case.store','Store Forward Case data','Store Forward Case data',NULL,NULL),(218,'forward_case.edit','Edit Forward Case data','Edit Forward Case data',NULL,NULL),(219,'forward_case.update','Update Forward Case data','Update Forward Case data',NULL,NULL),(220,'forward_case.show','Shows Forwarded Case data','Shows Forwarded Case data',NULL,NULL),(221,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(222,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(223,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(224,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(225,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(226,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(227,'ree.forward_application','forward application','forward application',NULL,NULL),(228,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(229,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(230,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(231,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(232,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(233,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(234,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(235,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(236,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(237,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(238,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(239,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(240,'ree.forward_application','forward application','forward application',NULL,NULL),(241,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(242,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(243,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(244,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(245,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(246,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(247,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(248,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(249,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(250,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(251,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(252,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(253,'ree.forward_application','forward application','forward application',NULL,NULL),(254,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(255,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(256,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(257,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(258,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(259,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(260,'ree_dashboard.index','REE Dashboard','REE Dashboard',NULL,NULL),(261,'ree_applications.index','REE Dashboard','REE Dashboard',NULL,NULL),(262,'ol_calculation_sheet.show','Calculation Sheet','Application calculation sheet',NULL,NULL),(263,'ree.society_EE_documents','society EE documents','society EE documents',NULL,NULL),(264,'ree.EE_Scrutiny_Remark','EE Scrutiny Remark','EE Scrutiny Remark',NULL,NULL),(265,'ree.dyce_scrutiny_remark','dyce scrutiny remark','dyce scrutiny remark',NULL,NULL),(266,'ree.forward_application','forward application','forward application',NULL,NULL),(267,'ree.forward_application_data','forward application data','forward application data',NULL,NULL),(268,'ree.download_cap_note','download cap note','download cap note',NULL,NULL),(269,'save_calculation_details','Save calculation details','Save calculation details',NULL,NULL),(270,'ree.upload_ree_note','Upload ree note','Upload ree note',NULL,NULL),(271,'ol_sharing_calculation_sheet.show','Sharing Calculation Sheet','Sharing Application calculation sheet',NULL,NULL),(272,'save_sharing_calculation_details','Save sharing calculation details','Save sharing calculation details',NULL,NULL),(273,'cap.index','index','index',NULL,NULL),(274,'cap.EE_scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(275,'cap.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(276,'cap.dyce_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(277,'cap.forward_application','forward_application','forward_application',NULL,NULL),(278,'cap.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(279,'cap.cap_notes','cap notes','cap notes',NULL,NULL),(280,'cap.upload_cap_note','upload cap notes','upload cap notes',NULL,NULL),(281,'co.index','index','index',NULL,NULL),(282,'co.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(283,'co.EE_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(284,'co.scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(285,'co.forward_application','forward_application','forward_application',NULL,NULL),(286,'co.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(287,'co.download_cap_note','download_cap_note','download_cap_note',NULL,NULL),(288,'resolution.index','List Resolution','Listing of Resolutions',NULL,NULL),(289,'resolution.create','Create a resolution','Creating a new resolution',NULL,NULL),(290,'resolution.edit','Edit a resolution','Edit a resolution',NULL,NULL),(291,'resolution.update','Update a resolution','Updating data of a particular resolution',NULL,NULL),(292,'resolution.destroy','Delete a resolution','Delete a particular resolution',NULL,NULL),(293,'loadDeleteReasonOfResolutionUsingAjax','Delete route from pop up','Delete route from pop up',NULL,NULL),(294,'resolution.store','Store a resolution a data','Creating a new resolution',NULL,NULL),(295,'frontend_resolution_list','Frontend resolution list','Frontend resolution list',NULL,NULL),(296,'rti_form','Show front end form','Show front end form',NULL,NULL),(297,'rti_form_success','Save RTI form data','Save RTI form data',NULL,NULL),(298,'rti_form_success_close','Save RTI form data','Save RTI form data',NULL,NULL),(299,'rti_form_search','RTI Form success','RTI Form success',NULL,NULL),(300,'rti_applicants','List of RTI Applicants','List of RTI Applicants',NULL,NULL),(301,'schedule_meeting','Schedule meeting','Schedule meeting',NULL,NULL),(302,'rti_schedule_meeting','Save Schedule meeting data','Save Schedule meeting data',NULL,NULL),(303,'view_applicant','View Applicant','View Applicant',NULL,NULL),(304,'update_status','Get Update Status form','Get Update Status form',NULL,NULL),(305,'rti_update_status','Save update status data','Save update status data',NULL,NULL),(306,'rti_send_info','Get RTI info form','Get RTI info form',NULL,NULL),(307,'rti_sent_info_data','Save RTI info data','Save RTI info data',NULL,NULL),(308,'rti_forwarded_application','Get Forward application form','Get Forward application form',NULL,NULL),(309,'rti_forwarded_application_data','Save Forward application form','Save Forward application form',NULL,NULL),(310,'rti_frontend_application','RTI Frontend Application','RTI Frontend Application',NULL,NULL),(311,'rti_frontend_application_status','RTI Frontend Application status','RTI Frontend Application status',NULL,NULL),(312,'vp.index','index','index',NULL,NULL),(313,'vp.EE_scrutiny_remark','scrutiny_remark','scrutiny_remark',NULL,NULL),(314,'vp.society_EE_documents','society_EE_documents','society_EE_documents',NULL,NULL),(315,'vp.dyce_Scrutiny_Remark','EE_Scrutiny_Remark','EE_Scrutiny_Remark',NULL,NULL),(316,'vp.forward_application','forward_application','forward_application',NULL,NULL),(317,'vp.forward_application_data','forward_application_data','forward_application_data',NULL,NULL),(318,'vp.cap_notes','cap notes','cap notes',NULL,NULL),(319,'roles.index','List Roles','Listing Roles',NULL,NULL),(320,'roles.create','Create Role','Creating role',NULL,NULL),(321,'roles.show','Create Role','Creating role',NULL,NULL),(322,'roles.store','Store Role','Storing Role',NULL,NULL),(323,'roles.edit','Edit Role','EDiting Role',NULL,NULL),(324,'roles.update','Update Role','updating Role',NULL,NULL),(325,'roles.destroy','Delete Role ','Deleting Role',NULL,NULL),(326,'loadDeleteRoleUsingAjax','Delete Roles Ajax','Deleting Roles using Ajax',NULL,NULL),(327,'architect_application','List architect Application','Listing EE Application',NULL,NULL),(328,'view_architect_application','View Architect','View Architect Application by id',NULL,NULL),(329,'evaluate_architect_application','evaluate_architect_application','evaluate_architect_application',NULL,NULL),(330,'shortlisted_architect_application','shortlisted_architect_application','shortlisted_architect_application',NULL,NULL),(331,'final_architect_application','final_architect_application','final_architect_application',NULL,NULL),(332,'save_evaluate_marks','save_evaluate_marks','save_evaluate_marks',NULL,NULL),(333,'generate_certificate','generate_certificate','generate_certificate',NULL,NULL),(334,'forward_application','forward_application','forward_application',NULL,NULL),(335,'finalCertificateGenerate','finalCertificateGenerate','finalCertificateGenerate',NULL,NULL),(336,'tempCertificateGenerate','tempCertificateGenerate','tempCertificateGenerate',NULL,NULL),(337,'postfinalCertificateGenerate','postfinalCertificateGenerate','postfinalCertificateGenerate',NULL,NULL),(338,'architect.edit_certificate','architect.edit_certificate','architect.edit_certificate',NULL,NULL),(339,'architect.update_certificate','architect.update_certificate','architect.update_certificate',NULL,NULL),(340,'architect.post_final_signed_certificate','architect.post_final_signed_certificate','architect.post_final_signed_certificate',NULL,NULL),(341,'post_forward_application','post_forward_application','post_forward_application',NULL,NULL),(342,'shortlist_architect_application','shortlist_architect_application','shortlist_architect_application',NULL,NULL),(343,'finalise_architect_application','finalise_architect_application','finalise_architect_application',NULL,NULL);
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
  CONSTRAINT `pre_post_schedule_hearing_schedule_id_foreign` FOREIGN KEY (`hearing_schedule_id`) REFERENCES `hearing_schedule` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pre_post_schedule_hearing_id_foreign` FOREIGN KEY (`hearing_id`) REFERENCES `hearing` (`id`) ON DELETE CASCADE
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
INSERT INTO `resolution_types` VALUES (1,'MHADA Resolutions','2018-10-25 01:59:24','2018-10-25 01:59:24',NULL),(2,'M.B.R & Resolutions','2018-10-25 01:59:24','2018-10-25 01:59:24',NULL),(3,'Government Resolutions','2018-10-25 01:59:24','2018-10-25 01:59:24',NULL);
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
INSERT INTO `role_user` VALUES (1,2,'2018-10-25 07:29:29',NULL),(2,3,'2018-10-25 07:29:30',NULL),(3,4,'2018-10-25 07:29:31',NULL),(4,5,'2018-10-25 07:29:32',NULL),(5,6,'2018-10-25 07:29:33',NULL),(6,7,'2018-10-25 07:29:33',NULL),(7,8,'2018-10-25 07:29:34',NULL),(8,9,'2018-10-25 07:29:34',NULL),(9,10,'2018-10-25 07:29:35',NULL),(10,11,'2018-10-25 07:29:35',NULL),(11,12,'2018-10-25 07:29:36',NULL),(12,13,'2018-10-25 07:29:37',NULL),(13,14,'2018-10-25 07:29:37',NULL),(14,15,'2018-10-25 07:29:37',NULL),(15,16,'2018-10-25 07:29:39',NULL),(16,17,'2018-10-25 07:29:39',NULL),(17,18,'2018-10-25 07:29:40',NULL),(18,19,'2018-10-25 07:29:40',NULL),(19,20,'2018-10-25 07:29:41',NULL),(20,21,'2018-10-25 07:29:42',NULL),(21,22,'2018-10-25 07:29:42',NULL),(22,23,'2018-10-25 07:29:43',NULL),(23,24,'2018-10-25 07:29:43',NULL),(24,25,'2018-10-25 07:29:44',NULL),(25,26,'2018-10-25 07:29:45',NULL),(26,27,'2018-10-25 07:29:46',NULL),(27,28,'2018-10-25 07:29:46',NULL),(28,29,'2018-10-25 07:29:46',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'society','/society_offer_letter_dashboard',NULL,NULL,'Society Offer Letter','Login as Society',NULL,NULL,NULL),(2,'ee_engineer','/ee',NULL,'[1,3]','EE Engineer','EE Engineer',NULL,'2018-10-25 01:59:44',NULL),(3,'ee_dy_engineer','/ee',2,'[4]','EE Deputy Engineer','EE Deputy Engineer',NULL,'2018-10-25 01:59:44',NULL),(4,'ee_junior_engineer','/ee',3,NULL,'EE Junior Engineer','EE Junior Engineer',NULL,NULL,NULL),(5,'em_manager','/em',NULL,NULL,'EM Manager','EM Manager',NULL,NULL,NULL),(6,'em_clerk','/em_clerk',5,NULL,'EE Deputy Engineer','EE Deputy Engineer',NULL,NULL,NULL),(7,'rc_collector','/rc',NULL,NULL,'RC Collector','RC Collector',NULL,NULL,NULL),(8,'dyce_engineer','/dyce',NULL,'[2,9]','DYCE_Engineer','Login as DYCE Engineer',NULL,'2018-10-25 01:59:44',NULL),(9,'dyce_deputy_engineer','/dyce',8,'[10]','DYCE_deputy_Engineer','Login as DYCE deputy Engineer',NULL,'2018-10-25 01:59:44',NULL),(10,'dyce_junior_engineer','/dyce',9,NULL,'DYCE_junior_Engineer','Login as DYCE junior Engineer',NULL,NULL,NULL),(11,'LM','/village_detail',NULL,NULL,'land_manager','Login as Land Manger',NULL,NULL,NULL),(12,'Joint CO','/hearing',NULL,NULL,'joint_co','Login as Joint CO',NULL,NULL,NULL),(13,'Joint Co PA','/hearing',12,NULL,'joint_co_pa','Login as Joint CO PA',NULL,NULL,NULL),(14,'Co','/hearing',NULL,NULL,'co','Login as CO',NULL,NULL,NULL),(15,'Co PA','/hearing',14,NULL,'joint_co_pa','Login as Joint CO PA',NULL,NULL,NULL),(16,'ree_engineer','/ree_applications',NULL,'[2,8,17]','Residential Executive Engineer','Login as Residential Executive Engineer',NULL,'2018-10-25 01:59:44',NULL),(17,'REE Assistant Engineer','/ree_applications',16,'[18]','REE Assistant Engineer','Login as REE Assistant Engineer',NULL,'2018-10-25 01:59:44',NULL),(18,'REE deputy Engineer','/ree_applications',17,'[19]','REE Deputy Engineer','Login as REE Deputy Engineer',NULL,'2018-10-25 01:59:44',NULL),(19,'REE Junior Engineer','/ree_applications',18,NULL,'REE Junior Engineer','Login as REE Junior Engineer',NULL,NULL,NULL),(20,'cap_engineer','/cap',NULL,NULL,'CAP_Engineer','Login as CAP Engineer',NULL,NULL,NULL),(21,'co_engineer','/co',NULL,'[2,8,16]','Co_Engineer','Login as CO Engineer',NULL,'2018-10-25 01:59:44',NULL),(22,'RM','/resolution',NULL,NULL,'resolution_manager','Login as Resolution Manger',NULL,NULL,NULL),(23,'RTI','/rti_applicants',NULL,NULL,'rti_manager','Login as RTI Manager',NULL,NULL,NULL),(24,'vp_engineer','/vp',NULL,NULL,'VP_Engineer','Login as VP Engineer',NULL,NULL,NULL),(25,'superadmin','/crudadmin/roles',NULL,NULL,'Super Admin','Super Admin',NULL,NULL,NULL),(26,'architect','/architect_application',NULL,NULL,'Head Architect','Main Architect',NULL,NULL,NULL),(27,'senior_architect','/architect_application',26,NULL,'Senior Architect','Senior Architect',NULL,NULL,NULL),(28,'junior_architect','/architect_application',27,NULL,'Junior Architect','Junior Architect',NULL,NULL,NULL),(29,'selection_commitee','/architect_application',NULL,NULL,'Selection Commitee','Selection Commitee',NULL,NULL,NULL);
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
  CONSTRAINT `rti_forward_application_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_forward_application_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `rti_form` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_forward_application_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE
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
  CONSTRAINT `rti_send_info_rti_status_id_foreign` FOREIGN KEY (`rti_status_id`) REFERENCES `rti_status` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rti_send_info_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `rti_form` (`id`) ON DELETE CASCADE
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
  CONSTRAINT `service_charges_rates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `master_buildings` (`id`),
  CONSTRAINT `service_charges_rates_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `master_societies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_charges_rates`
--

LOCK TABLES `service_charges_rates` WRITE;
/*!40000 ALTER TABLE `service_charges_rates` DISABLE KEYS */;
INSERT INTO `service_charges_rates` VALUES (1,29,23,'2018-19','LIG',10.00,12.00,10.00,10.00,10.00,10.00,10.00,10.00,NULL,'2018-10-25 02:26:47','2018-10-25 02:26:47'),(2,24,40,'2018-19','LIG',10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,NULL,'2018-10-25 02:39:07','2018-10-25 02:39:07'),(3,57,71,'2018-19','LIG',10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,NULL,'2018-10-25 03:11:46','2018-10-25 03:11:46'),(4,57,18,'2018-19','LIG',10.00,10.00,10.00,10.00,10.00,10.00,10.00,10.00,NULL,'2018-10-25 03:12:38','2018-10-25 03:12:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nitin Gadkari','user1@gmail.com','$2y$10$T/hS3CxtOUzYvkfREFSqN.weo9vZA83fXvK7Y9b1yhhWLmfZYNF42',2,'Test',NULL,NULL,NULL,'G5eidO84fGutoo012QEfQn1zctUPDxDHTWnq6PdoumWhZWpUXjqLzlbtYFqg',NULL,NULL,'7412589635','Mumbai'),(2,'Amit Kadam','user2@gmail.com','$2y$10$PoFnUjjlzTrzN/nBOewi6e/m6NPBsd/.hhZW6xK17w2FCnAw/oewq',3,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(3,'Suryakant Teli','user3@gmail.com','$2y$10$ZQZQmA5IIaBfFzCraTAPReHEPnObN6z.w84LI637Vn.4PY8pg1wMe',4,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(4,'EM Manager','em@gmail.com','$2y$10$jjXnq6pGT7YXrGeZqXVAe.pypO5CH2GmOBxUXrpFIHcDAv.Goz8fK',5,'Test',NULL,NULL,NULL,'BDLvQpjasgpRchjwE6A2685svn5ArGH3KVkD3beXHXECFpGwgVz8YyfZzDTq',NULL,NULL,'7412589635','Mumbai'),(5,'Amit Kadam','em_clerk@gmail.com','$2y$10$dbrEWE8PDMdOXXFH4bnlVOXz9RhCK5v5vCojefpR62JryeIGlKg6q',6,'Test',NULL,NULL,NULL,'ckwXBAVkKS9pGuVePHn47fqrfSGFp8M5iDCjix8VSTjF1C2cZEWubyBj19is',NULL,NULL,'7412589635','Mumbai'),(6,'Amit Kadam','rc@gmail.com','$2y$10$Nlbq9LKKtZ53DQlsGgr1oOo3ouJV.a2DbVGBS9NEOeJnmJi.mFU.i',7,'Test',NULL,NULL,NULL,'jqqXzvdx3UvYUdKYpyEWgtLWwVxy7xFFjcL2qwoV7cFBKDHzggff7OgP5jee',NULL,NULL,'7412589635','Mumbai'),(7,'Bhavana.Salunkhe','bhavnasalunkhe@neosofttech.com','$2y$10$i.vWfk3k3nm0d1I2N8Vt7OJZo2Dn62DCasrOubcSAavQQj/UbBZAW',8,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(8,'dyce_deputy','dyce1@gmail.com','$2y$10$PIZtUKR/IfeOPMRmM0V6VeHWR4fAYW8yw3LxONTpcN7YCvSGwSUAW',9,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(9,'dyce_JR','dyce2@gmail.com','$2y$10$8M4BtTRLOkwqp9K7LV75FuJb5iUB1XarUB9t9pcys4rrLmgT07zRG',10,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(10,'martin.philipose','martin.philipose@wwindia.com','$2y$10$9DLeM2NH.60iwarwH1uvm.91qehDBRcOov81nHCW3QXGclVQyZjri',11,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(11,'Joint CO','jointco@gmail.com','$2y$10$1g3ukoYeiIJ4qi/Kv8MQROrYPmPtN1f3Y9k0vjLIXbHE5Zke/rZTa',12,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(12,'Joint CO PA','jointcopa@gmail.com','$2y$10$y4M7JlWScAEHlRl8x0Afl.1Udtgxm2dEGNM8jOaVOxEOeINjUayRa',13,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(13,'CO','hearingco@gmail.com','$2y$10$eoMS/DUcwpCgvupqTw8ALOFVDNn6ZWAFMBuHd0wQy0JwdE8r7y6ri',14,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(14,'CO PA','copa@gmail.com','$2y$10$3So4ZUYabOGhjZX46rWJQe31YCnTM7DZlRVaX2crTi8BC2A792KQC',15,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(15,'Neelam','neelam1.tambe@wwindia.com','$2y$10$I5R4o0xqDlm2u.SuZccNw.RR2al0oPGXAvUoJSajwLEla1y6yt.pq',16,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(16,'REE1','ree1@gmail.com','$2y$10$/aFCE697dB0LZrcvcbhrc.WEhZfsyWySB.pXFTDIiWZtiwHvpwpDi',17,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(17,'REE2','ree2@gmail.com','$2y$10$uQvpGtVAM0D8KTP0bDKPGewT64PSiGHckGoDZS5.iT31v2e.wi0hC',18,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(18,'REE3','ree3@gmail.com','$2y$10$7iq8JTZQHRZnW4MnALdsA.Z4CIZnTeR3zIN0l9TzQR.1Iy17JcPE2',19,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9969054274','Mumbai'),(19,'cap user','cap@gmail.com','$2y$10$VSh5v6Uf6F88l7ZbXM0adu/GZhaGvnBo2zXhbGTmVMGH0SmpeRk8G',20,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(20,'CO','co@gmail.com','$2y$10$IxdRjfYAFzALmCGkgbSI6ORtRdUQZXxgbVD9oI1wDOJKznCrVnNmO',21,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(21,'Resolution Manager','resolution@gmail.com','$2y$10$fiodLKaRyajPRwj0nWWFJeilsq/Qh6hHBQ8k6ZTsYtTFWxqWXq/3u',22,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(22,'RTI Manager','rti@gmail.com','$2y$10$/SG93BHE3iDohvipteTN2OvApd0YbQzdFVvt6/bM9hFI4n4SsYNsS',23,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(23,'VP user','vp@gmail.com','$2y$10$8Y6OUoNNJe4tvO7AqnrUk.wRPsR9DCwZkfxaN3BBRGTbZeZvN.xfe',24,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9765238678','Mumbai'),(24,'Super Admin','superadmin@gmail.com','$2y$10$uNRceKc5Ub6sho/X/Plgae7nbK9FalTGFjuZqiMHUfkQ0lA5/v2sS',25,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'7412589635','Mumbai'),(25,'Sudesh Jadhav','sudesh@gmail.com','$2y$10$vAt13afGDa8bMx8AzBjr5O0tqMN5NbbqH.oaICCQC1jd6Q8uN1eH2',26,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'8585868585','Mumbai'),(26,'Senior Architect','senior_architect@gmail.com','$2y$10$PlL2ee/neZT3YCQvK47mOeU9cc55kkg8YX6.qsW9T2aStsEZQx5My',27,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'8787878785','Mumbai'),(27,'Junior Architect','junior_architect@gmail.com','$2y$10$/sOkt/VRKyyn9ZNuxyQhZ.oy1DlpkY7rqstPE5S0LErv.MxJ.3YNm',28,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'9696565856','Mumbai'),(28,'Amar Prajapati','amar.prajapati@gmail.com','$2y$10$cDYjC.Svi114iEi7u.Cgd.RV.uKt7tiXnI4f5CKrnIE4KbWR.A3uS',29,'Test',NULL,NULL,NULL,NULL,NULL,NULL,'8585652545','Mumbai');
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

-- Dump completed on 2018-10-25 15:14:11
