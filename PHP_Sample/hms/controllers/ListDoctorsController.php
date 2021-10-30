<?php

/**
 *  ListDoctorController renders the ListDoctors view page
 */
class ListDoctorsController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the ListDoctors page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'List Doctors','description'=>'Listing the doctor details'];
        $this->view = 'ListDoctors';
    }
}