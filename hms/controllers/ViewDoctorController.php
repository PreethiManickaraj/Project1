<?php

/**
 *  ViewDoctorController renders the ViewDoctor view page
 */

class ViewDoctorController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the ViewDoctor page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'View Doctor',
            'description'=>'View Doctor details'
        );
        $this->view = 'ViewDoctor';
    }
}