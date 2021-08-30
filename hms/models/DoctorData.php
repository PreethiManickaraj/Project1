<?php 

class DoctorData
{
    const TABLE_NAME = 'doctor';

    private $dbConnect;

    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }

    public function addDoctor($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$qualification,$district,$state,$country,$pincode)
    {
        $table = self::TABLE_NAME;
        if(!$this->isExistingDoctor($email)) 
        {
            $stmt = $this->dbConnect->prepare("INSERT INTO $table(firstName,lastName,contact,age,dob,gender,address,qualification,email,password,district,state,country,pincode)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$firstname,$lastname,$contact,$age,$dob,$gender,$address,$qualification,$email,$password,$district,$state,$country,$pincode]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function updateDoctor($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$qualification,$district,$state,$country,$pincode)
    {
        $table = self::TABLE_NAME;
        $id=$this->getDoctorId($email);
        $stmt = $this->dbConnect->prepare("UPDATE $table SET firstName=?,lastName=?,contact=?,age=?,dob=?,gender=?,address=?,qualification=?,email=?,password=?,district=?,state=?,country=?,pincode=?");
        $stmt->execute([$firstname,$lastname,$contact,$age,$dob,$gender,$address,$qualification,$email,$password,$district,$state,$country,$pincode]);
    }

    public function getDoctorId($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT d_id FROM $table WHERE email=?");
        $stmt->execute([$email]);
        $record = $stmt->fetch();
        return $record['d_id'];
        
    }

    public function isExistingDoctor($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();

        return count($records) > 0 ? true : false;
    }

    public function selectDoctor($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT email,password FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }

}