<?php

/**
 *  PatientController renders the patient view page
 */
class PatientController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the patient page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Patient form',
            'description'=>'Click here to add details'
        );
        $this->view = 'patient';
    }
}