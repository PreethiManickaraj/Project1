<?php

/**
 *  ListPatientController renders the ListPatients view page
 */
class ListPatientsController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the ListPatients page.
     */
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Patient details',
            'description'=>'Click here to view details'
        );
        $this->view = 'ListPatients';
    }
}