<?php

namespace App\Controller;

use App\Entity\Formulario;
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
        $form = new Formulario();
        $form
            ->setNome($request->request->get('nome'))
            ->setCpf($request->request->get('cpf'))
            ->setDataNascimento(new \DateTime($request->request->get('nascimento')))
            ->setIdOrigem($request->request->get('origem'))
            ->setIdEspecialidade($request->request->get('especialidade'))
            ->setIdProfissional($request->request->get('profissional'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($form);
        $em->flush();

        return new Response('', 201);
    }
}
