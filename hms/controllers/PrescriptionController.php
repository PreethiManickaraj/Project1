<?php

/**
 *  PrescriptionController renders the DoctorHome view page
 */
class PrescriptionController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the Prescription page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Prescription Details','description'=>'Prescription Details Page'];
        $this->view = 'Prescription';
    }
}