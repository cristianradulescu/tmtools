<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class EmployeeApiController
 * @package AppBundle\Controller
 */
class EmployeeApiController extends ApiController
{
    /**
     * @var string
     */
    protected $tableAlias = 'e';

    /**
     * @return JsonResponse
     */
    public function listAction()
    {
        $listFields = [
            $this->tableAlias.'.id',
            $this->tableAlias.'.username'
        ];

        $employees = $this->getDoctrine()->getManager()->getRepository(Employee::class)
            ->createQueryBuilder($this->tableAlias)
            ->select($listFields)
            ->getQuery()
            ->getResult();

        return new JsonResponse($employees);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function showAction($id)
    {
        $showFields = [
            $this->tableAlias.'.id',
            $this->tableAlias.'.username',
            $this->tableAlias.'.firstName',
            $this->tableAlias.'.lastName',
            $this->tableAlias.'.personalNumericCode',
            $this->tableAlias.'.identityCardNumber',
        ];

        $employee = $this->getDoctrine()->getManager()->getRepository(Employee::class)
            ->createQueryBuilder($this->tableAlias)
            ->select($showFields)
            ->where($this->tableAlias.'.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        return new JsonResponse($employee);
    }
}
