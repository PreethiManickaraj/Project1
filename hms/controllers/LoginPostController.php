<?php 

/** 
 *  LoginPostController process the data given by the user and login according to the role.
 *  This class validates the fields and shows error and success messages.
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
     */
    public function process($params)
    {
        $postData = $_POST;
        $errors = $this->validator->process($postData);
        if ($errors) {
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
        if ($success) {
            switch($postData['role']) {
                case 'admin':
                    $loginData = $this->adminData->selectAdmin($postData['email'],md5($postData['password']));
                    $login = $loginData[0];
                    if ($login['email'] === $postData['email'] && $login['password'] === md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login['user_id'],$login['role'],$postData['role']);
                        $this->redirect('AdminHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                case 'staff':
                    $loginData = $this->staffData->selectStaff($postData['email'],md5($postData['password']));
                    $login = $loginData[0];
                    if ($login['email'] === $postData['email'] && $login['password'] === md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login['staff_id'],$login['name'],$postData['role']);
                        $this->redirect('StaffHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                case 'patient':
                    $loginData = $this->patientData->selectPatient($postData['email'],md5($postData['password']));
                    $login = $loginData[0];
                    if ($login['email'] === $postData['email'] && $login['password'] === md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login['p_id'],$login['firstname'],$postData['role']);
                        $this->redirect('Prescription');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                case 'doctor':
                    $loginData = $this->doctorData->selectDoctor($postData['email'],md5($postData['password']));
                    $login = $loginData[0];
                    if ($login['email'] === $postData['email'] && $login['password'] === md5($postData['password'])) {
                        $this->messageManager->addSuccessMessage('Login Successfull.');
                        $this->cookieData->setData($login['d_id'],$login['firstname'],$postData['role']);
                        $this->redirect('DoctorHome');
                    } else {
                        $this->messageManager->addErrorMessage('Enter correct credentials');
                        $this->redirect('login');
                    }
                    break;
                default:
                    $this->messageManager->addErrorMessage('Enter correct credentials');
                    $this->redirect('login');
                    break;
            }
        }
    }
}