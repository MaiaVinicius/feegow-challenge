<?php

declare(strict_types=1);

namespace App\Factory;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Zend\Http\Client;

use App\Service\AgendaService;

class AgendaServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Client; $clientRequest */
        $clientRequest   = $container->get('ClientRequest');
        $entityManager   = $container->get(EntityManagerInterface::class);
        $config = $container->get("config");

        return new AgendaService($entityManager, $clientRequest, $config['config_feegow']['endpoint']);
    }
}
