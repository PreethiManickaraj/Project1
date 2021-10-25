<?php 

/**
 *  ChangePasswordPostController process the data given by the user.
 *  This class validates the fields,add and update the password details.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class
 *  @var object $doctorData is the instance of DoctorData class
 */
class ChangePasswordPostController extends Controller
{
    protected $fields = [
        'ChangePassword'=> 'string',
        
    ];
    protected $validator;
    /**
     *  Method for instantiate the objects for class.
     *  instantiates object for Validator and DoctorData class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->adminData = new AdminData();
        $this->doctorData = new DoctorData();
        $this->patientData = new PatientData();
        $this->staffData = new StaffData();
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
        if(isset($_GET['user_id'])) {
            $id = $_GET['user_id'];
        }
        $errors = $this->validator->process($postData);
        $success = false;
        try {
            switch ($postData['submit']) {
                case 'Update':
                    if ($_SESSION['role']==="admin") {
                        $this->adminData->updatePassword(md5($postData['ChangePassword']),$id);
                        break;
                    }
                    if ($_SESSION['role']==="doctor") {
                        $this->doctorData->updatePassword(md5($postData['ChangePassword']),$id);
                        break;
                    }
                    if ($_SESSION['role']==="staff") {
                        $this->staffData->updatePassword(md5($postData['ChangePassword']),$id);
                        break;
                    }
                    if ($_SESSION['role']==="patient") {
                        $this->patientData->updatePassword(md5($postData['ChangePassword']),$id);
                        break;
                    }
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to change password');
        } 
        if ($success) {
            if ($postData['submit'] === 'Update') {
                $this->messageManager->addSuccessMessage('Password changed successfully');
                $this->redirect('profile');
            }
        }
    }
}