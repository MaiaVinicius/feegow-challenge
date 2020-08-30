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
        $call = 'specialties';
        $response = $this->client->request('GET', '/specialties/list');
        return json_decode($this->parseFeegowResponseToArray($response->getBody()->getContents(), $call), true);
    }

    public function professional(){
        $call = 'professional';
        $response = $this->client->request('GET', '/professional/list');
        return json_decode($this->parseFeegowResponseToArray($response->getBody()->getContents(), $call), true);

    }

    public function sources(){
        $call = 'sources';
        $response = $this->client->request('GET', '/patient/list-sources');
        return json_decode($this->parseFeegowResponseToArray($response->getBody()->getContents(), $call), true);
    }

    private function parseFeegowResponseToArray(string $contents, $call) {
        $json_content = json_decode($contents,  true);
        $data = $json_content['content'];
        $collect = collect();


        switch ($call) {
            case 'specialties':
                foreach ($data as $item){
                    $collect->push([
                        'especialidade_id' => (int) $item['especialidade_id'],
                        'nome' =>  $item['nome'],
                    ]);
                }
                return $collect->sortByDesc('especialidade_id')->values()->toJson();
                break;
            case 'professional':
                foreach ($data as $item){
                    
                    
                    $collect->push([
                        'profissional_id' => (int) $item['profissional_id'],
                        'nome' =>  $item['nome'],
                        'documento_conselho' => (int) $item['documento_conselho'],
                        'foto' => (int) $item['foto'],
                        'especialidade_id' => $this->getEspecialidade($item['especialidades']), 
                    ]);
                }
                return $collect->toJson();
            break;

            case 'sources':
                foreach ($data as $item){
                    $collect->push([
                        '' => (int) $item['especialidade_id'],
                        'nome' =>  $item['nome'],
                    ]);
                }
                return $collect->sortByDesc('especialidade_id')->values()->toJson();
                break;

            default:
                return "no calls!!";
                break;
        }

    }

    private function getEspecialidade(array $data) {

        foreach ($data as $item){
             return  $item['especialidade_id'];
        }
        
    }

}
