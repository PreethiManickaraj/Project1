<?php 

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
    protected $DoctorData;
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->DoctorData = new DoctorData();
        parent::__construct();
    }
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
            $this->DoctorData->addDoctor($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address'],$postData['qualification'],$postData['district'],$postData['state'],$postData['country'],$postData['pincode']);
            $success = true;
        }catch (EntityAlreadyExistsException $ea){
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add patient');
        } 
        
        if($success)
        {
            $this->messageManager->addSuccessMessage('Doctor details added Successfully');
            $this->redirect('admin');
        }
    }
}