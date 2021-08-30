<?php 

class StaffPostController extends Controller
{
    protected $fields = [
        'StaffName'=> 'text',
        'email' => 'email',
        'password' => 'string'
    ];
    protected $validator;
    protected $StaffData;
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->StaffData = new StaffData();
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
            switch($postData['submit'])
            {
                case 'addStaff':
                    $this->StaffData->addStaff($postData['StaffName'],$postData['email'],md5($postData['password']));
                    break;
                case 'update':
                    $this->StaffData->updateStaff($postData['StaffName'],$postData['email'],md5($postData['password']));
                    break;
            }
            $success = true;
        }catch (EntityAlreadyExistsException $ea){
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add the staff');
        } 
        if($success)
        {
            if($postData['submit']==='addStaff')
            {
                $this->messageManager->addSuccessMessage('Staff Added Successfully!!!');
                $this->redirect('admin');
            }
            if($postData['submit']==='update')
            {
                $this->messageManager->addSuccessMessage('Staff Updated...');
                $this->redirect('admin');
            }
        }
    }
}