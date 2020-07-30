<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Services\Response;
use Slim\Http\Request;
use Validator\Validator;

class ConsultaController
{
    public function index(Request $request, Response $response)
    {
        return $response->view('consulta');
    }

    public function store(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $validator = Validator::make($body,
            [
                'name' => 'required',
                'birth_date' => 'required',
                'cpf' => 'required'
            ], [
                'name' => [
                    'required' => 'Este campo é obrigatório'
                ],
                'birthdate' => [
                    'required' => 'Este campo é obrigatório'
                ],
                'cpf' => [
                    'required' => 'Este campo é obrigatório'
                ]
            ]);

        if (!$validator->valid()) 
            return $response->json($validator->fails(), 400);

        try {

            (new Consulta)->create($body);

            return $response->json("Salvo com sucesso!");

        } catch (\Exception $exception) {
            return $response->error("Houve uma falha ao tentar salvar o agendamento da consulta.");
        }
        
    }

}
