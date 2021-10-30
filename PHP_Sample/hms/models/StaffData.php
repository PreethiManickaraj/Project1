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
        $dbConnect = new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }
    /**
     *  Method for updating details in the staff table.
     *  @param array $details has the staff details.
     */
    public function addStaff($details)
    {
        $table = self::TABLE_NAME;
        if (!$this->isExistingStaff($details[1])) {
            $stmt = $this->dbConnect->prepare("INSERT INTO $table(name,email,password) VALUES (?,?,?)");
            $stmt->execute([$details['name'],$details['email'],$details['password']]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $details[1]));
        }
    }
    /**
     *  Method for updating details in the staff table.
     *  @param array $details has the staff details.
     */
    public function updateStaff($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("UPDATE $table SET name = ?,email = ? WHERE staff_id = ?");
        $stmt->execute([
            $details['name'],
            $details['email'], 
            $details['id']
        ]);
    }
    /**
     *  Method for checking that staff existing or not.
     *  @param string $email is the email value of user.
     *  @return int $records returns the number of records.
     */
    public function isExistingStaff($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();
        return count($records) > 0 ? true : false;
    }
    /** 
     *  Method for selecting all details from staff table.
     *  @param string $email has the email id of staff.
     *  @param string $password has the password of staff.
     *  @return array $records has the result data.
     */
    public function selectStaff($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /** 
     *  Method for listing the staff details.
     *  @return query returns the staff details as result.
     */
    public function listStaff()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY staff_id desc");
    }
    /** 
     *  Method for view staff details according to patient id.
     *  @param int $id has the staff id.
     *  @return array $records has the result data.
     */
    public function viewStaff($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where staff_id = ?");
        $stmt->execute([$id]); 
        $records = $stmt->fetch();
        return $records;
    }
    /** 
     *  Method for retriving all records for user profile.
     *  @param int $id has the staff id.
     *  @return array $records has the result data.
     */
    public function profile($id){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where staff_id =?");
        $stmt->execute([$id]); 
        $records = $stmt->fetchAll();
        return $records;
    }
     /** 
     *  Method for retriving records according to limit.
     *  @return query $records has the result data.
     */
    public function listPerPage($start_from,$per_page_record)
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table order by staff_id desc LIMIT $start_from,$per_page_record");
    }
    /** 
     *  Method for counting records in the table.
     *  @return int $records has the total count.
     */
    public function countRecords()
    {
        $table = self::TABLE_NAME;
        //return $this->dbConnect->query("SELECT COUNT(*) FROM $table");
        $stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute(); 
        $records = $stmt->fetch();
        return $records['COUNT(*)'];
    } 
    /** 
     *  Method for selecting staff name like the data given by user.
     *  @return query has the name like $data.
     */
    public function SearchStaffName($data)
    {
        $table = self::TABLE_NAME;
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table WHERE name like '%$data%' or email like '%$data%'");
    }
    /** 
     *  Method for listing staff details.
     *  @return query has the staff details.
     */
    public function listStaffReports()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT staff_id,name,email FROM $table ORDER BY staff_id desc");
    }
    /**
     *  Method for select update password.
     *  @param $password, $id has the new password and staff id.
     */
    public function updatePassword($password,$id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("UPDATE $table SET password = ? WHERE staff_id = ?");
        $stmt->execute([$password,$id]); 
    }
}