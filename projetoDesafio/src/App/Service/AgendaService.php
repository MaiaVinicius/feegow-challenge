<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Zend\Http\Client;
use Zend\Http\Request;

use App\Entity\SolicitaHorario;
use App\ValueObject\Origem;
use App\ValueObject\Profissional;

class AgendaService
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
     * @var EntityManagerInterface
     */
    private $entityManage;

    /**
     * EspecialidadeService constructor.
     * @param EntityManagerInterface $entityManage
     * @param Client $client
     * @param string $endpoint
     */
    public function __construct(EntityManagerInterface $entityManage, Client $client, string $endpoint)
    {
        $this->entityManage = $entityManage;
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * @return iterable|\ArrayObject|Origem[]
     * @throws \Exception
     */
    public function getListOrigens(): iterable
    {
        $this->client->setEncType(Client::ENC_URLENCODED);
        $this->client->setUri("{$this->endpoint}/patient/list-sources");
        $this->client->setMethod(Request::METHOD_GET);

        $response = $this->client->send();
        $content = $response->getBody();

        $conteudoBody = json_decode($content);
        if (!isset($conteudoBody->success) || !$conteudoBody->success) {
            throw new \Exception('Ocorreu um erro no retorno da lista de origens', 400);
        }

        /** @var iterable|\ArrayObject|Profissional[] $listOrigem */
        $listOrigem = (new \JsonMapper())->mapArray(
            $conteudoBody->content,
            new \ArrayObject(),
            Origem::class
        );

        return $listOrigem;
    }

    /**
     * @param SolicitaHorario $solicitaHorario
     */
    public function persistSolicitarHorario(SolicitaHorario $solicitaHorario): void
    {
        $this->entityManage->persist($solicitaHorario);
        $this->entityManage->flush();
    }

}
