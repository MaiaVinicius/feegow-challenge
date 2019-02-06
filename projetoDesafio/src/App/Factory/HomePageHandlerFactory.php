<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use App\Handler\Web\HomePageHandler;
use App\Service\EspecialidadeService;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        /** @var EspecialidadeService $especialidadeService */
        $especialidadeService = $container->get(EspecialidadeServiceFactory::class);

        return new HomePageHandler($especialidadeService, $template);
    }
}
