<?php

/**
 *  DoctorController renders the doctor view page.
 */
class DoctorController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the doctor page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Doctor',
            'description'=>'Doctor Page'
        );
        $this->view = 'doctor';
    }
}