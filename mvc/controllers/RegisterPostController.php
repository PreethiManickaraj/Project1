<?php 

/**
 *  RegisterPostController class validates the fields given in forms.
 */

class RegisterPostController extends Controller{
    
    /**
     * @var array $fields associative array has form names as key and type as value
     * @var $validator instance of Validator class
     */
    protected $fields = [
        'firstname' => 'string',
        'lastname'  => 'string',
        'email' => 'email',
        'password' => 'string'
    ];
    protected $validator;

    protected $userData;
    public function __construct()
    {
        /**
         *  creating instance for Validator class and passing fields as arguments
         *  calling parent constructor function
         */
        $this->validator = new Validator($this->fields);
        $this->userData = new UserData();
        parent::__construct();
    }

    public function process($params)
    {
       /**
        * process is abstract method
        * @var array $postData has form data as array
        * @var array $errors to display error messages
        * @var string $success to display success message after complete registration
        */
        $postData = $_POST;
        
        $errors = $this->validator->process($postData);
       // $success = $this->validator->success($postData);
       
        if($errors) {
            // calling addErrorMessage method in Validator class to show errors in line by line
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            // redirects to registration page
            return $this->redirect('register');
        }
        $success = false;
        try {
            $this->userData->registerUser($postData['firstname'],$postData['lastname'],$postData['email'],$postData['password']);
            $success = true;
        }catch (EntityAlreadyExistsException $ea){

            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            print_r($e->getMessage());die;
            $this->messageManager->addErrorMessage('Unable to register the user');
        } 
        
        if($success){
            // calling  addSuccessMessage method in Validator class to show success message
            $this->messageManager->addSuccessMessage('User Registration Success.');
            $this->redirect('login');
        }

        $this->redirect('register');
    }
}
