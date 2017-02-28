<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\DocumentStatus;
use AppBundle\Entity\Reimbursement;
use AppBundle\Entity\Travel;
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
     * Return the corresponding service identifier.
     *
     * @return string
     */
    protected function getServiceId()
    {
        return 'app.'.$this->admin->getSubject()->getTypeUniqueId();
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
        /** @var Document $document */
        $document = $this->admin->getSubject();

        /** @var DocumentService $documentService */
        $documentService = $this->get($this->getServiceId());

        return $this->render(
            'AppBundle:Documents:'.$document->getTypeUniqueId().'.svg.twig',
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
     * Generate a simple html table report, to be copy/pasted in an email.
     *
     * @param ProxyQueryInterface $selectedModelQuery
     * @param Request|null $request
     * @return Response
     */
    public function batchActionGenerateExpensesReport(ProxyQueryInterface $selectedModelQuery, Request $request = null)
    {
        $selectedModels = $selectedModelQuery->execute();
        $report = array();

        try {
            /** @var Document $document **/
            foreach ($selectedModels as $document) {
                if ($document->isReimbursementDocument()) {
                    $report = array_merge($report, $this->generateReimbursementExpensesReportByDocument($document));
                }
                if ($document->isTravelDocument() && $document->hasTravel()) {
                    $report = array_merge($report, $this->generateTravelExpensesReportByDocument($document));
                }
            }
        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', $e->getMessage());

            return new RedirectResponse(
                $this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters()))
            );
        }

        return $this->render(
            'AppBundle::document_expenses_report.html.twig',
            array('report' => $report)
        );
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

    /**
     * @param Document $document
     * @return array
     */
    protected function generateReimbursementExpensesReportByDocument(Document $document)
    {
        $reimbursementsReport = array();
        $reimbursementReport = array();
        $reimbursementReport['employee'] = (string) $document->getEmployee();

        /** @var Reimbursement $reimbursement */
        foreach ($document->getReimbursements() as $reimbursement) {
            $reimbursementReport['type'] = $this->trans(
                (string) $reimbursement->getType(),
                array(),
                'messages',
                'ro'
            );
            $reimbursementReport['amount'] = (string) $reimbursement->getValue();
            $reimbursementsReport[] = $reimbursementReport;
        }

        return $reimbursementsReport;
    }

    /**
     * @param Document $document
     * @return array
     */
    protected function generateTravelExpensesReportByDocument(Document $document)
    {
        $travelReport = array();
        $travelReport['employee'] = (string) $document->getEmployee();

        /** @var Travel $travel */
        $travel = $document->getTravel();
        $travelReport['type'] = $this->trans(
            'Travel allowance %nb_days% days',
            array('%nb_days%' => $travel->getNumberOfDaysOnTravel()),
            'messages',
            'ro'
        );
        $travelReport['amount'] = (string) 32.5 * $travel->getNumberOfDaysOnTravel();

        return array($travelReport);
    }
}
