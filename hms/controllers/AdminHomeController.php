<?php

/**
 *  AdminHomeController renders the AdminHome view page
 */
class AdminHomeController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the AdminHome page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Admin','description'=>'Admin  Home Page'];
        $this->view = 'AdminHome';
    }
}