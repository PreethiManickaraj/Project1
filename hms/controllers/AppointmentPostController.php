<?php 

/**
 *  AppointmentPostController class process the data given in the form.
 *  This class validates the fields and calls the addPresb function to add appointment.
 *  @var array $fields This has a type of fields as values.
 *  @var object $validator This is object of Validator class.
 *  @var object $appointmentData This is object of AppointmentData class.
 */

class AppointmentPostController extends Controller
{
    protected $validator;
    protected $appointmentData;
    public function __construct()
    {
        $this->appointmentData = new AppointmentData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  @param array $params url address in array
     */
    public function process($params)
    {
        $postData = $_POST;
        $details = [
            'patient_id' => $postData['p_id'],
            'doctor_id' => $postData['doctor_id'],
            'appointment_date' => $postData['appointment_date'],
            'appointment_from_time' => $postData['app_from_time'],
            'appointment_to_time' => $postData['app_to_time'],
            'status' => 'Opened'
        ];
        $success = false;
        try {
            switch ($postData['submit']) {
                case 'Save':
                    $this->appointmentData->addAppointment($details);
                    break;
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Unable to book appointment');
        }
        if ($success) {
            if ($postData['submit'] === "Save") {
                $this->messageManager->addSuccessMessage('Appointment Booked Successfully');
                $this->redirect('Appointment');
            }
        }
    }
}
