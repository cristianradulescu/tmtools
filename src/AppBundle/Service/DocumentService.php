<?php

namespace AppBundle\Service;

use AppBundle\Entity\Company;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Document;

/**
 * Class DocumentService
 * @package AppBundle\Service
 */
abstract class DocumentService
{
    /**
     * @var Employee
     */
    protected $employee;

    /**
     * @var Company
     */
    protected $company;

    /**
     * @return Employee
     */
    protected function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @return Company
     */
    protected function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Document $document
     * @return array
     */
    public function fillPlaceholders(Document $document)
    {
        $this->employee = $document->getEmployee();
        $this->company = $this->employee->getCompany();

        return array();
    }
}
