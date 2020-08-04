<?php
class Conexao
{
    private $_USER,
        $_PASSWORD,
        $_DATABASE,
        $_SERVER;
    private static $pdo;

    public function __construct()
    {

        $this->_SERVER = "localhost";
        $this->_DATABASE = "feegow_agendamentos";
        $this->_USER = "root";
        $this->_PASSWORD  = "";
    }

    public function connect()
    {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO("mysql:host=" . $this->_SERVER . ";dbname=" . $this->_DATABASE, $this->_USER, $this->_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }
            return self::$pdo;
        } catch (PDOException $ex) {
            self::$pdo->rollBack();
            echo "Failed: " . $ex->getMessage();
        }
    }
    
}
