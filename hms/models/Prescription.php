<?php 

/**
 *  Prescription model class used to perform operations in prescription table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class Prescription
{
    const TABLE_NAME1 = 'prescription';
    const TABLE_NAME2 = 'doctor';
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
     *  @param array $details has the prescription details.
     */
    public function addPresb($details)
    {
        $table = self::TABLE_NAME1;
        $stmt = $this->dbConnect->prepare(
            "INSERT INTO $table (disease,medicine,description,quantity,no_of_days,morning,noon,night,p_id,d_id) VALUES (?,?,?,?,?,?,?,?,?,?)"
        );
        for ($i = 0; $i < count($details['disease']);$i++) {
            $stmt->execute([
                $details['disease'][$i],
                $details['medicine'][$i],
                $details['description'][$i],
                $details['quantity'][$i],
                $details['days'][$i],
                $details['morning'][$i],
                $details['noon'][$i],
                $details['night'][$i],
                $details['p_id'],
                $details['d_id']
            ]);
        }
    }
    /**
     *  Method for listing the prescription details for patient.
     *  @param int $id is the patient id.
     *  @return array firstname from patient table and all details from prescription table.
     */
    public function listPresb($id)
    {
        $table1 = self::TABLE_NAME1;
        $table2 = self::TABLE_NAME2;
        return $this->dbConnect->query("SELECT A.*,B.firstname FROM $table1 A, $table2 B where A.d_id = B.d_id and A.p_id = $id");
    }
}