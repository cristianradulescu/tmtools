<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DocumentInterface;
use AppBundle\Entity\Status;
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
abstract class DocumentController extends CRUDController
{
    /**
     * Return the template used for document rendering.
     *
     * @return string
     */
    abstract protected function getDocumentTemplate();

    /**
     * Return the corresponding service identifier.
     *
     * @return string
     */
    abstract protected function getServiceId();

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
