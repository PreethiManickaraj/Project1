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
        $dbConnect = new dbConnect();
        $this->dbConnect = $dbConnect->connect();
    }
    /**
     *  Method for adding doctor details into the doctor table.
     *  @param array $details has the doctor details.
     */
    public function addDoctor($details,$status)
    {
        $table = self::TABLE_NAME;
        if (!$this->isExistingDoctor($details['email'])) {
            $stmt = $this->dbConnect->prepare(
                "INSERT INTO $table (firstName,lastName,contact,age,dob,gender,
                address,qualification,email,password,district,state,country,pincode,status,specialist,from_time,to_time)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
            );
            $stmt->execute([
                $details['firstname'],
                $details['lastname'],
                $details['contact'],
                $details['age'],
                $details['dob'],
                $details['gender'],
                $details['address'],
                $details['qualification'],
                $details['email'],
                $details['password'],
                $details['district'],
                $details['state'],
                $details['country'],
                $details['pincode'],
                $status,
                $details['specialist'],
                $details['from_time'],
                $details['to_time']
            ]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $details['email']));
        }
    }
    /**
     *  Method for updating details in the doctor table.
     *  @param array $details has the doctor details to update.
     */
    public function updateDoctor($details,$status)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare(
            "UPDATE $table SET firstname=?,lastname=?,contact=?,age=?,dob=?,gender=?,address=?,qualification=?,email=?,district=?,state=?,country=?,pincode=?,specialist=?,from_time=?,to_time=?,status=? WHERE d_id = ?");
        $stmt->execute([
            $details['firstname'],
            $details['lastname'],
            $details['contact'],
            $details['age'],
            $details['dob'],
            $details['gender'],
            $details['address'],
            $details['qualification'],
            $details['email'],
            $details['district'],
            $details['state'],
            $details['country'],
            $details['pincode'],
            $details['specialist'],
            $details['from_time'],
            $details['to_time'],
            $status,
            $details['d_id']
        ]);
    }
    /**
     *  Method for checking that doctor existing or not.
     *  @param string $email is the email value of user.
     *  @return int $records returns the number of records.
     */
    public function isExistingDoctor($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll(); 
        return count($records) > 0 ? true : false;
    }
    /** 
     *  Method for selecting all details from doctor table.
     *  @param string $email has the email id of doctor.
     *  @param string $password has the password of doctor.
     *  @return array $records has the result data.
     */
    public function selectDoctor($email,$password){
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /** 
     *  Method for listing the doctor details.
     *  @return array returns the doctor details as result.
     */
    public function listDoctors()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY d_id desc");
    }
    /** 
     *  Method for view doctor details according to doctor id.
     *  @return array $records has the result data.
     */
    public function viewDoctor($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where d_id = ?");
        $stmt->execute([$id]); 
        $records = $stmt->fetch();
        return $records;
    }
    /** 
     *  Method for retriving all records for user profile.
     *  @return array $records has the result data.
     */
    public function profile($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where d_id = ?");
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
        return $this->dbConnect->query("SELECT * FROM $table order by d_id desc LIMIT $start_from,$per_page_record");
    }
    /** 
     *  Method for counting records in the table.
     *  @return int $records has the total count.
     */
    public function countRecords()
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute(); 
        $records = $stmt->fetch();
        return $records['COUNT(*)'];
    } 
    /** 
     *  Method for selecting doctor name like the data given by user.
     *  @return query has the firstname like $data.
     */
    public function SearchDoctorName($data)
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table WHERE firstname like '%$data%' or lastname like '%$data%'
        or email like '%$data%' or country like '%$data%' or district like '%$data%' or state like '%$data%' or gender like '$data'");
    }
    /** 
     *  Method for listing doctor details.
     *  @return query has the doctor details.
     */
    public function listDoctorReports()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT d_id,firstname,lastname,gender,contact,age,
        address,email,qualification,from_time,to_time,dob,district,state,country,pincode 
        FROM $table 
        ORDER BY d_id desc");
    }
    /**
     *  Method for select update password.
     *  @param $password, $id has the new password and doctor id.
     */
    public function updatePassword($password,$id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("UPDATE $table SET password = ? WHERE d_id = ?");
        $stmt->execute([$password,$id]); 
    }
    /**
     *  Method for select doctor first name.
     *  @param $doctor has the doctor id.
     */
    public function selectName($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT firstname FROM $table WHERE d_id = ?");
        $stmt->execute([$id]);
        $records = $stmt->fetchAll();
        return $records[0]['firstname'];
    }
}