<?php

class Consultas {

  public $connection = null;

  function __construct() {
    $this->connection = new mysqli("localhost", "root", "", "feegow", "3306");
  }

  function __destruct() {
    $this->connection->close();
  }

  public function setResponseMessage($success, $message) {
    $response = [];
    $response["sucesso"] = $success;
    $response['message'] = $message;
    return json_encode($response);
  }

  public function saveData($formData) {
    
    // Check if the fields in the $_POST var
    $arrFields = ["nome", "como_conheceu", "nascimento", "cpf"];
    foreach($arrFields as $field) {
      if (!array_key_exists($field, $formData)) {
        return $this->setResponseMessage(false, "Preencha todos os campos e tente novamente!");
      }
    }

    if ($this->connection->connect_error) {
      return $this->setResponseMessage(false, "Erro ao se conectar a base de dados.");
    }

    // Insert Data to the Database
    $specialty_id    = $formData['especialidade'];
    $professional_id = $formData['profissional'];
    $name            = $formData['nome'];
    $cpf             = $formData['cpf'];
    $source_id       = $formData['como_conheceu'];
    $birthdate       = $formData['nascimento'];
    $stringSql = "
      INSERT INTO consultas (specialty_id, professional_id, name, cpf, source_id, birthdate)
      VALUES('$specialty_id', '$professional_id', '$name', '$cpf', '$source_id', '$birthdate')
    ";
    $result = $this->connection->query($stringSql);
    if ($result === TRUE) {
      return $this->setResponseMessage(true, "Salvo com sucesso!");
    } else {
      return $this->setResponseMessage(false, "Ocorreu um erro interno, tente novamente mais tarde.");
    }
  }
  
}

?>