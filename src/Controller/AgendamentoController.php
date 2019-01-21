<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendamentoController extends AbstractController
{
    /**
     * @Route("/agendamento/{idEspecialidade}/{idProfissional}", name="agendamento", methods={"GET"})
     */
    public function index(int $idEspecialidade, int $idProfissional)
    {
        return $this->render('agendamento/index.html.twig', compact('idEspecialidade', 'idProfissional'));
    }

    /**
     * @Route("/agendamento", name="solicitar_agendamento", methods={"POST"})
     */
    public function solicitarAgendamento(Request $request)
    {
        return new Response();
    }
}
