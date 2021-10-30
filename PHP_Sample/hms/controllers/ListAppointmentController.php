<?php

/**
 *  ListAppointmentController class renders the ListAppointment view page. 
 */
class ListAppointmentController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the ListAppointment page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Add Prescription','description'=>'Adding Prescription details'];
        $this->view = 'ListAppointment';
    }
}