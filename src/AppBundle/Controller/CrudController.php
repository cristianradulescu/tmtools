<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface CrudController
 * @package AppBundle\Controller
 */
interface CrudController
{
    /**
     * @return JsonResponse
     */
    public function listAction() : JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function showAction(int $id) : JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request) : JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateAction(Request $request) : JsonResponse;
}
