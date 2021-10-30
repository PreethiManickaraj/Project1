<?php

/**
 *  ErrorController class redirects to error page
 */
class ErrorController extends Controller
{
    /**
     *  Method for setting title.
     *  Renders the error page.
     */
    public function process($params)
    {
        header("HTTP/1.1 404 Not Found");
        $this->head['title'] = 'Error 404';
        $this->view = 'error';
    }
}