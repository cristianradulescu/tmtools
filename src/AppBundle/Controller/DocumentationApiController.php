<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DocumentationApiController
 * @package AppBundle\Controller
 */
class DocumentationApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function indexAction()
    {
        return new JsonResponse(array('TBD'));
    }
}
