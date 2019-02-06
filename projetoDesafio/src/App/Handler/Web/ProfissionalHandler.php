<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

use App\Service\ProfissionalService;

class ProfissionalHandler implements RequestHandlerInterface
{
    /** @var ProfissionalService */
    private $profissionalService;

    /** @var null|TemplateRendererInterface */
    private $template;

    /**
     * ProfissionalHandler constructor.
     * @param ProfissionalService $profissionalService
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(
        ProfissionalService $profissionalService,
        ?TemplateRendererInterface $template = null
    ) {
        $this->profissionalService = $profissionalService;
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $ativo = null;
        if (isset($request->getQueryParams()['ativo'])) {
            $ativo = (bool)$request->getQueryParams()['ativo'];
        }

        $especialidade = null;
        if (isset($request->getQueryParams()['especialidade'])) {
            $especialidade = (int)$request->getQueryParams()['especialidade'];
        }

        $unidade = null;
        if (isset($request->getQueryParams()['$unidade'])) {
            $unidade = (int)$request->getQueryParams()['$unidade'];
        }

        try {
            $listProfissionais = $this->profissionalService->getListProfissionais($ativo, $unidade, $especialidade);
            return new HtmlResponse(
                $this->template->render(
                    'app::profissional',
                    ['listProfissionais' => $listProfissionais, 'layout' => false]
                )
            );
        }catch (\Exception $e){
            $statusCode = ($e->getCode() > 100) ? $e->getCode() : 500;
            return new HtmlResponse($e->getMessage(), $statusCode);
        }
    }
}
