<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TravelDocument;
use AppBundle\Service\TravelDocumentService;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class TravelDocumentController
 * @package AppBundle\Controller
 */
class TravelDocumentController extends DocumentController
{
    /**
     * @return string
     */
    protected function getDocumentTemplate()
    {
        return 'AppBundle:svg:ordin_de_deplasare.svg.twig';
    }

    /**
     * @return string
     */
    protected function getServiceId()
    {
        return TravelDocumentService::SERVICE_ID;
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
