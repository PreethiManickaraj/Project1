<?php

class AdminController extends Controller 
{
    public function process($postParams)
    {
        $this->head = array(
            'title'=>'Admin form',
            'description'=>'ADMIN PAGE'
        );

        $this->view = 'admin';
    }
}