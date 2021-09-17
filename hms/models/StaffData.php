<?php 

/**
 *  StaffData model class is used to perform operations in Staff table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class StaffData
{
    const TABLE_NAME = 'staff';
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
     *  Method for adding staff details into the staff table.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     */
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
    /**
     *  Method for updating details in the staff table.
     *  @var string $table has the table name.
     *  @var int $id has the doctor id.
     *  @var array $stmt has the query statement.
     */
    public function updateStaff($name,$email,$password)
    {
        $table = self::TABLE_NAME;
        $id = $this->getStaffId($email);
        $stmt = $this->dbConnect->prepare("UPDATE $table SET name=?,email=?,password=? WHERE staff_id = ?");
        $stmt->execute([$name, $email, $password,$id]);
    }
    /**
     *  Method for getting particular staff id.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     *  @return int $record  returns the doctor id.
     */
    public function getStaffId($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT staff_id FROM $table WHERE email=?");
        $record = $stmt->execute([$email]);
        return $record;
    }
    /**
     *  Method for checking that staff existing or not.
     *  @param string $email is the email value of user.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return int $records returns the number of records.
     */
    public function isExistingStaff($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();
        return count($records) > 0 ? true : false;
    }
    /** 
     *  Method for selecting all details from staff table.
     *  @param string $email has the email id of staff.
     *  @param string $password has the password of staff.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function selectStaff($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /** 
     *  Method for listing the staff details.
     *  @var string $table has the staff table.
     *  @return array returns the staff details as result.
     */
    public function listStaff()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY staff_id asc");
    }
    /** 
     *  Method for view staff details according to patient id.
     *  @var string $table is the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function viewStaff($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where staff_id= ?");
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
    public function profile($id){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where staff_id=?");
        $stmt->execute([$id]); 
        $records = $stmt->fetchAll();
        return $records;
    }
}