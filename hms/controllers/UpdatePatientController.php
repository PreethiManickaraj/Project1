<?php

/** 
 *  UpdatePatientController renders the updatePatient view page
 */
class UpdatePatientController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the updatePatient page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Update Patient',
            'description'=>'Update details of patient'
        );
        $this->view = 'updatePatient';
    }
}