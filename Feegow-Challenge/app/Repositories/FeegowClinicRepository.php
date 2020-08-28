<?php


namespace App\Repositories;


use App\Clients\FeegowClient;

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

        $response = $this->client->request('GET', 'specialties/list');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function professional(){
        
        $response = $this->client->request('GET', 'professional/list');
        return json_decode($response->getBody()->getContents(), true);

    }

    public function sources(){
        
        $response = $this->client->request('GET', 'patient/list-sources');
        return json_decode($response->getBody()->getContents(), true);
    }


}
