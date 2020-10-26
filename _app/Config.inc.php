<?php

/*
 * BANCO DE DADOS
 */
if ($_SERVER['HTTP_HOST'] == 'localhost'):
    define('SIS_DB_HOST', 'localhost'); //Link do banco de dados no localhost
    define('SIS_DB_USER', 'root'); //Usuário do banco de dados no localhost
    define('SIS_DB_PASS', ''); //Senha  do banco de dados no localhost
    define('SIS_DB_DBSA', 'feegow'); //Nome  do banco de dados no localhost
else:
    define('SIS_DB_HOST', 'localhost'); //Link do banco de dados no servidor
    define('SIS_DB_USER', ''); //Usuário do banco de dados no servidor
    define('SIS_DB_PASS', ''); //Senha  do banco de dados no servidor
    define('SIS_DB_DBSA', ''); //Nome  do banco de dados no servidor
endif;

define('DB_CONF', 'config');
define('DB_SCHEDULES', 'schedules');

function MyAutoLoad($Class)
{
    $cDir = ['Conn', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php')):
            include_once(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;
}

spl_autoload_register("MyAutoLoad");

require 'Config/Config.inc.php';

