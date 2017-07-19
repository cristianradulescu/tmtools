<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DocumentationApiController
 * @package AppBundle\Controller
 */
class DocumentationApiController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function indexAction()
    {
        return new JsonResponse(array('TBD'));
    }
}
