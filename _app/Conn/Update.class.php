<?php

class Update {

    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Result;

    private $Update;

    private $Conn;
    
    public function __construct() {
        $this->Conn = Conn::getConn();
    }

    public function ExeUpdate($Tabela, array $Dados, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getRowCount() {
        return $this->Update->rowCount();
    }

    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    private function Connect() {
        $this->Update = $this->Conn->prepare($this->Update);
    }

    private function getSyntax() {
        foreach ($this->Dados as $Key => $Value):
            $Places[] = $Key . ' = :' . $Key;
        endforeach;

        $Places = implode(', ', $Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
    }

    private function Execute() {
        $this->Connect();
        $this->setNull();
        try {
            $this->Update->execute(array_merge($this->Dados, $this->Places));
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            Erro("<b>Erro Ao Ler:</b> {$e->getMessage()}", $e->getCode());
        }
    }

    private function setNull() {
        foreach ($this->Dados as $Key => $Value):
            $this->Dados[$Key] = ($Value == "" ? null : $Value);
        endforeach;
    }

}
