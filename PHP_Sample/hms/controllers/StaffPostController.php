<?php 

/**
 *  StaffPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class.
 *  @var object $staffData instance of StaffData class.
 */
class StaffPostController extends Controller
{
    protected $fields = [
        'StaffName'=> 'text',
        'email' => 'email',
    ];
    protected $validator;
    protected $staffData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator object for Validator class.
     *  instantiates the staffData object for StaffData class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->staffData = new StaffData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  validates the fields and display error and success messages.
     *  @var array $postData has the data given in the form
     *  @var array $error used to display the error messages
     *  @var bool $success flag to check all the conditions passed or not.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        $postData = $_POST;
        $details = [
            'id' => $postData['staff_id'],
            'name' => $postData['StaffName'],
            'email' => $postData['email'],
            'password' => md5($postData['password'])
        ];
        $errors = $this->validator->process($postData);
        if ($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('Staff');
        }
        $success = false; 
        try {
            switch ($postData['submit']) {
                case 'Save':
                    $this->staffData->addStaff($details);
                    break;
                case 'Update':
                    $this->staffData->updateStaff($details);
                    break;
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add the staff');
        } 
        if ($success) {
            if ($postData['submit'] === 'Save') {
                $this->messageManager->addSuccessMessage('Staff Added Successfully..');
                $this->redirect('Staff');
            }
            if ($postData['submit'] === 'Update') {
                $this->messageManager->addSuccessMessage('Staff details updated...');
                $this->redirect('Staff');
            }
        }
    }
}