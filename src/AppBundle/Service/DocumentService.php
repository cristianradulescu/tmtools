<?php

namespace AppBundle\Service;

use AppBundle\Entity\Company;
use AppBundle\Entity\Employee;
use AppBundle\Entity\DocumentInterface;

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
     * @param DocumentInterface $entity
     */
    public function fillPlaceholders(DocumentInterface $entity)
    {
        $this->employee = $entity->getEmployee();
        $this->company = $this->employee->getCompany();
    }
}
