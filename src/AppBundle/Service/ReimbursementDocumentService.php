<?php

namespace AppBundle\Service;

use AppBundle\Entity\DocumentInterface;
use AppBundle\Entity\ReimbursementDocument;

/**
 * Class ReimbursementDocumentService
 * @package AppBundle\Service
 */
class ReimbursementDocumentService extends DocumentService
{
    const SERVICE_ID = 'app.reimbursement_document';

    /**
     * @param DocumentInterface|ReimbursementDocument $reimbursementDocument
     * @return array
     */
    public function fillPlaceholders(DocumentInterface $reimbursementDocument)
    {
        parent::fillPlaceholders($reimbursementDocument);

        return array(
            'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
            'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
            'PLACEHOLDER_DIVISION_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
            'PLACEHOLDER_DIVISION_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
            'reimbursement_collection' => $reimbursementDocument->getReimbursements()
        );
    }
}
