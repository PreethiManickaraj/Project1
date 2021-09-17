<?php 

/** 
 *  LoginPostController process the data given by the user and login according to the role.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the field and type given in the form.
 *  @var object $validator instance of Validator class
 *  @var object $adminData instance of AdminData class
 *  @var object $patientData instance of PatientData class
 *  @var object $staffData instance of StaffData class
 *  @var object $doctorData instance of DoctorData class
 */

class LoginPostController extends Controller
{
    protected $fields = [
        'email' => 'email',
        'password' => 'string'
    ];
    protected $validator;

    protected $adminData;
    protected $patientData;
    protected $staffData;
    protected $doctorData;
    protected $cookieData;
    /**
     *  Method for instantiate the objects for class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->adminData = new AdminData();
        $this->patientData = new PatientData();
        $this->staffData = new StaffData();
        $this->doctorData = new DoctorData();
        $this->cookieData = new CookieManager();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  Validates the fields and shows error and success messages and stored role in session variable.
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
            return $this->redirect('login');
        }
        $success = false;
        try {
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to login the user');
        } 
        $_SESSION['role'] = $postData['role'];
        if($success) {
            switch($postData['role'])
            {
                case 'admin':
                    $login = $this->adminData->selectAdmin($postData['email'],md5($postData['password']));
                    if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login[0]['user_id'],$login[0]['role'],$postData['role']);
                        $this->redirect('AdminHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                case 'staff':
                    $login = $this->staffData->selectStaff($postData['email'],md5($postData['password']));
                    if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login[0]['staff_id'],$login[0]['name'],$postData['role']);
                        $this->redirect('StaffHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                case 'patient':
                    $login = $this->patientData->selectPatient($postData['email'],md5($postData['password']));
                    if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login[0]['p_id'],$login[0]['firstName'],$postData['role']);
                        $this->redirect('PatientHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                case 'doctor':
                    $login = $this->doctorData->selectDoctor($postData['email'],md5($postData['password']));
                    if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login[0]['d_id'],$login[0]['firstName'],$postData['role']);
                        $this->redirect('DoctorHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
            }
        }
    }
}