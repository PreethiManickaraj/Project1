<?php 
/**
 *  IndexController redirects to homepage
 */

class IndexController extends Controller {

    public function process($params)
    {   
        $this->head['title'] = 'Hospital Management System';
        $this->head['description'] = 'Home Page';
        $this->view = 'index';
    }
}
