<?php 

class LoginPostController extends Controller{

    protected $email;
    protected $pass;

    public function __construct()
    {
        $this->validator = new Validator();
        parent::__construct();
    }
    public function process($params){
    }
}