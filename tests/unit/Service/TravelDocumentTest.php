<?php
namespace Service;

use AppBundle\Entity\TravelDocument;
use AppBundle\Service\TravelDocumentService;
use \Mockery as m;

/**
 * Class TravelDocumentTest
 * @package Service
 */
class TravelDocumentTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
        m::close();
    }

    /**
     * @param array $dataProvider
     *
     * @covers \AppBundle\Service\TravelDocumentService::fillPlaceholders()
     * @dataProvider travelDocumentDataProvider
     */
    public function testFillPlaceholders(array $dataProvider)
    {
        $this->assertEquals(
            array(
                'PLACEHOLDER_COST_CENTER' => $dataProvider['cost_center'],
                'PLACEHOLDER_EMPLOYEE_NAME' => $dataProvider['employee_name'],
                'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $dataProvider['employee_job_title'],
                'PLACEHOLDER_TRAVEL_PURPOSE' => $dataProvider['travel_purpose'],
                'PLACEHOLDER_TRAVEL_DESTINATION' => $dataProvider['travel_destination'],
                'PLACEHOLDER_COMPANY_NAME' => $dataProvider['company_name'],
                'PLACEHOLDER_EMPLOYEE_ICN' => $dataProvider['employee_icn'],
                'PLACEHOLDER_EMPLOYEE_PNC' => $dataProvider['employee_pnc'],
                'PLACEHOLDER_DATE_FROM' => $dataProvider['date_from'],
                'PLACEHOLDER_DATE_TO' => $dataProvider['date_to'],
                'PLACEHOLDER_DESTINATION_ARRIVAL_TIME' => $dataProvider['destination_arrival_time'],
                'PLACEHOLDER_DESTINATION_LEAVE_TIME' => $dataProvider['destination_leave_time'],
                'PLACEHOLDER_STARTPOINT_LEAVE_TIME' => $dataProvider['startpoint_leave_time'],
                'PLACEHOLDER_STARTPOINT_ARRIVAL_TIME' => $dataProvider['startpoint_arrival_time'],
                'PLACEHOLDER_MANAGER_LAST_NAME' => $dataProvider['manager_last_name'],
                'PLACEHOLDER_MANAGER_FIRST_NAME' => $dataProvider['manager_first_name'],
                'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $dataProvider['employee_last_name'],
                'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $dataProvider['employee_first_name'],
                'days_on_travel' => $dataProvider['days_on_travel']
            ),
            (new TravelDocumentService())->fillPlaceholders($this->mockTravelDocument($dataProvider))
        );
    }

    /**
     * @return array
     */
    public function travelDocumentDataProvider()
    {
        return array(
            // dataset #0
            array(
                array(
                    'cost_center' => '12AB345678',
                    'employee_name' => 'Bill Employee',
                    'employee_job_title' => 'PHP Developer',
                    'travel_purpose' => 'Meeting',
                    'travel_destination' => 'Bucharest',
                    'company_name' => 'Tech Company',
                    'employee_icn' => 'AB 123456',
                    'employee_pnc' => '1234567890987',
                    'date_from' => new \DateTime('2017-01-16'),
                    'date_to' => new \DateTime('2017-01-18'),
                    'destination_arrival_time' => new \DateTime('2017-01-16 09:00:00'),
                    'destination_leave_time' => new \DateTime('2017-01-18 18:00:00'),
                    'startpoint_leave_time' => new \DateTime('2017-01-16 06:00:00'),
                    'startpoint_arrival_time' => new \DateTime('2017-01-18 21:30:00'),
                    'manager_last_name' => 'Manager',
                    'manager_first_name' => 'John',
                    'employee_last_name' => 'Employee',
                    'employee_first_name' => 'Bill',
                    'days_on_travel' => 3
                )
            ),
            // dataset #1
            array(
                array(
                    'cost_center' => '34CD987654',
                    'employee_name' => 'Charlie Employee',
                    'employee_job_title' => 'PHP Developer',
                    'travel_purpose' => 'Company event',
                    'travel_destination' => 'Bucharest',
                    'company_name' => 'Another Company',
                    'employee_icn' => 'ZZ 987654',
                    'employee_pnc' => '9876543212234',
                    'date_from' => new \DateTime('2017-01-17'),
                    'date_to' => new \DateTime('2017-01-17'),
                    'destination_arrival_time' => new \DateTime('2017-01-17 09:00:00'),
                    'destination_leave_time' => new \DateTime('2017-01-17 18:00:00'),
                    'startpoint_leave_time' => new \DateTime('2017-01-17 06:00:00'),
                    'startpoint_arrival_time' => new \DateTime('2017-01-17 21:30:00'),
                    'manager_last_name' => 'Manager',
                    'manager_first_name' => 'Alice',
                    'employee_last_name' => 'Employee',
                    'employee_first_name' => 'Charlie',
                    'days_on_travel' => 1
                )
            )
        );
    }

    /**
     * @param array $dataProvider
     * @return m\MockInterface|TravelDocument
     */
    protected function mockTravelDocument(array $dataProvider)
    {
        // company
        $company = m::mock('AppBundle\Entity\Company');
        $company->shouldReceive('getName')->andReturn($dataProvider['company_name']);
        $company->shouldReceive('getCostCenter')->andReturn($dataProvider['cost_center']);

        // employee - divison manager
        $divisionManager = m::mock('AppBundle\Entity\Employee');
        $divisionManager->shouldReceive('getCompany')->andReturn($company);
        $divisionManager->shouldReceive('getFirstName')->andReturn($dataProvider['manager_first_name']);
        $divisionManager->shouldReceive('getLastName')->andReturn($dataProvider['manager_last_name']);
        $company->shouldReceive('getDivisionManager')->andReturn($divisionManager);

        // employee
        $employee = m::mock('AppBundle\Entity\Employee');
        $employee->shouldReceive('getCompany')->andReturn($company);
        $employee->shouldReceive('getFirstName')->andReturn($dataProvider['employee_first_name']);
        $employee->shouldReceive('getLastName')->andReturn($dataProvider['employee_last_name']);
        $employee->shouldReceive('getFullName')->andReturn($dataProvider['employee_name']);
        $employee->shouldReceive('getJobTitle')->andReturn($dataProvider['employee_job_title']);
        $employee->shouldReceive('getIdentityCardNumber')->andReturn($dataProvider['employee_icn']);
        $employee->shouldReceive('getPersonalNumericCode')->andReturn($dataProvider['employee_pnc']);

        // travel document
        $travelDocument = m::mock('AppBundle\Entity\TravelDocument');
        $travelDocument->shouldReceive('getEmployee')->andReturn($employee);
        $travelDocument->shouldReceive('getDateStart')->andReturn($dataProvider['date_from']);
        $travelDocument->shouldReceive('getDateEnd')->andReturn($dataProvider['date_to']);
        $travelDocument->shouldReceive('getDepartureLeaveTime')->andReturn($dataProvider['startpoint_leave_time']);
        $travelDocument->shouldReceive('getDestinationArrivalTime')->andReturn($dataProvider['destination_arrival_time']);
        $travelDocument->shouldReceive('getDestinationLeaveTime')->andReturn($dataProvider['destination_leave_time']);
        $travelDocument->shouldReceive('getDepartureArrivalTime')->andReturn($dataProvider['startpoint_arrival_time']);
        $travelDocument->shouldReceive('getPurpose')->andReturn($dataProvider['travel_purpose']);
        $travelDocument->shouldReceive('getDestination')->andReturn($dataProvider['travel_destination']);

        return $travelDocument;
    }
}
