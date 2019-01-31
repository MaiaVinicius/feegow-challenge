<?php

namespace App\Services\FeeGowAPIService;
use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 29/01/19
 * Time: 20:24
 */
class FeeGowAPIService
{
    private $client;
    const URL_LIST_SOURCES = 'patient/list-sources';
    const URL_LIST_PROFESSIONALS = 'professional/list';
    const URL_LIST_SPECIALTIES = 'specialties/list';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://clinic5.feegow.com.br/components/public/api/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'x-access-token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38',
                'Access-Control-Allow-Origin' => '*',
            ],
        ]);
    }

    public function get($url, $queryString = [])
    {
        if($queryString){
            $queryString = ['query' => $queryString];
        }
        $response = $this->client->get($url, $queryString);
        return json_decode($response->getBody()->getContents());
    }
}