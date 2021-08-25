<?php 

class StaffPostController extends Controller
{
    protected $fields = [
        'StaffName'=> 'text',
        'email' => 'email',
        'password' => 'string'
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
            return $this->redirect('staff');
        }
        $success = false;
        try {
            $this->hosData->addStaff($postData['StaffName'],$postData['email'],md5($postData['password']));
            $success = true;
        }catch (EntityAlreadyExistsException $ea){
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add the staff');
        } 
        
        if($success)
        {
            $this->messageManager->addSuccessMessage('Staff Added Successfully');
            $this->redirect('admin');
        }
    }
}