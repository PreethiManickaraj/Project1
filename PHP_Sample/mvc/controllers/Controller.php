<?php

/**
 *  Controller is the base Controller class
 *  @var array $data indexes will be accessible as variables in templates
 *  @var string $view template name without extension
 *  @var array $head  stores HTML head
 *  @var string $messageManager instance of MessageManager class
 *  @var array $messages stores the error, success, warning messages
 */
abstract class Controller
{
    protected $data = [];
    protected $view = "";
	protected $head = array('title' => '', 'description' => '');
    protected $messageManager;
    protected $messages = [];
    
    public function __construct()
    {
        // instantiates the MessageManager class
        $this->messageManager = new MessageManager();
    }

    /**
     *  Renders the view page
     */
    
    public function renderView()
    {
        // calling getAllMessages method in MessageManager class
        $this->messages = $this->messageManager->getAllMessages();
        if ($this->view)
        {
            extract($this->data);
            extract($this->head);
            extract($this->messages);
            require("views/" . $this->view . ".phtml");
        }
        // clears the messages after clearing errors
        $this->messages = $this->messageManager->unsetMessages();
    }
    /**
     *  @param string $url redirects to given url
     */

	public function redirect($url)
	{
		header("Location: /$url");
		header("Connection: close");
        exit;
	}
    
    /**
     *  main controller method
     *  @param array $params URL parameters 
     */
    abstract function process($params);

}
