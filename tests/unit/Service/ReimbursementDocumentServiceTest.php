<?php
namespace Service;

use AppBundle\Entity\Reimbursement;
use AppBundle\Service\ReimbursementDocumentService;
use Doctrine\Common\Collections\ArrayCollection;
use \Mockery as m;

/**
 * Class ReimbursementDocumentServiceTest
 * @package Service
 */
class ReimbursementDocumentServiceTest extends \PHPUnit_Framework_TestCase
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
     * @covers \AppBundle\Service\ReimbursementDocumentService::fillPlaceholders()
     * @dataProvider reimbursementDocumentDataProvider
     */
    public function testFillPlaceholders(array $dataProvider)
    {
        $this->assertEquals(
            array(
                'PLACEHOLDER_COMPANY_NAME' => $dataProvider['company_name'],
                'PLACEHOLDER_COST_CENTER' => $dataProvider['cost_center'],
                'PLACEHOLDER_EMPLOYEE_NAME' => $dataProvider['employee_name'],
                'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $dataProvider['employee_job_title'],
                'PLACEHOLDER_DIVISION_MANAGER_LAST_NAME' => $dataProvider['division_manager_last_name'],
                'PLACEHOLDER_DIVISION_MANAGER_FIRST_NAME' => $dataProvider['division_manager_first_name'],
                'PLACEHOLDER_REIMBURSEMENT_TOTAL_AMOUNT' => $dataProvider['reimbursement_total_amount'],
                'reimbursement_collection' => $dataProvider['reimbursement_collection']
            ),
            (new ReimbursementDocumentService())->fillPlaceholders(
                $this->mockReimbursementDocumentService($dataProvider)
            )
        );
    }

    /**
     * @return array
     */
    public function reimbursementDocumentDataProvider()
    {
        return array(
            // dataset #0
            array(
                array(
                    'company_name' => 'Tech Company',
                    'cost_center' => '12AB345678',
                    'employee_name' => 'John Doe',
                    'employee_job_title' => 'Software Developer',
                    'division_manager_last_name' => 'Manager',
                    'division_manager_first_name' => 'Bill',
                    'reimbursement_total_amount' => 930.97,
                    'reimbursement_collection' => new ArrayCollection(
                        array(
                            new Reimbursement(),
                            new Reimbursement()
                        )
                    )
                )
            ),
            // dataset #1
            array(
                array(
                    'company_name' => 'eCommerce Company',
                    'cost_center' => '99XY098765',
                    'employee_name' => 'Alice Doe',
                    'employee_job_title' => 'Manager',
                    'division_manager_last_name' => 'Doe',
                    'division_manager_first_name' => 'Alice',
                    'reimbursement_total_amount' => 231.50,
                    'reimbursement_collection' => new ArrayCollection(
                        array(
                            new Reimbursement()
                        )
                    )
                )
            )
        );
    }

    /**
     * @param array $dataProvider
     * @return m\MockInterface
     */
    protected function mockReimbursementDocumentService(array $dataProvider)
    {
        // company
        $company = m::mock('AppBundle\Entity\Company');
        $company->shouldReceive('getName')->andReturn($dataProvider['company_name']);
        $company->shouldReceive('getCostCenter')->andReturn($dataProvider['cost_center']);

        // employee - divison manager
        $divisionManager = m::mock('AppBundle\Entity\Employee');
        $divisionManager->shouldReceive('getFirstName')->andReturn($dataProvider['division_manager_first_name']);
        $divisionManager->shouldReceive('getLastName')->andReturn($dataProvider['division_manager_last_name']);
        $company->shouldReceive('getDivisionManager')->andReturn($divisionManager);

        // employee
        $employee = m::mock('AppBundle\Entity\Employee');
        $employee->shouldReceive('getCompany')->andReturn($company);
        $employee->shouldReceive('getFullName')->andReturn($dataProvider['employee_name']);
        $employee->shouldReceive('getJobTitle')->andReturn($dataProvider['employee_job_title']);

        // reimbursement document
        $reimbursementDocument = m::mock('AppBundle\Entity\Document');
        $reimbursementDocument->shouldReceive('getEmployee')->andReturn($employee);
        $reimbursementDocument->shouldReceive('getReimbursements')->andReturn($dataProvider['reimbursement_collection']);
        $reimbursementDocument->shouldReceive('getTotalAmount')->andReturn($dataProvider['reimbursement_total_amount']);

        return $reimbursementDocument;
    }
}
