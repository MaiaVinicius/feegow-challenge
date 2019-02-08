<?php

namespace App\Service;

use Zend\Http\Client;
use Zend\Http\Request;

use App\ValueObject\Profissional;

class ProfissionalService
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
     * @param bool|null $ativo
     * @param int|null $unidadeId
     * @param int|null $especialidadeId
     * @return iterable
     * @throws \Exception|\JsonMapper_Exception
     */
    public function getListProfissionais(
        ?bool $ativo = null,
        ?int $unidadeId = null,
        ?int $especialidadeId = null
    ): iterable {
        $parametros = $this->montarParametros($ativo, $unidadeId, $especialidadeId);

        $this->client->setEncType(Client::ENC_URLENCODED);
        $this->client->setUri("{$this->endpoint}/professional/list?{$parametros}");
        $this->client->setMethod(Request::METHOD_GET);

        $response = $this->client->send();
        $content = $response->getBody();
        $conteudoBody = json_decode($content);

        if(!isset($conteudoBody->success) || !$conteudoBody->success){
            throw new \Exception('Ocorreu um erro no retorno da lista dos profissionais', 400);
        }

        /** @var iterable|\ArrayObject|Profissional[] $listProfissionais */
        $listProfissionais = (new \JsonMapper())->mapArray(
            $conteudoBody->content,
            new \ArrayObject(),
            Profissional::class
        );

        return $listProfissionais;
    }

    private function montarParametros(?bool $ativo, ?int $unidadeId, ?int $especialidadeId): string
    {
        $params = [];
        if(!is_null($ativo)){
            $params['ativo'] = $ativo;
        }
        if(!is_null($unidadeId)){
            $params['unidade_id'] = $unidadeId;
        }
        if(!is_null($especialidadeId)){
            $params['especialidade_id'] = $especialidadeId;
        }

        return http_build_query($params);
    }
}
