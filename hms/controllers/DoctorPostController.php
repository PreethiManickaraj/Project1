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
        'address' => 'string'
    ];
    protected $validator;
    protected $hosData;
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->hosData = new hosData();
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
            $this->hosData->addDoctor($postData['firstname'],$postData['lastname'],$postData['gender'],$postData['dob'],$postData['age'],$postData['email'],$postData['contact'],md5($postData['password']),$postData['address']);
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