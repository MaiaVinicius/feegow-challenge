<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Handler\Api\PersistSolicitaHorarioHandler;
use App\Service\AgendaService;

class PersistSolicitaHorarioHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        /** @var AgendaService $agendaService */
        $agendaService   = $container->get(AgendaServiceFactory::class);
        $entityManager   = $container->get(EntityManagerInterface::class);

        return new PersistSolicitaHorarioHandler($agendaService, $entityManager);
    }
}
