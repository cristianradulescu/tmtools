<?php

namespace AppBundle\Service;

use AppBundle\Entity\EmployeeInterface;
use AppBundle\Entity\ReimbursementDocument;

/**
 * Class ReimbursementDocumentService
 * @package AppBundle\Service
 */
class ReimbursementDocumentService extends DocumentService
{
    /**
     * @param EmployeeInterface|ReimbursementDocument $reimbursementDocument
     * @return array
     */
    public function fillPlaceholders(EmployeeInterface $reimbursementDocument)
    {
        parent::fillPlaceholders($reimbursementDocument);

        return array(
            'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
            'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
            'PLACEHOLDER_DIVISION_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
            'PLACEHOLDER_DIVISION_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
            'reimbursement_collection' => $reimbursementDocument->getReimbursement()
        );
    }
}
