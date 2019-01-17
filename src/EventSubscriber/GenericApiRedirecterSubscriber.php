<?php

namespace App\EventSubscriber;

use App\Service\FeegowApiService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class GenericApiRedirecterSubscriber implements EventSubscriberInterface
{
    /**
     * @var FeegowApiService
     */
    private $service;

    public function __construct(FeegowApiService $service)
    {
        $this->service = $service;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'redirecionaParaApi'
        ];
    }

    public function redirecionaParaApi(FilterResponseEvent $event)
    {
        $pathInfo = $event->getRequest()->getPathInfo();

        if (mb_strpos($pathInfo, '/api') === false) {
            return;
        }

        $apiResponse = $this->service->request('GET', str_replace('/api', '', $pathInfo));

        $response = new JsonResponse($apiResponse, 200, ['X-Status-Code' => 200]);
        $event->setResponse($response);
    }
}