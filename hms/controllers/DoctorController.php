<?php

class DoctorController extends Controller 
{
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Doctor form',
            'description'=>'Click here to add details'
        );

        $this->view = 'doctor';
    }
}