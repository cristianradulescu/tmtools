<?php

namespace AppBundle\Entity;

/**
 * Interface DocumentInterface
 * @package AppBundle\Entity
 */
interface DocumentInterface
{
    /**
     * @return Employee
     */
    public function getEmployee();

    /**
     * @return Employee
     */
    public function getStatus();
}