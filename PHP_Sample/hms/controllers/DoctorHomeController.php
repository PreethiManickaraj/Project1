<?php

/**
 *  DoctorHomeController renders the DoctorHome view page
 */
class DoctorHomeController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the DoctorHome page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Doctor','description'=>'Doctor Home Page'];
        $this->view = 'DoctorHome';
    }
}