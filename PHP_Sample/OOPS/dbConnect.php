<?php 

class dbConnect{

    private $host = 'localhost';
    private $userName = 'root';
    private $pwd = 'H@rsha07';
    private $dbName = 'ecommerce';

    protected function connect(){
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
        $pdo = new PDO($dsn,$this->userName,$this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo;
    }
}