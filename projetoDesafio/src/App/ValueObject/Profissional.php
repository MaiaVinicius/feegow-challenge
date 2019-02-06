<?php

namespace App\ValueObject;

class Profissional
{
    public $profissional_id;
    /**
     * @var string|null
     */
    public $nome;
    /**
     * @var string|null
     */
    public $rqe;
    /**
     * @var string|null
     */
    public $conselho;
    /**
     * @var string|null
     */
    public $documento_conselho;
    /**
     * @var string|null
     */
    public $uf_conselho;
    /**
     * @var string|null
     */
    public $foto;
    /**
     * @var string|null
     */
    public $sexo;
    /**
     * @var EspecialidadeProfissional[]|null
     */
    public $especialidades;
}
