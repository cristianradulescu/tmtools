START TRANSACTION;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cost_center` varchar(45) NOT NULL,
  `division_manager_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cost_center_UNIQUE` (`cost_center`),
  KEY `fk_company_employee_idx` (`division_manager_id`),
  CONSTRAINT `fk_company_employee` FOREIGN KEY (`division_manager_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DELETE FROM `company`;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` (`id`, `name`, `cost_center`, `division_manager_id`) VALUES
  (1, 'EMAG', '12RO123456', 1);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `personal_numeric_code` bigint(20) unsigned DEFAULT NULL,
  `identity_card_number` varchar(45) DEFAULT NULL,
  `job_title_id` int(11) DEFAULT NULL,
  `direct_manager_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`),
  UNIQUE KEY `personal_numeric_code_UNIQUE` (`personal_numeric_code`),
  UNIQUE KEY `identity_card_number_UNIQUE` (`identity_card_number`),
  KEY `fk_employee_job_title_idx` (`job_title_id`),
  KEY `fk_employee_employee_idx` (`direct_manager_id`),
  KEY `fk_employee_team_idx` (`team_id`),
  KEY `fk_employee_company_idx` (`company_id`),
  CONSTRAINT `fk_employee_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_employee` FOREIGN KEY (`direct_manager_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_job_title` FOREIGN KEY (`job_title_id`) REFERENCES `employee_job_title` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_team` FOREIGN KEY (`team_id`) REFERENCES `employee_team` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8;

DELETE FROM `employee`;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`id`, `first_name`, `last_name`, `username`, `email_address`, `birthday`, `personal_numeric_code`, `identity_card_number`, `job_title_id`, `direct_manager_id`, `team_id`, `company_id`) VALUES
  (1, 'Cristian', 'Radulescu', 'cristian.radulescu', 'cristian.radulescu', '1980-07-06', 18034567890123, 'AB 123456', 1, 1, 1, 1),
  (2, 'John', 'Doe', 'john.doe', 'john.doe', '1981-10-09', 18134567890012, 'CD 789012', 2, 1, 1, 1),
  (3, 'Foo', 'Bar', 'foo.bar', 'foo.bar', '1982-01-01', 18234567890456, 'EF 345678', 2, 1, 1, 1);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


DROP TABLE IF EXISTS `employee_job_title`;
CREATE TABLE IF NOT EXISTS `employee_job_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DELETE FROM `employee_job_title`;
/*!40000 ALTER TABLE `employee_job_title` DISABLE KEYS */;
INSERT INTO `employee_job_title` (`id`, `name`) VALUES
  (1, 'Manager'),
  (2, 'Programator');
/*!40000 ALTER TABLE `employee_job_title` ENABLE KEYS */;


DROP TABLE IF EXISTS `employee_team`;
CREATE TABLE IF NOT EXISTS `employee_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DELETE FROM `employee_team`;
/*!40000 ALTER TABLE `employee_team` DISABLE KEYS */;
INSERT INTO `employee_team` (`id`, `name`) VALUES
  (1, 'HUB Craiova');
/*!40000 ALTER TABLE `employee_team` ENABLE KEYS */;

DROP TABLE IF EXISTS `fos_user`;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DELETE FROM `fos_user`;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `PASSWORD`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
  (1, 'test', 'test', 'test', 'test', 1, NULL, '$2y$13$qBjRacI0XwJ4/xCzF9BTCeOLmN2mNcuUvZJbYdCT7ACtjXjTDmkVm', '2017-01-01 00:00:00', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}');
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;


DROP TABLE IF EXISTS `reimbursement`;
CREATE TABLE IF NOT EXISTS `reimbursement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `number` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reimbursement_document_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reimbursement_reimbursement_type_idx` (`type_id`),
  KEY `fk_reimbursement_employee_idx` (`employee_id`),
  KEY `fk_reimbursement_document_idx` (`reimbursement_document_id`),
  CONSTRAINT `fk_reimbursement_reimbursement_document` FOREIGN KEY (`reimbursement_document_id`) REFERENCES `reimbursement_document` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_reimbursement_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_reimbursement_reimbursement_type` FOREIGN KEY (`type_id`) REFERENCES `reimbursement_type` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;

DELETE FROM `reimbursement`;
/*!40000 ALTER TABLE `reimbursement` DISABLE KEYS */;
INSERT INTO `reimbursement` (`id`, `type_id`, `number`, `date`, `value`, `employee_id`, `reimbursement_document_id`) VALUES
  (1, 1, '47', '2016-12-08', 188.37, 3, 1),
  (2, 1, '874', '2016-12-10', 188.81, 2, 1),
  (3, 4, '157', '2016-12-05', 142.26, 1, 1),
  (4, 4, '161', '2016-12-07', 329.51, 1, 1),
  (5, 2, '0005', '2016-12-17', 13.93, 14, 2);
/*!40000 ALTER TABLE `reimbursement` ENABLE KEYS */;


DROP TABLE IF EXISTS `reimbursement_document`;
CREATE TABLE IF NOT EXISTS `reimbursement_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_reimbursement_document_employee_idx` (`employee_id`),
  KEY `fk_reimbursement_document_status_idx` (`status_id`),
  CONSTRAINT `fk_reimbursement_document_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_reimbursement_document_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Dumping data for table heroku_50b788c3a03fca4.reimbursement_document: ~5 rows (approximately)
DELETE FROM `reimbursement_document`;
/*!40000 ALTER TABLE `reimbursement_document` DISABLE KEYS */;
INSERT INTO `reimbursement_document` (`id`, `employee_id`, `status_id`) VALUES
  (1, 1, 1),
  (2, 1, 1);
/*!40000 ALTER TABLE `reimbursement_document` ENABLE KEYS */;


DROP TABLE IF EXISTS `reimbursement_type`;
CREATE TABLE IF NOT EXISTS `reimbursement_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

DELETE FROM `reimbursement_type`;
/*!40000 ALTER TABLE `reimbursement_type` DISABLE KEYS */;
INSERT INTO `reimbursement_type` (`id`, `name`) VALUES
  (1, 'Bon combustibil'),
  (2, 'Bon taxi'),
  (3, 'Bilet tren'),
  (4, 'Factura');
/*!40000 ALTER TABLE `reimbursement_type` ENABLE KEYS */;


DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `name`) VALUES
  (1, 'New'),
  (2, 'Pending'),
  (3, 'Completed');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


DROP TABLE IF EXISTS `travel_destination`;
CREATE TABLE IF NOT EXISTS `travel_destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DELETE FROM `travel_destination`;
/*!40000 ALTER TABLE `travel_destination` DISABLE KEYS */;
INSERT INTO `travel_destination` (`id`, `name`) VALUES
  (1, 'Bucuresti'),
  (2, 'Craiova');
/*!40000 ALTER TABLE `travel_destination` ENABLE KEYS */;


DROP TABLE IF EXISTS `travel_document`;
CREATE TABLE IF NOT EXISTS `travel_document` (
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
  `status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_travel_document_employee_idx` (`employee_id`),
  KEY `fk_travel_document_travel_purpose_idx` (`purpose_id`),
  KEY `fk_travel_document_travel_destination_idx` (`destination_id`),
  KEY `fk_travel_document_status_idx` (`status_id`),
  CONSTRAINT `fk_travel_document_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_document_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_travel_document_travel_destination` FOREIGN KEY (`destination_id`) REFERENCES `travel_destination` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_document_travel_purpose` FOREIGN KEY (`purpose_id`) REFERENCES `travel_purpose` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

DELETE FROM `travel_document`;
/*!40000 ALTER TABLE `travel_document` DISABLE KEYS */;
INSERT INTO `travel_document` (`id`, `employee_id`, `purpose_id`, `destination_id`, `date_start`, `date_end`, `departure_leave_time`, `departure_arrival_time`, `destination_arrival_time`, `destination_leave_time`, `status_id`) VALUES
  (1, 1, 1, 1, '2016-12-08', '2016-12-08', '2016-12-08 06:00:00', '2016-12-08 21:00:00', '2016-12-08 09:00:00', '2016-12-08 18:00:00', 1),
  (2, 1, 1, 1, '2016-12-09', '2016-12-09', '2016-12-09 06:00:00', '2016-12-09 21:00:00', '2016-12-09 09:00:00', '2016-12-09 18:00:00', 1),
  (3, 2, 2, 1, '2016-12-07', '2016-12-10', '2016-12-07 06:00:00', '2016-12-10 21:00:00', '2016-12-07 09:00:00', '2016-12-10 18:00:00', 1),
  (4, 3, 1, 1, '2016-12-13', '2016-12-14', '2016-12-13 06:00:00', '2016-12-14 21:00:00', '2016-12-13 09:00:00', '2016-12-14 18:00:00', 1);
/*!40000 ALTER TABLE `travel_document` ENABLE KEYS */;


DROP TABLE IF EXISTS `travel_purpose`;
CREATE TABLE IF NOT EXISTS `travel_purpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

DELETE FROM `travel_purpose`;
/*!40000 ALTER TABLE `travel_purpose` DISABLE KEYS */;
INSERT INTO `travel_purpose` (`id`, `name`) VALUES
  (1, 'Sedinta planificare'),
  (2, 'Eveniment'),
  (3, 'Campanie');

SET FOREIGN_KEY_CHECKS=1;

COMMIT;