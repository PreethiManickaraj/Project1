<?php

class AdminController extends Controller 
{
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Admin form',
            'description'=>'ADMIN PAGE'
        );
        if(isset($_POST['name'])){
            switch($_POST['name']){
                case "staff":
                    $this->redirect('Staff');
                    break;
                case "patient":
                    $this->redirect('Patient');
                    break;
                case "doctor":
                    $this->redirect('Doctor');
                    break;
            }
        }
        $this->view = 'admin';
    }
}