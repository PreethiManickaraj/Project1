<?php 

class PatientData
{
    const TABLE_NAME = 'patient';

    private $dbConnect;

    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }

    public function addPatient($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$district,$state,$country,$pincode)
    {
        $table = self::TABLE_NAME;
        if(!$this->isExistingPatient($email)) {
            $stmt = $this->dbConnect->prepare("INSERT INTO $table(firstName,lastName,gender,contact,age,address,email,dob,password,district,state,country,pincode)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$firstname,$lastname,$gender,$contact,$age,$address,$email,$dob,$password,$district,$state,$country,$pincode]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function isExistingPatient($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();
        return count($records) > 0 ? true : false;
    }

    public function selectPatient($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT email,password FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
}