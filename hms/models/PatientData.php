<?php 

/**
 *  PatientData model class used to perform operations in patient table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class PatientData
{
    const TABLE_NAME = 'patient';
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
     *  Method for adding patient details into the patient table.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     */
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
    /**
     *  Method for updating details in the patient table.
     *  @var string $table has the table name.
     *  @var int $id has the doctor id.
     *  @var array $stmt has the query statement.
     */
    public function updatePatient($firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$district,$state,$country,$pincode)
    {
        $table = self::TABLE_NAME;
        $id=$this->getPatientId($email);
        $stmt = $this->dbConnect->prepare("UPDATE $table SET firstname=?,lastname=?,gender=?,dob=?,age=?,email=?,contact=?,password=?,address=?,district=?,state=?,country=?,pincode=? WHERE p_id = ?");
        $stmt->execute([$firstname,$lastname,$gender,$dob,$age,$email,$contact,$password,$address,$district,$state,$country,$pincode,$id]);
    }
    /**
     *  Method for getting particular patient id.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     *  @return int $record  returns the patient id.
     */
    public function getPatientId($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT p_id FROM $table WHERE email=?");
        $stmt->execute([$email]);
        $record = $stmt->fetch();
        return $record['p_id'];  
    }
    /**
     *  Method for checking that patient is existing or not.
     *  @param string $email is the email value of user.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return int $records returns the number of records.
     */
    public function isExistingPatient($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();
        return count($records) > 0 ? true : false;
    }
    /** 
     *  Method for selecting all details from patient table.
     *  @param string $email has the email id of patient.
     *  @param string $password has the password of patient.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function selectPatient($email,$password)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /** 
     *  Method for view patient details according to patient id.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function viewPatient($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where p_id= ?");
        $stmt->execute([$id]); 
        $records = $stmt->fetch();
        return $records;
    }
    /** 
     *  Method for listing the patient details.
     *  @var string $table has the patient table.
     *  @return array returns the patient details as result.
     */
    public function listPatients()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY p_id asc");
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
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where p_id =?");
        $stmt->execute([$id]); 
        $records = $stmt->fetchAll();
        return $records;
    }
}