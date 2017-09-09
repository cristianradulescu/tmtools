<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\DocumentStatus;
use AppBundle\Entity\DocumentType;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Reimbursement;
use AppBundle\Entity\ReimbursementType;
use AppBundle\Entity\Travel;
use AppBundle\Entity\TravelDestination;
use AppBundle\Entity\TravelPurpose;
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
     * @param int $id
     * @return JsonResponse
     */
    public function showAction(int $id): JsonResponse
    {
        /** @var Document $document */
        $document = $this->getDoctrine()->getManager()->getRepository(Document::class)
            ->find($id);
        $response = [
            'id' => $document->getId(),
            'employee' => $document->getEmployee()->getFullName(),
            'type' => (string)$document->getType(),
            'status' => (string)$document->getStatus(),
        ];
        if ($document->isTravelDocument()) {
            $travel = $document->getTravel();
            return new JsonResponse(array_merge(
                $response,
                [
                    'date_start' => $travel->getDateStart()->format('Y-m-d'),
                    'date_end' => (string)$travel->getDateEnd()->format('Y-m-d'),
                    'destination' => (string)$travel->getDestination(),
                    'purpose' => (string)$travel->getPurpose()
                ]
            ));
        }
        if ($document->isReimbursementDocument()) {
            $reimbursements = $document->getReimbursements();
            $response['reimbursements'] = [];

            /** @var Reimbursement $reimbursement */
            foreach ($reimbursements as $reimbursement) {
                $response['reimbursements'][] = [
                    'type' => (string)$reimbursement->getType(),
                    'value' => $reimbursement->getValue(),
                    'date' => $reimbursement->getDate()->format('Y-m-d'),
                    'number' => $reimbursement->getNumber()
                ];
            }

            return new JsonResponse($response);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        $doctrineManager = $this->getDoctrine()->getManager();
        $params = $request->request->all();

        try {
            $employee = $doctrineManager->getRepository(Employee::class)->find($params['employee_id']);
            $type = $doctrineManager->getRepository(DocumentType::class)->find($params['type_id']);

            $document = (new Document())
                ->setEmployee($employee)
                ->setStatus(
                    $doctrineManager->getRepository(DocumentStatus::class)->find(DocumentStatus::STATUS_NEW)
                )
                ->setType($type);

            if ($document->isTravelDocument()) {
                $travelParams = $params['travel'];
                $travel = $this->createTravelForDocument($document, $travelParams);
                $document->setTravel($travel);
            } elseif ($document->isReimbursementDocument()) {
                $reimbursementParams = $params['reimbursement'];
                $reimbursement = $this->createReimbursementForDocument($document, $reimbursementParams);
                $document->addReimbursement($reimbursement);
            }

            $doctrineManager->persist($document);
            $doctrineManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

        return new JsonResponse(['id' => $document->getId()]);
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

    /**
     * @param Document $document
     * @param array $travelDetails
     * @return Travel
     */
    protected function createTravelForDocument(Document $document, array $travelDetails) : Travel
    {
        $doctrineManager = $this->getDoctrine()->getManager();
        $destination = $doctrineManager->getRepository(TravelDestination::class)
            ->find($travelDetails['destination_id']);
        $purpose = $doctrineManager->getRepository(TravelPurpose::class)
            ->find($travelDetails['purpose_id']);

        return (new Travel())
            ->setDocument($document)
            ->setEmployee($document->getEmployee())
            ->setDestination($destination)
            ->setPurpose($purpose)
            ->setDateStart(new \DateTime($travelDetails['date_start']))
            ->setDateEnd(new \DateTime($travelDetails['date_start']))
            ->setDepartureLeaveTime(new \DateTime($travelDetails['departure_leave_time']))
            ->setDepartureArrivalTime(new \DateTime($travelDetails['departure_arrival_time']))
            ->setDestinationLeaveTime(new \DateTime($travelDetails['destination_leave_time']))
            ->setDestinationArrivalTime(new \DateTime($travelDetails['destination_arrival_time']));
    }

    /**
     * @param Document $document
     * @param array $reimbursementDetails
     * @return Reimbursement
     */
    protected function createReimbursementForDocument(Document $document, array $reimbursementDetails) : Reimbursement
    {
        $doctrineManager = $this->getDoctrine()->getManager();
        $employee = $doctrineManager->getRepository(Employee::class)
            ->find($reimbursementDetails['employee_id']);
        $type = $doctrineManager->getRepository(ReimbursementType::class)
            ->find($reimbursementDetails['type_id']);

        return (new Reimbursement())
            ->setDocument($document)
            ->setEmployee($employee)
            ->setType($type)
            ->setNumber($reimbursementDetails['number'])
            ->setValue($reimbursementDetails['value'])
            ->setDate(new \DateTime($reimbursementDetails['date']));
    }
}
