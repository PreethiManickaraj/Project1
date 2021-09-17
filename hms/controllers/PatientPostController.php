<?php 

/**
 *  PatientPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the fields and its types given in form.
 *  @var object $validator instance of Validator class.
 *  @var object $patientData instance of PatientData class.
 */
class PatientPostController extends Controller
{
    protected $fields = [
        'firstname'=> 'string',
        'lastname' => 'string',
        'gender' => 'string',
        'dob' => 'date',
        'age' => 'int',
        'email' => 'email',
        'contact' => 'int',
        'password' => 'string',
        'address' => 'string'
    ];
    protected $validator;
    protected $patientData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator for Validator class
     *  instantiates the patientData for PatientData class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->patientData = new PatientData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  Validates the fields and shows error and success messages.
     *  @param array $params url address in array
     *  @var array $postData contains the form fields
     *  @var array $errors shows error messages
     *  @var bool flag to check the conditions passed or not.
     */
    public function process($params)
    {
        $postData = $_POST;
        $errors = $this->validator->process($postData);
        if($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('addpatient');
        }
        $success = false;
        try {
            switch($postData['submit'])
            {
                case 'Save':
                    $this->patientData->addPatient($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
                    break;
                case 'Update':
                    $this->patientData->updatePatient($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
                    break;
            }
            $success = true;
        } catch(EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch(\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add patient');
        }
        if($success) {
            if($postData['submit']==="Save") {
                $this->messageManager->addSuccessMessage('Patient details added Successfully');
                $this->redirect('Patient');
            }
            if($postData['submit']==='Update') {
                $this->messageManager->addSuccessMessage('Patient details updated');
                $this->redirect('ListPatients');
            }
        }
    }
}