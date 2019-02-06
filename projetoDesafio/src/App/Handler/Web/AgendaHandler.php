<?php

declare(strict_types=1);

namespace App\Handler\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

use App\Service\AgendaService;

class AgendaHandler implements RequestHandlerInterface
{
    /** @var AgendaService */
    private $agendaService;

    /** @var null|TemplateRendererInterface */
    private $template;

    /**
     * AgendaHandler constructor.
     * @param AgendaService $agendaService
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(
        AgendaService $agendaService,
        ?TemplateRendererInterface $template = null
    ) {
        $this->agendaService = $agendaService;
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
            $listOrigem = $this->agendaService->getListOrigens();
            return new HtmlResponse(
                $this->template->render('app::agenda', ['listOrigem' => $listOrigem, 'layout' => false])
            );
        } catch (\Exception $e) {
            $statusCode = ($e->getCode() > 100) ? $e->getCode() : 500;
            return new HtmlResponse($e->getMessage(), $statusCode);
        }
    }
}
