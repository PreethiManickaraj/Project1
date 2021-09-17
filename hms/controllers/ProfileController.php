<?php 

/** 
 *  ProfileController renders the profile view page
 */
class ProfileController extends Controller
{
    /**
     *  Method for setting title and description.
     *  Renders the profile page.
     */
    public function process($params){
        $this->head = array(
            'title'=>'User Profile',
            'description'=>'User Profile Page'
        );
        $this->view = 'profile';
    }
}
