<?php

/** 
 *  StaffHomeController renders the StaffHome view page
 */
class StaffHomeController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the StaffHome page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Staff Home','description'=>'Staff Home Page'];
        $this->view = 'StaffHome';
    }
}