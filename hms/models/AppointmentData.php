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
    private $dbConnect;
    /**
     *  Method for instantiates the object for class.
     *  call the connect function to connect the database.
     */
    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }
    /** 
     *  Method for adding prescription details for patients.
     *  @param int $id is the patient id.
     *  @param string $disease is the disease name.
     *  @param string $drug_name is the drug name.
     *  @param int $drug_quantity is the drug quantity.
     *  @param string $presb is the prescription statement.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     */
    public function addPresb($id,$disease,$drug_name,$drug_quantity,$presb)
    {
        $table = self::TABLE_NAME1;
        $stmt = $this->dbConnect->prepare("INSERT INTO $table(p_id,disease,drug_name,drug_quantity,prescription) VALUES
        (?,?,?,?,?)");
        $stmt->execute([$id,$disease,$drug_name,$drug_quantity,$presb]);
    }
    /**
     *  Method for listing the prescription details for patient.
     *  @param int $id is the patient id.
     *  @var string $table1 is the appointment table.
     *  @var string $table2 is the patient table.
     *  @return array firstname from patient table and all details from appointment table.
     */
    public function listPresb($id)
    {
        $table1 = self::TABLE_NAME1;
        $table2 = self::TABLE_NAME2;
        return $this->dbConnect->query("SELECT A.*,B.firstName FROM $table1 A, $table2 B where A.p_id = B.p_id and A.p_id = $id");
    } 
}