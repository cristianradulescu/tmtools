<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReinbursementDocument;
use AppBundle\Service\ReinbursementDocumentService;
use Sonata\AdminBundle\Controller\CRUDController;

/**
 * Class ReinbursementDocumentController
 * @package AppBundle\Controller
 */
class ReinbursementDocumentController extends CRUDController
{
    /**
     * Generate a file with the reinbursement documents.
     *
     * The file is in SVG format and it is served directly, in order to be used for print.
     *
     * @return Response
     */
    public function printAction()
    {
        /** @var ReinbursementDocument $reinbursementDocument */
        $reinbursementDocument = $this->admin->getSubject();

        /** @var ReinbursementDocumentService $reinbursementDocumentService */
        $reinbursementDocumentService = $this->get('app.reinbursement_document');

        return $this->render(
            'AppBundle:svg:decont_de_cheltuieli.svg.twig',
            $reinbursementDocumentService->fillPlaceholders($reinbursementDocument)
        );
    }
}

