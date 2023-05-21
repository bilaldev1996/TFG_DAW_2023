<?php

class Db
{
    private $host;
    private $dbName;
    private $username;
    private $password;
    private static $instance;
    public $connection;

    private function __construct()
    {
        $this->host = constant('DB_HOST');
        $this->dbName = constant('DB');
        $this->username = constant('DB_USER');
        $this->password = constant('DB_PASS');

        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbName, 3306);

        if ($this->connection->connect_error) {
            throw new Exception("Fallo en la conexión: " . $this->connection->connect_error);
        }
    }

    /**
     * Este es un método estático que devuelve una instancia de la clase si aún no existe.
     * 
     * @return una instancia de la clase.
     * Uso este método estático para que no se realicen demasidas peticiones a la base de datos y caiga la web.
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
