<?php 

/**
 *  HomeController renders the home page
 */
class HomeController extends Controller 
{
    /**
     *  Method for setting title and description.
     *  Renders the Home page.
     */
    public function process($params)
    {   
        $this->head['title'] = 'Hospital Management System';
        $this->head['description'] = 'Home Page';
        $this->view = 'Home';
    }
}
