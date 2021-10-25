<?php

/** 
 *  PatientReportController renders the patient report view page
 */
class PatientReportController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the patient report page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Patient Report','description'=>'Patient Report Details'];
        $this->view = 'PatientReport';
    }
}