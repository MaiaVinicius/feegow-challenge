<?php

namespace App\Controller;

use App\Service\FeegowApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfissionaisController extends AbstractController
{
    /**
     * @var FeegowApiService
     */
    private $service;

    public function __construct(FeegowApiService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/", name="profissionais")
     */
    public function index()
    {
        $especialidades = $this->service->request('GET', '/specialties/list');
        return $this->render('profissionais/index.html.twig', compact('especialidades'));
    }
}
