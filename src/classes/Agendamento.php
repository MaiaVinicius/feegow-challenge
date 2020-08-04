<?php

require_once("Conexao.php");


class Agendamento
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Conexao();
    }

    public function queryInsert()
    {
        try {
            $sql = "INSERT INTO agendamentos (`specialty_id`,`professional_id`,`name`,`cpf`,`source_id`,`birthdate`,`date_time`) VALUES (:specialty_id,:professional_id,:name,:cpf,:source_id,:birthdate,:date_time)";
            $today = date('YmdHis');
            $birthdate = str_replace( "-", "", $_POST['birthdate']);
            $query = $this->conn->connect()->prepare($sql);
            $newcpf = preg_replace("/[^0-9]/", "", $_POST['cpf'] );
            $query->bindParam(":specialty_id", $_POST['specialty_id']);
            $query->bindParam(":professional_id", $_POST['professional_id']);
            $query->bindParam(":name", $_POST['name']);
            $query->bindParam(":cpf", $newcpf);
            $query->bindParam(":source_id", $_POST['source_id']);
            $query->bindParam(":birthdate",  $birthdate);
            $query->bindParam(":date_time", $today);
            $result = $query->execute();
 
            if (! $result) {
                var_dump($query->errorInfo());
                exit;
            }
                 
            echo $query->rowCount();

        } catch (\PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

$agendamento = new Agendamento;

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case "insert":
      $agendamento->queryInsert();
        break;
    }
} else {
    echo "Ação não cadastrada";
}
