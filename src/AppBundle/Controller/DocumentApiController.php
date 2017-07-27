<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\Travel;
use AppBundle\Service\DocumentService;
use AppBundle\Service\ReimbursementDocumentService;
use AppBundle\Service\TravelDocumentService;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DocumentApiController
 * @package AppBundle\Controller
 */
class DocumentApiController extends Controller implements CrudController
{
    /**
     * @return JsonResponse
     */
    public function listAction() : JsonResponse
    {
        $listFields = [
            'd.id',
            'e.username as user',
            't.name as type',
            's.name as status',

        ];
        $reimbursementlistFields = [
            'SUM(doc.value) as total'
        ];
        $travelListFields = [
            '(DATE_DIFF(doc.dateEnd, doc.dateStart) + 1) * '.Travel::TRAVEL_ALLOWANCE.' as total'
        ];

        /** @var EntityRepository $documentRepository */
        $documentRepository = $this->getDoctrine()->getManager()->getRepository(Document::class);
        $reimbursementDocuments = $documentRepository
            ->createQueryBuilder('d')
            ->join('d.employee', 'e')
            ->join('d.type', 't')
            ->join('d.status', 's')
            ->join('d.reimbursements', 'doc')
            ->select(array_merge($listFields, $reimbursementlistFields))
            ->groupBy('doc.document')
            ->getQuery()
            ->getResult();
        $travelDocuments = $documentRepository
            ->createQueryBuilder('d')
            ->join('d.employee', 'e')
            ->join('d.type', 't')
            ->join('d.status', 's')
            ->join('d.travel', 'doc')
            ->select(array_merge($listFields, $travelListFields))
            ->getQuery()
            ->getResult();

        return new JsonResponse(array_merge($reimbursementDocuments, $travelDocuments));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function showAction($id): JsonResponse
    {
        return new JsonResponse('TO DO');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        return new JsonResponse('TO DO');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateAction(Request $request): JsonResponse
    {
        return new JsonResponse('TO DO');
    }

    /**
     * @param int $id
     * @return Response
     */
    public function printAction($id) : Response
    {
        /** @var Document $document */
        $document = $this->getDoctrine()->getManager()->getRepository(Document::class)->find($id);

        /** @var DocumentService|TravelDocumentService|ReimbursementDocumentService $documentService */
        $documentService = $this->get(
            'app.'.str_replace(' ', '_', strtolower($document->getType())).'_document'
        );

        return $this->render(
            'AppBundle:Documents:'.$documentService::DOCUMENT_TEMPLATE.'.twig',
            $documentService->fillPlaceholders($document)
        );
    }
}
