<?php

class StaffController extends Controller 
{
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Staff Login form',
            'description'=>'Click here to Login'
        );

        $this->view = 'staff';
    }
    
}