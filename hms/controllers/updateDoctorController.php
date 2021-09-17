<?php

/**
 *  UpdateDoctorController  renders the updateDoctor view page
 */
class UpdateDoctorController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the updateDoctor page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Update Doctor',
            'description'=>'Update details of doctor'
        );
        $this->view = 'updateDoctor';
    }
}