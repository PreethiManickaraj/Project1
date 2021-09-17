<?php

/**
 *  AddPresbController class renders the AddPresb view page. 
 */
class AddPresbController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the AddPresb page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Add Prescription',
            'description'=>'Adding Prescription details'
        );
        $this->view = 'AddPresb';
    }
}