<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DocumentStatus;
use AppBundle\Service\DocumentService;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DocumentController
 * @package AppBundle\Controller
 */
class DocumentController extends CRUDController
{
    /**
     * Return the template used for document rendering.
     *
     * @return string
     */
    protected function getDocumentTemplate()
    {
        return 'AppBundle:Documents:'.$this->admin->getSubject()->getType()->getTemplate().'.twig';
    }

    /**
     * Return the corresponding service identifier.
     *
     * @return string
     */
    protected function getServiceId()
    {
        $documentTypeName = $this->admin->getSubject()->getType()->getName();

        return 'app.'.str_replace(' ', '_', strtolower($documentTypeName)).'_document';
    }

    /**
     * Render the document.
     *
     * The file is in SVG format and it is served directly, in order to be used for print.
     *
     * @return Response
     */
    public function printAction()
    {
        /** @var DocumentInterface $document */
        $document = $this->admin->getSubject();

        /** @var DocumentService $documentService */
        $documentService = $this->get($this->getServiceId());

        return $this->render(
            $this->getDocumentTemplate(),
            $documentService->fillPlaceholders($document)
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
        return $this->changeStatus($selectedModelQuery, DocumentStatus::STATUS_PENDING);
    }

    /**
     * @param ProxyQueryInterface $selectedModelQuery
     * @param Request|null $request
     * @return RedirectResponse
     */
    public function batchActionMarkStatusCompleted(ProxyQueryInterface $selectedModelQuery, Request $request = null)
    {
        return $this->changeStatus($selectedModelQuery, DocumentStatus::STATUS_COMPLETED);
    }

    /**
     * Common method used for status change batch actions.
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
        /** @var DocumentStatus $status */
        $status = $this->get('doctrine.orm.entity_manager')->find('AppBundle\Entity\DocumentStatus', $statusId);

        try {
            /** @var Document $selectedModel **/
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
