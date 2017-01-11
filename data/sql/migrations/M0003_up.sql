START TRANSACTION;

ALTER TABLE reimbursement ADD reimbursement_document_id INT NULL;
ALTER TABLE reimbursement ADD CONSTRAINT fk_reimbursement_reimbursement_document
  FOREIGN KEY (reimbursement_document_id)
  REFERENCES reimbursement_document (id)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;
CREATE INDEX fk_reimbursement_document_idx ON reimbursement (reimbursement_document_id ASC);

-- Migrate data from old table into the new column
UPDATE reimbursement r
  SET r.reimbursement_document_id = (
    SELECT rdr.reimbursement_document_id FROM reimbursement_document_reimbursements rdr
    WHERE rdr.reimbursement_id = r.id
  );

-- This should be executed manually, after data migration is verified.
-- DROP TABLE reimbursement_document_reimbursements;

COMMIT;