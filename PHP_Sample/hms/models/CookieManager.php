<?php 

/**
 *  CookieManager model class used to set data and unset data in cookie variable.
 */
class CookieManager 
{
    /**
     *  Method for set the data in cookie.
     *  @param int $id is the user id.
     *  @param string $username is the name of the user.
     *  @param string $role is the role of the user.
     */
    public function setData($id,$username,$role)
    {
        setcookie("userdata",json_encode(['username'=>$username,'id'=>$id,'roles'=>$role]),time()+7200);
    }
    /**
     *  Method for unset the data in the cookie.
     */
    public function unsetData()
    {
        setcookie("userdata","",time()-60);
    }
}