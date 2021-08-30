<?php

class UpdateDoctorController extends Controller 
{
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Doctor form',
            'description'=>'Click here to update details'
        );
        $this->view = 'updateDoctor';
    }
}