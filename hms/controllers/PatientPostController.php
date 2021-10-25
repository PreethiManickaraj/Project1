<?php 
/**
 *  PatientPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 */
class PatientPostController extends Controller
{
    protected $fields = [
        'firstname'=> 'string',
        'lastname' => 'string',
        'dob' => 'date',
        'age' => 'int',
        'email' => 'email',
        'contact' => 'int',
        'address' => 'string'
    ];
    protected $validator;
    protected $patientData;
    protected $countryData;
    protected $stateData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator for Validator class
     *  instantiates the patientData for PatientData class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->patientData = new PatientData();
        $this->countryData = new CountryData();
        $this->stateData = new StateData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  Validates the fields and shows error and success messages.
     *  @param array $params url address in array
     */
    public function process($params)
    {
        $postData = $_POST;
        $countryName = $this->countryData->SelectCountryName($postData['country']);
        $details = [
            'p_id' => $postData['p_id'],
            'firstname' => $postData['firstname'],
            'lastname' => $postData['lastname'],
            'gender' => $postData['gender'],
            'dob' => $postData['dob'],
            'age' => $postData['age'],
            'email'=> $postData['email'],
            'contact' => $postData['contact'],
            'password' => md5($postData['password']),
            'address' => $postData['address'],
            'district' => $postData['district'],
            'state' => $postData['state'],
            'country' => $countryName,
            'pincode' => $postData['pincode'],
        ];
        $errors = $this->validator->process($postData);
        if ($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('Patient');
        }
        $success = false;
        try {
            switch ($postData['submit']) {
                case 'Save':
                    $this->patientData->addPatient($details);
                    break;
                case 'Update':
                    $this->patientData->updatePatient($details);
                    break;
                default:
                    $this->redirect('Patient');
                    $this->messageManager->addErrorMessage('Unable to add/update patient');
            }
            $success = true;
        } catch(EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch(\Exception $e) {
            $this->redirect('Patient');
            $this->messageManager->addErrorMessage('Unable to add patient');
        }
        if ($success) {
            if($postData['submit'] === "Save") {
                $this->messageManager->addSuccessMessage('Patient details added Successfully');
                $this->redirect('Patient');
            }
            if ($postData['submit'] === 'Update') {
                $this->messageManager->addSuccessMessage('Patient details updated');
                $this->redirect('ListPatients');
            }
        }
    }
}