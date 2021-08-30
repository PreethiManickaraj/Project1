<?php 

class StaffData
{
    const TABLE_NAME = 'staff';

    private $dbConnect;

    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }

    public function addStaff($name,$email,$password)
    {
        $table = self::TABLE_NAME;
        if(!$this->isExistingStaff($email)) {
            $stmt = $this->dbConnect->prepare("INSERT INTO $table(name,email,password)VALUES(?,?,?)");
            $stmt->execute([$name, $email, $password]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function updateStaff($name,$email,$password)
    {
        $table = self::TABLE_NAME;
        $id = $this->getStaffId($email);
        $stmt = $this->dbConnect->prepare("UPDATE $table SET name=?,email=?,password=? WHERE staff_id = ?");
        $stmt->execute([$name, $email, $password,$id]);
    }

    public function getStaffId($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT staff_id FROM $table WHERE email=?");
        $record = $stmt->execute([$email]);
        return $record;
    }

    public function isExistingStaff($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();

        return count($records) > 0 ? true : false;
    }

    public function selectStaff($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT email,password FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
}