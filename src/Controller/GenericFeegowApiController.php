<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenericFeegowApiController extends AbstractController
{
    /**
     * @Route("/api/{sufixo}", name="generic_feegow_api")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return new JsonResponse([
            'path' => $request->getPathInfo()
        ]);
    }
}
