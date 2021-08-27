<?php 

class AdminData
{
    const TABLE_NAME = 'admin';

    private $dbConnect;

    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }

    public function selectAdmin($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT email,password FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
}