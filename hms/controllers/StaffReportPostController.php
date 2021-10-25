<?php 

/**
 *  StaffReportPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class.
 *  @var object $staffData instance of StaffData class.
 */
class StaffReportPostController extends Controller
{
    protected $staffData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator object for Validator class.
     *  instantiates the staffData object for StaffData class.
     */
    public function __construct()
    {
        $this->staffData = new StaffData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  validates the fields and display error and success messages.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        
        $staffs = [];
        $staffList = $this->staffData->listStaffReports();
        while ($row = $staffList->fetch(PDO::FETCH_ASSOC)) {
            $staffs[] = $row;
        }
        $output = fopen('php://output', 'w');
        fputcsv($output,['ID','Name','Email']);
        if (count($staffs) > 0) {
            foreach ($staffs as $row1) {
                fputcsv($output,$row1);
            } 
        }
        header('Content-Type: text/csv/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename=StaffReport.csv');
    }
}