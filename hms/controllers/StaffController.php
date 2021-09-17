<?php

/** 
 *  StaffController renders the Staff view page
 */
class StaffController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the Staff page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Staff',
            'description'=>'Staff Page'
        );
        $this->view = 'staff';
    }
}