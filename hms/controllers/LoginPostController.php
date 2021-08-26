<?php 

/**
 *  RegisterPostController class validates the fields given in forms.
 */

class LoginPostController extends Controller
{
    protected $fields = [
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
            return $this->redirect('login');
        }
        $success = false;
        try {
            $this->hosData->loginUser($postData['email'],$postData['password']);
            $success = true;
        }catch (EntityAlreadyExistsException $ea){
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to login the user');
        } 
        
        if($success){
            if($postData['email']==='admin@gmail.com' && $postData['password']==='admin')
            {
                $this->messageManager->addSuccessMessage('Login Successfull.');
                $this->redirect('admin');
            } else{
                $this->messageManager->addErrorMessage('Enter correct credentials');
                $this->redirect('login');
            }
        }
    }
}