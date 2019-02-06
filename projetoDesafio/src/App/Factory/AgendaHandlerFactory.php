<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use App\Handler\Web\AgendaHandler;
use App\Service\AgendaService;

class AgendaHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        /** @var AgendaService $agendaService */
        $agendaService   = $container->get(AgendaServiceFactory::class);

        return new AgendaHandler($agendaService, $template);
    }
}
