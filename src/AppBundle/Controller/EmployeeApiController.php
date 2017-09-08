<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Employee;
use AppBundle\Entity\EmployeeJobTitle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EmployeeApiController
 * @package AppBundle\Controller
 */
class EmployeeApiController extends Controller implements CrudController
{
    /**
     * @return JsonResponse
     */
    public function listAction() : JsonResponse
    {
        $listFields = [
            'e.id',
            'e.username',
            'e.personalNumericCode',
            'e.identityCardNumber'
        ];


        $employees = $this->getDoctrine()->getManager()->getRepository(Employee::class)
            ->createQueryBuilder('e')
            ->select($listFields)
            ->getQuery()
            ->getResult();

        return new JsonResponse($employees);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function showAction(int $id) : JsonResponse
    {
        $employee = $this->getDoctrine()->getManager()->getRepository(Employee::class)
            ->find($id);

        return new JsonResponse(
            [
                'id' => $employee->getId(),
                'username' => $employee->getUsername(),
                'first_name' => $employee->getFirstName(),
                'last_name' => $employee->getLastName(),
                'personal_numeric_code' => $employee->getPersonalNumericCode(),
                'identity_card_number' => $employee->getIdentityCardNumber()
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request) : JsonResponse
    {
        $doctrineManager = $this->getDoctrine()->getManager();
        $params = $request->request->all();

        try {
            $employee = (new Employee())
                ->setFirstName($params['first_name'])
                ->setLastName(($params['last_name']))
                ->setUsername($params['username'])
                ->setPersonalNumericCode($params['personal_numeric_code'])
                ->setIdentityCardNumber(($params['identity_card_number']));

            $company = $doctrineManager->getRepository(Company::class)->find($params['company_id']);
            $employee->setCompany($company);

            $jobtitle = $doctrineManager->getRepository(EmployeeJobTitle::class)
                ->find($params['job_title_id']);
            $employee->setJobTitle($jobtitle);

            $divisionManager = $doctrineManager->getRepository(Employee::class)
                ->find($params['division_manager_id']);
            $employee->setDivisionManager($divisionManager);

            $doctrineManager->persist($employee);
            $doctrineManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

        return new JsonResponse(['id' => $employee->getId()]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateAction(Request $request) : JsonResponse
    {
        return new JsonResponse('TO DO');
    }
}
