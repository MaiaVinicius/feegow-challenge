<?php


namespace App\Repositories;


use App\Client\FeegowClient;

class FeegowClinicRepository
{
    /**
     * @var FeegowClient
     */
    private $client;

    /**
     * FeegowClinicRepository constructor.
     * @param FeegowClient $client
     */
    public function __construct(FeegowClient $client)
    {
        $this->client = $client;
    }

    public function specialty(){
        $response = $this->client->request('GET', '/specialties/list');

        return $response->getBody()->getContents();
    }

    public function professional(){
        $response = $this->client->request('GET', '/professional/list');

        return $response->getBody()->getContents();
    }

    public function sources(){
        $response = $this->client->request('GET', '/patient/list-sources');

        return $response->getBody()->getContents();
    }


}
