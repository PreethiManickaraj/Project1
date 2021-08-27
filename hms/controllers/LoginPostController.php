<?php 

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
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->adminData = new AdminData();
        $this->patientData = new PatientData();
        $this->staffData = new StaffData();
        $this->doctorData = new DoctorData();
        parent::__construct();
    }

    public function process($params)
    {
        $postData = $_POST;
        //print_r($postData);
        $errors = $this->validator->process($postData);
       
        if($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('login');
        }
        $success = false;
        try {
            $success = true;
        }catch (EntityAlreadyExistsException $ea){
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to login the user');
        } 
        
        if($success){
            switch($postData['role']){
            case 'admin':
                $login = $this->adminData->selectAdmin($postData['email'],md5($postData['password']));
                if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password']))
                {
                $this->messageManager->addSuccessMessage('Login Successfull.');
                $this->redirect('admin');
                } else{
                $this->messageManager->addErrorMessage('Enter correct credentials');
                $this->redirect('login');
                }
                break;
            case 'staff':
                $login = $this->staffData->selectStaff($postData['email'],md5($postData['password']));
                if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password']))
                {
                $this->messageManager->addSuccessMessage('Login Successfull.');
                $this->redirect('staff');
                } else{
                $this->messageManager->addErrorMessage('Enter correct credentials');
                $this->redirect('login');
                }
                break;
            case 'patient':
                $login = $this->patientData->selectPatient($postData['email'],md5($postData['password']));
                if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password']))
                {
                $this->messageManager->addSuccessMessage('Login Successfull.');
                $this->redirect('patient');
                } else{
                $this->messageManager->addErrorMessage('Enter correct credentials');
                $this->redirect('login');
                }
                break;
            case 'doctor':
                $login = $this->doctorData->selectDoctor($postData['email'],md5($postData['password']));
                if($login[0]['email']===$postData['email'] && $login[0]['password']===md5($postData['password']))
                {
                $this->messageManager->addSuccessMessage('Login Successfull.');
                $this->redirect('patient');
                } else{
                $this->messageManager->addErrorMessage('Enter correct credentials');
                $this->redirect('login');
                }
                break;
            }
        }
    }
}