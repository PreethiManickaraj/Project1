<?php

/** 
 *  StaffReportController renders the Staff report view page
 */
class StaffReportController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the Staff Report page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Staff Report','description'=>'Staff Report Page'];
        $this->view = 'StaffReport';
    }
}