<?php

/**
 *  ListStaffsController renders the ListStaffs view page
 */
class ListStaffsController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the ListStaffs page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Staff details','description'=>'List the staff details'];
        $this->view = 'ListStaffs';
    }
}