<?php

class Read {

    private $Select;
    private $Places;
    private $Result;

    private $Read;
    private $Conn;
    public function __construct() {
        $this->Conn = Conn::getConn();
    }

    public function ExeRead($Tabela, $Termos = null, $ParseString = null) {
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;

        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    public function LinkResult($Tabela, $Coluna, $Valor, $Campos = null) {
        if ($Campos):
            $this->FullRead("SELECT {$Campos} FROM  {$Tabela} WHERE {$Coluna} = :value", "value={$Valor}");
        else:
            $this->ExeRead($Tabela, "WHERE {$Coluna} = :value", "value={$Valor}");
        endif;

        if ($this->getResult()):
            return $this->getResult()[0];
        else:
            return false;
        endif;
    }

    public function getRowCount() {
        return $this->Read->rowCount();
    }

    public function FullRead($Query, $ParseString = null) {
        $this->Select = (string) $Query;
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;
        $this->Execute();
    }

    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->Execute();
    }

    private function Connect() {
        
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getSyntax() {
        if ($this->Places):
            foreach ($this->Places as $Vinculo => $Valor):
                if ($Vinculo == 'limit' || $Vinculo == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Read->bindValue(":{$Vinculo}", $Valor, ( is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    private function Execute() {
        $this->Connect();
        try {
            $this->getSyntax();
            $this->Read->execute();
            $this->Result = $this->Read->fetchAll();
        } catch (PDOException $e) {
            $this->Result = null;
            Erro("<b>Erro Ao Ler:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
