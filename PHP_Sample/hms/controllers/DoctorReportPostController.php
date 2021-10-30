<?php 
/**
 *  DoctorReportPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class.
 *  @var object $doctorData instance of DoctorData class.
 */
class DoctorReportPostController extends Controller
{
    protected $doctorData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator object for Validator class.
     *  instantiates the doctorData object for DoctorData class.
     */
    public function __construct()
    {
        $this->doctorData = new DoctorData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        $doctors = [];
        $doctorList = $this->doctorData->listDoctorReports();
        while ($row = $doctorList->fetch(PDO::FETCH_ASSOC)) {
            $doctors[] = $row;
        }
        $output = fopen('php://output', 'w');
        fputcsv($output,['ID','First Name','Last Name','Gender','Contact','Age',
            'Address','Email','Qualification','From_time','To_time','DOB','District','State','Country','Pincode'
        ]);
        if (count($doctors) > 0) {
            foreach ($doctors as $row1) {
                fputcsv($output, $row1);
            }
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=DoctorReport.csv');
    }
}