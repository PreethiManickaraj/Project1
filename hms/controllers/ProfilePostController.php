<?php 

/**
 *  ProfilePostController process the data given by user.
 *  This class validates the fields and shows error and success messages.
 *  @var array $fields has the datatype of fields.
 *  @var object $validator is the instance of Validator class.
 *  @var object $imageData instance of ImageData class.
 */
class ProfilePostController extends Controller
{
    protected $fields = [
        'admin_image'=>'string'
    ];
    protected $imageData;
    /**
     *  Method for instantiate the object for class.
     *  instantiates the validator object for Validator class.
     *  instantiates the imageData object for ImageData class.
     */
    public function __construct()
    {
        $this->imageData = new ImageData();
        $this->adminData = new AdminData();
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
        $success = false; 
        try {
            switch ($postData['submit']) {
                case 'Upload':
                    if ($_SESSION['role'] === 'admin') {
                        if (isset($_POST['submit'])) {
                            $file = $_FILES['admin_image'];
                            $fileName = $_FILES['admin_image']['name'];
                            $fileTmpName = $_FILES['admin_image']['tmp_name'];
                            $fileSize = $_FILES['admin_image']['size'];
                            $fileError = $_FILES['admin_image']['error'];
                            $fileType = $_FILES['admin_image']['type'];
                            $fileExt = explode('.',$fileName);
                            $fileActualExt = strtolower(end($fileExt));
                            $imgContent = addslashes(file_get_contents($fileTmpName)); 
                            $allowed  = array('jpg','jpeg','png','pdf');
                            $cookie = json_decode($_COOKIE['userdata'],true);
                            if (in_array($fileActualExt, $allowed)){
                                if ($fileError === 0){
                                    if ($fileSize < 1000000){
                                        $fileNewName = $cookie['username'].$cookie['id'].".". $fileActualExt;
                                        $fileDestination = "views/AdminImageUploads/". $fileNewName;
                                        $details = ['id'=>$cookie['id'],'admin_image'=>$fileNewName];
                                        if (file_exists("views/AdminImageUploads/") === true) {
                                            unlink("views/AdminImageUploads/". $fileNewName);
                                            $this->imageData->deleteImage($details);
                                            move_uploaded_file($fileTmpName,$fileDestination);
                                            $this->imageData->addImage($details);
                                        } else {
                                            move_uploaded_file($fileTmpName,$fileDestination);
                                            $this->imageData->addImage($details);
                                        }
                                    } else {
                                        echo "Your file is too big";
                                    }
                                } else {
                                    echo "There was an error in uploading your file";
                                }
                            } else {
                                echo "You cannot upload files of this type";
                            }
                        }
                    }
            }
            $success = true;
        } catch (EntityAlreadyExistsException $ea) {
            $this->messageManager->addErrorMessage($ea->getMessage());
        } catch (\Exception $e) {
            $this->redirect('AdminHome');
            $this->messageManager->addErrorMessage('Unable to add the photo');
        } 
        if ($success) {
            if ($postData['submit'] === 'Upload') {
                $this->messageManager->addSuccessMessage('Profile Photo Uploaded..');
                $this->redirect('profile');
            }
        }
    }
}