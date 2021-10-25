<?php 
/**
 *  PatientData model class used to perform operations in patient table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class PatientData
{
    const TABLE_NAME = 'patient';
    const TABLE_NAME1 = 'appointment';

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
     *  Method for adding patient details into the patient table.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     */
    public function addPatient($details)
    {
        $table = self::TABLE_NAME;
        $query = "INSERT INTO $table (firstname,lastname,gender,contact,age,address,
            email,dob,password,district,state,country,pincode)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        if (!$this->isExistingPatient($details['email'])) {
            $stmt = $this->dbConnect->prepare($query);
            $stmt->execute([
                $details['firstname'],
                $details['lastname'],
                $details['gender'],
                $details['contact'],
                $details['age'],
                $details['address'],
                $details['email'],
                $details['dob'],
                $details['password'],
                $details['district'],
                $details['state'],
                $details['country'],
                $details['pincode']
            ]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }
    /**
     *  Method for updating details in the patient table.
     *  @param array $details has the patient details.
     */
    public function updatePatient($details)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare(
            "UPDATE $table SET firstname=?,lastname=?,gender=?,dob=?,age=?,email=?,contact=?,address=?,district=?,state=?,country=?,pincode=? 
            WHERE p_id= ?");
        $stmt->execute([
            $details['firstname'],
            $details['lastname'],
            $details['gender'],
            $details['dob'],
            $details['age'],
            $details['email'],
            $details['contact'],
            $details['address'],
            $details['district'],
            $details['state'],
            $details['country'],
            $details['pincode'],
            $details['p_id']
        ]);
    }
    /**
     *  Method for checking that patient is existing or not.
     *  @param string $email is the email value of user.
     *  @return int $records returns the number of records.
     */
    public function isExistingPatient($email)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();
        return count($records) > 0 ? true : false;
    }
    /** 
     *  Method for selecting all details from patient table.
     *  @param string $email has the email id of patient.
     *  @param string $password has the password of patient.
     *  @return array $records has the result data.
     */
    public function selectPatient($email,$password)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /** 
     *  Method for view patient details according to patient id.
     *  @param int $id has the patient id.
     *  @return array $records has the result data.
     */
    public function viewPatient($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where p_id = ?");
        $stmt->execute([$id]); 
        $records = $stmt->fetch();
        return $records;
    }
    /** 
     *  Method for listing the patient details.
     *  @return query returns the patient details.
     */
    public function listPatients()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY p_id desc");
    }
    /** 
     *  Method for listing patient details.
     *  @return query has the patient details.
     */
    public function listPatientReports()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT p_id,firstname,lastname,gender,contact,age,
        address,email,dob,district,state,country,pincode FROM $table ORDER BY p_id desc");
    }
    /** 
     *  Method for listing patient details.
     *  @param int $data has the patient id.
     *  @return query has the patient details.
     */
    public function listPatient($data)
    {
        $table = self::TABLE_NAME;
        // print_r($data);die;
        return $this->dbConnect->query("SELECT * FROM $table where p_id = $data ORDER BY p_id desc");
    }
    /** 
     *  Method for retriving all records for user profile.
     *  @param int $id has the patient id.
     *  @return array $records has the result data.
     */
    public function profile($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where p_id = ?");
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
        return $this->dbConnect->query("SELECT * FROM $table order by p_id desc LIMIT $start_from,$per_page_record");
    }
    public function tableSort($start_from,$per_page_record,$column,$order)
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table order by $column $order LIMIT $start_from,$per_page_record");
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
     *  Method for selecting patient name like the data given by user.
     *  @return query has the firstname like $data.
     */
    public function SearchPatientName($data)
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table WHERE firstname like '%$data%' or lastname like '%$data%'
        or email like '%$data%' or country like '%$data%' or district like '%$data%' or state like '%$data%' or gender like '$data'");
    }
    public function SearchPatientsName($data)
    {
        $table = self::TABLE_NAME;
        $table1 = self::TABLE_NAME1;
        return $this->dbConnect->query("SELECT * FROM $table right join $table1 on $table.p_id = $table1.patient_id WHERE firstname like '%$data%' or lastname like '%$data%'
        or email like '%$data%' or country like '%$data%' or district like '%$data%' or state like '%$data%' or gender like '$data'");
    }
    /**
     *  Method for select update password.
     *  @param $password, $id has the new password and patient id.
     */
    public function updatePassword($password,$id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("UPDATE $table SET password = ? WHERE p_id = ?");
        $stmt->execute([$password,$id]); 
    }
     /**
     *  Method for select patient first name.
     *  @param $doctor has the patient id.
     */
    public function selectName($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT firstname FROM $table WHERE p_id = ?");
        $stmt->execute([$id]);
        $records = $stmt->fetchAll();
        return $records[0]['firstname'];
    }
}