<?php 
/**
 *  hosData model class used to perform operations in database
 */
class hosData 
{
    //instance of dbConnect class
    private $dbConnect;

    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        // instantiates for dbConnect class
        $this->dbConnect = $dbConnect->connect();
    }

    public function addStaff($name,$email,$password)
    {
        if(!$this->isExistingStaff($email)) {
            //$query = "INSERT INTO  $tableName(firstname,lastname,email,password)VALUES(?,?,?,?)";
            $stmt = $this->dbConnect->prepare("INSERT INTO staff(name,email,password)VALUES(?,?,?)");
            $stmt->execute([$name, $email, $password]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function isExistingStaff($email)
    {
        $stmt = $this->dbConnect->prepare("SELECT * FROM staff WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();

        return count($records) > 0 ? true : false;
    }

    public function addPatient($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address)
    {
        if(!$this->isExistingPatient($email)) {
            //$query = "INSERT INTO  $tableName(firstname,lastname,email,password)VALUES(?,?,?,?)";
            $stmt = $this->dbConnect->prepare("INSERT INTO patient(firstName,lastName,gender,contact,age,address,email,dob,password)
            VALUES(?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$firstname,$lastname,$gender,$contact,$age,$address,$email,$dob,$password]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function isExistingPatient($email)
    {
        $stmt = $this->dbConnect->prepare("SELECT * FROM patient WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();

        return count($records) > 0 ? true : false;
    }

    public function addDoctor($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address)
    {
        if(!$this->isExistingDoctor($email)) {
            //$query = "INSERT INTO  $tableName(firstname,lastname,email,password)VALUES(?,?,?,?)";
            $stmt = $this->dbConnect->prepare("INSERT INTO doctor(firstName,lastName,gender,contact,age,address,email,dob,password)
            VALUES(?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$firstname,$lastname,$gender,$contact,$age,$address,$email,$dob,$password]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function isExistingDoctor($email)
    {
        $stmt = $this->dbConnect->prepare("SELECT * FROM doctor WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();

        return count($records) > 0 ? true : false;
    }

    public function loginUser($email,$password)
    {
        $stmt = $this->dbConnect->prepare("SELECT * FROM adminuser WHERE email=? and pass=?");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
    }
}