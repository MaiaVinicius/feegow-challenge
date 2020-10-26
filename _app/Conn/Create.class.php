<?php

class Create {

    private $Tabela;
    private $Dados;
    private $Result;

    private $Create;

    private $Conn;
    
    public function __construct() {
        $this->Conn = Conn::getConn();
    }

    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $this->getSyntax();
        $this->Execute();
    }

    public function ExeCreateMulti($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Fileds = implode(', ', array_keys($this->Dados[0]));
        $Places = null;
        $Inserts = null;
        $Links = count(array_keys($this->Dados[0]));

        foreach ($Dados as $ValueMult):
            $Places .= '(';
            $Places .= str_repeat('?,', $Links);
            $Places .= '),';
            
            foreach ($ValueMult as $ValueSingle):
                $Inserts[] = $ValueSingle;
            endforeach;      
        endforeach;
        
        $Places = str_replace(',)', ')', $Places);
        $Places = substr($Places, 0, -1);
        $this->Dados = $Inserts;
        
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES {$Places}";
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    private function Connect() {
        $this->Create = $this->Conn->prepare($this->Create);
    }

    private function getSyntax() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }

    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            Erro("<b>Erro Ao Cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
