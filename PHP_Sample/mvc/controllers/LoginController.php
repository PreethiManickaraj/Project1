<?php 

class LoginController extends Controller{

    public function process($params){
        $this->head = array(
            'title'=>'Login form',
            'description'=>'Click here to Login'
        );

        if(isset($_POST["firstname"]) && isset($_POST["password"])){
            $login = new Login();
            $login->selectData($_POST["firstname"],$_POST["password"]);
        }

        $this->view = 'login';
    }
}