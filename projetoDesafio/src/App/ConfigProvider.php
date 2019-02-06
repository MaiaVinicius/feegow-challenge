<?php

declare(strict_types=1);

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Zend\Http\Client;
use Zend\Http\Headers;

use App\Factory\AgendaHandlerFactory;
use App\Factory\AgendaServiceFactory;
use App\Factory\ProfissionalServiceFactory;
use App\Handler\Web\AgendaHandler;
use App\Factory\EspecialidadeServiceFactory;
use App\Factory\HomePageHandlerFactory;
use App\Factory\ProfissionalHandlerFactory;
use App\Handler\Api\PingHandler;
use App\Handler\Web\HomePageHandler;
use App\Factory\PersistSolicitaHorarioHandlerFactory;
use App\Handler\Api\PersistSolicitaHorarioHandler;
use App\Handler\Web\ProfissionalHandler;

class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                PingHandler::class => Handler\Api\PingHandler::class,
            ],
            'factories' => [
                HomePageHandler::class => HomePageHandlerFactory::class,

                ProfissionalHandler::class => ProfissionalHandlerFactory::class,
                ProfissionalServiceFactory::class => ProfissionalServiceFactory::class,

                AgendaHandler::class => AgendaHandlerFactory::class,
                AgendaServiceFactory::class => AgendaServiceFactory::class,

                EspecialidadeServiceFactory::class => EspecialidadeServiceFactory::class,

                PersistSolicitaHorarioHandler::class => PersistSolicitaHorarioHandlerFactory::class,

                'ClientRequest' => function (ContainerInterface $container) {
                    $config = $container->get("config");
                    $headerObject = new Headers();
                    $headerObject->addHeaders(['x-access-token' => $config['config_feegow']['token']]);
                    $client = new Client();
                    $client->setHeaders($headerObject);

                    return $client;
                },

                EntityManagerInterface::class => function (ContainerInterface $container) {
                    $config = Setup::createXMLMetadataConfiguration(
                        array(__DIR__ . '/Mapping'),
                        true,
                        null,
                        null
                    );

                    $configConnection = $container->get("config");

                    $entityManager = EntityManager::create($configConnection['connection'], $config);
                    return $entityManager;
                }

            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => ['templates/app'],
                'error' => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
