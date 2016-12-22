<?php

namespace AppBundle\Service;

use AppBundle\Entity\TravelDocument;

/**
 * Class TravelDocumentService
 * @package AppBundle\Service
 */
class TravelDocumentService
{

    const DATE_FORMAT_PATTERN = 'd.m.Y H:i';
    const TRAVEL_DAY_PAYMENT = 32.5;
    const DOCUMENT_TYPE_TEXT = 'Diurna %s zile (%s lei/zi)';

    /**
     * @param TravelDocument $travelDocument
     * @return array
     */
    public function fillPlaceholders(TravelDocument $travelDocument)
    {
        $employee = $travelDocument->getEmployee();
        $company = $employee->getCompany();
        $daysOnTravel = $this->computeDaysOnTravelByTravelDates(
            $travelDocument->getDateStart(),
            $travelDocument->getDateEnd()
        );
        $paymentAmount = $daysOnTravel * self::TRAVEL_DAY_PAYMENT;

        return array(
            'PLACEHOLDER_COST_CENTER' => $company->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $employee->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $employee->getJobTitle(),
            'PLACEHOLDER_TRAVEL_PURPOSE' => $travelDocument->getPurpose(),
            'PLACEHOLDER_TRAVEL_DESTINATION' => $travelDocument->getDestination(),
            'PLACEHOLDER_COMPANY_NAME' => $company->getName(),
            'PLACEHOLDER_EMPLOYEE_DETAILS' => $employee->getIdentityCardNumber().' / '
                .$employee->getPersonalNumericCode(),
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
            'PLACEHOLDER_MANAGER_LAST_NAME' => $company->getDivisionManager()->getLastName(),
            'PLACEHOLDER_MANAGER_FIRST_NAME' => $company->getDivisionManager()->getFirstName(),
            'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $employee->getLastName(),
            'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $employee->getFirstName()
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