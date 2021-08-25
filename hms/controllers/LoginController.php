<?php 

class LoginController extends Controller{

    public function process($params){
        $this->head = array(
            'title'=>'Login form',
            'description'=>'Click here to Login'
        );

        $this->view = 'login';
    }
}
