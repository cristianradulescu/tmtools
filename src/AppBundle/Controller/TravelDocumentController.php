<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TravelDocument;
use AppBundle\Service\TravelDocumentService;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TravelDocumentController
 * @package AppBundle\Controller
 */
class TravelDocumentController extends CRUDController
{
    /**
     * Generate a file with the travel documents.
     *
     * The file is in SVG format and it is served directly, in order to be used for print.
     *
     * @return Response
     */
    public function printAction()
    {
        /** @var TravelDocument $travelDocument */
        $travelDocument = $this->admin->getSubject();

        /** @var TravelDocumentService $travelDocumentService */
        $travelDocumentService = $this->get('app.travel_document');
        $placeholders = $travelDocumentService->fillPlaceholders($travelDocument);

        return $this->render(
            'AppBundle:svg:ordin_de_deplasare.svg.twig',
            $placeholders['ordin_de_deplasare.svg']
        );
    }

    /**
     * Clone the travel document in order to change it's details.
     *
     * This is useful when you need to create travel documents with the same details for more employees. The action
     * redirects to the edit page for the cloned object, in order to allow the user to edit the details.
     *
     * @return RedirectResponse
     */
    public function cloneAction()
    {
        /** @var TravelDocument $object */
        $object = $this->admin->getSubject();
        $clonedObject = clone $object;
        $clonedObject = $this->admin->create($clonedObject);

        $this->addFlash(
            'sonata_flash_success',
            'The travel document was successfully cloned. Please edit the details of the new document.'
        );
        return new RedirectResponse($this->admin->generateUrl('edit', array('id' => $clonedObject->getId())));
    }
}