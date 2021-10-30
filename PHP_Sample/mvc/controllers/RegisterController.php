<?php 
/**
 *  RegisterController class 
 */

class RegisterController extends Controller
{
    public function process($params)
    {
        // sets head tag 
        $this->head = array(
            'title'=>'Register Form',
            'description'=>'Click here for New Registration'
        );
        // sets the template to register
        $this->view = 'register';
    }
}