<?php 

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
    protected $PatientData;
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->PatientData = new PatientData();
        parent::__construct();
    }
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
            switch($postData['submit']){
                case 'addPatient':
                    $this->PatientData->addPatient($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
                    break;
                case 'update':
                    $this->PatientData->updatePatient($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
                    break;
                }
            $success = true;
        }catch (EntityAlreadyExistsException $ea){
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add patient');
        }
        
        if($success)
        {
            if($postData['submit']==="addPatient")
            {
                $this->messageManager->addSuccessMessage('Patient details added Successfully');
                $this->redirect('admin');
            }
            if($postData['submit']==='update')
            {
                $this->messageManager->addSuccessMessage('Patient details updated');
                $this->redirect('admin');
            }
        }
    }
}