<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 * @package AppBundle\Controller
 */
abstract class ApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    abstract public function listAction() : JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    abstract public function showAction($id) : JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    abstract public function createAction(Request $request) : JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    abstract public function updateAction(Request $request) : JsonResponse;


}
