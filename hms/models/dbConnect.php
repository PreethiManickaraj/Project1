<?php 
/**
 *  dbConnect class is used to connect database
 *  @var string $host has host name of database
 *  @var string $userName has username of database
 *  @var string $pwd has user password of database
 *  @var string $dbName has database name
 * 
 */

class dbConnect
{

    private $host = 'localhost';
    private $userName = 'root';
    private $pwd = 'H@rsha07';
    private $dbName = 'hms';

    public function connect()
    {
        // connect function connects the database
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
        $pdo = new PDO($dsn,$this->userName,$this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo;
    }
} 