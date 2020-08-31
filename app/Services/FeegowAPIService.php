<?php
namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FeegowAPIService
{
    /**
     * base url location
     *
     * @var string
     */
    protected $baseUrl = 'https://api.feegow.com.br/api';

    /**
     * Auth token 
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new FeegowAPIService instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->token = env('FEEGOW_API_TOKEN');
    }

    /**
     * Fetch professional list from Feegow API
     *
     * @return array
     */
    public function professional($search = null)
    {
        return $this->sendRequest('/professional/list', null, $search);
    }

    /**
     * Fetch patients sources list from Feegow API
     *
     * @return array
     */
    public function patientSources()
    {
        return $this->sendRequest('/patient/list-sources');
    }

    /**
     * Fetch patients sources list from Feegow API
     *
     * @return array
     */
    public function specialtyList()
    {
        return $this->sendRequest('/specialties/list');
    }

    /**
     * Create a request according to http method
     *
     * @param string $endpoint
     * @param string $method
     * @param array $data
     * @return array
     */
    protected function sendRequest($endpoint, $method = 'GET', $data = null)
    {   
        $response = Http::withHeaders(['x-access-token' => $this->token]);

        switch ($method) {
            case 'GET':
                $response = $response->get($this->buildRequestUrl($endpoint), $data);
                break;
            case 'POST':
                $response = $response->post($this->buildRequestUrl($endpoint), $data);
                break;
            default:
                $response = $response->get($this->buildRequestUrl($endpoint), $data);
                break;
        }
     
        return $this->returnResults($response);
    }

    /**
     * Return response body or throw error
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array
     * 
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function returnResults(Response $response)
    {
        $response = $response->throw();
        return $response['content'];
    }

    /**
     * Append endpoint to base url
     *
     * @param string $endpoint
     * @return string
     */
    protected function buildRequestUrl($endpoint) {
        return $this->baseUrl.'/'.trim($endpoint, " \/");
    }
}
