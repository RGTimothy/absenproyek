-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: absenproyek_db
-- ------------------------------------------------------
-- Server version	5.7.29

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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('Company Admin','4',1611660189),('Super Admin','2',1611995674);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1606032303,1606032303),('/admin/*',2,NULL,NULL,NULL,1606032309,1606032309),('/admin/assignment/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/assignment/assign',2,NULL,NULL,NULL,1611657624,1611657624),('/admin/assignment/index',2,NULL,NULL,NULL,1611657624,1611657624),('/admin/assignment/revoke',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/assignment/view',2,NULL,NULL,NULL,1611657624,1611657624),('/admin/default/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/default/index',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/menu/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/menu/create',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/menu/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/menu/index',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/menu/update',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/menu/view',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/assign',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/create',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/index',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/remove',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/update',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/permission/view',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/assign',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/create',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/index',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/remove',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/update',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/role/view',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/route/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/route/assign',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/route/create',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/route/index',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/route/refresh',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/route/remove',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/rule/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/rule/create',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/rule/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/rule/index',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/rule/update',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/rule/view',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/*',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/activate',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/change-password',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/index',2,NULL,NULL,NULL,1606031522,1606031522),('/admin/user/login',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/logout',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/reset-password',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/signup',2,NULL,NULL,NULL,1611657625,1611657625),('/admin/user/view',2,NULL,NULL,NULL,1611657625,1611657625),('/company-clock/*',2,NULL,NULL,NULL,1611644040,1611644040),('/company-clock/create',2,NULL,NULL,NULL,1611657625,1611657625),('/company-clock/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/company-clock/index',2,NULL,NULL,NULL,1611657625,1611657625),('/company-clock/pdf',2,NULL,NULL,NULL,1611990574,1611990574),('/company-clock/update',2,NULL,NULL,NULL,1611657625,1611657625),('/company-clock/view',2,NULL,NULL,NULL,1611657625,1611657625),('/company-information/*',2,NULL,NULL,NULL,1611657625,1611657625),('/company-information/create',2,NULL,NULL,NULL,1611657625,1611657625),('/company-information/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/company-information/index',2,NULL,NULL,NULL,1611657625,1611657625),('/company-information/pdf',2,NULL,NULL,NULL,1612083477,1612083477),('/company-information/update',2,NULL,NULL,NULL,1611657625,1611657625),('/company-information/view',2,NULL,NULL,NULL,1611657625,1611657625),('/company-limitation/*',2,NULL,NULL,NULL,1612503890,1612503890),('/company-limitation/create',2,NULL,NULL,NULL,1612503890,1612503890),('/company-limitation/delete',2,NULL,NULL,NULL,1612503890,1612503890),('/company-limitation/index',2,NULL,NULL,NULL,1612503890,1612503890),('/company-limitation/pdf',2,NULL,NULL,NULL,1612503890,1612503890),('/company-limitation/update',2,NULL,NULL,NULL,1612503890,1612503890),('/company-limitation/view',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/*',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/create',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/delete',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/index',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/pdf',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/update',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance-summary/view',2,NULL,NULL,NULL,1612503890,1612503890),('/company-project-attendance/*',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project-attendance/create',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project-attendance/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project-attendance/index',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project-attendance/pdf',2,NULL,NULL,NULL,1612083477,1612083477),('/company-project-attendance/update',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project-attendance/view',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project/*',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project/add-company-project-attendance',2,NULL,NULL,NULL,1612083477,1612083477),('/company-project/create',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project/index',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project/pdf',2,NULL,NULL,NULL,1612083477,1612083477),('/company-project/update',2,NULL,NULL,NULL,1611657625,1611657625),('/company-project/view',2,NULL,NULL,NULL,1611657625,1611657625),('/company-role/*',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/add-user',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/create',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/delete',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/index',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/pdf',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/update',2,NULL,NULL,NULL,1612083477,1612083477),('/company-role/view',2,NULL,NULL,NULL,1612083477,1612083477),('/company/*',2,NULL,NULL,NULL,1611640960,1611640960),('/company/add-company-clock',2,NULL,NULL,NULL,1612503890,1612503890),('/company/add-company-information',2,NULL,NULL,NULL,1612503890,1612503890),('/company/add-company-limitation',2,NULL,NULL,NULL,1612503890,1612503890),('/company/add-company-project',2,NULL,NULL,NULL,1612503890,1612503890),('/company/add-company-role',2,NULL,NULL,NULL,1612503890,1612503890),('/company/add-user',2,NULL,NULL,NULL,1612503890,1612503890),('/company/create',2,NULL,NULL,NULL,1611657625,1611657625),('/company/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/company/index',2,NULL,NULL,NULL,1611657625,1611657625),('/company/pdf',2,NULL,NULL,NULL,1612503890,1612503890),('/company/update',2,NULL,NULL,NULL,1611657625,1611657625),('/company/view',2,NULL,NULL,NULL,1611657625,1611657625),('/datecontrol/*',2,NULL,NULL,NULL,1611990574,1611990574),('/datecontrol/parse/*',2,NULL,NULL,NULL,1611990574,1611990574),('/datecontrol/parse/convert',2,NULL,NULL,NULL,1611990574,1611990574),('/debug/*',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/default/*',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/default/db-explain',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/default/download-mail',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/default/index',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/default/toolbar',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/default/view',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/user/*',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/user/reset-identity',2,NULL,NULL,NULL,1611657625,1611657625),('/debug/user/set-identity',2,NULL,NULL,NULL,1611657625,1611657625),('/gii/*',2,NULL,NULL,NULL,1606030776,1606030776),('/gii/default/*',2,NULL,NULL,NULL,1611657625,1611657625),('/gii/default/action',2,NULL,NULL,NULL,1611657625,1611657625),('/gii/default/diff',2,NULL,NULL,NULL,1611657625,1611657625),('/gii/default/index',2,NULL,NULL,NULL,1611657625,1611657625),('/gii/default/preview',2,NULL,NULL,NULL,1611657625,1611657625),('/gii/default/view',2,NULL,NULL,NULL,1611657625,1611657625),('/gridview/*',2,NULL,NULL,NULL,1611990574,1611990574),('/gridview/export/*',2,NULL,NULL,NULL,1611990574,1611990574),('/gridview/export/download',2,NULL,NULL,NULL,1611990574,1611990574),('/site/*',2,NULL,NULL,NULL,1606033178,1606033178),('/site/error',2,NULL,NULL,NULL,1606036847,1606036847),('/site/index',2,NULL,NULL,NULL,1606036853,1606036853),('/site/login',2,NULL,NULL,NULL,1606036853,1606036853),('/site/logout',2,NULL,NULL,NULL,1606036853,1606036853),('/treemanager/*',2,NULL,NULL,NULL,1611990574,1611990574),('/treemanager/node/*',2,NULL,NULL,NULL,1611990574,1611990574),('/treemanager/node/manage',2,NULL,NULL,NULL,1611990574,1611990574),('/treemanager/node/move',2,NULL,NULL,NULL,1611990574,1611990574),('/treemanager/node/remove',2,NULL,NULL,NULL,1611990574,1611990574),('/treemanager/node/save',2,NULL,NULL,NULL,1611990574,1611990574),('/user/*',2,NULL,NULL,NULL,1611657625,1611657625),('/user/add-company-project-attendance',2,NULL,NULL,NULL,1612083477,1612083477),('/user/create',2,NULL,NULL,NULL,1611657625,1611657625),('/user/delete',2,NULL,NULL,NULL,1611657625,1611657625),('/user/index',2,NULL,NULL,NULL,1611657625,1611657625),('/user/pdf',2,NULL,NULL,NULL,1612083477,1612083477),('/user/update',2,NULL,NULL,NULL,1611657625,1611657625),('/user/view',2,NULL,NULL,NULL,1611657625,1611657625),('Company Admin',1,NULL,NULL,NULL,1611658932,1611658932),('Company Clock Create',2,NULL,NULL,NULL,1611990832,1611990832),('Company Clock Detail',2,NULL,NULL,NULL,1611998224,1611998224),('Company Clock Index',2,NULL,NULL,NULL,1611996803,1611996803),('Company Detail',2,NULL,NULL,NULL,1614179968,1614179968),('Company Information Create',2,NULL,NULL,NULL,1611658167,1611658167),('Company Information Delete',2,NULL,NULL,NULL,1611658245,1611658245),('Company Information Detail',2,NULL,NULL,NULL,1611658279,1611658279),('Company Information Index',2,NULL,NULL,NULL,1611658192,1611658192),('Company Information Update',2,NULL,NULL,NULL,1611658218,1611658218),('Company Project Attendance Detail',2,NULL,NULL,NULL,1611658407,1611658407),('Company Project Attendance Index',2,NULL,NULL,NULL,1611658375,1611658375),('Company Project Attendance Summary Index',2,NULL,NULL,NULL,1612503951,1612503951),('Company Project Create',2,NULL,NULL,NULL,1611658126,1611658126),('Company Project Delete',2,NULL,NULL,NULL,1611658099,1611658099),('Company Project Detail',2,NULL,NULL,NULL,1611658037,1611658037),('Company Project Index',2,NULL,NULL,NULL,1611658010,1611658010),('Company Project Update',2,NULL,NULL,NULL,1611658070,1611658070),('Company Role Create',2,NULL,NULL,NULL,1612083541,1612083541),('Company Role Delete',2,NULL,NULL,NULL,1612085604,1612085604),('Company Role Detail',2,NULL,NULL,NULL,1612084143,1612084143),('Company Role Index',2,NULL,NULL,NULL,1612083590,1612083590),('Company Role Update',2,NULL,NULL,NULL,1612085582,1612085582),('Company Update',2,NULL,NULL,NULL,1614178163,1614178163),('Guest',1,NULL,NULL,NULL,1606035015,1606035015),('Standard View',2,NULL,NULL,NULL,1606032660,1606032660),('Super Admin',1,NULL,NULL,NULL,1606029110,1606029110),('User Delete',2,NULL,NULL,NULL,1611657969,1611657969),('User Detail',2,NULL,NULL,NULL,1611657904,1611657904),('User Index',2,NULL,NULL,NULL,1606031568,1611657876),('User Update',2,NULL,NULL,NULL,1611657933,1611657933);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('Company Clock Create','/company-clock/create'),('Company Clock Index','/company-clock/index'),('Company Clock Detail','/company-clock/view'),('Company Information Create','/company-information/create'),('Company Information Delete','/company-information/delete'),('Company Information Index','/company-information/index'),('Company Information Update','/company-information/update'),('Company Information Detail','/company-information/view'),('Company Project Attendance Summary Index','/company-project-attendance-summary/index'),('Company Project Attendance Index','/company-project-attendance/index'),('Company Project Attendance Detail','/company-project-attendance/view'),('Company Project Create','/company-project/create'),('Company Project Delete','/company-project/delete'),('Company Project Index','/company-project/index'),('Company Project Update','/company-project/update'),('Company Project Detail','/company-project/view'),('Company Role Create','/company-role/create'),('Company Role Delete','/company-role/delete'),('Company Role Index','/company-role/index'),('Company Role Update','/company-role/update'),('Company Role Detail','/company-role/view'),('Company Update','/company/update'),('Company Detail','/company/view'),('Company Admin','/datecontrol/*'),('Company Admin','/datecontrol/parse/*'),('Company Admin','/datecontrol/parse/convert'),('Company Admin','/gridview/*'),('Company Admin','/gridview/export/*'),('Company Admin','/gridview/export/download'),('Standard View','/site/*'),('Standard View','/site/error'),('Standard View','/site/index'),('Standard View','/site/login'),('Standard View','/site/logout'),('Company Admin','/treemanager/*'),('Company Admin','/treemanager/node/*'),('Company Admin','/treemanager/node/manage'),('Company Admin','/treemanager/node/move'),('Company Admin','/treemanager/node/remove'),('Company Admin','/treemanager/node/save'),('User Delete','/user/delete'),('User Index','/user/index'),('User Update','/user/update'),('User Detail','/user/view'),('Super Admin','Company Admin'),('Company Admin','Company Clock Create'),('Company Admin','Company Clock Detail'),('Company Admin','Company Clock Index'),('Company Admin','Company Detail'),('Company Admin','Company Information Create'),('Company Admin','Company Information Delete'),('Company Admin','Company Information Detail'),('Company Admin','Company Information Index'),('Company Admin','Company Information Update'),('Company Admin','Company Project Attendance Detail'),('Company Admin','Company Project Attendance Index'),('Company Admin','Company Project Attendance Summary Index'),('Company Admin','Company Project Create'),('Company Admin','Company Project Delete'),('Company Admin','Company Project Detail'),('Company Admin','Company Project Index'),('Company Admin','Company Project Update'),('Company Admin','Company Role Create'),('Company Admin','Company Role Delete'),('Company Admin','Company Role Detail'),('Company Admin','Company Role Index'),('Company Admin','Company Role Update'),('Company Admin','Company Update'),('Super Admin','Guest'),('Company Admin','Standard View'),('Guest','Standard View'),('Company Admin','User Detail'),('Company Admin','User Index');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `image_filename` varchar(255) DEFAULT NULL,
  `description` text,
  `hour_rounding` int(11) DEFAULT '60',
  `status` varchar(20) DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_clock`
--

DROP TABLE IF EXISTS `company_clock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_clock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `clock_in` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `break_hour` int(11) DEFAULT '0',
  `allowance` int(11) DEFAULT '0',
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_company` (`company_id`),
  CONSTRAINT `fk-company_clock-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_clock`
--

LOCK TABLES `company_clock` WRITE;
/*!40000 ALTER TABLE `company_clock` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_clock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_information`
--

DROP TABLE IF EXISTS `company_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_company` (`company_id`),
  CONSTRAINT `fk-company_information-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_information`
--

LOCK TABLES `company_information` WRITE;
/*!40000 ALTER TABLE `company_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_limitation`
--

DROP TABLE IF EXISTS `company_limitation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_limitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `max_user` int(11) DEFAULT '1',
  `max_project` int(11) DEFAULT '1',
  `max_unrestricted_project` int(11) DEFAULT '0',
  `max_grade` int(11) DEFAULT '1',
  `max_subscription_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk-company_limitation-company_id` (`company_id`),
  CONSTRAINT `fk-company_limitation-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_limitation`
--

LOCK TABLES `company_limitation` WRITE;
/*!40000 ALTER TABLE `company_limitation` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_limitation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_project`
--

DROP TABLE IF EXISTS `company_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  `clock_in` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_company` (`company_id`),
  CONSTRAINT `fk-company_project-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_project`
--

LOCK TABLES `company_project` WRITE;
/*!40000 ALTER TABLE `company_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_project_attendance`
--

DROP TABLE IF EXISTS `company_project_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_project_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_project_id` int(11) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remark` text,
  `image` blob,
  `image_filename` varchar(100) DEFAULT NULL,
  `image_filetype` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_company_project` (`company_project_id`),
  KEY `idx_user` (`user_id`),
  CONSTRAINT `fk-company_project_attendance-company_project_id` FOREIGN KEY (`company_project_id`) REFERENCES `company_project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-company_project_attendance-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_project_attendance`
--

LOCK TABLES `company_project_attendance` WRITE;
/*!40000 ALTER TABLE `company_project_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_project_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_project_attendance_summary`
--

DROP TABLE IF EXISTS `company_project_attendance_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_project_attendance_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_role_id` int(11) DEFAULT NULL,
  `company_project_id` int(11) DEFAULT NULL,
  `projects` text,
  `work_duration` int(11) DEFAULT '0',
  `overtime_duration_1` int(11) DEFAULT '0',
  `overtime_duration_2` int(11) DEFAULT '0',
  `overtime_duration_3` int(11) DEFAULT '0',
  `total_allowance` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk-company_project_attendance_summary-user_id` (`user_id`),
  KEY `fk-company_project_attendance_summary-company_role_id` (`company_role_id`),
  CONSTRAINT `fk-company_project_attendance_summary-company_role_id` FOREIGN KEY (`company_role_id`) REFERENCES `company_role` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk-company_project_attendance_summary-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_project_attendance_summary`
--

LOCK TABLES `company_project_attendance_summary` WRITE;
/*!40000 ALTER TABLE `company_project_attendance_summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_project_attendance_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_role`
--

DROP TABLE IF EXISTS `company_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk-company_role-company_id` (`company_id`),
  CONSTRAINT `fk-company_role-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_role`
--

LOCK TABLES `company_role` WRITE;
/*!40000 ALTER TABLE `company_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (2,'Karyawan',13,'/user/index',6,NULL),(4,'Proyek',13,'/company-project/index',2,NULL),(5,'Informasi',13,'/company-information/index',3,NULL),(6,'Riwayat Absensi',13,'/company-project-attendance/index',4,NULL),(13,'Menu Admin',NULL,NULL,1,NULL),(16,'Jam Kerja',13,'/company-clock/index',5,NULL),(17,'Grade Karyawan',13,'/company-role/index',7,NULL),(18,'Absensi',13,'/company-project-attendance-summary/index',8,NULL),(19,'Konfigurasi',13,'/company/update',9,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1605523236),('m130524_201442_init',1605523239),('m140506_102106_rbac_init',1605523368),('m140602_111327_create_menu_table',1605523247),('m160312_050000_create_user',1605523247),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1605523368),('m180523_151638_rbac_updates_indexes_without_prefix',1605523368),('m190124_110200_add_verification_token_column_to_user_table',1605523239),('m200409_110543_rbac_update_mssql_trigger',1605523368),('m210106_104816_add_phone_column_to_user_table',1609942518),('m210106_120555_alter_columns_in_user_table',1609942734),('m210111_084202_create_company_table',1610355957),('m210111_085044_add_company_id_column_to_user_table',1610355957),('m210111_091640_create_company_information_table',1610363678),('m210116_114353_create_company_project_attendance_table',1610866968),('m210117_062926_create_company_project_table',1610866968),('m210117_064447_add_index_to_company_information_table',1610866968),('m210117_065010_create_company_project_user_table',1610866968),('m210117_075103_add_clock_columns_to_company_project_table',1610870313),('m210117_081025_add_coordinates_to_company_project_attendance_table',1610871471),('m210121_104500_add_coordinates_to_company_project_table',1611226012),('m210122_084950_add_radius_column_to_company_project_table',1611305471),('m210122_085814_add_image_column_to_company_project_attendance_table',1611308558),('m210125_091621_add_code_column_to_company_table',1611566329),('m210126_053712_create_company_clock_table',1611640530),('m210126_065734_add_foreign_key_to_company_information_table',1611644398),('m210126_070545_add_foreign_key_to_company_project_table',1611644826),('m210126_094614_drop_company_project_user_table',1611654424),('m210126_094949_add_foreign_key_to_company_project_attendance_table',1611654773),('m210126_114013_add_company_role_to_user_table',1611661351),('m210130_063653_add_blameable_columns_to_company_clock_table',1611999327),('m210130_100837_add_blameable_columns_to_company_project_table',1612001434),('m210130_103323_add_allowance_to_company_clock_table',1612002975),('m210130_110106_add_blameable_columns_to_user_table',1612004694),('m210130_112737_add_foreign_key_to_user_table',1612006417),('m210131_044709_create_company_role_table',1612069626),('m210131_045628_add_company_role_id_column_to_user_table',1612069626),('m210131_050119_delete_company_role_column_from_user_table',1612069626),('m210131_060024_add_remark_column_to_company_project_attendance_table',1612073346),('m210131_063029_add_blameable_columns_to_company_information_table',1612074695),('m210131_091717_add_company_id_column_to_company_role_table',1612084796),('m210131_120139_add_is_default_column_to_company_role_table',1612094717),('m210202_051900_add_hour_rounding_column_to_company_table',1612243481),('m210202_053258_add_break_hour_column_to_company_clock_table',1612244090),('m210202_054104_create_company_limitation_table',1612245217),('m210202_055504_create_company_project_attendance_summary_table',1612263328),('m210202_112524_add_blameable_columns_to_company_table',1612265196),('m210202_112944_add_is_default_column_to_company_clock_table',1612265512),('m210225_032406_add_company_project_id_to_company_project_attendance_summary_table',1614223604);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `company_role_id` int(11) DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT '0',
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `phone` (`phone`),
  KEY `idx_company` (`company_id`),
  KEY `fk-user-company_role_id` (`company_role_id`),
  CONSTRAINT `fk-user-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk-user-company_role_id` FOREIGN KEY (`company_role_id`) REFERENCES `company_role` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'rgtimothy',NULL,NULL,'ZwIbby6TMCNdNovebG3jsAeRVnT-a8qu','$2y$13$PKB87tK/tbcUJTk2pNPQau.Z8Voj6yfowMkQhw2xxNT3jglsZB.GO',NULL,'rg.timothy@gmail.com',NULL,10,'2021-01-06 14:18:54',0,'2021-01-06 14:18:54',0,NULL,0,NULL),(2,'superadmin',NULL,NULL,'xL5hsVuVGMdXuvZbMf2syzigcKSkNCU0','$2y$13$ydmJk5KIQ8CP5QN9MHm.Xu76/UVh.VFLZuE3CHEF1BGFfLpmsaRzS',NULL,'test1@gmail.com',NULL,10,'2021-01-06 14:18:54',0,'2021-01-06 14:18:54',0,NULL,0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'absenproyek_db'
--

--
-- Dumping routines for database 'absenproyek_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-25 22:06:44
