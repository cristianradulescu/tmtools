<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class TravelController
 * @package AppBundle\Controller
 */
class TravelController extends CRUDController
{
    /**
     * Duplicate the travel.
     *
     * This is useful when you need to create travels with the same details for more employees. The action
     * redirects to the edit page for the cloned object, in order to allow the user to edit the details.
     *
     * @return RedirectResponse
     */
    public function cloneAction()
    {
        /** @var Travel $object */
        $object = $this->admin->getSubject();
        $clonedObject = clone $object;
        $clonedObject->setDocument(null);
        $clonedObject = $this->admin->create($clonedObject);

        $this->addFlash(
            'sonata_flash_success',
            'The travel was successfully cloned. You can edit the details of the new record.'
        );
        return new RedirectResponse($this->admin->generateUrl('edit', array('id' => $clonedObject->getId())));
    }
}
