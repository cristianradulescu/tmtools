<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TravelDocument;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class TravelDocumentController extends CRUDController
{
    /**
     * Generate a zip file with the travel documents.
     *
     * SVG format does not supports multiple pages, thus we need to serve all the files in a zip archive.
     *
     * @return BinaryFileResponse
     */
    public function generateAction()
    {
        /** @var TravelDocument $travelDocument */
        $travelDocument = $this->admin->getSubject();
        $pages['ordin_de_deplasare_p1.svg'] = $this->render(
            'AppBundle:svg:ordin_de_deplasare_p1.svg.twig',
            array(
                'PLACEHOLDER_COST_CENTER' => $travelDocument->getEmployee()->getCompany()->getCostCenter(),
                'PLACEHOLDER_EMPLOYEE_NAME' => $travelDocument->getEmployee()->getFullName(),
                'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $travelDocument->getEmployee()->getJobTitle(),
                'PLACEHOLDER_TRAVEL_PURPOSE' => $travelDocument->getPurpose(),
                'PLACEHOLDER_TRAVEL_DESTINATION' => $travelDocument->getDestination(),
                'PLACEHOLDER_COMPANY_NAME' => $travelDocument->getEmployee()->getCompany()->getName(),
                'PLACEHOLDER_EMPLOYEE_DETAILS' => $travelDocument->getEmployee()->getPersonalNumericCode(),
                'PLACEHOLDER_DATE_FROM' => $travelDocument->getDateStart()->format('d.m.Y'),
                'PLACEHOLDER_DATE_TO' => $travelDocument->getDateEnd()->format('d.m.Y'),
                'PLACEHOLDER_DESTINATION_ARRIVAL_TIME' => $travelDocument->getDestinationArrivalTime()->format('d.m.Y H:i'),
                'PLACEHOLDER_DESTINATION_LEAVE_TIME' => $travelDocument->getDestinationLeaveTime()->format('d.m.Y H:i'),
            )
        );

        $pages['ordin_de_deplasare_p2.svg'] = $this->render(
            'AppBundle:svg:ordin_de_deplasare_p2.svg.twig',
            array(
                'PLACEHOLDER_STARTPOINT_LEAVE_TIME' => $travelDocument->getDepartureLeaveTime()->format('d.m.Y H:i'),
                'PLACEHOLDER_STARTPOINT_ARRIVAL_TIME' => $travelDocument->getDepartureArrivalTime()->format('d.m.Y H:i'),
                'PLACEHOLDER_DOCUMENT_TYPE' => 'Diurna 1 zi',
                'PLACEHOLDER_AMOUNT' => '32.5',
                'PLACEHOLDER_TOTAL_AMOUNT' => '32.5',
                'PLACEHOLDER_MANAGER_LAST_NAME' => $travelDocument->getEmployee()->getCompany()->getDivisionManager()->getLastName(),
                'PLACEHOLDER_MANAGER_FIRST_NAME' => $travelDocument->getEmployee()->getCompany()->getDivisionManager()->getFirstName(),
                'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $travelDocument->getEmployee()->getLastName(),
                'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $travelDocument->getEmployee()->getFirstName()
            )
        );

        // create zip file to download both pages at once
        $zipFileName = 'travel_documents_'.date('YmdHis').'.zip';
        $zip = new \ZipArchive();
        $zip->open($zipFileName, \ZipArchive::CREATE);
        foreach ($pages as $filename => $page) {
            $zip->addFromString($filename, $page->getContent());
        }
        $zipFilePath = $zip->filename;
            $zip->close();

        $response = new BinaryFileResponse($zipFilePath);
        $response->deleteFileAfterSend(true);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $zipFileName);

        return $response;
    }
}