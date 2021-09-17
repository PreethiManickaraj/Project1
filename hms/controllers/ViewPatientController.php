<?php

/** 
 *  ViewPatientController renders the ViewPatient view page
 */
class ViewPatientController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the ViewPatient page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'View Patient',
            'description'=>'View Patient details'
        );
        $this->view = 'ViewPatient';
    }
}