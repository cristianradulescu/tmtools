<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TravelDocument;
use AppBundle\Service\TravelDocumentService;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class TravelDocumentController
 * @package AppBundle\Controller
 */
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

        /** @var TravelDocumentService $travelDocumentService */
        $travelDocumentService = $this->get('app.travel_document');
        $placeholders = $travelDocumentService->fillPlaceholders($travelDocument);

        $pages['ordin_de_deplasare_p1.svg'] = $this->render(
            'AppBundle:svg:ordin_de_deplasare_p1.svg.twig',
            $placeholders['ordin_de_deplasare_p1.svg']
        );

        $pages['ordin_de_deplasare_p2.svg'] = $this->render(
            'AppBundle:svg:ordin_de_deplasare_p2.svg.twig',
            $placeholders['ordin_de_deplasare_p2.svg']
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