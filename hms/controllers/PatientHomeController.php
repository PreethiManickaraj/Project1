<?php

/**
 *  PatientHomeController renders the PatientHome view page
 */
class PatientHomeController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the PatientHome page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Admin form',
            'description'=>'ADMIN PAGE'
        );
        $this->view = 'PatientHome';
    }
}