<?php

declare(strict_types=1);

namespace App\Handler\Api;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

use App\Entity\SolicitaHorario;
use App\Service\AgendaService;

class PersistSolicitaHorarioHandler implements RequestHandlerInterface
{
    /**
     * @var AgendaService
     */
    private $agendaService;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PersistSolicitaHorarioHandler constructor.
     * @param AgendaService $agendaService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(AgendaService $agendaService, EntityManagerInterface $entityManager)
    {
        $this->agendaService = $agendaService;
        $this->entityManager = $entityManager;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bodyContent = json_decode($request->getBody()->getContents());

        try {
            if (!$bodyContent) {
                throw new \ParseError('Não foi passada as informações', 400);
            }

            $this->entityManager->beginTransaction();
            /** @var SolicitaHorario $solicitaHorario */
            $solicitaHorario = (new \JsonMapper())->map($bodyContent, new SolicitaHorario());
            $solicitaHorario->setDateTime(new \DateTime());

            $this->agendaService->persistSolicitarHorario($solicitaHorario);
            $this->entityManager->commit();
            return new JsonResponse([], 201);
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $statusCode = ($e->getCode() > 100) ? $e->getCode() : 500;
            return new JsonResponse(['Ocorreu um erro na hora de gravar o horário'], $statusCode);
        } catch (\ParseError $parser) {
            $statusCode = ($parser->getCode() > 100) ? $parser->getCode() : 500;
            return new JsonResponse(['A informação passada não é válida'], $statusCode);
        }
        //docker exec -it php_web ./vendor/bin/doctrine orm:schema-tool:update --force
    }
}
