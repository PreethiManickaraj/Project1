<?php

/**
 *  AppointmentController class renders the Appointment view page. 
 */
error_reporting(0);
class AppointmentController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the Appointment page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Add Appointment','description'=>'Adding Appointment details'];
        $this->view = 'Appointment';
    }
}