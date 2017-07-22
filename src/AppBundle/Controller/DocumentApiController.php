<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\Travel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DocumentApiController
 * @package AppBundle\Controller
 */
class DocumentApiController extends ApiController
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

        $reimbursementDocuments = $this->getDoctrine()->getManager()->getRepository(Document::class)
            ->createQueryBuilder('d')
            ->join('d.employee', 'e')
            ->join('d.type', 't')
            ->join('d.status', 's')
            ->join('d.reimbursements', 'doc')
            ->select(array_merge($listFields, $reimbursementlistFields))
            ->groupBy('doc.document')
            ->getQuery()
            ->getResult();

        $travelDocuments = $this->getDoctrine()->getManager()->getRepository(Document::class)
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
        // TODO: Implement showAction() method.
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        // TODO: Implement createAction() method.
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateAction(Request $request): JsonResponse
    {
        // TODO: Implement updateAction() method.
    }
}
