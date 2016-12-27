<?php

namespace AppBundle\Service;

use AppBundle\Entity\EmployeeInterface;
use AppBundle\Entity\Reinbursement;
use AppBundle\Entity\ReinbursementDocument;

/**
 * Class ReinbursementDocumentService
 * @package AppBundle\Service
 */
class ReinbursementDocumentService extends DocumentService
{
    /**
     * @param EmployeeInterface|ReinbursementDocument $reinbursementDocument
     * @return array
     */
    public function fillPlaceholders(EmployeeInterface $reinbursementDocument)
    {
        parent::fillPlaceholders($reinbursementDocument);

        return array(
            'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
            'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
            'PLACEHOLDER_DIVISION_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
            'PLACEHOLDER_DIVISION_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
            'reinbursement_collection' => $reinbursementDocument->getReinbursement()
        );
    }
}
