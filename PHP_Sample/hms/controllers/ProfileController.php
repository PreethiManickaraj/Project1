<?php 

/** 
 *  ProfileController renders the profile view page
 */
error_reporting(0);
class ProfileController extends Controller
{
    /**
     *  Method for setting title and description.
     *  Renders the profile page.
     */
    public function process($params){
        $this->head = ['title'=>'User Profile','description'=>'User Profile Page'];
        $this->view = 'profile';
    }
}
