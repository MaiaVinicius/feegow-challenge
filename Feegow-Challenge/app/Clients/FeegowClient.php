<?php


namespace App\Clients;


use GuzzleHttp\Client;

class FeegowClient
{
    private $endpoint;

    private $client;
    private $token;

    /**
     * DailyPlanetClient constructor.
     * @throws \ErrorException
     */
    public function __construct()
    {
        $this->endpoint = env('FEEGOW_API_URL');
        if(!$this->endpoint) throw new \ErrorException('feegow url was not defined');

        $this->token = env('FEEGOW_TOKEN');
        if(!$this->token) throw new \ErrorException('feegow token was not defined');

        $this->client = new Client();
    }

    public function request($method, $path){
        return $this->client->request($method, $this->endpoint.$path, ['headers' =>  ['x-access-token' => $this->token]]);
    }
}
