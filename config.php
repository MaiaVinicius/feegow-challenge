<?php
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json, text/html");
header("Access-Control-Allow-Origin: *");
$servidor = "localhost";
$usuario = "upper952_feegow";
$senha = "mudar@123";
$dbname = "upper952_feegow";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if(!$conn){
    print_r(json_encode( array('conn'=>mysqli_connect_error()) ));
    die;
} else {
    print_r(json_encode( array('conn'=>$conn) ));
}
mysqli_set_charset($conn,"utf8");