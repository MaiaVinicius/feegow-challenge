<?php
require_once('Consultas.php');

// Check if is an AJAX request
if (sizeof($_GET) === 0 && array_key_exists("is_ajax", $_POST) && $_POST['is_ajax']) {
  $consultas = new Consultas();
  echo $consultas->saveData($_POST);
  exit;
}

echo header('HTTP/1.1 405 Forbiden', true, 405);

?>
