<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;

class HttpService 
{
    private $url;
    private $token;
    private $headers;

    public function __construct()
    {
        $this->url = config('feegow.api.url');
        $this->token = config('feegow.api.token');

        $this->headers = [
            'x-access-token' => $this->token
        ];
    }

    public function get($endpoint, $datas = null)
    {
        $vars = '';

        $firstData = true;
        if ($datas) {
            foreach($datas as $key => $data) {
                $symbol = '&';
                if ($firstData) {
                    $symbol = '?';
                    $firstData = false;
                }

                $vars .= $symbol . $key . '=' . $data;
            }
        }
        
        $response = Http::withHeaders($this->headers)
            ->get($this->url . $endpoint . $vars);

        return $this->getResponse($response);
    }

    public function post($endpoint, $data)
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->url . $endpoint, $data);
        
        return $this->getResponse($response);
    }

    public function getResponse($response)
    {
        if ($response->status() == Response::HTTP_OK) {
            return $response;
        } else {
            Log::error('SERVICE ERROR: ' . $response->status());
            throw new \Exception();
        }
    }
}