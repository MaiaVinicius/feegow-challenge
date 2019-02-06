<?php
namespace App\Service;

use Zend\Http\Client;
use Zend\Http\Request;

use App\ValueObject\Especialidade;

class EspecialidadeService
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $endpoint;

    /**
     * EspecialidadeService constructor.
     * @param Client $client
     * @param string $endpoint
     */
    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * @return iterable|\ArrayObject|Especialidade[]
     * @throws \Exception
     */
    public function getListEspecialidade(): iterable
    {
        $this->client->setEncType(Client::ENC_URLENCODED);
        $this->client->setUri("{$this->endpoint}/specialties/list");
        $this->client->setMethod(Request::METHOD_GET);

        $response = $this->client->send();
        $content = $response->getBody();

        $conteudoBody = json_decode($content);
        if(!isset($conteudoBody->success) || !$conteudoBody->success){
            throw new \Exception('Ocorreu um erro no retorno das especialidades', 400);
        }

        /** @var iterable|\ArrayObject|Especialidade[] $listEspecialidades */
        $listEspecialidades = (new \JsonMapper())->mapArray(
            $conteudoBody->content,
            new \ArrayObject(),
            Especialidade::class
        );

        return $listEspecialidades;
    }
}
