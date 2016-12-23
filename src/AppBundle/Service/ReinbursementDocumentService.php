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
        $reinbursementPlaceholders = [];
        $reinbursementTotalAmount = 0;
        $reinbursementCollection = $reinbursementDocument->getReinbursement();

        // TODO: use it like this, with string placeholders? or switch to Twig variable and loop in template?
        foreach ($reinbursementCollection as $key => $reinbursement) {
            /** @var Reinbursement $reinbursement */
            $reinbursementPlaceholders['PLACEHOLDER_DOC_INDEX_'.$key] = $key;
            $reinbursementPlaceholders['PLACEHOLDER_DOC_TYPE_'.$key] = $reinbursement->getType();
            $reinbursementPlaceholders['PLACEHOLDER_DOC_NR_'.$key] = $reinbursement->getNumber();
            $reinbursementPlaceholders['PLACEHOLDER_DOC_DATE_'.$key] = $reinbursement->getDate()->format('m-d-Y');
            $reinbursementTotalAmount +=
                $reinbursementPlaceholders['PLACEHOLDER_DOC_AMOUNT_'.$key] = floatval($reinbursement->getValue());
        }

        return array_merge(
            array(
                'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
                'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
                'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
                'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
                'PLACEHOLDER_DIVISION_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
                'PLACEHOLDER_DIVISION_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
                'PLACEHOLDER_TOTAL_AMOUNT' => $reinbursementTotalAmount,
                'reinbursement_collection' => $reinbursementCollection
            ),
            $reinbursementPlaceholders
        );
    }

}