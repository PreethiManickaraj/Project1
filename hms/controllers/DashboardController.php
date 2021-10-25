<?php

/**
 *  DashboardController class renders the dashboard view page. 
 */
class DashboardController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the dashboard page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Dashboard','description'=>'Dashboard'];
        $this->view = 'Dashboard';
    }
}