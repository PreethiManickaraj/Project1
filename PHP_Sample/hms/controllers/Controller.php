<?php

/**
 *  Controller is the base Controller class
 *  @var array $data indexes will be accessible as variables in templates
 *  @var string $view template name without extension
 *  @var array $head  stores HTML head
 *  @var object $messageManager is instance of MessageManager class
 *  @var array $messages is used to store error and success messages
 */
abstract class Controller
{
    protected $data = [];
    protected $view = "";
	protected $head = ['title' => '', 'description' => ''];
    protected $messageManager;
    protected $messages = [];
    /**
     *  Method for instantiate object for MessageManager class.
     */
    public function __construct()
    {
        $this->messageManager = new MessageManager();
    }
    /**
     *  Method for rendering to the appropriate view page.
     *  calling getAllMessages function to display success,error and warning messages.
     *  gets the appropriate phtml file.
     */
    public function renderView()
    {
        $this->messages = $this->messageManager->getAllMessages();
        if ($this->view) {
            extract($this->data);
            extract($this->head);
            extract($this->messages);
            require("views/" . $this->view . ".phtml");
        }
        $this->messages = $this->messageManager->unsetMessages();
    }
    /**
     *  Method for redirecting the pages.
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
