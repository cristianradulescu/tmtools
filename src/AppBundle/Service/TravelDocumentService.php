<?php

namespace AppBundle\Service;

use AppBundle\Entity\EmployeeInterface;
use AppBundle\Entity\TravelDocument;

/**
 * Class TravelDocumentService
 * @package AppBundle\Service
 */
class TravelDocumentService extends DocumentService
{

    const DATE_FORMAT_PATTERN = 'd.m.Y H:i';
    const TRAVEL_DAY_PAYMENT = 32.5;
    const DOCUMENT_TYPE_TEXT = 'Diurna %s zile (%s lei/zi)';

    /**
     * @param EmployeeInterface|TravelDocument $travelDocument
     * @return array
     */
    public function fillPlaceholders(EmployeeInterface $travelDocument)
    {
        parent::fillPlaceholders($travelDocument);

        $daysOnTravel = $this->computeDaysOnTravelByTravelDates(
            $travelDocument->getDateStart(),
            $travelDocument->getDateEnd()
        );
        $paymentAmount = $daysOnTravel * self::TRAVEL_DAY_PAYMENT;

        return array(
            'PLACEHOLDER_COST_CENTER' => $this->getCompany()->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->getEmployee()->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->getEmployee()->getJobTitle(),
            'PLACEHOLDER_TRAVEL_PURPOSE' => $travelDocument->getPurpose(),
            'PLACEHOLDER_TRAVEL_DESTINATION' => $travelDocument->getDestination(),
            'PLACEHOLDER_COMPANY_NAME' => $this->getCompany()->getName(),
            'PLACEHOLDER_EMPLOYEE_DETAILS' => $this->getEmployee()->getIdentityCardNumber().' / '
                .$this->getEmployee()->getPersonalNumericCode(),
            'PLACEHOLDER_DATE_FROM' => $travelDocument->getDateStart()->format('d.m.Y'),
            'PLACEHOLDER_DATE_TO' => $travelDocument->getDateEnd()->format('d.m.Y'),
            'PLACEHOLDER_DESTINATION_ARRIVAL_TIME' => $travelDocument->getDestinationArrivalTime()
                ->format(self::DATE_FORMAT_PATTERN),
            'PLACEHOLDER_DESTINATION_LEAVE_TIME' => $travelDocument->getDestinationLeaveTime()
                ->format(self::DATE_FORMAT_PATTERN),
            'PLACEHOLDER_STARTPOINT_LEAVE_TIME' => $travelDocument->getDepartureLeaveTime()
                ->format(self::DATE_FORMAT_PATTERN),
            'PLACEHOLDER_STARTPOINT_ARRIVAL_TIME' => $travelDocument->getDepartureArrivalTime()
                ->format(self::DATE_FORMAT_PATTERN),
            'PLACEHOLDER_DOCUMENT_TYPE' => sprintf(self::DOCUMENT_TYPE_TEXT, $daysOnTravel, self::TRAVEL_DAY_PAYMENT),
            'PLACEHOLDER_AMOUNT' => $paymentAmount,
            'PLACEHOLDER_TOTAL_AMOUNT' => $paymentAmount,
            'PLACEHOLDER_MANAGER_LAST_NAME' => $this->getCompany()->getDivisionManager()->getLastName(),
            'PLACEHOLDER_MANAGER_FIRST_NAME' => $this->getCompany()->getDivisionManager()->getFirstName(),
            'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $this->getEmployee()->getLastName(),
            'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $this->getEmployee()->getFirstName()
        );
    }

    /**
     * Determine the document type (payment for days spent travelling).
     *
     * Must add 1 day to the final result in order to include the first day, since the date difference method will not
     * include it.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return string
     */
    protected function computeDaysOnTravelByTravelDates(\DateTime $startDate, \DateTime $endDate)
    {
        $travelTime = $endDate->diff($startDate);

        return $travelTime->days + 1;
    }
}