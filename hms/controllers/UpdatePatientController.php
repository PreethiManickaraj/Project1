<?php

class UpdatePatientController extends Controller 
{
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Patient form',
            'description'=>'Click here to add details'
        );

        $this->view = 'updatePatient';
    }
}