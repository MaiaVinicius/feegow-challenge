<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Zend\Http\Client;

use App\Service\EspecialidadeService;

class EspecialidadeServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Client; $clientRequest */
        $clientRequest = $container->get('ClientRequest');
        $config = $container->get("config");
        return new EspecialidadeService($clientRequest, $config['config_feegow']['endpoint']);
    }
}
