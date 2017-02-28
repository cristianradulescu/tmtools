<?php

namespace AppBundle\Service;

use AppBundle\Entity\Document;
use AppBundle\Entity\Travel;

/**
 * Class TravelDocumentService
 * @package AppBundle\Service
 */
class TravelDocumentService extends DocumentService
{
    /**
     * @param Document $document
     * @return array
     */
    public function fillPlaceholders(Document $document)
    {
        parent::fillPlaceholders($document);

        /** @var Travel $travel */
        $travel = $document->getTravel();

        return array(
            'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
            'PLACEHOLDER_TRAVEL_PURPOSE' => $travel->getPurpose(),
            'PLACEHOLDER_TRAVEL_DESTINATION' => $travel->getDestination(),
            'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
            'PLACEHOLDER_EMPLOYEE_ICN' => $this->getEmployee()->getIdentityCardNumber(),
            'PLACEHOLDER_EMPLOYEE_PNC' => $this->getEmployee()->getPersonalNumericCode(),
            'PLACEHOLDER_DATE_FROM' => $travel->getDateStart(),
            'PLACEHOLDER_DATE_TO' => $travel->getDateEnd(),
            'PLACEHOLDER_DESTINATION_ARRIVAL_TIME' => $travel->getDestinationArrivalTime(),
            'PLACEHOLDER_DESTINATION_LEAVE_TIME' => $travel->getDestinationLeaveTime(),
            'PLACEHOLDER_STARTPOINT_LEAVE_TIME' => $travel->getDepartureLeaveTime(),
            'PLACEHOLDER_STARTPOINT_ARRIVAL_TIME' => $travel->getDepartureArrivalTime(),
            'PLACEHOLDER_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
            'PLACEHOLDER_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
            'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $this->getEmployee()->getLastName(),
            'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $this->getEmployee()->getFirstName(),
            'PLACEHOLDER_TRAVEL_TOTAL_AMOUNT' => $document->getTotalAmount(),
            'days_on_travel' => $travel->getNumberOfDaysOnTravel()
        );
    }
}
