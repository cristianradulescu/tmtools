-- MySQL Script generated by MySQL Workbench
-- 12/14/16 12:24:41
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tmtools
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tmtools` ;

-- -----------------------------------------------------
-- Schema tmtools
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tmtools` DEFAULT CHARACTER SET utf8 ;
USE `tmtools` ;

-- -----------------------------------------------------
-- Table `tmtools`.`employee_job_title`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`employee_job_title` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`employee_job_title` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `tmtools`.`employee_job_title` (`name` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`employee_team`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`employee_team` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`employee_team` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `tmtools`.`employee_team` (`name` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`company`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`company` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`company` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `cost_center` VARCHAR(45) NOT NULL,
  `division_manager_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_company_employee`
  FOREIGN KEY (`division_manager_id`)
  REFERENCES `tmtools`.`employee` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
  ENGINE = InnoDB;

CREATE UNIQUE INDEX `cost_center_UNIQUE` ON `tmtools`.`company` (`cost_center` ASC);

CREATE INDEX `fk_company_employee_idx` ON `tmtools`.`company` (`division_manager_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`employee` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`employee` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `email_address` VARCHAR(255) NOT NULL,
  `birthday` DATE NULL,
  `personal_numeric_code` BIGINT UNSIGNED NULL,
  `identity_card_number` VARCHAR(45) NULL,
  `job_title_id` INT NULL,
  `direct_manager_id` INT NULL,
  `team_id` INT NULL,
  `company_id` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_employee_job_title`
  FOREIGN KEY (`job_title_id`)
  REFERENCES `tmtools`.`employee_job_title` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_employee`
  FOREIGN KEY (`direct_manager_id`)
  REFERENCES `tmtools`.`employee` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_team`
  FOREIGN KEY (`team_id`)
  REFERENCES `tmtools`.`employee_team` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_company`
  FOREIGN KEY (`company_id`)
  REFERENCES `tmtools`.`company` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
  ENGINE = InnoDB;

CREATE UNIQUE INDEX `username_UNIQUE` ON `tmtools`.`employee` (`username` ASC);

CREATE UNIQUE INDEX `email_address_UNIQUE` ON `tmtools`.`employee` (`email_address` ASC);

CREATE UNIQUE INDEX `personal_numeric_code_UNIQUE` ON `tmtools`.`employee` (`personal_numeric_code` ASC);

CREATE UNIQUE INDEX `identity_card_number_UNIQUE` ON `tmtools`.`employee` (`identity_card_number` ASC);

CREATE INDEX `fk_employee_job_title_idx` ON `tmtools`.`employee` (`job_title_id` ASC);

CREATE INDEX `fk_employee_employee_idx` ON `tmtools`.`employee` (`direct_manager_id` ASC);

CREATE INDEX `fk_employee_team_idx` ON `tmtools`.`employee` (`team_id` ASC);

CREATE INDEX `fk_employee_company_idx` ON `tmtools`.`employee` (`company_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`travel_destination`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`travel_destination` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`travel_destination` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `tmtools`.`travel_destination` (`name` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`aquisition_supplier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`aquisition_supplier` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`aquisition_supplier` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmtools`.`aquisition_bought_service`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`aquisition_bought_service` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`aquisition_bought_service` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(225) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmtools`.`aquisition_supplier_account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`aquisition_supplier_account` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`aquisition_supplier_account` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aquisition_supplier_id` INT NULL,
  `bank_account_number` VARCHAR(45) NULL,
  `bank_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_aquisition_supplier_account_aquisition_supplier`
  FOREIGN KEY (`aquisition_supplier_id`)
  REFERENCES `tmtools`.`aquisition_supplier` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
  ENGINE = InnoDB;

CREATE INDEX `fk_aquisition_supplier_account_aquisition_supplier_idx` ON `tmtools`.`aquisition_supplier_account` (`aquisition_supplier_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`reinbursement_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`reinbursement_type` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`reinbursement_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmtools`.`reinbursement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`reinbursement` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`reinbursement` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type_id` INT NOT NULL,
  `number` VARCHAR(45) NOT NULL,
  `date` DATE NOT NULL,
  `value` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_reinbursement_reinbursement_type`
  FOREIGN KEY (`type_id`)
  REFERENCES `tmtools`.`reinbursement_type` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
  ENGINE = InnoDB;

CREATE INDEX `fk_reinbursement_reinbursement_type_idx` ON `tmtools`.`reinbursement` (`type_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`reinbursement_document`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`reinbursement_document` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`reinbursement_document` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `employee_id` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_reinbursement_document_employee`
  FOREIGN KEY (`employee_id`)
  REFERENCES `tmtools`.`employee` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
  ENGINE = InnoDB;

CREATE INDEX `fk_reinbursement_document_employee_idx` ON `tmtools`.`reinbursement_document` (`employee_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`travel_purpose`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`travel_purpose` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`travel_purpose` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `tmtools`.`travel_purpose` (`name` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`travel_document`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`travel_document` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`travel_document` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `employee_id` INT NOT NULL,
  `purpose_id` INT NOT NULL,
  `destination_id` INT NOT NULL,
  `date_start` DATE NOT NULL,
  `date_end` DATE NOT NULL,
  `departure_leave_time` DATETIME NOT NULL,
  `departure_arrival_time` DATETIME NOT NULL,
  `destination_arrival_time` DATETIME NOT NULL,
  `destination_leave_time` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_travel_document_employee`
  FOREIGN KEY (`employee_id`)
  REFERENCES `tmtools`.`employee` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_document_travel_purpose`
  FOREIGN KEY (`purpose_id`)
  REFERENCES `tmtools`.`travel_purpose` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_travel_document_travel_destination`
  FOREIGN KEY (`destination_id`)
  REFERENCES `tmtools`.`travel_destination` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_travel_document_employee_idx` ON `tmtools`.`travel_document` (`employee_id` ASC);

CREATE INDEX `fk_travel_document_travel_purpose_idx` ON `tmtools`.`travel_document` (`purpose_id` ASC);

CREATE INDEX `fk_travel_document_travel_destination_idx` ON `tmtools`.`travel_document` (`destination_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`reinbursement_document_reinbursements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`reinbursement_document_reinbursements` ;

CREATE TABLE IF NOT EXISTS `tmtools`.`reinbursement_document_reinbursements` (
  `reinbursement_document_id` INT NOT NULL,
  `reinbursement_id` INT NOT NULL,
  PRIMARY KEY (`reinbursement_document_id`, `reinbursement_id`),
  CONSTRAINT `fk_reinbursement_document`
  FOREIGN KEY (`reinbursement_document_id`)
  REFERENCES `tmtools`.`reinbursement_document` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reinbursement`
  FOREIGN KEY (`reinbursement_id`)
  REFERENCES `tmtools`.`reinbursement` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_reinbursement_idx` ON `tmtools`.`reinbursement_document_reinbursements` (`reinbursement_id` ASC);


-- -----------------------------------------------------
-- Table `tmtools`.`fos_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmtools`.`fos_user` ;

CREATE TABLE `tmtools`.`fos_user` (
  id INT AUTO_INCREMENT NOT NULL,
  username VARCHAR(180) NOT NULL,
  username_canonical VARCHAR(180) NOT NULL,
  email VARCHAR(180) NOT NULL,
  email_canonical VARCHAR(180) NOT NULL,
  enabled TINYINT(1) NOT NULL,
  salt VARCHAR(255) DEFAULT NULL,
  PASSWORD VARCHAR(255) NOT NULL,
  last_login DATETIME DEFAULT NULL,
  confirmation_token VARCHAR(180) DEFAULT NULL,
  password_requested_at DATETIME DEFAULT NULL,
  roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)',
  UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical),
  UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical),
  UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token),
  PRIMARY KEY(id))
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Data for table `tmtools`.`employee_job_title`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`employee_job_title` (`id`, `name`) VALUES (DEFAULT, 'Manager');
INSERT INTO `tmtools`.`employee_job_title` (`id`, `name`) VALUES (DEFAULT, 'Programator');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tmtools`.`employee_team`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`employee_team` (`id`, `name`) VALUES (DEFAULT, 'Craiova HUB');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tmtools`.`company`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`company` (`id`, `name`, `cost_center`, `division_manager_id`) VALUES (DEFAULT, 'eMAG', '12RO123456', 1);
INSERT INTO `tmtools`.`company` (`id`, `name`, `cost_center`, `division_manager_id`) VALUES (DEFAULT, 'Dante', '13RO123456', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tmtools`.`employee`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`employee` (`id`, `first_name`, `last_name`, `username`, `email_address`, `birthday`, `personal_numeric_code`, `identity_card_number`, `job_title_id`, `direct_manager_id`, `team_id`, `company_id`) VALUES (DEFAULT, 'Cristian', 'Radulescu', 'cristian.radulescu', 'cristian.radulescu', '1984-01-01', 1234567890000, 'AB123456', 1, NULL, 1, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tmtools`.`travel_destination`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`travel_destination` (`id`, `name`) VALUES (DEFAULT, 'Bucuresti');
INSERT INTO `tmtools`.`travel_destination` (`id`, `name`) VALUES (DEFAULT, 'Craiova');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tmtools`.`travel_purpose`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`travel_purpose` (`id`, `name`) VALUES (DEFAULT, 'Sedinta planificare');
INSERT INTO `tmtools`.`travel_purpose` (`id`, `name`) VALUES (DEFAULT, 'Eveniment companie');
INSERT INTO `tmtools`.`travel_purpose` (`id`, `name`) VALUES (DEFAULT, 'Curs');
INSERT INTO `tmtools`.`travel_purpose` (`id`, `name`) VALUES (DEFAULT, 'Prezentare');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tmtools`.`reinbursement_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `tmtools`;
INSERT INTO `tmtools`.`reinbursement_type` (`id`, `name`) VALUES (DEFAULT, 'Bon combustibil');
INSERT INTO `tmtools`.`reinbursement_type` (`id`, `name`) VALUES (DEFAULT, 'Bon taxi');
INSERT INTO `tmtools`.`reinbursement_type` (`id`, `name`) VALUES (DEFAULT, 'Bilet tren');
INSERT INTO `tmtools`.`reinbursement_type` (`id`, `name`) VALUES (DEFAULT, 'Factura');

COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
