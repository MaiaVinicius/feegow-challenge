<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use App\Service\ProfissionalService;
use App\Handler\Web\ProfissionalHandler;

class ProfissionalHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        /** @var ProfissionalService $especialidadeService */
        $profissionalService   = $container->get(ProfissionalServiceFactory::class);

        return new ProfissionalHandler($profissionalService, $template);
    }
}
