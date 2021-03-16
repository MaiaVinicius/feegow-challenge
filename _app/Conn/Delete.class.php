<?php

class Delete {

    private $Tabela;
    private $Termos;
    private $Places;
    private $Result;

    private $Delete;

    private $Conn;
    
    public function __construct() {
        $this->Conn = Conn::getConn();
    }

    public function ExeDelete($Tabela, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getRowCount() {
        return $this->Delete->rowCount();
    }

    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    private function Connect() {
        $this->Delete = $this->Conn->prepare($this->Delete);
    }

    private function getSyntax() {
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    private function Execute() {
        $this->Connect();
        try {
            $this->Delete->execute($this->Places);
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            Erro("<b>Erro Ao Deletar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
