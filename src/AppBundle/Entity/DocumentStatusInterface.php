<?php

namespace AppBundle\Entity;

/**
 * Interface DocumentStatusInterface
 * @package AppBundle\Entity
 */
interface DocumentStatusInterface
{
    /**
     * @return Status
     */
    public function getStatus();
}