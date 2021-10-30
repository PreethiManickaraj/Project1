<?php 

/**
 *  LoginController renders the login page
 */
error_reporting(0);
class LoginController extends Controller
{
    /**
     *  Method for setting title and description.
     *  Renders the AddPresb page and redirects to the appropriate pages using cookies.
     *  @var array $cookie contains the cookie data.
     */
    public function process($params)
    {
        $this->head = ['title' => 'Login','description' => 'Login Page'];
        if (!$_COOKIE) {

            $this->view = 'login';

        } else {

            $cookie = json_decode($_COOKIE['userdata'],true);

            if ($cookie['roles'] === 'admin') {

                $this->redirect('AdminHome');

            } else if($cookie['roles'] === 'patient') {

                $this->redirect('PatientHome');

            } else if($cookie['roles'] === 'doctor') {

                $this->redirect('DoctorHome');

            } else if($cookie['roles'] === 'staff') {

                $this->redirect('StaffHome');

            }
        }
        $this->view = "login"; 
    }
}
