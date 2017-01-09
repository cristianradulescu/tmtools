START TRANSACTION;

-- Use a default value for employee_id, in order to be able to create the foreign key
SET @employee_id = (SELECT id FROM employee WHERE username='cristian.radulescu');
ALTER TABLE reimbursement ADD employee_id INT NULL;
UPDATE reimbursement SET employee_id=@employee_id WHERE employee_id IS NULL;

ALTER TABLE reimbursement ADD CONSTRAINT fk_reimbursement_employee FOREIGN KEY (employee_id) REFERENCES employee (id);
CREATE INDEX fk_reimbursement_employee_idx ON reimbursement (employee_id ASC);
ALTER TABLE reimbursement CHANGE employee_id employee_id INT NOT NULL;

COMMIT;