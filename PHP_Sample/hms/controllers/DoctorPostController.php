<?php 

/**
 *  DoctorPostController process the data given by the user.
 *  This class validates the fields,add and update the doctor details.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class
 *  @var object $doctorData is the instance of DoctorData class
 */
class DoctorPostController extends Controller
{
    protected $fields = [
        'firstname'=> 'string',
        'lastname' => 'string',
        'gender' => 'string',
        'dob' => 'date',
        'age' => 'int',
        'email' => 'email',
        'contact' => 'int',
        'address' => 'string',
        'qualification' => 'string'
    ];
    protected $validator;
    protected $doctorData;
    protected $countryData;
    /**
     *  Method for instantiate the objects for class.
     *  instantiates object for Validator and DoctorData class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->doctorData = new DoctorData();
        $this->countryData = new CountryData();
        parent::__construct();
    }
    /**
     *  Method for Processing the data given in the form.
     *  validates the fields and display error and success messages.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        $postData = $_POST;
        $countryName = $this->countryData->SelectCountryName($postData['country']);
        $details = [
            'd_id' => $postData['d_id'],
            'firstname' => $postData['firstname'],
            'lastname' => $postData['lastname'],
            'gender' => $postData['gender'],
            'dob' => $postData['dob'],
            'age' => $postData['age'],
            'email' => $postData['email'],
            'contact' => $postData['contact'],
            'password' => md5($postData['password']),
            'address' => $postData['address'],
            'qualification' => $postData['qualification'],
            'district' => $postData['district'],
            'state' => $postData['state'],
            'country' => $countryName,
            'pincode' => $postData['pincode'],
            'specialist' => $postData['specialist'],
            'from_time' => $postData['from_time'],
            'to_time' => $postData['to_time']
        ];
        $errors = $this->validator->process($postData);
        if ($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('doctor');
        }
        $success = false;
        try {
            switch ($postData['submit']) {
                case 'Save':
                    $this->doctorData->addDoctor($details,1);
                    break;
                case 'Update':
                    $this->doctorData->updateDoctor($details,$postData['status']);
                    break;
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add doctor');
        } 
        if ($success) {
            if ($postData['submit'] === 'Save') {
                $this->messageManager->addSuccessMessage('Doctor details added Successfully');
                $this->redirect('Doctor');
            }
            if ($postData['submit'] === 'Update') {
                $this->messageManager->addSuccessMessage('Doctor details updated');
                $this->redirect('Doctor');
            }
        }
    }
}