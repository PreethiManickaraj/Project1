<?php 

/**
 *  AddPresbPostController class process the data given in the form.
 *  This class validates the fields and calls the addPresb function to add Prescription.
 *  @var array $fields This has a type of fields as values.
 *  @var object $validator This is object of Validator class.
 *  @var object $presbData This is object of Prescription class.
 */

class AddPresbPostController extends Controller
{
    protected $fields = [
        'disease'=> 'string',
        'medicine'=>'string',
        'description'=> 'string'
    ];
    protected $validator;
    protected $presbData;
    /**
     *  Method for instantiate objects for class.
     */
    public function __construct()
    {
        $this->validator = new Validator($this->fields);
        $this->presbData = new Prescription();
        $this->appointmentData = new AppointmentData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  Validates the fields and shows error and success messages
     *  call the addPresb method by passing the form details.
     *  @param array $params url address in array
     */
    public function process($params)
    {
        $postData = $_POST;
        $cookie = json_decode($_COOKIE['userdata'],true);
        $disease = $_POST['disease'];
        $medicine = $_POST['medicine'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $days = $_POST['days'];
        $morning = $_POST['morning'];
        $noon = $_POST['noon'];
        $night = $_POST['night'];
        $details =[
            'disease' => $disease,
            'medicine'=> $medicine,
            'description'=> $description,
            'quantity' => $quantity,
            'days' => $days,
            'morning'=> $morning,
            'noon' => $noon,
            'night' => $night,
            'p_id' => $postData['patientId'],
            'd_id' => $cookie['id']
        ];
        $status = 'Closed';
        $errors = $this->validator->process($postData);
        if ($errors) {
            $this->messageManager->addErrorMessage(implode(' </br>', $errors));
            return $this->redirect('AddPresb');
        }
        $success = false;
        try {
            switch ($postData['submit']) {
                case 'Save':
                    $this->presbData->addPresb($details);
                    $this->appointmentData->updateStatus($status,$postData['patientId']);
                    break;
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to add Prescrption');
        } 
        if ($success) {
            if ($postData['submit'] === 'Save') {
                $this->messageManager->addSuccessMessage('Prescription added Successfully');
                $this->redirect('AddPresb');
            }
        }
    }
}