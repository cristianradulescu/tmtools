START TRANSACTION;

ALTER TABLE reimbursement DROP FOREIGN KEY fk_reimbursement_employee;
ALTER TABLE reimbursement DROP COLUMN employee_id;

COMMIT;