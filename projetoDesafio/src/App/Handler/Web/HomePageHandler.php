<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

use App\Service\EspecialidadeService;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var EspecialidadeService */
    private $especialidadeService;

    /** @var TemplateRendererInterface|null */
    private $template;

    /**
     * HomePageHandler constructor.
     * @param EspecialidadeService $especialidadeService
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(
        EspecialidadeService $especialidadeService,
        ?TemplateRendererInterface $template = null
    ) {
        $this->especialidadeService = $especialidadeService;
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $listEspecialidades = $this->especialidadeService->getListEspecialidade();
            return new HtmlResponse(
                $this->template->render(
                    'app::home-page', ['listEspecialidades' => $listEspecialidades]
                )
            );
        } catch (\Exception $e) {
            $statusCode = ($e->getCode() > 100) ? $e->getCode() : 500;
            return new HtmlResponse($e->getMessage(), $statusCode);
        }
    }
}
