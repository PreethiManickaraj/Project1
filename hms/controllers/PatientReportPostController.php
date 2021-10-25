<?php 

/**
 *  PatientReportPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class.
 *  @var object $patientData instance of PatientData class.
 */
class PatientReportPostController extends Controller
{
    protected $patientData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator object for Validator class.
     *  instantiates the patientData object for PatientData class.
     */
    public function __construct()
    {
        $this->patientData = new PatientData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  validates the fields and display error and success messages.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        $patients = [];
        $patientList = $this->patientData->listPatientReports();
        while ($row = $patientList->fetch(PDO::FETCH_ASSOC)) {
            $patients[] = $row;
        }
        $output = fopen('php://output', 'w');
        fputcsv($output,['ID','First Name','Last Name','Gender','Contact','Age',
            'Address','Email','DOB','District','State','Country','Pincode'
        ]);
        if (count($patients) > 0) {
            foreach ($patients as $row1) {
                fputcsv($output, $row1);
            }
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=PatientReport.csv');
    }
}