<?php

/**
 *  ErrorController class redirects to error page
 */

class ErrorController extends Controller
{
    public function process($params)
    {
        /**
         *  file not exists then redirects to error page
         */
        header("HTTP/1.1 404 Not Found");
        $this->head['title'] = 'Error 404';
        $this->view = 'error';
    }
}