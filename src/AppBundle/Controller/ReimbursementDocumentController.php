<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReimbursementDocument;
use AppBundle\Service\ReimbursementDocumentService;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ReimbursementDocumentController
 * @package AppBundle\Controller
 */
class ReimbursementDocumentController extends CRUDController
{
    /**
     * Generate a file with the reimbursement documents.
     *
     * The file is in SVG format and it is served directly, in order to be used for print.
     *
     * @return Response
     */
    public function printAction()
    {
        /** @var ReimbursementDocument $reimbursementDocument */
        $reimbursementDocument = $this->admin->getSubject();

        /** @var ReimbursementDocumentService $reimbursementDocumentService */
        $reimbursementDocumentService = $this->get('app.reimbursement_document');

        return $this->render(
            'AppBundle:svg:decont_de_cheltuieli.svg.twig',
            $reimbursementDocumentService->fillPlaceholders($reimbursementDocument)
        );
    }
}
