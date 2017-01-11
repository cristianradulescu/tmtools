START TRANSACTION;

ALTER TABLE reimbursement DROP FOREIGN KEY fk_reimbursement_reimbursement_document;
ALTER TABLE reimbursement DROP COLUMN reimbursement_document_id;
CREATE TABLE IF NOT EXISTS `reimbursement_document_reimbursements` (
  `reimbursement_document_id` INT NOT NULL,
  `reimbursement_id` INT NOT NULL,
  PRIMARY KEY (`reimbursement_document_id`, `reimbursement_id`),
  CONSTRAINT `fk_reimbursement_document`
  FOREIGN KEY (`reimbursement_document_id`)
  REFERENCES `reimbursement_document` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reimbursement`
  FOREIGN KEY (`reimbursement_id`)
  REFERENCES `reimbursement` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
  ENGINE = InnoDB;
CREATE INDEX `fk_reimbursement_idx` ON `reimbursement_document_reimbursements` (`reimbursement_id` ASC);

COMMIT;