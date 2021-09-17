<?php 
/**
 *  LogoutController renders the logout view page.
 *  @var object $cookieData is object for CookieManager class.
 */
class LogoutController extends Controller
{
    protected $cookieData;
    /**
     *  Method for instantiate cookieData for CookieManager class.
     */
    public function __construct()
    {
        $this->cookieData = new CookieManager();
    }
    /**
     *  Method for rendering the logout page
     *  unset the cookie data and redirect to login page.
     */
    public function process($params)
    {
        $this->head = array(
            'title'=>'Logout',
            'description'=>'Logout Page'
        );
        $this->cookieData->unsetData();
        $this->redirect("login");
    }
}
