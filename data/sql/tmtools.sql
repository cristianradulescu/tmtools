-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.16 - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tmtools
CREATE DATABASE IF NOT EXISTS `tmtools` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tmtools`;


-- Dumping structure for table tmtools.company
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cost_center` varchar(45) NOT NULL,
  `division_manager_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_cost_center_UNIQUE` (`cost_center`),
  UNIQUE KEY `company_name_UNIQUE` (`name`),
  KEY `fk_company_employee_id` (`division_manager_id`),
  CONSTRAINT `fk_company_employee_id` FOREIGN KEY (`division_manager_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.company: ~1 rows (approximately)
DELETE FROM `company`;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` (`id`, `name`, `cost_center`, `division_manager_id`, `created_at`, `updated_at`) VALUES
  (1, 'SC EMAG IT RESEARCH SRL', '11RO270200', 1, '2017-02-10 17:04:30', '2017-02-10 17:04:30');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;


-- Dumping structure for table tmtools.document
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_document_employee_id` (`employee_id`),
  KEY `fk_document_status_id` (`status_id`),
  KEY `fk_document_type_id` (`type_id`),
  CONSTRAINT `fk_document_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_document_status_id` FOREIGN KEY (`status_id`) REFERENCES `document_status` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_document_type_id` FOREIGN KEY (`type_id`) REFERENCES `document_type` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tmtools.document: ~0 rows (approximately)
DELETE FROM `document`;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
/*!40000 ALTER TABLE `document` ENABLE KEYS */;


-- Dumping structure for table tmtools.document_status
CREATE TABLE IF NOT EXISTS `document_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_status_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.document_status: ~3 rows (approximately)
DELETE FROM `document_status`;
/*!40000 ALTER TABLE `document_status` DISABLE KEYS */;
INSERT INTO `document_status` (`id`, `name`) VALUES
  (3, 'Completed'),
  (1, 'New'),
  (2, 'Pending');
/*!40000 ALTER TABLE `document_status` ENABLE KEYS */;


-- Dumping structure for table tmtools.document_type
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_type_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table tmtools.document_type: ~3 rows (approximately)
DELETE FROM `document_type`;
/*!40000 ALTER TABLE `document_type` DISABLE KEYS */;
INSERT INTO `document_type` (`id`, `name`) VALUES
  (1, 'Travel'),
  (2, 'Reimbursement'),
  (3, 'Service quisition');
/*!40000 ALTER TABLE `document_type` ENABLE KEYS */;


-- Dumping structure for table tmtools.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `personal_numeric_code` bigint(20) unsigned NOT NULL,
  `identity_card_number` varchar(9) NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `division_manager_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_numeric_code_UNIQUE` (`personal_numeric_code`),
  UNIQUE KEY `identity_card_number_UNIQUE` (`identity_card_number`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_employee_job_title_id` (`job_title_id`),
  KEY `fk_employee_division_manager_id` (`division_manager_id`),
  KEY `fk_employee_company_id` (`company_id`),
  CONSTRAINT `fk_employee_company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_division_manager_id` FOREIGN KEY (`division_manager_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `employee_job_title` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.employee: ~31 rows (approximately)
DELETE FROM `employee`;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`id`, `first_name`, `last_name`, `username`, `birthday`, `personal_numeric_code`, `identity_card_number`, `job_title_id`, `division_manager_id`, `company_id`, `created_at`, `update_at`) VALUES
  (1, 'Cristian', 'Radulescu', 'cristian.radulescu', '2011-07-06', 1234567890098, 'AB 123456', 1, 1, 1, '2017-02-10 17:21:52', '2017-02-10 17:21:52'),
  (2, 'Bob', 'Test', 'bob.test', '1987-10-09', 1098765432212, 'CD 987654', 2, 1, 1, '2017-02-10 17:21:52', '2017-02-10 17:21:52'),
  (3, 'Alice', 'Test', 'alice.test', '2011-01-01', 21231234112233, 'EF 123456', 2, 1, 1, '2017-02-10 17:21:52', '2017-02-10 17:21:52');
  /*!40000 ALTER TABLE `employee` ENABLE KEYS */;


-- Dumping structure for table tmtools.employee_job_title
CREATE TABLE IF NOT EXISTS `employee_job_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_jon_title_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.employee_job_title: ~2 rows (approximately)
DELETE FROM `employee_job_title`;
/*!40000 ALTER TABLE `employee_job_title` DISABLE KEYS */;
INSERT INTO `employee_job_title` (`id`, `name`) VALUES
  (1, 'Team Manager'),
  (2, 'PHP Developer');
/*!40000 ALTER TABLE `employee_job_title` ENABLE KEYS */;


-- Dumping structure for table tmtools.fos_user
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- Dumping structure for table tmtools.reimbursement
CREATE TABLE IF NOT EXISTS `reimbursement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `number` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_reimbursement_type_id` (`type_id`),
  KEY `fk_reimbursement_employee_id` (`employee_id`),
  KEY `fk_reimbursement_document_id` (`document_id`),
  CONSTRAINT `fk_reimbursement_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_reimbursement_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_reimbursement_type_id` FOREIGN KEY (`type_id`) REFERENCES `reimbursement_type` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table tmtools.reimbursement_type
CREATE TABLE IF NOT EXISTS `reimbursement_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reimbursement_type_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.reimbursement_type: ~5 rows (approximately)
DELETE FROM `reimbursement_type`;
/*!40000 ALTER TABLE `reimbursement_type` DISABLE KEYS */;
INSERT INTO `reimbursement_type` (`id`, `name`) VALUES
  (1, 'Bill'),
  (2, 'Fuel receipt'),
  (3, 'Taxi receipt'),
  (4, 'Train ticket'),
  (5, 'Travel allowance');
/*!40000 ALTER TABLE `reimbursement_type` ENABLE KEYS */;


-- Dumping structure for table tmtools.travel
CREATE TABLE IF NOT EXISTS `travel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `purpose_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `departure_leave_time` datetime NOT NULL,
  `departure_arrival_time` datetime NOT NULL,
  `destination_arrival_time` datetime NOT NULL,
  `destination_leave_time` datetime NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_travel_document_id` (`document_id`),
  KEY `fk_travel_employee_id` (`employee_id`),
  KEY `fk_travel_purpose_id` (`purpose_id`),
  KEY `fk_travel_destination_id` (`destination_id`),
  CONSTRAINT `fk_travel_destination_id` FOREIGN KEY (`destination_id`) REFERENCES `travel_destination` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_purpose_id` FOREIGN KEY (`purpose_id`) REFERENCES `travel_purpose` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table tmtools.travel_destination
CREATE TABLE IF NOT EXISTS `travel_destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `travel_destination_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.travel_destination: ~1 rows (approximately)
DELETE FROM `travel_destination`;
/*!40000 ALTER TABLE `travel_destination` DISABLE KEYS */;
INSERT INTO `travel_destination` (`id`, `name`) VALUES
  (1, 'Bucharest');
/*!40000 ALTER TABLE `travel_destination` ENABLE KEYS */;


-- Dumping structure for table tmtools.travel_purpose
CREATE TABLE IF NOT EXISTS `travel_purpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `travel_purpose_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table tmtools.travel_purpose: ~5 rows (approximately)
DELETE FROM `travel_purpose`;
/*!40000 ALTER TABLE `travel_purpose` DISABLE KEYS */;
INSERT INTO `travel_purpose` (`id`, `name`) VALUES
  (3, 'Company event'),
  (5, 'Course'),
  (1, 'Meeting'),
  (2, 'Planning'),
  (4, 'Presentation');
/*!40000 ALTER TABLE `travel_purpose` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
