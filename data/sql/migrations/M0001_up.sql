START TRANSACTION;

CREATE TABLE `status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;
INSERT INTO `status` (`id`, `name`) VALUES (1, 'New'),  (2, 'Pending'), (3, 'Completed');

ALTER TABLE reimbursement_document ADD status_id INT DEFAULT 1;
ALTER TABLE reimbursement_document ADD CONSTRAINT fk_reimbursement_document_status FOREIGN KEY (status_id) REFERENCES status (id);
CREATE INDEX fk_reimbursement_document_status_idx ON reimbursement_document (status_id);
ALTER TABLE travel_document ADD status_id INT DEFAULT 1;
ALTER TABLE travel_document ADD CONSTRAINT fk_travel_document_status FOREIGN KEY (status_id) REFERENCES status (id);
CREATE INDEX fk_travel_document_status_idx ON travel_document (status_id);

COMMIT;