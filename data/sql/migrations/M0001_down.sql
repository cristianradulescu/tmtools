START TRANSACTION;

ALTER TABLE `reimbursement_document` DROP FOREIGN KEY fk_reimbursement_document_status;
ALTER TABLE `reimbursement_document` DROP COLUMN status_id;
ALTER TABLE `travel_document` DROP FOREIGN KEY fk_travel_document_status;
ALTER TABLE `travel_document` DROP COLUMN status_id;

DROP TABLE `status`;

COMMIT;