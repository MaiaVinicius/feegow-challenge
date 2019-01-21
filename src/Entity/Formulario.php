<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Formulario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="name")
     */
    private $nome;

    /**
     * @ORM\Column(type="integer", name="source_id")
     */
    private $idOrigem;

    /**
     * @ORM\Column(type="date", name="birthdate")
     */
    private $dataNascimento;

    /**
     * @ORM\Column(type="string", length=14, name="cpf")
     */
    private $cpf;

    /**
     * @ORM\Column(type="integer", name="specialty_id")
     */
    private $idEspecialidade;

    /**
     * @ORM\Column(type="integer", name="professional_id")
     */
    private $idProfissional;

    /**
     * @ORM\Column(type="datetime", name="date_time")
     */
    private $dataCriacao;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getIdOrigem(): ?int
    {
        return $this->idOrigem;
    }

    public function setIdOrigem(int $idOrigem): self
    {
        $this->idOrigem = $idOrigem;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getIdEspecialidade(): ?int
    {
        return $this->idEspecialidade;
    }

    public function setIdEspecialidade(int $idEspecialidade): self
    {
        $this->idEspecialidade = $idEspecialidade;

        return $this;
    }

    public function getIdProfissional(): ?string
    {
        return $this->idProfissional;
    }

    public function setIdProfissional(string $idProfissional): self
    {
        $this->idProfissional = $idProfissional;

        return $this;
    }

    public function getDataCriacao(): ?\DateTimeInterface
    {
        return $this->dataCriacao;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(): self
    {
        $this->dataCriacao = new \DateTime();

        return $this;
    }
}
