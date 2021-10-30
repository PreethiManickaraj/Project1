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
    private $dbName = 'userform';

    public function connect()
    {
        // connect function connects the database
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
        $pdo = new PDO($dsn,$this->userName,$this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo;

    }
    /**
     *  insertRow function is used to insert record in database
     */

    public function insertRow($tableName){
        $query = "INSERT INTO $tableName(firstname,lastname,email,password)VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password']]);
    }

    /**
     *  selectRow is used to select record from table
     */
    public function selectRow($tablename,$email,$password){
        $query = "SELECT $email FROM $tableName WHERE password = $password";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$email,$password]);
        $name = $stmt->fetchALL();
        //print_r($name);
    }
} 