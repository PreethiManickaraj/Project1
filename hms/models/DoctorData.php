<?php 

/** 
 *  DoctorData model class is used to perform operations in Doctor table.
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class DoctorData
{
    const TABLE_NAME = 'doctor';
    private $dbConnect;
    /**
     *  Method for instantiates the object for class
     *  connecting the database calling connect function.
     */
    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }
    /**
     *  Method for adding doctor details into the doctor table.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     */
    public function addDoctor($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$qualification,$district,$state,$country,$pincode)
    {
        $table = self::TABLE_NAME;
        if(!$this->isExistingDoctor($email)) {
            $stmt = $this->dbConnect->prepare("INSERT INTO $table(firstName,lastName,contact,age,dob,gender,address,qualification,email,password,district,state,country,pincode)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$firstname,$lastname,$contact,$age,$dob,$gender,$address,$qualification,$email,$password,$district,$state,$country,$pincode]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }
    /**
     *  Method for updating details in the doctor table.
     *  @var string $table has the table name.
     *  @var int $id has the doctor id.
     *  @var array $stmt has the query statement.
     */
    public function updateDoctor($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$qualification,$district,$state,$country,$pincode)
    {
        $table = self::TABLE_NAME;
        $id=$this->getDoctorId($email);
        $stmt = $this->dbConnect->prepare("UPDATE $table SET firstName=?,lastName=?,contact=?,age=?,dob=?,gender=?,address=?,qualification=?,email=?,password=?,district=?,state=?,country=?,pincode=?");
        $stmt->execute([$firstname,$lastname,$contact,$age,$dob,$gender,$address,$qualification,$email,$password,$district,$state,$country,$pincode]);
    }
    /**
     *  Method for getting particular doctor id.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     *  @return int $record  returns the doctor id.
     */
    public function getDoctorId($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT d_id FROM $table WHERE email=?");
        $stmt->execute([$email]);
        $record = $stmt->fetch();
        return $record['d_id'];
    }
    /**
     *  Method for checking that doctor existing or not.
     *  @param string $email is the email value of user.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return int $records returns the number of records.
     */
    public function isExistingDoctor($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll(); 
        return count($records) > 0 ? true : false;
    }
    /** 
     *  Method for selecting all details from doctor table.
     *  @param string $email has the email id of doctor.
     *  @param string $password has the password of doctor.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function selectDoctor($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /** 
     *  Method for listing the doctor details.
     *  @var string $table has the doctor table.
     *  @return array returns the doctor details as result.
     */
    public function listDoctors()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY d_id asc");
    }
    /** 
     *  Method for view doctor details according to doctor id.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function viewDoctor($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where d_id= ?");
        $stmt->execute([$id]); 
        $records = $stmt->fetch();
        return $records;
    }
    /** 
     *  Method for retriving all records for user profile.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function profile($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where d_id=?");
        $stmt->execute([$id]); 
        $records = $stmt->fetchAll();
        return $records;
    }
}