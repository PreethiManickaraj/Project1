<?php

/**
 * RouterController class is used to call appropriate
 * controllers according to users URL.
 * @var controller Inner controller instance
 */
class RouterController extends Controller
{
	protected $controller;
	/**
	 *  Method for segregating slashes and url.
	 *  @param string $url for passing url address
	 *  @return array url parameters
	 */
	private function parseUrl($url)
	{
		$parsedUrl = parse_url($url);
		$parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
		$parsedUrl["path"] = trim($parsedUrl["path"]);
		$explodedUrl = explode("/", $parsedUrl["path"]);
		return $explodedUrl;
	}
	/**
	 *  This function is used for converting first letter of word to uppercase
	 *  @param string controller name is passed
	 *  @return string returns controller class name's first letter as uppercase
	 */
	private function dashesToCamel($text)
	{
		$text = str_replace('-', ' ', $text);
		$text = ucwords($text);
		$text = str_replace(' ', '', $text);
		return $text;
	}
	/**
	 *  Parses url address and creates appropriate controller
	 *  @param array $params url address in array 
	 *  @var array $parsedUrl has the url in associative array.
	 *  @var string $controllerClass has the controller name.
	 */
	public function process($params)
	{
		$parsedUrl = $this->parseUrl($params[0]);
		if(empty($parsedUrl[0])) {
			$controllerClass = 'HomeController';
		} else {	
			$controllerClass = $this->dashesToCamel(array_shift($parsedUrl)) . 'Controller';
		}
		if(file_exists('controllers/' . $controllerClass . '.php')) {
			$this->controller = new $controllerClass;
		}
		else {
			$this->redirect('error');
		}
		$this->controller->process($parsedUrl);
		$this->view = 'layout';
		$this->head  = $this->controller->head;
	}
}