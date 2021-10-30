<?php 
/**
 *  IndexController redirects to homepage
 */

class IndexController extends Controller {

    public function process($params)
    {   
        $this->head['title'] = 'MVC - Home Page';
        $this->head['description'] = 'MVC - Home Page';
        $this->view = 'index';
    }
}
