<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FeegowApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function request(string $method, string $url, $data = null)
    {
        $baseUrl = 'http://clinic5.feegow.com.br/components/public/api';
        $request = new Request($method, $baseUrl . $url, [
            'x-access-token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38',
            'content-type' => 'application/json'
        ], $data);

        $response = $this->client->send($request);
        if ($response->getStatusCode() > 399) {
            throw new \DomainException($response->getBody(), $response->getStatusCode());
        }

        $responseData = json_decode($response->getBody());
        return $responseData->content;
    }
}
