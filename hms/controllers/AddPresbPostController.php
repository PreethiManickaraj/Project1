<?php 

/**
 *  AddPresbPostController class process the data given in the form.
 *  This class validates the fields and calls the addPresb function to add Prescription.
 *  @var array $fields This has a type of fields as values.
 *  @var object $validator This is object of Validator class.
 *  @var object $appointmentData This is object of AppointmentData class.
 */

class AddPresbPostController extends Controller
{
    protected $fields = [
        'disease'=> 'string',
        'drug_name' => 'string',
        'drug_quantity' => 'string',
        'prescription' => 'string',
    ];
    protected $validator;
    protected $appointmentData;
    /**
     *  Method for instantiate objects for class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->appointmentData = new AppointmentData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  Validates the fields and shows error and success messages
     *  call the addPresb method by passing the form details.
     *  @param array $params url address in array
     *  @var array $postData contains the form fields
     *  @var array $errors shows error messages
     *  @var bool $success flag to check the conditions passed or not.
     */
    public function process($params)
    {
        $postData = $_POST;
        $errors = $this->validator->process($postData);
        if($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('AddPresb');
        }
        $success = false;
        try {
            switch($postData['submit'])
            {
                case 'Save':
                    $this->appointmentData->addPresb($postData['patientId'],$postData['disease'],$postData['drug_name'],$postData['drug_quantity'],$postData['prescription']);
                    break;
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add doctor');
        } 
        
        if($success) {
            if($postData['submit']==='Save') {
                $this->messageManager->addSuccessMessage('Prescription added Successfully');
                $this->redirect('AddPresb');
            }
        }
    }
}