<?php

namespace AppBundle\Controller;

use AppBundle\Service\ReimbursementDocumentService;

/**
 * Class ReimbursementDocumentController
 * @package AppBundle\Controller
 */
class ReimbursementDocumentController extends DocumentController
{
    /**
     * @return string
     */
    protected function getDocumentTemplate()
    {
        return 'AppBundle:svg:decont_de_cheltuieli.svg.twig';
    }

    /**
     * @return string
     */
    protected function getServiceId()
    {
        return ReimbursementDocumentService::SERVICE_ID;
    }
}
