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
        'password' => 'string',
        'address' => 'string',
        'qualification' => 'string'
    ];
    protected $validator;
    protected $doctorData;
    /**
     *  Method for instantiate the objects for class.
     *  instantiates object for Validator and DoctorData class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->doctorData = new DoctorData();
        parent::__construct();
    }
    /**
     *  Method for Processing the data given in the form.
     *  validates the fields and display error and success messages.
     *  @var array $postData has the data given in the form
     *  @var array $error used to display the error messages
     *  @var bool $success flag to check all the conditions passed or not.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        $postData = $_POST;
        $errors = $this->validator->process($postData);
        if($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('doctor');
        }
        $success = false;
        try {
            switch($postData['submit'])
            {
                case 'Save':
                    $this->doctorData->addDoctor($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['qualification'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
                    break;
                case 'Update':
                    $this->doctorData->updateDoctor($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['qualification'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
                    break;
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add doctor');
        } 
        if($success) {
            if($postData['submit']==='Save') {
                $this->messageManager->addSuccessMessage('Doctor details added Successfully');
                $this->redirect('Doctor');
            }
            if($postData['submit']==='Update') {
                $this->messageManager->addSuccessMessage('Doctor details updated');
                $this->redirect('Doctor');
            }
        }
    }
}