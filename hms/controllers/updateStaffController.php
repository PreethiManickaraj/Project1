<?php

/**
 *  UpdateStaffController renders the updateStaff view page
 */
class UpdateStaffController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the updateStaff page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Update Staff',
            'description'=>'Update details of Staff'
        );
        $this->view = 'updateStaff';
    }
}