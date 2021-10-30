<?php

/** 
 *  DoctorReportController renders the Doctor Report page
 */
class DoctorReportController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the Doctor Report page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Doctor Report','description'=>'Doctor Report Page'];
        $this->view = 'DoctorReport';
    }
}