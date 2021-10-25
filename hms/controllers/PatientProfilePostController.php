<?php 

/**
 *  StaffPostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class.
 *  @var object $staffData instance of StaffData class.
 */
class PatientProfilePostController extends Controller
{
    protected $fields = [
        'patient_image'=>'string'
    ];
    protected $imageData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator object for Validator class.
     *  instantiates the staffData object for StaffData class.
     */
    public function __construct()
    {
        $this->imageData = new ImageData();
        $this->patientData = new PatientData();
        parent::__construct();
    }
    /**
     *  Method for processing the data given in the form.
     *  validates the fields and display error and success messages.
     *  @param array $params url address in the array.
     */
    public function process($params)
    {
        $postData = $_POST;
        if ($postData['submit'] === 'Update') {
            $cookie = json_decode($_COOKIE['userdata'],true);
            $this->patientData->updatePassword(md5($postData['ChangePass']),$cookie['id']);
        }
        $success = false; 
        try {
            switch ($postData['submit']) {
                case 'Upload':
                    if ($_SESSION['role'] === 'patient') {
                        if (isset($_POST['submit'])) {
                            $file = $_FILES['patient_image'];
                            $fileName = $_FILES['patient_image']['name'];
                            $fileTmpName = $_FILES['patient_image']['tmp_name'];
                            $fileSize = $_FILES['patient_image']['size'];
                            $fileError = $_FILES['patient_image']['error'];
                            $fileType = $_FILES['patient_image']['type'];
                            $fileExt = explode('.',$fileName);
                            $fileActualExt = strtolower(end($fileExt));
                            $imgContent = addslashes(file_get_contents($fileTmpName)); 
                            $allowed  = array('jpg','jpeg','png','pdf');
                            $cookie = json_decode($_COOKIE['userdata'],true);
                            
                            if (in_array($fileActualExt, $allowed)){
                                if ($fileError === 0){
                                    if ($fileSize < 1000000){
                                        $fileNewName = $cookie['username'].$cookie['id'].".". $fileActualExt;
                                        $fileDestination = "views/PatientImageUploads/". $fileNewName;
                                        $details = ['id'=>$cookie['id'],'patient_image'=>$fileNewName];
                                        if (file_exists("views/PatientImageUploads/".$fileNewName) === true) {
                                            unlink("views/PatientImageUploads/". $fileNewName);
                                            $this->imageData->deletePatientImage($details);
                                            move_uploaded_file($fileTmpName,$fileDestination);
                                            $this->imageData->addPatientImage($details);
                                        } else {
                                            move_uploaded_file($fileTmpName,$fileDestination);
                                            $this->imageData->addPatientImage($details);
                                        }
                                    } else {
                                        $this->messageManager->addErrorMessage("Your file is too big");
                                        $this->redirect('profile');
                                    }
                                } else {
                                    $this->messageManager->addErrorMessage("There was an error in uploading your file");
                                    $this->redirect('profile');
                                }
                            } else {
                                $this->messageManager->addErrorMessage("You cannot upload files of this type");
                                $this->redirect('profile');
                            }
                        }
                    }
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->redirect('PatientHome');
            $this->messageManager->addErrorMessage('Unable to add the photo');
            $this->redirect('PatientHome');
        } 
        if ($success) {
            if ($postData['submit'] === 'Upload') {
                $this->messageManager->addSuccessMessage('Profile Photo Uploaded..');
                $this->redirect('profile');
            }
            if ($postData['submit'] === 'Update') {
                $this->messageManager->addSuccessMessage('Password updated successfully');
                $this->redirect('profile');
            }
        }
    }
}