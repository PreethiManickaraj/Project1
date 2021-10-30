<?php 

/**
 *  AppointmentData model class used to perform operations in appointment table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class AppointmentData
{
    const TABLE_NAME1 = 'appointment';
    const TABLE_NAME2 = 'patient';
    const TABLE_NAME3 = 'prescription';
    private $dbConnect;
    /**
     *  Method for instantiates the object for class.
     *  call the connect function to connect the database.
     */
    public function __construct()
    {
        $dbConnect = new dbConnect();
        $this->dbConnect = $dbConnect->connect();
    }
    /** 
     *  Method for adding appointment details for patients.
     *  @param array $details is the patient details.
     */
    public function addAppointment($details)
    {
        $table = self::TABLE_NAME1;
        $stmt = $this->dbConnect->prepare(
            "INSERT INTO $table (patient_id,doctor_id,appointment_date,appointment_from_time,appointment_to_time,status) 
            VALUES (?,?,?,?,?,?)"
        );
        $stmt->execute([
            $details['patient_id'],
            $details['doctor_id'],
            $details['appointment_date'],
            $details['appointment_from_time'],
            $details['appointment_to_time'],
            $details['status']
        ]); 
    }
    /** 
     *  Method for listing the appointment details for patients.
     *  @param int $doctorId is the doctor id.
     */
    public function appList($doctorId)
    {
        $table = self::TABLE_NAME1;
        $sql = "SELECT patient_id FROM $table WHERE doctor_id = '$doctorId'";
        $stmt = $this->dbConnect->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    /** 
     *  Method for listing the current date appointment details.
     *  @return query has the results of appointment details.
     */
    public function selectAppointment($id)
    {   
        $table = self::TABLE_NAME1;
        return $this->dbConnect->query("SELECT * FROM $table WHERE appointment_date = curdate() and doctor_id = $id");
    }
    /**
     *  Method for update appointment status for patient
     *  @param string $status.
     *  @param int $id is the patient id.
     */
    public function updateStatus($status,$id)
    {
        $table = self::TABLE_NAME1;
        $stmt = $this->dbConnect->prepare("UPDATE $table SET status = ? WHERE patient_id = ?");
        $stmt->execute([$status,$id]);
    }
    /** 
     *  Method for listing the appointment details based on doctor id.
     *  @return query has the results of appointment details.
     */
    public function listAppointment($id)
    {   
        $table = self::TABLE_NAME1;
        return $this->dbConnect->query("SELECT * FROM $table WHERE doctor_id = $id");

    }
}