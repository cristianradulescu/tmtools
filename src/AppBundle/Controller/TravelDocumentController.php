<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Status;
use AppBundle\Entity\TravelDocument;
use AppBundle\Service\TravelDocumentService;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render(
            'AppBundle:svg:ordin_de_deplasare.svg.twig',
            $travelDocumentService->fillPlaceholders($travelDocument)
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

    /**
     * @param ProxyQueryInterface $selectedModelQuery
     * @param Request|null $request
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function batchActionMarkStatusPending(ProxyQueryInterface $selectedModelQuery, Request $request = null)
    {
        return $this->changeStatus($selectedModelQuery, Status::STATUS_ID_PENDING);
    }

    /**
     * @param ProxyQueryInterface $selectedModelQuery
     * @param Request|null $request
     * @return RedirectResponse
     */
    public function batchActionMarkStatusCompleted(ProxyQueryInterface $selectedModelQuery, Request $request = null)
    {
        return $this->changeStatus($selectedModelQuery, Status::STATUS_ID_COMPLETED);
    }

    /**
     * Common method used for status change batch actions.
     *
     * TODO: Move this to a common controller class. It can be used for Reimbursement Document also.
     *
     * @param ProxyQueryInterface $selectedModelQuery
     * @param $statusId
     * @return RedirectResponse
     *
     * @throws \Exception If an error occurs during the update process.
     */
    protected function changeStatus(ProxyQueryInterface $selectedModelQuery, $statusId)
    {
        $modelManager = $this->admin->getModelManager();
        $selectedModels = $selectedModelQuery->execute();
        /** @var Status $status */
        $status = $this->get('doctrine.orm.entity_manager')->find('AppBundle\Entity\Status', $statusId);

        try {
            /** @var TravelDocument $selectedModel **/
            foreach ($selectedModels as $selectedModel) {
                $selectedModel->setStatus($status);
                $modelManager->update($selectedModel);
            }

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', $e->getMessage());

            return new RedirectResponse(
                $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
            );
        }

        $this->addFlash('sonata_flash_success', 'Status succesfully changed to '.$status->getName());

        return new RedirectResponse(
            $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
        );
    }
}