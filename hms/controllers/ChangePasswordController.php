<?php

/**
 *  AddPresbController class renders the AddPresb view page. 
 */
class ChangePasswordController extends Controller 
{
    /**
     *  Method for setting title and description
     *  Renders the AddPresb page.
     */
    public function process($postParams)
    {
        $this->head = ['title'=>'Change Password','description'=>'Change Password details'];
        $this->view = 'ChangePassword';
    }
}