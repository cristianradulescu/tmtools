<?php

namespace AppBundle\Service;

use AppBundle\Entity\DocumentInterface;
use AppBundle\Entity\TravelDocument;

/**
 * Class TravelDocumentService
 * @package AppBundle\Service
 */
class TravelDocumentService extends DocumentService
{
    const SERVICE_ID = 'app.travel_document';

    /**
     * @param DocumentInterface|TravelDocument $travelDocument
     * @return array
     */
    public function fillPlaceholders(DocumentInterface $travelDocument)
    {
        parent::fillPlaceholders($travelDocument);

        return array(
            'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
            'PLACEHOLDER_TRAVEL_PURPOSE' => $travelDocument->getPurpose(),
            'PLACEHOLDER_TRAVEL_DESTINATION' => $travelDocument->getDestination(),
            'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
            'PLACEHOLDER_EMPLOYEE_ICN' => $this->getEmployee()->getIdentityCardNumber(),
            'PLACEHOLDER_EMPLOYEE_PNC' => $this->getEmployee()->getPersonalNumericCode(),
            'PLACEHOLDER_DATE_FROM' => $travelDocument->getDateStart(),
            'PLACEHOLDER_DATE_TO' => $travelDocument->getDateEnd(),
            'PLACEHOLDER_DESTINATION_ARRIVAL_TIME' => $travelDocument->getDestinationArrivalTime(),
            'PLACEHOLDER_DESTINATION_LEAVE_TIME' => $travelDocument->getDestinationLeaveTime(),
            'PLACEHOLDER_STARTPOINT_LEAVE_TIME' => $travelDocument->getDepartureLeaveTime(),
            'PLACEHOLDER_STARTPOINT_ARRIVAL_TIME' => $travelDocument->getDepartureArrivalTime(),
            'PLACEHOLDER_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
            'PLACEHOLDER_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
            'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $this->getEmployee()->getLastName(),
            'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $this->getEmployee()->getFirstName(),
            'days_on_travel' => $travelDocument->getDateEnd()
                ->diff($travelDocument->getDateStart())->days + 1
        );
    }
}
